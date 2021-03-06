<?php


namespace model;


use model\language\AppLanguage;
use model\language\LanguageI;
use model\settings\App;
use model\settings\AppSettings;
use model\utility\StringUtility;
use model\utility\UrlUtility;
use view\View;

class Router {
    public function __construct(array $server) {
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

        $view = "\\view\\" . $app . "\\ErrorView";

        if ((!isset($url[0]) || $url[0] === "") && $app == App::WEB) $view = "\\view\\" . $app . "\\HomeView";
        else
            for ($i = count($url) - 1; $i >= 0; $i--) {
                $url[0] = ucfirst($url[0]);
                $viewName = "view\\" . $app . "\\" . implode("\\", $url) . "View";

                if ($this->viewExists($viewName)) {
                    $view = $viewName;
                    break;
                } else {
                    array_shift($url);
                }
            }
        $this->view = new $view($lang);
    }

    private function viewExists(string $path): string {
        return file_exists(StringUtility::instance()->backSlashesToNormal($path.".php"))&& class_exists($path) ? $path : "";
    }

    public function getView(): View {
        return $this->view;
    }
}