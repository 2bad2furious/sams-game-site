<?php


namespace view\html;


use model\form\customforms\RegisterForm;
use model\Message;
use model\user\RegisterFailure;
use model\user\User;
use presenter\RegisterPresenter;
use view\glob\RegisterViewI;
use view\PageView;

class RegisterView extends PageView implements RegisterViewI {
    private $passwordsDontEqual = false;
    private $loggedIn = false;
    private $hasData = false;
    private $registerData = null;
    private $formHtml = "";

    protected function getContent(): string {
        new RegisterPresenter($this, $this->getLang());

        $profileUrl = "/" . $this->getLang()->getCode() . "/profile";

        if ($this->loggedIn) $this->redirect($profileUrl);

        if ($this->hasData) {
            if (!$this->passwordsDontEqual) $this->addMessage(new Message($this->getLang()->getPasswordsDontMatch(), Message::WARN));
            if ($this->registerData instanceof User) {
                $this->addMessage(new Message($this->getLang()->getRegisterSuccess()));
                $this->formHtml = "";
            } else if ($this->registerData instanceof RegisterFailure) {
                $data = $this->registerData;
                if ($data->isUsernameExists()) $this->addMessage(new Message($this->getLang()->getUsernameExists(), Message::WARN));
                if ($data->isPasswordMustRegex()) $this->addMessage(new Message($this->getLang()->getPasswordMustRegex(), Message::WARN));
                if ($data->isPasswordAllowedRegex()) $this->addMessage(new Message($this->getLang()->getPasswordAllowedRegex(), Message::WARN));
                if ($data->isEmailRegex()) $this->addMessage(new Message($this->getLang()->getEmailRegex(), Message::WARN));
                if ($data->isEmailExists()) $this->addMessage(new Message($this->getLang()->getEmailExists(), Message::WARN));
                if ($data->isUsernameRegex()) $this->addMessage(new Message($this->getLang()->getUsernameRegex(), Message::WARN));
            } else {
                $this->addMessage(new Message($this->getLang()->getAdminFailure(), Message::ERROR));
            }
        }
        return $this->runScript("templates/register.phtml");
    }

    public function setRegisterData($data) {
        $this->registerData = $data;
    }

    public function setForm(RegisterForm $form) {
        $this->formHtml = $form->returnHtml();
    }

    public function isLoggedIn(bool $logged) {
        $this->loggedIn = $logged;
    }

    public function hasData(bool $data) {
        $this->hasData = $data;
    }

    public function passwordsEqual(bool $equal) {
        $this->passwordsDontEqual = $equal;
    }

    protected function getForm(): string {
        return $this->formHtml;
    }
}