<?php

// Vérifiez si l'utilisateur est déjà connecté, si oui, redirigez-le vers la page d'accueil
if ($user->is_loggedin()) {
  $user->redirect("Accueil.php");
  exit;
}

// Definir les variables et inserer des valeurs vide
$email = $nom = $prenom = $password = $passwordConfirm = $age = $sexe = $username = $adress = $niv = $tlf = "";
$email_err = $nom_err = $prenom_err = $password_err = $passwordConfirm_err = $age_err = $sexe_err = $username_err = $adress_err = $niv_err = $tlf_err = "";
$err = "";

// Traitement des données du formulaire lors de la soumission du formulaire
if ($_SERVER["REQUEST_METHOD"] == "POST") {

  //verifier si l'email est valide
  if (empty(trim($_POST["email"]))) {
    $email_err = "Entrer votre email.";
  } else {
    //Check if email is valable
    if ($user->verifier_email_exist(trim($_POST["email"])) != "") {
      $email_err = "Email existe déja.";
    } else {
      $email = trim($_POST["email"]);
    }
  }

  //verifier si le nom est valide
  if (empty(trim($_POST["nom"])) || strlen(trim($_POST["nom"])) < 3 || !preg_match("/^[a-zA-z]*$/", (trim($_POST["nom"])))) {
    $nom_err = "Entrer un nom valide.";
  } else {
    $nom = ucfirst(strtolower(trim($_POST["nom"])));
  }

  //verifier si le prenom est valide
  if (empty(trim($_POST["prenom"])) || strlen(trim($_POST["prenom"])) < 3 || !preg_match("/^[a-zA-z]*$/", (trim($_POST["prenom"])))) {
    $prenom_err = "Entrer un prenom valide.";
  } else {
    $prenom = ucfirst(strtolower(trim($_POST["prenom"])));
  }

  //verfier si la date de naissance est valide
  if (empty(trim($_POST["age"]))) {
    $age_err = "Entrer la date de naissance.";
  } else {
    $age = $_POST["age"];
  }

  //affecter la valeur de sexe
  $sexe = ucfirst(strtolower($_POST["sexe"]));

  //verifier si le nom d'utilisateur est valide
  if (empty(trim($_POST["username"])) || strlen(trim($_POST["username"])) < 5) {
    $username_err = "Entrer un nom d'utilisateur valide.";
  } else {
    if ($user->verifier_username_exist(trim($_POST["username"])) != "") {
      $username_err = "Nom d'utilisateur existe déja.";
    } else {
      $username = ucfirst(strtolower(trim($_POST["username"])));
    }
  }

  //verifier si le mot de passe est valide
  if (empty(trim($_POST["password"]))) {
    $password_err = "Entrer un mot de passe valide.";
  } else if (strlen(trim($_POST["password"])) < 6) {
    $password_err = "Le mot de passe doit être en moin 6 caractère.";
  } else {
    if (empty(trim($_POST["passwordConfirm"]))) {
      $passwordConfirm_err = "Confirmer le mot de passe.";
    } else {
      if (trim($_POST["passwordConfirm"]) != trim($_POST["password"])) {
        $passwordConfirm_err = "Le mot de passe ne correspond pas.";
      } else {
        $password = trim($_POST["password"]);
      }
    }
  }

  //verifier si l'adresse est valide
  if (empty(trim($_POST["adress"]))) {
    $adress_err = "Entrer une adresse valide.";
  } else {
    $adress = ucfirst(strtolower(trim($_POST["adress"])));
  }

  //verifier si le niveau est valide
  if (empty(trim($_POST["nivSel"]))) {
    $niv_err = "Selectionner le niveau scolaire.";
  } else {
    $niv = trim($_POST["nivSel"]);
  }

  //verifier si le numero de télépohone est valide
  if (empty(trim($_POST["tlf"])) || strlen(trim($_POST["tlf"])) < 10 || !preg_match("/^[0-9]*$/", (trim($_POST["tlf"])))) {
    $tlf_err = "Entrer une numero de téléphone valide.";
  } else {
    $tlf = trim($_POST["tlf"]);
  }

  //si il ya zero erreur
  if (empty($email_err) && empty($nom_err) && empty($prenom_err) && empty($password_err) && empty($passwordConfirm_err) && empty($age_err) && empty($username_err)  && empty($adress_err) && empty($niv_err) && empty($tlf_err)) {

    if ($user->registrer($email, $nom, $prenom, $age, $username, $password, $sexe, $adress, $niv, $tlf)) {

      // Inscription avec succée, alors démarrez une nouvelle session
      session_start();
      // Stocker les données dans des variables de session

      $_SESSION["loggedIn"] = true;
      $_SESSION["email"] = $email;
      $_SESSION["role"] = $user->typePersonne($_SESSION["email"]);

      $user->redirect("Accueil.php");
    } else {
      $err = "Il ya un erreurs...";
    }
  }
}
