<?php

class Paragraph
{

    /* Attributes */
    private $id_paragraph;
    private $content_paragraph;
    private $order_paragraph;
    private $date_creation_paragraph;
    private $fk_id_recipes;

    /**
     * Get the value of id_paragraph
     */
    public function getId_paragraph()
    {
        return $this->id_paragraph;
    }

    /**
     * Set the value of id_paragraph
     *
     * @return  self
     */
    public function setId_paragraph($id_paragraph)
    {
        $this->id_paragraph = $id_paragraph;

        return $this;
    }

    /**
     * Get the value of content_paragraph
     */
    public function getContent_paragraph()
    {
        return $this->content_paragraph;
    }

    /**
     * Set the value of content_paragraph
     *
     * @return  self
     */
    public function setContent_paragraph($content_paragraph)
    {
        $this->content_paragraph = $content_paragraph;

        return $this;
    }

    /**
     * Get the value of order_paragraph
     */
    public function getOrder_paragraph()
    {
        return $this->order_paragraph;
    }

    /**
     * Set the value of order_paragraph
     *
     * @return  self
     */
    public function setOrder_paragraph($order_paragraph)
    {
        $this->order_paragraph = $order_paragraph;

        return $this;
    }

    /**
     * Get the value of date_creation_paragraph
     */
    public function getDate_creation_paragraph()
    {
        return $this->date_creation_paragraph;
    }

    /**
     * Set the value of date_creation_paragraph
     *
     * @return  self
     */
    public function setDate_creation_paragraph($date_creation_paragraph)
    {
        $this->date_creation_paragraph = $date_creation_paragraph;

        return $this;
    }

    /**
     * Get the value of fk_id_recipes
     */
    public function getFk_id_recipes()
    {
        return $this->fk_id_recipes;
    }

    /**
     * Set the value of fk_id_paragraph
     *
     * @return  self
     */
    public function setFk_id_recipes($fk_id_recipes)
    {
        $this->fk_id_recipes = $fk_id_recipes;

        return $this;
    }
}
