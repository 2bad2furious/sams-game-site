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

    /**
     * Form constructor.
     * @param LanguageI $lang
     * @param array $data
     * @param string $title
     * @param string $submitButton
     * @param string $method
     * @param string $enctype
     * @param string $class
     * @param string $action
     * @internal param array $fields
     * @internal param $name
     */
    public function __construct(LanguageI $lang, array $data = array(), string $title, string $submitButton, $method = "post", $enctype = "multipart/form-data", $class = "simpleForm", $action = "") {
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
     * @param array $post
     * @param array $get
     * @param array $files
     * @param string $server_request_method
     * @return bool
     */
    public function hasData(array $post, array $get, array $files, string $server_request_method): bool {

        if ($server_request_method != ucwords($this->method)) return false;

        return $this->validate($post, $get, $files);
    }

    protected function validate(array $post, array $get, array $files): bool {
        $data = array();
        if ($this->method == "post") $data = $post;
        else if ($this->method == "get") $data = $get;

        foreach ($this->fields as $v) {
            if (!$v instanceof FormNode) throw new \Exception("invalid form array");

            if (!$v->isRequired())
                continue;

            if (!isset($data[$v->getName()])) {
                /* array inputs like fileuploads and stuff*/
                $split = mb_substr($v->getName(), -2, 2);
                if ($split === "[]") {
                    if (isset($data[substr($v->getName(), 0, strlen($split))]))
                        continue;
                    else
                        return false;
                }

                if ($v instanceof UploadNode) {
                    if (!isset($files[$v->getName()]))
                        return false;
                    continue;
                }
            }
        }
    }

    protected function addFormNode(FormNode $formNode) {
        $this->fields[] = $formNode;
    }

    /**
     * @throws \Exception
     */
    protected function checkAttributes(): void {
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
}