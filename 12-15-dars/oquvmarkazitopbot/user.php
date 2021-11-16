<?php

function setPage($chat_id, $data)
{
    file_put_contents('users/' . $chat_id . 'page.txt', $data);
}

function getPage($chat_id) {
    return file_get_contents('users/' . $chat_id . 'page.txt');
}

function setLanguage($chat_id, $data) {
    file_put_contents('users/' . $chat_id . 'language.txt', $data);
}

function getLanguage($chat_id) {
    return file_get_contents('users/' . $chat_id . 'language.txt');
}

function setDistrict($chat_id, $data) {
    file_put_contents('users/' . $chat_id . 'district.txt', $data);
}

function getDistrict($chat_id) {
    return file_get_contents('users/' . $chat_id . 'district.txt');
}

function setSubject($chat_id, $data) {
    setKeyValue('subject', $data, $chat_id);
}

function getSubject($chat_id) {
   getKeyValue('subject', $chat_id);
}

function setLongitude($chat_id, $data) {
    file_put_contents('users/' . $chat_id . 'longitude.txt', $data);
}

function getLongitude($chat_id) {
    return file_get_contents('users/' . $chat_id . 'longitude.txt');
}

function setKeyValue($key, $value, $chat_id) {
    file_put_contents('users/' . $chat_id . $key.'.txt', $value);
}

function getKeyValue($key, $chat_id) {
    return file_get_contents('users/' . $chat_id . $key.'.txt');
}

