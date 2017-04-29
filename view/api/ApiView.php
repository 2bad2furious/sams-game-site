<?php


namespace view\api;


use view\ViewI;

class ApiView implements ViewI {
    private $data = array();

    public function output(): string {
        return json_encode($this->data);
    }

    public function setData(array $data) {
        $this->data = $data;
    }
}