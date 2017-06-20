<?php


namespace model;


use JsonSerializable;
use model\user\User;
use model\utility\Db;
use Serializable;

final class Map implements JsonSerializable, Serializable {
    private $id = 0;
    private $author;
    private $json = "";
    private $xml = "";

    /**
     * Map constructor.
     * @param int $id
     * @param User|null $author
     * @param string $json
     * @param string $xml
     * @internal param $ 0User $author
     */
    private function __construct($id, ?User $author, $json, $xml) {
        $this->id = $id;
        $this->author = $author;
        $this->json = $json;
        $this->xml = $xml;
    }

    //TODO implement
    public static function validateJson(string $json): bool {
        return true;
    }

    public static function createNewMap(string $json): bool {
        if (!self::validateJson($json)) throw new \Exception("JSON not valid");

        $author = User::extractUser();

        $xml = self::xmlFromJson($json);
        return (Db::instance()->add("map",
            array("author_id" => $author->getId())));
    }

    private static function xmlFromJson(string $json): string {
        return "";
    }

    public static function editMap(int $id, string $json): bool {
        if (!self::validateJson($json)) throw new \Exception("JSON not valid");
        if (!self::exists($id) || !self::hasRights($id)) throw new \Exception("NOT exists or you dont have rights");

        return Db::instance()->customQuery("UPDATE map SET json = ?, xml = ? WHERE map_id = ?", array($json, self::xmlFromJson($json)));
    }

    public static function hasRights(int $id): bool {
        return boolval(Db::instance()->single("SELECT * FROM map WHERE map_id = ? AND author_id = ?", array($id, User::extractUser()->getUsername())));
    }

    public static function exists(int $id): bool {
        return boolval(Db::instance()->single("SELECT * FROM map WHERE map_id = ?", array($id)));
    }

    public static function get(int $id): Map {
        if (!self::exists($id)) throw new \Exception("Map does not exist or you dont have rights");

        $data = Db::instance()->single("SELECT * FROM map WHERE map_id=?", array($id));
        if ($data) {
            return new Map($data["map_id"], User::getById($data["author_id"]), $data["json"], $data["xml"]);
        }
        throw new \Exception("MAP NOT FOUND");
    }

    private static function jsonFromXml(string $xml): string {
        return "";
    }

    /**
     * String representation of object
     * @link http://php.net/manual/en/serializable.serialize.php
     * @return string the string representation of the object or null
     * @since 5.1.0
     */
    public function serialize() {

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