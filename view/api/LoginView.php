<?php


namespace view\api;

use presenter\LoginPresenter;
use model\form\customforms\LoginForm;
use view\ApiView;
use view\glob\LoginViewI;

class LoginView extends ApiView implements LoginViewI {
    protected $loginPresenter;

    protected function main(): void {
        $this->loginPresenter = new LoginPresenter($this->session, $this->post, $this, $this->lang,$this->server["REQUEST_METHOD"],$this->server["REMOTE_ADDR"]);
    }

    protected function getOutput(): string {
        // TODO: Implement getOutput() method.
    }

    public function isLoggedIn(bool $loggedIn) {
        // TODO: Implement isLoggedIn() method.
    }

    public function setLoginSuccess(bool $success) {
        // TODO: Implement setLoginSuccess() method.
    }

    public function hasData(bool $hasData) {
        // TODO: Implement hasData() method.
    }

    public function setForm(LoginForm $form){

    }
}