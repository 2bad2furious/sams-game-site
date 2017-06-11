<?php


namespace model;

// presentation model
class Message {
    const OK = "msg-ok";
    const WARN = "msg-warn";
    const ERROR = "msg-err";

    private $text = "";
    private $category;

    /**
     * Message constructor.
     * @param string $text
     * @param string $category
     * @internal param $category
     */
    public function __construct(string $text, string $category = Message::OK) {
        $this->text = $text;
        $this->category = $category;
    }

    public function getText(): string {
        return $this->text;
    }

    public function getCategory(): string {
        return $this->category;
    }

    public function toHtml(): string {
        return "<div class='message {$this->getCategory()}' >
    <span>{$this->getText()}</span>
</div>";
    }

}