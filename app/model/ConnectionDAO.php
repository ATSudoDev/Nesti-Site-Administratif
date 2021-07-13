<?php
class ConnectionDAO extends BaseDAO
{
    /* Check the username of one user */
    public static function checkUsername($username)
    { {
            $pdo = Database::getPdo();

            $sql = "SELECT * FROM users WHERE username_user = $username";
            $result = $pdo->prepare($sql);

            $result->setFetchMode(PDO::FETCH_CLASS, 'User');

            if ($result) {
                $user = $result->fetch();
            } else {
                $user = '';
            }

            Database::disconnect();

            return $user;
        }
    }

    /* Add a new log for one user */
    public static function addLogUser($id_user)
    {
        $pdo = Database::getPdo();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "INSERT INTO logs_users (date_connection_log_user, fk_id_user) VALUES (CURRENT_TIMESTAMP, $id_user)";
        $q = $pdo->prepare($sql);
        $q->execute();

        Database::disconnect();
    }

    /* Fetch data of one user in DB */
    public static function findOneUserBy($username)
    {
        $pdo = Database::getPdo();

        $sql = "SELECT * FROM users WHERE username_user = $username";
        $result = $pdo->prepare($sql);
        $result->setFetchMode(PDO::FETCH_CLASS, 'User');

        if ($result) {
            $user = $result->fetch();
        } else {
            $user = '';
        }

        Database::disconnect();

        return $user;
    }
}
