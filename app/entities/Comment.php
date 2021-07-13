<?php

class Comment
{

    /* Attributes */
    private $id_comment;
    private $title_comment;
    private $content_comment;
    private $date_creation_comment;
    private $state_comment;
    private $fk_id_recipe;
    private $fk_id_user;
    private $fk_id_moderator;

    /**
     * Get the value of id_comment
     */
    public function getId_comment()
    {
        return $this->id_comment;
    }

    /**
     * Set the value of id_comment
     *
     * @return  self
     */
    public function setId_comment($id_comment)
    {
        $this->id_comment = $id_comment;

        return $this;
    }

    /**
     * Get the value of title_comment
     */
    public function getTitle_comment()
    {
        return $this->title_comment;
    }

    /**
     * Set the value of title_comment
     *
     * @return  self
     */
    public function setTitle_comment($title_comment)
    {
        $this->title_comment = $title_comment;

        return $this;
    }

    /**
     * Get the value of content_comment
     */
    public function getContent_comment()
    {
        return $this->content_comment;
    }

    /**
     * Set the value of content_comment
     *
     * @return  self
     */
    public function setContent_comment($content_comment)
    {
        $this->content_comment = $content_comment;

        return $this;
    }

    /**
     * Get the value of date_creation_comment
     */
    public function getDate_creation_comment()
    {
        return $this->date_creation_comment;
    }

    public function getDisplayDate_creation_comment()
    {
        $date =  $this->date_creation_comment;
        return strftime("%d/%m/%G à %Hh%M", strtotime($date));
    }

    /**
     * Set the value of date_creation_comment
     *
     * @return  self
     */
    public function setDate_creation_comment($date_creation_comment)
    {
        $this->date_creation_comment = $date_creation_comment;

        return $this;
    }

    /**
     * Get the value of state_comment
     */
    public function getState_comment()
    {
        return $this->state_comment;
    }

    /* Display state for tables */
    public function getDisplayState_comment()
    {

        if ($this->state_comment == 'a') {
            $state = 'Actif';
        }
        if ($this->state_comment == 'b') {
            $state = 'Bloqué';
        }
        if ($this->state_comment == 'w') {
            $state = 'En attente';
        }
        return $state;
    }

    /**
     * Set the value of state_comment
     *
     * @return  self
     */
    public function setState_comment($state_comment)
    {
        $this->state_comment = $state_comment;

        return $this;
    }

    /**
     * Get the value of fk_id_recipe
     */
    public function getFk_id_recipe()
    {
        return $this->fk_id_recipe;
    }

    public function getNameById_recipe()
    {
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
     * Get the value of fk_id_user
     */
    public function getFk_id_user()
    {
        return $this->fk_id_user;
    }

    /**
     * Set the value of fk_id_user
     *
     * @return  self
     */
    public function setFk_id_user($fk_id_user)
    {
        $this->fk_id_user = $fk_id_user;

        return $this;
    }

    /**
     * Get the value of fk_id_moderator
     */
    public function getFk_id_moderator()
    {
        return $this->fk_id_moderator;
    }

    /**
     * Set the value of fk_id_moderator
     *
     * @return  self
     */
    public function setFk_id_moderator($fk_id_moderator)
    {
        $this->fk_id_moderator = $fk_id_moderator;

        return $this;
    }

    public function getRecipe()
    {
        return RecipeDAO::findOneBy('id_recipe', $this->getFk_id_recipe());
    }
}
