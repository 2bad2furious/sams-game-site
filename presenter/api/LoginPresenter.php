<?php


namespace presenter\api;


use presenter\Presenter;
use view\api\ApiView;

class LoginPresenter extends Presenter {

    /**
     *TODO set view
     */
    protected function main(): void {
        $this->view = new ApiView();

    }
}