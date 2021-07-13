<?php

class ControllerArticles extends BaseController
{

    public function initialize()
    {

        // RESTRICTION user if he is not an admin
        if (array_search("admins", $_SESSION["roles_user"]) === false) {
            header('Location:' . BASE_URL . "forbidden");
            exit();
        } else {

            // ARTICLE
            if (!isset($_GET['action'])) {
                $arrayArticles = ArticleDAO::readAllArticles();
                $this->_data['arrayArticles'] = $arrayArticles;
            } else {

                // ARTICLE / DELETE
                if ($_GET['action'] == 'delete') {

                    if (isset($_GET['id'])) {

                        $id_article = $_GET['id'];

                        ArticleDAO::deleteArticle($id_article);

                        $_SESSION['deleteArticle'] = '';
                        header('Location:' . BASE_URL . "articles");
                        exit();
                    }
                }

                // ARTICLE / EDITION
                if ($_GET['action'] == 'edit') {
                    if (!isset($_GET['option'])) {

                        $id_article = $_GET['id'];

                        $article = ArticleDAO::findOneBy("id_article", $id_article);
                        $id_picture = $article->getFk_id_image();
                        if ($id_picture != 0) {
                            $name_picture = PictureDAO::getPictureName($article->getFk_id_image());
                            $this->_data['name_picture'] = $name_picture;
                        }

                        if ($_SERVER["REQUEST_METHOD"] == "POST" && !empty($_POST)) {

                            $article->setCustomer_name_article(($_POST["articleCustomerName"]));
                            $article->setState_article(($_POST["stateArticle"]));

                            ArticleDAO::updateArticle($article);
                            $_SESSION['articleUpdated'] = '';
                        }

                        $this->_data['article'] = $article;
                    }

                    // ARTICLE / ADD IMAGE
                    if (isset($_GET['id'])) {
                        if ((isset($_GET['option'])) && (($_GET['option']) == "editpicture")) {
                            if (isset($_FILES['file']['name'])) {

                                $id_article = $_GET['id'];
                                $filename = $_FILES['file']['name'];
                                $position = strrpos($filename, ".");
                                $data['download'] = is_uploaded_file($_FILES['file']['tmp_name']);
                                $location = BASE_DIR . "/public/images/articles/" . strtolower($filename);
                                $imageFileType = strtolower(pathinfo($location, PATHINFO_EXTENSION));
                                $valid_extensions = array("jpg", "jpeg", "png");

                                $response = [];
                                /* Check file extension */
                                if (in_array(strtolower($imageFileType), $valid_extensions)) {
                                    /* Upload file */
                                    if (move_uploaded_file($_FILES['file']['tmp_name'], $location)) {

                                        $image = new Image;
                                        $image->setName_image(substr(strtolower($filename), 0, $position));
                                        $image->setExtension_image($imageFileType);
                                        $id_image = PictureDAO::addPicture($image);
                                        PictureDAO::linkPictureToArticle($id_article, $id_image);

                                        $response['name'] = $image->getName_image() . "." . $image->getExtension_image();
                                        $response["path"] = PATH_IMG_ARTICLES . $response['name'];
                                    }
                                }
                                echo json_encode($response);
                                die();
                            }
                        }
                    }

                    // ARTICLE/ DELETE IMAGE
                    if (isset($_GET['id'])) {
                        if ((isset($_GET['option'])) && (($_GET['option']) == "deletepicture")) {
                            if ($_SERVER["REQUEST_METHOD"] == "POST" && !empty($_POST)) {

                                $id_article = $_POST["id_article"];
                                ArticleDAO::deletePictureArticle($id_article);

                                $response = 'succeed';

                                echo json_encode($response);
                                die();
                            }
                        }
                    }
                }

                // ARTICLE / COMMANDS
                if ($_GET['action'] == 'commands') {

                    /* Gets the commands - AJAX METHOD */
                    if ($_SERVER["REQUEST_METHOD"] == "POST" && !empty($_POST)) {

                        $data = [];
                        $id_command = $_POST['id_command'];
                        $commandLines = CommandDAO::getCommandsLines($id_command);

                        $index = 0;

                        foreach ($commandLines as $line) {
                            $article = ArticleDAO::findOneBy('id_article', $line->getFk_id_article());
                            $data['article-command'][$index] = $line->getCommand_quantity() . ' x ' . $article->getQuantity_unite_article() 
                            . ' ' . $article->getUnitArticle() . ' de ' . $article->getNameProduct();
                            $data['id-article-command'][$index] = $line->getFk_id_article();
                            $index++;
                        }

                        echo json_encode($data);
                        die;

                    } else {

                        if (!isset($_GET['option'])) {

                            $arrayCommands = CommandDAO::readAllCommands();
                            $this->_data['arrayCommands'] = $arrayCommands;
                        }
                    }
                }
            }
        }
    }
}
