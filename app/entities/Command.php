<?php

class Command
{

    /* Attributes */
    private $id_command;
    private $state_command;
    private $date_creation_command;
    private $fk_id_user;


    /**
     * Get the value of id_command
     */
    public function getId_command()
    {
        return $this->id_command;
    }

    /**
     * Set the value of id_command
     *
     * @return  self
     */
    public function setId_command($id_command)
    {
        $this->id_command = $id_command;

        return $this;
    }

    /**
     * Get the value of state_command
     */
    public function getState_command()
    {
        return $this->state_command;
    }

    /**
     * Set the value of state_command
     *
     * @return  self
     */
    public function setState_command($state_command)
    {
        $this->state_command = $state_command;

        return $this;
    }


    /* Display state for tables */
    public function getDisplayState_command()
    {

        if ($this->state_command == 'a') {
            $state = 'Payée';
        }
        if ($this->state_command == 'w') {
            $state = 'En attente';
        }
        if ($this->state_command == 'b') {
            $state = 'Annulée';
        }
        return $state;
    }

    /**
     * Get the value of date_creation_command
     */
    public function getDate_creation_command()
    {
        return $this->date_creation_command;
    }

    public function getDisplayDate_creation_command()
    {
        $date = $this->date_creation_command;
        return strftime("%d/%m/%G à %Hh%M", strtotime($date));
    }

    /**
     * Set the value of date_creation_command
     *
     * @return  self
     */
    public function setDate_creation_command($date_creation_command)
    {
        $this->date_creation_command = $date_creation_command;

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

    public function getNameUserCommands()
    {
        return UserDAO::getNameUserCommands($this->getFk_id_user());
    }

    public function getTotalPriceCommand()
    {
        return CommandDAO::getTotalPriceCommand($this->getId_command());
    }
}
