<?php

class PackageDAO extends BaseDAO
{
    protected static $tableName = "packages";

    /* Get the packages by day */
    public static function getPackagesByDay($date)
    {

        $pdo = Database::getPdo();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "SELECT * FROM packages WHERE date_reception LIKE '$date%' ";
        $result = $pdo->query($sql);

        if ($result->rowcount() == 1) {
            $packagesByDay = $result->fetchAll(PDO::FETCH_CLASS, 'Package');
        } else {
            $packagesByDay = new Package;
        }

        Database::disconnect();
        return $packagesByDay;
    }
}
