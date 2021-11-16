<?php

require_once 'Telegram.php';
require_once 'user.php';
require_once 'texts.php';
require_once 'districts.php';
require_once 'subjects.php';

$telegram = new Telegram('1185070666:AAGrSmjGgvqlCNBdkTr-HnMyP-cExeQr9oI');

$data = $telegram->getData();
$message = $data['message'];
$text = $message['text'];
$chat_id = $message['chat']['id'];

$callback_data = $telegram->Callback_Data();
$callback_query = $telegram->Callback_Query();

if ($text == "/start") {
    chooseLanguage();
} else {
    switch (getPage($chat_id)) {
        case 'start':
            if ($text == "Русский 🇷🇺") {
                setLanguage($chat_id, "ru");
                showMainPage();
            } elseif ($text == "O'zbek tili 🇺🇿") {
                setLanguage($chat_id, "uz");
                showMainPage();
            } else {
                chooseButtons();
            }
            break;
        case 'main':
            switch ($text) {
                case "🔖 " . getmText('choose_training_center', $chat_id):
                    showDistricts();
                    break;
                case "💎 " . getmText('training_centers_list', $chat_id):
                    // TODO
                    break;
                case "🇺🇿🔄🇷🇺 " . getmText('change_lang', $chat_id):
                    changeLanguage();
                    break;

            }
            break;
        case 'districts':
            switch ($text) {
                case "🔙 " . getmText("back", $chat_id):
                case "🔙 " . getmText("main_page", $chat_id):
                    showMainPage();
                    break;
                default:
                    if (in_array(substr($text, 5), getDistricts($chat_id))) {
                        setDistrict($chat_id, $text);
                        showSubjects();
                    } else {
                        chooseButtons();
                    }
                    break;
            }
            break;
        case 'subjects':
            switch ($text) {
                case "🔙 " . getmText("back", $chat_id):
                    showDistricts();
                    break;
                case "🔙 " . getmText("main_page", $chat_id):
                    showMainPage();
                    break;
                default:
                    if (in_array(substr($text, 7), getSubjects($chat_id))) {
//                        setSubject($chat_id, $text);
                        showTrainingCentres();
                    } else {
                        chooseButtons();
                    }
                    break;
            }
            break;
            break;
    }
}

function chooseLanguage()
{
    global $telegram, $chat_id;

    $text = "Пожалуйста выберите язык.\nIltimos, tilni tanlang.";

    setPage($chat_id, 'start');

    $option = array(
        array($telegram->buildKeyboardButton("Русский 🇷🇺"), $telegram->buildKeyboardButton("O'zbek tili 🇺🇿")),
    );
    $keyb = $telegram->buildKeyBoard($option, $onetime = false, $resize = true);
    $content = array('chat_id' => $chat_id, 'text' => $text, 'reply_markup' => $keyb);
    $telegram->sendMessage($content);
}

function showMainPage()
{
    global $telegram, $chat_id;

    $text = getmText('choose_category', $chat_id);

    setPage($chat_id, 'main');

    $option = array(
        array($telegram->buildKeyboardButton("🔖 " . getmText('choose_training_center', $chat_id)), $telegram->buildKeyboardButton("💎 " . getmText('training_centers_list', $chat_id))),
        array($telegram->buildKeyboardButton("🇺🇿🔄🇷🇺 " . getmText('change_lang', $chat_id))),
    );
    $keyb = $telegram->buildKeyBoard($option, $onetime = false, $resize = true);
    $content = array('chat_id' => $chat_id, 'text' => $text, 'reply_markup' => $keyb);
    $telegram->sendMessage($content);
}

function showDistricts()
{
    global $chat_id;
    $text = getmText('choose_district', $chat_id);
    setPage($chat_id, 'districts');
    $districts = getDistricts($chat_id);
    sendTextWithKeyboard($districts, $text, "📍 ");
}

function showSubjects()
{
    global $chat_id;
    $text = getmText('choose_subject', $chat_id);
    setPage($chat_id, 'subjects');
    $subjects = getSubjects($chat_id);
    sendTextWithKeyboard($subjects, $text, "▫️ ");
}

function showTrainingCentres()
{
    global $telegram, $chat_id;
    $training_centers = getTrainingCenters();
    $option = [
        [$telegram->buildInlineKeyboardButton()]
    ];
    $keyb = $telegram->buildInlineKeyBoard($option);
    $content = array('chat_id' => $chat_id, 'text' => "test uchun", 'reply_markup' => $keyb);
    $telegram->sendMessage($content);
}

function sendTextWithKeyboard($buttons, $text, $smile)
{
    global $telegram, $chat_id;
    $option = [];
    for ($i = 0; $i < count($buttons); $i += 2) {
        $option[] = [$telegram->buildKeyboardButton($smile . $buttons[$i]), $telegram->buildKeyboardButton($smile . $buttons[$i + 1])];
    }
    $option[] = [$telegram->buildKeyboardButton("🔙 " . getmText("back", $chat_id)), $telegram->buildKeyboardButton("🔙 " . getmText("main_page", $chat_id))];
    $keyb = $telegram->buildKeyBoard($option, $onetime = false, $resize = true);
    $content = array('chat_id' => $chat_id, 'text' => $text, 'reply_markup' => $keyb);
    $telegram->sendMessage($content);
}

function changeLanguage()
{
    global $chat_id;
    if (getLanguage($chat_id) == "uz") {
        setLanguage($chat_id, "ru");
    } else {
        setLanguage($chat_id, "uz");
    }
    showMainPage();
}

// TODO
function chooseButtons()
{
    global $telegram, $chat_id;

    $content = array('chat_id' => $chat_id, 'text' => "Iltimos, quyidagi tugmalardan birini tanlang.");
    $telegram->sendMessage($content);
}

function sendMessage($text)
{
    global $telegram, $chat_id;
    $telegram->sendMessage([
        'chat_id' => $chat_id,
        'text' => $text
    ]);
}