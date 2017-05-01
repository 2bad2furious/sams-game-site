<?php


namespace model\form;


abstract class FormNode {
    protected $name;
    protected $required;
    protected $value;
    protected $placeholder;
    protected $additionaltags;

    /**
     * FormNode constructor.
     * @param string $name
     * @param string $placeholder
     * @param bool $required
     * @param string $value
     * @param string $additionaltags
     */
    public function __construct(string $name, string $placeholder = "", bool $required = false, string $value = "", string $additionaltags = "") {
        $this->name = $name;
        $this->required = $required;
        $this->value = $value;
        $this->placeholder = $placeholder;
        $this->additionaltags = $additionaltags;
    }

    /**
     * @return bool
     */
    public function isRequired(): bool {
        return $this->required;
    }

    /**
     * @return string
     */
    public function getName(): string {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getValue(): string {
        return $this->value;
    }

    /**
     * @return string
     */
    public function getPlaceholder(): string {
        return $this->placeholder;
    }

    /**
     * @return string
     */
    public function getAdditionaltags(): string {
        return $this->additionaltags;
    }

    /**
     * @return string
     */
    protected function getRequired(): string {
        return $this->required ? " required" : "";
    }

    /**
     * returns html string
     * e.g.: <input type='text' ....>
     * @return string
     */
    abstract public function returnHtml(): string;
}