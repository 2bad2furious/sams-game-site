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
        $form = new LoginForm($this->getLang(), $_POST);

        $this->getView()->setLoggedIn($isLoggedIn = User::isLoggedIn());

        if ($isLoggedIn) {
            return;
        }

        $hasData = $form->hasData();

        $this->getView()->hasData($hasData);
        $this->getView()->setForm($form);

        if ($hasData) {
            $username = $form->getUsername()->getValue();
            $password = $form->getPassword()->getValue();

            $user = User::loginUser($username, $password);

            $this->getView()->setUser($user);
        }
    }


}