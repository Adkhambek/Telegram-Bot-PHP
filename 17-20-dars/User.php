<?php


class User
{
    private $chat_id;

    function __construct($chat_id)
    {
        $this->chat_id = $chat_id;
    }

    function setPage($data)
    {
        file_put_contents('users/' . $this->chat_id . 'page.txt', $data);
    }

    function getPage() {
        return file_get_contents('users/' . $this->chat_id . 'page.txt');
    }

    function setLanguage($data) {
        file_put_contents('users/' . $this->chat_id . 'language.txt', $data);
    }

    function getLanguage() {
        return file_get_contents('users/' . $this->chat_id . 'language.txt');
    }

    function setDistrict($data) {
        file_put_contents('users/' . $this->chat_id . 'district.txt', $data);
    }

    function getDistrict() {
        return file_get_contents('users/' . $this->chat_id . 'district.txt');
    }

    function setSubject($data) {
        file_put_contents('users/' . $this->chat_id . 'subject.txt', $data);
    }

    function getSubject() {
        return file_get_contents('users/' . $this->chat_id . 'subject.txt');
    }
}