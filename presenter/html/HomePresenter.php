<?php


namespace presenter\html;


use model\settings\AppSettings;
use view\html\HomeView;

class HomePresenter extends FullScalePresenter {

    protected function main(): void {
        $this->view = new HomeView();
        $this->setAllViews();


        $this->setTitle(AppSettings::DEFAULT_AFTER_TITLE,"");
    }
}