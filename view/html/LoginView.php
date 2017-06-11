<?php


namespace view\html;


use model\form\customforms\LoginForm;
use model\Message;
use model\user\User;
use presenter\LoginPresenter;
use view\glob\LoginViewI;
use view\PageView;

class LoginView extends PageView implements LoginViewI {
    private $form = "";
    private $loggedIn = "";
    private $user;
    private $hasData = false;


    protected function getContent(): string {
        new LoginPresenter($this,$this->getLang());

        $profileUrl = "/".$this->getLang()->getCode()."/profile";

        if($this->loggedIn) $this->redirect($profileUrl);
        else if($this->hasData){
            if($this->user instanceof User) $this->redirect($profileUrl);
            else $this->addMessage(new Message($this->getLang()->getLoginFailure(),Message::ERROR));
        }
        return $this->runScript("templates/login.phtml");
    }

    public function setLoggedIn(bool $loggedIn) {
        $this->loggedIn = $loggedIn;
    }

    public function setUser(?User $user) {
        $this->user = $user;
    }

    public function hasData(bool $hasData) {
        $this->hasData = $hasData;
    }

    public function setForm(LoginForm $form) {
        $this->form = $form->returnHtml();
    }

    /**
     * @return string
     */
    protected function getForm(): string {
        return $this->form;
    }

    /**
     * @return string
     */
    protected function getLoggedIn(): string {
        return $this->loggedIn;
    }

    /**
     * @return mixed
     */
    protected function getUser():?User {
        return $this->user;
    }
}