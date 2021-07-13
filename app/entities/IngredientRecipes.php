<?php

class IngredientRecipes
{

    /* Attributes */
    private $quantity_ingredient;
    private $fk_id_recipe;
    private $fk_id_measure_unit;
    private $fk_id_product;

    /**
     * Get the value of quantity_ingredient
     */
    public function getQuantity_ingredient()
    {
        return $this->quantity_ingredient;
    }

    /**
     * Set the value of quantity_ingredient
     *
     * @return  self
     */
    public function setQuantity_ingredient($quantity_ingredient)
    {
        $this->quantity_ingredient = $quantity_ingredient;

        return $this;
    }

    /**
     * Get the value of fk_id_recipe
     */
    public function getFk_id_recipe()
    {
        return $this->fk_id_recipe;
    }

    /**
     * Set the value of fk_id_recipe
     *
     * @return  self
     */
    public function setFk_id_recipe($fk_id_recipe)
    {
        $this->fk_id_recipe = $fk_id_recipe;

        return $this;
    }

    /**
     * Get the value of fk_id_measure_unit
     */
    public function getFk_id_measure_unit()
    {
        return $this->fk_id_measure_unit;
    }

    /**
     * Set the value of fk_id_measure_unit
     *
     * @return  self
     */
    public function setFk_id_measure_unit($fk_id_measure_unit)
    {
        $this->fk_id_measure_unit = $fk_id_measure_unit;

        return $this;
    }

    /**
     * Get the value of fk_id_product
     */
    public function getFk_id_product()
    {
        return $this->fk_id_product;
    }

    /**
     * Set the value of fk_id_product
     *
     * @return  self
     */
    public function setFk_id_product($fk_id_product)
    {
        $this->fk_id_product = $fk_id_product;

        return $this;
    }

    public function getNameMeasureUnit()
    {
        return MeasureUnitDAO::getNameMeasureUnit($this->fk_id_measure_unit);
    }

    public function getNameProduct()
    {
        return ProductDAO::getNameProduct($this->fk_id_product);
    }
}
