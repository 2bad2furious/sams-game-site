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

    public function getPasswordsDontMatch(): string;

    public function getUserAlreadyLoggedIn(): string;

    public function getEmailExists(): string;

    public function getEmailRegex(): string;

    public function getPasswordAllowedRegex(): string;

    public function getPasswordMustRegex(): string;

    public function getUsernameRegex(): string;

    public function getUsernameExists(): string;

    public function getLoginSuccess(): string;

    public function getAdminFailure(): string;

    public function getRegisterSuccess(): string;

    public function getLoginFailure(): string;

    public function getFormNoData(): string;

    public static function instance(): LanguageI;

    public function getLogoutSuccess(): string;
}