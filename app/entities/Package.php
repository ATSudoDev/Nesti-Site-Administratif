<?php

class Package
{
    /* Attributes */
    private $ref_package;
    private $fk_id_article;
    private $price_unite_package;
    private $quantity_bought_package;
    private $date_reception;

    /**
     * Get the value of ref_package
     */
    public function getRef_package()
    {
        return $this->ref_package;
    }

    /**
     * Set the value of ref_package
     *
     * @return  self
     */
    public function setRef_package($ref_package)
    {
        $this->ref_package = $ref_package;

        return $this;
    }

    /**
     * Get the value of fk_id_article
     */
    public function getFk_id_article()
    {
        return $this->fk_id_article;
    }

    /**
     * Set the value of fk_id_article
     *
     * @return  self
     */
    public function setFk_id_article($fk_id_article)
    {
        $this->fk_id_article = $fk_id_article;

        return $this;
    }

    /**
     * Get the value of price_unite_package
     */
    public function getPrice_unite_package()
    {
        return $this->price_unite_package;
    }

    /**
     * Set the value of price_unite_package
     *
     * @return  self
     */
    public function setPrice_unite_package($price_unite_package)
    {
        $this->price_unite_package = $price_unite_package;

        return $this;
    }

    /**
     * Get the value of quantity_bought_package
     */
    public function getQuantity_bought_package()
    {
        return $this->quantity_bought_package;
    }

    /**
     * Set the value of quantity_bought_package
     *
     * @return  self
     */
    public function setQuantity_bought_package($quantity_bought_package)
    {
        $this->quantity_bought_package = $quantity_bought_package;

        return $this;
    }

    /**
     * Get the value of date_reception
     */
    public function getDate_reception()
    {
        return $this->date_reception;
    }

    /**
     * Set the value of date_reception
     *
     * @return  self
     */
    public function setDate_reception($date_reception)
    {
        $this->date_reception = $date_reception;

        return $this;
    }
}
