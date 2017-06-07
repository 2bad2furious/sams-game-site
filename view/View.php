<?php


namespace view;


use model\language\LanguageI;

abstract class View implements ViewI {
    private $lang;

    private $headers = array();

    protected $status = "";

    public function __construct(LanguageI $lang) {
        $this->lang = $lang;
        $this->addHeader($this->getContentHeader());
        $this->main();
    }

    public final function output(): string {
        $this->headers();
        return $this->getOutput();
    }

    /**
     * @return LanguageI
     */
    public function getLang(): LanguageI {
        return $this->lang;
    }

    protected function redirect(string $uri): void {
        $this->addHeader("location:" . $uri);
    }

    protected function addHeader(string $header): void {
        $this->headers[] = $header;
    }

    protected final function headers(): void {
        foreach (array_merge($this->headers, array($this->status)) as $v) {
            header($v);
        }
    }

    abstract protected function main(): void;

    abstract protected function getOutput(): string;

    abstract protected function getContentHeader(): string;

}