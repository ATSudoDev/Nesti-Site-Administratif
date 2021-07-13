<?php

class ControllerUsers extends BaseController
{

    public function initialize()
    {
        // RESTRICTION
        if (array_search("moderators", $_SESSION["roles_user"]) === false && array_search("admins", $_SESSION["roles_user"]) === false) {
            header('Location:' . BASE_URL . "forbidden");
            exit();
        } else {

            // USERS
            if (!isset($_GET['action'])) {
                $arrayUsers = UserDAO::readAllUsers();
                $this->_data['arrayUsers'] = $arrayUsers;
            } else {

                // USER/DELETE
                if ($_GET['action'] == 'delete') {
                    $this->deleteUser();
                }

                // USER/CREATE
                if ($_GET['action'] == 'create') {
                    $user = new User();
                    $city = new City();

                    if ($_SERVER["REQUEST_METHOD"] == "POST" && !empty($_POST)) {
                        $city = $this->createCity();
                        $user = $this->createUser($city);
                    }

                    $this->_data['user'] = $user;
                    $this->_data['city'] = $city;
                }

                // USER/EDITION
                if ($_GET['action'] == 'edit') {

                    if (!isset($_GET['option'])) {

                        if (isset($_POST["id_command"]) && !empty($_POST["id_command"])) {
                            $this->getCommands();
                        }

                        $id_user = $_GET['id'];

                        $user = UserDAO::findOneUser($id_user);
                        $id_city = $user->getFk_id_city();
                        $city = CityDAO::findOneBy("id_city", $id_city);
                        $roles_user = RoleDAO::readUserRoles($user);
                        $user->setRoles_user($roles_user);

                        if ($_SERVER["REQUEST_METHOD"] == "POST" && !empty($_POST)) {

                            $city = $this->createCity();
                            $this->editUser($user, $city, $roles_user);
                        }

                        // Table Commands
                        $arrayCommandsUser = CommandDAO::readCommandsFromOneUser($id_user);
                        $this->_data['arrayCommandsUser'] = $arrayCommandsUser;

                         // Table Comments
                         $arrayCommentsUser = CommentDAO::readCommentsFromOneUser($id_user);
                         $this->_data['arrayCommentsUser'] = $arrayCommentsUser;

                        $this->_data['user'] = $user;
                        $this->_data['city'] = $city;
                    }

                    // COMMENT APPROVED
                    if (isset($_GET['option'])) {
                        if ($_GET['option'] == 'commentapproved') {

                            if ($_SERVER["REQUEST_METHOD"] == "POST" && !empty($_POST)) {

                                $id_user = $_POST['id_user'];
                                $id_comment = $_POST['id_comment'];
                                CommentDAO::approveComment($id_comment);

                                $_SESSION['commentapproved'] = '';
                                header('Location:' . BASE_URL . "users/edit/" . $id_user);
                                exit();
                            }
                        }
                    }

                    // COMMENT DISAPPROVED
                    if (isset($_GET['option'])) {
                        if ($_GET['option'] == 'commentdisapproved') {

                            if ($_SERVER["REQUEST_METHOD"] == "POST" && !empty($_POST)) {

                                $id_user = $_POST['id_user'];
                                $id_comment = $_POST['id_comment'];
                                CommentDAO::disapproveComment($id_comment);

                                $_SESSION['commentdisapproved'] = '';
                                header('Location:' . BASE_URL . "users/edit/" . $id_user);
                                exit();
                            }
                        }
                    }

                    // RESET PASSWORD
                    if (isset($_GET['option'])) {
                        if ($_GET['option'] == 'resetpassword') {

                            if ($_SERVER["REQUEST_METHOD"] == "POST" && !empty($_POST)) {

                                $id_user = $_POST['id_user'];

                                $data = '1234567890ABCDEFGHIJabcefghij!$#=+/&@_-';
                                $password = substr(str_shuffle($data), 0, 16);

                                UserDAO::resetPasswordUser($password, $id_user);

                                $_SESSION['password'] = $password;

                                header('Location:' . BASE_URL . "users/edit/" . $id_user);
                                exit();
                            }
                        }
                    }
                }
            }
        }
    }

    /* Delete one user */
    private function deleteUser()
    {
        if (isset($_GET['id'])) {

            $id_user = $_GET['id'];
            UserDAO::deleteUser($id_user);
            $_SESSION['deleteUser'] = '';
            header('Location:' . BASE_URL . "users");
            exit();
        }
    }

    /* Creates a new USER */
    private function createUser($city)
    {
        $user = new User;
        $user->setUsername_user($_POST["username_user"]);
        $user->setPassword_user($_POST["password_user"]);
        $user->setState_user($_POST["state_user"]);
        $user->setLastname_user($_POST["lastname_user"]);
        $user->setFirstname_user($_POST["firstname_user"]);
        $user->setEmail_user($_POST["email_user"]);
        $user->setAddress1_user($_POST["address1_user"]);
        $user->setAddress2_user($_POST["address2_user"]);
        $user->setFk_id_city($city->getId_city());
        $user->setPostcode_user($_POST["postcode_user"]);

        if (!empty($_POST['roles_user'])) {
            $roles = $_POST['roles_user'];
        }

        if (!empty($roles)) {
            $user->setRoles_user($roles);
        }

        // Pushes into DB
        if (($user->getValid_user()) == true) {
            $last_id = UserDAO::createUser($user);
            $user->setId_user($last_id);
            // Links ROLES to USER
            RoleDAO::createRoles($user);

            $_SESSION['userCreated'] = '';
            header('Location:' . BASE_URL . "users");
            exit();
        }
        return $user;
    }

    /* Creates or gets an object CITY */
    private function createCity()
    {
        // Checks/Creates a new CITY
        $nameCity = $_POST["name_city"];
        if ((CityDAO::findOneBy("name_city", $nameCity)) == null) {
            $city = new City;
            $city->setName_city($_POST["name_city"]);
            if (($city->getValid_city()) == true) {
                CityDAO::createCity($city);
                $city = CityDAO::findOneBy("name_city", $nameCity);
            }
        } else {
            $city = CityDAO::findOneBy("name_city", $nameCity);
        }

        return $city;
    }

    /* Edit data for one user */
    private function editUser($user, $city, $roles_user)
    {

        if ($roles_user[0] == 'Utilisateur') {
            $roles_user = [];
        }

        /* Creates ROLES to user */
        $roles = [];
        if (!empty($_POST['roles_user'])) {
            foreach ($_POST['roles_user'] as $value) {
                $roles = $_POST['roles_user'];
            }
        }

        $newRoles = array_diff($roles, $roles_user);
        $oldAndNewRoles = array_merge($roles, $roles_user);

        /* Checks/Creates data USER */
        $user->setState_user($_POST["state_user"]);
        $user->setLastname_user($_POST["lastname_user"]);
        $user->setFirstname_user($_POST["firstname_user"]);
        $user->setState_user($_POST["state_user"]);
        $user->setAddress1_user($_POST["address1_user"]);
        $user->setAddress2_user($_POST["address2_user"]);
        $user->setFk_id_city($city->getId_city());
        $user->setPostcode_user($_POST["postcode_user"]);
        $user->setRoles_user($oldAndNewRoles);

        $id_user = $_GET['id'];

        /* Push into DB */
        if (($user->getValid_user()) == true) {

            UserDAO::updateUser($user);
            RoleDAO::updateRoles($id_user, $newRoles);

            if ($id_user == $_SESSION["id_user"]) {
                $_SESSION["roles_user"] = $user->getRoles_user();
            }

            $_SESSION['userUpdated'] = '';
            header('Location:' . BASE_URL . "users/edit/" . $id_user);
            exit();
        }

        return $user;
    }

    /* GET COMMANDS */
    private function getCommands()
    {
        $data = [];
        $id_command = $_POST['id_command'];
        $commandLines = CommandDAO::getCommandsLines($id_command);

        $index = 0;

        foreach ($commandLines as $line) {
            $article = ArticleDAO::findOneBy('id_article', $line->getFk_id_article());
            $data['article-command'][$index] = $line->getCommand_quantity() . ' x ' . $article->getQuantity_unite_article() . ' ' . $article->getUnitArticle() . ' de ' . $article->getNameProduct();
            $data['id-article-command'][$index] = $line->getFk_id_article();
            $index++;
        }
        echo json_encode($data);
        die;
    }
}
