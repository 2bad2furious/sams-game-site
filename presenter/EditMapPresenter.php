<?php


namespace presenter;


use model\form\customforms\MapEditForm;
use model\Map;
use model\user\User;

class EditMapPresenter extends Presenter {

    protected function main(): void {
        $this->getView()->setIsLogged($isLogged = User::isLoggedIn());
        if (!$isLogged) return;

        $parameters = $this->getView()->getParameters();

        $parameter = "";

        $this->getView()->setParameterExists($parameterExists = (isset($parameters[0]) && $parameter = intval($parameters[0]) && $parameter > 0));

        if (!$parameterExists) return;

        $this->getView()->setExists($exists = Map::exists($parameter));

        if(!$exists) return;

        $this->getView()->setHasRights($hasRights = Map::hasRights($parameter));

        if(!$hasRights) return;

        $mapArray = Map::get($parameter)->serialize();

        $form = new MapEditForm($this->getLang(), $this->getLang()->getCreateMap(), $this->getLang()->getSave(), ($_POST) ? $_POST : $mapArray, null, null, null, "mapForm");

        $this->getView()->setForm($form);

        $this->getView()->setHasData($hasData = $form->hasData());

        if (!$hasData) return;

        $this->getView()->setMapCreated($mapCreated = Map::editMap($parameter, $form->getJson()));
    }
}