<?php


namespace model;


class Page {
    private static $pages = array();

    /**
     * @return array
     */
    public static function getPages(): array {
        if(!self::$pages)
            self::$pages = array(
                "home"=>new Page(""),
                "register"=>new Page("register"),
                "logout"=>new Page("logout"),
                "login"=>new Page("login"),
                "profile"=>new Page("profile")
            );
        return self::$pages;
    }


    private $url;

    public function __construct(string $url) {
        $this->url = $url;
    }

    public function getUrl($prefix = ""):string{
        if($prefix) return $prefix."/".$this->url;
        return $this->url;
    }
}