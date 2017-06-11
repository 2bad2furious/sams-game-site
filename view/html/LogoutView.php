<?php


namespace view\html;


use model\Message;
use presenter\LogoutPresenter;
use view\glob\LogoutViewI;
use view\PageView;

class LogoutView extends PageView implements LogoutViewI {
    private $loggedIn = false;

    public function setLoggedIn(bool $logged) {
        $this->loggedIn = $logged;
    }

    protected function getContent(): string {
        new LogoutPresenter($this, $this->getLang());

        $this->addMessage(($this->loggedIn) ? new Message($this->getLang()->getLogoutSuccess()) : new Message($this->getLang()->getUserNotLogged(), Message::WARN));
        $this->sendBack("/".$this->getLang()->getCode());
        return "";
    }
}