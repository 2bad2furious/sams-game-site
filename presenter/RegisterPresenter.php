<?php
/**
 * Created by PhpStorm.
 * User: martin
 * Date: 8.5.17
 * Time: 13:12
 */

namespace presenter;


use model\form\customforms\RegisterForm;
use model\Globals;
use model\language\LanguageI;
use model\settings\AppSettings;
use model\user\User;
use view\glob\RegisterViewI;

class RegisterPresenter extends Presenter {

    protected function main(): void {
        $form = new RegisterForm($this->getLang(), $_POST);
        $this->getView()->setForm($form);

        $this->getView()->isLoggedIn($isLoggedIn = User::isLoggedIn());

        if ($isLoggedIn) {
            return;
        }

        $this->getView()->hasData($hasData = $form->hasData());

        if ($hasData) {
            $username = $form->getUsername()->getValue();
            $email = $form->getEmail()->getValue();
            $password = $form->getPassword()->getValue();
            $password2 = $form->getPassword2()->getValue();


            $this->getView()->passwordsEqual($passwordsEqual = $password === $password2);
            if (!$passwordsEqual) return;

            $registerData = User::registerUser($username, $password, $email, $_SERVER["REMOTE_ADDR"]);

            $this->getView()->setRegisterData($registerData);
        }
    }
}