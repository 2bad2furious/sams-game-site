<?php


namespace presenter;


use model\user\User;

class LogoutPresenter extends Presenter {

    protected function main(): void {
        $this->getView()->setLoggedIn($isLogged = $this->isLoggedIn());

        if ($isLogged)
            User::logout();
    }
}