<?php


namespace model\language;


class AppLanguage {
    private static $arr;

    private static function setArr() {
        self::$arr = array(CsLanguage::instance(), EnLanguage::instance());
    }

    public static function isLanguage(string $langcode):?LanguageI {
        if (!self::$arr) self::setArr();

        foreach (self::$arr as $lang) {
            if ($lang->getCode() == $langcode)
                return $lang;
        }
        return null;
    }

    public static function getInitLanguage(string $http_accept_language, string $default = ""):?LanguageI {
        $langcode = substr($http_accept_language, 0, 2);

        if ($langcode) $lang = self::isLanguage($langcode);

        if ($lang == null) return self::isLanguage($default);

        return $lang;
    }

}