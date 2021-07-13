<?php

class CommandLines
{

    /* Attributes */
    private $command_quantity;
    private $fk_id_command;
    private $fk_id_article;

    /**
     * Get the value of command_quantity
     */
    public function getCommand_quantity()
    {
        return $this->command_quantity;
    }

    /**
     * Set the value of command_quantity
     *
     * @return  self
     */
    public function setCommand_quantity($command_quantity)
    {
        $this->command_quantity = $command_quantity;

        return $this;
    }

    /**
     * Get the value of fk_id_command
     */
    public function getFk_id_command()
    {
        return $this->fk_id_command;
    }

    /**
     * Set the value of fk_id_command
     *
     * @return  self
     */
    public function setFk_id_command($fk_id_command)
    {
        $this->fk_id_command = $fk_id_command;

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
}
