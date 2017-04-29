<?php

namespace presenter\api;

use presenter\Presenter;
use view\api\ApiView;

class ErrorPresenter extends Presenter {

    protected function main(): void {
        $this->view = new ApiView();
    }
}