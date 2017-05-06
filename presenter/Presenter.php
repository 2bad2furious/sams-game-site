<?php

namespace presenter;


use model\settings\AppSettings;
use model\user\User;

abstract class Presenter
{
    protected $user;

    protected function setUser(array $session)
    {
        $user = null;
        if (isset($session["user"])) {
            if (!$session["user"] instanceof User) throw new \Exception();

            $user = $this->validateUser($session["user"]);
        }
        $this->user = $user;
    }

    protected function isLogged():?User
    {
        return ($this->user instanceof User && $this->validateUser($this->user)) ? $this->user : null;
    }

    protected function validateUser(?User $user): bool
    {
        return User::isUserOk($user, "xd", AppSettings::USER_LOGOUT_TIME);
    }
}