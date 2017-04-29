<?php


namespace model\language;


interface LanguageI {

    public function getCode(): string;

    public function getLogin(): string;

    public function getUserNotLogged(): string;

    public function getLogout(): string;

    public function getRegister(): string;

    public function getUsername(): string;

    public function getPageDoesNotExist(): string;

    public function getPassword(): string;

    public function getPasswordFormText(): string;

    public function getPasswordSecondFormText(): string;

    public function getUsernameFormText(): string;

    public function getEmailFormText(): string;

    public static function instance(): LanguageI;
}