<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once 'ShoppingCart.php';

if (ShoppingCart::addNewOrder(2341, 67, 10, 1)) {
    echo 'tovar qoshildi';
} else {
    echo 'tovar qoshilmadi';
}

echo '<pre>';
var_dump(ShoppingCart::getUserProducts(2341));
echo '</pre>';
