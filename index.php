<?php

// Require config file
require_once "config.php";

//include logic
include(LOGIC_PATH . "/logic-login.php");


?>

<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <!-- PAGE settings -->
  <link rel="icon" href="https://templates.pingendo.com/assets/Pingendo_favicon.ico" />
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
      <div class="row mt-5 mr-5" style="position: relative">
        <a class="mt-1"><img src="assets/cfpaC.jpg" /></a>
      </div>
      <div class="row">
        <div class="col-md-8">
          <div class="row border border-primary">
            <div id="map" style="height: 750px; width: 100%"">
              <!-- My map -->
            </div>
          </div>
        </div>
        <div class=" col-md-4 bg-light pb-5 border border-primary" style="opacity: 0.8">

              <form class="p-4 bg-light" action="<?php echo $_SERVER["PHP_SELF"] ?>" method="POST">
                <div class="text-center">
                  <a class="pt-2 " href="http://www.enefep.dz/nomenclature.htm" id="login" target="_blank">http://www.enefep.dz/nomenclature.htm</a>
                </div>
                <h3 class="pt-5 pb-4 text-center" id="login">
                  Se Connecter
                  <img src="assets/loginicon.png" style="width: 30px" />
                </h3>
                <br />
                <div class="form-group">
                  <label>E-mail :</label>
                  <input class="form-control" placeholder="CfpaChlef@email.com" name="email" value="<?php echo $email ?>" />
                  <small class="text-danger"><?php echo $email_err; ?></small>
                </div>
                <div class="form-group">
                  <label>Mot de passe :</label>
                  <input type="password" class="form-control" placeholder="Mot de passe" name="password" />
                  <small class="text-danger"><?php echo $password_err; ?></small>
                </div>
                <p>Mot de passe oublier? <a href="#"> Clique ici! </a></p>
                <button type="submit" class="btn mt-4 btn-block p-2 btn-primary">
                  <b>Se connecter</b>
                </button>
                <p class="mt-3">Vous avez pas un compte?</p>
                <button type="submit" class="btn mt-1 btn-block p-2 btn-danger">
                  <b>Inscrivez-vous</b>
                </button>
              </form>
            </div>
          </div>
          <div class="row my-5" id="services">
            <div class="col-lg-10 mx-auto p-3 animate-in-down">
              <div class="p-4 bg-light">
                <h2 class="my-4 text-center">Services <img src="assets/services.png"></h2>
                <p class="my-4">
                  Les missions de CFPA Chlef peuvent se r??sumer en :
                  <br><br>
                  <b>Equiper : </b>Notre ??tablissement est charg?? de l???acquisition, la livraison, l???installation et la mise en service des ??quipements technico-p??dagogiques au profit des ??tablissements de formation et d???enseignement professionnels.
                  <br><br>
                  <b>Accompagner :</b> Notre ??tablissement accompagne les structures de formation dans le cadre du contr??le technique, la mise en service et l???exploitation des ??quipements technico-p??dagogiques. En outre, il constitue un fond documentaire relatif aux ??quipements technico-p??dagogiques et le diffuse au profit des ??tablissements de formation et d???enseignement professionnels.
                  <br><br>
                  <b> D??velopper :</b> Notre ??tablissement est charg?? d???effectuer des ??tudes techniques et de march?? li??s ?? son objet pour explorer les potentialit??s de la production nationale.Il contribue ?? l?????laboration, l???adaptation des plans d?????quipements et de la nomenclature des ??quipements technico-p??dagogiques.
                  <br><br>
                  <b>Maintenir : </b>Notre ??tablissement assure la prise en charge de la maintenance et la r??novation des ??quipements technico-p??dagogiques des ??tablissements de formation.
                  <br><br>
                  <b> Former :</b>Notre ??tablissement organise des formations sur l???utilisation et la maintenance des ??quipements technico-p??dagogiques, au profit du personnel enseignant et de l???encadrement techniques des ??tablissements de formation professionnelle
                  <br><br>
                  <b>Assister: </b>Les institutions et organismes publics ou priv??s peuvent requ??rir l???assistance de notre ??tablissement en mati??re d?????tude de besoins, d???acquisition, d???entretien et de maintenance des mat??riels et ??quipements.
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
      <!-- Script: Smooth scrolling between anchors in the same page -->
      <script src="js/smooth-scroll.js"></script>
      <!-- Javascript pour la map -->
      <script src="https://unpkg.com/leaflet@1.3.1/dist/leaflet.js" integrity="sha512-/Nsx9X4HebavoBvEBuyp3I7od5tA0UzAxs+j83KgC8PU0kgB4XiK4Lfe4y4cgBtaRJQEIFCW+oC506aPT2L1zw==" crossorigin=""></script>
      <script>
        var lat = 36.331493;
        var lon = 1.279508;
        var mycard = null;
        const mymap = 1.5;
        // Initialisation de la carte
        function initMap() {
          // Cr??er l'objet "mycard" et le mettre dans l'??l??ment html avec l'id "map"
          mycard = L.map('map').setView([lat, lon], 10);
          // Leaflet ne r??cup??re pas les tuiles d'un serveur par d??faut. Nous devons lui dire o?? nous voulons les obtenir. Ici, openstreetmap.org
          L.tileLayer('	https://a.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            // C'est une bonne id??e de laisser le lien vers la source des donn??es.
            attribution: 'Copyright@ CFPACHLEF</a>',
            minZoom: 1,
            maxZoom: 19,
          }).addTo(mycard);
          // markers
          var xhttp = new XMLHttpRequest();

          //la fonction de xmlhttp
          xhttp.onreadystatechange = function() {
            if (this.readyState == 4) {
              if (this.status == 200) {

                let data = JSON.parse(this.responseText);
                Object.entries(data.etabs).forEach((etab) => {
                  let marker = L.marker([etab[1].latitude, etab[1].longitude]).addTo(mycard);
                  marker.bindPopup(etab[1].designation);

                });
              } else {
                console.log(this.statusText);
              }
            }
          };
          xhttp.open(
            'GET',
            'http://localhost/cfpa/logic/map-markers.php',
            true
          );
          xhttp.send();
        }

        window.onload = function() {
          // Fonction d'initialisation qui est ex??cut??e lorsque le DOM est charg??
          initMap();
        };
      </script>
</body>

</html>