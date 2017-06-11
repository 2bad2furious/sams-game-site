<?php


namespace view\html;


use view\PageView;
use view\View;

class ErrorView extends PageView{
    protected $pageDoesNotExist = "";

    /**
     * @param string $pageDoesNotExist
     */
    public function setPageDoesNotExist(string $pageDoesNotExist) {
        $this->pageDoesNotExist = $pageDoesNotExist;
    }

    protected function preOutput(): string {
        return file_get_contents("templates/error.phtml");
    }

    protected function getContent(): string {
        return "xd";
    }
}