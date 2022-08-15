<?php

// Vérifiez si l'utilisateur est déjà connecté et si il est un administrateur, si non, redirigez-le vers la page d'accueil
if (!$user->is_loggedin() || $_SESSION["role"] != "admin") {
  $user->redirect("index.php");
  exit;
}


$designationEtab = $emailEtab = $villeEtab = $tlfEtab = $longiitude = $latitude = "";
$designationEtab_err = $emailEtab_err = $villeEtab_err = $tlfEtab_err = $longitude_err = $latitude_err = "";
$designationForm = $abriviation = "";
$designationSpec = $nivQualif = $diplome = $dureeForm = $nivSel  = $mod_form = $id_branche = "";
$designationSpec_err = $nivQualif_err = $diplome_err = $dureeForm_err = $nivSel_err = $mod_form_err  = $id_branche_err = "";
$designationForm_err = $abriviation_err = "";
$succee = $err = "";

// Traitement des données du formulaire lors de la soumission du formulaire
if ($_SERVER["REQUEST_METHOD"] == "POST") {
//Ajouter établissement formulaire traitement
  if (isset($_POST["ajouterEtab"])) {

    //verifier si la designation est valide
    if (empty(trim($_POST["designationEtab"])) || strlen(trim($_POST["designationEtab"])) < 3 || !preg_match("/^[a-zA-z]*$/", (trim($_POST["designationEtab"])))) {
      $designationEtab_err = "Entrer une designation valide.";
    } else {
      $designationEtab = ucfirst(strtolower(trim($_POST["designationEtab"])));
    }

    //verifier si l'email' est valide
    if (empty(trim($_POST["emailEtab"]))) {
      $emailEtab_err = "Entrer un email valide.";
    } else {
      $emailEtab = ucfirst(strtolower(trim($_POST["emailEtab"])));
    }

    //verifier si la ville est valide
    if (empty(trim($_POST["villeEtab"])) || strlen(trim($_POST["villeEtab"])) < 3 || !preg_match("/^[a-zA-z]*$/", (trim($_POST["villeEtab"])))) {
      $villeEtab_err = "Entrer une ville valide.";
    } else {
      $villeEtab = ucfirst(strtolower(trim($_POST["villeEtab"])));
    }

    //verifier si le numero de télépohone est valide
    if (empty(trim($_POST["tlfEtab"])) || strlen(trim($_POST["tlfEtab"])) < 10 || !preg_match("/^[0-9]*$/", (trim($_POST["tlfEtab"])))) {
      $tlfEtab_err = "Entrer une numéro de téléphone valide.";
    } else {
      $tlfEtab = trim($_POST["tlfEtab"]);
    }

    //verifier si longitude est valide
    if (empty(trim($_POST["longitude"]))) {
      $longitude_err = "Entrer un longitude valide.";
    } else {
      $longitude = trim($_POST["longitude"]);
    }

    //verifier si latitude est valide
    if (empty(trim($_POST["latitude"]))) {
      $latitude_err = "Entrer un latitude valide.";
    } else {
      $latitude = trim($_POST["latitude"]);
    }

    if (empty($designationEtab_err) && empty($emailEtab_err) && empty($villeEtab_err) && empty($tlfEtab_err) && empty($longitude_err) && empty($latitude_err)) {

      if ($map->ajouterEtab($designationEtab, $emailEtab, $villeEtab, $tlfEtab, $longitude, $latitude)) {
        $succee = "Un établissement a été ajouter avec succéee";
      } else {
        $err = "Oops! Il ya un erreur";
      }
    }
  }

//Ajouter formation formulaire traitement
  if (isset($_POST["ajouterForm"])) {

    //verifier si la designation est valide
    if (empty(trim($_POST["designationForm"])) || strlen(trim($_POST["designationForm"])) < 3 || !preg_match("/^[a-zA-z]*$/", (trim($_POST["designationForm"])))) {
      $designationForm_err = "Entrer une designation valide.";
    } else {
      $designationForm = ucfirst(strtolower(trim($_POST["designationForm"])));
    }

    //verifier si l'abriviation est valide
    if (empty(trim($_POST["abriviation"])) || strlen(trim($_POST["abriviation"])) < 3 || !preg_match("/^[a-zA-z]*$/", (trim($_POST["abriviation"])))) {
      $abriviation_err = "Entrer une abriviation valide.";
    } else {
      $abriviation = strtoupper(trim($_POST["abriviation"]));
    }

    if (empty($designationForm_err) && empty($abriviation_err)) {

      if ($map->ajouterForm($designationForm, $abriviation)) {
        $succee = "Une formation a été ajouter avec succéee";
      } else {
        $err = "Oops! Il ya un erreur";
      }
    }
  }

//Ajouter spécialitée formulaire traitement
  if (isset($_POST["ajouterSpec"])) {
    
    //verifier si la designation est valide
    if (empty(trim($_POST["designationSpec"])) || strlen(trim($_POST["designationSpec"])) < 3 || !preg_match("/^[a-zA-z]*$/", (trim($_POST["designationSpec"])))) {
      $designationSpec_err = "Entrer une designation valide.";
    } else {
      $designationSpec = ucfirst(strtolower(trim($_POST["designationSpec"])));
    }

    //verifier si le niveau de qualification est valide
    if (empty(trim($_POST["nivQualif"])) || strlen(trim($_POST["nivQualif"])) > 2 || !preg_match("/^[0-9]*$/", (trim($_POST["nivQualif"])))) {
      $nivQualif_err = "Entrer un niveau de qualification valide.";
    } else {
      $nivQualif = trim($_POST["nivQualif"]);
    }
    
//verifier si le diplome est valide
if (empty(trim($_POST["diplome"])) || strlen(trim($_POST["diplome"])) < 3 || !preg_match("/^[a-zA-z]*$/", (trim($_POST["diplome"])))) {
  $diplome_err = "Entrer un diplome valide.";
} else {
  $diplome = strtoupper(trim($_POST["diplome"]));
}

//verifier si la durée de formation est valide
if (empty(trim($_POST["dureeForm"])) || strlen(trim($_POST["dureeForm"])) > 2 || !preg_match("/^[0-9]*$/", (trim($_POST["dureeForm"])))) {
  $dureeForm_err = "Entrer une durée de formation valide.";
} else {
  $dureeForm = trim($_POST["diplome"]) . " mois";
}

//verifier si le niveau scolaire est valide
if (empty(trim($_POST["nivSel"])) ) {
  $nivSel_err = "Séléctionner le niveau scolaire.";
} else {
  $nivSel = trim($_POST["nivSel"]);
}

//verifier si le niveau scolaire est valide
if (empty(trim($_POST["mod_form"])) ) {
  $mod_form_err = "Séléctionner le mode de formation.";
} else {
  $mod_form = trim($_POST["mod_form"]);
}

//verifier si le niveau scolaire est valide
if (empty(trim($_POST["id_branche"])) ) {
  $id_branche_err = "Entrer l'ID du branche'.";
} else {
  $id_branche = trim($_POST["id_branche"]);
}


    if (empty($designationSpec_err) && empty($nivQualif_err) && empty($diplome_err) && empty($dureeForm_err) && empty($nivSel_err) && empty($mod_form_err) && empty($id_branche_err)) {

      if ($map->ajouterSpec($designationSpec , $nivQualif , $diplome , $dureeForm , $nivSel  , $mod_form , $id_branche)) {
        $succee = "Une spécialitée a été ajouter avec succéee";
      } else {
        $err = "Oops! Il ya un erreur";
      }
    }
  }
}
