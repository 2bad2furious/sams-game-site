<?php


namespace model;


use model\language\AppLanguage;
use model\language\LanguageI;
use model\settings\App;
use model\settings\AppSettings;
use model\utility\UrlUtility;
use view\View;

class Router {
    public function __construct(array $server, array $session, array $post, array $get, array $files, array $cookie) {
        $url = explode("/", $server["REQUEST_URI"]);
        array_shift($url);

        $default_lang = AppLanguage::getInitLanguage((string)@$server["HTTP_ACCEPT_LANGUAGE"], AppSettings::DEFAULT_LANGUAGE);

        if (!isset($url[0]) || !$url[0]) {
            UrlUtility::instance()->redirect($default_lang->getCode());
        }

        $appLanguage = AppLanguage::isLanguage($url[0]);
        if ($appLanguage == null || !$appLanguage instanceof LanguageI) {
            $lang = $default_lang;
        } else {
            $lang = $appLanguage;

            array_shift($url);
        }

        $app = AppSettings::DEFAULT_APP;

        if (isset($url[0]) && App::isAnAppType($url[0])) {
            $app = $url[0];
            array_shift($url);
        }

        $view = "\\view\\" . $app . "\\ErrorPresenter";

        if ((!isset($url[0]) || $url[0] === "") && $app == App::WEB) $view = "\\view\\" . $app . "\\HomeView";
        else
            for ($i = count($url) - 1; $i >= 0; $i--) {
                $viewName = "view\\" . $app . "\\" . implode("\\", $url) . "View";

                if ($this->viewExists($viewName)) {
                    $view = $viewName;
                    break;
                } else {
                    array_shift($url);
                }
            }
        $this->view = new $view($server, $session, $post, $get, $cookie, $files, $lang);
    }

    private function viewExists(string $path): bool {

    }

    public function getView(): View {
        return $this->view;
    }
}