<?php
require_once 'db_connect.php';
require_once 'user.php';

function getSubjects($chat_id) {
    global $db;

    $lang = getLanguage($chat_id);

    $districtsArray = [];

    $result = $db->query("SELECT * FROM `subjects`");

    while ($arr = $result->fetch_assoc()) {
        if (isset($arr[$lang])) {
            $districtsArray[] = $arr[$lang];
        }
    }

    return $districtsArray;
}