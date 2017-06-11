<?php


namespace view;


use model\settings\HeaderTypes;

abstract class ApiView extends View {
    private $data = array();

    protected function getOutput(): string {
        return json_encode($this->data);
    }

    /**
     * @return array
     */
    public function getData(): array {
        return $this->data;
    }

    /**
     * @param array $data
     */
    public function setData(array $data) {
        $this->data = $data;
    }

    protected final function getContentHeader(): string {
        return HeaderTypes::CONTENT_JSON;
    }
}