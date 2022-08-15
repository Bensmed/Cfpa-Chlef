<?php

// Require config file
require_once "config.php";

// Vérifiez si l'utilisateur est déjà connecté, si non, redirigez-le vers la page d'accueil
if (!$user->is_loggedin()) {
  $user->redirect("index.php");
  exit;
}



?>
<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <!-- PAGE settings -->

  <title>CFPA Chlef | Accueil</title>
  <meta name="description" content="Centre de formation  professionel d'apprentissage de la wilaya de chlef" />
  <meta name="keywords" content="CFPA Chlef" />
  <!-- CSS dependencies -->
  <link rel="stylesheet" href="https://unpkg.com/leaflet@1.3.1/dist/leaflet.css" integrity="sha512-Rksm5RenBEKSKFjgI3a41vrjkw4EVPlJ3+OiI65vTjIdo9brlAacEuKOiQ5OFh7cOI1bkDwLqdLw3Zg0cRJAAQ==" crossorigin="" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" type="text/css" />
  <link rel="stylesheet" href="aquamarine.css" type="text/css" />
  <!-- Script: Make my navbar transparent when the document is scrolled to top -->
  <script src="js/navbar-ontop.js"></script>
  <!-- Script: Animated entrance -->
  <script src="js/animate-in.js"></script>
</head>

<body>
  <!-- Navbar -->
  <?php
  include(LAYOUTS_PATH . "/navbar.php");
  ?>
  <!-- Cover -->
  <div class="photo-overlay section-parallax align-items-center d-flex cover section-aquamarine py-2" style="background-image: url('assets/restaurant/cover_light.jpg')">
    <div class="container-fluid mt-3">
      <div class="row mt-5" style="position: relative">
        <a class="mt-1"><img src="assets/cfpaC.jpg" /></a>
      </div>
      <div class="row">
        <div id="Actualite" class="carousel slide" data-ride="carousel">
          <div class="carousel-inner">
            <div class="carousel-item active">
              <img class="d-block w-100" src="assets/Slider/aS.jpg" alt="First slide" />
              <div class="carousel-caption d-none d-md-block">
                <h5>Cfpa Chlef</h5>
              </div>
            </div>
            <div class="carousel-item">
              <img class="d-block w-100" src="assets/Slider/bS.jpg" alt="Second slide" />
              <div class="carousel-caption d-none d-md-block">
                <h5>Cfpa Chlef</h5>

              </div>
            </div>
            <div class="carousel-item">
              <img class="d-block w-100" src="assets/Slider/cS.jpg" alt="Third slide" />
              <div class="carousel-caption d-none d-md-block">
                <h5>Cfpa Chlef</h5>
              </div>
            </div>
            <div class="carousel-item">
              <img class="d-block w-100" src="assets/Slider/dS.jpg" alt="Third slide" />
              <div class="carousel-caption d-none d-md-block">
                <h5>Cfpa Chlef</h5>
              </div>
            </div>
          </div>
          <a class="carousel-control-prev" data-target="#Actualite" role="button" data-slide="prev" style="cursor: pointer">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
          </a>
          <a class="carousel-control-next" data-target="#Actualite" role="button" data-slide="next" style="cursor: pointer">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
          </a>
        </div>
      </div>


      <div class="row " id="comment">
        <div class="col-md-12 bg-light pb-5 border border-primary " style="opacity: 0.8">
          <h2 class="my-4 text-center">
            Commentaires
          </h2>
          <?php if ($user->afficher_commenataire() !== "") {
            $commentaires = $user->afficher_commenataire();
            foreach ($commentaires as $commentaire) {
          ?>
              <div class="card border border-primary w-75 mx-auto mb-2">
                <div class="card-header bg-primary "> <label class="ml-3"><b><?php echo $commentaire["nom"] . " " . $commentaire["prenom"] . " :" ?></b></label></div>
                <div class="card-body text-lg-center">
                  <p><?php echo $commentaire["commentaire"]; ?></p>
                </div>
                <div class="card-footer bg-secondary"><label class="float-right">Date de commentaire :<i><?php echo "    " . $commentaire["date_eval"] ?></i></label></div>
              </div>
            <?php }
          } else { ?>
            <h5>Aucun commentaire.</h5>
          <?php } ?>
        </div>

      </div>


      <div class="row my-5" id="services">
        <div class="col-lg-10 mx-auto p-3 animate-in-down">
          <div class="p-4 bg-light">
            <h2 class="my-4 text-center">
              Services <img src="assets/services.png" />
            </h2>
            <p class="my-4">
              Les missions de CFPA Chlef peuvent se résumer en :
              <br><br>
              <b>Equiper : </b>Notre établissement est chargé de l’acquisition, la livraison, l’installation et la mise en service des équipements technico-pédagogiques au profit des établissements de formation et d’enseignement professionnels.
              <br><br>
              <b>Accompagner :</b> Notre établissement accompagne les structures de formation dans le cadre du contrôle technique, la mise en service et l’exploitation des équipements technico-pédagogiques. En outre, il constitue un fond documentaire relatif aux équipements technico-pédagogiques et le diffuse au profit des établissements de formation et d’enseignement professionnels.
              <br><br>
              <b> Développer :</b> Notre établissement est chargé d’effectuer des études techniques et de marché liés à son objet pour explorer les potentialités de la production nationale.Il contribue à l’élaboration, l’adaptation des plans d’équipements et de la nomenclature des équipements technico-pédagogiques.
              <br><br>
              <b>Maintenir : </b>Notre établissement assure la prise en charge de la maintenance et la rénovation des équipements technico-pédagogiques des établissements de formation.
              <br><br>
              <b> Former :</b>Notre établissement organise des formations sur l’utilisation et la maintenance des équipements technico-pédagogiques, au profit du personnel enseignant et de l’encadrement techniques des établissements de formation professionnelle
              <br><br>
              <b>Assister: </b>Les institutions et organismes publics ou privés peuvent requérir l’assistance de notre établissement en matière d’étude de besoins, d’acquisition, d’entretien et de maintenance des matériels et équipements.
            </p>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Footer -->
  <?php
  include(LAYOUTS_PATH . "/footer.php");
  ?>
  <!-- JavaScript dependencies -->
  <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" crossorigin="anonymous" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" crossorigin="anonymous" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy"></script>
  <!--  Script: Défilement fluide entre les ancres dans la même page -->
  <script src="js/smooth-scroll.js"></script>

</body>

</html>