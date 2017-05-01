<?php


namespace model;


final class StringArray {
    private $arr;

    /**
     * StringArray constructor.
     * @param $arr
     */
    public function __construct($arr) {
        $this->arr = $arr;
    }


    public function get(string $index): string {
        return (isset($this->arr[$index]) && is_string($this->arr[$index])) ? $this->arr[$index] : "";
    }


}