<?php

require_once 'db_connect.php';

class Texts
{
    private $lang;

    public function __construct($lang)
    {
        $this->lang = $lang;
    }

    function getText($keyword) {
        global $db;
        $text = "";
        $result = $db->query("SELECT * FROM `texts` WHERE `keyword` = '{$keyword}' LIMIT 1");
        $arr = $result->fetch_assoc();
        if (isset($arr[$this->lang])) {
            $text = $arr[$this->lang];
        }
        return $text;
    }

    function getNames() {
        global $db;

        $mArray = [];

        $result = $db->query("SELECT * FROM `texts`");

        while ($arr = $result->fetch_assoc()) {
            if (isset($arr[$this->lang])) {
                $mArray[] = $arr[$this->lang];
            }
        }

        return $mArray;
    }
}