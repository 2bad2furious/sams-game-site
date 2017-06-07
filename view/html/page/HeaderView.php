<?php


namespace view\html\page;


use view\glob\page\HeaderViewI;
use view\HtmlView;

class HeaderView extends HtmlView implements HeaderViewI {

    protected function getHtmlContent(): string {
        return "header lol";
    }

    protected function main(): void {
        // TODO: Implement main() method.
    }
}