<?php

namespace model\settings;

class AppSettings {
    const DEFAULT_APP = App::WEB;

    const FORBIDDEN_EXTENSIONS = array("php","phtml","gitignore","htaccess");

    const DEFAULT_AFTER_TITLE = " GAME xd";
    const DEFAULT_FAVICON = "/favicon.ico";
    const DEFAULT_IMAGE = "img.png";

    const DEFAULT_LANGUAGE = "cs";

    const SALT = "$\\_//$";

    const DEFAULT_TOKEN_INDEX = "HTTP_TOKEN";
}