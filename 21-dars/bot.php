<?php

require_once 'Telegram.php';

$bot_token =
    '1206704496:AAGwPeqe73ck6XJZf5jd03oG159Fd5EhcEU';

$telegram = new Telegram($bot_token);

$callback_query = $telegram->Callback_Query();

$data = $telegram->getData();
$message = $data['message'];
$text = $message['text'];
$chatID = $message['chat']['id'];

if ($text == '/start') {
    showMainPage();
} else if ($message['location']['latitude']) {
    $lat = $message['location']['latitude'];
    $lon = $message['location']['longitude'];
    $weatherData = sendRequest('weather',['lat' => $lat, 'lon' => $lon]);
    if ($weatherData) {
        $temp = (int)($weatherData['main']['temp'] - 273);
        sendMessage($temp);
    } else {
        sendMessage("fail");
    }
} else {
    sendMessage("fail2");
}

$tempData = sendRequest('onecall', [
    'lat' => 41.26,
    'lon' => 69.22,
]);

sendMessage(json_encode($tempData, JSON_PRETTY_PRINT));

function showMainPage()
{
    global $telegram, $chatID;
    $options = [
        [$telegram->buildKeyboardButton("Hozirgi ob-havo")],
        [$telegram->buildKeyboardButton("Joylashuvimdigi ob-havoni bilish", false, true)],
    ];
    $keyb = $telegram->buildKeyBoard($options);
    $content = ['chat_id' => $chatID, 'text' => 'Bosh menyu', 'reply_markup' => $keyb];
    $telegram->sendMessage($content);
}

function getCurrentWeatherByCity($city)
{
    return sendRequest('weather', ['q' => $city]);
}

function sendRequest($apiMethod, $params)
{
    $request = "http://api.openweathermap.org/data/2.5/".$apiMethod;
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