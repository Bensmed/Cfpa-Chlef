<?php
// Vérifiez si l'utilisateur est déjà connecté, si non, redirigez-le vers la page d'index
if (!$user->is_loggedin()) {
  $user->redirect("index.php");
  exit;
}

// Definir les variables et inserer des valeurs vide
$email = $nom = $prenom = $password = $age = $username = $adress = $niv = $tlf = $nv_email = $nv_nom = $nv_prenom = $actuel_password = $nv_password = $confirm_nv_password = $nv_age = $nv_adress = $nv_niv = $nv_tlf = "";
$nv_email_err = $nv_nom_err = $nv_prenom_err = $actuel_password_err = $nv_password_err = $confirm_nv_password_err = $nv_age_err = $nv_adress_err = $nv_niv_err = $nv_tlf_err = "";
$succee = $err = "";



//récupérer les données de profil
if ($row = $user->fetch_profile($_SESSION["email"])) {
  $email = $row["email"];
  $nom = $new_nom = $row["nom"];
  $prenom = $new_prenom = $row["prenom"];
  $username = $row["username"];
  $age = $new_age = $row["date_naissance"];
  $tlf = $row["tlf"];
  //récupérer les information a partir de la table  'apprenant'
  if ($row = $user->fetch_apprenant_info($_SESSION["email"])) {
    $adress = $row["adress"];
    $niv = $row["niveau"];
  }
}

//// Traitement des données du formulaire lors de la soumission du formulaire
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  //Change personal informations form submitted
  if (isset($_POST["nv_info_submit"])) {
    //verifier si le nom est valide
    if (empty(trim($_POST["nv_nom"])) || strlen(trim($_POST["nv_nom"])) < 3) {
      $nv_nom_err = "Entrer un nom valide.";
    }
    $nv_nom = ucfirst(strtolower(trim($_POST["nv_nom"])));

    //verifier si le prénom est valide
    if (empty(trim($_POST["nv_prenom"])) || strlen(trim($_POST["nv_prenom"])) < 3) {
      $nv_prenom_err = "Entrer un prénom valide.";
    }
    $nv_prenom = ucfirst(strtolower(trim($_POST["nv_prenom"])));

    //verifier si l 'age est valid
    if (empty(trim($_POST["nv_age"]))) {
      $nv_age_err = "Entrer la date de naissance.";
    }
    $nv_age = $_POST["nv_age"];
    if ($_SESSION["role"] == "apprenant") {
      //verifier si le niveau scolaire
      if (empty(trim($_POST["nv_niv"]))) {
        $nv_niv_err = "Entrer le niveau scolaire.";
      }
      $nv_niv = $_POST["nv_niv"];

      //verifier si  l'adresse est valide
      if (empty(trim($_POST["nv_adress"]))) {
        $nv_adress_err = "Entrer une adresse valide.";
      }
      $nv_adress = $_POST["nv_adress"];
    }
    //verifier si le téléphone est valide
    if (empty(trim($_POST["nv_tlf"]))) {
      $nv_tlf_err = "Entrer un téléphone valide.";
    }
    $nv_tlf = $_POST["nv_tlf"];

    if (empty($nv_nom_err) && empty($nv_prenom_err) && empty($nv_age_err) && empty($nv_adress_err) && empty($nv_niv_err) && empty($nv_tlf_err)) {
      //verifier si il ya aucune modification
      if ($nv_nom == $nom && $nv_prenom == $prenom  && $nv_age == $age && $nv_adress == $adress && $nv_niv == $niv && $nv_tlf == $tlf) {
        //rien faire ...
      } else {
        if ($user->change_personalInfo($email, $nv_nom, $nv_prenom, $nv_age, $nv_adress, $nv_niv, $nv_tlf)) {
          $succee = "Vous avez modifier avec succée ! ";
          $nom = $nv_nom;
          $prenom = $nv_prenom;
          $age = $nv_age;
          $adress = $nv_adress;
          $niv = $nv_niv;
          $tlf = $nv_tlf;
        } else {
          $err = "Oops! il ya un erreur ... ";
        }
      }
    }
  }
}
