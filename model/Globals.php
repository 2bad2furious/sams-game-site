<?php


namespace model;


class Globals {
    public static function getSession(): array {
        return $_SESSION;
    }

    public static function getPost(): array {
        return $_POST;
    }

    public static function getGet(): array {
        return $_GET;
    }

    public static function getServer(): array {
        return $_SERVER;
    }

    public static function getFiles(): array {
        return $_FILES;
    }
}