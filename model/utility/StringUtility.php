<?php

namespace model\utility;

final class StringUtility {
    private static $instance;

    private function __construct() {
    }

    public static function instance(): StringUtility {
        if (!self::$instance) {
            self::$instance = new StringUtility();
        }
        return self::$instance;
    }

    public function backSlashesToNormal(string $str): string {
        return $this->slashModify($str, "\\", "/");
    }

    public function normalSlashesToBack(string $str): string {
        return $this->slashModify($str, "/", "\\");
    }

    private function slashModify(string $str, string $from, string $to): string {
        return str_replace($from, $to, $str);
    }
}