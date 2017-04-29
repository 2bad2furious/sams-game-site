<?php


namespace view\html;


use model\Header;
use view\View;

class HeaderView extends View {
    protected $logged;
    protected $username;
    protected $usernameText;
    protected $loginUrl;
    protected $logoutUrl;
    protected $registerUrl;
    protected $loginText;
    protected $logoutText;
    protected $registerText;
    protected $prefix;
    protected $profile;
    protected $pages = array();

    protected function preOutput(): string {
        $str = $this->runScript("templates/header.phtml");
        return $str;
    }

    public function setHeader(Header $header) {
        $this->prefix = $header->getPrefix();
        $this->logged = $header->isLogged();
        $this->username = $header->getUsername();
        $this->usernameText = $header->getUsernameText();
        $this->logoutText = $header->getLogout();
        $this->loginText = $header->getLogin();
        $this->registerText = $header->getRegister();
        $this->logoutUrl = $header->getLogoutPage()->getUrl($this->prefix);
        $this->loginUrl = $header->getLoginPage()->getUrl($this->prefix);
        $this->profileUrl = $header->getProfilePage()->getUrl($this->prefix);
        $this->registerUrl = $header->getRegisterPage()->getUrl($this->prefix);
    }
}