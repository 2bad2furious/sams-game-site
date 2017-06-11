<?php

/**
 * Created by PhpStorm.
 * User: martin
 * Date: 6.5.17
 * Time: 11:56
 */

namespace view\glob;

use model\form\customforms\LoginForm;
use model\user\User;

interface LoginViewI {

    public function setLoggedIn(bool $loggedIn);

    public function setUser(?User $user);

    public function hasData(bool $hasData);

    public function setForm(LoginForm $form);


}