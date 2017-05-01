<?php

namespace presenter\api;

use presenter\ApiPresenter;
use view\api\ApiView;

class ErrorPresenter extends ApiPresenter {

    protected function main(): void {
        $this->view = new ApiView();
    }
}