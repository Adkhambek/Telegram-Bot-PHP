<?php

$host = "localhost"; // в 90% случаев это менять не надо
$username = "root";
$password = "root";
$databasename = "boss_788";

global $db;
setlocale(LC_ALL,"ru_RU.UTF8");
$db = new mysqli($host, $username, $password, $databasename, 3306);
$db->set_charset('utf8mb4');

if ($db->connect_errno) {
    echo "Cannot connect to databse: (" . $db->connect_errno . ") " . $db->connect_error;
    exit;
}