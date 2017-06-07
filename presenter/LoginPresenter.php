<?php


namespace presenter;


use model\form\customforms\LoginForm;
use model\Globals;
use model\language\LanguageI;
use model\settings\AppSettings;
use model\user\User;
use presenter\Presenter;
use view\glob\LoginViewI;

class LoginPresenter extends Presenter {

    protected function main(): void {
        $form = new LoginForm($this->getLang(), Globals::getPost());

        $server = Globals::getServer();

        $this->getView()->isLoggedIn($isLoggedIn = User::isLoggedIn(Globals::getSession(), $ip = $server["REMOTE_ADDR"], AppSettings::USER_LOGOUT_TIME));

        if ($isLoggedIn) {
            return;
        }

        $hasData = $form->hasData($server["REQUEST_METHOD"]);

        $this->getView()->hasData($hasData);
        $this->getView()->setForm($form);

        if ($hasData) {
            $username = $form->getUsername()->getValue();
            $password = $form->getPassword()->getValue();

            $user = User::loginUser($username, $password,$ip);

            $this->getView()->setUser($user);
        }
    }


}