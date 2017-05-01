<?php

use model\File;
use model\utility\Db;
use presenter\Presenter;

require "startup.php";

$requesturi = $_SERVER["REQUEST_URI"];

try {
    if (strpos($requesturi, ".")) {
        $file = new File($requesturi);
        $file->read();
        exit();
    }
    echo Presenter::route($_POST, $_GET, $_FILES, $_SERVER, $_SESSION)->output();
} catch (Throwable $ex) {
    //throw $ex->getPrevious();
    var_dump($ex->getPrevious() instanceof PDOException);
    if($ex->getPrevious() instanceof PDOException)
        throw $ex->getPrevious();
    throw $ex;
}