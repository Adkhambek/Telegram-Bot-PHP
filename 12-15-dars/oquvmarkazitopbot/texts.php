<?php

require_once 'db_connect.php';
require_once 'user.php';

function getmText($keyword, $chat_id) {
    global $db;

    $lang = getLanguage($chat_id);
    echo $lang;

    $text = "";

    $result = $db->query("SELECT * FROM `texts` WHERE `keyword` = '{$keyword}' LIMIT 1");

    $arr = $result->fetch_assoc();

    if (isset($arr[$lang])) {
        $text = $arr[$lang];
    }

    return $text;
}
