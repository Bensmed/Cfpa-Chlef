<?php

// Vérifiez si l'utilisateur est déjà connecté et si il est un administrateur, si non, redirigez-le vers la page d'accueil
if (!$user->is_loggedin() || $_SESSION["role"] != "admin") {
  $user->redirect("index.php");
  exit;
}

$succee = $err = "";

if (isset($_POST["supprimerUser"])) {

  $email = $_POST["supprimerUser"];
  if ($user->supprimer_user($email)) {
    $succee = "Un utilisateur a été supprimer avec succée";
  } else {
    $err = "Oops! il ya un erreur .. ";
  }
}

if (isset($_POST["supprimerEtab"])) {

  $id = $_POST["supprimerEtab"];
  if ($user->supprimer_etab($id)) {
    $succee = "Un établissement a été supprimer avec succée";
  } else {
    $err = "Oops! il ya un erreur .. ";
  }
}
if (isset($_POST["supprimerForm"])) {

  $id = $_POST["supprimerForm"];
  if ($user->supprimer_form($id)) {
    $succee = "Une formation a été supprimer avec succée";
  } else {
    $err = "Oops! il ya un erreur .. ";
  }
}
if (isset($_POST["supprimerSpec"])) {

  $id = $_POST["supprimerSpec"];
  if ($user->supprimer_spec($id)) {
    $succee = "Une spécialitée a été supprimer avec succée";
  } else {
    $err = "Oops! il ya un erreur .. ";
  }
}
