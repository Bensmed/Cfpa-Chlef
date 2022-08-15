<?php
if (isset($_GET["logout"])) {
  $user->logout();
}

?>

<nav class="navbar navbar-expand-md navbar-dark bg-primary fixed-top">
  <div class="container-fluid ml-4">
    <a class="navbar-brand" href="/CFPA">
      <img src="assets/output-onlinepngtools.png" alt="" />
    </a>
    <div class="collapse navbar-collapse text-center justify-content-center" id="navbar3SupportedContent">
      <ul class="navbar-nav">
        <li class="nav-item mx-3">
          <a class="nav-link <?php if ($user->active_page("/Cfpa/index.php") || $user->active_page("/Cfpa/Accueil.php")) {
                                echo "active";
                              } ?>" href="/Cfpa"><b>Accueil</b></a>
        </li>
        <li class="nav-item dropdown <?php if ($user->active_page("/Cfpa/Rechercher.php")) {
                                        echo "active";
                                      } ?>" style="cursor: pointer; ">
          <a class="nav-link " id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Rechercher</a>
          <div class="dropdown-menu dropdown-primary " aria-labelledby="navbarDropdownMenuLink">
            <a class="dropdown-item" href="/Cfpa/Rechercher.php?etablissement">Etablissment</a>
            <a class="dropdown-item" href="/Cfpa/Rechercher.php?formation">Formation</a>
            <a class="dropdown-item" href="/Cfpa/Rechercher.php?specialitee">Spécialitée</a>
          </div>
        </li>
        <?php if ($user->is_loggedin()) : ?>
          <?php if ($_SESSION["role"] == "apprenant") { ?>
            <li class="nav-item mx-2 <?php if ($user->active_page("/Cfpa/Choisir.php")) {
                                        echo "active";
                                      } ?>">
              <a class="nav-link" href="/Cfpa/Choisir.php"><b>Choisir</b></a>
            </li>
          <?php } else if ($_SESSION["role"] == "admin") { ?>
            <li class="nav-item mx-2 <?php if ($user->active_page("/Cfpa/dashboard.php") || $user->active_page("/Cfpa/Ajouter.php")) {
                                        echo "active";
                                      } ?>">
              <a class="nav-link" href="/Cfpa/dashboard.php?gererUtilisateurs"><b>Tableau de bord</b></a>
            </li>
          <?php } ?>
          <li class="nav-item mx-2">
            <a class="nav-link" href="/Cfpa/#services"><b>Services</b></a>
          </li>
      </ul>
      <div class="ml-5">
        <a class="btn navbar-btn btn-danger" href="?logout">
          Déconnecter
        </a>
        <div class="btn-group">
          <button type="button" class="btn btn-primary " data-toggle="dropdown">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="dropdown-menu">
            <?php if ($_SESSION["role"] == "admin") : ?>
              <a class="dropdown-item bg-success <?php if ($user->active_page("/Cfpa/dashboard.php")) {
                                                    echo "active";
                                                  } ?>" href="/Cfpa/dashboard.php?gererUtilisateurs">Tableau de bord</a>
            <?php endif; ?>

            <a class="dropdown-item <?php if ($user->active_page("/Cfpa/Profile.php")) {
                                      echo "active";
                                    } ?>" href="/Cfpa/Profile.php">Profile</a>
            <a class="dropdown-item" href="/Cfpa/#comment">Commentaires</a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="#contact">Contact</a>
          </div>
        </div>
      </div>
    <?php else : ?>
      <li class="nav-item mx-2">
        <a class="nav-link" href="/Cfpa/#services"><b>Services</b></a>
      </li>
      <li class="nav-item mx-2">
        <a class="nav-link" href="#contact"><b>Contact</b></a>
      </li>
      </ul>

      <a class="btn navbar-btn btn-success mx-2" href="/Cfpa/#login"><b>Se Connecter</b></a>
      <a class="btn navbar-btn btn-danger mx-2" href="/Cfpa/inscription.php"><b class="">Inscrivez-vous</b></a>

    <?php endif; ?>
    </div>
  </div>
</nav>