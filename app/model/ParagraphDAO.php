<?php

class ParagraphDAO extends BaseDAO
{
    protected static $tableName = "paragraphs";

    /* Find all the preparation steps for one recipe thanks to the recipe id */
    public static function findAllStepsForOneRecipe($id_recipe)
    {
        $pdo = Database::getPdo();
        $sql = "SELECT * FROM `paragraphs` WHERE fk_id_recipes = $id_recipe ORDER BY order_paragraph ASC";
        $result = $pdo->query($sql);

        if ($result) {
            $arrayParagraphRecipe = $result->fetchAll(PDO::FETCH_CLASS, 'Paragraph');
        } else {
            $arrayParagraphRecipe = [];
        }

        Database::disconnect();

        return $arrayParagraphRecipe;
    }

    /* Get the preparation steps in order thanks to the recipe id */
    public static function getOrderParagraphRecipe($id_recipe)
    {
        $pdo = Database::getPdo();
        $sql = "SELECT COUNT(order_paragraph) + 1 AS 'order' FROM `paragraphs` WHERE fk_id_recipes = $id_recipe";
        $result = $pdo->query($sql);
        $result->setFetchMode(PDO::FETCH_ASSOC);

        if ($result->rowcount() == 1) {
            $order_recipes = $result->fetch();
        } else {
            $order_recipes['order'] = 0;
        }

        Database::disconnect();

        return $order_recipes['order'];
    }

    /* Add one preparation step to one recipe */
    public static function addParagraphRecipe($order_paragraph, $fk_id_recipe)
    {
        $pdo = Database::getPdo();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "INSERT INTO paragraphs (order_paragraph, fk_id_recipes) values(?, ?)";
        $q = $pdo->prepare($sql);
        $q->execute(
            [
                $fk_id_recipe,
                $order_paragraph
            ]
        );

        $last_id = $pdo->lastInsertId();
        Database::disconnect();
        return $last_id;
    }

    /* */
    public static function addContentParagraphRecipe($fk_id_recipe, $content_paragraph, $id_paragraph, $order_paragraph)
    {
        $pdo = Database::getPdo();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "UPDATE paragraphs SET content_paragraph = ? WHERE fk_id_recipes = ? AND order_paragraph = ? AND id_paragraph = ?";
        $q = $pdo->prepare($sql);

        $q->execute(
            [
                $content_paragraph,
                $fk_id_recipe,
                $order_paragraph,
                $id_paragraph
            ]
        );

        Database::disconnect();
    }

    /* Delete one preparation step to one recipe*/
    public static function deleteParagraphRecipe($fk_id_recipe, $id_paragraph, $order_paragraph)
    {
        $pdo = Database::getPdo();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "DELETE FROM paragraphs WHERE fk_id_recipes = ? AND  id_paragraph = ? AND  order_paragraph = ?";
        $q = $pdo->prepare($sql);
        $q->execute(
            [
                $fk_id_recipe,
                $id_paragraph,
                $order_paragraph
            ]
        );

        Database::disconnect();
    }

    /* Find all order that are greater than */
    public static function findAllOrderGreaterThan($order_paragraph, $fk_id_recipe)
    {
        $pdo = Database::getPdo();
        $sql = "SELECT id_paragraph FROM paragraphs WHERE order_paragraph > $order_paragraph AND fk_id_recipes = $fk_id_recipe";
        $result = $pdo->query($sql);
        $result->setFetchMode(PDO::FETCH_ASSOC);

        if ($result) {
            $arrayIdParagraphs["id_paragraph"] = $result->fetchAll();
        } else {
            $arrayIdParagraphs = [];
        }

        Database::disconnect();

        return $arrayIdParagraphs["id_paragraph"];
    }

    /* Find one preparation step before another on */
    public static function findParagraphBefore($order_paragraph, $fk_id_recipe)
    {
        $pdo = Database::getPdo();
        $sql = "SELECT id_paragraph FROM paragraphs WHERE order_paragraph = ($order_paragraph - 1) AND fk_id_recipes = $fk_id_recipe";
        $result = $pdo->query($sql);
        $result->setFetchMode(PDO::FETCH_ASSOC);

        if ($result) {
            $id_paragraph = $result->fetch();
        } else {
            $id_paragraph['id_paragraph'] = '0';
        }

        Database::disconnect();
        return $id_paragraph['id_paragraph'];
    }

    /* Find one preparation step after another one */
    public static function findParagraphAfter($order_paragraph, $fk_id_recipe)
    {
        $pdo = Database::getPdo();
        $sql = "SELECT id_paragraph FROM paragraphs WHERE order_paragraph = ($order_paragraph + 1) AND fk_id_recipes = $fk_id_recipe";
        $result = $pdo->query($sql);

        if ($result) {
            $id_paragraph = $result->fetch();
        } else {
            $id_paragraph['id_paragraph'] = '0';
        }

        Database::disconnect();
        return $id_paragraph['id_paragraph'];
    }

    /* Change order to one preparation step : -1 */
    public static function orderDownParagraphRecipe($id_paragraph)
    {

        $pdo = Database::getPdo();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "UPDATE paragraphs SET order_paragraph = (order_paragraph - 1) WHERE id_paragraph = ?";
        $q = $pdo->prepare($sql);
        $q->execute(
            [
                $id_paragraph
            ]
        );
        Database::disconnect();
    }

    /* Change order to one preparation step : +1 */
    public static function orderUpParagraphRecipe($id_paragraph)
    {
        $pdo = Database::getPdo();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "UPDATE paragraphs SET order_paragraph = (order_paragraph + 1) WHERE id_paragraph = ?";
        $q = $pdo->prepare($sql);
        $q->execute(
            [
                $id_paragraph

            ]
        );
        Database::disconnect();
    }
}
