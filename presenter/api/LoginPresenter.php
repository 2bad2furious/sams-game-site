<?php


namespace presenter\api;


use model\form\customforms\LoginForm;
use model\Header;
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

        $form = new LoginForm($this->lang, "", "", $this->post, $this->files);

        if ($form->hasData($this->server->get("REQUEST_METHOD"))) {
            $user = User::getUserByLogin($form->getUsername()->getValue(), $form->getPassword()->getValue(), $this->server->get("REMOTE_ADDR"));
            if ($user instanceof User) {
                //$_SESSION["user"] = $user;
                $this->status = HeaderTypes::OK;
                $this->view->setData($this->getJsonMessage($this->lang->getLoginSuccess()));
            } else {
                $this->status = HeaderTypes::BAD_REQUEST;
                $this->view->setData($this->getJsonMessage($this->lang->getLoginFailure()));
            }
        } else {
            $this->status = HeaderTypes::BAD_REQUEST;
            $this->view->setData($this->getJsonMessage($this->lang->getFormNoData()));
        }

    }
}