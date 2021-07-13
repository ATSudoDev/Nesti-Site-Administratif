<?php

class IngredientRecipeDAO extends BaseDAO
{
    protected static $tableName = "ingredient_recipes";

    /* Find All Ingredients for one recipe */
    public static function findAllIngredientsForOneRecipe($id_recipe)
    {
        $pdo = Database::getPdo();
        $sql = "SELECT * FROM `ingredient_recipes` WHERE fk_id_recipe = $id_recipe";
        $result = $pdo->query($sql);

        if ($result) {
            $arrayIngredientsRecipe = $result->fetchAll(PDO::FETCH_CLASS, 'IngredientRecipes');
        } else {
            $arrayIngredientsRecipe = [];
        }

        Database::disconnect();

        return $arrayIngredientsRecipe;
    }

    /* Find the id of one measure unit thanks to its name */
    public static function findIDMeasureUnitWith($name_measure_unit)
    {
        $pdo = Database::getPdo();
        $sql = "SELECT id_measure_unit FROM measure_units WHERE name_measure_unit = '$name_measure_unit'";
        $result = $pdo->query($sql);
        $result->setFetchMode(PDO::FETCH_ASSOC);

        if ($result->rowcount() == 1) {
            $id_measure_unit = $result->fetch();
        } else {
            $id_measure_unit['id_measure_unit'] = null;
        }

        Database::disconnect();

        return $id_measure_unit['id_measure_unit'];
    }

    /* Creates a new ingredient for a recipe */
    public static function addIngredientRecipe($id_recipe, $id_ingredient, $quantity_ingredient, $id_measure_unit_ingredient)
    {
        $pdo = Database::getPdo();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "INSERT INTO ingredient_recipes (quantity_ingredient, fk_id_recipe, fk_id_measure_unit, fk_id_product) values(?, ?, ?, ?)";
        $q = $pdo->prepare($sql);
        $q->execute(
            [
                $quantity_ingredient,
                $id_recipe,
                $id_measure_unit_ingredient,
                $id_ingredient
            ]
        );

        Database::disconnect();
    }

    /* Delete a ingredient for a recipe */
    public static function deleteIngredientRecipe($id_recipe, $id_ingredient, $quantity_ingredient, $id_measure_unit_ingredient)
    {
        $pdo = Database::getPdo();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "DELETE FROM ingredient_recipes WHERE quantity_ingredient = ? AND fk_id_recipe = ? AND fk_id_measure_unit = ? AND fk_id_product = ?";
        $q = $pdo->prepare($sql);
        $q->execute(
            [
                $quantity_ingredient,
                $id_recipe,
                $id_measure_unit_ingredient,
                $id_ingredient
            ]
        );

        Database::disconnect();
    }
}
