<?php


namespace model\user;


class UserNotUnique {
    protected $username = false;
    protected $email = false;

    /**
     * UserNotUnique constructor.
     * @param bool $username
     * @param bool $email
     */
    public function __construct(bool $username, bool $email) {
        $this->username = $username;
        $this->email = $email;
    }

    /**
     * @return bool
     */
    public function username(): bool {
        return $this->username;
    }

    /**
     * @return bool
     */
    public function email(): bool {
        return $this->email;
    }


}