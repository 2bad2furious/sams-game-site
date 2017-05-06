<?php

namespace model\settings;

class AppSettings {
    const DEFAULT_APP = App::WEB;

    const FORBIDDEN_EXTENSIONS = array("php", "phtml", "gitignore", "htaccess","sql");

    const DEFAULT_AFTER_TITLE = " GAME xd";
    const DEFAULT_FAVICON = "/favicon.ico";
    const DEFAULT_IMAGE = "img.png";

    const DEFAULT_LANGUAGE = "cs";

    const SALT = "$\\_//$";

    const DEFAULT_TOKEN_INDEX = "HTTP_TOKEN";

    const USER_LOGOUT_TIME = 1200;

    const PASSWORD_ALLOWED_SYNTAX = "#([^A-Za-z0-9\$_-&@/ß//])#";
    const PASSWORD_MUST_SYNTAX = "#(.*)#"; //TODO
    const EMAIL_SYNTAX = "#[@]#";
    const USERNAME_SYNTAX = "#[^0-9a-zA-Z_]#";

}