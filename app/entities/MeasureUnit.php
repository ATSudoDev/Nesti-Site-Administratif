<?php

class Product
{
    /* Attributes */
    private $id_measure_unit;
    private $name_measure_unit;

    /**
     * Get the value of id_measure_unit
     */
    public function getId_measure_unit()
    {
        return $this->id_measure_unit;
    }

    /**
     * Set the value of id_measure_unit
     *
     * @return  self
     */
    public function setId_measure_unit($id_measure_unit)
    {
        $this->id_measure_unit = $id_measure_unit;

        return $this;
    }

    /**
     * Get the value of name_measure_unit
     */
    public function getName_measure_unit()
    {
        return $this->name_measure_unit;
    }

    /**
     * Set the value of name_measure_unit
     *
     * @return  self
     */
    public function setName_measure_unit($name_measure_unit)
    {
        $this->name_measure_unit = $name_measure_unit;

        return $this;
    }
}
