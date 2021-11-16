<?php
include "districts.php";
include 'texts.php';

$chat_id = 635793263;

echo '<pre>';
var_dump(getDistricts($chat_id));
echo '</pre>';
