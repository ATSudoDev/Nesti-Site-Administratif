<?php

class ProductDAO extends BaseDAO
{
    protected static $tableName = "products";

    /* Find the ID of the ingredient thanks to its name */
    public static function findIDIngredientWith($name_ingredient)
    {
        $pdo = Database::getPdo();
        $sql = "SELECT id_product FROM products WHERE name_product = '$name_ingredient'";
        $result = $pdo->query($sql);
        $result->setFetchMode(PDO::FETCH_ASSOC);

        if ($result->rowcount() == 1) {
            $id_ingredient = $result->fetch();
        } else {
            $id_ingredient['id_product'] = null;
        }

        Database::disconnect();

        return $id_ingredient['id_product'];
    }

    /* Creates a new product */
    public static function createProduct($name_ingredient)
    {
        $pdo = Database::getPdo();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "INSERT INTO products (name_product) values(?)";
        $q = $pdo->prepare($sql);
        $q->execute(
            [
                $name_ingredient
            ]
        );
        $last_id = $pdo->lastInsertId();
        Database::disconnect();
        return $last_id;
    }

    /* Get the name of one product thanks to its id */
    public static function getNameProduct($id_product)
    {
        $pdo = Database::getPdo();
        $sql = "SELECT name_product FROM products WHERE id_product = $id_product";
        $result = $pdo->query($sql);
        $result->setFetchMode(PDO::FETCH_ASSOC);

        if ($result->rowcount() == 1) {
            $name_product = $result->fetch();
        } else {
            $name_product['name_product'] = "";
        }

        Database::disconnect();

        return $name_product['name_product'];
    }
}
