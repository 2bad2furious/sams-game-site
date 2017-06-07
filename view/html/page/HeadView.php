<?php


namespace view\html\page;


use view\glob\page\HeadViewI;
use view\HtmlView;

class HeadView extends HtmlView implements HeadViewI {

    protected function getHtmlContent(): string {
        return "head xd";
    }

    protected function main(): void {
        // TODO: Implement main() method.
    }
}