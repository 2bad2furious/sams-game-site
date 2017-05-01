<?php


namespace presenter\api;


use model\form\customforms\RegisterForm;
use model\settings\HeaderTypes;
use model\user\RegisterFailure;
use model\user\User;
use presenter\ApiPresenter;
use view\api\ApiView;

class RegisterPresenter extends ApiPresenter {

    /**
     *TODO set view
     */
    protected function main(): void {
        $this->view = new ApiView();

        if ($this->user instanceof User) {
            $this->view->setData($this->getJsonMessage($this->lang->getUserAlreadyLoggedIn()));
            return;
        }

        $form = new RegisterForm($this->lang, "", "", $this->post, $this->files);

        if ($form->getPassword()->getValue() != $form->getPassword()->getValue()) {
            $this->status = HeaderTypes::BAD_REQUEST;
            $this->view->setData(array("message" => array($this->getJsonMessage($this->lang->getPasswordsDontMatch()))));
        }

        if ($form->hasData($this->server->get("REQUEST_METHOD"))) {

            $data = User::registerUser($form->getUsername()->getValue(), $form->getPassword()->getValue(), $form->getEmail()->getValue(), $this->server->get("REMOTE_ADDR"));

            if ($data instanceof RegisterFailure) {
                $this->status = HeaderTypes::BAD_REQUEST;
                $arr = array();
                if ($data->isEmailExists()) $arr[] = $this->getJsonMessage($this->lang->getEmailExists());
                if ($data->isEmailRegex()) $arr[] = $this->getJsonMessage($this->lang->getEmailRegex());
                if ($data->isPasswordAllowedRegex()) $arr[] = $this->getJsonMessage($this->lang->getPasswordAllowedRegex());
                if ($data->isPasswordMustRegex()) $arr[] = $this->getJsonMessage($this->lang->getPasswordMustRegex());
                if ($data->isUsernameExists()) $arr[] = $this->getJsonMessage($this->lang->getUsernameRegex());
                if ($data->isUsernameRegex()) $arr[] = $this->getJsonMessage($this->lang->getUsernameExists());
                $this->view->setData(array("message" => $arr));
            } else if ($data instanceof User) {
                $this->view->setData(array("message" => $this->getJsonMessage($this->lang->getRegisterSuccess())));
            } else if ($data == null) {
                $this->view->setData(array("message" => $this->getJsonMessage($this->lang->getAdminFailure())));
            }
        } else {
            $this->status = HeaderTypes::BAD_REQUEST;
        }
    }
}