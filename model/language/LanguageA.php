<?php


namespace model\language;


abstract class LanguageA implements LanguageI {

    protected $code = "";
    protected $register = "";
    protected $login = "";
    protected $logout = "";
    protected $userNotLogged = "";
    protected $username = "";
    protected $pageDoesNotExist = "";
    protected $password = "";
    protected $passwordFormText = "";
    protected $passwordSecondFormText = "";
    protected $usernameFormText = "";
    protected $emailFormText = "";
    protected $passwordsDontMatch = "";
    protected $userAlreadyLoggedIn = "";
    protected $emailExists = "";
    protected $emailRegex = "";
    protected $passwordAllowedRegex = "";
    protected $passwordMustRegex = "";
    protected $usernameRegex = "";
    protected $usernameExists = "";
    protected $registerSuccess = "";
    protected $loginSuccess = "";
    protected $adminFailure = "";
    protected $loginFailure = "";

//Getters
    public function getCode(): string {
        return $this->code;
    }

    public function getRegister(): string {
        return $this->register;
    }

    public function getLogin(): string {
        return $this->login;
    }

    public function getUserNotLogged(): string {
        return $this->userNotLogged;
    }

    public function getLogout(): string {
        return $this->logout;
    }

    public function getUsername(): string {
        return $this->username;
    }

    public function getPageDoesNotExist(): string {
        return $this->pageDoesNotExist;
    }

    public function getPassword(): string {
        return $this->password;
    }

    /**
     * @return string
     */
    public function getPasswordFormText(): string {
        return $this->passwordFormText;
    }

    /**
     * @return string
     */
    public function getPasswordSecondFormText(): string {
        return $this->passwordSecondFormText;
    }

    /**
     * @return string
     */
    public function getUsernameFormText(): string {
        return $this->usernameFormText;
    }

    /**
     * @return string
     */
    public function getEmailFormText(): string {
        return $this->emailFormText;
    }

    /**
     * @return string
     */
    public function getPasswordsDontMatch(): string {
        return $this->passwordsDontMatch;
    }

    /**
     * @return string
     */
    public function getUserAlreadyLoggedIn(): string {
        return $this->userAlreadyLoggedIn;
    }

    /**
     * @return string
     */
    public function getEmailExists(): string {
        return $this->emailExists;
    }

    /**
     * @return string
     */
    public function getEmailRegex(): string {
        return $this->emailRegex;
    }

    /**
     * @return string
     */
    public function getPasswordAllowedRegex(): string {
        return $this->passwordAllowedRegex;
    }

    /**
     * @return string
     */
    public function getPasswordMustRegex(): string {
        return $this->passwordMustRegex;
    }

    /**
     * @return string
     */
    public function getUsernameRegex(): string {
        return $this->usernameRegex;
    }

    /**
     * @return string
     */
    public function getUsernameExists(): string {
        return $this->usernameExists;
    }

    /**
     * @return string
     */
    public function getLoginSuccess(): string {
        return $this->loginSuccess;
    }

    /**
     * @return string
     */
    public function getAdminFailure(): string {
        return $this->adminFailure;
    }

    /**
     * @return string
     */
    public function getRegisterSuccess(): string {
        return $this->registerSuccess;
    }

    /**
     * @return string
     */
    public function getLoginFailure(): string {
        return $this->loginFailure;
    }

    /**
     * TODO set everything
     * LanguageA constructor.
     */
    abstract protected function __construct();
}