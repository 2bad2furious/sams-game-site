<?php


namespace model\form;


use model\language\LanguageI;

abstract class Form {
    const METHOD_POST = "post";
    const METHOD_GET = "get";
    const METHOD_ARRAY = array(Form::METHOD_GET, Form::METHOD_POST);

    const ENCTYPE_APP = "application/x-www-form-urlencoded";
    const ENCTYPE_MULTIPART = "multipart/form-data";
    const ENCTYPE_PLAIN = "text/plain";
    const ENCTYPE_ARRAY = array(Form::ENCTYPE_APP, Form::ENCTYPE_PLAIN, Form::ENCTYPE_MULTIPART);


    protected $fields = array();
    protected $method;
    protected $enctype;
    protected $class;
    protected $action;
    protected $title;
    protected $submitButton;
    protected $data = array();
    protected $files = array();

    /**
     * Form constructor.
     * @param LanguageI $lang
     * @param string $title
     * @param string $submitButton
     * @param array $data
     * @param array $files
     * @param string $method
     * @param string $enctype
     * @param string $class
     * @param string $action
     */
    public function __construct(LanguageI $lang, string $title, string $submitButton, array $data = array(),array $files = array(), $method = Form::METHOD_POST, $enctype = Form::ENCTYPE_MULTIPART, $class = "simpleForm", $action = "") {
        $this->method = $method;
        $this->enctype = $enctype;
        $this->class = $class;
        $this->action = $action;
        $this->title = $title;
        $this->submitButton = $submitButton;

        $this->checkAttributes();

        $this->main($lang, $data);
    }


    /**
     * @param array $files
     * @param string $server_request_method
     * @return array|bool
     */
    public function hasData(string $server_request_method): bool {

//        var_dump($server_request_method,strtoupper($this->method));

        if ($server_request_method != strtoupper($this->method)) return false;

        return $this->validate();
    }

    protected function validate(): bool {

        foreach ($this->fields as $v) {
            if (!$v instanceof FormNode) throw new \Exception("invalid form array");

            if (!$v->isRequired())
                continue;

            $purename = $v->getName();

            if (!isset($this->data[$v->getName()])) {
                /* array inputs like fileuploads and stuff*/
                $split = mb_substr($v->getName(), -2, 2);
                if ($split === "[]") {
                    $purename = substr($v->getName(), 0, strlen($split));
                    if (!isset($this->data[$purename]))
                        return false;
                }

                if ($v instanceof UploadNode) {
                    if (!isset($this->files[$purename]))
                        return false;
                    continue;
                }
            }
        }

        return true;
    }

    protected function addFormNode(FormNode $formNode) {
        $this->fields[] = $formNode;
    }

    /**
     * @throws \Exception
     */
    protected final function checkAttributes(): void {
        if (!in_array($this->method, Form::METHOD_ARRAY)) throw new \Exception("Invalid form method");

        if (!in_array($this->enctype, Form::ENCTYPE_ARRAY)) throw new \Exception("Invalid form enctype");
    }

    public function returnHtml(): string {
        $html = "<form class='{$this->class}' method='{$this->method}' action='{$this->action}' enctype='{$this->enctype}'> <h2>{$this->title}</h2>";
        foreach ($this->fields as $v) {
            if (!$v instanceof FormNode) throw new \Exception("invalid formnode array");
            $html .= $v->returnHtml();
        }
        return $html . "<input type='submit' value='{$this->submitButton}'></form>";
    }

    /**
     * add fields and stuff
     * @param LanguageI $lang
     * @param array $data
     * @return void
     */
    abstract protected function main(LanguageI $lang, array $data = array()): void;

    /**
     * @return array
     */
    public function getFields(): array {
        return $this->fields;
    }

    /**
     * @return string
     */
    public function getMethod(): string {
        return $this->method;
    }

    /**
     * @return string
     */
    public function getEnctype(): string {
        return $this->enctype;
    }

    /**
     * @return string
     */
    public function getClass(): string {
        return $this->class;
    }

    /**
     * @return string
     */
    public function getAction(): string {
        return $this->action;
    }

    /**
     * @return string
     */
    public function getTitle(): string {
        return $this->title;
    }

    /**
     * @return string
     */
    public function getSubmitButton(): string {
        return $this->submitButton;
    }
}