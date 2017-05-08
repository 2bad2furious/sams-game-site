<?php
/**
 * Created by PhpStorm.
 * User: martin
 * Date: 8.5.17
 * Time: 13:09
 */

namespace view\glob;


use model\form\customforms\RegisterForm;

interface RegisterViewI{
    public function setRegisterData($data);
    public function setForm(RegisterForm $form);
    public function isLoggedIn(bool $logged);
    public function hasData(bool $data);
    public function passwordsEqual(bool $equal);
}