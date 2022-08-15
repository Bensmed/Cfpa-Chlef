<?php

// Require config file
require_once "config.php";

//include logic
include(LOGIC_PATH . "/logic-inscription.php");




?>
<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <!-- PAGE settings -->
  <link rel="icon" href="https://templates.pingendo.com/assets/Pingendo_favicon.ico" />
  <title>CFPA Chlef | Inscription</title>
  <meta name="description" content="Centre de formation  professionel d'apprentissage de la wilaya de chlef" />
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
  <!--inscription form-->
  <div class="photo-overlay section-parallax align-items-center d-flex cover section-aquamarine pt-5" style="background-image: url('assets/restaurant/cover_light.jpg')">
    <div class="container" style="box-shadow: 2px 2px 5px black">
      <div class="row p-4 bg-aquamarine animate-in-down">
        <div class="col-md-10 mx-auto">
          <h1 class="text-center">Inscription</h1>

          <form class="mt-5" action="<?php echo $_SERVER["PHP_SELF"] ?>" method="POST">
            <div class="form-group">
              <div class="form-row">
                <div class="col-sm mr-4">
                  <div class="form-group">
                    <div class="form-row">
                      <div class="col-sm-2">
                        <label class="pt-1" for="nom">Nom :</label>
                      </div>
                      <div class="col-sm-9">
                        <div class="form-row">
                          <input type="text" class="form-control w-100" placeholder="Nom .." name="nom" value="<?php echo $nom ?>" required />
                        </div>
                        <div class="form-row">
                          <small class="text-danger"><?php echo $nom_err; ?></small>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-sm">
                  <div class="form-group">
                    <div class="form-row">
                      <div class="col-sm-3">
                        <label class="pt-1" for="prenom">Prénom :</label>
                      </div>
                      <div class="col-sm-9">
                        <div class="form-row">
                          <input type="text" class="form-control w-100" placeholder="Prénom .." name="prenom" value="<?php echo $prenom ?>" required />
                        </div>
                        <div class="form-row">
                          <small class="text-danger"><?php echo $prenom_err; ?></small>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="form-group">
                <div class="form-inline">
                  <label for="age">Date de naissance :</label>
                  <input type="date" class="form-control w-50 ml-3" name="age" value="<?php echo $age ?>" min='1960-01-01' max='2002-10-08' required />
                  <small class="text-danger"><?php echo $age_err; ?></small>
                </div>
              </div>
              <div class="form-group my-3">
                <div class="form-inline">
                  <label for="">Sexe : </label>
                  <div class="form-check ml-5 mr-4">
                    <label class="form-check-label" for="maleRad" style="font-size: 16px">
                      <input type="radio" class="form-check-input" name="sexe" id="maleRad" value="homme" checked />
                      Homme
                    </label>
                  </div>
                  <div class="form-check mr-2">
                    <label class="form-check-label" for="FemaleRad" style="font-size: 16px">
                      <input type="radio" class="form-check-input" name="sexe" id="FemaleRad" value="femme" />
                      Femme
                    </label>
                  </div>
                </div>
              </div>
              <div class="form-group">
                <div class="form-inline">
                  <label for="username">Nom d'utilisateur :</label>

                  <input type="text" class="form-control ml-3 w-75" name="username" placeholder="Nom d'utilisateur .." value="<?php echo $username ?>" required />
                  <small class="text-danger" style="margin-left: 150px"><?php echo $username_err; ?></small>
                </div>
              </div>
              <div class="form-group">
                <div class="form-inline">
                  <label for="email">Email :</label>

                  <input type="email" class="form-control ml-3 w-75" name="email" placeholder="CfpaChlef@email.com .." value="<?php echo $email ?>" required />
                  <small class="text-danger" style="margin-left: 75px"><?php echo $email_err; ?></small>
                </div>
              </div>
              <div class="form-row">
                <div class="col-sm mr-2">
                  <div class="form-group">
                    <div class="form-row">
                      <div class="col-sm-4">
                        <label class="pt-1" for="password">Mot de passe :</label>
                      </div>
                      <div class="col-sm-8">
                        <div class="form-row">
                          <input type="password" class="form-control w-100" placeholder="Mot de passe .." name="password" required />
                        </div>
                        <div class="form-row">
                          <small class="text-danger"><?php echo $password_err; ?></small>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-sm">
                  <div class="form-group">
                    <div class="form-row">
                      <div class="col-sm-9">
                        <div class="form-row">
                          <input type="password" class="form-control w-100" placeholder="Confirmation de mot de passe .." name="passwordConfirm" required />
                        </div>
                        <div class="form-row">
                          <small class="text-danger"><?php echo $passwordConfirm_err; ?></small>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="form-group">
                <div class="form-inline">
                  <label for="adress">Adresse : </label>

                  <input type="text" class="form-control ml-3 w-50" name="adress" placeholder="Adresse .." value="<?php echo $adress ?>" required />
                  <small class="text-danger ml-3"><?php echo $adress_err; ?></small>
                </div>
              </div>
              <div class="form-group">
                <div class="form-inline">
                  <label for="nivSec">Niveau scolaire : </label>

                  <select class="custom-select w-50 ml-4" name="nivSel" id="nivSel">
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
                  <small class="text-danger ml-3"><?php echo $niv_err; ?></small>
                </div>
              </div>
              <div class="form-group">
                <div class="form-inline">
                  <label for="phone">Numéro de téléphone : </label>

                  <input type="text" class="form-control ml-3 w-50" name="tlf" placeholder="0123456789 .." value="<?php echo $tlf ?>" required />
                  <small class="text-danger" style="margin-left: 180px"><?php echo $tlf_err; ?></small>
                </div>
              </div>

              <div class="custom-control custom-checkbox">
                <input type="checkbox" class="custom-control-input" id="customCheck" name="condition_check" required />
                <label class="custom-control-label" for="customCheck">
                  <p>Vous accepte notre <a href="#">conditions.</a></p>
                </label>
              </div>
              <div class="d-flex justify-content-end">
                <button type="submit" class="btn btn-success mt-3">
                  Inscrire
                </button>
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
  <!-- Script: Smooth scrolling between anchors in the same page -->
  <script src="js/smooth-scroll.js"></script>
</body>

</html>