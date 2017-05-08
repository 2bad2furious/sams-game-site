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
        $this->loginPresenter = new LoginPresenter($this->session, $this->post, $this, $this->lang, $this->server["REQUEST_METHOD"], $this->server["REMOTE_ADDR"]);

        $header = HeaderTypes::BAD_REQUEST;

        if (!$this->hasData) {
            $message = $this->lang->getFormNoData();
        } else if ($this->isLoggedIn) {
            $message = $this->lang->getUserAlreadyLoggedIn();
        } else if (!$this->user instanceof User) {
            $message = $this->lang->getLoginFailure();
        } else {
            $message = $this->lang->getLoginSuccess();
            $header = HeaderTypes::OK;
        }

        $this->status = $header;
        $this->data = array("message" => $message);
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