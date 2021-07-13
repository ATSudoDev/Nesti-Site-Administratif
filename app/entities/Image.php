<?php

class Image
{

    /* Attributes */
    private $id_image;
    private $date_creation_image;
    private $name_image;
    private $extension_image;


    /**
     * Get the value of id_image
     */
    public function getId_image()
    {
        return $this->id_image;
    }

    /**
     * Set the value of id_image
     *
     * @return  self
     */
    public function setId_image($id_image)
    {
        $this->id_image = $id_image;

        return $this;
    }

    /**
     * Get the value of date_creation_image
     */
    public function getDate_creation_image()
    {
        return $this->date_creation_image;
    }

    /**
     * Set the value of date_creation_image
     *
     * @return  self
     */
    public function setDate_creation_image($date_creation_image)
    {
        $this->date_creation_image = $date_creation_image;

        return $this;
    }

    /**
     * Get the value of name_image
     */
    public function getName_image()
    {
        return $this->name_image;
    }

    /**
     * Set the value of name_image
     *
     * @return  self
     */
    public function setName_image($name_image)
    {
        $this->name_image = $name_image;

        return $this;
    }

    /**
     * Get the value of extension_image
     */
    public function getExtension_image()
    {
        return $this->extension_image;
    }

    /**
     * Set the value of extension_image
     *
     * @return  self
     */
    public function setExtension_image($extension_image)
    {
        $this->extension_image = $extension_image;

        return $this;
    }
}
