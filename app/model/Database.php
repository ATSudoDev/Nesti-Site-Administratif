<?php

class Database
{

    private static $pdo = null;

    /* Connection of the PDO */
    public static function connect()
    {

        try {
            self::$pdo = new PDO(DSN, USERNAME, PWD, [PDO::ATTR_PERSISTENT => true]);
        } catch (PDOException $e) {
            die($e->getMessage());
        }
    }

    /* Disconnection of the PDO */
    public static function disconnect()
    {
        self::$pdo = null;
    }

    /**
     * Get the value of pdo
     */
    public static function getPdo()
    {
        if (self::$pdo == null) {
            self::connect();
        }
        return self::$pdo;
    }
}
