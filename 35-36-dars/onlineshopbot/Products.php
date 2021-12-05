<?php

class Products
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

    /**
     * @param string $keyword
     * @return string
     */
    function getNameByKeyword($keyword)
    {
        global $db;
        $district = "";
        $result = $db->query("SELECT * FROM `products` WHERE keyword='$keyword'");
        $arr = $result->fetch_assoc();
        if (isset($arr[$this->lang])) {
            $district = $arr[$this->lang];
        }
        return $district;
    }

    function getKeywordByName($name)
    {
        global $db;
        $keyword = "";
        $result = "";
        $name = $db->real_escape_string($name);
        if ($this->lang == 'uz') {
            $result = $db->query("SELECT * FROM `products` WHERE uz='$name' LIMIT 1");
        } elseif ($this->lang == 'ru') {
            $result = $db->query("SELECT * FROM `products` WHERE ru='$name' LIMIT 1");
        }
        $arr = $result->fetch_assoc();
        if (isset($arr["keyword"])) {
            $keyword = $arr["keyword"];
        }

        return $keyword;
    }

    function getNamesByCategoryId($categoryId)
    {
        global $db;
        $categoryId = $db->real_escape_string($categoryId);
        $products = [];
        $result = $db->query("SELECT * FROM `products` WHERE `categoryId` = '{$categoryId}'");
        while ($arr = $result->fetch_assoc()) {
            if (isset($arr[$this->lang])) {
                $products[] = $arr[$this->lang];
            }
        }
        return $products;
    }

    function getIdByName($name)
    {
        global $db;
        $id = "";
        $result = "";
        $name = $db->real_escape_string($name);
        if ($this->lang == 'uz') {
            $result = $db->query("SELECT * FROM `products` WHERE uz='$name' LIMIT 1");
        } elseif ($this->lang == 'ru') {
            $result = $db->query("SELECT * FROM `products` WHERE ru='$name' LIMIT 1");
        }
        $arr = $result->fetch_assoc();
        if (isset($arr["id"])) {
            $id = $arr["id"];
        }
        return $id;
    }

    function getProduct($productId)
    {
        global $db;
        $result = $db->query("SELECT * FROM `products` WHERE `id`='{$productId}' LIMIT 1");
        $arr = $result->fetch_assoc();
        $arr['name'] = $arr[$this->lang];
        $arr['options'] = json_decode($arr['options'], true);
        return $arr;
    }

    static function addNewProduct($product)
    {
        global $db;
        $categoryId = (int)($product['categoryId']);
        $photoUrl = $product['photoUrl'];
        $productName = $db->real_escape_string($product['name']);
        $productInfo = $db->real_escape_string($product['info']);
        $productOptions = $db->real_escape_string(json_encode($product['options'], JSON_UNESCAPED_UNICODE));
        $query = "INSERT INTO `products` (`categoryId`, `photoUrl`, `uz`, `info`, `options`) 
                    VALUES ('{$categoryId}', '{$photoUrl}', '{$productName}', '{$productInfo}', '{$productOptions}')";
        return $db->query($query);
    }

    static function deleteProduct($productId) {
        global $db;
        $productId = $db->real_escape_string($productId);
        $query = "DELETE FROM `products` WHERE `products`.`id` = {$productId}";
        return $db->query($query);
    }

    static function updateProduct($product) {
        global $db;
        $categoryId = (int)($product['categoryId']);
        $photoUrl = $product['photoUrl'];
        $productName = $db->real_escape_string($product['name']);
        $productInfo = $db->real_escape_string($product['info']);
        $productOptions = $db->real_escape_string(json_encode($product['options'], JSON_UNESCAPED_UNICODE));
        $query = "UPDATE `products` SET `uz` = '{$productName}', `categoryId` = '{$categoryId}', `options` = '{$productOptions}', `info` = '{$productInfo}', `photoUrl` = '{$photoUrl}' WHERE `products`.`id` = {$product['id']}";
        return $db->query($query);

    }

}