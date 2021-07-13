<!-- Create new user object -->
<?php if (!isset($user) || empty($user)) {
    $user = new User();
}
?>

<!-- Main -->
<main class="container-lg">

    <!-- Nav Location -->
    <div class="row mt-2">
        <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?php echo BASE_URL ?>users" class="bc">Utilisateur</a></li>
                <li class="breadcrumb-item org" aria-current="page">Édition</li>
            </ol>
        </nav>
    </div>

    <!-- Alertes -->
    <!-- For the edit -->
    <?php
    if (isset($_SESSION['userUpdated'])) {
    ?>
        <div class="alert alert-success" role="alert" onclick="removeAlert(this)">
            L'utilisateur a bien été mis à jour.
        </div>
    <?php }
    unset($_SESSION['userUpdated']); ?>

    <!-- For the password -->
    <?php
    if (isset($_SESSION['password'])) {
    ?>
        <div class="alert alert-success" role="alert" onclick="">
            Le mot de passe a bien été modifié.
            <br><br>
            Voici le nouveau mot de passe de l'utilisateur :<b> <?= $_SESSION['password'] ?></b>
            <br><br>
            Veuillez le noter attentivement car il ne vous sera plus jamais proposé de nouveau !
        </div>
    <?php }
    unset($_SESSION['password']); ?>

    <!-- For the comments -->
    <?php if (isset($_SESSION['commentdisapproved'])) { ?>

        <div class="alert alert-success" role="alert" onclick="removeAlert(this)">
            Le commentaire a bien été bloqué.
        </div>
    <?php }
    unset($_SESSION['commentdisapproved']); ?>

    <?php if (isset($_SESSION['commentapproved'])) { ?>

        <div class="alert alert-success" role="alert" onclick="removeAlert(this)">
            Le commentaire a bien été validé.
        </div>
    <?php }
    unset($_SESSION['commentapproved']); ?>

    <!-- Title Page -->
    <div class="row">
        <div class="col-12">
            <h1>Edition des utilisateurs</h1>
            <br>
        </div>
    </div>

    <!-- Section Top -->
    <div class="row d-flex justify-content-around mr-2">

        <!-- Inputs User Informations -->
        <div class="col-lg-5 col-sm-12 mb-sm-4">
            <form method="POST" class="application rounded">

                <!-- Input LastName User -->
                <div class="row mb-2">
                    <label for="inputUserLastName">Nom *</label>
                    <input type="text" class="form-control" id="inputUserLastName" name="lastname_user" value="<?= $user->getLastname_user() ?>">
                </div>

                <!-- Error LastName User -->
                <div>
                    <?php if (!empty($user->getLastnameError())) : ?>
                        <span class="badge bg-danger mb-2"><?= $user->getLastnameError() ?></span>
                    <?php endif; ?>
                </div>

                <!-- Input FirstName User -->
                <div class=" row mb-2">
                    <label for="inputUserFirstName">Prénom *</label>
                    <input type="text" class="form-control" id="inputUserFirstName" name="firstname_user" value="<?= $user->getFirstname_user() ?>">
                </div>

                <!-- Error FirstName User -->
                <div>
                    <?php if (!empty($user->getFirstnameError())) : ?>
                        <span class="badge bg-danger mb-2"><?= $user->getFirstnameError() ?></span>
                    <?php endif; ?>
                </div>

                <!-- Input Address1 User -->
                <div class=" row mb-2">
                    <label for="inputUserAddress1">Adresse *</label>
                    <input type="text" class="form-control" id="inputUserAddress1" name="address1_user" value="<?= $user->getAddress1_user() ?>">
                </div>

                <!-- Error Address1 User -->
                <div>
                    <?php if (!empty($user->getAddress1Error())) : ?>
                        <span class="badge bg-danger mb-2"><?= $user->getAddress1Error() ?></span>
                    <?php endif; ?>
                </div>

                <!-- Input Address2 User -->
                <div class="row mb-2">
                    <label for="inputUserAddress2">Complément d'adresse</label>
                    <input type="text" class="form-control" id="inputUserAddress2" name="address2_user" value="<?= $user->getAddress2_user() ?>">
                </div>

                <!-- Error Address2 User -->
                <div>
                    <?php if (!empty($user->getAddress2Error())) : ?>
                        <span class="badge bg-danger mb-2"><?= $user->getAddress2Error() ?></span>
                    <?php endif; ?>
                </div>

                <!-- Input City User -->
                <div class="row mb-2">
                    <label for="inputUserCity">Ville *</label>
                    <input type="text" class="form-control" id="inputUserCity" name="name_city" value='<?= $city->getName_city() ?>'>
                </div>

                <!-- Error City User -->
                <div>
                    <?php if (!empty($city->getNameCityError())) : ?>
                        <span class="badge bg-danger mb-2"><?= $city->getNameCityError() ?></span>
                    <?php endif; ?>
                </div>

                <!-- Input Postcode User -->
                <div class="row mb-2">
                    <label for="inputUserPostCode">Code postal *</label>
                    <input type="text" class="form-control" id="inputUserPostCode" name="postcode_user" value="<?= $user->getPostcode_user() ?>">
                </div>

                <!-- Error Postcode User -->
                <div>
                    <?php if (!empty($user->getPostcodeError())) : ?>
                        <span class="badge bg-danger mb-2"><?= $user->getPostcodeError() ?></span>
                    <?php endif; ?>
                </div>

                <div class="row">

                    <!-- Input Role User -->
                    <div class="col-6">

                        <div>Rôle(s) *</div> <br>

                        <input type="checkbox" id="admin" name="inputUserRole" value="admins" <?php foreach ($user->getRoles_user() as $role) {
                                                                                                    if ($role == 'admins') {
                                                                                                        echo 'checked disabled';
                                                                                                    };
                                                                                                }; ?>>
                        <label for="admin"> Administrateur </label><br>

                        <input type="checkbox" id="mod" name="inputUserRole" value="moderators" <?php foreach ($user->getRoles_user() as $role) {
                                                                                                    if ($role == 'moderators') {
                                                                                                        echo 'checked disabled';
                                                                                                    };
                                                                                                }; ?>>
                        <label for="mod"> Modérateur </label><br>

                        <input type="checkbox" id="chief" name="inputUserRole" value="chiefs" <?php foreach ($user->getRoles_user() as $role) {
                                                                                                    if ($role == 'chiefs') {
                                                                                                        echo 'checked disabled';
                                                                                                    };
                                                                                                }; ?>>
                        <label for="chief"> Chef </label><br>

                    </div>

                    <!-- Input State User -->
                    <div class="col-6">
                        <label for="inputUserState">État *</label> <br>
                        <select name="state_user" id="inputUserState">
                            <option value="a" <?php if ($user->getState_user() == 'a') {
                                                    echo 'selected';
                                                }; ?>>Actif</option>
                            <option value="b" <?php if ($user->getState_user() == 'b') {
                                                    echo 'selected';
                                                }; ?>>Bloqué</option>
                            <option value="w" <?php if ($user->getState_user() == 'w') {
                                                    echo 'selected';
                                                }; ?>>En attente</option>
                        </select>
                    </div>
                </div>

                <br>

                <!-- Buttons Validation / Reset -->
                <div class="row d-flex justify-content-around">

                    <!-- Button Validation -->
                    <button class="btn btn-lg btn-validation" type="submit">Valider </button>

                    <!-- Button Reset -->
                    <button class="btn btn-lg btn-reset" type="reset" onclick=resetUser()>Annuler</button>
                </div>
            </form>

        </div>

        <!-- Article Input Informations Users-->
        <div class="col-lg-5 col-sm-12">

            <div class="row">
                <h2>Informations</h2>
            </div>
            <div class="list">
                <div class="row">
                    <p> Date de création : <?= $user->getDisplayDate_creation_user() ?> <br>
                        Dernière connexion : <?= $user->getLastConnectionUser() ?></p>
                </div>
                <div class="row">
               
                    <h5> Utilisateur </h5>
                    <p>
                    Nombre de commandes : <?= $user->getNumberCommandsUser() ?><br>
                    Montant total des commandes : <?= $user->getAllCommandsPricesUser() ?> €<br>
                    Dernière commande : <?= $user->getLastCommandPriceUser() ?> €</p>
                </div>

                <?php $roles_user = $user->getRoles_user() ?>
                <?php foreach ($roles_user as $role) {
                    if ($role == 'admins') { ?>
                        <div class="row">
                            <h5> Administrateur </h5>
                            <p>
                            Nombre d'importation faites : <?= $user->getNumberImportsAdmin() ?> <br>
                            Date de la dernière importation : <?= $user->getDateLastImportAdmin() ?> </p>
                        </div>
                    <?php
                    }
                    if ($role == 'moderators') { ?>
                        <div class="row">
                            <h5> Modérateur </h5>
                            <p>
                            Nombre de commentaire validé : <?= $user->getNumberApprovedCommentsModerator() ?> <br>
                            Nombre de commentaire bloqué : <?= $user->getNumberDisapprovedCommentsModerator() ?> </p>
                        </div>
                    <?php
                    }
                    if ($role == 'chiefs') { ?>
                        <div class="row">
                            <h5> Chef </h5>
                            <p>
                            Nombre de recette : <?= $user->getNumberRecipesChief() ?> <br>
                            Dernière recette : <?= $user->getNameLastRecipeChief() ?> </p>
                        </div>
                <?php
                    }
                }
                ?>
            </div>

            <br>

            <!-- Form POST Reset Password -->
            <form method="POST" action="<?= BASE_URL . "users/edit/" . $id . "/resetpassword" ?>" class="">

                <!-- Button Reset Password -->
                <div class="row d-flex justify-content-center">
                    <button type="button" class="btn btn-lg btn-reset" data-bs-toggle="modal" data-bs-target="#resetPassword">
                        Réinitialisation du mot de passe
                    </button>
                </div>

                <!-- Input Hidden POST -->
                <input type="hidden" name="id_user" value="<?= $id ?>">

                <!-- Modal Reset Password-->
                <div class="modal fade" id="resetPassword" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="staticBackdropLabel">Réinitialisation mot de passe</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                Vous êtes sur le point de réinitialiser le mot de passe de l'utilisateur.
                                Cette action est définitive et irréversible.
                                <br><br>
                                Êtes-vous sûr de vouloir réaliser cette action ?
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Non</button>
                                <button type="submit" class="btn btn-success">Oui</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <br>
    <br>

    <!-- Section Middle -->
    <div class="container-lg wrapper-commands">

        <div class="row d-flex">

            <!-- Titles Page -->
            <div class="col-12">

                <div class="row">
                    <h1>Commandes</h1>
                    <h5>Consultation de ses commandes</h5>
                </div>

                <br>

                <!-- Research Bar Commands -->
                <div class="row">
                    <div class="col d-flex align-items-center no-padding">
                        <input type="search" class="form-control-lg shadow mr-2" id="searchCommands" placeholder="Rechercher une commande">
                        <i class="fas fa-search ms-2"></i>
                    </div>

                </div>

                <br>

                <!-- Table Container Commands -->
                <div class="row justify-content-between">
                    <div class="col-lg-7 col-sm-12">
                        <table class="table" id="commandsUserTable" data-toggle="table" data-sortable="true" data-pagination="true" data-pagination-next-text="Next" data-search="true" data-search-selector="#searchCommands" data-locale="fr-FR">
                            <thead>
                                <tr>
                                    <th scope="col">ID</th>
                                    <th scope="col">Utilisateur</th>
                                    <th scope="col">Montant</th>
                                    <th scope="col">Date de création</th>
                                    <th scope="col">État</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                foreach ($arrayCommandsUser as $element) {
                                ?>
                                    <tr id="<?= $element->getId_command() ?>">
                                        <th scope="row">
                                            <?= $element->getId_command() ?>
                                        </th>
                                        <td>
                                            <?= $element->getNameUserCommands() ?>
                                        </td>
                                        <td>
                                            <?= $element->getTotalPriceCommand() ?> €
                                        </td>
                                        <td>
                                            <?= $element->getDisplayDate_creation_command() ?>
                                        </td>
                                        <td>
                                            <?= $element->getDisplayState_command() ?>
                                        </td>
                                    </tr>

                                <?php
                                }
                                ?>

                            </tbody>
                        </table>
                    </div>

                    <!-- Details -->
                    <div class="col-lg-4 col-sm-12">
                        <div class="row d-flex justify-content-between mb-1">
                            <div class="col-8">
                                <h2>Détails</h2>
                            </div>
                            <div class="col-2 d-flex align-items-center">
                                <div class="px-2 bg-warning" id="idCommandUserSelected"></div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="d-flex flex-column form-control shadow" id="detailsCommandsUser">
                                Veuillez selectionner une ligne dans le tableau afin d'accéder aux détails d'une commande
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>


    <br><br>

    <!-- Section Comments -->
    <div class="row d-flex">
        <div class="col-lg-12">
            <div class="row">
                <h1>Ses Commentaires</h1>
                <h5>Modération des ses commentaires</h5>
            </div>

            <br>

            <!-- Research Bar -->
            <div class="row">
                <div class="col d-flex align-items-center no-padding">
                    <input type="search" class="form-control-lg shadow mr-2" id="searchComments" placeholder="Rechercher un commentaire">
                    <i class="fas fa-search ms-2"></i>
                </div>
            </div>

            <br>

            <!-- Table Comments Container -->
            <div class="row">
                <table class="table" data-toggle="table" data-sortable="true" data-pagination="true" data-pagination-next-text="Next" data-search="true" data-search-selector="#searchComments" data-locale="fr-FR">
                    <thead>
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Titre</th>
                            <th scope="col">Recette</th>
                            <th scope="col">Contenu</th>
                            <th scope="col">Date de création</th>
                            <th scope="col">État</th>
                            <th scope="col">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($arrayCommentsUser as $element) {
                        ?>
                            <tr>
                                <th scope="row">
                                    <?= $element->getId_comment() ?>
                                </th>
                                <td>
                                    <?= $element->getTitle_comment() ?>
                                </td>
                                <td>
                                    <?= $element->getRecipe()->getName_recipe() ?>
                                </td>
                                <td>
                                    <?= $element->getContent_comment() ?>
                                </td>
                                <td>
                                    <?= $element->getDisplayDate_creation_comment() ?>
                                </td>
                                <td>
                                    <?= $element->getDisplayState_comment() ?>
                                </td>

                                <td>
                                    <!-- Form POST Approve -->
                                    <form method="POST" action="<?= BASE_URL . "users/edit/" . $id . "/commentapproved" ?>" class="form-table mb-2 rounded bg-success">

                                        <!-- Button trigger modal -->
                                        <button type="button" class="btn bt-tbl" data-bs-toggle="modal" data-bs-target="#approveComment<?= $element->getId_comment()?>">
                                            Valider
                                        </button>

                                        <!-- Input Hidden POST -->
                                        <input type="hidden" name="id_user" value="<?= $id ?>">
                                        <input type="hidden" name="id_comment" value="<?= $element->getId_comment() ?>">

                                        <!-- Modal -->
                                        <div class="modal fade" id="approveComment<?= $element->getId_comment()?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="staticBackdropLabel">État commentaire</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        Vous êtes sur le point de valider ce commentaire. Êtes-vous sûr de vouloir réaliser cette action ?
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Non</button>
                                                        <button type="submit" class="btn btn-success">Oui</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </form>

                                    <!-- Form POST Disapprove -->
                                    <form method="POST" action="<?= BASE_URL . "users/edit/" . $id . "/commentdisapproved" ?>" class="form-table rounded bg-danger">

                                        <!-- Button trigger modal -->
                                        <button type="button" class="btn bt-tbl" data-bs-toggle="modal" data-bs-target="#disapproveComment<?= $element->getId_comment()?>">
                                            Bloquer
                                        </button>

                                        <!-- Input Hidden POST -->
                                        <input type="hidden" name="id_user" value="<?= $id ?>">
                                        <input type="hidden" name="id_comment" value="<?= $element->getId_comment() ?>">

                                        <!-- Modal -->
                                        <div class="modal fade" id="disapproveComment<?= $element->getId_comment()?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="staticBackdropLabel">État commentaire</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        Vous êtes sur le point de bloquer ce commentaire. Êtes-vous sûr de vouloir réaliser cette action ?
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
            </div>
            <br>
        </div>
    </div>
</main>

<script>
    const ROOT = '<?= BASE_URL ?>';
</script>