<?php

require_once 'database/db_connect.php';

class ShoppingCart
{
    static function addNewOrder($chat_id, $productId, $count, $optionNum) {
        global $db;
        $chat_id = $db->real_escape_string($chat_id);
        $productId = $db->real_escape_string($productId);
        $count = $db->real_escape_string($count);
        $optionNum = $db->real_escape_string($optionNum);

        $result = $db->query("SELECT * FROM `products` WHERE id='$productId' LIMIT 1");
        if (mysqli_num_rows($result) != 0) {
            $resultShoppingCart = $db->query("SELECT * FROM `shoppingcart` WHERE (`userId`='{$chat_id}' AND `productId`='$productId') AND `optionNum`={$optionNum} LIMIT 1");
            if (mysqli_num_rows($resultShoppingCart) == 0) {
                return $resultInsert = $db->query("INSERT INTO `shoppingcart` (`userId`, `productId`, `quantity`, `optionNum`) VALUES ('{$chat_id}', '{$productId}', '{$count}', '{$optionNum}')");
            } else {
                $arr = $resultShoppingCart->fetch_assoc();
                $id = $arr['id'];
                $oldQuantity = $arr['quantity'];
                $newQuantity = (int) $oldQuantity + (int) $count;
                return $resultUpdate = $db->query("UPDATE `shoppingcart` SET `quantity` = '$newQuantity' WHERE `shoppingcart`.`id` = '$id'");
            }
        }
        return false;
    }

    static function getUserProducts($chatID) {
        global $db;
        $userID = $db->real_escape_string($chatID);
        $res = [];
        $query = "SELECT * FROM `shoppingcart` WHERE `userId` = '{$userID}'";
        $result = $db->query($query);
        if (mysqli_num_rows($result) == 0 ) return false;
        while ($arr = $result->fetch_assoc()) {
            if (isset($arr['id'])) {
                $tempArr = [];
                $tempArr['id'] = $arr['productId'];
                $tempArr['count'] = (int) $arr['quantity'];
                $tempArr['optionNum'] = (int) $arr['optionNum'];
                $res[] = $tempArr;
            }
        }
        return $res;
    }

    static function clearShoppingCart($chatID) {
        global $db;
        return $result = $db->query("DELETE FROM `shoppingcart` WHERE `userId` = '{$chatID}'");
    }

    static function deleteProduct($userId, $productId, $optionNum) {
        global $db;
        $userId = $db->real_escape_string($userId);
        $productId = $db->real_escape_string($productId);

        $result = $db->query("DELETE FROM `shoppingcart` WHERE `userId` = '{$userId}' AND `productId` = '{$productId}' AND `optionNum` ='$optionNum'");
    }

}