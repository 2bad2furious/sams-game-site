<?php


namespace model\user;


use model\settings\AppSettings;
use model\utility\Db;

final class User {
    private $username;
    private $email;
    private $password;
    private $time;
    private $ip;

    public static function getUserByLogin(string $username, string $password, string $ip): ?User {
        $data = Db::instance()->single("SELECT * FROM user WHERE username LIKE ?", array($username));
        if ($data)
            return password_verify($password, $data["password"]) ? new User($data["username"], $data["password"], $data["email"], $ip) : null;
        return null;
    }

    public static function registerUser(string $username, string $password, string $email, string $ip) {
        $usernameExists = boolval(Db::instance()->single("SELECT * FROM user WHERE username LIKE ?", array($username)));
        $emailExists = boolval(Db::instance()->single("SELECT * FROM user WHERE email LIKE ?", array($email)));
        $emailRegex = !boolval(preg_match(AppSettings::EMAIL_SYNTAX, $email));
        $usernameRegex = boolval(preg_match(AppSettings::USERNAME_SYNTAX, $username));
        $passwordAllowedRegex = boolval(preg_match(preg_quote(AppSettings::PASSWORD_ALLOWED_SYNTAX), $password));
        $passwordMustRegex = !boolval(preg_match(AppSettings::PASSWORD_MUST_SYNTAX, $password));
        
        if ($usernameExists || $usernameRegex || $emailExists || $emailRegex || $passwordAllowedRegex || $passwordMustRegex) return new RegisterFailure($usernameExists, $usernameRegex, $emailExists, $emailRegex, $passwordAllowedRegex, $passwordMustRegex);

        $hashedPassword = self::hash($password);

        $creation = Db::instance()->add("user", array("username" => $username, "password" => $hashedPassword, "email" => $email));

        if ($creation) return new User($username, $hashedPassword, $email, $ip);

        return null;
    }


    private static function hash(string $string): string {
        return password_hash($string, PASSWORD_BCRYPT);
    }

    /**
     * User constructor.
     * @param string $username
     * @param string $password
     * @param string $email
     * @param string $ip
     */
    private function __construct(string $username, string $password, string $email, string $ip) {
        $this->username = $username;
        $this->password = $password;
        $this->email = $email;
        $this->ip = $ip;
        $this->time = time();
    }

    private function exists(): bool {
        return boolval($this->getInfo());
    }

    private function arePasswordsSame(): bool {
        $data = $this->getInfo();
        if (!$data) return false;
        return $this->password == $data["password"];
    }

    private function getInfo(): array {
        return Db::instance()->single("SELECT * FROM user WHERE email LIKE ? AND username LIKE ?", array($this->email, $this->username));
    }

    /* TODO */
    private function checkTimeout(int $time): bool {
        return time() < ($this->time + $time);
    }

    public static function isUserOk(?User $user, string $ip, int $time): bool {
        if (!$user instanceof User) return false;
        return $user->exists() && $user->arePasswordsSame() && $user->areIPsSame($ip) && $user->checkTimeout($time) && $user->refreshTime();
    }

    private function refreshTime(): bool {
        return boolval($this->time = time());
    }

    private function areIPsSame(string $ip): bool {
        return $ip == $this->ip;
    }

    public function getUsername(): string {
        return $this->username;
    }

    private function setInfo(): void {
        $data = $this->getInfo();
    }

}