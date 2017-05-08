<?php

use model\File;
use model\Router;
use model\user\User;
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
    $router = new Router($_SERVER,$_SESSION, $_POST, $_GET, $_FILES, $_COOKIE);

    echo $router->getView()->output();
} catch (Throwable $ex) {
    //throw $ex->getPrevious();
    var_dump($ex->getPrevious() instanceof PDOException);
    if ($ex->getPrevious() instanceof PDOException)
        throw $ex->getPrevious();
    throw $ex;
}