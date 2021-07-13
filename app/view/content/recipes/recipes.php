<!-- Main -->
    <main class="container-lg wrapper-recipes">
        <br>

        <!-- Alertes -->
        <?php
        if (isset($_SESSION['deleteRecipe'])) {
        ?>
            <div class="alert alert-danger" role="alert" onclick="removeAlert(this)">
                La recette a bien été bloquée.
            </div>
        <?php }
        unset($_SESSION['deleteRecipe']); ?>

        <!-- Title Page -->
        <div class="row">
            <div class="col-12">
                <h1>Recettes</h1>
                <br>
            </div>
        </div>

        <!-- User Top Page -->
        <div class="row d-flex justify-content-between">

            <!-- Research Bar -->
            <div class="col-8 d-flex align-items-center no-padding">
                <input type="search" class="form-control-lg shadow mr-2" id="searchRecipe" placeholder="Rechercher une recette">
                <i class="fas fa-search ms-2"></i>
            </div>

            <!-- Buttons Container -->
            <div class="col-4 d-flex justify-content-end no-padding">

                <!-- Button Add -->
                <a href="recipes/create" class="btn btn-lg btn-outline-secondary btn-add shadow">
                    <i class="fas fa-plus-circle"></i>
                    Ajouter
                </a>
            </div>
        </div>

        <br>

        <!-- Table Container -->
        <table class="table" data-toggle="table" data-sortable="true" data-pagination="true" data-pagination-next-text="›" data-search="true" data-search-selector="#searchRecipe" data-locale="fr-FR">
            <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Nom</th>
                    <th scope="col">Difficulté (sur 5)</th>
                    <th scope="col">Pour</th>
                    <th scope="col">Temps</th>
                    <th scope="col">Chef</th>
                    <th scope="col">État</th>
                    <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>

                <?php
                foreach ($arrayRecipes as $element) {
                ?>
                    <tr>
                        <th scope="row">
                            <?= $element->getId_recipe() ?>
                        </th>
                        <td>
                            <?= $element->getName_recipe() ?>
                        </td>
                        <td>
                            <?= $element->getDifficulty_recipe() ?>
                        </td>
                        <td>
                            <?= $element->getNumber_person_recipe() ?>
                        </td>
                        <td>
                            <?= $element->getDisplayTimeHMS_recipe() ?>
                        </td>
                        <td>
                            <?= $element->getNameChiefRecipe() ?>
                        </td>
                        <td>
                            <?= $element->getDisplayState_recipe() ?>
                        </td>
                        <td>

                           <!-- Button modify -->
                           <a class="btn bt-tbl mb-2 rounded bg-warning" href = "<?= BASE_URL . "recipes/edit/" .  $element->getId_recipe() ?>">
                                    Modifier
                                </a>

                            <!-- Form POST Delete -->
                            <form method="POST" action="<?= BASE_URL . "recipes/delete/" . $element->getId_recipe() ?>" class="form-table rounded bg-danger">

                                <!-- Button trigger modal -->
                                <button type="button" class="btn bt-tbl" data-bs-toggle="modal" data-bs-target="<?= '#deleteRecipe' .  $element->getId_recipe()  ?>">
                                    Supprimer
                                </button>

                                <!-- Modal -->
                                <div class="modal fade" id="<?= 'deleteRecipe' .  $element->getId_recipe()  ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="<?='staticBackdropLabel'.  $element->getId_recipe() ?>" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="<?='staticBackdropLabel'.  $element->getId_recipe() ?>">Supprimer recette</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                Vous êtes sur le point de supprimer la recette nommée <b><?= $element->getName_recipe() ?></b>. Êtes-vous sûr de vouloir réaliser cette action ?
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Non</button>
                                                <button type="submit" class="btn btn-success">Oui</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </td>
                    </tr>

                <?php
                }
                ?>

            </tbody>
        </table>
        <br>
    </main>