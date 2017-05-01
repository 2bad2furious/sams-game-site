<?php


namespace presenter\api;


use model\form\customforms\LoginForm;
use model\settings\HeaderTypes;
use model\user\User;
use presenter\ApiPresenter;
use view\api\ApiView;

class LoginPresenter extends ApiPresenter {

    /**
     *TODO set view
     */
    protected function main(): void {
        $this->view = new ApiView();

        if ($this->user instanceof User) {
            $this->view->setData($this->getJsonMessage($this->lang->getUserAlreadyLoggedIn()));
            return;
        }

        $form = new LoginForm($this->lang, "", "", array("username" => "text", "password" => "xd"), $this->files);

        $data = $form->hasData("POST");

        if (!$data) {
            $this->status = HeaderTypes::BAD_REQUEST;
            return;
        }

        $user = User::getUserByLogin($form->getUsername()->getValue(), $form->getPassword()->getValue(), $this->server->get("REMOTE_ADDR"));

        var_dump($form->getPassword()->getValue());
        var_dump($form->getUsername()->getValue());

        var_dump($user);
    }
}