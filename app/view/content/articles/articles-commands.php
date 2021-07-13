    <!-- Main -->
    <main class="container-lg wrapper-commands">
        <div class="row d-flex">
            <!-- Nav Location -->
            <div class="row mt-2">
                <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="<?php echo BASE_URL ?>articles" class="bc">Articles</a></li>
                        <li class="breadcrumb-item org" aria-current="page">Commandes</li>
                    </ol>
                </nav>
            </div>

            <br>

            <!-- Titles Page -->
            <div class="col-12">

                <div class="row">
                    <h1>Commandes</h1>
                    <h5>Consultation des commandes</h5>
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
                    <div class="col-7">
                        <table class="table" id="allCommandsTable" data-toggle="table" data-sortable="true" data-pagination="true" data-pagination-next-text="Next" data-search="true" data-search-selector="#searchCommands" data-locale="fr-FR">
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
                                foreach ($arrayCommands as $element) {
                                ?>
                                    <tr id="<?= $element->getId_command() ?>">
                                        <td>
                                            <?= $element->getId_command() ?>
                                        </td>
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
                    <div class="col-4">
                        <div class="row d-flex justify-content-between mb-1">
                            <div class="col-8">
                                <h2>Détails</h2>
                            </div>
                            <div class="col-2 d-flex align-items-center">
                                <div class="px-2 bg-warning" id="idCommandSelected"></div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="d-flex flex-column form-control shadow" id="detailsCommands">
                                Veuillez selectionner une ligne dans le tableau afin d'accéder aux détails d'une commande
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </main>

    <script>
        const ROOT = '<?= BASE_URL ?>';
    </script>