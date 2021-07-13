<nav class="navbar" id="mainNavbar">

  <!-- Buttons nav -->
  <div class="wrapper-buttons-nav w-100 d-flex justify-content-around py-4 text-decoration-none">

    <!-- Button Recipe -->
    <a class="d-flex align-items-center nav-link btnNavbar rounded shadow <?= ($loc == "recipes") ? "active" : ""; ?>" href="<?php echo BASE_URL ?>recipes">
      <i class="fas fa-clipboard-list me-3"></i>
      Recettes
    </a>

    <!-- Button Articles -->
    <a class="d-flex align-items-center nav-link btnNavbar rounded shadow <?= ($loc == "articles") ? "active" : ""; ?>" href="<?php echo BASE_URL ?>articles">
      <i class="fas fa-utensils me-3"></i>
      Articles
    </a>

    <!-- Button Users -->
    <a class="d-flex align-items-center nav-link btnNavbar rounded shadow <?= ($loc == "users") ? "active" : ""; ?>" href="<?php echo BASE_URL ?>users">
      <i class="fas fa-users me-3"></i>
      Utilisateurs
    </a>

    <!-- Button Recipe -->
    <a class="d-flex align-items-center nav-link btnNavbar rounded shadow <?= ($loc == "statistics") ? "active" : ""; ?>" href="<?php echo BASE_URL ?>statistics">
      <i class="far fa-chart-bar me-3"></i>
      Statistiques
    </a>

    <!-- Button Session -->
    <div class="wrapper-buttons-session d-flex justify-content-end rounded bg-white shadow">

      <!-- Button User -->
      <div class="d-flex align-items-center nav-link" id="userNames">
        <i class="fas fa-user me-3"></i>
        <?php echo $_SESSION["lastname_user"] . " " . $_SESSION["firstname_user"] ?>
      </div>

      <!-- Button Disconnection -->
      <a class="d-flex align-items-center nav-link" id="disconnection" href="<?php echo BASE_URL ?>disconnection">
        <i class="fas fa-sign-out-alt me-3"></i>
        Déconnexion
      </a>
    </div>
  </div>
</nav>