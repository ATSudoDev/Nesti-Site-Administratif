    <!-- Main -->
    <main class="container-lg">

        <!-- Nav Location -->
        <div class="row mt-2">
            <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="<?php echo BASE_URL ?>users" class="bc">Utilisateur</a></li>
                    <li class="breadcrumb-item org" aria-current="page">Création</li>
                </ol>
            </nav>
        </div>

        <br>

        <!-- Title Page -->
        <div class="row d-flex justify-content-center">
            <div class="col-10">
                <div class="row">
                    <h1>Création d'un utilisateur</h1>
                </div>

                <br>

                <!-- Section Top -->
                <div class="row">

                    <!-- User Input Informations -->
                    <form method="POST" class="application rounded">
                        <div class="row d-flex justify-content-between">
                            <div class="col-5">

                                <!-- Input LastName User -->
                                <div class="row mb-2">
                                    <label for="inputUserLastName">Nom *</label>
                                    <input type="text" class="form-control" id="inputUserLastName" name="lastname_user" value="<?= $user->getLastname_user() ?>">
                                </div>

                                <!-- Error LastName User -->
                                <div>
                                    <?php if (!empty($user->getLastnameError())) : ?>
                                        <span class="badge bg-danger mb-3"><?= $user->getLastnameError() ?></span>
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
                                        <span class="badge bg-danger mb-3"><?= $user->getFirstnameError() ?></span>
                                    <?php endif; ?>
                                </div>

                                <!-- Input Email User -->
                                <div class="row mb-2">
                                    <label for="inputUserEmail">Email *</label>
                                    <input type="text" class="form-control" id="inputUserEmail" name="email_user" value="<?= $user->getEmail_user() ?>">
                                </div>

                                <!-- Error Email User -->
                                <div>
                                    <?php if (!empty($user->getEmailError())) : ?>
                                        <span class="badge bg-danger mb-3"><?= $user->getEmailError() ?></span>
                                        <?php echo "</br>" ?>
                                    <?php endif; ?>
                                </div>

                                <!-- Input UserName User -->
                                <div class="row mb-2">
                                    <label for="inputUserName">Nom d'utilisateur *</label>
                                    <input type="text" class="form-control" id="inputUserName" name="username_user" value="<?= $user->getUsername_user() ?>">
                                </div>

                                <!-- Error UserName User -->
                                <div>
                                    <?php if (!empty($user->getUsernameError())) : ?>
                                        <span class="badge bg-danger mb-3"><?= $user->getUsernameError() ?></span>
                                    <?php endif; ?>
                                </div>

                                <!-- Input Password User -->
                                <div class="row mb-2">
                                    <label for="inputUserPassword">Mot de passe *</label>
                                    <input type="password" class="form-control" id="inputUserPassword" name="password_user" value="<?= $user->getPassword_user() ?>">
                                    <progress id="pwd-strength" value="0" max="5"></progress>
                                </div>

                                <!-- Error Password User -->
                                <div>
                                    <?php if (!empty($user->getPasswordError())) : ?>
                                        <span class="badge bg-danger mb-3"><?= $user->getPasswordError() ?></span>
                                    <?php endif; ?>
                                </div>

                                <!-- Verification Strength Password User -->
                                <div id="password_verification">
                                    <div class="font-weight-bold">Votre mot de passe doit contenir : </div>
                                    <div id='password_conditions'>
                                        <div id='pwdLength'> • Au moins 12 caractères</div>
                                        <div id='pwdLowCase'> • Une minuscule</div>
                                        <div id='pwdUpperCase'> • Une majuscule</div>
                                        <div id='pwdDigit'> • Un chiffre</div>
                                        <div id='pwdSpecial'> • Un caractère spécial</div>
                                    </div>
                                </div>

                                <br>

                            </div>

                            <div class="col-5">

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
                                    <input type="text" class="form-control" id="inputUserCity" name="name_city" value="<?= $city->getName_city() ?>">
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

                                <div class="row mb-2">

                                    <!-- Input Role User -->
                                    <div class="col-6">
                                        <div>Rôle(s)</div> <br>

                                        <input type="checkbox" id="admin" name="roles_user[]" value="admins" <?php foreach ($user->getRoles_user() as $role) {
                                                                                                                    if ($role == 'admins') {
                                                                                                                        echo 'checked';
                                                                                                                    };
                                                                                                                }; ?>>
                                        <label for="admin"> Administrateur </label><br>

                                        <input type="checkbox" id="mod" name="roles_user[]" value="moderators" <?php foreach ($user->getRoles_user() as $role) {
                                                                                                                    if ($role == 'moderators') {
                                                                                                                        echo 'checked';
                                                                                                                    };
                                                                                                                }; ?>>
                                        <label for="mod"> Modérateur </label><br>

                                        <input type="checkbox" id="chief" name="roles_user[]" value="chiefs" <?php foreach ($user->getRoles_user() as $role) {
                                                                                                                    if ($role == 'chiefs') {
                                                                                                                        echo 'checked';
                                                                                                                    };
                                                                                                                }; ?>>
                                        <label for="chief"> Chef </label><br>

                                    </div>

                                    <!-- Input State User -->
                                    <div class="col-6">
                                        <label for="inputUserState">État</label> <br>
                                        <select name="state_user" id="inputUserState">
                                            <option value="a">Actif</option>
                                            <option value="b">Bloqué</option>
                                            <option value="w">En attente</option>
                                        </select>
                                    </div>

                                </div>
                            </div>
                        </div>

                        <!-- Buttons Validation / Reset -->
                        <div class="row d-flex justify-content-around">

                            <!-- Button Validation -->
                            <button class="btn btn-lg btn-validation" type="submit">Valider</button>

                            <!-- Button Reset -->
                            <button class="btn btn-lg btn-reset" type="reset">Annuler</button>

                        </div>

                    </form>

                </div>

            </div>
        </div>

        <br>

    </main>