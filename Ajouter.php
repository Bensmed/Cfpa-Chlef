<?php

// Require config file
require_once "config.php";

//include logic
include(LOGIC_PATH . "/logic-ajouter.php");


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
        <div class="col-md bg-light pb-5 " style="opacity: 0.8">
          <div class="row">
            <div class="col-sm-3 ">
              <div class="col-sm-12 mt-4 mx-auto">
                <div class="list-group w-75 ">
                <a href="dashboard.php?gererUtilisateurs" class="list-group-item list-group-item-action bg-success">Tableau de bord</a>
                  <a href="Ajouter.php?Etablissement" class="list-group-item list-group-item-action <?php if (isset($_GET["Etablissement"])) {
                                                                                                      echo "active";
                                                                                                    } ?>">Ajouter un établissement</a>

                  <a href="Ajouter.php?Formation" class="list-group-item list-group-item-action <?php if (isset($_GET["Formation"])) {
                                                                                                  echo "active";
                                                                                                } ?>">Ajouter une formation</a>
                  <a href="Ajouter.php?Specialitee" class="list-group-item list-group-item-action <?php if (isset($_GET["Specialitee"])) {
                                                                                                      echo "active";
                                                                                                    } ?>">Ajouter une spécialitée</a>
                </div>
              </div>
            </div>
            <?php if (isset($_GET["Etablissement"])) : ?>
              <div class="col-sm-9 mt-3">
                <h1 class="mb-3">Ajouter un établissement</h1>
                <div class="">
                  <h4 class="text-success">
                    <?php echo $succee; ?>
                  </h4>
                  <h4 class="text-danger">
                    <?php echo $err; ?>
                  </h4>
                </div>

                <form method="POST">
                  <div class="form-group">

                    <div class="form-group">
                      <label for="designationEtab">Désignation :</label>
                      <input type="text" class="form-control ml-3 w-75" name="designationEtab" placeholder="Entrer la désignation .." value="<?php echo $designationEtab ?>" required />
                      <small class="text-danger"><?php echo $designationEtab_err; ?></small>
                    </div>

                    <div class="form-group">
                      <label for="villeEtab">Ville :</label>
                      <input type="text" class="form-control ml-3 w-75" name="villeEtab" placeholder="Entrer la ville .." value="<?php echo $villeEtab ?>" required />
                      <small class="text-danger"><?php echo $villeEtab_err; ?></small>
                    </div>

                    <div class="form-group">
                      <label for="emailEtab">Email :</label>
                      <input type="email" class="form-control ml-3 w-75" name="emailEtab" placeholder="Entrer l'email .." value="<?php echo $emailEtab ?>" required />
                      <small class="text-danger"><?php echo $emailEtab_err; ?></small>
                    </div>

                    <div class="form-group">
                      <label for="tlfEtab">Téléphone :</label>
                      <input type="text" class="form-control ml-3 w-75" name="tlfEtab" placeholder="Entrer le téléphone .." value="<?php echo $tlfEtab ?>" required />
                      <small class="text-danger"><?php echo $tlfEtab_err; ?></small>
                    </div>

                    <div class="form-group">
                      <label for="longitude">Longitude :</label>
                      <input type="number" step="0.00000001" class="form-control ml-3 w-75" name="longitude" placeholder="Entrer la longitude .." value="<?php echo $longitude ?>" required />
                      <small class="text-danger"><?php echo $longitude_err; ?></small>
                    </div>

                    <div class="form-group">
                      <label for="latitude">Latitude :</label>
                      <input type="number" step="0.00000001" class="form-control ml-3 w-75" name="latitude" placeholder="Entrer la latitude .." value="<?php echo $latitude ?>" required />
                      <small class="text-danger"><?php echo $latitude_err; ?></small>
                    </div>

                    <div class="d-flex justify-content-end mr-5">
                      <button type="submit" class="btn btn-success mt-3 w-25" name="ajouterEtab">
                        Ajouter
                      </button>
                    </div>
                  </div>
                </form>


              </div>
            <?php endif; ?>
            <?php if (isset($_GET["Formation"])) : ?>
              <div class="col-sm-9 mt-3">
                <h1 class="mb-3">Ajouter une formation</h1>
                <div class="">
                  <h4 class="text-success">
                    <?php echo $succee; ?>
                  </h4>
                  <h4 class="text-danger">
                    <?php echo $err; ?>
                  </h4>
                </div>

                <form method="POST">
                  <div class="form-group">

                    <div class="form-group">
                      <label for="designationForm">Désignation :</label>
                      <input type="text" class="form-control ml-3 w-75" name="designationForm" placeholder="Entrer la désignation .." value="<?php echo $designationForm ?>" required />
                      <small class="text-danger"><?php echo $designationForm_err; ?></small>
                    </div>

                    <div class="form-group">
                      <label for="abriviation">Abriviation :</label>
                      <input type="text" class="form-control ml-3 w-75" name="abriviation" placeholder="Entrer l'abriviation .." value="<?php echo $abriviation ?>" required />
                      <small class="text-danger"><?php echo $abriviation_err; ?></small>
                    </div>

                    <div class="d-flex justify-content-end mr-5">
                      <button type="submit" class="btn btn-success mt-3 w-25" name="ajouterForm">
                        Ajouter
                      </button>
                    </div>
                  </div>
                </form>


              </div>
            <?php endif; ?>
            <?php if (isset($_GET["Specialitee"])) : ?>
              <div class="col-sm-9 mt-3">
                <h1 class="mb-3">Ajouter une spécialitée</h1>
                <div class="">
                  <h4 class="text-success">
                    <?php echo $succee; ?>
                  </h4>
                  <h4 class="text-danger">
                    <?php echo $err; ?>
                  </h4>
                </div>

                <form method="POST">
                  <div class="form-group">

                    <div class="form-group">
                      <label for="designationSpec">Désignation :</label>
                      <input type="text" class="form-control ml-3 w-75" name="designationSpec" placeholder="Entrer la désignation .." value="<?php echo $designationSpec ?>" required />
                      <small class="text-danger"><?php echo $designationSpec_err; ?></small>
                    </div>

                    <div class="form-group">
                      <label for="nivQualif">Niveau de qualification :</label>
                      <input type="text" class="form-control ml-3 w-75" name="nivQualif" placeholder="Entrer le niveau de qualification .." value="<?php echo $nivQualif ?>" required />
                      <small class="text-danger"><?php echo $nivQualif_err; ?></small>
                    </div>

                    <div class="form-group">
                      <label for="diplome">Diplome :</label>
                      <input type="text" class="form-control ml-3 w-75" name="diplome" placeholder="Entrer le diplome .." value="<?php echo $diplome ?>" required />
                      <small class="text-danger"><?php echo $diplome_err; ?></small>
                    </div>

                    <div class="form-group">
                      <label for="dureeForm">Durée de formation :</label>
                      <input type="text" class="form-control ml-3 w-75" name="dureeForm" placeholder="Entrer la durée de formation (mois) .." value="<?php echo $dureeForm ?>" required />
                      <small class="text-danger"><?php echo $dureeForm_err; ?></small>
                    </div>

                    <div class="form-group">
                      <label for="nivSel">Niveau scolaire : </label>
                      <select class="form-control w-75 ml-3" name="nivSel" id="nivSel">
                        <option value="" selected>Selectionner le niveau scolaire ..</option>
                        <option value="Primaire">Primaire</option>
                        <option value="1ère Année Moyenne">1ère Année Moyenne</option>
                        <option value="2ème Année Moyenne">2ème Année Moyenne</option>
                        <option value="3ème Année Moyenne">3ème Année Moyenne</option>
                        <option value="4ème Année Moyenne">4ème Année Moyenne</option>
                        <option value="1ère Année Secondaire">1ère Année Secondaire</option>
                        <option value="2ème Année Secondaire">2ème Année Secondaire</option>
                        <option value="3ème Année Secondaire">3ème Année Secondaire</option>
                      </select>
                      <small class="text-danger ml-3"><?php echo $nivSel_err; ?></small>
                    </div>

                    <div class="form-group">
              <label for="mod_form">Mode de formation : </label>
              <select class="form-control w-75 ml-3" name="mod_form" id="mod_form" >
                <option value="" selected disabled>Séléctionner le mode de formation ..</option>
                <option value="Apprentissage">Apprentissage</option>
                <option value="Qualifiante">Qualifiante</option>
                <option value="Conventionnel">Conventionnel</option>
              </select>
              <small class="text-danger ml-3"><?php echo $mod_form_err; ?></small>
            </div>

                    <div class="form-group">
                      <label for="id_branche">ID du branche :</label>
                      <input type="number" class="form-control ml-3 w-75" name="id_branche" placeholder="Entrer l'ID du branche' .." value="<?php echo $id_branche ?>" required />
                      <small class="text-danger"><?php echo $id_branche_err; ?></small>
                    </div>

                    <div class="d-flex justify-content-end mr-5">
                      <button type="submit" class="btn btn-success mt-3 w-25" name="ajouterSpec">
                        Ajouter
                      </button>
                    </div>
                  </div>
                </form>


              </div>
            <?php endif; ?>
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
  <!-- Javascript for map -->
  <script src="https://unpkg.com/leaflet@1.3.1/dist/leaflet.js" integrity="sha512-/Nsx9X4HebavoBvEBuyp3I7od5tA0UzAxs+j83KgC8PU0kgB4XiK4Lfe4y4cgBtaRJQEIFCW+oC506aPT2L1zw==" crossorigin=""></script>
  <script>
    $(document).ready(function() {
      $("#myInput").on("keyup", function() {
        var value = $(this).val().toLowerCase();
        $("#myTable tr").filter(function() {
          $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
        });
      });
    });
  </script>
  <script>
    var userSel, etabSel, formSel, specSel;
    $('#userSel').change(function() {
      userSel = $(this).val();

    });
    $('#etabSel').change(function() {
      etabSel = $(this).val();

    });
    $('#formSel').change(function() {
      formSel = $(this).val();

    });
    $('#specSel').change(function() {
      specSel = $(this).val();

    });

    function rechUser() {
      var input, filter, table, tr, td, i, txtValue;
      input = document.getElementById('userInput');
      filter = input.value.toUpperCase();
      table = document.getElementById('usersTable');
      tr = table.getElementsByTagName('tr');
      if (userSel == "id") {
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
      } else if (userSel == "nom") {
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
      } else if (userSel == "email") {
        for (i = 0; i < tr.length; i++) {
          td = tr[i].getElementsByTagName('td')[5];
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

    function rechEtab() {
      var input, filter, table, tr, td, i, txtValue;
      input = document.getElementById('etabInput');
      filter = input.value.toUpperCase();
      table = document.getElementById('etabsTable');
      tr = table.getElementsByTagName('tr');
      if (etabSel == "id") {
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
      } else if (etabSel == "designation") {
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
      } else if (etabSel == "ville") {
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

    function rechForm() {
      var input, filter, table, tr, td, i, txtValue;
      input = document.getElementById('formInput');
      filter = input.value.toUpperCase();
      table = document.getElementById('formsTable');
      tr = table.getElementsByTagName('tr');
      if (formSel == "id") {
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
      } else if (formSel == "designation") {
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

    function rechSpec() {
      var input, filter, table, tr, td, i, txtValue;
      input = document.getElementById('specInput');
      filter = input.value.toUpperCase();
      table = document.getElementById('specsTable');
      tr = table.getElementsByTagName('tr');
      if (specSel == "id") {
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
      } else if (specSel == "designation") {
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
      } else if (specSel == "niveau") {
        for (i = 0; i < tr.length; i++) {
          td = tr[i].getElementsByTagName('td')[6];
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