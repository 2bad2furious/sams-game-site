<?php


namespace view\api;

use model\settings\HeaderTypes;
use model\user\User;
use presenter\LoginPresenter;
use model\form\customforms\LoginForm;
use view\ApiView;
use view\glob\LoginViewI;

class LoginView extends ApiView implements LoginViewI
{
    protected $loginPresenter;
    protected $hasData = false;
    protected $isLoggedIn = false;
    protected $user = null;

    protected function main(): void
    {
        $this->loginPresenter = new LoginPresenter($this, $this->getLang());

        $header = HeaderTypes::BAD_REQUEST;

        if (!$this->hasData) {
            $message = $this->getLang()->getFormNoData();
        } else if ($this->isLoggedIn) {
            $message = $this->getLang()->getUserAlreadyLoggedIn();
        } else if (!$this->user instanceof User) {
            $message = $this->getLang()->getLoginFailure();
        } else {
            $message = $this->getLang()->getLoginSuccess();
            $header = HeaderTypes::OK;
        }

        $this->status = $header;
        $this->setData(array("message" => $message));
    }

    public function isLoggedIn(bool $loggedIn)
    {
        $this->isLoggedIn = $loggedIn;
    }

    public function hasData(bool $hasData)
    {
        $this->hasData = $hasData;
    }

    public function setForm(LoginForm $form)
    {

    }

    public function setUser(?User $user)
    {
        $this->user = $user;
    }
}