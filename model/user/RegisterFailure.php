<?php


namespace model\user;


class RegisterFailure {
    protected $usernameExists = false;
    protected $usernameRegex = false;
    protected $emailExists = false;
    protected $emailRegex = false;
    protected $passwordAllowedRegex = false;
    protected $passwordMustRegex = false;

    /**
     * RegisterFailure constructor.
     * @param bool $usernameExists
     * @param bool $usernameRegex
     * @param bool $emailExists
     * @param bool $emailRegex
     * @param bool $passwordAllowedRegex
     * @param bool $passwordMustRegex
     */
    public function __construct($usernameExists, $usernameRegex, $emailExists, $emailRegex, $passwordAllowedRegex, $passwordMustRegex) {
        $this->usernameExists = $usernameExists;
        $this->usernameRegex = $usernameRegex;
        $this->emailExists = $emailExists;
        $this->emailRegex = $emailRegex;
        $this->passwordAllowedRegex = $passwordAllowedRegex;
        $this->passwordMustRegex = $passwordMustRegex;
    }

    /**
     * @return bool
     */
    public function isUsernameExists(): bool {
        return $this->usernameExists;
    }

    /**
     * @return bool
     */
    public function isUsernameRegex(): bool {
        return $this->usernameRegex;
    }

    /**
     * @return bool
     */
    public function isEmailExists(): bool {
        return $this->emailExists;
    }

    /**
     * @return bool
     */
    public function isEmailRegex(): bool {
        return $this->emailRegex;
    }

    /**
     * @return bool
     */
    public function isPasswordAllowedRegex(): bool {
        return $this->passwordAllowedRegex;
    }

    /**
     * @return bool
     */
    public function isPasswordMustRegex(): bool {
        return $this->passwordMustRegex;
    }
}