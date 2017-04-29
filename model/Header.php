<?php


namespace model;


use model\language\LanguageI;
use model\logged\LoggedData;
use model\user\User;

final class Header {
    private $logged;
    private $usernameText;
    private $username;
    private $login;
    private $logout;
    private $register;
    private $logoutPage;
    private $registerPage;
    private $profilePage;
    private $loginPage;
    private $prefix;

    /**
     * Header constructor.
     * @param LanguageI $lang
     * @param User|null $user
     */
    public function __construct(LanguageI $lang, ?User $user,array $pages) {
        $this->logged = $user instanceof User && $user != null;
        $this->prefix = $lang->getCode();
        $this->username = $this->logged ? $user->getUsername() : $lang->getUserNotLogged();
        $this->logout = $lang->getLogout();
        $this->login = $lang->getLogin();
        $this->register = $lang->getRegister();
        $this->usernameText = $lang->getUsername();

        $this->logoutPage = $pages["logout"];
        $this->registerPage= $pages["register"];
        $this->loginPage = $pages["login"];
        $this->profilePage = $pages["profile"];

    }


    public function isLogged(): bool {
        return $this->logged;
    }

    public function getUsernameText(): string {
        return $this->usernameText;
    }

    public function getUsername(): string {
        return $this->username;
    }

    public function getLogin(): string {
        return $this->login;
    }

    public function getLogout(): string {
        return $this->logout;
    }

    public function getRegister(): string {
        return $this->register;
    }

    public function getLogoutPage():Page{
        return $this->logoutPage;
    }

    public function getRegisterPage() {
        return $this->registerPage;
    }

    public function getProfilePage(): Page {
        return $this->profilePage;
    }

    public function getLoginPage():Page {
        return $this->loginPage;
    }

    public function getPrefix(): string {
        return $this->prefix;
    }

}