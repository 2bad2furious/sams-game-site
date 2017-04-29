<?php


namespace model\settings;


class App {
    const WEB = "html";
    const API = "api";

    const AppArray = array(self::WEB,self::API);

    public static function isAnAppType(string $type){
        return in_array($type,self::AppArray);
    }
}