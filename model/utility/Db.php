<?php
/**
 * Created by PhpStorm.
 * User: martinmacura & samuelkodytek
 * Date: 15.02.2017
 * Time: 13:18
 */

namespace model\utility\Db;

use model\settings\DbSettings;
use PDO;

class Db extends PDO {
    private static $sharedInstance;

    public static function instance(): Db {
        if (!self::$sharedInstance)
            self::$sharedInstance = new Db(
                "mysql:host=" . DbSettings::HOST . ";dbname=" . DbSettings::DATABASE . ";charset=" . DbSettings::CHARSET,
                DbSettings::USERNAME,
                DbSettings::PASSWORD,
                DbSettings::OPTIONS
            );

        return self::$sharedInstance;
    }

    /**
     * @param string $query
     * SQL query
     * @param array $parameters
     * Parameters for the SQL query (SQL injection prevention)
     * @return array
     * Returns one row
     */
    public function single(string $query, array $parameters = array()): array {
        $result = $this->createObject($query, $parameters)->fetch();
        return ($result) ? $result : array();
    }

    public function customQuery(string $query, array $parameters = array()): int {
        return $this->createObject($query, $parameters)->rowCount();
    }

    public function add(string $table, array $data): int {
        return $this->createObject("INSERT INTO `" . $table . "` (" . implode(',', array_keys($data)) . ")
            VALUES (" . str_repeat('?,', count($data) - 1) . ",?)", array_values($data))->rowCount();
    }

    public function update(string $table, array $data, string $where, array $params): int {
        return self::createObject("UPDATE " . $table . " SET `" . implode('`= ?, `', array_keys($data)) . "`
            = ? WHERE " . $where, array_merge(array_values($data), $params))->rowCount();
    }

    /**
     * @param string $query
     * SQL query
     * @param array $parameters
     * Parameters for the SQL query (SQL injection prevention)
     * @return array
     * Returns multiple rows
     */
    public function multiple(string $query, array $parameters = array()): array {
        $result = $this->createObject($query, $parameters)->fetchAll();
        return ($result) ? $result : array();
    }

    /**
     * @param string $query
     * SQL query
     * @param array $parameters
     * Parameters for the SQL query (SQL injection prevention)
     * @return \PDOStatement
     * Returns the executed statement
     */
    public function createObject(string $query, array $parameters = array()): PDOStatement {
        $PDOquery = $this->prepare($query);
        $PDOquery->execute($parameters);
        return $PDOquery;
    }
}