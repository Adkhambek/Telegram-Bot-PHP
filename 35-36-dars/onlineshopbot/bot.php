<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once 'Telegram.php';
require_once 'User.php';
require_once 'Pages.php';
require_once 'Texts.php';
require_once 'Categories.php';
require_once 'Products.php';
require_once 'ShoppingCart.php';

$bot_token =
    '1246793090:AAGK2fA2zHy4FsTf8BmdHB7-qRSZgAFeN8g';

$rootPath = "https://roboss.uz/onlineshopbot/";

$NUMBERS = ['0️⃣', '1️⃣', '2️⃣', '3️⃣', '4️⃣', '5️⃣', '6️⃣', '7️⃣', '8️⃣', '9️⃣'];

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
$products = new Products($user->getLanguage());

$ADMINS_CHAT_IDS = [
    635793263,
];

ini_set('precision', 100);

echo 'gg';

//sendMessage(json_encode($data, JSON_PRETTY_PRINT));

if (isset($message['reply_to_message']['forward_from']['id'])) {
    if (in_array($chatID, $ADMINS_CHAT_IDS)) {
        $content = ['chat_id' => $message['reply_to_message']['forward_from']['id'], 'text' => $text];
        $telegram->sendMessage($content);
    }
}

// callback buttons
if ($callback_query !== null && $callback_query != '') {
    $callback_data = $telegram->Callback_Data();
    $chatID = $telegram->Callback_ChatID();

    if (isContains($callback_data, "editProduct")) {
        $optionNum = substr($callback_data, 11);
        $optionNum = explode(',', $optionNum);
        $optionNum = substr($optionNum[0], 6);
        $user->setProductOption($optionNum);
        $content = array('chat_id' => $chatID, 'message_id' => $callback_query['message']['message_id'] - 1);
        $telegram->deleteMessage($content);
        $content = array('chat_id' => $chatID, 'message_id' => $callback_query['message']['message_id']);
        $telegram->deleteMessage($content);
        $options = [[$telegram->buildKeyboardButton("❌ Bekor qilish")]];
        $keyb = $telegram->buildKeyBoard($options, $onetime = false, $resize = true);
        $content = ['chat_id' => $chatID, 'text' => "Tovarni narxini kiriting:", 'reply_markup' => $keyb];
        $telegram->sendMessage($content);
        $user->setPage(Pages::PAGE_ADMIN_EDIT_PRODUCT_PRICE_INPUT_PRICE);
    } elseif (isContains($callback_data, 'count')) {
        $mdata = explode(',', $callback_data);
        $count = substr($mdata[0], 5);
        $optionNum = substr($mdata[1], 6);
        $productId = substr($mdata[2], 9);
        if (ShoppingCart::addNewOrder($chatID, $productId, $count, $optionNum)) {
            $options = [[$telegram->buildInlineKeyboardButton("Savatga o'tish", "", "shoppingcart")]];
            $keyb = $telegram->buildInlineKeyBoard($options);
            $content = ['chat_id' => $chatID, 'message_id' => $telegram->MessageID(), 'text' => "Tovar savatga qo'shildi", 'reply_markup' => $keyb];
            $telegram->editMessageText($content);
        } else {
            sendMessage("Tovar savatga qo'shilmadi");
        }
    } elseif (isContains($callback_data, 'back')) {
        $productId = substr($callback_data, 4);
        $product = $products->getProduct($productId);
        showProduct($product, true);
    } elseif (isContains($callback_data, 'option')) {
        $mdata = explode(',', $callback_data);
        $optionNum = substr($mdata[0], 6);
        $productId = substr($mdata[1], 9);
        showChooseCount($productId, $optionNum);
    } elseif ($callback_data == "shoppingcart") {
        $content = ['chat_id' => $chatID, 'message_id' => $telegram->MessageID()];
        $telegram->deleteMessage($content);
        showCartPage();
    } elseif ($callback_data == "closeWindow") {
        $content = array('chat_id' => $chatID, 'message_id' => $callback_query['message']['message_id']);
        $telegram->deleteMessage($content);
    } elseif (isContains($callback_data, "id")) {
        $mdata = explode(",", $callback_data);
        $id = substr($callback_data, 2);
        $optionNum = $mdata[1];
        ShoppingCart::deleteProduct($chatID, $id, $optionNum);
        if (ShoppingCart::getUserProducts($chatID)) {
            showProductsToClear(true);
        } else {
            $content = array('chat_id' => $chatID, 'message_id' => $callback_query['message']['message_id'], 'text' => "Savat bo'sh holatda");
            $telegram->editMessageText($content);
            showMainPage();
        }
    }

    //answer nothing with answerCallbackQuery, because it is required
    $content = ['callback_query_id' => $telegram->Callback_ID(), 'text' => "", 'show_alert' => false];
    $telegram->answerCallbackQuery($content);

} elseif ($text == '/start') {
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
        // user
        case Pages::PAGE_MAIN:
            switch ($text) {
                case $texts->getText('page_main_btn_1'): // catalog
                    showCategoriesPage();
                    break;
                case $texts->getText('page_main_btn_2'): // korzina
                    showCartPage();
                    break;
                case $texts->getText('page_main_btn_3'): // aloqa
                    sendMessage("+998993213123");
                    break;
                case $texts->getText('page_main_btn_4'): // bot haqida
                    sendMessage("Bu bot sizga mahsulotlarni yetkazib berishda yordam beradi.");
                    break;
                case $texts->getText('page_main_btn_5'): // xabar yuborish
                    $user->setPage(Pages::PAGE_SEND_LETTER);
                    sendTextWithKeyboard([], "Iltimos, xabar matnini kiriting.", true);
                    break;
                case $texts->getText('page_main_admin_btn'): // admin panel
                    if (in_array($chatID, $ADMINS_CHAT_IDS)) {
                        showAdminPage();
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
                    } else {
                        sendMessage("Iltimos, quyidagi kategoriyalardan birini tanlang.");
                    }
            }
            break;
        case Pages::PAGE_PRODUCTS:
            switch ($text) {
                case $texts->getText("back_btn"):
                    showCategoriesPage();
                    break;
                default:
                    if (in_array($text, $products->getNamesByCategoryId($user->getCategoryId()))) {
                        $productId = $products->getIdByName($text);
                        $product = $products->getProduct($productId);
                        showProduct($product);
                    } else {
                        sendMessage("Iltimos, quyidagi kategoriyalardan birini tanlang.");
                    }
            }
            break;
        case Pages::PAGE_SHOPPING_CART:
            switch ($text) {
                case "💵 Buyurtmani hisoblash":
                    showCartPage();
                    break;
                case "🛎 Buyurtma berish":
                    showCheckoutPage();
                    break;
                case "⚙️ O'zgartirish":
                    showProductsToClear();
                    break;
                case "❌ Tozalash":
                    showClearProducts();
                    break;
                case $texts->getText('back_btn'):
                    showMainPage();
                    break;
            }
            break;
        case Pages::PAGE_DELIVERY_TYPE:
            switch ($text) {
                case "Olib ketish":
                    $user->setOrderType('pickupType');
                    showFirstNamePage();
                    break;
                case "Yetkazib berish":
                    $user->setOrderType('deliveryType');
                    showFirstNamePage();
                    break;
                case $texts->getText('back_btn'):
                    showCartPage();
                    break;
            }
            break;
        case Pages::PAGE_FIRST_NAME:
            switch ($text) {
                case $texts->getText('back_btn'):
                    showCheckoutPage();
                    break;
                default:
                    $user->setFirstName($text);
                    if ($user->getOrderType() == 'pickupType') {
                        showPhoneNumberPage();
                    } else {
                        showLocationPage();
                    }
                    break;
            }
            break;
        case Pages::PAGE_PHONE_NUMBER:
            switch ($text) {
                case $texts->getText("back_btn"):
                    showFirstNamePage();
                    break;
                default:
                    if ($message['contact']['phone_number'] != "") {
                        $user->setPhoneNumber($message['contact']['phone_number']);
                    } else {
                        $user->setPhoneNumber($text);
                    }
                    showConfirmOrderPage();
                    break;
            }
            break;
        case Pages::PAGE_LOCATION:
            switch ($text) {
                case $texts->getText("back_btn"):
                    showFirstNamePage();
                    break;
                case "Lokatsiya jo'nata olmayamman":
                    $user->setLatitude("");
                    $user->setLongitude("");
                    showPhoneNumberPage();
                    break;
                default:
                    if ($message['location']['latitude'] && $message['location']['longitude']) {
                        $user->setLatitude($message['location']['latitude']);
                        $user->setLongitude($message['location']['longitude']);
                        showPhoneNumberPage();
                    }
                    break;
            }
            break;
        case Pages::PAGE_ORDER_CONFIRMATION:
            switch ($text) {
                case $texts->getText('back_btn'):
                    showPhoneNumberPage();
                    break;
                case "Buyurtma berish":
                    showOrderConfirmed();
                    ShoppingCart::clearShoppingCart($user);
                    break;
                case "Bekor qilish":
                    showOrderCanceled();
                    break;

            }
            break;
        case Pages::PAGE_SEND_LETTER:
            switch ($text) {
                case $texts->getText('back_btn'):
                    showMainPage();
                    break;
                default:
                    sendMessage("Xabaringiz muvaffaqiyatli yuborildi. ✅");
                    showMainPage();
                    foreach ($ADMINS_CHAT_IDS as $admin_chat_id) {
                        $content = ['chat_id' => $admin_chat_id, 'from_chat_id' => $chatID, 'message_id' => $telegram->MessageID()];
                        $telegram->forwardMessage($content);
                    }
                    break;
            }
            break;
        // admin
        case Pages::PAGE_ADMIN:
            switch ($text) {
                case "➕ Tovar qo'shish":
                    $user->setProduct([]);
                    showCategoriesPage(Pages::PAGE_ADMIN_PRODUCT_CATEGORY);
                    break;
                case "➕ Kategoriya qo'shish":
                    showAdminAddCategory();
                    break;
                case "➖ Tovar o'chirish":
                    showCategoriesPage(Pages::PAGE_ADMIN_DELETE_PRODUCT_CATEGORY);
                    break;
                case "➖ Kategoriya o'chirish":
                    showCategoriesPage(Pages::PAGE_ADMIN_DELETE_CATEGORY);
                    break;
                case "Tovar narxini o'zgartirish":
                    showCategoriesPage(Pages::PAGE_ADMIN_EDIT_PRODUCT_PRICE_CHOOSE_CATEGORY);
                    break;
                case $texts->getText("back_btn"):
                    showMainPage();
                    break;
            }
            break;
        case Pages::PAGE_ADMIN_PRODUCT_CATEGORY:
            switch ($text) {
                case $texts->getText("back_btn"):
                    showAdminPage();
                    break;
                default:
                    if (in_array($text, $categories->getAllNames())) {
                        $categoryId = $categories->getIdByName($text);
                        $user->setCategoryId($categoryId);
                        $product = $user->getProduct();
                        $product['optionsCount'] = 0;
                        $product['categoryId'] = $categoryId;
                        $user->setProduct($product);
                        $user->setCategoryId($categoryId);
                        showAdminSendProductPhoto();
                    } else {
                        sendMessage("Iltimos, quyidagi kategoriyalardan birini tanlang.");
                    }
            }
            break;
        case Pages::PAGE_ADMIN_PRODUCT_PHOTO:
            switch ($text) {
                case $texts->getText("back_btn"):
                    showCategoriesPage(Pages::PAGE_ADMIN_PRODUCT_CATEGORY);
                    break;
                default:
                    if (!$message['photo']) {
                        showAdminSendProductPhoto();
                    } else {
                        $photo = end($message['photo']);
                        $result = $telegram->getFile($photo['file_id']);
                        $filePath = $result['result']['file_path'];
                        $product = $user->getProduct();
                        $cnt = file_get_contents('photoCounter.txt');
                        $localFilePath = 'photos/' . $cnt . "." . explode(".", $filePath)[1];
                        $telegram->downloadFile($filePath, $localFilePath);
                        file_put_contents('photoCounter.txt', $cnt + 1);
                        $product['photoUrl'] = $localFilePath;
                        $user->setProduct($product);
                        sendMessage("Rasm muvaffaqiyatli yuklandi.");
                        showAdminSendProductName();
                    }
                    break;
            }
            break;
        case Pages::PAGE_ADMIN_PRODUCT_NAME:
            switch ($text) {
                case $texts->getText("back_btn"):
                    showAdminSendProductPhoto();
                    break;
                default:
                    $product = $user->getProduct();
                    $product['name'] = $text;
                    $user->setProduct($product);
                    showAdminSendProductInfo();
                    break;
            }
            break;
        case Pages::PAGE_ADMIN_PRODUCT_INFO:
            switch ($text) {
                case $texts->getText("back_btn"):
                    showAdminSendProductName();
                    break;
                default:
                    $product = $user->getProduct();
                    $product['info'] = $text;
                    $product['options'] = [];
                    $product['optionsCount'] = 0;
                    $user->setProduct($product);
                    showAdminSendProductOptionsName();
                    break;
            }
            break;
        case Pages::PAGE_ADMIN_PRODUCT_OPTIONS_NAME:
            switch ($text) {
                case $texts->getText("back_btn"):
                    showAdminSendProductInfo();
                    break;
                default:
                    $product = $user->getProduct();
                    $product['options'][$product['optionsCount']]['name'] = $text;
                    $user->setProduct($product);
                    showAdminSendProductOptionsPrice();
                    break;
            }
            break;
        case Pages::PAGE_ADMIN_PRODUCT_OPTIONS_PRICE:
            switch ($text) {
                case $texts->getText("back_btn"):
                    showAdminSendProductOptionsName();
                    break;
                default:
                    $product = $user->getProduct();
                    $product['options'][$product['optionsCount']]['price'] = $text;
                    $user->setProduct($product);
                    showProduct($product);
                    showAdminSendProductOptionsConfirmOrAddMore();
                    break;
            }
            break;
        case Pages::PAGE_ADMIN_PRODUCT_OPTIONS_CONFIRM_OR_ADD_MORE:
            switch ($text) {
                case $texts->getText("back_btn"):
                    showAdminSendProductInfo();
                    break;
                case $texts->getText("btn_add_more"):
                    $product = $user->getProduct();
                    $product['optionsCount'] = ((int)($product['optionsCount'])) + 1;
                    $user->setProduct($product);
                    showAdminSendProductOptionsName();
                    break;
                case $texts->getText('btn_done'):
                    if (Products::addNewProduct($user->getProduct())) {
                        sendMessage("tovar qo'shildi");
                        showAdminPage();
                    } else {
                        sendMessage("tovar qo'shilmadi...:(");
                    }
                    break;
                default:
                    showAdminSendProductOptionsConfirmOrAddMore();
                    break;
            }
            break;
        // add new category
        case Pages::PAGE_ADMIN_ADD_CATEGORY:
            switch ($text) {
                case $texts->getText("back_btn"):
                    showAdminPage();
                    break;
                default:
                    if (Categories::addNewCategory($text)) {
                        sendMessage("kategoriya qo'shildi.");
                        showAdminPage();
                    } else {
                        sendMessage("kategoriya qo'shilmadi.");
                    }
                    break;
            }
            break;
        // delete product
        case Pages::PAGE_ADMIN_DELETE_PRODUCT_CATEGORY:
            switch ($text) {
                case $texts->getText("back_btn"):
                    showAdminPage();
                    break;
                default:
                    if (in_array($text, $categories->getAllNames())) {
                        $categoryId = $categories->getIdByName($text);
                        $user->setCategoryId($categoryId);
                        showProductsPage($categoryId, Pages::PAGE_ADMIN_DELETE_PRODUCT_NAME);
                    }
            }
            break;
        case Pages::PAGE_ADMIN_DELETE_PRODUCT_NAME:
            switch ($text) {
                case $texts->getText("back_btn"):
                    showCategoriesPage(Pages::PAGE_ADMIN_DELETE_PRODUCT_CATEGORY);
                    break;
                default:
                    if (in_array($text, $products->getNamesByCategoryId($user->getCategoryId()))) {
                        $productId = $products->getIdByName($text);
                        if (Products::deleteProduct($productId)) {
                            sendMessage("Tovar o'chirildi.");
                            showAdminPage();
                        } else {
                            sendMessage("Tovar o'chirilmadi. Qayta urinib ko'ring.");
                        }
                    }
                    break;
            }
            break;
        // delete category
        case Pages::PAGE_ADMIN_DELETE_CATEGORY:
            switch ($text) {
                case $texts->getText("back_btn"):
                    showAdminPage();
                    break;
                default:
                    if (in_array($text, $categories->getAllNames())) {
                        $categoryId = $categories->getIdByName($text);
                        if (Categories::deleteCategory($categoryId)) {
                            sendMessage("Kategoriya o'chirildi.");
                            showAdminPage();
                        } else {
                            sendMessage("Kategoriya o'chirilmadi. Qayta urinib ko'ring.");
                        }
                    }
            }
            break;
        // edit price
        case Pages::PAGE_ADMIN_EDIT_PRODUCT_PRICE_CHOOSE_CATEGORY:
            switch ($text) {
                case $texts->getText("back_btn"):
                    showAdminPage();
                    break;
                default:
                    if (in_array($text, $categories->getAllNames())) {
                        $categoryId = $categories->getIdByName($text);
                        $user->setCategoryId($categoryId);
                        showProductsPage($categoryId, Pages::PAGE_ADMIN_EDIT_PRODUCT_PRICE_CHOOSE_PRODUCT);
                        break;
                    }
            }
            break;
        case Pages::PAGE_ADMIN_EDIT_PRODUCT_PRICE_CHOOSE_PRODUCT:
            switch ($text) {
                case $texts->getText("back_btn"):
                    showCategoriesPage(Pages::PAGE_ADMIN_EDIT_PRODUCT_PRICE_CHOOSE_CATEGORY);
                    break;
                default:
                    if (in_array($text, $products->getNamesByCategoryId($user->getCategoryId()))) {
                        $productId = $products->getIdByName($text);
                        $user->setProductId($productId);
                        sendMessage("Tovar turini tanlang");
                        showProduct($products->getProduct($productId), false, "editProduct");
                    }
                    break;
            }
            break;
        case Pages::PAGE_ADMIN_EDIT_PRODUCT_PRICE_INPUT_PRICE:
            switch ($text) {
                case "❌ Bekor qilish":
                    showCategoriesPage(Pages::PAGE_ADMIN_EDIT_PRODUCT_PRICE_CHOOSE_CATEGORY);
                    break;
                default:
                    $product = $products->getProduct($user->getProductId());
                    $optionNum = $user->getProductOption();
                    $product['options'][$optionNum]['price'] = $text;
                    if (Products::updateProduct($product)) {
                        sendMessage("Tovar narxi o'zgartirildi.");
                        showAdminPage();
                    } else {
                        sendMessage("tovar narxi o'zgarmadi.");
                    }
                    break;
            }
            break;
    }
}

// user pages

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

function showCategoriesPage($page = Pages::PAGE_CATALOG)
{
    global $user, $texts, $categories;
    $buttons = $categories->getAllNames();
    if (!$buttons) {
        sendMessage($texts->getText('page_categories_text_no_category'));
    } else {
        $user->setPage($page);
        $textToSend = $texts->getText("page_categories_text");
        sendTextWithKeyboard($buttons, $textToSend, true);
    }
}

function showProductsPage($categoryId, $page = Pages::PAGE_PRODUCTS)
{
    global $user, $texts, $products;
    $buttons = $products->getNamesByCategoryId($categoryId);
    if (!$buttons) {
        sendMessage($texts->getText('page_products_text_no_product'));
    } else {
        $user->setPage($page);
        $textToSend = $texts->getText("page_products_text");
        sendTextWithKeyboard($buttons, $textToSend, true);
    }
}

function showChooseCount($productId, $optionNum)
{
    global $NUMBERS, $chatID, $texts, $telegram, $callback_query;
    $options = [];
    for ($cnt = 0, $i = 0; $i < 3; $i++) {
        for ($j = 0; $j < 3; $j++) {
            $cnt++;
            $options[$i][$j] = $telegram->buildInlineKeyboardButton($NUMBERS[$cnt], '', 'count' . $cnt . ',option' . $optionNum . ",productId" . $productId);
        }
    }
    $options[] = [$telegram->buildInlineKeyboardButton($texts->getText('back_btn'), "", 'back' . $productId)];
    $keyb = $telegram->buildInlineKeyBoard($options);
    $content = [
        'chat_id' => $chatID,
        'message_id' => $callback_query['message']['message_id'],
        'text' => $texts->getText('page_choose_count_text'),
        'reply_markup' => $keyb
    ];
    $telegram->editMessageText($content);
}

function showProduct($product, $edit = false, $editPrice = "")
{
    global $telegram, $chatID, $rootPath, $texts, $user, $callback_query;

    if ($product['photoUrl']) {
        $photoUrl = $rootPath . $product['photoUrl'];
    } else {
        $photoUrl = $rootPath . "photos/empty-img.png";
    }
    $caption = "";
    if ($product['name']) $caption .= $product['name'] . "\n\n";
    if ($product['info']) {
        $caption .= $product['info'] . "\n";
    } else {
        $caption .= "no info\n";
    }
    $content = ['chat_id' => $chatID, 'text' => "<a href=\"{$photoUrl}\"> </a>" . $caption, 'parse_mode' => "HTML"];
    if ($product['options']) {
        $option = [];
        for ($i = 0; $i < count($product['options']); $i++) {
            $name = $product['options'][$i]['name'];
            $price = number_format($product['options'][$i]['price'], 0, "", " ") . " " . $texts->getText('soum');
            $option[] = [$telegram->buildInlineKeyboardButton($name . " - " . $price, '', $editPrice . "option" . $i . ",productId" . $product['id'])];
        }
        $keyb = $telegram->buildInlineKeyBoard($option);
        $content['reply_markup'] = $keyb;
    }
    if ($edit) {
        $content['message_id'] = $callback_query['message']['message_id'];
        $telegram->editMessageText($content);
    } else {
        $telegram->sendMessage($content);
    }
}

function showCartPage()
{
    global $user, $telegram, $chatID, $TEXTS, $products;

    if (!ShoppingCart::getUserProducts($chatID)) {
        $content = [
            'chat_id' => $telegram->ChatID(),
            'text' => "Savat bo'sh holatda."
        ];
        $telegram->sendMessage($content);
    } else {
        $user->setPage(Pages::PAGE_SHOPPING_CART);
        $content = [
            'chat_id' => $telegram->ChatID(),
            'text' => "Sizning buyurtmangiz"
        ];
        $telegram->sendMessage($content);

        $orderText = "";
        $overallPrice = 0;

        foreach (ShoppingCart::getUserProducts($chatID) as $productArr) {
            $productCount = $productArr['count'];
            $optionNum = $productArr['optionNum'];
            $product = $products->getProduct($productArr['id']);
            $price = ((int)($product['options'][$optionNum]['price'])) * ((int)($productCount));
            $overallPrice += $price;
            $orderText .= $product['name'] . " " . $product['options'][$optionNum]['name'] . ", " . $productCount . " " . "dona" . " - " . number_format($price, 0, "", " ") . " " . "so'm" . "\n\n";
        }

        $orderText .= "--------------------\n";
        $orderText .= "Jami: " . number_format($overallPrice, 0, "", " ") . " " . "so'm";

        $buttons = ["💵 Buyurtmani hisoblash", "🛎 Buyurtma berish", "⚙️ O'zgartirish", "❌ Tozalash"];
        sendTextWithKeyboard($buttons, $orderText, true);
    }
}

function showClearProducts()
{
    global $telegram, $chatID;
    if (ShoppingCart::clearShoppingCart($chatID)) {
        $content = [
            'chat_id' => $telegram->ChatID(),
            'text' => "Savat tozalandi"
        ];
        $telegram->sendMessage($content);
    }
    showMainPage();
}

function showProductsToClear($edit = false)
{
    global $user, $telegram, $chatID, $TEXTS, $callback_query, $products;

    $option = [];
    foreach (ShoppingCart::getUserProducts($chatID) as $productArr) {
        $product = $products->getProduct($productArr['id']);
        $optionNum = $productArr['optionNum'];
        $option[] = [$telegram->buildInlineKeyboardButton($product['name'] . " " . $product['options'][$optionNum]['name'], "", "ggg"), $telegram->buildInlineKeyboardButton("❌", "", "id" . $product['id'] . "," . $productArr['optionNum'])];
    }
    $option[] = [$telegram->buildInlineKeyboardButton("Oynani yopish", "", "closeWindow")];
    $keyboard = $telegram->buildInlineKeyBoard($option);
    if ($edit) {
        $content = array('chat_id' => $chatID, 'message_id' => $callback_query['message']['message_id'], 'reply_markup' => $keyboard, 'text' => "Mahsulotni savatdan o'chirish uchun ❌ ni bosing.", 'parse_mode' => "HTML");
        $telegram->editMessageText($content);
    } else {
        $content = array('chat_id' => $chatID, 'reply_markup' => $keyboard, 'text' => "Mahsulotni savatdan o'chirish uchun ❌ ni bosing.", 'parse_mode' => "HTML");
        $telegram->sendMessage($content);
    }
}

function showCheckoutPage()
{
    global $user;
    $user->setPage(Pages::PAGE_DELIVERY_TYPE);
    $buttons = ["Olib ketish", "Yetkazib berish"];
    $mtext = "Yetkazib berish usulini tanlang.";
    sendTextWithKeyboard($buttons, $mtext, true);
}

function showFirstNamePage()
{
    global $user;
    $user->setPage(Pages::PAGE_FIRST_NAME);
    sendTextWithKeyboard([], "Iltimos, ismingizni kiriting:", true);
}

function showPhoneNumberPage()
{
    global $user, $telegram, $chatID, $texts;
    $user->setPage(Pages::PAGE_PHONE_NUMBER);
    $option = [
        [$telegram->buildKeyboardButton("Telefon raqam yuborish", true, false)],
        [$telegram->buildKeyboardButton($texts->getText('back_btn'))],
    ];
    $keyboard = $telegram->buildKeyBoard($option, $onetime = false, $resize = true);
    $content = array('chat_id' => $chatID, 'reply_markup' => $keyboard, 'text' => "Iltimos, telefon raqamingizni yuboring.", 'parse_mode' => "HTML");
    $telegram->sendMessage($content);
}

function showLocationPage()
{
    global $user, $telegram, $chatID, $texts;
    $user->setPage(Pages::PAGE_LOCATION);

    $option = [
        [$telegram->buildKeyboardButton("Lokatsiyani yuborish", false, true)],
        [$telegram->buildKeyboardButton("Lokatsiya jo'nata olmayamman")],
        [$telegram->buildKeyboardButton($texts->getText("back_btn"))],
    ];
    $keyboard = $telegram->buildKeyBoard($option, $onetime = false, $resize = true);
    $content = array('chat_id' => $chatID, 'reply_markup' => $keyboard, 'text' => "Iltimos, lokatsiyangizni yuboring. (GPS ni yoqishni unutmang).", 'parse_mode' => "HTML");
    $telegram->sendMessage($content);
}

function showConfirmOrderPage()
{
    global $user, $telegram, $chatID, $TEXTS, $products;
    $user->setPage(Pages::PAGE_ORDER_CONFIRMATION);
    $orderType = $user->getOrderType() == 'pickupType' ? "Olib ketish" : "Yetkazib berish";
    $orderText = "<b>" . strtoupper($orderType) . "</b>";
    $orderText .= "\n-------------\n\n";
    $orderText .= "<b>" . "BUYURTMA" . "</b>" . ":\n";

    $overallPrice = 0;

    foreach (ShoppingCart::getUserProducts($chatID) as $productArr) {
        $productCount = $productArr['count'];
        $optionNum = $productArr['optionNum'];
        $product = $products->getProduct($productArr['id']);
        $price = ((int)($product['options'][$optionNum]['price'])) * ((int)($productCount));
        $overallPrice += $price;
        $orderText .= $product['name'] . " " . $product['options'][$optionNum]['name'] . ", " . $productCount . " " . $TEXTS['pieces'] . " - " . number_format($price, 0, "", " ") . " " . $TEXTS['soum'] . "\n\n";
    }

    $orderText .= "--------------------\n";
    $orderText .= "Jami: " . number_format($overallPrice, 0, "", " ") . " " . "so'm";
    $orderText .= "\n\nIsm: " . $user->getFirstName();
    $orderText .= "\nTelefon raqam: " . $user->getPhoneNumber();
    $buttons = ["Buyurtma berish", "Bekor qilish"];
    sendTextWithKeyboard($buttons, $orderText, true);

    if ($user->getLongitude() != "" && $user->getLatitude() != "") {
        $latitude = str_replace(",", ".", $user->getLatitude());
        $longitude = str_replace(",", ".", $user->getLongitude());
        $content = array('chat_id' => $chatID, 'latitude' => $latitude, 'longitude' => $longitude);
        $telegram->sendLocation($content);
    }

    $user->setOrderText($orderText);
}

function showOrderConfirmed()
{
    global $user, $telegram, $chatID, $TEXTS, $ADMINS_CHAT_IDS;
    $mtext = "Rahmat. Sizning buyurtmangiz qabul qilindi. Tez orada sizga operatorimiz buyurtmani tasdiqlash uchun qo'ng'iroq qiladi.";
    $content = array('chat_id' => $chatID, 'text' => $mtext, 'parse_mode' => "HTML");
    $telegram->sendMessage($content);
    showMainPage();

    foreach ($ADMINS_CHAT_IDS as $admin_chat_id) {
        $content = array('chat_id' => $admin_chat_id, 'text' => "Yangi buyurtma keldi!", 'parse_mode' => "HTML");
        $telegram->sendMessage($content);
        $content = array('chat_id' => $admin_chat_id, 'text' => $user->getOrderText(), 'parse_mode' => "HTML");
        $telegram->sendMessage($content);
        if ($user->getLongitude() != "" && $user->getLatitude() != "") {
            $latitude = str_replace(",", ".", $user->getLatitude());
            $longitude = str_replace(",", ".", $user->getLongitude());
            $content = array('chat_id' => $admin_chat_id, 'latitude' => $latitude, 'longitude' => $longitude);
            $telegram->sendLocation($content);
        }
    }
}

function showOrderCanceled()
{
    global $telegram, $chatID;

    $content = array('chat_id' => $chatID, 'text' => "Buyurtma bekor qilindi.", 'parse_mode' => "HTML");
    $telegram->sendMessage($content);
    showMainPage();
}

// admin pages

// -- add product

function showAdminPage()
{
    global $user;
    $user->setPage(Pages::PAGE_ADMIN);
    $buttons = ["➕ Tovar qo'shish", "➕ Kategoriya qo'shish", "➖ Tovar o'chirish", "➖ Kategoriya o'chirish",
        "Tovar narxini o'zgartirish"];
    $textToSend = "Admin Panelga xush kelibsiz!";
    sendTextWithKeyboard($buttons, $textToSend, true);
}

function showAdminSendProductPhoto()
{
    global $user;
    $user->setPage(Pages::PAGE_ADMIN_PRODUCT_PHOTO);
    sendTextWithKeyboard([], "Iltimos, tovar rasmini yuboring.", true);
}

function showAdminSendProductName()
{
    global $user;
    $user->setPage(Pages::PAGE_ADMIN_PRODUCT_NAME);
    sendTextWithKeyboard([], "Iltimos, tovar nomini yuboring.", true);
}

function showAdminSendProductInfo()
{
    global $user;
    $user->setPage(Pages::PAGE_ADMIN_PRODUCT_INFO);
    sendTextWithKeyboard([], "Iltimos, tovar haqidagi ma'lumotni yuboring.", true);
}

function showAdminSendProductOptionsName()
{
    global $user;
    $user->setPage(Pages::PAGE_ADMIN_PRODUCT_OPTIONS_NAME);
    sendTextWithKeyboard([], "Iltimos, tovar turlarini yuboring.", true);
    sendMessage("Tovar turining nomini yuboring.");
}

function showAdminSendProductOptionsPrice()
{
    global $user;
    $user->setPage(Pages::PAGE_ADMIN_PRODUCT_OPTIONS_PRICE);
    sendMessage("Tovar turining narxini yuboring.");
}

function showAdminSendProductOptionsConfirmOrAddMore()
{
    global $user, $texts;
    $user->setPage(Pages::PAGE_ADMIN_PRODUCT_OPTIONS_CONFIRM_OR_ADD_MORE);
    sendTextWithKeyboard([$texts->getText("btn_add_more"), $texts->getText('btn_done')], "Tur qo'shildi. {$texts->getText("btn_add_more")} yoki {$texts->getText('btn_done')} tugmasini bosing.", true);
}

// -- add category

function showAdminAddCategory()
{
    global $user;
    $user->setPage(Pages::PAGE_ADMIN_ADD_CATEGORY);
    sendTextWithKeyboard([], "Kategoriya nomini kiriting.", true);
}

// helper functions

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

function isContains($string, $needle)
{
    return strpos($string, $needle) !== false;
}