<?php

// Require config file
require_once "config.php";

//include logic
include(LOGIC_PATH . "/logic-dashboard.php");


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
                  <a href="dashboard.php?gererUtilisateurs" class="list-group-item list-group-item-action <?php if (isset($_GET["gererUtilisateurs"])) {
                                                                                                            echo "active";
                                                                                                          } ?>">Gérer les utilisateurs</a>

                  <a href="dashboard.php?gererEtablissements" class="list-group-item list-group-item-action <?php if (isset($_GET["gererEtablissements"])) {
                                                                                                              echo "active";
                                                                                                            } ?>">Gérer les établissements</a>

                  <a href="dashboard.php?gererFormations" class="list-group-item list-group-item-action <?php if (isset($_GET["gererFormations"])) {
                                                                                                          echo "active";
                                                                                                        } ?>">Gérer les formations</a>
                  <a href="dashboard.php?gererSpecialitees" class="list-group-item list-group-item-action <?php if (isset($_GET["gererSpecialitees"])) {
                                                                                                            echo "active";
                                                                                                          } ?>">Gérer les spécialitées</a>
                </div>
              </div>
            </div>
            <?php if (isset($_GET["gererUtilisateurs"])) : ?>
              <div class="col-sm-9 mt-3">
                <h1 class="">Gérer les utilisateurs</h1>
                <div class=" text-center">

                  <h4 class="text-success">
                    <?php echo $succee; ?>
                  </h4>
                  <h4 class="text-danger">
                    <?php echo $err; ?>

                  </h4>
                </div>
                <nav class="navbar navbar-expand-sm bg-info navbar-dark justify-content-end">
                  <div class="mr-5">

                    <div class="form-inline">
                      <input class="form-control mr-sm-2" id="userInput" type="text" placeholder="Recherche ..">

                      <select class="form-control mr-sm-2" id="userSel" name="userSel" style="cursor: pointer">
                        <option value="" disabled selected>Recherche par...</option>
                        <option value="id">ID</option>
                        <option value="nom">Nom</option>
                        <option value="email">Email</option>
                      </select>
                      <button class="btn btn-primary" type="submit" onclick="rechUser()">
                        <i class="fa fa-search"></i>
                      </button>

                    </div>
                  </div>
                </nav>
                <div>
                  <table class="table table-hover " style="cursor: pointer">
                    <thead class="table-secondary">
                      <tr>
                        <th>ID</th>
                        <th>Nom d'utilisateur</th>
                        <th>Nom et prénom</th>
                        <th>Date de naissance</th>
                        <th>Sexe</th>
                        <th>Email</th>
                        <th>Niveau scolaire</th>
                        <th>Adresse</th>
                        <th></th>
                      </tr>
                    </thead>
                    <tbody id="usersTable">
                      <?php
                      $usersTable = $user->fetchUsers();
                      if ($usersTable != "") {
                        foreach ($usersTable as $row) {
                          echo '<form method="POST">';
                          echo " <tr>";
                          echo "<td>" . $row['id'] . "</td> ";
                          echo "<td>" . $row['username'] . "</td> ";
                          echo "<td>" . $row['nom'] . " " . $row['prenom'] . "</td> ";
                          echo "<td>" . $row['date_naissance'] . "</td> ";
                          echo "<td>" . $row['sexe'] . "</td> ";
                          echo "<td>" . $row['email'] . "</td> ";
                          echo "<td>" . $row['niveau'] . "</td> ";
                          echo "<td>" . $row['adress'] . "</td> ";
                          echo '<td><button class="btn btn-danger" name="supprimerUser" value="' . $row['email'] . '">Supprimer</button></td>';
                          echo "</tr>";
                          echo "</form>";         
                        }
                        echo "</tbody>";
                        echo "</table>";
                      } else {
                        echo "</tbody>";
                        echo "</table>";
                        echo "<p class='text-center'>Aucun compte existe</p>";
                      }
                      ?>

                </div>
              </div>
            <?php endif; ?>
            <?php if (isset($_GET["gererEtablissements"])) : ?>
              <div class="col-sm-9 mt-3">
                <h1 class="mb-3">Gérer les établissements</h1>
                <div class=" text-center">

                  <h4 class="text-success">
                    <?php echo $succee; ?>
                  </h4>
                  <h4 class="text-danger">
                    <?php echo $err; ?>
                  </h4>
                </div>
                <nav class="navbar navbar-expand-sm bg-info navbar-dark justify-content-end">
                  <div class="mr-5">
                    <div class="form-inline">
                      <a class="btn btn-primary mr-5" href="Ajouter.php?Etablissement">Ajouter un établissement</a>


                      <input class="form-control mr-sm-2" id="etabInput" type="text" placeholder="Recherche ..">

                      <select class="form-control mr-sm-2" id="etabSel" name="etabSel" style="cursor: pointer">
                        <option value="" disabled selected>Recherche par...</option>
                        <option value="id">ID</option>
                        <option value="designation">Designation</option>
                        <option value="ville">Ville</option>
                      </select>
                      <button class="btn btn-primary" type="submit" onclick="rechEtab()">
                        <i class="fa fa-search"></i>
                      </button>
                    </div>
                  </div>
                </nav>
                <div>
                  <table class="table table-hover " style="cursor: pointer">
                    <thead class="table-secondary">
                      <tr>
                        <th>ID</th>
                        <th>Designation</th>
                        <th>Ville</th>
                        <th>Email</th>
                        <th>Tlf</th>
                        <th>Latitude</th>
                        <th>Longitude</th>
                        <th></th>
                      </tr>
                    </thead>
                    <tbody id="etabsTable">
                      <?php
                      $etabsTable = $map->fetch_etabs();
                      foreach ($etabsTable as $row) {
                        echo '<form method="POST">';
                        echo " <tr>";
                        echo "<td>" . $row['id'] . "</td> ";
                        echo "<td>" . $row['designation'] . "</td> ";
                        echo "<td>" . $row['ville'] . "</td> ";
                        echo "<td>" . $row['email'] . "</td> ";
                        echo "<td>" . $row['tlf'] . "</td> ";
                        echo "<td>" . $row['longitude'] . "</td> ";
                        echo "<td>" . $row['latitude'] . "</td> ";
                        echo '<td><button class="btn btn-danger" name="supprimerEtab" value="' . $row['id'] . '">Supprimer</button></td>';
                        echo "</tr>";
                        echo "</form>";
                      }
                      ?>
                    </tbody>
                  </table>
                </div>
              </div>
            <?php endif; ?>
            <?php if (isset($_GET["gererFormations"])) : ?>
              <div class="col-sm-9 mt-3">
                <h1 class="mb-3">Gérer les formations</h1>
                <div class=" text-center">

                  <h4 class="text-success">
                    <?php echo $succee; ?>
                  </h4>
                  <h4 class="text-danger">
                    <?php echo $err; ?>
                  </h4>
                </div>
                <nav class="navbar navbar-expand-sm bg-info navbar-dark justify-content-end">
                  <div class="mr-5">
                    <div class="form-inline">
                      <a class="btn btn-primary mr-5 " href="Ajouter.php?Formation">Ajouter une formation</a>
                      <input class="form-control mr-sm-2" id="formInput" type="text" placeholder="Recherche ..">

                      <select class="form-control mr-sm-2" id="formSel" name="formSel" style="cursor: pointer">
                        <option value="" disabled selected>Recherche par...</option>
                        <option value="id">ID</option>
                        <option value="designation">Désignation</option>
                      </select>
                      <button class="btn btn-primary" type="submit" onclick="rechForm()">
                        <i class="fa fa-search"></i>
                      </button>
                    </div>
                  </div>
                </nav>
                <div>
                  <table class="table table-hover " style="cursor: pointer">
                    <thead class="table-secondary">
                      <tr>
                        <th>ID</th>
                        <th>Désignation</th>
                        <th>Abriviation</th>
                        <th></th>
                      </tr>
                    </thead>
                    <tbody id="formsTable">
                      <?php
                      $formTable = $map->fetch_forms();
                      foreach ($formTable as $row) {
                        echo '<form method="POST">';
                        echo " <tr>";
                        echo "<td>" . $row['id'] . "</td> ";
                        echo "<td>" . $row['designation_branche'] . "</td> ";
                        echo "<td>" . $row['abriviation'] . "</td> ";
                        echo '<td><button class="btn btn-danger" name="supprimerForm" value="' . $row['id'] . '">Supprimer</button></td>';
                        echo "</tr>";
                        echo '</form>';
                      }
                      ?>
                    </tbody>
                  </table>
                </div>
              </div>
            <?php endif; ?>
            <?php if (isset($_GET["gererSpecialitees"])) : ?>
              <div class="col-sm-9 mt-3">
                <h1 class="mb-3">Gérer les spécialitées</h1>
                <div class=" text-center">

                  <h4 class="text-success">
                    <?php echo $succee; ?>
                  </h4>
                  <h4 class="text-danger">
                    <?php echo $err; ?>
                  </h4>
                </div>
                <nav class="navbar navbar-expand-sm bg-info navbar-dark justify-content-end">
                  <div class="mr-5">
                    <div class="form-inline">
                      <a class="btn btn-primary mr-5" href="Ajouter.php?Specialitee">Ajouter une spécialitée</a>
                      <input class="form-control mr-sm-2" id="specInput" type="text" placeholder="Recherche ..">

                      <select class="form-control mr-sm-2" id="specSel" name="specSel" style="cursor: pointer">
                        <option value="" disabled selected>Recherche par...</option>
                        <option value="id">ID</option>
                        <option value="designation">Designation</option>
                        <option value="niveau">Niveau</option>
                      </select>
                      <button class="btn btn-primary" type="submit" onclick="rechSpec()">
                        <i class="fa fa-search"></i>
                      </button>
                    </div>
                  </div>
                </nav>
                <div>
                  <table class="table table-hover " style="cursor: pointer">
                    <thead class="table-secondary">
                      <tr>
                        <th>ID</th>
                        <th>Branche</th>
                        <th>Désignation</th>
                        <th>Niveau de qualification</th>
                        <th>Diplome</th>
                        <th>Durée de formation</th>
                        <th>Niveau scolaire</th>
                        <th>Type de formation</th>
                        <th></th>
                      </tr>
                    </thead>
                    <tbody id="specsTable">
                      <?php
                      $specsTable = $map->fetch_spes();
                      foreach ($specsTable as $row) {
                        echo '<form method="POST">';
                        echo " <tr>";
                        echo "<td>" . $row['id'] . "</td> ";
                        echo "<td>" . $row['designation_branche'] . "</td> ";
                        echo "<td>" . $row['designation_spe'] . "</td> ";
                        echo "<td>" . $row['niv_qualif'] . "</td> ";
                        echo "<td>" . $row['diplome'] . "</td> ";
                        echo "<td>" . $row['duree_form'] . "</td> ";
                        echo "<td>" . $row['niveau'] . "</td> ";
                        echo "<td>" . $row['mod_form'] . "</td> ";
                        echo '<td><button class="btn btn-danger" name="supprimerSpec" value="' . $row['id'] . '">Supprimer</button></td>';
                        echo "</tr>";
                        echo '</form>';
                      }
                      ?>
                  </table>
                </div>
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