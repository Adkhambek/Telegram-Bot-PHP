<?php

require_once 'Telegram.php';
require_once 'User.php';
require_once 'Pages.php';
require_once 'Texts.php';
require_once 'Categories.php';

$bot_token =
    '1246793090:AAGK2fA2zHy4FsTf8BmdHB7-qRSZgAFeN8g';

$telegram = new Telegram($bot_token);
//var_dump($telegram->setWebhook((isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]"));

$callback_query = $telegram->Callback_Query();
$callback_data = $telegram->Callback_Data();

$data = $telegram->getData();
$message = $data['message'];
$text = $message['text'];
$chatID = $telegram->ChatID();

$user = new User($chatID);
$texts = new Texts($user->getLanguage());
$categories = new Categories($user->getLanguage());

$ADMINS_CHAT_IDS = [
    635793263,
];

echo 'gg';

if ($text == '/start') {
    showStart();
} else {
    switch ($user->getPage()) {
        case Pages::START:
            switch ($text) {
                case "🇺🇿 O'zbekcha":
                    $user->setLanguage('uz');
                    $texts = new Texts($user->getLanguage());
                    showMainPage();
                    break;
                case "🇷🇺 Русский":
                    $user->setLanguage('ru');
                    $texts = new Texts($user->getLanguage());
                    showMainPage();
                    break;
                default:
                    showStart();
                    break;
            }
            break;
        case Pages::PAGE_MAIN:
            switch ($text) {
                case $texts->getText('page_main_btn_1'): // catalog
                    showCategoriesPage();
                    break;
                case $texts->getText('page_main_btn_2'): // korzina
//                    showCartPage();
                    break;
                case $texts->getText('page_main_btn_3'): // qayta aloqa
//                    showCompanyPhoneNumber();
                    break;
                case $texts->getText('page_main_btn_4'): // bot haqida
//                    showAbout();
                    break;
                case $texts->getText('page_main_admin_btn'): // admin panel
                    if (in_array($chatID, $ADMINS_CHAT_IDS)) {
//                        showAdminPage();
                    }
                    break;
                default:
                    showMainPage();
                    break;
            }
            break;
        case Pages::PAGE_CATALOG:
            switch ($text) {
                case $texts->getText("back_btn"):
                    showMainPage();
                    break;
                default:
                    if (in_array($text, $categories->getAllNames())) {
                        $categoryId = $categories->getIdByName($text);
                        $user->setCategoryId($categoryId);
                        showProductsPage($categoryId);
                    }
            }
            break;
    }
}

function showStart()
{
    global $user;
    $user->setPage(Pages::START);
    $buttons = ["🇷🇺 Русский", "🇺🇿 O'zbekcha"];
    $textToSend = "Пожалуйста выберите язык. 👇\n\nIltimos, tilni tanlang. 👇";
    sendTextWithKeyboard($buttons, $textToSend);
}

function showMainPage()
{
    global $user, $texts, $chatID, $ADMINS_CHAT_IDS;
    $user->setPage(Pages::PAGE_MAIN);
    $buttons = $texts->getArrayLike("page_main_btn");
    if (in_array($chatID, $ADMINS_CHAT_IDS)) {
        $buttons[] = $texts->getText("page_main_admin_btn");
    }
    $textToSend = $texts->getText("page_main_text");
    sendTextWithKeyboard($buttons, $textToSend);
}

function showCategoriesPage()
{
    global $user, $texts, $categories;
    $buttons = $categories->getAllNames();
    if (!$buttons) {
        sendMessage($texts->getText('page_categories_text_no_category'));
    } else {
        $user->setPage(Pages::PAGE_CATALOG);
        $textToSend = $texts->getText("page_categories_text");
        sendTextWithKeyboard($buttons, $textToSend, true);
    }
}

function sendMessage($text)
{
    global $telegram, $chatID;
    $telegram->sendMessage(['chat_id' => $chatID, 'text' => $text]);
}

function sendTextWithKeyboard($buttons, $text, $backBtn = false)
{
    global $telegram, $chatID, $texts;
    $option = [];
    if (count($buttons) % 2 == 0) {
        for ($i = 0; $i < count($buttons); $i += 2) {
            $option[] = array($telegram->buildKeyboardButton($buttons[$i]), $telegram->buildKeyboardButton($buttons[$i + 1]));
        }
    } else {
        for ($i = 0; $i < count($buttons) - 1; $i += 2) {
            $option[] = array($telegram->buildKeyboardButton($buttons[$i]), $telegram->buildKeyboardButton($buttons[$i + 1]));
        }
        $option[] = array($telegram->buildKeyboardButton(end($buttons)));
    }
    if ($backBtn) {
        $option[] = [$telegram->buildKeyboardButton($texts->getText("back_btn"))];
    }
    $keyboard = $telegram->buildKeyBoard($option, $onetime = false, $resize = true);
    $content = array('chat_id' => $chatID, 'reply_markup' => $keyboard, 'text' => $text, 'parse_mode' => "HTML");
    $telegram->sendMessage($content);
}