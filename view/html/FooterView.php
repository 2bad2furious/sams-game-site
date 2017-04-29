<?php


namespace view\html;


use view\View;

class FooterView extends View{

    protected function preOutput(): string {
        return file_get_contents("templates/footer.phtml");
    }
}