<?php


namespace view\html;

use view\PageView;

class HomeView extends PageView {

    protected function getContent(): string {
        return $this->runScript("templates/home.phtml");
    }
}