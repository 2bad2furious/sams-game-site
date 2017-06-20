<?php


namespace model\user;


use model\settings\AppSettings;
use model\utility\Db;

final class User implements \Serializable, \JsonSerializable {
    private static $extractedUser;
    private $id;
    private $username;
    private $email;
    private $password;
    private $time;
    private $ip;

    public static function loginUser(string $username, string $password): ?User {
        $data = Db::instance()->single("SELECT * FROM user WHERE username LIKE ?", array($username));
        if ($data)
            if (password_verify($password, $data["password"])) {
                $user = new User($data["user_id"], $data["username"], $data["password"], $data["email"], $_SERVER["REMOTE_ADDR"]);
                $_SESSION["user"] = $user;
                return $user;
            }
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
        if ($creation) return new User($id = Db::instance()->lastInsertId(), $username, $hashedPassword, $email, $ip);

        return null;
    }


    private static function hash(string $string): string {
        return password_hash($string, PASSWORD_BCRYPT);
    }

    /**
     * User constructor.
     * @param int $id
     * @param string $username
     * @param string $password
     * @param string $email
     * @param string $ip
     */
    private function __construct(int $id, string $username, string $password, string $email, string $ip) {
        $this->username = $username;
        $this->password = $password;
        $this->email = $email;
        $this->ip = $ip;
        $this->time = time();
        $this->id = $id;
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

    //todo pass a db wrapper to it
    public static function isUserOk(?User $user): bool {
        if (!$user instanceof User) return false;
        return $user->exists() && $user->arePasswordsSame() && $user->areIPsSame($_SERVER["REMOTE_ADDR"]) && $user->checkTimeout(AppSettings::USER_LOGOUT_TIME) && $user->refreshTime();
    }

    private function refreshTime(): bool {
        return boolval($this->time = time());
    }

    private function areIPsSame(string $ip): bool {
        return $ip == $this->ip;
    }

    public static function isLoggedIn(): bool {
        return self::extractUser() instanceof User;
    }

    public static function extractUser():?User {
        if (!self::$extractedUser instanceof User) {
            $user = @$_SESSION["user"];
            if ($user == null || !$user instanceof User) {
                $user = null;
                self::logout();
            } else {
                if (!User::isUserOk($user)) {
                    self::logout();
                    $user = null;
                }
            }
            self::$extractedUser = $user;
        }
        return self::$extractedUser;
    }

    public static function logout() {
        unset($_SESSION["user"]);
    }

    public static function getById(int $id): ?User {
        $data = Db::instance()->single("SELECT * FROM user WHERE user_id = ?", array($id));
        if ($data) {
            return new User($data["user_id"], $data["username"], "", $data["email"], "");
        }
        return null;
    }

    public function getUsername(): string {
        return $this->username;
    }

    public function getId(): int {
        return $this->id;
    }

    /**
     * String representation of object
     * @link http://php.net/manual/en/serializable.serialize.php
     * @return string the string representation of the object or null
     * @since 5.1.0
     */
    public function serialize() {
        // TODO: Implement serialize() method.
    }

    /**
     * Constructs the object
     * @link http://php.net/manual/en/serializable.unserialize.php
     * @param string $serialized <p>
     * The string representation of the object.
     * </p>
     * @return void
     * @since 5.1.0
     */
    public function unserialize($serialized) {
        // TODO: Implement unserialize() method.
    }

    /**
     * Specify data which should be serialized to JSON
     * @link http://php.net/manual/en/jsonserializable.jsonserialize.php
     * @return mixed data which can be serialized by <b>json_encode</b>,
     * which is a value of any type other than a resource.
     * @since 5.4.0
     */
    function jsonSerialize() {
        // TODO: Implement jsonSerialize() method.
    }
}