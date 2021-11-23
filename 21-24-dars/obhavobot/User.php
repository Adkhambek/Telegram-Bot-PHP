<?php


class User
{
    private $chat_id;

    public function __construct($chat_id)
    {
        $this->chat_id = $chat_id;
    }

    function setCity($data) {
        file_put_contents('users/'.$this->chat_id.'city.txt', $data);
    }

    function getCity()
    {
        return file_get_contents('users/' . $this->chat_id . 'city.txt');
    }


}