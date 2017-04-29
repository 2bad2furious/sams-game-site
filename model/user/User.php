<?php


namespace model\user;


use model\utility\Db\Db;

final class User {
    private $username;
    private $email;
    private $password;
    private $time;

    /**
     * User constructor.
     * @param $username
     * @param $email
     * @param $password
     */
    public function __construct(string $username, string $password, string $email) {
        $this->username = $username;
        $this->email = $email;
        $this->password = $password;
        $this->time = time();
    }

    public function create(): bool {
        if ($this->isUnique() != null) throw new \Exception("User not unique");
        return boolval(Db::instance()->add("user",
            array("username" => $this->username,
                "email", $this->email,
                "password" => $this->hash($this->password))));
    }

    public function isUnique():?UserNotUnique {
        $username = boolval(Db::instance()->single("SELECT * FROM user WHERE username LIKE ?", array($this->username)));
        $email = boolval(Db::instance()->single("SELECT * FROM user WHERE email LIKE ?", array($this->email)));
        if ($username || $email) return new UserNotUnique($username, $email);
        return null;
    }

    private function exists(): bool {
        return boolval($this->getInfo());
    }

    private function arePasswordsSame(): bool {
        $data = $this->getInfo();
        if (!$data) return false;
        return hash_equals($this->hash($this->password), $data["password"]);
    }

    private function getInfo(): array {
        return Db::instance()->single("SELECT * FROM user WHERE email LIKE ? AND username LIKE ?", array($this->email, $this->username));
    }

    private function hash(string $string): string {
        return password_hash($string, PASSWORD_BCRYPT);
    }

    private function checkTimeout(): bool {
        return time() > $this->time;
    }

    public static function isUserOk(?User $user): bool {
        if (!$user instanceof User) return false;
        return $user->exists() && $user->arePasswordsSame() && $user->checkTimeout();
    }

    public function getUsername(): string {
        return $this->username;
    }


}