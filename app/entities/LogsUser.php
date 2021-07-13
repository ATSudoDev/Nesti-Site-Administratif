<?php

class LogsUser
{
    /* Attributes */
    private $id_log_user;
    private $date_connection_log_user;
    private $fk_id_user;


    /**
     * Get the value of id_log_user
     */
    public function getId_log_user()
    {
        return $this->id_log_user;
    }

    /**
     * Set the value of id_log_user
     *
     * @return  self
     */
    public function setId_log_user($id_log_user)
    {
        $this->id_log_user = $id_log_user;

        return $this;
    }

    /**
     * Get the value of date_connection_log_user
     */
    public function getDate_connection_log_user()
    {
        return $this->date_connection_log_user;
    }

    /**
     * Set the value of date_connection_log_user
     *
     * @return  self
     */
    public function setDate_connection_log_user($date_connection_log_user)
    {
        $this->date_connection_log_user = $date_connection_log_user;

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
}
