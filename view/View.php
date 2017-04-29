<?php


namespace view;




use model\utility\Syntax;

abstract class View implements ViewI {
    protected function replaceTags(string $input,Syntax $syntax): string {
        $str = $input;


        $beglen = strlen($syntax->getSyntaxBeginning()) - 1;

        $endlen = strlen($syntax->getSyntaxEnd()) - 1;

        $regex = $syntax->getWhole();

        $matches = null;
        preg_match_all($regex, $str, $matches);
        foreach ($matches[0] as $match) {
            $var = substr($match, $beglen, strlen($match) - $beglen - $endlen);
            $replacement = ((isset($this->$var) && is_string($this->$var)) ? $this->$var : "");
            $str = str_replace($match, $replacement, $str);
        }

        return $str;
    }

    protected function runScript(string $path) {
        ob_start(function () {});
        require $path;
        $str = ob_get_flush();
        return $str;
    }

    public function output(): string {
        return $this->replaceTags($this->preOutput(),Syntax::createDefault());
    }

    abstract protected function preOutput(): string;

}