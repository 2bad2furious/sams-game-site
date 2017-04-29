<?php


namespace model;


use model\settings\AppSettings;
use model\settings\HeaderTypes;

final class File {
    private $filename;
    private $extension;

    public function __construct(string $request) {
        $this->filename = $request;
        $arr = explode(".", $this->filename);
        $this->extension = $arr[count($arr) - 1];
    }

    public function read(): bool {
        if (!$this->isValidExtension()) {
            header(HeaderTypes::FORBIDDEN);
            return false;
        }else if (!is_file($this->filename)) {
            header(HeaderTypes::NOT_FOUND);
            return false;
        }
        header(HeaderTypes::OK);
        header("Cache-Control: public"); // needed for internet explorer
        header("Content-Transfer-Encoding: Binary");
        header("Content-Length:" . filesize($this->filename));
        header("Content-Disposition: attachment; filename=" . $this->filename);
        readfile($this->filename);
        return true;
    }

    private function isValidExtension(): bool {
        if (in_array($this->extension, AppSettings::FORBIDDEN_EXTENSIONS)) return false;
        return true;
    }
}