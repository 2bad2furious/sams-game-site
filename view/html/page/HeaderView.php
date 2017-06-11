<?php


namespace view\html\page;


use presenter\page\HeaderPresenter;
use view\glob\page\HeaderViewI;
use view\HtmlView;

class HeaderView extends HtmlView implements HeaderViewI {
    private $logged = false;
    private $username = "";

    protected function getHtmlContent(): string {
        return $this->runScript("templates/header.phtml");
    }

    protected function main(): void {
        new HeaderPresenter($this, $this->getLang());
    }

    public function setLogged(bool $val) {
        $this->logged = $val;
    }

    public function isLogged(): bool {
        return $this->logged;
    }

    protected function getUsernameText(): string {
        return $this->getLang()->getUsername();
    }

    /**
     * @return string
     */
    public function getProfileUrl(): string {
        return "/" . $this->getLang()->getCode() . "/profile";
    }

    public function getLogoutUrl(): string {
        return "/" . $this->getLang()->getCode() . "/logout";
    }

    public function getLogoutText(): string {
        return $this->getLang()->getLogout();
    }

    public function getLoginUrl():string{
        return "/".$this->getLang()->getCode()."/login";
    }

    public function getRegisterUrl():string{
        return "/".$this->getLang()->getCode()."/register";
    }

    /**
     * @return string
     */
    public function getUsername(): string {
        return $this->username;
    }

    /**
     * @return string
     */
    public function getLoginText(): string {
        return $this->getLang()->getLogin();
    }

    /**
     * @return string
     */
    public function getRegisterText(): string {
        return $this->getLang()->getRegister();
    }

    /**
     * @return string
     */
    public function getUserNotLoggedIn(): string {
        return $this->getLang()->getUserNotLogged();
    }

    public function setUsername(string $username) {
        $this->username = $username;
    }

}