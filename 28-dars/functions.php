<?php

require_once 'db_connect.php';

function getRegions() {
    global $db;
    $query = "SELECT * FROM `regions`";
    $result = $db->query($query);
    return mysqli_fetch_all($result, MYSQLI_ASSOC);
}

function getDistricts($regionId) {
    global $db;
    $query = "SELECT id, name FROM `districts` WHERE `districts`.`regionId` = {$regionId}";
    $result = $db->query($query);
    return mysqli_fetch_all($result, MYSQLI_ASSOC);
}