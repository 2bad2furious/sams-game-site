<?php


namespace model\utility;


final class Syntax {

    public static function createDefault():Syntax{
        /* /!{([^{}!])*}/ */
        return new Syntax("/!{","([^{}!])*", "}/");
    }

    private $syntaxBeginning = "";
    private $syntaxEnd = "";
    private $syntaxDelimiter = "";

    /**
     * Syntax constructor.
     * @param string $syntaxBeginning
     * @param string $syntaxEnd
     * @param string $syntaxDelimiter
     */

    public function __construct(string $syntaxBeginning,string $syntaxDelimiter,string $syntaxEnd) {
        $this->syntaxBeginning = $syntaxBeginning;
        $this->syntaxEnd = $syntaxEnd;
        $this->syntaxDelimiter = $syntaxDelimiter;
    }


    /**
     * @return string
     */
    public function getSyntaxBeginning(): string {
        return $this->syntaxBeginning;
    }

    /**
     * @return string
     */
    public function getSyntaxEnd(): string {
        return $this->syntaxEnd;
    }

    /**
     * @return string
     */
    public function getSyntaxDelimiter(): string {
        return $this->syntaxDelimiter;
    }

    public function getWhole():string{
        return $this->syntaxBeginning.$this->getSyntaxDelimiter().$this->getSyntaxEnd();
    }
}