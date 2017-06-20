<?php

namespace presenter;


use model\Globals;
use model\language\LanguageI;
use model\settings\AppSettings;
use model\user\User;
use view\View;

abstract class Presenter {
    private $view;
    private $lang;
    private $extractedUser;
    private $parameters;

    /**
     * Presenter constructor.
     * @param View $view
     * @param LanguageI $lang
     */
    public final function __construct(View $view, LanguageI $lang) {
        $this->view = $view;
        $this->lang = $lang;

        $this->main();
    }

    protected function getView(): View {
        return $this->view;
    }

    /**
     * @return LanguageI
     */
    public function getLang(): LanguageI {
        return $this->lang;
    }

    protected abstract function main(): void;

    protected function isLoggedIn(): bool {
        return $this->getUser() instanceof User;
    }

    protected function getUser():?User {
        if (!$this->extractedUser instanceof User)
            $this->extractedUser = User::extractUser($_SERVER["REMOTE_ADDR"], AppSettings::USER_LOGOUT_TIME);
        return $this->extractedUser;
    }
}