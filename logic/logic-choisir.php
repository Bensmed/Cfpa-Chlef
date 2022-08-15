<?php

// Include config file
require_once "C:/xampp\htdocs\cfpa\config.php";

// Vérifiez si l'utilisateur est déjà connecté, si non, redirigez-le vers la page d'accueil
if (!$user->is_loggedin()) {
  $user->redirect("index.php");
  exit;
}

$etabID = $modForm = $dateSess = $etabID_choisi = $modForm_choisi = $dateSess_choisi = $specID_choisi = $sessID = "";
$succee = $err = "";
$commentaire = $succee_com = $err_com = "";




if (
  isset($_POST["etab_id"]) && isset($_POST["mod_form"]) && isset($_POST["date_sess"])
) {

  $etabID = $_POST["etab_id"];
  $modForm = $_POST["mod_form"];
  $dateSess = $_POST["date_sess"];

  $specs = $user->specSel_fetch($etabID, $modForm, $dateSess);

  echo  "<option selected disabled>Choisir une spécialitée ..</option>";
  foreach ($specs as $spec) {
    echo "<option value=" . $spec["id"] . ">" . $spec["designation_spe"] . "</option>";
  }
}
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  if (isset($_POST["choisir_spec"])) {

    $etabID_choisi = $_POST["etabSel"];
    $modForm_choisi = $_POST["formSel"];
    $dateSess_choisi = $_POST["sessSel"];
    $specID_choisi = $_POST["specSel"];

    if ($sessID = $user->trouver_sessID($etabID_choisi, $modForm_choisi, $dateSess_choisi, $specID_choisi)) {

      if ($user->deja_choisi($_SESSION["email"]) !== false) {
        $deja_choisi = true;
      } else {
        $deja_choisi = false;
      }
      if ($user->choisir_spe($_SESSION["email"], $sessID)) {
        if (!$deja_choisi) {
          $succee = "Vous avez bien choisir votre spécialitée";
        } else {
          $succee = "Vous avez bien modifier votre spécialitée";
        }
      } else {
        $err = "Oops! il ya un erreur .. ";
      }
    }
  }


  // faire un commentaire
  if (isset($_POST["commenter"])) {
    $commentaire = $_POST["commentaire"];
    $email_app = $_SESSION["email"];
    if ($user->commmnter($email_app, date("Y-m-d"), $commentaire)) {

      $succee_com = "Vous avez commenter avec succée";
    } else {

      $err_com = "Il ya un erreur .. ";
    }
  }
}
