<?php

namespace presenter;

use Exception;
use model\Header;
use model\language\AppLanguage;
use model\language\LanguageI;
use model\settings\App;
use model\settings\AppSettings;
use model\settings\HeaderTypes;
use model\StringArray;
use model\user\User;
use model\utility\StringUtility;
use model\utility\UrlUtility;
use view\ViewI;

abstract class Presenter {
    /**
     * @param array $post
     * @param array $get
     * @param array $files
     * @param array $server
     * @return Presenter
     * @throws Exception
     */
    public static function route(array $post, array $get, array $files, array $server, array $session): Presenter {
        $serverArr = new StringArray($server);

        $url = explode("/", $serverArr->get("REQUEST_URI"));
        array_shift($url);

        if (!isset($url[0]) || !$url[0]) {
            UrlUtility::instance()->redirect(AppLanguage::getInitLanguage($serverArr->get("HTTP_ACCEPT_LANGUAGE"), AppSettings::DEFAULT_LANGUAGE)->getCode());
        }

        $appLanguage = AppLanguage::isLanguage($url[0]);
        if ($appLanguage == null || !$appLanguage instanceof LanguageI) {
            $lang = AppLanguage::getInitLanguage($serverArr->get("HTTP_ACCEPT_LANGUAGE"), AppSettings::DEFAULT_LANGUAGE);
            if ($lang == null) throw new Exception("language not set");
        } else {
            $lang = $appLanguage;

            array_shift($url);
        }

        $app = AppSettings::DEFAULT_APP;

        if (isset($url[0]) && App::isAnAppType($url[0])) {
            $app = $url[0];
            array_shift($url);
        }

        $presenter = "\\presenter\\" . $app . "\\ErrorPresenter";

        if ((!isset($url[0]) || $url[0] === "") && $app == App::WEB) $presenter = "\\presenter\\" . $app . "\\HomePresenter";
        else
            for ($i = count($url) - 1; $i >= 0; $i--) {
                $presenterName = "presenter\\" . $app . "\\" . implode("\\", $url) . "Presenter";

                if (self::presenterExists($presenterName)) {
                    $presenter = $presenterName;
                    break;
                } else {
                    array_shift($url);
                }
            }
        return new $presenter($post, $get, $files, $serverArr, $session, $url, $lang);
    }

    private static function presenterExists(string $path): bool {
        return file_exists(StringUtility::instance()->backSlashesToNormal($path) . ".php") && class_exists(StringUtility::instance()->normalSlashesToBack($path));
    }

    protected $view;
    protected $server = array();
    protected $headers = array();
    protected $post = array();
    protected $get = array();
    protected $files = array();
    protected $parameters = array();
    protected $session = array();
    protected $user = null;
    protected $contentType = HeaderTypes::CONTENT_HTML;
    protected $status = HeaderTypes::OK;

    /**
     * Presenter constructor.
     * @param array $post
     * @param array $get
     * @param array $files
     * @param array $server
     * @param array $session
     * @param array $parameters
     * @param LanguageI $lang
     * @throws Exception
     * @internal param App|string $app
     */
    private final function __construct(array $post, array $get, array $files, StringArray $server, array $session, array $parameters, LanguageI $lang) {

        if (isset($session["user"])) {
            if (!$session["user"] instanceof User) {
                $this->logout();
            } else if (User::isUserOK($session["user"], $server->get("REMOTE_ADDR"), AppSettings::USER_LOGOUT_TIME)) {
                $this->user = $session["user"];
            } else {
                $this->loginTimeOut();
            }
        }

        $this->post = $post;
        $this->get = $get;
        $this->server = $server;
        $this->session = $session;
        $this->files = $files;
        $this->parameters = $parameters;
        $this->lang = $lang;

        $this->main();
    }

    public function output(): string {
        $this->headers();
        if (!$this->view || !$this->view instanceof ViewI) throw new Exception("view not set");
        return $this->view->output();
    }

    protected function headers(): void {
        $this->addHeader($this->contentType);
        $this->addHeader($this->status);

        foreach ($this->headers as $v) {
            header($v);
        }
    }

    protected final function addHeader(string $string) {
        $this->headers[] = $string;
    }

    protected final function loginTimeOut() {
        $this->status = HeaderTypes::LOGIN_TIMEOUT;
        $this->logout();
    }

    protected final function logout() {
        unset($_SESSION["user"]);
    }

    protected final function redirect(string $url) {
        UrlUtility::instance()->redirect($url);
        exit();
    }

    /**
     *TODO set view
     */
    abstract protected function main(): void;

}