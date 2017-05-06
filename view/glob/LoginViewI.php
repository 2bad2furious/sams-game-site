<?php

/**
 * Created by PhpStorm.
 * User: martin
 * Date: 6.5.17
 * Time: 11:56
 */

namespace view\glob;

use model\form\customforms\LoginForm;

interface LoginViewI {

    public function isLoggedIn(bool $loggedIn);

    public function setLoginSuccess(bool $success);

    public function hasData(bool $hasData);

    public function setForm(LoginForm $form);


}