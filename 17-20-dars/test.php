<?php

require_once 'TrainingCenters.php';
require_once 'User.php';

$chat_id = 635793263;
$user = new User($chat_id);

$test = base64_encode("good");

echo '<pre>';
var_dump(base64_decode($test));
echo '</pre>';