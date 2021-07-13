<?php

class ControllerConnection extends BaseController
{
    public function initialize()
    {
        $UserSession = new Session();

        $username = filter_input(INPUT_POST, "logUsername", FILTER_SANITIZE_STRING);
        $password = filter_input(INPUT_POST, "logPassword", FILTER_SANITIZE_STRING);

        if (isset($username) && (!empty($username))) {

            $user = UserDAO::findOneBy('username_user', $username);

            // If the user exists
            if ($user) {
                if (isset($password) && (!empty($password))) {
                    $passwordDB = $user->getPassword_user();
                    $validation = password_verify($password, $passwordDB);

                    // If the password login are validated
                    if ($validation) {

                        $UserSession->connectUser($user->getId_user());

                        // Add log user 
                        ConnectionDAO::addLogUser($_SESSION["id_user"]);

                        $roles = RoleDAO::readUserRoles($user);

                        if ($roles[0] == 'Utilisateur') {
                            $this->_data['error_roles'] = "Vous n'avez pas accès à ce contenu";
                        } else {
                            $user->SetRoles_user($roles);
                            $_SESSION["lastname_user"] = $user->getLastname_user();
                            $_SESSION["firstname_user"] = $user->getFirstname_user();
                            $_SESSION["roles_user"] = $user->getRoles_user();
                            $_SESSION["id_user"] = $user->getId_user();

                            header('Location:' . BASE_URL . "recipes");
                            die();
                        }

                         // If the password login are not validated
                    } else {
                        $this->_data['error_password'] = "Le mot de passe est incorrect";
                    }
                }
                
                // If the user doesn't exist
            } else {
                $this->_data['error_username'] = "Le nom d'utilisateur est incorrect";
            }
        }
    }
}
