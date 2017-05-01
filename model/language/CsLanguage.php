<?php

namespace model\language;


final class CsLanguage extends LanguageA {
    private static $instance;

    public function __construct() {
        $this->register = "Registrovat";
        $this->login = "Přihlásit se";
        $this->username = "Uživatelské jméno";
        $this->logout = "Odhlásit se";
        $this->code = "cs";
        $this->userNotLogged = "Uživatel nepřihlášen";
        $this->pageDoesNotExist = "Tato stránka neexistuje";
        $this->password = "password";
        $this->passwordFormText = "Vložte Vaše heslo";
        $this->passwordSecondFormText = "Vložte Vaše heslo znovu";
        $this->usernameFormText = "Vložte Vaše uživatelské jméno";
        $this->emailFormText = "Vložte Váš email";
        $this->passwordsDontMatch = "Hesla se neshodují";
        $this->userAlreadyLoggedIn = "Jste již přihlášen";
        $this->emailExists = "Účet s tímto emailem již existuje";
        $this->emailRegex = "Email musí obsahovat @";
        $this->passwordAllowedRegex = "Heslo smí obsahovat pouze malá, velká písmena, číslice a znaky \$ _- & @ ß /";
        $this->passwordMustRegex = "Heslo musí obsahovat minimálně dvě velká písmena, dvě malá písmena a dvě číslice";
        $this->usernameRegex = "Uživatelské jméno smí obsahovat pouze písmena, číslice a _";
        $this->usernameExists = "Uživatel s tímto jménem již existuje";
        $this->loginSuccess = "Uživatel úspěšně přihlášen";
        $this->registerSuccess = "Uživatel úspěšně zaregistrován";
        $this->adminFailure = "Někde nastala chyba. Můžete nás kontaktovat, případně to zkusit později";
        $this->loginFailure = "Špatné uživatelské jméno nebo heslo";
    }


    public static function instance(): LanguageI {
        if (!self::$instance) {
            self::$instance = new CsLanguage();
        }
        return self::$instance;
    }
}