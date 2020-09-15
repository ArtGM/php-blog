<?php
namespace Blog\Config;

use PDO;

/**
 * Class DatabaseFactory
 * @package Blog\src\Config
 */
class DatabaseFactory
{
    /**
     * @return PDO
     */
    public static function dbConnect()
    {
        $database = new PDO('mysql:host=' . DB_HOST . ';dbname=' . DB_NAME . ';charset=utf8', DB_USER, DB_PASS);
        $database->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $database;
    }
}
