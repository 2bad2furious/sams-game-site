<?php


namespace model\language;


abstract class LanguageA implements LanguageI {

    protected $langcode = "";
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

//Getters
    public function getCode(): string {
        return $this->langcode;
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
     * TODO set everything
     * LanguageA constructor.
     */
    abstract protected function __construct();
}