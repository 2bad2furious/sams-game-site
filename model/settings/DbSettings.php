<?php


namespace model\settings;


use PDO;

class DbSettings {
    const DATABASE = "sams-game";
    const USERNAME = "remote-user";
    const PASSWORD = "7iPiQdukdfS1jdMK";
    const HOST = "192.168.1.54:3306";
    //const DATABASE = "vampp";
    //const USERNAME = "root";
    //const PASSWORD = "";
    //const HOST = "localhost";
    const OPTIONS = array(
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',
        PDO::ATTR_EMULATE_PREPARES => false);
}