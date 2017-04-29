<?php


namespace presenter\html;



use model\settings\AppSettings;
use view\html\ErrorView;

class ErrorPresenter extends FullScalePresenter {


    protected function main(): void {

        $this->setAllViews();

        $this->view = new ErrorView();

        $this->view->setPageDoesNotExist($this->lang->getPageDoesNotExist());

        $this->setTitle($this->lang->getPageDoesNotExist());
    }

}