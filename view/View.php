<?php


namespace view;


use model\language\LanguageI;

abstract class View
{
    protected $server = array();
    protected $session = array();
    protected $post = array();
    protected $get = array();
    protected $cookie = array();
    protected $files = array();

    protected $lang;

    protected $headers = array();

    protected $status = "";

    /**
     * View constructor.
     * @param array $server
     * @param array $session
     * @param array $post
     * @param array $get
     * @param array $cookie
     * @param array $files
     * @param $lang
     */
    public function __construct(array $server, array $session, array $post, array $get, array $cookie, array $files, LanguageI $lang)
    {
        $this->server = $server;
        $this->session = $session;
        $this->post = $post;
        $this->get = $get;
        $this->cookie = $cookie;
        $this->files = $files;
        $this->lang = $lang;

        $this->addHeader($this->getContentHeader());

        $this->main();
    }

    public final function output(): string
    {
        $this->headers();
        return $this->preOutput();
    }

    protected function redirect(string $uri): void
    {
        $this->addHeader("location:" . $uri);
    }

    protected function addHeader(string $header): void
    {
        $this->headers[] = $header;
    }

    protected final function headers(): void
    {
        foreach (array_merge($this->headers,array($this->status)) as $v) {
            header($v);
        }
    }

    abstract protected function main(): void;

    abstract protected function preOutput(): string;


    abstract protected function getContentHeader(): string;

}