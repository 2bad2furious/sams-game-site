<?php


namespace model\settings;


class DbSettings {
    const DATABASE = "";
    const USERNAME = "";
    const PASSWORD = "";
    const HOST = "";
    const CHARSET = "";
    const OPTIONS = array(
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',
        PDO::ATTR_EMULATE_PREPARES => false);
}