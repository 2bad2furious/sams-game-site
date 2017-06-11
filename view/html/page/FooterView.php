<?php


namespace view\html\page;


use view\glob\page\FooterViewI;
use view\HtmlView;

class FooterView extends HtmlView implements FooterViewI {

    protected function getHtmlContent(): string {
        return $this->runScript("templates/footer.phtml");
    }

    protected function main(): void {
        // TODO: Implement main() method.
    }
}