<?php

// Require config file
require_once "config.php";

//include logic
include(LOGIC_PATH . "/logic-choisir.php");



?>
<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <!-- PAGE settings -->
  <link rel="icon" href="https://templates.pingendo.com/assets/Pingendo_favicon.ico" />
  <title>CFPA Chlef | Choisir votre formation</title>
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
      <div class="row mt-5">
        <div class="col-md-12 bg-light pb-5 border border-primary" style="opacity: 0.8">

          <?php if ($succee != "") { ?>
            <h3 class="text-center text-success mt-5"><?php echo $succee; ?></h3>
          <?php } else if ($err != "") { ?>
            <h3 class="text-center text-danger mt-5"><?php echo $err; ?></h3>
          <?php } ?>
          <form class="p-4 bg-light" method="POST" action="<?php echo $_SERVER["PHP_SELF"] ?>">
         
          <h2 class="text-center mt-2 mb-5">Renseigner une specialitée suivi</h2>
       
             <div class="form-group my-3">
              <label for="">Etablissement : </label>
              <select class="custom-select" name="etabSel" id="etabSel">
                <option value="" selected disabled>Choisir un établissement ..</option>
                <?php
                $etabs = $map->fetch_etabs();
                foreach ($etabs as $etab) {
                  echo "<option value=" . $etab["id"] . ">" . $etab["designation"] . "</option>";
                }
                ?>
              </select>
            </div>
           
            <div class="form-group my-4">
              <label for="">Session : </label>
              <select class="custom-select" name="sessSel" id="sessSel" disabled>
                <option value="" selected disabled>Choisir une session ..</option>
                <option value="2020-09-01">1ère session (Septembre)</option>
                <option value="2020-02-01">2ème session (Février)</option>
              </select>
            </div>
            <div class="form-group my-4">
              <label for="">Mode de formation : </label>
              <select class="custom-select" name="formSel" id="formSel" disabled>
                <option value="" selected disabled>Choisir le mode de formation ..</option>
                <option value="Apprentissage">Apprentissage</option>
                <option value="Qualifiante">Qualifiante</option>
                <option value="Conventionnel">Conventionnel</option>
              </select>
            </div>
            <div class="form-group my-4">
              <label for="">Spécialitée : </label>
              <select class="custom-select" name="specSel" id="specSel" disabled>
                <option selected disabled>Choisir une spécialitée ..</option>
              </select>
            </div>

            <div class="mt-5 ">
              <div class="form-inline ">
                <button type="submit" class="btn p-2 btn-success w-50" name="choisir_spec">
                Evaluer
                </button>

                <a class="btn p-2 btn-danger w-50" href="/Cfpa/Accueil.php">
                  <b>Annuler</b>
                </a>
              </div>
            </div>
          </form>
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
  <!-- Javascript pour la map -->
  <script src="https://unpkg.com/leaflet@1.3.1/dist/leaflet.js" integrity="sha512-/Nsx9X4HebavoBvEBuyp3I7od5tA0UzAxs+j83KgC8PU0kgB4XiK4Lfe4y4cgBtaRJQEIFCW+oC506aPT2L1zw==" crossorigin=""></script>
  <script>
    let ville = (distance = '');
    var lat = 36.331493;
    var lon = 1.279508;
    var mycard = null;
    // Initialisation de la carte
    function initMap() {
      // Créer l'objet "mycard" et le mettre dans l'élément html avec l'id "map"
      mycard = L.map('map').setView([lat, lon], 10);
      // Leaflet ne récupère pas les tuiles d'un serveur par défaut. Nous devons lui dire où nous voulons les obtenir. Ici, openstreetmap.org
      L.tileLayer('	https://a.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        // C'est une bonne idée de laisser le lien vers la source des données.
        attribution: 'Copyright@ CFPACHLEF</a>',
        minZoom: 1,
        maxZoom: 19,
        name: 'tiles', //permettra de ne pas supprimer cette couche
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
      // On récupère les champs de la page
      let champVille = document.getElementById('champ-ville');
      let champDistance = document.getElementById('champ-distance');
      let valeurDistance = document.getElementById('valeur-distance');

      // On écoute l'évènement "change" sur le champ Etab
      champVille.addEventListener('change', function() {
        // On envoie la requête ajax vers nominatim et on traite la réponse
        ajaxGet(
          `https://nominatim.openstreetmap.org/search?q=${this.value}&format=json&addressdetails=1&limit=1&polygon_svg=1`
        ).then((reponse) => {
          // On convertit la réponse en objet Javascript
          let data = JSON.parse(reponse);

          // On stocke la latitude et la longitude dans la variable Etab
          ville = [data[0].lat, data[0].lon];

          // On centre la carte sur la Etab
          mycard.panTo(ville);
        });
      });

      champDistance.addEventListener('change', function() {
        // On récupère la distance choisie
        distance = this.value;

        // On écrit cette valeur sur la page
        valeurDistance.innerText = distance + ' km';
        //On vérifie si une ville a été saisie
        if (ville != '') {
          // On envoie les données au serveur
          ajaxGet(
            `http://localhost/cfpa/logic/localiser.php?lat=${ville[0]}&lon=${ville[1]}&distance=${distance}`
          ).then((reponse) => {
            //on supprime toutes les couches de la carte
            mycard.eachLayer(function(layer) {
              if (layer.options.name != 'tiles') {
                mycard.removeLayer(layer);
              }
            });
            //On trace un cercle coresspondant a la distance
            let circle = L.circle(ville, {
              color: '#839c49',
              fillColor: '#839c49',
              fillOpacity: 0.3,
              radius: distance * 1000,
            }).addTo(mycard);

            //On boucle sur les données
            let donnees = JSON.parse(reponse);

            Object.entries(donnees).forEach((etab) => {
              //On créer le marqueur

              let marker = L.marker([
                etab[1].latitude,
                etab[1].longitude,
              ]).addTo(mycard);
              marker.bindPopup(etab[1].designation);
            });

            //On centre la carte sur le cercle
            let bounds = circle.getBounds();
            mycard.fitBounds(bounds);
          });
        }
      });

    }
    window.onload = function() {
      // Fonction d'initialisation qui est exécutée lorsque le DOM est chargé
      initMap();
    };




    /** Cette fonction effectue un appel Ajax vers une url et retourne une promesse
     * @param {string}
     */
    function ajaxGet(url) {
      return new Promise(function(resolve, reject) {
        // Nous allons gérer la promesse
        let xmlhttp1 = new XMLHttpRequest();

        xmlhttp1.onreadystatechange = function() {
          // Si le traitement est terminé
          if (xmlhttp1.readyState == 4) {
            // Si le traitement est un succès
            if (xmlhttp1.status == 200) {
              // On résoud la promesse et on renvoie la réponse
              resolve(xmlhttp1.response);
            } else {
              // On résoud la promesse et on envoie l'erreur
              reject(xmlhttp1);
            }
          }
        };

        // Si une erreur est survenue
        xmlhttp1.onerror = function(error) {
          // On résoud la promesse et on envoie l'erreur
          reject(error);
        };

        // On ouvre la requête
        xmlhttp1.open('get', url, true);

        // On envoie la requête
        xmlhttp1.send(null);
      });
    }
  </script>
  <!-- Javascript pour choisir selection -->

  <script>
    $(document).ready(function() {
      var EtabID;
      var modForm;
      var dateSess;
      $('#etabSel').change(function() {
        $('#sessSel').prop('disabled', false);
        EtabID = $(this).val();

      });
      $('#sessSel').change(function() {
        $('#formSel').prop('disabled', false);
        dateSess = $(this).val();

      });
      $('#formSel').change(function() {
        $('#specSel').prop('disabled', false);
        modForm = $(this).val();
        if (EtabID && modForm && dateSess) {
          $.ajax({
            type: 'POST',
            url: 'http://localhost/Cfpa/logic/logic-choisir.php',
            data: {
              etab_id: EtabID,
              mod_form: modForm,
              date_sess: dateSess
            },
            success: function(html) {
              $('#specSel').html(html);
            }
          });
        }
      });
    });
  </script>
</body>

</html>