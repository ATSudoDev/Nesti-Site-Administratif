    <!-- Main -->
    <main class="container-lg wrapper-recipe-create">

        <!-- Nav Location -->
        <div class="row mt-2">
            <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="<?php echo BASE_URL ?>recipes" class="bc">Recettes</a></li>
                    <li class="breadcrumb-item org" aria-current="page">Édition</li>
                </ol>
            </nav>
        </div>

        <!-- Alertes -->
        <?php
        if (isset($_SESSION['recipeCreated'])) {
        ?>
            <div class="alert alert-success" role="alert" onclick="removeAlert(this)">
                Votre recette a bien été créée. <br><br>
                Nous vous recommandons vivement de lui ajouter des informations complémentaires tel qu'une image, des ingrédients et des étapes de préparations.
            </div>
        <?php }
        unset($_SESSION['recipeCreated']); ?>

        <?php if (isset($_SESSION['recipeUpdated'])) {
        ?>
            <div class="alert alert-success" role="alert" onclick="removeAlert(this)">
                Votre recette a bien été mis à jour.
            </div>
        <?php }
        unset($_SESSION['recipeUpdated']); ?>

        <!-- Title Page -->
        <div class="row">
            <div class="col">
                <h1>Édition d'une Recette</h1>
                <br>
            </div>
        </div>

        <!-- Section Top -->
        <div class="row d-flex justify-content-between">

            <!-- Article Input Informations Recipe-->
            <div class="col-lg-4 col-sm-12 mb-sm-4">
                <form method="POST" class="application">

                    <!-- Input Name Recipe -->
                    <div class="row d-flex mb-2">
                        <div class="col-12">
                            <label for="inputRecipeName">Nom de la recette</label>
                            <input type="text" class="form-control" id="inputRecipeName" placeholder="Exemple : Gâteau au chocolat" name="name_recipe" value="<?= $recipe->getName_recipe() ?>">
                        </div>
                    </div>

                    <!-- Error Name Recipe -->
                    <div>
                        <?php if (!empty($recipe->getNameError())) : ?>
                            <span class="badge bg-danger mb-2"><?= $recipe->getNameError() ?></span>
                        <?php endif; ?>
                    </div>

                    <!-- Input Difficulty Recipe -->
                    <div class="row d-flex mb-2 justify-content-between">
                        <div class="col-8">
                            <label for="inputRecipeDifficulty">Difficulté (note sur 5)</label>
                        </div>
                        <div class="col-2">
                            <input type="text" class="form-control" id="inputRecipeDifficulty" placeholder="" name="difficulty_recipe" value="<?= $recipe->getDifficulty_recipe() ?>">
                        </div>
                    </div>

                    <!-- Error Difficulty Recipe -->
                    <div>
                        <?php if (!empty($recipe->getDifficultyError())) : ?>
                            <span class="badge bg-danger mb-2"><?= $recipe->getDifficultyError() ?></span>
                        <?php endif; ?>
                    </div>

                    <!-- Input Number Person Recipe -->
                    <div class="row d-flex mb-2 justify-content-between">
                        <div class="col-8">
                            <label for="inputRecipeNbPerson">Nombre de personnes</label>
                        </div>
                        <div class="col-2">
                            <input type="text" class="form-control" id="inputRecipeNbPerson" placeholder="" name="number_person_recipe" value="<?= $recipe->getNumber_person_recipe() ?>">
                        </div>

                    </div>

                    <!-- Error Number Person Recipe -->
                    <div>
                        <?php if (!empty($recipe->getNumberPersonError())) : ?>
                            <span class="badge bg-danger mb-2"><?= $recipe->getNumberPersonError() ?></span>
                        <?php endif; ?>
                    </div>

                    <!-- Input Time Preparation Recipe -->
                    <div class="row d-flex mb-2 justify-content-between">
                        <div class="col-9">
                            <label for="inputRecipeType">Temps de préparation (en minutes)</label>
                        </div>
                        <div class="col-2">
                            <input type="text" class="form-control" id="inputRecipeType" placeholder="" name="time_recipe" value="<?= $recipe->getDisplayTimeM_recipe() ?>">
                        </div>
                    </div>

                    <!-- Error Time Preparation Recipe -->
                    <div>
                        <?php if (!empty($recipe->getTimeError())) : ?>
                            <span class="badge bg-danger mb-2"><?= $recipe->getTimeError() ?></span>
                        <?php endif; ?>
                    </div>

                    <!-- Input State Recipe -->
                    <div class="row d-flex justify-content-between">
                        <div class="col-6">
                            <label for="inputRecipeState">État</label>
                        </div>
                        <div class="col-4 d-flex justify-content-end">
                            <select name="stateRecipe" id="inputRecipeState">
                                <option value="a" <?php if ($recipe->getState_recipe() == 'a') {
                                                        echo 'selected';
                                                    }; ?>>Actif</option>
                                <option value="b" <?php if ($recipe->getState_recipe() == 'b') {
                                                        echo 'selected';
                                                    }; ?>>Bloqué</option>
                                <option value="w" <?php if ($recipe->getState_recipe() == 'w') {
                                                        echo 'selected';
                                                    }; ?>>En attente</option>
                            </select>
                        </div>
                    </div>

                    <br>

                    <!-- Buttons Validation / Reset -->
                    <div class="row d-flex justify-content-around">

                        <!-- Button Validation -->
                        <button class="btn btn-lg btn-validation" type="submit">Valider</button>

                        <!-- Button Reset -->
                        <button class="btn btn-lg btn-reset" type="reset" onclick="resetUser()">Annuler</button>

                    </div>
                </form>
            </div>


            <!-- Picture Recipe -->
            <div class="col-lg-6 col-sm-12">

                <div id="alertes-recipe-image">
                    <!-- ALERTES IMAGE DISPLAY HERE -->
                </div>

                <div class="application d-flex justify-content-center">
                    <form id="formPictureRecipe" method="post" enctype="multipart/form-data">
                        <div id="display-img-recipe" class='preview d-flex justify-content-center mb-3' style="background-image: url('<?= BASE_URL ?>public/images/recipes/<?= $name_picture['image_name'] ?> ')">
                            <!-- IMAGE DISPLAY HERE -->
                        </div>
                        <div class='d-flex justify-content-center'>
                            <div class='d-flex align-items-center me-2'>
                                <input type="file" id="InputFileEditRecipe" name="file" />
                            </div>
                            <div class='d-flex justify-content-center me-2'>
                                <button class="btn btn-lg btn-validation" id="button-upload-picture-recipe">Ajouter</button>
                            </div>
                            <button class="btn btn-delete" data-bs-toggle="modal" data-bs-target="#staticBackdropImage">
                                <i class="fas fa-trash"> </i>
                            </button>
                        </div>

                        <!-- Modal Delete Picture -->
                        <div class="modal fade" id="staticBackdropImage" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabelImage" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="staticBackdropLabelImage">Supprimer l'image</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        Vous êtes sur le point de supprimer l'image associée à cette recette. Êtes-vous sûr de vouloir réaliser cette action ?
                                    </div>
                                    <div class="modal-footer">
                                        <button class="btn btn-danger" data-bs-dismiss="modal">Non</button>
                                        <button id="button-delete-picture-recipe" class="btn btn-success" data-bs-dismiss="modal">Oui</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <br>

        <!-- Section Preparation -->
        <div class="row d-flex justify-content-between mb-4">

            <div class="col-lg-7 col-sm-12">

                <!-- Title -->
                <div class="row">
                    <div class="col">
                        <h1>Préparation</h1>
                    </div>
                </div>

                <br>

                <div id="alertes-recipe-preparations">
                    <!-- ALERTES PREPARATIONS DISPLAY HERE -->
                </div>

                <!-- Bloc Preparation -->
                <div class="application mb-4">
                    <div id="stepsPreparation">
                        <!-- PARAGRAPHS LOAD HERE -->
                    </div>

                    <!-- Button Plus -->
                    <div id="row-add-preparation" class="row justify-content-end">
                        <button class="btn" id="buttonAddStepPreparation" type="submit"><i class="fas fa-plus"></i></button>
                    </div>

                    <!-- Modal Delete Preparation -->
                    <div class="modal fade" id="deletePreparation" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="labelDeletePreparation" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="labelDeletePreparation">Supprimer une étape de préparation</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    Vous êtes sur le point de supprimer une étape de préparation à cette recette. Êtes-vous sûr de vouloir réaliser cette action ?
                                </div>
                                <div class="modal-footer">
                                    <button class="btn btn-danger" data-bs-dismiss="modal">Non</button>
                                    <button id="button-delete-preparation-recipe" class="btn btn-success" data-bs-dismiss="modal">Oui</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <div class="col-lg-4 col-sm-12">

                <!-- Title -->
                <div class="row">
                    <h1>Liste des Ingrédients</h1>
                </div>

                <br>

                <div id="alertes-recipe-ingredients">
                    <!-- ALERTES INGREDIENTS DISPLAY HERE -->
                </div>

                <div class="row shadow rounded">
                    <div class="col-12 mt-3">
                        <ul id="listIngredients">
                            <?php foreach ($ingredients_recipe as $element) { ?>
                                <li class="justify-content-between mb-1">
                                    <?= $element->getQuantity_ingredient() . " " . $element->getNameMeasureUnit() . " de " . $element->getNameProduct() ?>
                                    <button class="buttonDeleteIngredient rounded" data-id-recipe="<?= $element->getFk_id_recipe() ?>" data-quantity="<?= $element->getQuantity_ingredient() ?>" data-id-product="<?= $element->getFk_id_product() ?>" data-id-measure-unit="<?= $element->getFk_id_measure_unit() ?>" data-bs-toggle="modal" data-bs-target="#deleteIngredient">
                                        <i class="fas fa-times"></i>
                                    </button>
                                <?php } ?>
                                <!-- Add <li> here -->
                        </ul>
                    </div>

                    <!-- Modal Delete Ingredient-->
                    <div class="modal fade" id="deleteIngredient" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="labelDeleteIngredient" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="labelDeleteIngredient">Supprimer un ingrédient</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    Vous êtes sur le point de supprimer cet ingrédient. Êtes-vous sûr de vouloir réaliser cette action ?
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Non</button>
                                    <button id="button-delete-ingredient-recipe" class="btn btn-success" data-bs-dismiss="modal">Oui</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <br>

                <div>
                    <div class="row d-flex justify-content-center">
                        <div class="application rounded">
                            <div class="col-12">

                                <div class="row mb-1 justify-content-center">
                                    <label for="inputRecipeName">Ajouter un ingrédient</label>
                                </div>
                                <div class="row mb-3">
                                    <input type="text" class="form-control" id="inputIngredientName" placeholder="Exemple : Banane">
                                </div>

                                <div class="row d-flex justify-content-between">
                                    <div class="col-3">
                                        <input type="text" class="form-control" id="inputIngredientQuantity" placeholder="Quantité">
                                    </div>
                                    <div class="col-5">
                                        <input type="text" class="form-control" id="inputIngredientUnit" placeholder="Unité">
                                    </div>
                                    <div class="col-3 d-flex justify-content-end">
                                        <button id="buttonAddIngredient" class="btn btn-validation">Ajouter</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <br>

    </main>

    <script>
        const ROOT = '<?= BASE_URL ?>';
        const idRecipe = '<?= $_GET['id'] ?>';
    </script>