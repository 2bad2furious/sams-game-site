<?php


namespace model;


use model\settings\AppSettings;

final class File {
    private $filename;
    private $extension;

    public function __construct(string $request) {
        $this->filename = $request;
        $arr = explode(".", $this->filename);
        $this->extension = $arr[count($arr) - 1];
    }

    public function read(): bool {
        if (!$this->isValidExtension()) throw new \Exception("Invalid file extension");
        if (!is_file($this->filename)) return false;
        header(HTTPHeaderTypes::OK);
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