<?php

use model\File;
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
} catch (Exception $ex) {
    throw $ex;
}
