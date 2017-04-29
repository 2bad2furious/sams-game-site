<?php


namespace presenter\api;


use presenter\Presenter;
use view\ApiView;

class RegisterPresenter extends Presenter {

    /**
     *TODO set view
     */
    protected function main(): void {
        $this->view = new ApiView();


    }
}