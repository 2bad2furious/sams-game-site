<?php

namespace model\language;


final class CsLanguage extends LanguageA {
    private static $instance;

    public function __construct() {
        $this->register = "Registrovat";
        $this->login = "Přihlásit se";
        $this->username = "Uživatelské jméno";
        $this->logout = "Odhlásit se";
        $this->langcode = "cs";
        $this->userNotLogged = "Uživatel nepřihlášen";
        $this->pageDoesNotExist = "Tato stránka neexistuje";
        $this->password = "password";
        $this->passwordFormText = "Vložte Vaše heslo";
        $this->passwordSecondFormText = "Vložte Vaše heslo znovu";
        $this->usernameFormText = "Vložte Vaše uživatelské jméno";
        $this->emailFormText = "Vložte Váš email";
    }


    public static function instance(): LanguageI {
        if (!self::$instance) {
            self::$instance = new CsLanguage();
        }
        return self::$instance;
    }
}