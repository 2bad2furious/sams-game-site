<?php


namespace presenter;


use model\form\customforms\MapEditForm;
use model\Map;
use model\user\User;

class CreateMapPresenter extends Presenter {

    protected function main(): void {
        $this->getView()->setIsLogged($isLogged = User::isLoggedIn());
        if (!$isLogged) return;

        $form = new MapEditForm($this->getLang(), $this->getLang()->getCreateMap(), $this->getLang()->getSave(), $_POST, null, null, null, "mapForm");

        $this->getView()->setForm($form);

        $this->getView()->setHasData($hasData = $form->hasData());

        if (!$hasData) return;

        $this->getView()->setMapCreated($mapCreated = Map::createNewMap($form->getJson()));
    }
}