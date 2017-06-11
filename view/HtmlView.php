<?php


namespace view;


use model\settings\HeaderTypes;
use model\utility\Syntax;

abstract class HtmlView extends View {


    protected function replaceTags(string $input, Syntax $syntax): string {
        $str = $input;

        $beglen = strlen($syntax->getSyntaxBeginning()) - 1;

        $endlen = strlen($syntax->getSyntaxEnd()) - 1;

        $regex = $syntax->getWhole();

        foreach ($this->getMatches($regex, $str) as $match) {
            $methodname = "get" . ucfirst(substr($match, $beglen, strlen($match) - $beglen - $endlen));
            $value = null;
            $replacement = (method_exists($this, $methodname) && is_string($value = $this->{$methodname}())) ? $value : "";
            $str = str_replace($match, $replacement, $str);
            //var_dump($str);
        }
        return $str;
    }

    private function getMatches(string $regex, string $str): array {
        $matches = array();
        preg_match_all($regex, $str, $matches);
        return $matches[0];
    }

    //TODO delete when done
    protected function runScript(string $path):string {
        $str = "";
        if(!file_exists($path)) throw new \Exception("File does not exist");
        ob_start(function () {
        });
        try {
            require $path;
            $str = ob_get_clean();
        } catch (\Throwable $ex) {
            ob_end_clean();
            throw $ex;
        }

        return $this->replaceTags($str, Syntax::createDefault());
    }

    protected final function getContentHeader(): string {
        return HeaderTypes::CONTENT_HTML;
    }

    public function getOutput(): string {
        return $this->replaceTags($this->getHtmlContent(), Syntax::createDefault());
    }

    protected abstract function getHtmlContent(): string;
}