<?php

use model\settings\AppSettings;
use model\utility\SessionSetter;


spl_autoload_register(function ($class) {
    $path = $_SERVER["DOCUMENT_ROOT"] . "/" . str_replace("\\", "/", $class) . ".php";
    if (file_exists($path)) {
        require $path;
    }
});

$tokenIndex = AppSettings::DEFAULT_TOKEN_INDEX;

$ss = new SessionSetter(@$_SERVER[$tokenIndex]);
$id = $ss->getId();

if ($id) session_id($id);

session_start();

