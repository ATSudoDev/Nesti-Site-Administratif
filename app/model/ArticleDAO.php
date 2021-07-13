<?php

class ArticleDAO extends BaseDAO
{

    protected static $tableName = "articles";

    /* Fetch all data of the articles in DB */
    public static function readAllArticles()
    {

        $pdo = Database::getPdo();
        $sql = "SELECT * FROM articles";
        $result = $pdo->query($sql);

        if ($result) {
            $arrayArticles = $result->fetchAll(PDO::FETCH_CLASS, 'Article');
        } else {
            $arrayArticles = [];
        }

        return $arrayArticles;
    }

    /* Update one article thanks to its id */
    public static function updateArticle($article)
    {
        $pdo = Database::getPdo();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "UPDATE articles SET customer_name_article = ?, state_article = ? WHERE id_article = ?";
        $q = $pdo->prepare($sql);
        $q->execute(
            [
                $article->getCustomer_name_article(),
                $article->getState_article(),
                $article->getId_article(),
            ]
        );
        Database::disconnect();
    }

    /* Get the price of one article thanks to its id */
    public static function getPriceArticle($id_article)
    {
        $pdo = Database::getPdo();

        $sql = "SELECT price_articles.price_article FROM `price_articles`
        INNER JOIN articles ON articles.id_article = price_articles.fk_id_article
        WHERE price_articles.fk_id_article = $id_article";
        $result = $pdo->query($sql);
        $result->setFetchMode(PDO::FETCH_ASSOC);

        if ($result) {
            $price_article = $result->fetch();
        } else {
            $price_article['price_article'] = '0';
        }

        Database::disconnect();

        return $price_article['price_article'];
    }

    /* Get the name of one article thanks to its id */
    public static function getNameArticle($id_article)
    {
        $pdo = Database::getPdo();

        $sql = "SELECT products.name_product FROM `articles`
        INNER JOIN products ON products.id_product = articles.fk_id_product
        WHERE articles.id_article = $id_article";
        $result = $pdo->query($sql);
        $result->setFetchMode(PDO::FETCH_ASSOC);

        if ($result) {
            $name_article = $result->fetch();
        } else {
            $name_article['name_product'] = '0';
        }

        Database::disconnect();

        return $name_article['name_product'];
    }

    /* Get the type of one article thanks to its id */
    public static function getTypeArticle($id_article)
    {
        $pdo = Database::getPdo();

        $sql = "SELECT * FROM ingredients WHERE fk_product_ingredient = $id_article";
        $result = $pdo->query($sql);
        $result->setFetchMode(PDO::FETCH_ASSOC);
        $result->execute();

        if ($result->rowcount() == 1) {

            $type = "Ingrédient";
        } else {

            $type = "Utensile";
        }

        return $type;
    }

    /* Get the unit of one article thanks to its id */
    public static function getUnitArticle($id_article)
    {
        $pdo = Database::getPdo();

        $sql = "SELECT measure_units.name_measure_unit FROM `measure_units`
        INNER JOIN articles ON measure_units.id_measure_unit = articles.fk_id_measure_unit
        WHERE articles.id_article = $id_article";
        $result = $pdo->query($sql);
        $result->setFetchMode(PDO::FETCH_ASSOC);

        if ($result) {
            $unit = $result->fetch();
        } else {
            $unit['name_measure_unit'] = "Pas d'unité";
        }

        Database::disconnect();

        return $unit['name_measure_unit'];
    }

    /* Get the reference number for one article thanls to its id */
    public static function getRefArticle($id_article)
    {
        $pdo = Database::getPdo();

        $sql = "SELECT ref_package FROM `packages` WHERE fk_id_article = $id_article";
        $result = $pdo->query($sql);
        $result->setFetchMode(PDO::FETCH_ASSOC);

        if ($result) {
            $ref = $result->fetch();
        } else {
            $ref['ref_package'] = "0";
        }

        Database::disconnect();

        return $ref['ref_package'];
    }

    /* Block / Delete one article */
    public static function deleteArticle($id_article)
    {
        $pdo = Database::getPdo();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "UPDATE articles SET state_article = ? WHERE id_article = ?";
        $q = $pdo->prepare($sql);
        $q->execute(
            [
                "b",
                $id_article
            ]
        );
        Database::disconnect();
    }

    /* Get the quantity bought for one article thanks to its id */
    public static function getQuantityBoughtArticle($id_article)
    {
        $pdo = Database::getPdo();

        $sql = "SELECT packages.quantity_bought_package AS bought FROM packages
         INNER JOIN articles ON articles.id_article = packages.fk_id_article
         WHERE articles.id_article = $id_article";
        $result = $pdo->query($sql);
        $result->setFetchMode(PDO::FETCH_ASSOC);

        if ($result->rowcount() == 1) {
            $bought = $result->fetch();
        } else {
            $bought['bought'] = "0";
        }

        Database::disconnect();

        return $bought['bought'];
    }

    /* Get the total sales for one article thanks to its id */
    public static function getTotalSalesArticle($id_article)
    {
        $pdo = Database::getPdo();

        $sql = "SELECT SUM(price_articles.price_article*command_lines.command_quantity) AS 'TotalSales' FROM `articles`
        INNER JOIN price_articles ON price_articles.fk_id_article = articles.id_article
        INNER JOIN command_lines ON command_lines.fk_id_article = articles.id_article
        WHERE articles.id_article = $id_article";
        $result = $pdo->query($sql);
        $result->setFetchMode(PDO::FETCH_ASSOC);

        if ($result->rowcount() == 1) {
            $total_sales = $result->fetch();
        } else {
            $total_sales = "0";
        }

        Database::disconnect();

        return $total_sales['TotalSales'];
    }

    /* Get the total that Nesti bought for one article thanks to its id */
    public static function getTotalBoughtArticle($id_article)
    {
        $pdo = Database::getPdo();

        $sql = "SELECT SUM(packages.quantity_bought_package * packages.price_unite_package) AS 'TotalBought' FROM packages
        WHERE packages.fk_id_article = $id_article";
        $result = $pdo->query($sql);
        $result->setFetchMode(PDO::FETCH_ASSOC);

        if ($result->rowcount() == 1) {
            $total_bought = $result->fetch();
        } else {
            $total_bought = "0";
        }

        Database::disconnect();

        return $total_bought['TotalBought'];
    }

    /* Get the quantity sold for one article thanks to its id */
    public static function getQuantitySoldArticle($id_article)
    {
        $pdo = Database::getPdo();

        $sql = "SELECT SUM(command_lines.command_quantity) AS quantity_sold FROM packages
        INNER JOIN articles ON articles.id_article = packages.fk_id_article
        INNER JOIN command_lines ON command_lines.fk_id_article = articles.id_article
        WHERE articles.id_article = $id_article";
        $result = $pdo->query($sql);
        $result->setFetchMode(PDO::FETCH_ASSOC);

        if ($result->rowcount() == 1) {
            $quantity_sold = $result->fetch();
        } else {
            $quantity_sold['quantity_sold'] = "0";
        }

        Database::disconnect();

        return $quantity_sold['quantity_sold'];
    }

    /* Delet the picture for one article thanks to the id article*/
    public static function deletePictureArticle($id_article)
    {
        $pdo = Database::getPdo();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "UPDATE articles SET fk_id_image = NULL WHERE id_article = ?";
        $q = $pdo->prepare($sql);
        $q->execute(
            [
                $id_article
            ]
        );
        Database::disconnect();
    }
}
