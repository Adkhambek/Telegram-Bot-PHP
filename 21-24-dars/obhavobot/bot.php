<?php

require_once 'Telegram.php';
require_once 'User.php';

$bot_token =
    '1206704496:AAGwPeqe73ck6XJZf5jd03oG159Fd5EhcEU';

$telegram = new Telegram($bot_token);


$callback_query = $telegram->Callback_Query();

$data = $telegram->getData();
$message = $data['message'];
$text = $message['text'];
$chatID = $telegram->ChatID();

$user = new User($chatID);

$CITIES = ['Toshkent', 'Samarqand', 'Buxoro', 'Qarshi', 'Andijon', 'Nukus'];

if ($callback_query != null && $callback_query != '') {
    $callback_data = $telegram->Callback_Data();
    $chatID = $telegram->Callback_ChatID();

    if (in_array($callback_data, $CITIES)) {
//        $user->setCity($callback_data);
        $weatherData = getCurrentWeatherByCity($callback_data);
        $temp = $weatherData['main']['temp'] - 273 . "°";
        $humidity = $weatherData['main']['humidity'] . "%";
        $windSpeed = $weatherData['wind']['speed'] . "m/s";
        $text = "<b>Hozirgi ob-havo.</b>\n";
        $text.= "Temperatura: {$temp}\n";
        $text.= "Havo namligi: {$humidity}\n";
        $text.= "Shamol tezligi: {$windSpeed}\n";
        $content = ['chat_id' => $telegram->ChatID(), /*'message_id' => $telegram->MessageID(),*/
            'text' => $text, 'parse_mode' => "HTML"];
        $telegram->sendMessage($content);
    }

    $content = ['callback_query_id' => $telegram->Callback_ID(), 'text' => $callback_data, 'show_alert' => false];
    $telegram->answerCallbackQuery($content);
} elseif ($text == '/start') {
    showMainPage();
} else if ($message['location']['latitude']) {
    $lat = $message['location']['latitude'];
    $lon = $message['location']['longitude'];
    $weatherData = sendRequest('weather', ['lat' => $lat, 'lon' => $lon]);
    if ($weatherData) {
        $temp = (int)($weatherData['main']['temp'] - 273);
        sendMessage($temp);
    } else {
        sendMessage("fail");
    }
} else {
    sendMessage("fail2");
}

function showMainPage()
{
    global $telegram, $chatID, $CITIES;
    $options = getInlineKeyboardButtons($CITIES, 3);
    $keyb = $telegram->buildInlineKeyBoard($options);
    $content = ['chat_id' => $chatID, 'text' => 'Bosh menyu', 'reply_markup' => $keyb];
    $telegram->sendMessage($content);
}

function getInlineKeyboardButtons($buttons, $columnNum = 2) {
    global $telegram;
    $options = [];
    for ($i = 0; $i < count($buttons);) {
        $tempArray = [];
        for ($j = 0; $j < $columnNum && $i < count($buttons); $j++) {
            $tempArray[] = $telegram->buildInlineKeyboardButton($buttons[$i], "", $buttons[$i]);
            $i++;
        }
        $options[] = $tempArray;
    }
    return $options;
}

function getCurrentWeatherByCity($city)
{
    return sendRequest('weather', ['q' => $city]);
}

function sendRequest($apiMethod, $params)
{
    $request = "http://api.openweathermap.org/data/2.5/" . $apiMethod;
    $i = 0;
    foreach ($params as $key => $param) {
        if ($i == 0) {
            $request .= "?{$key}={$param}";
        } else {
            $request .= "&{$key}={$param}";
        }
        $i++;
    }
    $request .= "&appid=be33e8920b2ab453d2fa07b7e233eda0";

    $data = json_decode(file_get_contents($request), true);

    if ($data['cod'] == 200) {
        return $data;
    } else {
        return false;
    }
}

function sendMessage($text)
{
    global $telegram, $chatID;
    $telegram->sendMessage(['chat_id' => $chatID, 'text' => $text]);
}