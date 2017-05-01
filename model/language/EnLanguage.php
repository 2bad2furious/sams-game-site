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
        $this->code = "en";
        $this->userNotLogged = "User not logged in";
        $this->pageDoesNotExist = "Page does not exist";
        $this->password = "heslo";
        $this->passwordFormText = "Insert your password";
        $this->passwordSecondFormText = "Insert your password again";
        $this->usernameFormText = "Insert your username";
        $this->emailFormText = "Insert your email";
        $this->passwordsDontMatch = "Passwords don't match";
        $this->userAlreadyLoggedIn = "You are already logged in";
        $this->emailExists = "This email is already registered";
        $this->emailRegex = "Email must contain @";
        $this->passwordAllowedRegex = "Password can only contain uppercase letters, lowercase letters, numbers and \$ _- & @ ß /";
        $this->passwordMustRegex = "Password must contain two uppercase letters, two lowercase letters and two numbers";
        $this->usernameRegex = "Username can only contain letters, numbers and  _";
        $this->usernameExists = "This username is already registered";
        $this->loginSuccess = "User successfully logged in";
        $this->registerSuccess = "User successfully registered";
        $this->adminFailure = "An error occured. You can contact us or try again later";
    }
}