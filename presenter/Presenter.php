<?php

namespace presenter;


use model\language\LanguageI;
use model\settings\AppSettings;
use model\user\User;
use view\View;

abstract class Presenter {
    private $view;
    private $lang;

    /**
     * Presenter constructor.
     * @param View $view
     * @param LanguageI $lang
     */
    public final function __construct(View $view,LanguageI $lang) {
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

    protected abstract function main():void;
}