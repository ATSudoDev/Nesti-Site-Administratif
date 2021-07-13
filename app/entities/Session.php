<?php

class Session
{
    /* Does the user is connected ? */
    public function isUserConnected()
    {
        $isConnected = false;
        if (isset($_SESSION['id_user']) && !empty($_SESSION['id_user'])) {
            $isConnected = true;
        }
        return $isConnected;
    }

    /* Connection User Session */
    public function connectUser($id)
    {
        $_SESSION['id_user'] = $id;
    }

    /* Disconnection User Sesion */
    public function disconnectUser()
    {
        session_unset();
        session_destroy();
    }
}
