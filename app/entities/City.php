<?php

class City
{

    /* Attributes */
    private $id_city;
    private $name_city;
    private $valid_city = true;

    /* Errors */
    private $nameCityError = '';

    /**
     * Get the value of id_city
     */
    public function getId_city()
    {
        return $this->id_city;
    }

    /**
     * Set the value of id_city
     *
     * @return  self
     */
    public function setId_city($id_city)
    {
        $this->id_city = $id_city;

        return $this;
    }

    /**
     * Get the value of name_city
     */
    public function getName_city()
    {
        return $this->name_city;
    }

    /**
     * Set the value of name_city
     *
     * @return  self
     */
    public function setName_city($name_city)
    {
        if (empty($name_city)) {
            $this->nameCityError = "Veuillez saisir votre ville";
            $this->valid_city  = false;
        } else if (!preg_match("/^[a-zA-ZÀ-ÿ ,.'-]{3,25}+$/i", $name_city)) {
            $this->nameCityError = "Votre saisie ville ne respecte pas les conditions";
            $this->valid_city = false;
        }

        $this->name_city = $name_city;

        return $this;
    }

    /**
     * Get the value of valid_city
     */
    public function getValid_city()
    {
        return $this->valid_city;
    }

    /**
     * Get the value of nameCityError
     */
    public function getNameCityError()
    {
        return $this->nameCityError;
    }
}
