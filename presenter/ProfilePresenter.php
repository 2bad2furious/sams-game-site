<?php


namespace presenter;


use model\form\customforms\ProfileForm;
use model\user\User;

class ProfilePresenter extends Presenter {

    protected function main(): void {
        $this->getView()->setIsLogged($isLogged = User::isLogged());

        if(!$isLogged) return;

        $this->getView()->setForm($form = new ProfileForm($this->getLang()));

        $this->getView()->hasData($hasData = $form->hasData());

        if(!$hasData) return;

        $uploader = new FileUploader();

        $username = $form->getUsername();

        $this->getView()->setSuccess(User::edit($username,$photo));
    }
}