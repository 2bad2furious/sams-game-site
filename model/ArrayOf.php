<?php

namespace model;

class ArrayOf {
    private $class;
    private $arr;

    /**
     * ArrayOf constructor.
     * @param $class
     */
    public function __construct(string $class) {
        if(!class_exists($class)) throw new \Exception("Class does not exist");
        $this->class = $class;
    }

    public function isClass($obj) {
        return is_a($obj, $this->class);
    }

    public function getClass(): string {
        return $this->class;
    }

    public function add($obj) {
        if (!$this->isClass($obj)) throw new Exception("Object not an instance of " . $this->class);
        $this->arr[] = $obj;
    }

    public function get(int $index) {
        if (!isset($this->arr[$index])) throw new OutOfBoundsException("Index does not exist");
        return $this->arr[$index];
    }

    public static function fromAnotherInstance(ArrayOf $arrayOf): ArrayOf {
        $newInstance = new ArrayOf($arrayOf->getClass());

        foreach($arrayOf->arr as $v){
            $newInstance->add($v);
        }

        return $newInstance;
    }
}
