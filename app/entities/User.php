<?php

class User
{
    /* Attributes */
    private $id_user;
    private $username_user;
    private $password_user;
    private $lastname_user;
    private $firstname_user;
    private $email_user;
    private $state_user;
    private $date_creation_user;
    private $address1_user;
    private $address2_user;
    private $fk_id_city;
    private $postcode_user;
    private $roles_user = [];
    private $valid_user = true;

    /* Errors */
    private $usernameError = '';
    private $passwordError = '';
    private $lastnameError = '';
    private $firstnameError = '';
    private $emailError = '';
    private $stateError = '';
    private $address1Error = '';
    private $address2Error = '';
    private $cityError = '';
    private $postcodeError = '';
    private $rolesError = '';

    /**
     * Get the value of id_user
     */
    public function getId_user()
    {
        return $this->id_user;
    }

    /**
     * Set the value of id_user
     * @return  self
     */
    public function setId_user($id_user)
    {
        $this->id_user = $id_user;

        return $this;
    }

    /**
     * Get the value of username_user
     */
    public function getUsername_user()
    {
        return $this->username_user;
    }

    /**
     * Set the value of username_user
     * @return  self
     */
    public function setUsername_user($username_user)
    {
        if (empty($username_user)) {
            $this->usernameError = "Veuillez saisir un nom d'utilisateur";
            $this->valid_user  = false;
        } else if (!preg_match("/^[a-zA-ZÀ-ÿ ,.'-]{3,20}+$/i", $username_user)) {
            $this->usernameError = "Votre saisie nom d'utilisateur ne respecte pas les conditions (entre 3 et 20 caractères)";
            $this->valid_user = false;
        }

        $this->username_user = $username_user;

        return $this;
    }

    /**
     * Get the value of password_user
     */
    public function getPassword_user()
    {
        return $this->password_user;
    }

    /**
     * Set the value of password_user
     * @return  self
     */
    public function setPassword_user($password_user)
    {
        if (empty($password_user)) {
            $this->passwordError = 'Veuillez saisir un mot de passe';
            $this->valid_user = false;
        } else if (!preg_match("/^(?=.*[0-9])(?=.*[a-z])(?=.*[A-Z])(?=.*[$&+,:;=?@#|'<>.-^*()%!])(?=\\S+$).{12,}$/", $password_user)) {
            $this->passwordError = "Le mot de passe n'est pas assez fort ou ne respecte pas les conditions";
            $this->valid_user = false;
        }

        $this->password_user = $password_user;

        return $this;
    }

    /**
     * Get the value of lastname_user
     */
    public function getLastname_user()
    {
        return $this->lastname_user;
    }

    /**
     * Set the value of lastname_user
     * @return  self
     */
    public function setLastname_user($lastname_user)
    {
        if (empty($lastname_user)) {
            $this->lastnameError = 'Veuillez saisir votre nom';
            $this->valid_user = false;
        } else if (!preg_match("/^[a-zA-ZÀ-ÿ ,.'-]{2,25}+$/i", $lastname_user)) {
            $this->lastnameError = "Votre saisie nom ne respecte pas les conditions (entre 2 et 25 caractères)";
            $this->valid_user = false;
        }

        $this->lastname_user = $lastname_user;

        return $this;
    }

    /**
     * Get the value of firstname_user
     */
    public function getFirstname_user()
    {
        return $this->firstname_user;
    }

    /**
     * Set the value of firstname_user
     * @return  self
     */
    public function setFirstname_user($firstname_user)
    {
        if (empty($firstname_user)) {
            $this->firstnameError = 'Veuillez saisir votre prénom';
            $this->valid_user = false;
        } else if (!preg_match("/^[a-zA-ZÀ-ÿ ,.'-]{2,25}+$/i",  $firstname_user)) {
            $this->firstnameError = "Votre saisie prénom ne respecte pas les conditions (entre 2 et 25 caractères)";
            $this->valid_user = false;
        }

        $this->firstname_user = $firstname_user;

        return $this;
    }

    /**
     * Get the value of email_user
     */
    public function getEmail_user()
    {
        return $this->email_user;
    }

    /**
     * Set the value of email_user
     * @return  self
     */
    public function setEmail_user($email_user)
    {
        if (empty($email_user)) {
            $this->emailError = 'Veuillez saisir votre adresse e-mail';
            $this->valid_user = false;
        } else if (!filter_var($email_user, FILTER_VALIDATE_EMAIL)) {
            $this->emailError = "Votre saisie adresse email ne respecte pas les conditions";
            $this->valid_user = false;
        }
        $this->email_user = $email_user;

        return $this;
    }

    /**
     * Get the value of state_user
     */
    public function getState_user()
    {
        return $this->state_user;
    }

    // Display state for tables
    public function getDisplayState_user()
    {

        if ($this->state_user == 'a') {
            $state = 'Actif';
        }
        if ($this->state_user == 'b') {
            $state = 'Bloqué';
        }
        if ($this->state_user == 'w') {
            $state = 'En attente';
        }
        return $state;
    }

    /**
     * Set the value of state_user
     * @return  self
     */
    public function setState_user($state_user)
    {
        $this->state_user = $state_user;

        return $this;
    }

    /**
     * Get the value of date_creation_user
     */
    public function getDate_creation_user()
    {
        return $this->date_creation_user;
    }

    public function getDisplayDate_creation_user()
    {
        $date =  $this->date_creation_user;
        return strftime("%d/%m/%G à %Hh%M", strtotime($date));
    }

    /**
     * Set the value of date_creation_user
     * @return  self
     */
    public function setDate_creation_user($date_creation_user)
    {
        $this->date_creation_user = $date_creation_user;

        return $this;
    }

    /**
     * Get the value of address1_user
     */
    public function getAddress1_user()
    {
        return $this->address1_user;
    }

    /**
     * Set the value of address1_user
     * @return  self
     */
    public function setAddress1_user($address1_user)
    {
        if (empty($address1_user)) {
            $this->address1Error = 'Veuillez saisir une adresse postale';
            $this->valid_user = false;
        }

        $this->address1_user = $address1_user;

        return $this;
    }

    /**
     * Get the value of address2_user
     */
    public function getAddress2_user()
    {
        return $this->address2_user;
    }

    /**
     * Set the value of address2_user
     * @return  self
     */
    public function setAddress2_user($address2_user)
    {
        $this->address2_user = $address2_user;

        return $this;
    }

    /**
     * Get the value of postcode_user
     */
    public function getPostcode_user()
    {
        $postcode2 = $this->postcode_user;

        if ($postcode2 != '' && strlen($postcode2) < 5) {
            $postcode2 = "0" . $postcode2;
        }


        return $postcode2;
    }

    /**
     * Set the value of postcode_user
     * @return  self
     */
    public function setPostcode_user($postcode_user)
    {
        if (empty($postcode_user)) {
            $this->postcodeError = 'Veuillez saisir un code postal';
            $this->valid_user = false;
        } else if (!preg_match("/^[0-9]{5}$/", $postcode_user)) {
            $this->postcodeError = "Votre saisie code postal ne respecte pas les conditions";
            $this->valid_user = false;
        }

        $this->postcode_user = $postcode_user;

        return $this;
    }

    /**
     * Get the value of fk_id_city
     */
    public function getFk_id_city()
    {
        return $this->fk_id_city;
    }

    /**
     * Set the value of fk_id_city
     *
     * @return  self
     */
    public function setFk_id_city($fk_id_city)
    {
        $this->fk_id_city = $fk_id_city;

        return $this;
    }

    /**
     * Get the value of roles
     */
    public function getRoles_user()
    {
        return $this->roles_user;
    }

    // Display roles for tables
    public function getDisplayRoles()
    {
        $displayRoles = [];

        foreach ($this->roles_user as $role) {
            if ($role == 'admins') {
                $displayRoles[] = 'Administrateur';
            }
            if ($role == 'moderators') {
                $displayRoles[] = 'Modérateur';
            }
            if ($role == 'chiefs') {
                $displayRoles[] = 'Chef';
            }
        }

        if ($displayRoles == null) {
            $displayRoles[] = 'Utilisateur';
        }

        return $displayRoles;
    }

    /**
     * Set the value of roles
     *
     * @return  self
     */
    public function setRoles_user($roles_user)
    {
        $this->roles_user = $roles_user;

        return $this;
    }

    /**
     * Get the value of valid_user
     */
    public function getValid_user()
    {
        return $this->valid_user;
    }

    /**
     * Set the value of valid_user
     * @return  self
     */
    public function setValid_user($valid_user)
    {
        $this->valid_user = $valid_user;

        return $this;
    }

    /**
     * Get the value of usernameError
     */
    public function getUsernameError()
    {
        return $this->usernameError;
    }

    /**
     * Get the value of passwordError
     */
    public function getPasswordError()
    {
        return $this->passwordError;
    }

    /**
     * Get the value of lastnameError
     */
    public function getLastnameError()
    {
        return $this->lastnameError;
    }

    /**
     * Get the value of firstnameError
     */
    public function getFirstnameError()
    {
        return $this->firstnameError;
    }

    /**
     * Get the value of emailError
     */
    public function getEmailError()
    {
        return $this->emailError;
    }

    /**
     * Get the value of addressError
     */
    public function getAddress1Error()
    {
        return $this->address1Error;
    }

    /**
     * Get the value of addressError
     */
    public function getAddress2Error()
    {
        return $this->address2Error;
    }

    /**
     * Get the value of cityError
     */
    public function getCityError()
    {
        return $this->cityError;
    }

    /**
     * Get the value of postcodeError
     */
    public function getPostcodeError()
    {
        return $this->postcodeError;
    }

    /**
     * Get the value of stateError
     */
    public function getStateError()
    {
        return $this->stateError;
    }

    /**
     * Get the value of rolesError
     */
    public function getRolesError()
    {
        return $this->rolesError;
    }

    public function getNumberRecipesChief()
    {
        return RecipeDAO::getNumberRecipesChief($this->getId_user());
    }

    public function getNumberApprovedCommentsModerator()
    {
        return CommentDAO::getNumberApprovedCommentsModerator($this->getId_user());
    }

    public function getNumberDisapprovedCommentsModerator()
    {
        return CommentDAO::getNumberDisapprovedCommentsModerator($this->getId_user());
    }

    public function getConnectionsUser()
    {
        return LogsUserDAO::getConnectionsUser($this->getId_user());
    }

    public function getLastConnectionUser()
    {
        $date =  LogsUserDAO::getLastConnectionUser($this->getId_user());
        if ($date != "Pas de première connection") {
            $date = strftime("%d/%m/%G à %Hh%M", strtotime($date));
        }
        return $date;
    }

    public function getNumberCommandsUser()
    {
        return CommandDAO::getNumberCommandsUser($this->getId_user());
    }

    public function getDateLastImportAdmin()
    {
        return ImportDAO::getDateLastImportAdmin($this->getId_user());
    }

    public function getNumberImportsAdmin()
    {
        return ImportDAO::getNumberImportAdmin($this->getId_user());
    }

    public function getNameLastRecipeChief()
    {
        return RecipeDAO::getNameLastRecipeChief($this->getId_user());
    }

    public function getLastCommandPriceUser()
    {
        return CommandDAO::getLastCommandPriceUser($this->getId_user());
    }

    public function getAllCommandsPricesUser()
    {
        return CommandDAO::getAllCommandsPricesUser($this->getId_user());
    }

    public function getGradeChief()
    {
        return RecipeDAO::getGradeChief($this->getId_user());
    }
}
