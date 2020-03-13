<?php
// namespace Blog\src\config;
require('config.php');

class DatabaseFactory
{
    public static function dbConnect()
    {
        $db = new PDO('mysql:host='. DB_HOST .';dbname='. DB_NAME, DB_USER, DB_PASS);
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $db;
    }
}
