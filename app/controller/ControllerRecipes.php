<?php

class ControllerRecipes extends BaseController
{

    public function initialize()
    {

        // RESTRICTION 
        if ((array_search("chiefs", $_SESSION["roles_user"]) === false) && (array_search("admins", $_SESSION["roles_user"]) === false)) {
            header('Location:' . BASE_URL . "forbidden");
            exit();
        } else {

            // RECIPES
            if (!isset($_GET['action'])) {
                $arrayRecipes = RecipeDAO::readAllRecipes();
                $this->_data['arrayRecipes'] = $arrayRecipes;
            } else {

                // ARTICLE / DELETE
                if ($_GET['action'] == 'delete') {

                    if (isset($_GET['id'])) {

                        $id_recipe = $_GET['id'];

                        RecipeDAO::deleteRecipe($id_recipe);

                        $_SESSION['deleteRecipe'] = '';
                        header('Location:' . BASE_URL . "recipes");
                        exit();
                    }
                }

                // CREATE a new recipe
                if ($_GET['action'] == 'create') {

                    // RESTRICTION USER (cannot create a recipe if he is not a chief)
                    if (array_search("chiefs", $_SESSION["roles_user"]) !== false) {
                        
                        //Form Methode POST
                        if ($_SERVER["REQUEST_METHOD"] == "POST" && !empty($_POST)) {

                            $recipe = new Recipe; // Create a new recipe
                            $recipe->setName_recipe($_POST["name_recipe"]);
                            $recipe->setDifficulty_recipe($_POST["difficulty_recipe"]);
                            $recipe->setNumber_person_recipe($_POST["number_person_recipe"]);
                            $recipe->setState_recipe($_POST["stateRecipe"]);
                            $recipe->setTime_recipe($_POST["time_recipe"]);

                            // Pushes into DB
                            if (($recipe->getValid_recipe()) == true) { // If the data are validated
                                $id_user = $_SESSION['id_user'];
                                $last_id = RecipeDAO::createRecipe($recipe, $id_user); // Create recipe in the DB
                                $recipe->setId_recipe($last_id);

                                // Create a session variable for the alerte
                                $_SESSION['recipeCreated'] = ''; 

                                // Goes to the edit page for adding information
                                header('Location:' . BASE_URL . "recipes/edit/" . $last_id); 
                                exit();
                            }

                            // Return data
                            $this->_data['recipe'] = $recipe;
                        }

                    } else {
                        // Message restriction
                        header('Location:' . BASE_URL . "forbidden");
                        exit();
                    }
                }

                // RECIPE / EDITION
                if ($_GET['action'] == 'edit') {
                    if (isset($_GET['id'])) {

                        $id_recipe = $_GET['id'];
                        $recipe = RecipeDAO::findOneBy("id_recipe", $id_recipe);

                        // RESTRICTION
                        if (((array_search("chiefs", $_SESSION["roles_user"]) !== false) && ($_SESSION["id_user"] ==  $recipe->getFk_id_chief())) || (array_search("admins", $_SESSION["roles_user"]) !== false)) {


                            if (!isset($_GET['option'])) {

                                $id_recipe = $_GET['id'];

                                $recipe = RecipeDAO::findOneBy("id_recipe", $id_recipe);
                                $ingredients_recipe = IngredientRecipeDAO::findAllIngredientsForOneRecipe($id_recipe);
                                $steps_recipe = ParagraphDAO::findAllStepsForOneRecipe($id_recipe);
                                $id_picture = $recipe->getFk_id_image();
                                if ($id_picture != 0) {
                                    $name_picture = PictureDAO::getPictureName($recipe->getFk_id_image());
                                    $this->_data['name_picture'] = $name_picture;
                                }

                                if ($_SERVER["REQUEST_METHOD"] == "POST" && !empty($_POST)) {

                                    $recipe->setName_recipe($_POST["name_recipe"]);
                                    $recipe->setDifficulty_recipe($_POST["difficulty_recipe"]);
                                    $recipe->setNumber_person_recipe($_POST["number_person_recipe"]);
                                    $recipe->setState_recipe($_POST["stateRecipe"]);
                                    $recipe->setTime_recipe($_POST["time_recipe"]);

                                    // Pushes into DB
                                    if (($recipe->getValid_recipe()) == true) {
                                        RecipeDAO::updateRecipe($recipe);

                                        $_SESSION['recipeUpdated'] = '';
                                    }
                                }

                                $this->_data['recipe'] = $recipe;
                                $this->_data['ingredients_recipe'] = $ingredients_recipe;
                                $this->_data['steps_recipe'] = $steps_recipe;
                            }

                            // RECIPE / ADD IMAGE
                            if ((isset($_GET['option'])) && (($_GET['option']) == "editpicture")) {

                                if (isset($_FILES['file']['name'])) {

                                    $id_recipe = $_GET['id'];
                                    $filename = $_FILES['file']['name'];
                                    $position = strrpos($filename, ".");
                                    $data['download'] = is_uploaded_file($_FILES['file']['tmp_name']);
                                    $location = BASE_DIR . "/public/images/recipes/" . strtolower($filename);
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
                                            PictureDAO::linkPictureToRecipe($id_recipe, $id_image);

                                            $response['name'] = $image->getName_image() . "." . $image->getExtension_image();
                                            $response["path"] = PATH_IMG_RECIPES . $response['name'];
                                        }
                                    }
                                    echo json_encode($response);
                                    die();
                                }
                            }

                            // RECIPE / DELETE IMAGE
                            if ((isset($_GET['option'])) && (($_GET['option']) == "deletepicture")) {
                                if ($_SERVER["REQUEST_METHOD"] == "POST" && !empty($_POST)) {

                                    $id_recipe = $_POST["id_recipe"];
                                    RecipeDAO::deletePictureRecipe($id_recipe);

                                    $response = 'succeed';

                                    echo json_encode($response);
                                    die();
                                }
                            }

                            // LOAD PARAGRAPHS
                            if ((isset($_GET['option'])) && (($_GET['option']) == "loadparagraphs")) {

                                if ($_SERVER["REQUEST_METHOD"] == "POST" && !empty($_POST)) {

                                    $fk_id_recipe = $_POST["id_recipe"];

                                    $steps_recipe = ParagraphDAO::findAllStepsForOneRecipe($fk_id_recipe);

                                    $steps = [];
                                    foreach ($steps_recipe as $key => $step) {
                                        $steps[$key]['id_paragraph'] = $step->getId_paragraph();
                                        $steps[$key]['content_paragraph'] = $step->getContent_paragraph();
                                        $steps[$key]['order_paragraph'] = $step->getOrder_paragraph();
                                        $steps[$key]['fk_id_recipes'] = $step->getFk_id_recipes();
                                    }
                                    echo json_encode($steps);
                                    die();
                                }
                            }

                            // ADD INGREDIENT
                            if ((isset($_GET['option'])) && (($_GET['option']) == "addingredient")) {

                                if ($_SERVER["REQUEST_METHOD"] == "POST" && !empty($_POST)) {

                                    $id_recipe = $_POST["id_recipe"];
                                    $name_ingredient = filter_input(INPUT_POST, "name_ingredient", FILTER_SANITIZE_STRING);
                                    $quantity_ingredient = $_POST["quantity_ingredient"];
                                    $name_unit_ingredient = $_POST["unit_ingredient"];

                                    $data = [];

                                    $id_ingredient = ProductDAO::findIDIngredientWith($name_ingredient);
                                    if ($id_ingredient == null) {
                                        $id_ingredient = ProductDAO::createProduct($name_ingredient);
                                        IngredientDAO::createIngredient($id_ingredient);
                                    }

                                    $id_measure_unit_ingredient = MeasureUnitDAO::findIDMeasureUnitWith($name_unit_ingredient);
                                    if ($id_measure_unit_ingredient == null) {
                                        $id_measure_unit_ingredient = MeasureUnitDAO::createMeasureUnit($name_unit_ingredient);
                                    }

                                    $data["id_ingredient"] = $id_ingredient;
                                    $data["id_measure_unit_ingredient"] = $id_measure_unit_ingredient;
                                    $data['quantity_ingredient'] = $quantity_ingredient;
                                    $data['id_recipe'] = $id_recipe;

                                    echo json_encode($data);

                                    IngredientRecipeDAO::addIngredientRecipe($id_recipe, $id_ingredient, $quantity_ingredient, $id_measure_unit_ingredient);
                                    die();
                                }
                            }

                            // DELETE INGREDIENT
                            if ((isset($_GET['option'])) && (($_GET['option']) == "deleteingredient")) {

                                if ($_SERVER["REQUEST_METHOD"] == "POST" && !empty($_POST)) {

                                    $id_recipe = $_POST["id_recipe"];
                                    $id_ingredient = $_POST["id_ingredient"];
                                    $quantity_ingredient = $_POST["quantity_ingredient"];
                                    $id_measure_unit_ingredient = $_POST["id_measure_unit"];

                                    $data['delete'] = "succeed";

                                    echo json_encode($data);

                                    IngredientRecipeDAO::deleteIngredientRecipe($id_recipe, $id_ingredient, $quantity_ingredient, $id_measure_unit_ingredient);
                                    die();
                                }
                            }

                            // ADD PARAGRAPH
                            if ((isset($_GET['option'])) && (($_GET['option']) == "addparagraph")) {

                                if ($_SERVER["REQUEST_METHOD"] == "POST" && !empty($_POST)) {

                                    $fk_id_recipe = $_POST["id_recipe"];

                                    $order_paragraph = ParagraphDAO::getOrderParagraphRecipe($fk_id_recipe);
                                    $id_paragraph = ParagraphDAO::addParagraphRecipe($fk_id_recipe, $order_paragraph);
                                    $steps_recipe = ParagraphDAO::findAllStepsForOneRecipe($fk_id_recipe);

                                    $steps = [];
                                    foreach ($steps_recipe as $key => $step) {
                                        $steps[$key]['id_paragraph'] = $step->getId_paragraph();
                                        $steps[$key]['content_paragraph'] = $step->getContent_paragraph();
                                        $steps[$key]['order_paragraph'] = $step->getOrder_paragraph();
                                        $steps[$key]['fk_id_recipes'] = $step->getFk_id_recipes();
                                    }
                                    echo json_encode($steps);
                                    die();
                                }
                            }

                            // ADD CONTENT PARAGRAPH
                            if ((isset($_GET['option'])) && (($_GET['option']) == "addcontentparagraph")) {

                                if ($_SERVER["REQUEST_METHOD"] == "POST" && !empty($_POST)) {

                                    $fk_id_recipe = $_POST["id_recipe"];
                                    $id_paragraph = $_POST["id_paragraph"];
                                    $content_paragraph = $_POST["content_paragraph"];
                                    $order_paragraph = $_POST["order_paragraph"];

                                    ParagraphDAO::addContentParagraphRecipe($fk_id_recipe, $content_paragraph, $id_paragraph, $order_paragraph);

                                    $data['addcontent'] = "succeed";

                                    echo json_encode($data);
                                    die();
                                }
                            }

                            // DELETE PARAGRAPH
                            if ((isset($_GET['option'])) && (($_GET['option']) == "deleteparagraph")) {

                                if ($_SERVER["REQUEST_METHOD"] == "POST" && !empty($_POST)) {

                                    $fk_id_recipe = $_POST["id_recipe"];
                                    $id_paragraph = $_POST["id_paragraph"];
                                    $order_paragraph = $_POST["order_paragraph"];

                                    $array_id_paragraphs = ParagraphDAO::findAllOrderGreaterThan($order_paragraph, $fk_id_recipe);

                                    ParagraphDAO::deleteParagraphRecipe($fk_id_recipe, $id_paragraph, $order_paragraph);
                                    foreach ($array_id_paragraphs as $id_paragraph) {
                                        ParagraphDAO::orderDownParagraphRecipe($id_paragraph['id_paragraph']);
                                    }

                                    $steps_recipe = ParagraphDAO::findAllStepsForOneRecipe($fk_id_recipe);

                                    $steps = [];
                                    foreach ($steps_recipe as $key => $step) {
                                        $steps[$key]['id_paragraph'] = $step->getId_paragraph();
                                        $steps[$key]['content_paragraph'] = $step->getContent_paragraph();
                                        $steps[$key]['order_paragraph'] = $step->getOrder_paragraph();
                                        $steps[$key]['fk_id_recipes'] = $step->getFk_id_recipes();
                                    }
                                    echo json_encode($steps);
                                    die();
                                }
                            }

                            // MOVE UP PARAGRAPHS
                            if ((isset($_GET['option'])) && (($_GET['option']) == "moveupparagraphs")) {

                                if ($_SERVER["REQUEST_METHOD"] == "POST" && !empty($_POST)) {

                                    $fk_id_recipe = $_POST["id_recipe"];
                                    $id_paragraph = $_POST["id_paragraph"];
                                    $order_paragraph = $_POST["order_paragraph"];

                                    $id_paragraph_before = ParagraphDAO::findParagraphBefore($order_paragraph, $fk_id_recipe);
                                    ParagraphDAO::orderUpParagraphRecipe($id_paragraph_before);
                                    ParagraphDAO::orderDownParagraphRecipe($id_paragraph);

                                    $steps_recipe = ParagraphDAO::findAllStepsForOneRecipe($fk_id_recipe);

                                    $steps = [];
                                    foreach ($steps_recipe as $key => $step) {
                                        $steps[$key]['id_paragraph'] = $step->getId_paragraph();
                                        $steps[$key]['content_paragraph'] = $step->getContent_paragraph();
                                        $steps[$key]['order_paragraph'] = $step->getOrder_paragraph();
                                        $steps[$key]['fk_id_recipes'] = $step->getFk_id_recipes();
                                    }
                                    echo json_encode($steps);
                                    die();
                                }
                            }

                            // MOVE DOWN PARAGRAPHS
                            if ((isset($_GET['option'])) && (($_GET['option']) == "movedownparagraphs")) {

                                if ($_SERVER["REQUEST_METHOD"] == "POST" && !empty($_POST)) {

                                    $fk_id_recipe = $_POST["id_recipe"];
                                    $id_paragraph = $_POST["id_paragraph"];
                                    $order_paragraph = $_POST["order_paragraph"];

                                    $id_paragraph_after = ParagraphDAO::findParagraphAfter($order_paragraph, $fk_id_recipe);
                                    ParagraphDAO::orderDownParagraphRecipe($id_paragraph_after);
                                    ParagraphDAO::orderUpParagraphRecipe($id_paragraph);

                                    $steps_recipe = ParagraphDAO::findAllStepsForOneRecipe($fk_id_recipe);

                                    $steps = [];
                                    foreach ($steps_recipe as $key => $step) {
                                        $steps[$key]['id_paragraph'] = $step->getId_paragraph();
                                        $steps[$key]['content_paragraph'] = $step->getContent_paragraph();
                                        $steps[$key]['order_paragraph'] = $step->getOrder_paragraph();
                                        $steps[$key]['fk_id_recipes'] = $step->getFk_id_recipes();
                                    }
                                    echo json_encode($steps);
                                    die();
                                }
                            }
                        } else {
                            header('Location:' . BASE_URL . "forbidden");
                            exit();
                        };
                    }
                }
            }
        }
    }
}
