<?php

class CityDAO extends BaseDAO
{
    protected static $tableName = "cities";

    /* Create a new city */
    public static function createCity($city)
    {
        $pdo = Database::getPdo();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "INSERT INTO cities (name_city) values(?)";
        $q = $pdo->prepare($sql);
        $q->execute(
            [
                $city->getName_city(),
            ]
        );
        Database::disconnect();
    }
}
