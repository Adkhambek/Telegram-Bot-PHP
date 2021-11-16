<?php


/*подключение к базе данных*/

$host = "localhost"; // в 90% случаев это менять не надо

$password = "rqSRU8%%";

$username = "bunnypeace_oquvm";

$databasename = "bunnypeace_oquvm";


global $db;

setlocale(LC_ALL,"ru_RU.UTF8");


$db = new mysqli($host, $username, $password, $databasename, 3306);

if ($db->connect_errno) {

    echo "Не удалось подключиться к MySQL: (" . $db->connect_errno . ") " . $db->connect_error;

    exit;

}