<?php

class Categories
{
    /**
     * @var string
     */
    private $lang;

    /**
     * Districts constructor.
     * @param string $lang
     */
    public function __construct($lang)
    {
        $this->lang = $lang;
    }

    function getNameByID($id)
    {
        global $db;
        $name = "";
        $result = $db->query("SELECT * FROM `categories` WHERE `id`='{$id}'");
        $arr = $result->fetch_assoc();
        if (isset($arr[$this->lang])) {
            $name = $arr[$this->lang];
        }
        return $name;
    }

    function getAllNames()
    {
        global $db;
        $names = [];
        $result = $db->query("SELECT * FROM `categories`");
        while ($arr = $result->fetch_assoc()) {
            if (isset($arr[$this->lang])) {
                $names[] = $arr[$this->lang];
            }
        }
        return $names;
    }

    function getIdByName($name)
    {
        global $db;
        $id = "";
        $result = "";
        $name = $db->real_escape_string($name);
        $result = $db->query("SELECT * FROM `categories` WHERE $this->lang='$name' LIMIT 1");
        $arr = $result->fetch_assoc();
        if (isset($arr["id"])) {
            $id = $arr["id"];
        }
        return $id;
    }

    static function addNewCategory($name)
    {
        global $db;
        $name = $db->real_escape_string($name);
        $query = "INSERT INTO `categories` (`uz`) VALUES ('{$name}')";
        return $db->query($query);
    }

    static function deleteCategory($categoryId)
    {
        global $db;
        $categoryId = $db->real_escape_string($categoryId);
        $query = "DELETE FROM `categories` WHERE `categories`.`id` = {$categoryId}";
        return $db->query($query);
    }
}