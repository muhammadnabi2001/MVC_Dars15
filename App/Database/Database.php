<?php
namespace App\Database;
use PDO;
class Database
{
    public static $host = 'localhost';
    public static $username = 'root';
    public static $password = 'root';
    public static $dbname = 'php_darslar';
    public static $connect;
    public static function connect() 
    {
        self::$connect = new PDO("mysql:host=".self::$host.";dbname=".self::$dbname, self::$username, self::$password);
        return self::$connect;
    }
}
