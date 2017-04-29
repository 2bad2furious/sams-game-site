<?php


namespace model\language;


class EnLanguage extends LanguageA {
    private static $instance;

    public static function instance(): LanguageI {
        if (!self::$instance) {
            self::$instance = new EnLanguage();
        }
        return self::$instance;
    }

    /**
     * TODO set everything
     * LanguageA constructor.
     */
    protected function __construct() {
        $this->register = "Register";
        $this->login = "Log In";
        $this->username = "Username";
        $this->logout = "Log Out";
        $this->langcode = "en";
        $this->userNotLogged = "User not logged in";
        $this->pageDoesNotExist = "Page does not exist";
        $this->password = "heslo";
        $this->passwordFormText = "Insert your password";
        $this->passwordSecondFormText = "Insert your password again";
        $this->usernameFormText = "Insert your username";
        $this->emailFormText = "Insert your email";
    }
}