<?php


namespace presenter\page;


use model\user\User;
use presenter\Presenter;

class HeaderPresenter extends Presenter {

    protected function main(): void {
        $posUser = $this->getUser();
        $this->getView()->setLogged($isLogged = $posUser instanceof User);

        if ($isLogged)
            $this->getView()->setUsername($posUser->getUsername());

    }
}