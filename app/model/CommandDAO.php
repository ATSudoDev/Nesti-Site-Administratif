<?php

class CommandDAO extends BaseDAO
{
    protected static $tableName = "commands";

    /* Fetch all data of the commands */
    public static function readAllCommands()
    {

        $pdo = Database::getPdo();
        $sql = "SELECT * FROM commands";
        $result = $pdo->query($sql);

        if ($result) {
            $arrayCommands = $result->fetchAll(PDO::FETCH_CLASS, 'Command');
        } else {
            $arrayCommands = [];
        }

        return $arrayCommands;
    }

    // Fetchs all commands of one user thanks to its is */
    public static function readCommandsFromOneUser($id_user)
    {
        $pdo = Database::getPdo();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "SELECT * FROM commands WHERE fk_id_user = $id_user";
        $result = $pdo->query($sql);

        if ($result) {
            $arrayCommands = $result->fetchAll(PDO::FETCH_CLASS, 'Command');
        } else {
            $arrayCommands = [];
        }
        return $arrayCommands;
    }

    /* Finds the number of commands for one user thanks to its id */
    public static function getNumberCommandsUser($id_user)
    {
        $pdo = Database::getPdo();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "SELECT COUNT(fk_id_user) FROM `commands` WHERE fk_id_user = ?";
        $result = $pdo->prepare($sql);
        $result->setFetchMode(PDO::FETCH_ASSOC);

        $result->execute(
            [
                $id_user
            ]
        );

        $number = $result->fetch();

        Database::disconnect();

        return $number['COUNT(fk_id_user)'];
    }

    /* Get last command price of one user */
    public static function getLastCommandPriceUser($id_user)
    {
        $pdo = Database::getPdo();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "SELECT commands.fk_id_user, price_articles.price_article FROM commands 
        INNER JOIN command_lines ON commands.id_command = command_lines.fk_id_command 
        INNER JOIN price_articles ON command_lines.fk_id_article = price_articles.fk_id_article 
        WHERE fk_id_user = $id_user ORDER BY date_creation_command DESC LIMIT 1";
        $result = $pdo->prepare($sql);
        $result->setFetchMode(PDO::FETCH_ASSOC);
        $result->execute();

        if ($result->rowcount() == 1) {
            $number = $result->fetch();
        } else {
            $number['price_article'] = "0";
        }
        Database::disconnect();
        return $number['price_article'];
    }

    /* Get all the prices of all the commands that a user has done thanks to its id */
    public static function getAllCommandsPricesUser($id_user)
    {
        $pdo = Database::getPdo();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "SELECT SUM(price_articles.price_article * command_lines.command_quantity) AS priceAllCommands FROM command_lines
        INNER JOIN price_articles ON price_articles.fk_id_article = command_lines.fk_id_article
        INNER JOIN commands ON commands.id_command = command_lines.fk_id_command
        INNER JOIN users ON commands.fk_id_user = users.id_user
        WHERE users.id_user = $id_user";
        $result = $pdo->prepare($sql);
        $result->setFetchMode(PDO::FETCH_ASSOC);
        $result->execute();

        $number = $result->fetch();

        if ($number['priceAllCommands'] == null) {
            $number['priceAllCommands'] = "0";
        }

        Database::disconnect();

        return $number['priceAllCommands'];
    }

    /* Get the total price of one command thanks to its id */
    public static function getTotalPriceCommand($id_command)
    {
        $pdo = Database::getPdo();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = " SELECT SUM(price_articles.price_article * command_lines.command_quantity) AS price_command FROM command_lines
        INNER JOIN price_articles ON price_articles.fk_id_article = command_lines.fk_id_article
        WHERE command_lines.fk_id_command = $id_command";
        $result = $pdo->prepare($sql);
        $result->setFetchMode(PDO::FETCH_ASSOC);
        $result->execute();


        if ($result->rowcount() == 1) {

            $price_command = $result->fetch();
        } else {
            $price_command['price_command'] = "0";
        }

        Database::disconnect();

        return $price_command['price_command'];
    }

    /* Get all the article of one command thanks to its id */
    public static function getArticlesCommands($id_command)
    {
        $pdo = Database::getPdo();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "SELECT * FROM `command_lines`
        WHERE fk_id_command = $id_command";
        $result = $pdo->prepare($sql);
        $result->execute();


        if ($result->rowcount() == 1) {

            $articles_command = $result->fetchAll();
        } else {
            $articles_command = "0";
        }

        Database::disconnect();

        return $articles_command;
    }

    /* Get all the command lines of one command thanks to its id */
    public static function getCommandsLines($id_command)
    {
        $pdo = Database::getPdo();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "  SELECT * FROM `command_lines`
        WHERE fk_id_command = $id_command";
        $result = $pdo->query($sql);

        if ($result) {
            $arrayCommandLines = $result->fetchAll(PDO::FETCH_CLASS, 'CommandLines');
        } else {
            $arrayCommandLines = [];
        }
        return $arrayCommandLines;
    }

    /* Get all the commands by day */
    public static function getCommandsByDay($date)
    {

        $pdo = Database::getPdo();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "SELECT * FROM commands WHERE date_creation_command LIKE '$date%' AND state_command ='a'";
        $result = $pdo->query($sql);

        if ($result) {
            $commandByDay = $result->fetchAll(PDO::FETCH_CLASS, 'Command');
        } else {
            $commandByDay = new Command;
        }
        Database::disconnect();
        return $commandByDay;
    }
}
