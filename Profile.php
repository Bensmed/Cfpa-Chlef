<?php

// Require config file
require_once "config.php";

include(LOGIC_PATH . "/logic-profile.php");

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
          <div class="row mt-3" style=" margin: 0 auto; width:90%;">
            <div class="col-sm-9 ml-5 mt-2">
              <h1 class="">Profile</h1>
              <div class=" text-center">

                <h4 class="text-success">
                  <?php echo $succee; ?>
                </h4>
                <h4 class="text-danger">
                  <?php echo $err; ?>

                </h4>
              </div>
              <div class="form-group">
                <div class="form-group">
                  <label for="username">Nom d'utilisateur :</label>
                  <div class="input-group">
                    <input type="text" class="form-control" name="username" value="<?php echo $username; ?>" readonly>
                  </div>
                </div>
                <div class="form-group">
                  <label for="nom">Nom :</label>
                  <div class="input-group">
                    <input type="text" class="form-control" name="nom" value="<?php echo $nom; ?>" readonly>
                    <div class="input-group-append">
                      <button class="btn btn-secondary" data-toggle="modal" data-target="#nv_info_modal">Modifier</button>
                    </div>
                  </div>
                </div>
                <div class="form-group">
                  <label for="prenom">Prénom :</label>
                  <div class="input-group">
                    <input type="text" class="form-control" name="prenom" value="<?php echo $prenom; ?>" readonly>
                    <div class="input-group-append">
                      <button class="btn btn-secondary" data-toggle="modal" data-target="#nv_info_modal">Modifier</button>
                    </div>
                  </div>
                </div>
                <div class="form-group">
                  <label for="age">Date de naissance :</label>
                  <div class="input-group">
                    <input type="date" class="form-control" name="age" value="<?php echo $age; ?>" readonly>
                    <div class="input-group-append">
                      <button class="btn btn-secondary" data-toggle="modal" data-target="#nv_info_modal">Modifier</button>
                    </div>
                  </div>
                </div>
                <?php if ($_SESSION["role"] == "apprenant") : ?>
                  <div class="form-group">
                    <label for="niv">Niveau scolaire :</label>
                    <div class="input-group">
                      <input type="text" class="form-control" name="niv" value="<?php echo $niv; ?>" readonly>
                      <div class="input-group-append">
                        <button class="btn btn-secondary" data-toggle="modal" data-target="#nv_info_modal">Modifier</button>
                      </div>
                    </div>
                  </div>

                  <div class="form-group">
                    <label for="adress">Adresse :</label>
                    <div class="input-group">
                      <input type="text" class="form-control" name="adress" value="<?php echo $adress; ?>" readonly>
                      <div class="input-group-append">
                        <button class="btn btn-secondary" data-toggle="modal" data-target="#nv_info_modal">Modifier</button>
                      </div>
                    </div>
                  </div>
                <?php endif; ?>
                <div class="form-group">
                  <label for="tlf">Téléphone :</label>
                  <div class="input-group">
                    <input type="text" class="form-control" name="tlf" value="<?php echo $tlf; ?>" readonly>
                    <div class="input-group-append">
                      <button class="btn btn-secondary" data-toggle="modal" data-target="#nv_info_modal">Modifier</button>
                    </div>
                  </div>
                </div>
                <div id="accordion">
                  <div class="form-group ">
                    <label for="email">Email :</label>
                    <div class="card">

                      <div class="input-group">
                        <input type="email" class="form-control" name="email" value="<?php echo $email; ?>" readonly>
                        <div class="input-group-append">
                          <button class="btn btn-secondary" data-toggle="collapse" data-target="#nv_email_form">Changer</button>
                        </div>
                      </div>

                      <!--collapse email form-->
                      <div id="nv_email_form" class="collapse" data-parent="#accordion">
                        <div class="card-body">
                          <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) ?>" method="POST">
                            <div class="form-group">
                              <div class="form-group">
                                <label for="nv_email">Nouveau email:</label>
                                <input type="email" class="form-control" name="nv_email" placeholder="cfpaChlef@email.com" value="<?php echo $nv_email; ?>" required>
                                <small class="text-danger"></small>
                              </div>
                              <div class="d-flex justify-content-end">
                                <button type="submit" class="btn btn-success" name="change_email_submit">Confirmer</button>
                              </div>
                            </div>
                          </form>
                        </div>
                      </div>
                    </div>
                  </div>

                  <div class="form-group ">
                    <label for="password">Mot de passe:</label>
                    <div class="card">
                      <div class="card-header">
                        <div class="input-group">
                          <input type="password" class="form-control" name="password" value="password" readonly>
                          <div class="input-group-append">
                            <button class="btn btn-secondary" data-toggle="collapse" href="#nv_password_form">Changer</button>
                          </div>
                        </div>
                      </div>
                      <!--collapse password form-->
                      <div id="nv_password_form" class="collapse" data-parent="#accordion">
                        <div class="card-body">
                          <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) ?>" method="POST">
                            <div class="form-group">
                              <div class="form-group">
                                <input type="password" class="form-control" placeholder="Mot de passe actuel" name="actuel_password" required>
                                <small class="text-danger"></small>
                              </div>
                              <div class="form-group">
                                <input type="password" class="form-control" placeholder="Nouveau mot de passe" name="nv_password" required>
                                <small class="text-danger"></small>
                              </div>
                              <div class="form-group">
                                <input type="password" class="form-control" placeholder="Confirm new password" name="confirm_nv_password" required>
                                <small class="text-danger"></small>
                              </div>
                              <div class="d-flex justify-content-end">
                                <button type="submit" class="btn btn-success" name="nv_password_submit">Confirmer</button>
                              </div>
                            </div>
                          </form>
                        </div>
                      </div>
                      <!---->
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

  <!-- Change personal informations Modal -->
  <div class="modal fade" id="nv_info_modal">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">

        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Modifier propre infomrations</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>

        <!-- Modal body -->
        <div class="modal-body">
          <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
            <div class="form-group">
              <div class="form-group">
                <label for="nv_nom">Nom :</label>
                <input type="text" class="form-control" placeholder="Entrer le nom .." name="nv_nom" value="<?php echo $nom ?>" required>
                <small class=" text-danger"><?php echo $nv_nom_err ?></small>
              </div>
              <div class="form-group">
                <label for="nv_prenom">Prénom :</label>
                <input type="text" class="form-control" placeholder="Entrer le prénom" name="nv_prenom" value="<?php echo $prenom ?>" required>
                <small class="text-danger"><?php echo $nv_prenom_err ?></small>
              </div>
              <div class="form-group">
                <label for="nv_age">Date de naissance:</label>
                <input type="date" class="form-control" name="nv_age" value="<?php echo $age ?>" min='1960-01-01' max='2002-10-08' required>
                <small class="text-danger"><?php echo $nv_age_err ?></small>
              </div>
              <?php if ($_SESSION["role"] == "apprenant") : ?>
                <div class="form-group">

                  <label for="nv_niv">Niveau scolaire : </label>

                  <select class="form-control" name="nv_niv" id="nv_niv">
                    <option value="" disabled>Selectionner le niveau scolaire ..</option>
                    <option <?php if ($niv == "Primaire") {
                              echo "Selected";
                            } ?> value="Primaire">Primaire</option>
                    <option <?php if ($niv == "1ère Année Moyenne") {
                              echo "Selected";
                            } ?> value="1ère Année Moyenne">1ère Année Moyenne</option>
                    <option <?php if ($niv == "2ème Année Moyenne") {
                              echo "Selected";
                            } ?> value="2ème Année Moyenne">2ème Année Moyenne</option>
                    <option <?php if ($niv == "3ème Année Moyenne") {
                              echo "Selected";
                            } ?> value="3ème Année Moyenne">3ème Année Moyenne</option>
                    <option <?php if ($niv == "4ème Année Moyenne") {
                              echo "Selected";
                            } ?> value="4ème Année Moyenne">4ème Année Moyenne</option>
                    <option <?php if ($niv == "1ère Année Secondaire") {
                              echo "Selected";
                            } ?> value="2ème Année Secondaire">1ère Année Secondaire</option>
                    <option <?php if ($niv == "Primaire") {
                              echo "Selected";
                            } ?> value="2ème Année Secondaire">2ème Année Secondaire</option>
                    <option <?php if ($niv == "3ème Année Secondaire") {
                              echo "Selected";
                            } ?> value="3ème Année Secondaire">3ème Année Secondaire</option>
                  </select>
                  <small class="text-danger ml-3"><?php echo $nv_niv_err; ?></small>

                </div>
                <div class="form-group">
                  <label for="nv_adress">Adresse :</label>
                  <input type="text" class="form-control" placeholder="Entrer l'adresse ..'" name="nv_adress" value="<?php echo $adress ?>" required>
                  <small class="text-danger"><?php echo $nv_adress_err ?></small>
                </div>
              <?php endif; ?>
              <div class="form-group">
                <label for="nv_tlf">Téléphone :</label>
                <input type="text" class="form-control" placeholder="Entrer le téléphone .." name="nv_tlf" value="<?php echo $tlf ?>" required>
                <small class="text-danger"><?php echo $nv_tlf_err ?></small>
              </div>
            </div>

        </div>
        <!-- Modal footer -->
        <div class="modal-footer">
          <button type="submit" class="btn btn-success" name="nv_info_submit">Modifier</button>
        </div>
        </form>
      </div>
    </div>
  </div>
  <!-- JavaScript dependencies -->
  <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" crossorigin="anonymous" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" crossorigin="anonymous" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy"></script>
  <!-- Script: Smooth scrolling between anchors in the same page -->
  <script src="js/smooth-scroll.js"></script>


</body>

</html>
<?php

?>