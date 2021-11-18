<?php

require_once 'Telegram.php';
require_once 'User.php';
require_once 'Pages.php';
require_once 'Districts.php';
require_once 'Subjects.php';
require_once 'Texts.php';
require_once 'TrainingCenters.php';

$telegram = new Telegram('1185070666:AAGrSmjGgvqlCNBdkTr-HnMyP-cExeQr9oI');

$data = $telegram->getData();
$message = $data['message'];
$text = $message['text'];
$chat_id = $message['chat']['id'];

$callback_data = $telegram->Callback_Data();
$callback_query = $telegram->Callback_Query();

$user = new User($chat_id);
$districts = new Districts($user->getLanguage());
$subjects = new Subjects($user->getLanguage());
$texts = new Texts($user->getLanguage());


if ($text == "/start") {
    chooseLanguage();
} else {
    switch ($user->getPage()) {
        case Pages::START:
            if ($text == "Русский 🇷🇺") {
                $user->setLanguage("ru");
                showMainPage();
            } elseif ($text == "O'zbek tili 🇺🇿") {
                $user->setLanguage("uz");
                showMainPage();
            } else {
                chooseButtons();
            }
            break;
        case Pages::MAIN:
            switch ($text) {
                case $texts->getText('choose_training_center'):
                    showDistricts();
                    break;
                case $texts->getText('training_centers_list'):
                    // TODO
                    break;
                case $texts->getText('change_lang'):
                    changeLanguage();
                    break;

            }
            break;
        case Pages::DISTRICTS:
            switch ($text) {
                case $texts->getText('back'):
                case $texts->getText('main_page'):
                    showMainPage();
                    break;
                default:
                    if (in_array(substr($text, 5), $districts->getNames())) {
                        $user->setDistrict($districts->getKeyword(substr($text, 5)));
                        showSubjects();
                    } else {
                        chooseButtons();
                    }
                    break;
            }
            break;
        case Pages::SUBJECTS:
            switch ($text) {
                case $texts->getText('back'):
                    showDistricts();
                    break;
                case $texts->getText('main_page'):
                    showMainPage();
                    break;
                default:
                    if (in_array((substr($text, 7)), $subjects->getNames())) {
                        $user->setSubject($subjects->getKeyword(substr($text, 7)));
                        showTrainingCentres();
                    } else {
                        chooseButtons();
                    }
                    break;
            }
            break;
    }
}

function chooseLanguage()
{
    global $telegram, $chat_id, $user;

    $text = "Пожалуйста выберите язык.\nIltimos, tilni tanlang.";

    $user->setPage(Pages::START);

    $option = array(
        array($telegram->buildKeyboardButton("Русский 🇷🇺"), $telegram->buildKeyboardButton("O'zbek tili 🇺🇿")),
    );
    $keyb = $telegram->buildKeyBoard($option, $onetime = false, $resize = true);
    $content = array('chat_id' => $chat_id, 'text' => $text, 'reply_markup' => $keyb);
    $telegram->sendMessage($content);
}

function showMainPage()
{
    global $telegram, $chat_id, $user, $texts;

    $texts = new Texts($user->getLanguage());

    $text = $texts->getText('choose_category');

    $user->setPage(Pages::MAIN);

    $option = array(
        array($telegram->buildKeyboardButton($texts->getText('choose_training_center')), $telegram->buildKeyboardButton($texts->getText('training_centers_list'))),
        array($telegram->buildKeyboardButton($texts->getText('change_lang'))),
    );
    $keyb = $telegram->buildKeyBoard($option, $onetime = false, $resize = true);
    $content = array('chat_id' => $chat_id, 'text' => $text, 'reply_markup' => $keyb);
    $telegram->sendMessage($content);
}

function showDistricts()
{
    global $user, $districts, $texts;
    $text = $texts->getText('choose_district');
    $user->setPage(Pages::DISTRICTS);
    sendTextWithKeyboard($districts->getNames(), $text, "📍 ");
}

function showSubjects()
{
    global $user, $subjects, $texts;
    $text = $texts->getText('choose_subject');
    $user->setPage(Pages::SUBJECTS);
    sendTextWithKeyboard($subjects->getNames(), $text, "▫️ ");
}

function showTrainingCentres()
{
    global $telegram, $chat_id, $user, $texts;
    $text = $texts->getText('choose_tc_text');
    $trainingCentersList = TrainingCenters::getNames($user->getDistrict(), $user->getSubject());
    if (!$trainingCentersList) {
        $content = array('chat_id' => $chat_id, 'text' => $texts->getText('no_tc'));
        $telegram->sendMessage($content);
    } else {
        $option = [];
        foreach ($trainingCentersList as $item) {
            $option[] = [$telegram->buildInlineKeyboardButton("☑️".$item."☑️", "", $item)];
        }
        $keyb = $telegram->buildInlineKeyBoard($option);
        $content = array('chat_id' => $chat_id, 'text' => $text, 'reply_markup' => $keyb);
        $telegram->sendMessage($content);
    }
}

function sendTextWithKeyboard($buttons, $text, $smile)
{
    global $telegram, $chat_id, $texts;
    $option = [];
    for ($i = 0; $i < count($buttons); $i += 2) {
        $option[] = [$telegram->buildKeyboardButton($smile . $buttons[$i]), $telegram->buildKeyboardButton($smile . $buttons[$i + 1])];
    }
    $option[] = [$telegram->buildKeyboardButton($texts->getText('back')), $telegram->buildKeyboardButton($texts->getText('main_page'))];
    $keyb = $telegram->buildKeyBoard($option, $onetime = false, $resize = true);
    $content = array('chat_id' => $chat_id, 'text' => $text, 'reply_markup' => $keyb);
    $telegram->sendMessage($content);
}

function changeLanguage()
{
    global $user;
    if ($user->getLanguage() == "uz") {
        $user->setLanguage("ru");
    } else {
        $user->setLanguage("uz");
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