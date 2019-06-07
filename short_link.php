<?php
//скрипт для переадресации на нужный ресурс
require __DIR__.'/config.php';
require __DIR__.'/Handler.php';

$hash = $_GET['hash'];
try {
    $handler = new Handler();
    $link = $handler->getLinkByHash($hash);
    if($link){
        header('Location: '.$link);
    } else {
        echo ERROR_MSG_REDIRECT;
    }
} catch (Exception $e) {
    echo ERROR_MSG_REDIRECT;
}
