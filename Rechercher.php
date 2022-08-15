<?php

// Require config file
require_once "config.php";
?>
<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <!-- PAGE settings -->

  <title>CFPA Chlef | Recherche</title>

  <meta name="keywords" content="CFPA chlef" />
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
    <div class="container-fluid mt-5">
      <div class="row">
        <div class="col-md-11 mx-auto bg-light pb-5 border border-primary" style="opacity: 0.8">
          <!-- Nav tabs -->
          <div class="row mt-3">
            <div class="col-md-10 mx-auto">
              <ul class="nav nav-tabs" style="font-size: 18px; font-weight: bold">
                <li class="nav-item">
                  <a class="nav-link <?php if (isset($_GET["etablissement"])) {
                                        echo "active";
                                      } ?>" data-toggle="tab" href="#etabTab">Etablissement</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link <?php if (isset($_GET["formation"])) {
                                        echo "active";
                                      } ?>" data-toggle="tab" href="#formTab">Formation</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link <?php if (isset($_GET["specialitee"])) {
                                        echo "active";
                                      } ?>" data-toggle="tab" href="#specTab">Spécialitée</a>
                </li>
              </ul>
            </div>
          </div>
          <!-- Tab panes -->
          <div class="tab-content">
            <div id="etabTab" class="container tab-pane <?php if (isset($_GET["etablissement"])) {
                                                          echo "active";
                                                        } ?>">
              <div class="row">
                <div class="col-md-12 mx-auto">
                  <div class="row mt-3">
                    <div class="col-md-12">
                      <div class="form-row">
                        <div class="col-sm-9 mr-2">
                          <div class="input-group">
                            <input type="text" class="form-control" id="rechEtab" placeholder="Recherche .." name="rech" />
                            <div class="input-group-append">
                              <button class="btn btn-primary" type="submit" onclick="rechEtab()">
                                <i class="fa fa-search"></i>
                              </button>
                            </div>
                          </div>
                        </div>
                        <div class="col-sm-2">
                          <div class="form-check mr-2">
                            <label class="form-check-label" for="parDesE" style="font-size: 14px" checked>
                              <input type="radio" class="form-check-input" name="typeE" id="parDesE" value="designation" checked />
                              Par designation
                            </label>
                          </div>
                          <div class="form-check">
                            <label class="form-check-label" for="parVilleE" style="font-size: 14px">
                              <input type="radio" class="form-check-input" name="typeE" id="parVilleE" value="ville" />
                              Par ville
                            </label>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>

                  <div class="row text-center">
                    <div class="col-md-11 mx-auto">
                      <h2 class="text-center my-3">
                        Trouver vos établissement
                      </h2>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-12 mx-auto">
                      <table class="table table-hover" style="cursor: pointer">
                        <thead class="table-secondary">
                          <tr>
                            <th>Désignation</th>
                            <th>Ville</th>
                            <th>Email</th>
                            <th>Téléphone</th>
                          </tr>
                        </thead>
                        <tbody id="tableEtab">
                          <?php
                          $etabTable = $map->fetch_etabs();
                          foreach ($etabTable as $row) {
                            echo " <tr>";
                            echo "<td>" . $row['designation'] . "</td> ";
                            echo "<td>" . $row['ville'] . "</td> ";
                            echo "<td>" . $row['email'] . "</td> ";
                            echo "<td>" . $row['tlf'] . "</td> ";
                            echo "</tr>";
                          }
                          ?>
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div id="formTab" class="container tab-pane <?php if (isset($_GET["formation"])) {
                                                          echo "active";
                                                        } ?>">
              <div class="row">
                <div class="col-md-12 mx-auto">
                  <div class="row mt-3">
                    <div class="col-md-12">
                      <div class="form-row">
                        <div class="col-sm-11 mr-2">
                          <div class="input-group">
                            <input type="text" class="form-control" id="rechForm" placeholder="Recherche par abriviation .." name="rech" />
                            <div class="input-group-append">
                              <button class="btn btn-primary" type="submit" onclick="rechForm()">
                                <i class="fa fa-search"></i>
                              </button>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>

                  <div class="row text-center">
                    <div class="col-md-11 mx-auto">
                      <h2 class="text-center my-3">
                        Trouver vos formations
                      </h2>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-12 mx-auto">
                      <table class="table table-hover" style="cursor: pointer">
                        <thead class="table-secondary">
                          <tr>
                            <th>Désignation</th>
                            <th>Abriviation</th>
                          </tr>
                        </thead>
                        <tbody id="tableForm">
                          <?php
                          $formTable = $map->fetch_forms();
                          foreach ($formTable as $row) {
                            echo " <tr>";
                            echo "<td>" . $row['designation_branche'] . "</td> ";
                            echo "<td>" . $row['abriviation'] . "</td> ";
                            echo "</tr>";
                          }
                          ?>
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div id="specTab" class="container tab-pane <?php if (isset($_GET["specialitee"])) {
                                                          echo "active";
                                                        } ?>">
              <div class="row">
                <div class="col-md-12 mx-auto">
                  <div class="row mt-3">
                    <div class="col-md-12">
                      <div class="form-row">
                        <div class="col-sm-9 mr-2">
                          <div class="input-group">
                            <input type="text" class="form-control" id="rechSpec" placeholder="Recherche .." name="rech" />
                            <div class="input-group-append">
                              <button class="btn btn-primary" type="submit" onclick="rechSpec()">
                                <i class="fa fa-search"></i>
                              </button>
                            </div>
                          </div>
                        </div>
                        <div class="col-sm-2">
                          <div class="form-check mr-2">
                            <label class="form-check-label" for="parDesS" style="font-size: 14px">
                              <input type="radio" class="form-check-input" name="typeS" id="parDesS" value="designation" checked />
                              Par designation
                            </label>
                          </div>
                          <div class="form-check">
                            <label class="form-check-label" for="parNivS" style="font-size: 14px">
                              <input type="radio" class="form-check-input" name="typeS" id="parNivS" value="niveau" />
                              Par niveau
                            </label>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>

                  <div class="row text-center">
                    <div class="col-md-11 mx-auto">
                      <h2 class="text-center my-3">
                        Trouver vos spécialitées
                      </h2>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-12 mx-auto">
                      <table class="table table-hover" style="cursor: pointer">
                        <thead class="table-secondary">
                          <tr>
                            <th>Branche</th>
                            <th>Désignation</th>
                            <th>Niveau de qualification</th>
                            <th>Diplome</th>
                            <th>Durée de formation</th>
                            <th>Niveau scolaire</th>
                            <th>Type de formation</th>
                            <th>Nombre de choix</th>
                          </tr>
                        </thead>
                        <tbody id="tableSpec">
                          <?php
                          $speTable = $map->fetch_spes();
                          foreach ($speTable as $row) {
                            echo " <tr>";
                            echo "<td>" . $row['designation_branche'] . "</td> ";
                            echo "<td>" . $row['designation_spe'] . "</td> ";
                            echo "<td>" . $row['niv_qualif'] . "</td> ";
                            echo "<td>" . $row['diplome'] . "</td> ";
                            echo "<td>" . $row['duree_form'] . "</td> ";
                            echo "<td>" . $row['niveau'] . "</td> ";
                            echo "<td>" . $row['mod_form'] . "</td> ";
                            echo "<td>" . $row['nbr_choix'] . "</td>";
                            echo "</tr>";
                          }
                          ?>
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <!-- Map -->
          <div class="row border-top mt-5 border-primary">
            <div class="col">
              <div class="row bg-light pt-3 " style="opacity: 0.8">
                <div class="col">
                  <div class="row">
                    <h3 class="text-center mx-auto">Trouver les établissements les plus proche de votre résidence </h3>
                  </div>
                  <div class="row">
                    <div class="form-group mx-auto ">
                      <div class="form-inline">
                        <div class="form-group">
                          <label for="champ-ville">Ville :</label>
                          <input type="text" name="adresse" id="champ-ville" class="form-control ml-4" placeholder="Ville .." />
                        </div>
                      </div>

                      <div class="form-group">
                        <div class="form-inline mt-3 ml-3">
                          <label for="champ-distance">Distance :</label>
                          <input type="range" id="champ-distance" class="form-control mr-4" min="1" max="200" />
                          <p id="valeur-distance"></p>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="row mt-3">
                <div class="col-md-11 mx-auto">
                  <div class="row border border-primary">
                    <div id="map" style="height: 750px; width: 100%">
                      <!-- My map -->
                    </div>
                  </div>
                </div>
              </div>
            </div>
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

  <script>
    function rechEtab() {
      var input, filter, table, tr, td, i, txtValue;
      input = document.getElementById('rechEtab');
      filter = input.value.toUpperCase();
      table = document.getElementById('tableEtab');
      tr = table.getElementsByTagName('tr');
      if (document.getElementById('parDesE').checked) {
        for (i = 0; i < tr.length; i++) {
          td = tr[i].getElementsByTagName('td')[0];
          if (td) {
            txtValue = td.textContent || td.innerText;
            if (txtValue.toUpperCase().indexOf(filter) > -1) {
              tr[i].style.display = '';
            } else {
              tr[i].style.display = 'none';
            }
          }
        }
      } else if (document.getElementById('parVilleE').checked) {
        for (i = 0; i < tr.length; i++) {
          td = tr[i].getElementsByTagName('td')[1];
          if (td) {
            txtValue = td.textContent || td.innerText;
            if (txtValue.toUpperCase().indexOf(filter) > -1) {
              tr[i].style.display = '';
            } else {
              tr[i].style.display = 'none';
            }
          }
        }
      }
    }

    function rechForm() {
      var input, filter, table, tr, td, i, txtValue;
      input = document.getElementById('rechForm');
      filter = input.value.toUpperCase();
      table = document.getElementById('tableForm');
      tr = table.getElementsByTagName('tr');

      for (i = 0; i < tr.length; i++) {
        td = tr[i].getElementsByTagName('td')[1];
        if (td) {
          txtValue = td.textContent || td.innerText;
          if (txtValue.toUpperCase().indexOf(filter) > -1) {
            tr[i].style.display = '';
          } else {
            tr[i].style.display = 'none';
          }
        }
      }
    }

    function rechSpec() {
      var input, filter, table, tr, td, i, txtValue;
      input = document.getElementById('rechSpec');
      filter = input.value.toUpperCase();
      table = document.getElementById('tableSpec');
      tr = table.getElementsByTagName('tr');
      if (document.getElementById('parDesS').checked) {
        for (i = 0; i < tr.length; i++) {
          td = tr[i].getElementsByTagName('td')[1];
          if (td) {
            txtValue = td.textContent || td.innerText;
            if (txtValue.toUpperCase().indexOf(filter) > -1) {
              tr[i].style.display = '';
            } else {
              tr[i].style.display = 'none';
            }
          }
        }
      } else if (document.getElementById('parNivS').checked) {
        for (i = 0; i < tr.length; i++) {
          td = tr[i].getElementsByTagName('td')[2];
          if (td) {
            txtValue = td.textContent || td.innerText;
            if (txtValue.toUpperCase().indexOf(filter) > -1) {
              tr[i].style.display = '';
            } else {
              tr[i].style.display = 'none';
            }
          }
        }
      }
    }
  </script>
</body>

</html>