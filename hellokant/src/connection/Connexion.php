<?php

namespace iutnc\hellokant\query;

class ConnectionFactory
{
    protected static $connection;

    public static function makeConnection(array $conf)
    {
        $dsn = "mysql:host={$conf['host']};dbname={$conf['database']};charset={$conf['charset']}";
        $options = [
            \PDO::ATTR_PERSISTENT => true,
            \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION,
            \PDO::ATTR_EMULATE_PREPARES => false,
            \PDO::ATTR_STRINGIFY_FETCHES => false,
        ];

        self::$connection = new \PDO($dsn, $conf[''], $conf[''], $options);
        return self::$connection;
    }

    public static function getConnection()
    {
        return self::$connection;
    }
}
