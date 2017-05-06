<?php


namespace view;


use model\settings\HeaderTypes;

abstract class ApiView extends View {
    protected $data = array();

    protected function preOutput(): string {
        return json_encode($this->data);
    }

    protected final function getContentHeader(): string {
        return HeaderTypes::CONTENT_JSON;
    }
}