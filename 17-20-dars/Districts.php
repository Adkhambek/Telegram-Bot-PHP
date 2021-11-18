<?php

require_once 'db_connect.php';

class Districts
{
    private $lang;

    public function __construct($lang)
    {
        $this->lang = $lang;
    }

    function getNames() {
        global $db;

        $mArray = [];

        $result = $db->query("SELECT * FROM `districts`");

        while ($arr = $result->fetch_assoc()) {
            if (isset($arr[$this->lang])) {
                $mArray[] = $arr[$this->lang];
            }
        }

        return $mArray;
    }

    function getKeyword($name)
    {
        global $db;
        $keyword = "";
        $result = $db->query("SELECT * FROM `districts` WHERE `{$this->lang}` = '{$name}' LIMIT 1");

        $arr = $result->fetch_assoc();
        if (isset($arr[$this->lang])) {
            $keyword = $arr['keyword'];
        }

        return $keyword;
    }
}