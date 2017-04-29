<?php


namespace model\utility;


class SessionSetter {
    private $token;

    /**
     * SessionSetter constructor.
     * @param null|string $token
     */
    public function __construct(?string $token) {
        $this->token = $token;
    }


    public function getId():?string {
        if ($this->token != null) {
            return $this->token;
        }
        return null;
    }
}