<?php


namespace view\api;


use model\form\customforms\RegisterForm;
use model\settings\HeaderTypes;
use model\user\RegisterFailure;
use model\user\User;
use presenter\RegisterPresenter;
use view\ApiView;
use view\glob\RegisterViewI;

class RegisterView extends ApiView implements RegisterViewI
{
    protected $registerData = null;
    protected $hasData = false;
    protected $isLoggedIn = false;
    protected $passwordsEqual = false;

    protected $registerPresenter;


    protected function main(): void
    {
        $this->registerPresenter = new RegisterPresenter($this->session, $this->post, $this, $this->lang, $this->server["REQUEST_METHOD"], $this->server["REMOTE_ADDR"]);

        $this->status = HeaderTypes::BAD_REQUEST;

        $messageArr = array();
        $message = "";

        if (!$this->hasData) {
            $message = $this->lang->getFormNoData();
        } else if ($this->isLoggedIn) {
            $message = $this->lang->getUserAlreadyLoggedIn();
        } else if (!$this->passwordsEqual) {
            $message = $this->lang->getPasswordsDontMatch();
        } else {
            if ($this->registerData instanceof RegisterFailure) {
                $data = $this->registerData;

                if ($data->isEmailExists()) $messageArr[] = $this->lang->getEmailExists();
                if ($data->isEmailRegex()) $messageArr[] = $this->lang->getEmailRegex();
                if ($data->isPasswordAllowedRegex()) $messageArr[] = $this->lang->getPasswordAllowedRegex();
                if ($data->isPasswordMustRegex()) $messageArr[] = $this->lang->getPasswordMustRegex();
                if ($data->isUsernameExists()) $messageArr[] = $this->lang->getUsernameExists();
                if ($data->isUsernameRegex()) $messageArr[] = $this->lang->getUsernameRegex();

            } else if ($this->registerData instanceof User) {
                $message = $this->lang->getRegisterSuccess();
            } else {
                $message = $this->lang->getAdminFailure();
            }
        }

        if ($message) $messageArr[] = $message;
        $this->data = array("messages" => $messageArr);

    }

    public function setRegisterData($data)
    {
        $this->registerData = $data;
    }

    public function setForm(RegisterForm $form)
    {
        // TODO: Implement setForm() method.
    }

    public function isLoggedIn(bool $logged)
    {
        $this->isLoggedIn = $logged;
    }

    public function hasData(bool $data)
    {
        $this->hasData = $data;
    }

    public function passwordsEqual(bool $equal)
    {
        $this->passwordsEqual = $equal;
    }
}