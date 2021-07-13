<?php

class ImportDAO extends BaseDAO
{
    protected static $tableName = "imports";

    /* Get the last import for one admin thanks to its id */
    public static function getDateLastImportAdmin($id_admin)
    {
        $pdo = Database::getPdo();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "SELECT date_import FROM imports WHERE fk_id_admin = $id_admin ORDER BY date_import DESC LIMIT 1";
        $result = $pdo->query($sql);
        $result->setFetchMode(PDO::FETCH_ASSOC);

        if ($result->rowcount() == 1) {

            $date = $result->fetch();
        } else {
            $date['date_import'] = "Pas de première importation";
        }

        Database::disconnect();


        return $date['date_import'];
    }

    /* Get the number of import for one admin thanks to its id */
    public static function getNumberImportAdmin($id_admin)
    {
        $pdo = Database::getPdo();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "SELECT COUNT(fk_id_admin) FROM `imports` WHERE fk_id_admin = ?";
        $result = $pdo->prepare($sql);
        $result->setFetchMode(PDO::FETCH_ASSOC);

        $result->execute(
            [
                $id_admin
            ]
        );

        $number = $result->fetch();

        Database::disconnect();

        return $number['COUNT(fk_id_admin)'];
    }

    /* Get the date of import for one article thanks to its id */
    public static function getDateImportArticle($id_article)
    {
        $pdo = Database::getPdo();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "SELECT date_import FROM `imports` WHERE fk_id_article = $id_article";
        $result = $pdo->query($sql);
        $result->setFetchMode(PDO::FETCH_ASSOC);

        if ($result->rowcount() == 1) {

            $date = $result->fetch();
        } else {
            $date['date_import'] = "Pas de première importation";
        }

        Database::disconnect();


        return $date['date_import'];
    }
}
