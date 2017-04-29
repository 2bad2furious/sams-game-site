<?php


namespace view\html;


use view\View;

class HeadView extends View{
    protected $favicon;
    protected $title;
    protected $description;
    protected $image;

    public function setFavicon(string $favicon) {
        $this->favicon = $favicon;
    }

    public function setTitle(string $title) {
        $this->title = $title;
    }

    public function setDescription(string $description) {
        $this->description = $description;
    }

    public function setImage(string $image) {
        $this->image = $image;
    }

    protected function preOutput(): string {
        return file_get_contents("templates/head.phtml");
    }
}