<?php


namespace view;


use model\language\LanguageI;
use model\Message;

abstract class View implements ViewI {
    private $lang;

    private $headers = array();
    protected $status = "";

    public final function __construct(LanguageI $lang) {
        if (!isset($_SESSION["messages"]) || !is_array($_SESSION["messages"]))
            $this->resetMessages();

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
    public final function getLang(): LanguageI {
        return $this->lang;
    }

    protected final function redirect(string $uri): void {
        $this->resetMessages();
        header("Location:" . $uri);
        exit();
    }

    protected final function sendBack(string $url = ""): void {
        if ($url) {
            $this->redirect($url);
        } else if (is_string($ses_url = $_SESSION["url"]) && $ses_url) {
            $this->redirect($ses_url);
            unset($_SESSION["url"]);
        } else if (isset($_SERVER["HTTP_REFERER"])) {
            $this->redirect($_SERVER["HTTP_REFERER"]);
        }
    }

    protected function addHeader(string $header): void {
        $this->headers[] = $header;
    }

    protected final function headers(): void {
        foreach (array_merge($this->headers, array($this->status)) as $v) {
            header($v);
        }
    }

    protected final function addMessage(Message $message) {
        $_SESSION["messages"][] = $message;
    }

    protected final function getMessages(): array {
        $messages = $_SESSION["messages"];
        $this->resetMessages();
        return $messages;
    }

    protected final function getMsgs(): string {
        $str = "";
        foreach ($this->getMessages() as $message) {
            if ($message instanceof Message)
                $str .= $message->toHtml();
        }
        return $str;
    }

    abstract protected function main(): void;

    abstract protected function getOutput(): string;

    abstract protected function getContentHeader(): string;

    private function resetMessages() {
        $_SESSION["messages"] = array();
    }

}