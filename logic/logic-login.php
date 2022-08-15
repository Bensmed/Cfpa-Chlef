<?php

// Vérifiez si l'utilisateur est déjà connecté, si oui, redirigez-le vers la page d'accueil
if ($user->is_loggedin()) {
  $user->redirect("Accueil.php");
  exit;
}



// Définit les variables et initialise avec des valeurs vides
$email  = $password = "";
$email_err  = $password_err = "";

// Traitement des données du formulaire lors de la soumission du formulaire
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // verifier si le champ est vide
  if (empty(trim($_POST["email"]))) {
    $email_err = "Entrer l'email.";
  } else {
    $email = trim($_POST["email"]);
  }

  // verifier si le champ est vide
  if (empty(trim($_POST["password"]))) {
    $password_err = "Entrer le mot de passe.";
  } else {
    $password = trim($_POST["password"]);
  }


  // Valider les identifiants
  if (empty($email_err) && empty($password_err)) {
    if ($reponse = $user->login($email, $password)) {

      if ($reponse == "email_err") {
        $email_err = "Le compte n'existe pas.";
      } else if ($reponse == "password_err") {
        $password_err = "Le mot de passe est incorrect.";
      } else {
        // Le mot de passe est correct, alors démarrez une nouvelle session
        session_start();
        // Stocker les données dans des variables de session
        $_SESSION["loggedIn"] = true;
        $_SESSION["email"] = $reponse;
        $_SESSION["role"] = $user->typePersonne($_SESSION["email"]);
        // Redirect user to Home page
        $user->redirect("Accueil.php");
      }
    }
  }
}
