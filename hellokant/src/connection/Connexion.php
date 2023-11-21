<?php

namespace iutnc\hellokant\query;

class ConnectionFactory
{
    protected static $connection;

    public static function makeConnection(array $conf)
    {
        self::$config = $conf;

        $dbtype = self::$config('db_driver');
        $host = self::$config('host');
        $dbname = self::$config('dbname');
        $user = self::$config('db_user');
        $pass = self::$config('db_password');
        $port = ((isset(self::$config['dbport'])) ? self::$config['dbport'] : null);
        $dsn = "$dbtype:host=$host;dbname=$dbname";
        try{
            self::$db = new PDO($dsn,$user,$pass,array(
            PDO::ATTR_PERSISTENT => true,
            PDO::ATTR_ERRMODE => 
            PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_EMULATE_PREPARES => false,
            PDO::ATTR_STRINGIFY_FETCHES => false,
            ))

            self::$db->prepare(query:'SET NAMES \'UTF8\'')->execute();
        }
            
        catch(\PDOException $e){
            throw new DBException(message: "Connection: $dsn", $e->getMessage(). '</br>');
        }
        
    }

    public static function getConnection()
    {
        return self::$connection;
    }
}
