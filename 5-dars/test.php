<?php

require_once 'db_connect.php';

global $db;

$result = $db->query("SELECT * FROM `users`");

while ($arr = $result->fetch_assoc()) {
    var_dump($arr);
    if ($arr['ru'] != NULL)
        if (isset($arr['data_json'])) {
//            print $arr['data_json'];
            print "<br/>";
        }
}

