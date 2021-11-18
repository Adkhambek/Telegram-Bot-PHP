<?php
require_once 'db_connect.php';

class TrainingCenters
{
    static function getNames($district, $subject) {
        global $db;

        $mArray = [];

        $result = $db->query("SELECT * FROM `trainingcentres`");

        while ($arr = $result->fetch_assoc()) {
            if ($district == $arr['district']) {
                $subjects = explode(", ", $arr['subjects']);
                if (in_array($subject, $subjects)) {
                    $mArray[] = $arr['name'];
                }
            }
        }

        return $mArray;
    }
}