<body>

    <!-- Alertes -->
    <?php

    if (isset($_SESSION['userDisconnected'])) {
    ?><div>
            <div class="alert alert-success mx-5 mt-2" role="alert" onclick="removeAlert(this)">
                Vous avez été déconnecté.
            </div>
        </div>
    <?php }
    unset($_SESSION['userDisconnected']); ?>

    <div id="wrapper_connection">

        <!-- Logo -->
        <div id="logo_nesti">
            <img src="public/images/logo/Nesti-logo-big.png" alt="Logo Nesti">
        </div>

        <div class="row application" id="container_connection">

            <form method="POST">

                <!-- Title -->
                <div class="row">
                    <h1>Connexion</h1>
                </div>

                <!-- Username -->
                <div class="row justify-content-center">
                    <div class="col-11 no-padding">
                        <label class="no-margin ml-5"><b>Nom d'utilisateur</b></label>
                        <div class="d-flex align-items-center mb-2">
                            <i class="fas fa-user-alt me-2"></i>
                            <input class="rounded" type="text" id="Connection-Username" placeholder="Entrer le nom d'utilisateur" name="logUsername" value ='AxelTeillier' required>
                        </div>
                    </div>
                </div>

                <!-- Error Username -->
                <div>
                    <?php if (!empty($error_username)) : ?>
                        <span class="alerte-error-connection badge bg-danger mb-3"><?= $error_username ?></span>
                    <?php endif; ?>
                </div>

                <!-- Password -->
                <div class="row justify-content-center">
                    <div class="col-11 no-padding">
                        <label class="no-margin ml-5"><b>Mot de passe</b></label>
                        <div class="d-flex align-items-center">
                            <i class="fas fa-lock me-2"></i>
                            <input class="rounded" type="password" id="Connection-Password" placeholder="Entrer le mot de passe" name="logPassword" value="D05Fj@bcg=8/aB#3" required>
                        </div>
                    </div>
                </div>

                <!-- Error Password -->
                <div>
                    <?php if (!empty($error_password)) : ?>
                        <span class="alerte-error-connection badge bg-danger mb-3"><?= $error_password ?></span>
                    <?php endif; ?>
                </div>

                <!-- Button Connection -->
                <div class="row justify-content-center">
                    <div class="col-4 no-padding">
                        <input class="no-margin rounded" type="submit" id='Connection' value='Valider'>
                    </div>
                </div>

                <!-- Error Roles -->
                <div>
                    <?php if (!empty($error_roles)) : ?>
                        <span class="alerte-error-roles badge bg-danger mt-3"><?= $error_roles ?></span>
                    <?php endif; ?>
                </div>

            </form>
        </div>
    </div>
    <script>
        console.log($disconnection)
    </script>
</body>

</html>