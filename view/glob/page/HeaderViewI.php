<?php


namespace view\glob\page;
use view\ViewI;

interface HeaderViewI extends ViewI{
    public function setLogged(bool $val);
    public function setUsername(string $username);
}