<?php
function setPage($chat_id, $data){
    file_put_contents('users/'.chat_id.'page.txt', $data);
}