<?php

class IngredientDAO extends BaseDAO
{
    protected static $tableName = "ingredients";

    /* Creates a new ingredient */
    public static function createIngredient($id_ingredient)
    {
        $pdo = Database::getPdo();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "INSERT INTO ingredients (fk_product_ingredient) values(?)";
        $q = $pdo->prepare($sql);
        $q->execute(
            [
                $id_ingredient
            ]
        );
        Database::disconnect();
    }
}
