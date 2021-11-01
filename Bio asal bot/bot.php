<?php
require_once 'Telegram.php';
require_once 'user.php';
$telegram = new Telegram('1096316270:AAGSkNxTvjQkqsd4Jrkwid0l7jzug1XVzQc');

$chat_id = $telegram->ChatID();
$text = $telegram->Text();
$username = $telegram->Username();
$firstname = $telegram->FirstName();
$data = $telegram->getData();
$message = $data['message'];

$orderTypes =["1kg - 50 000 so'm","1.5kg (1L) - 75 000 so'm","4.5kg (3L) - 220 000 so'm","7.5kg (5L) - 370 000 so'm"];

if ($text == "/start") {
    showMain();
} else {
    switch (getPage($chat_id)) {
        case 'main':
            if ($text == "🍯 Batafsil ma'lumot") {
                showAbout();
            } elseif ($text == "🍯 Buyurtma berish") {
                showMass();
            } else {
                chooseButtons();
            }
            break;
        case 'massa':
            if (in_array($text, $orderTypes)) {
                setMass($chat_id, $text);
                showPhone();
            } elseif ($text == "🔙 Orqaga") {
                showMain();
            } else {
                chooseButtons();
            }
            break;
        case 'phone':
            if ($message['contact']['phone_number'] != "") {
                setPhone($chat_id, $message['contact']['phone_number']);
                showDeliveryType();
            } elseif ($text == "🔙 Orqaga") {
                showMass();
            } else {
                setPhone($chat_id, $text);
                showDeliveryType();
            }
            break;
        case 'delivery':
            if ($text == "✈️ Yetkazib berish ✈") {
                showInputLocation();
            } elseif ($text == "🍯 Borib olish 🍯") {
                showReady();
            } elseif ($text == "🔙 Orqaga") {
                showPhone();
            } else {
                chooseButtons();
            }
            break;
        case 'location':
            if ($message['location']['latitude'] != "") {
                setLatitude($chat_id, $message['location']['latitude']);
                setLongitude($chat_id, $message['location']['latitude']);
                showReady();
            } elseif ($text == "Lokatsiya jo'nata olmayman") {
                showReady();
            } elseif ($text == "🔙 Orqaga") {
                showDeliveryType();
            } else {
                chooseButtons();
            }
            break;
        case 'ready':
            if ($text == "Boshqa buyurtma berish") {
                showMain();
            } else {
                chooseButtons();
            }
            break;
    }
}

function showMain()
{
    global $telegram, $chat_id, $firstname;

    setPage($chat_id, 'main');

    $option = array(
        //First row
        array($telegram->buildKeyboardButton("🍯 Batafsil ma'lumot")),
        //Second row
        array($telegram->buildKeyboardButton("🍯 Buyurtma berish"))
    );
    $keyb = $telegram->buildKeyBoard($option, $onetime = false, $resize = true);
    $content = array('chat_id' => $chat_id, 'text' => "Assalom alaykum $firstname!
Ushbu bot orqali siz BeeO asal-arichilik firmasidan tabiiy asal va  asal mahsulotlarini sotib olishingiz mumkin!");
    $telegram->sendMessage($content);
    $content = array('chat_id' => $chat_id, 'disable_web_page_preview' => false, 'reply_markup' => $keyb, 'text' => "Mening ismim Jamshid, ko`p yillardan beri oilaviy arichilik bilan shug`illanib kelamiz!
BeeO -asalchilik firmamiz mana 3 yildirki, Toshkent shahri aholisiga toza, tabiiy asal yetkizib bermoqda va ko`plab xaridorlarga ega bo`ldik, shukurki, shu yil ham arichiligimizni biroz kengaytirib siz azizlarning ham dasturxoningizga tabiiy-toza asal yetkazib berishni niyat qildik!");
    $telegram->sendMessage($content);
}

function showMass()
{
    global $telegram, $chat_id, $filePath;

    setPage($chat_id, 'massa');

    $option = array(
        array($telegram->buildKeyboardButton("1kg - 50 000 so'm")),
        array($telegram->buildKeyboardButton("1.5kg (1L) - 75 000 so'm")),
        array($telegram->buildKeyboardButton("4.5kg (3L) - 220 000 so'm")),
        array($telegram->buildKeyboardButton("7.5kg (5L) - 370 000 so'm")),
        array($telegram->buildKeyboardButton("🔙 Orqaga")),

    );
    $keyb = $telegram->buildKeyBoard($option, $onetime = false, $resize = true);
    $content = array('chat_id' => $chat_id, 'reply_markup' => $keyb, 'text' => "Buyurtma berish uchun hajmlardan birini tanlang yoki o'zingiz hohlagan hajmni kiriting.");
    $telegram->sendMessage($content);
}

function showPhone()
{
    global $telegram, $chat_id;

    setPage($chat_id, 'phone');

    $option = array(
        array($telegram->buildKeyboardButton("Raqamni jo'natish", $request_contact = true)),
        array($telegram->buildKeyboardButton("🔙 Orqaga")),
    );
    $keyb = $telegram->buildKeyBoard($option, $onetime = false, $resize = true);
    $content = array('chat_id' => $chat_id, 'reply_markup' => $keyb, 'text' => 'Hajm tanlandi, endi telefon raqamingnizni kiritsangiz.');
    $telegram->sendMessage($content);
}

function showDeliveryType()
{
    global $telegram, $chat_id;

    setPage($chat_id, 'delivery');

    $option = array(
        array($telegram->buildKeyboardButton("✈️ Yetkazib berish ✈")),
        array($telegram->buildKeyboardButton("🍯 Borib olish 🍯")),
        array($telegram->buildKeyboardButton("🔙 Orqaga")),
    );
    $keyb = $telegram->buildKeyBoard($option, $onetime = false, $resize = true);
    $content = array('chat_id' => $chat_id, 'reply_markup' => $keyb, 'text' => "Bizda Toshkent shahri bo'ylab yetkazib berish xizmati mavjud. Yoki, o'zingiz tashrif buyurib olib ketishingiz mumkin!
Manzil: Toshkent sh, Olmazor tum. Talabalar shaharchasi.");
    $telegram->sendMessage($content);
}

function showInputLocation()
{
    global $telegram, $chat_id;

    setPage($chat_id, 'location');

    $option = array(
        array($telegram->buildKeyboardButton("Lokatsiya jo'natish", false, true)),
        array($telegram->buildKeyboardButton("Lokatsiya jo'nata olmayman")),
        array($telegram->buildKeyboardButton("🔙 Orqaga")),
    );
    $key = $telegram->buildKeyBoard($option, $onetime = false, $resize = true);
    $content = array('chat_id' => $chat_id, 'reply_markup' => $key, 'text' => "Yaxshi, endi, lokatsiya jo'nating!");
    $telegram->sendMessage($content);
}

function showReady()
{
    global $telegram, $chat_id, $ADMIN_CHAT_ID;

    setPage($chat_id, 'ready');

    $option = array(
        array($telegram->buildKeyboardButton("Boshqa buyurtma berish")),
    );
    $keyb = $telegram->buildKeyBoard($option, $onetime = false, $resize = true);
    $content = array('chat_id' => $chat_id, 'reply_markup' => $keyb, 'text' => 'Sizning buyurtmangiz qabul qilindi. Tez orada siz bilan bog\'lanamiz. Murojaatingiz uchun rahmat! 😊');
    $telegram->sendMessage($content);

    //send admin
    $text = "Yangi buyurtma keldi!";
    $text.= "\n";
    $text.= "Hajm: ".getMass($chat_id);
    $text.= "\n";
    $text.= "Telefon raqam: ".getPhone($chat_id);
    $text.= "\n";

    $content = array('chat_id' => $ADMIN_CHAT_ID, 'reply_markup' => $keyb, 'text' => $text);
    $telegram->sendMessage($content);

    if (getLatitude($chat_id) != "") {
        $content = array('chat_id' => $ADMIN_CHAT_ID, 'latitude' => getLatitude($chat_id), 'longitude' => getLongitude($chat_id));
        $telegram->sendLocation($content);
    }
}

function showAbout()
{
    global $telegram, $chat_id;
    $content = array('chat_id' => $chat_id, 'text' => "Biz haqimizda ma'lumot. <a href='https://telegra.ph/Biz-haqimizda-05-12'>Havola</a>", 'parse_mode' => "html");
    $telegram->sendMessage($content);
}

function chooseButtons()
{
    global $telegram, $chat_id;

    $content = array('chat_id' => $chat_id, 'text' => "Iltimos, quyidagi tugmalardan birini tanlang.");
    $telegram->sendMessage($content);
}