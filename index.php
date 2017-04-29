<?php

use model\File;
use presenter\Presenter;

require "startup.php";

try {
    $file = new File($_SERVER["REQUEST_URI"]);
    if ($file->read()) exit();

    echo Presenter::route($_POST, $_GET, $_FILES, $_SERVER, $_SESSION)->output();
} catch (Exception $ex) {
    throw $ex;
}
