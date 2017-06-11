<?php


namespace model\settings;


use PDO;

class DbSettings {
    const DATABASE = "sams-game";
    const USERNAME = "root";
    const PASSWORD = "";
    const HOST = "localhost";
    //const DATABASE = "vampp";
    //const USERNAME = "root";
    //const PASSWORD = "";
    //const HOST = "localhost";
    const OPTIONS = array(
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',
        PDO::ATTR_EMULATE_PREPARES => false);
}