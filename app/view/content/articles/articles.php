    <!-- Main -->
    <main class="container-lg wrapper-articles">
        <br>

        <!-- Alertes -->
        <?php
        if (isset($_SESSION['deleteArticle'])) {
        ?>
            <div class="alert alert-danger" role="alert" onclick="removeAlert(this)">
                L'article a bien été bloquée.
            </div>
        <?php }
        unset($_SESSION['deleteArticle']); ?>

        <!-- Title Page -->
        <div class="row">
            <div class="col-12">
                <h1>Articles</h1>
                <br>
            </div>
        </div>

        <!-- Article Top Page -->
        <div class="row d-flex justify-content-between">

            <!-- Research Bar -->
            <div class="col-6 d-flex align-items-center no-padding">
                <input type="search" class="form-control-lg shadow mr-2" id="searchArticle" placeholder="Rechercher un article">
                <i class="fas fa-search ms-2"></i>
            </div>

            <!-- Buttons Container -->
            <div class="col-6 d-flex justify-content-end no-padding">

                <!-- Button Commands -->
                <a href="articles/commands" class="btn btn-lg btn-outline-secondary shadow me-3" id="btn-commands">
                    <i class="far fa-eye"></i>
                    Commandes
                </a>

                <!-- Button Import -->
                <a href="article/imports" class="btn btn-lg btn-outline-secondary btn-add shadow">
                    <i class="fas fa-plus-circle"></i>
                    Importer
                </a>
            </div>
        </div>

        <br>

        <!-- Table Container -->
        <table class="table" data-toggle="table" data-sortable="true" data-pagination="true" data-pagination-next-text="›" data-search="true" data-search-selector="#searchArticle" data-locale="fr-FR">
            <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Nom de l'article</th>
                    <th scope="col">Prix de vente</th>
                    <th scope="col">Type</th>
                    <th scope="col">Dernière importation</th>
                    <th scope="col">Stock</th>
                    <th scope="col">État</th>
                    <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>

                <?php
                foreach ($arrayArticles as $element) {
                ?>
                    <tr>
                        <th scope="row">
                            <?= $element->getId_article() ?>
                        </th>
                        <td>
                            <?= $element->getQuantity_unite_article() ?> <?= $element->getUnitArticle() ?> de <?= $element->getNameProduct() ?>
                        </td>
                        <td>
                            <?= $element->getPriceArticle() ?> €
                        </td>
                        <td>
                            <?= $element->getTypeArticle() ?>
                        </td>
                        <td>
                            <?= $element->getDateImportArticle() ?>
                        </td>
                        <td>
                            <?= $element->getStockArticle() ?>
                        </td>
                        <td>
                            <?= $element->getDisplayState_article() ?>
                        </td>
                        <td>

                        <!-- Button modify -->
                        <a class="btn bt-tbl mb-2 rounded bg-warning" href = "<?= BASE_URL . "articles/edit/" .  $element->getId_article() ?>">
                                    Modifier
                                </a>


                            <!-- Form POST Delete -->
                            <form method="POST" action="<?= BASE_URL . "articles/delete/" . $element->getId_article() ?>" class="form-table rounded bg-danger">

                                <!-- Button trigger modal -->
                                <button type="button" class="btn bt-tbl" data-bs-toggle="modal" data-bs-target="<?= '#deleteArticle' .  $element->getId_article() ?>">
                                    Supprimer
                                </button>

                                <!-- Modal -->
                                <div class="modal fade" id="<?= 'deleteArticle' .  $element->getId_article() ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="<?='staticBackdropLabel'.  $element->getId_article() ?>" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="<?='staticBackdropLabel'.  $element->getId_article() ?>">Supprimer article</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                Vous êtes sur le point de supprimer l'article <b><?= $element->getQuantity_unite_article() ?> <?= $element->getUnitArticle() ?> de <?= $element->getNameProduct() ?></b>. Êtes-vous sûr de vouloir réaliser cette action ?
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