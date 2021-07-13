<!-- Create new recipe object -->
<?php if (!isset($recipe) || empty($recipe)) {
    $recipe = new Recipe();
} ?>

<!-- Main -->
<main class="container-lg wrapper-recipe-create">

    <!-- Nav Location -->
    <div class="row mt-2">
        <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?php echo BASE_URL ?>recipes" class="bc">Recettes</a></li>
                <li class="breadcrumb-item org" aria-current="page">Création</li>
            </ol>
        </nav>
    </div>


    <!-- Title Page -->
    <div class="row">
        <div class="col">
            <h1>Création d'une Recette</h1>
            <br>
        </div>
    </div>

    <!-- Section Top -->
    <div class="row d-flex  justify-content-between">

        <!-- Input Informations Recipe-->
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
                        <input type="text" class="form-control" id="inputRecipeType" placeholder="" name="time_recipe" value="<?= $recipe->getTime_recipe() ?>">
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
    </div>
</main>