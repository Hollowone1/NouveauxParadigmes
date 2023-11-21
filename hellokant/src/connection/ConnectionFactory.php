<?php

namespace iutnc\hellokant\connection;

class ConnectionFactory
{
    protected static $config;
    protected static $db;
    protected static $connection;

    public static function makeConnection(array $conf)
    {
        self::$config = $conf;

        $dbtype = self::$config['driver'];
        $host = self::$config['host'];
        $database = self::$config['database'];
        $username = self::$config['username'];
        $password = self::$config['password'];

        $port = ((isset(self::$config['dbport'])) ? self::$config['dbport'] : null);
        $dsn = "$dbtype:host=$host;dbname=$database";
        try{
            self::$db = new \PDO($dsn,$username,$password,array(
            \PDO::ATTR_PERSISTENT => true,
            \PDO::ATTR_ERRMODE =>
            \PDO::ERRMODE_EXCEPTION,
            \PDO::ATTR_EMULATE_PREPARES => false,
            \PDO::ATTR_STRINGIFY_FETCHES => false,
            ));


            self::$db->prepare(query:'SET NAMES \'UTF8\'')->execute();
        }
            
        catch (\PDOException $e) {
            throw new DBException("Connection: $dsn " . $e->getMessage() . '</br>');
        }
        
        return self::$db;
    }

    public static function getConnection()
    {
        return self::$db;
    }
}
