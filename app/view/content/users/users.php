    <!-- Main -->
    <main class="container-lg wrapper-users">
        <br>
        <!-- Alertes -->
        <!-- For the create user -->
        <?php
        if (isset($_SESSION['userCreated'])) {
        ?>
            <div class="alert alert-success" role="alert" onclick="removeAlert(this)">
                L'utilisateur a bien été créé.
            </div>
        <?php }
        unset($_SESSION['userCreated']); ?>

        <!-- For the delete user -->
        <?php
        if (isset($_SESSION['deleteUser'])) {
        ?>
            <div class="alert alert-danger" role="alert" onclick="removeAlert(this)">
                L'utilisateur a bien été bloqué.
            </div>
        <?php }
        unset($_SESSION['deleteUser']); ?>

        <!-- Title Page -->
        <div class="row">
            <div class="col-12">
                <h1>Utilisateurs</h1>
                <br>
            </div>
        </div>

        <!-- User Top Page -->
        <div class="row d-flex justify-content-between">

            <!-- Research Bar -->
            <div class="col-8 d-flex align-items-center no-padding">
                <input type="search" class="form-control-lg shadow mr-2" id="searchUser" placeholder="Rechercher un utilisateur">
                <i class="fas fa-search ms-2"></i>
            </div>

            <!-- Buttons Container -->
            <div class="col-4 d-flex justify-content-end no-padding">

                <!-- Button Add -->
                <a href="users/create" class="btn btn-lg btn-outline-secondary btn-add shadow">
                    <i class="fas fa-plus-circle"></i>
                    Ajouter
                </a>
            </div>
        </div>

        <br>

        <!-- Table Container -->
        <table class="table" data-toggle="table" data-sortable="true" data-pagination="true" data-pagination-next-text="›" data-search="true" data-search-selector="#searchUser" data-locale="fr-FR">
            <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Nom d'utilisateur</th>
                    <th scope="col">Nom</th>
                    <th scope="col">Rôle(s)</th>
                    <th scope="col">Dernière connexion</th>
                    <th scope="col">État</th>
                    <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>

                <?php
                foreach ($arrayUsers as $element) {
                ?>
                    <tr>
                        <th scope="row">
                            <?= $element->getId_user() ?>
                        </th>
                        <td>
                            <?= $element->getUsername_user() ?>
                        </td>
                        <td>
                            <?= $element->getLastname_user() ?>
                            <?= $element->getFirstname_user() ?>
                        </td>
                        <td>
                            <?= implode(", ", $element->getDisplayRoles()) ?>
                        </td>
                        <td>
                            <?= $element->getLastConnectionUser() ?>
                        </td>
                        <td>
                            <?= $element->getDisplayState_user() ?>
                        </td>
                        <td>

                                <!-- Button modify -->
                                <a class="btn bt-tbl mb-2 rounded bg-warning" href = "<?= BASE_URL . "users/edit/" .  $element->getId_user() ?>">
                                    Modifier
                                </a>

                            <!-- Form POST Delete -->
                            <form method="POST" action="<?= BASE_URL . "users/delete/" . $element->getId_user() ?>" class="form-table rounded bg-danger">

                                <!-- Button trigger modal -->
                                <button type="button" class="btn bt-tbl" data-bs-toggle="modal" data-bs-target="<?= '#deleteUser' .  $element->getId_user() ?>">
                                    Supprimer
                                </button>

                                <!-- Modal -->
                                <div class="modal fade" id="<?= 'deleteUser' .  $element->getId_user() ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="<?='staticBackdropLabel'.  $element->getId_user() ?>" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="<?='staticBackdropLabel'.  $element->getId_user() ?>">Supprimer profil utilisateur</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                Vous êtes sur le point de supprimer le profil utilisateur de <b><?= $element->getLastname_user() ?> <?= $element->getFirstname_user() ?></b>. Êtes-vous sûr de vouloir réaliser cette action ?
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