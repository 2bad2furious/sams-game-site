<?php


namespace view\html;


use presenter\page\FooterPresenter;
use presenter\page\HeaderPresenter;
use presenter\page\HeadPresenter;
use view\HtmlView;

abstract class PageView extends HtmlView {
    protected $headPresenter;
    protected $headerPresenter;
    protected $footerPresenter;

    protected $html_lang = "";
    protected $title = "";
    protected $favicon = "";
    protected $image = "";
    protected $published_time = "";
    protected $modified_time = "";
    protected $description = "";
    protected $url = "";
    protected $author = "";
    protected $keywords = "";
    protected $site_name = "";
    protected $type = "";

    protected $head = "";
    protected $header = "";
    protected $footer = "";

    protected $content = "";

    protected function main(): void {
        $this->headPresenter = new HeadPresenter($this->lang, $this->server);
        $this->headerPresenter = new HeaderPresenter();
        $this->footerPresenter = new FooterPresenter();



        $this->header = $this->runScript("templates/header.phtml");
        $this->head = $this->runScript("templates/head.phtml");
        $this->footer = $this->runScript("templates/footer.phtml");


        $this->setContent();
    }

    abstract protected function setContent(): void;

    protected function getContent(): string {
        return $this->runScript("templates/page.phtml");
    }
}