<?php


namespace presenter;


use model\settings\HeaderTypes;

abstract class ApiPresenter extends Presenter {

    protected $contentType = HeaderTypes::CONTENT_JSON;

    protected function getJsonMessage(string $message): array {
        return array("message" => $message);
    }
}