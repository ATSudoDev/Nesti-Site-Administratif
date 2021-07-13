<?php

class UserDAO extends BaseDAO
{
    protected static $tableName = "users";

    /* Fetchs all data of the users in DB */
    public static function readAllUsers()
    {
        $pdo = Database::getPdo();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "SELECT * FROM users";
        $result = $pdo->query($sql);

        if ($result) {
            $arrayUsers = $result->fetchAll(PDO::FETCH_CLASS, 'User');

            foreach ($arrayUsers as $user) {
                $roles_user = RoleDAO::readUserRoles($user);
                $user->setRoles_user($roles_user);
            }
        } else {
            $arrayUsers = [];
        }
        return $arrayUsers;
    }

    /* Fetch data of one user in DB */
    public static function findOneUser($id)
    {
        $pdo = Database::getPdo();

        $sql = "SELECT * FROM users WHERE id_user = $id";
        $result = $pdo->query($sql);
        $result->setFetchMode(PDO::FETCH_CLASS, 'User');

        if ($result) {
            $user = $result->fetch();
        } else {
            $user = '';
        }

        Database::disconnect();

        return $user;
    }

    /* Create one user */
    public static function createUser($user)
    {
        $pdo = Database::getPdo();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "INSERT INTO users (username_user, password_user, lastname_user, firstname_user, email_user, 
        state_user, address1_user, address2_user, fk_id_city, postcode_user) values(?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $q = $pdo->prepare($sql);
        $q->execute(
            [
                $user->getUsername_user(),
                password_hash($user->getPassword_user(), PASSWORD_BCRYPT),
                $user->getLastname_user(),
                $user->getFirstname_user(),
                $user->getEmail_user(),
                $user->getState_user(),
                $user->getAddress1_user(),
                $user->getAddress2_user(),
                $user->getFk_id_city(),
                $user->getPostcode_user()
            ]
        );
        $last_id = $pdo->lastInsertId();
        Database::disconnect();
        return $last_id;
    }

    /* Block one user */
    public static function deleteUser($id)
    {
        $pdo = Database::getPdo();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "UPDATE users SET state_user = ? WHERE id_user = ?";
        $q = $pdo->prepare($sql);
        $q->execute(
            [
                "b",
                $id
            ]
        );
        Database::disconnect();
    }

    /* Update one user */
    public static function updateUser($user)
    {
        $pdo = Database::getPdo();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "UPDATE users SET lastname_user = ?, firstname_user = ?, state_user =?, address1_user = ?, address2_user = ?, fk_id_city = ?, postcode_user = ? WHERE id_user = ?";
        $q = $pdo->prepare($sql);
        $q->execute(
            [
                $user->getLastname_user(),
                $user->getFirstname_user(),
                $user->getState_user(),
                $user->getAddress1_user(),
                $user->getAddress2_user(),
                $user->getFk_id_city(),
                $user->getPostcode_user(),
                $user->getId_user()
            ]
        );
        Database::disconnect();
    }

    /* Reset password of one user */
    public static function resetPasswordUser($password, $id_user)
    {
        $pdo = Database::getPdo();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "UPDATE users SET password_user = ? WHERE id_user = ?";
        $q = $pdo->prepare($sql);
        $q->execute(
            [
                password_hash($password, PASSWORD_BCRYPT),
                $id_user
            ]
        );
        Database::disconnect();
    }

    /* Get the username of the person who made the command(s) */
    public static function getNameUserCommands($id_user)
    {
        $pdo = Database::getPdo();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "SELECT CONCAT(users.lastname_user, ' ', users.firstname_user) AS name FROM `users` WHERE users.id_user = $id_user";
        $result = $pdo->prepare($sql);
        $result->setFetchMode(PDO::FETCH_ASSOC);
        $result->execute();

        if ($result->rowcount() == 1) {

            $name = $result->fetch();
        } else {
            $name['name'] = "";
        }

        Database::disconnect();

        return $name['name'];
    }
}
