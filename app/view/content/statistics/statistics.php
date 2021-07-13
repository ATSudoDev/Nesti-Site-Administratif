 <main class="container-lg wrapper-articles">
     <br>
     <!-- Title Page -->
     <div class="row">
         <div class="col-12">
             <h1>Statistiques</h1>
             <br>
         </div>
     </div>

     <!-- Statistics Top Section -->
     <div class="row d-flex justify-content-between">
         <div class="col-lg-6 col-sm-12 mb-sm-4">

             <div class="row">
                 <h2>Commandes</h2>
             </div>

             <div id="toastCommands"> </div>

             <!-- TOP 10 USERS -->
             <div class="row d-flex justify-content-between mb-1">
                 <h3>Top 10 commandes</h3>
             </div>
             <div class="col-lg-6 col-sm-8">
                 <div class="row d-flex justify-content-center form-control shadow">
                     <?php
                        foreach ($top10commands as $command) {
                            echo "<div class='top10 d-flex flex-row justify-content-between'> <div> Commande n°" . $command->getId_command() . " </div><a href='" . BASE_URL . "articles/commands'>Voir</a> </div>";
                        } ?>
                 </div>
             </div>

         </div>
         <div class="col-lg-6 col-sm-6">

             <div class="row">
                 <h2>Consultation du site</h2>
             </div>

             <div id="toastConnection"> </div>

             <!-- TOP 10 USERS -->
             <div class="row d-flex justify-content-between mb-1">
                 <h3>Top 10 utilisateurs</h3>
             </div>
             <div class="col-lg-6 col-sm-8">
                 <div class="row d-flex justify-content-center form-control shadow">
                     <?php
                        foreach ($top10ConnectedUsers as $user) {
                            echo "<div class='top10 d-flex flex-row justify-content-between'> <div>" . $user->getLastname_user() . ' ' . $user->getFirstname_user() . " </div> <a href='" . BASE_URL . "users/edit/" . $user->getId_user() . "'>Voir</a></div>";
                        } ?>
                 </div>
             </div>
         </div>
     </div>

     <br>

     <!-- Statistics Middle Section -->
     <div class="row d-flex justify-content-between">
         <div class="col-lg-5 col-sm-12">

             <div class="row">
                 <h2>Recettes</h2>
             </div>
             <div class="row d-flex justify-content-between">
                 <div class="col-lg-5 col-sm-8 mb-sm-4">
                     <div class="row d-flex justify-content-between mb-1">
                         <h3>Top 10 Chefs</h3>
                     </div>
                     <div class="row d-flex justify-content-center form-control shadow">
                         <div class="col">
                             <?php
                                foreach ($top10Chiefs as $chief) {
                                    echo "<div class='top10 d-flex flex-row justify-content-between'> <div>" . $chief->getLastname_user() . ' ' . $chief->getFirstname_user() . " </div> <a href='" . BASE_URL . "users/edit/" . $chief->getId_user() . "'>Voir</a></div>";
                                } ?>

                         </div>
                     </div>
                 </div>
                 <div class="col-lg-5 col-sm-8 mb-sm-4">
                     <div class="row d-flex justify-content-between mb-1">
                         <h3>Top 10 Recettes</h3>
                     </div>
                     <div class="row d-flex justify-content-center form-control shadow">
                         <div class="col">
                             <?php
                                foreach ($top10Recipes as $recipe) {
                                    echo "<div class='top10 d-flex flex-row justify-content-between'> <div>" . $recipe->getName_recipe() . " </div> <a href='" . BASE_URL . "recipes/edit/" . $recipe->getId_recipe() . "'>Voir</a></div>";
                                } ?>

                         </div>
                     </div>
                 </div>
             </div>
         </div>
         <div class="col-lg-6 col-sm-12">

             <div class="row">
                 <h2>Articles</h2>
             </div>
             <div class="row">
                 Nombre d'articles en vente : <?php echo count($articlesName) ?>
                 <div id="toastArticles"> </div>
             </div>

             <h3>En rupture de stock</h3>
             <!-- Table Container -->
             <table class="table" data-toggle="table" data-sortable="true" data-locale="fr-FR">
                 <thead>
                     <tr>
                         <th scope="col">Nom</th>
                         <th scope="col">Quantité vendu</th>
                         <th scope="col">Bénéfice</th>
                         <th scope="col">Action</th>
                     </tr>
                 </thead>
                 <tbody>

                     <?php
                        foreach ($articlesOutOfStock as $article) {
                        ?>
                         <tr>
                             <td>
                                 <?= $article->getQuantity_unite_article() . ' ' . $article->getUnitArticle() . ' de ' . $article->getNameProduct() ?>
                             </td>
                             <td>
                                 <?= $article->getQuantitySoldArticle() ?>
                             </td>
                             <td>
                                 <?= $article->getBenefitsArticle() ?> €
                             </td>
                             <td>
                                 <a href='<?= BASE_URL . "articles" ?>'>Voir</a>

                             </td>
                         </tr>

                     <?php
                        }
                        ?>

                 </tbody>
             </table>
         </div>
     </div>
     <br>
 </main>

 <script>
     var totalSoldPerDay = <?php echo json_encode($totalSoldPerDay) ?>;
     var totalPurchasedPerDay = <?php echo json_encode($totalPurchasedPerDay) ?>;
     var arrayDates = <?php echo json_encode($arrayDates) ?>;
     var totalSoldPerDay = <?php echo json_encode($totalSoldPerDay) ?>;
     var connectionPerHour = <?php echo json_encode($connectionPerHour) ?>;
     var articlesName = <?php echo json_encode($articlesName) ?>;
     var articlesSold = <?php echo json_encode($articlesSold) ?>;
     var articlesBought = <?php echo json_encode($articlesBought) ?>;
 </script>