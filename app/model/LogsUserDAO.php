<?php

class LogsUserDAO extends BaseDAO
{
    protected static $tableName = "logs_users";

    /* Fetch all data of the articles in DB */
    public static function readAllLogsUsers()
    {
        $pdo = Database::getPdo();
        $sql = "SELECT * FROM `logs_users` ";
        $result = $pdo->query($sql);

        if ($result) {
            $arrayLogsUsers = $result->fetchAll(PDO::FETCH_CLASS, 'LogsUser');
        } else {
            $arrayLogsUsers = [];
        }

        return $arrayLogsUsers;
    }

    /* Get the last connection of one user thanks to its id */
    public static function getLastConnectionUser($id_user)
    {
        $pdo = Database::getPdo();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "SELECT date_connection_log_user FROM logs_users WHERE fk_id_user = $id_user ORDER BY date_connection_log_user DESC LIMIT 1";
        $result = $pdo->query($sql);
        $result->setFetchMode(PDO::FETCH_ASSOC);

        if ($result->rowcount() == 1) {

            $date = $result->fetch();
        } else {
            $date['date_connection_log_user'] = "Pas de première connection";
        }

        Database::disconnect();


        return $date['date_connection_log_user'];
    }

    /* Get all the connections of one user thanks to its id */
    public static function getConnectionsUser($id_user)
    {
        $pdo = Database::getPdo();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "SELECT date_connection_log_user FROM `logs_users` WHERE fk_id_user = $id_user";
        $result = $pdo->query($sql);
        $result->setFetchMode(PDO::FETCH_ASSOC);

        if ($result->rowcount() >= 1) {

            $date = $result->fetchAll();
        } else {
            $date = [];
        }

        Database::disconnect();

        return $date;
    }
}
