<?php


namespace view\html;



use view\View;

class HomeView extends View {

    protected $kokotko;

    protected function preOutput(): string {
        return file_get_contents("templates\\home.phtml");
    }
}