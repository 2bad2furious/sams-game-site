<?php


namespace view\api;


use view\View;

class LoginView extends View {
    protected $loginPresenter;

    protected function preOutput(): string {

    }

    protected function main(): void {
        $this->loginPresenter = new LoginPresenter($this->server,$this->session,$this->post,$this->get,$this->cookie,$this->files,$this->lang);
    }
}