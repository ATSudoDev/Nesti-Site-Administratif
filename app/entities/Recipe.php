<?php

class Recipe
{
    /* Attributs */
    private $id_recipe;
    private $date_creation_recipe;
    private $name_recipe;
    private $difficulty_recipe;
    private $number_person_recipe;
    private $state_recipe;
    private $time_recipe;
    private $fk_id_image;
    private $fk_id_chief;
    private $valid_recipe = true;

    /* Errors */
    private $nameError = '';
    private $difficultyError = '';
    private $numberPersonError = '';
    private $timeError = '';

    /**
     * Get the value of id_recipe
     */
    public function getId_recipe()
    {
        return $this->id_recipe;
    }

    /**
     * Set the value of id_recipe
     * @return  self
     */
    public function setId_recipe($id_recipe)
    {
        $this->id_recipe = $id_recipe;

        return $this;
    }

    /**
     * Get the value of date_creation_recipe
     */
    public function getDate_creation_recipe()
    {
        return $this->date_creation_recipe;
    }

    /**
     * Set the value of date_creation_recipe
     * @return  self
     */
    public function setDate_creation_recipe($date_creation_recipe)
    {
        $this->date_creation_recipe = $date_creation_recipe;

        return $this;
    }

    /**
     * Get the value of name_recipe
     */
    public function getName_recipe()
    {
        return $this->name_recipe;
    }


    /**
     * Set the value of name_recipe
     * @return  self
     */
    public function setName_recipe($name_recipe)
    {
        if (empty($name_recipe)) {
            $this->nameError = 'Veuillez saisir un nom de recette';
            $this->valid_recipe = false;
        }

        $this->name_recipe = $name_recipe;

        return $this;
    }

    /**
     * Get the value of difficulty_recipes
     */
    public function getDifficulty_recipe()
    {
        return $this->difficulty_recipe;
    }

    /**
     * Set the value of difficulty_recipe
     * @return  self
     */
    public function setDifficulty_recipe($difficulty_recipe)
    {
        if (empty($difficulty_recipe)) {
            $this->difficultyError = 'Veuillez saisir une note de difficulté sur 5';
            $this->valid_recipe = false;
        } else if (!preg_match("/^[1-5]$/", $difficulty_recipe)) {
            $this->difficultyError = "Veuillez saisir une note de difficulté comprise entre 0 et 5";
            $this->valid_recipe = false;
        }

        $this->difficulty_recipe = $difficulty_recipe;

        return $this;
    }

    /**
     * Get the value of number_person_recipe
     */
    public function getNumber_person_recipe()
    {
        return $this->number_person_recipe;
    }

    /**
     * Set the value of number_person_recipe
     * @return  self
     */
    public function setNumber_person_recipe($number_person_recipe)
    {
        if (empty($number_person_recipe)) {
            $this->numberPersonError = 'Veuillez saisir un nombre de personnes';
            $this->valid_recipe = false;
        } else if (!preg_match("/^[0-9]{0,2}$/", $number_person_recipe)) {
            $this->numberPersonError = "Veuillez saisir un nombre de personnes valide";
            $this->valid_recipe = false;
        }

        $this->number_person_recipe = $number_person_recipe;

        return $this;
    }

    /**
     * Get the value of state_recipe
     */
    public function getState_recipe()
    {
        return $this->state_recipe;
    }

    // Display state for tables
    public function getDisplayState_recipe()
    {

        if ($this->state_recipe == 'a') {
            $state = 'Actif';
        }
        if ($this->state_recipe == 'b') {
            $state = 'Bloqué';
        }
        if ($this->state_recipe == 'w') {
            $state = 'En attente';
        }
        return $state;
    }

    /**
     * Set the value of state_recipe
     * @return  self
     */
    public function setState_recipe($state_recipe)
    {
        $this->state_recipe = $state_recipe;

        return $this;
    }

    /**
     * Get the value of time_recipe
     */
    public function getTime_recipe()
    {
        return $this->time_recipe;
    }

    public function getDisplayTimeHMS_recipe()
    {
        $duration = $this->getTime_recipe();
        $vals = explode(':', $duration);

        if ($vals[0] == 0)
            $result = $vals[1] . ' minutes';
        else
            $result = substr($vals[0], 1)  . ' heure ' . $vals[1] . ' minutes';

        return $result;
    }

    public function getDisplayTimeM_recipe()
    {
        $duration = $this->getTime_recipe();
        $time = explode(':', $duration);
        return ($time[0] * 60) + ($time[1]) + ($time[2] / 60);
    }

    /**
     * Set the value of time_recipe
     * @return  self
     */
    public function setTime_recipe($time_recipe)
    {
        if (empty($time_recipe)) {
            $this->timeError = 'Veuillez saisir un temps de préparation';
            $this->valid_recipe = false;
        } else if (!preg_match("/^[0-9]{0,3}$/", $time_recipe)) {
            $this->timeError = "Veuillez saisir un temps de préparation valide";
            $this->valid_recipe = false;
        } else {
            $convertedTimeHour = intdiv($time_recipe, 60);
            $convertedTimeMinutes = fmod($time_recipe, 60);
            $convertedTime = $convertedTimeHour . ":" . $convertedTimeMinutes . ":00";
            $this->time_recipe = $convertedTime;
        }
        return $this;
    }

    /**
     * Get the value of fk_id_image
     */
    public function getFk_id_image()
    {
        return $this->fk_id_image;
    }

    /**
     * Set the value of fk_id_image
     * @return  self
     */
    public function setFk_id_image($fk_id_image)
    {
        $this->fk_id_image = $fk_id_image;

        return $this;
    }

    /**
     * Get the value of fk_id_chief
     */
    public function getFk_id_chief()
    {
        return $this->fk_id_chief;
    }

    /**
     * Set the value of fk_id_chief
     * @return  self
     */
    public function setFk_id_chief($fk_id_chief)
    {
        $this->fk_id_chief = $fk_id_chief;

        return $this;
    }

    /**
     * Get the value of nameError
     */
    public function getNameError()
    {
        return $this->nameError;
    }

    /**
     * Set the value of nameError
     *
     * @return  self
     */
    public function setNameError($nameError)
    {
        $this->nameError = $nameError;

        return $this;
    }

    /**
     * Get the value of difficultyError
     */
    public function getDifficultyError()
    {
        return $this->difficultyError;
    }

    /**
     * Set the value of difficultyError
     *
     * @return  self
     */
    public function setDifficultyError($difficultyError)
    {
        $this->difficultyError = $difficultyError;

        return $this;
    }

    /**
     * Get the value of numberPersonError
     */
    public function getNumberPersonError()
    {
        return $this->numberPersonError;
    }

    /**
     * Set the value of numberPersonError
     *
     * @return  self
     */
    public function setNumberPersonError($numberPersonError)
    {
        $this->numberPersonError = $numberPersonError;

        return $this;
    }

    /**
     * Get the value of timeError
     */
    public function getTimeError()
    {
        return $this->timeError;
    }

    /**
     * Set the value of timeError
     *
     * @return  self
     */
    public function setTimeError($timeError)
    {
        $this->timeError = $timeError;

        return $this;
    }

    /**
     * Get the value of valid_recipe
     */
    public function getValid_recipe()
    {
        return $this->valid_recipe;
    }

    /**
     * Set the value of valid_recipe
     *
     * @return  self
     */
    public function setValid_recipe($valid_recipe)
    {
        $this->valid_recipe = $valid_recipe;

        return $this;
    }

    public function getNameChiefRecipe()
    {
        return RecipeDAO::getNameChiefRecipe($this->getId_recipe());
    }

    public function getGradeRecipe()
    {
        return RecipeDAO::getGradeRecipe($this->getId_recipe());
    }

    public function canUserCreateRecipe()
    {
        return RecipeDAO::getGradeRecipe($this->getId_recipe());
    }
}
