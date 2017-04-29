<?php


namespace model\utility;


class UrlUtility {
    private static $instance;

    public static function instance() {
        if (!self::$instance) {
            self::$instance = new UrlUtility();
        }
        return self::$instance;
    }

    private function __construct() {}

    public function redirect($url) {
        header("location:" . $url);
        exit();
    }
}