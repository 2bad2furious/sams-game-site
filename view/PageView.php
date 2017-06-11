<?php


namespace view;

use view\glob\page\FooterViewI;
use view\glob\page\HeaderViewI;
use view\glob\page\HeadViewI;
use view\html\page\FooterView;
use view\html\page\HeaderView;
use view\html\page\HeadView;

abstract class PageView extends HtmlView {
    private $head = "";
    private $content = "";
    private $footer = "";
    private $header = "";


    protected function main(): void {
        $this->setFooter($this->getFooterView()->output());
        $this->setHead($this->getHeadView()->output());
        $this->setHeader($this->getHeaderView()->output());
    }

    /**
     * @return string
     */
    public final function getHeader(): string {
        return $this->header;
    }

    /**
     * @param string $header
     */
    public final function setHeader(string $header) {
        $this->header = $header;
    }

    /**
     * @return string
     */
    protected final function getHead(): string {
        return $this->head;
    }

    /**
     * @param string $head
     */
    protected final function setHead(string $head) {
        $this->head = $head;
    }

    /**
     * @return string
     */
    protected final function getFooter(): string {
        return $this->footer;
    }

    /**
     * @param string $footer
     */
    private final function setFooter(string $footer) {
        $this->footer = $footer;
    }

    protected final function setContent(string $content) {
        $this->content = $content;
    }

    protected final function getHtmlContent(): string {
        $this->content = $this->getContent();
        return $this->runScript($this->getPageScriptPath());
    }

    protected final function getInnerContent():string{
        return $this->content;
    }

    protected function getPageScriptPath(): string {
        return "templates/page.phtml";
    }

    protected function getHeadView(): HeadViewI {
        return new HeadView($this->getLang());
    }

    protected function getFooterView(): FooterViewI {
        return new FooterView($this->getLang());
    }

    protected function getHeaderView(): HeaderViewI {
        return new HeaderView($this->getLang());
    }

    protected abstract function getContent(): string;
}