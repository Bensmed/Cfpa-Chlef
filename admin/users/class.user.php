<?php

class USER
{
  public $pdo;

  function __construct($pdo)
  {
    $this->pdo = $pdo;
  }

  //   **************************** Inscription function ***************** */
  function registrer($email, $nom, $prenom, $age, $username, $password, $sexe, $adress, $niv, $tlf): bool
  {

    $sql = "INSERT INTO personne VALUES (:email, :nom, :prenom , :age , :sexe , :username , :password , :tlf  , :type)";
    try {
      if ($stmt = $this->pdo->prepare($sql)) {
        //Set the parameters
        $param_email = $email;
        $param_nom = $nom;
        $param_prenom = $prenom;
        $param_username = $username;
        //Create a password hash
        $param_password = password_hash($password, PASSWORD_DEFAULT);
        $param_age = $age;
        $param_sexe = $sexe;
        $param_tlf = $tlf;
        $param_type = "apprenant";


        //Bind parameters
        $stmt->bindParam(":email", $param_email);
        $stmt->bindParam(":nom", $param_nom);
        $stmt->bindParam(":prenom", $param_prenom);
        $stmt->bindParam(":username", $param_username);
        $stmt->bindParam(":password", $param_password);
        $stmt->bindParam(":age", $param_age);
        $stmt->bindParam(":sexe", $param_sexe);
        $stmt->bindParam(":tlf", $param_tlf);
        $stmt->bindParam(":type", $param_type);

        if ($stmt->execute()) {
          $sql = "INSERT INTO apprenant SELECT email , NULL , :adress , :niv , NULL  FROM personne WHERE email = :email";

          //prepare another statement
          if ($stm = $this->pdo->prepare($sql)) {
            //Set the parameters
            $param_email = $email;
            $param_adress = $adress;
            $param_niv = $niv;

            //Bind parameters
            $stm->bindParam(":email", $param_email);
            $stm->bindParam(":adress", $param_adress);
            $stm->bindParam(":niv", $param_niv);



            if ($stm->execute()) {
              return true;
            } else {
              return false;
            }
          }
        }
      }
      //Close statement
      unset($stmt);
    } catch (PDOException $e) {
      echo "Oops ! il ya un erreur...";
    }
  }

  //*******************verfication l"existance d'Email Function */
  function verifier_email_exist($email)
  {
    try {
      $sql = "SELECT * FROM personne WHERE email = :email";
      //verifier si l'email existe
      if ($stmt = $this->pdo->prepare($sql)) {
        //bind parameters
        $stmt->bindParam(":email", $email);

        if ($stmt->execute()) {
          if ($stmt->rowCount() == 1) {
            if ($row = $stmt->fetch()) {
              return $row;
            }
          } else {
            return false;
          }
        }
      }
    } catch (PDOException $e) {
      echo "Oops ! il ya un erreur...";
    }

    //Close statement
    unset($stmt);
  }

  //*******************verfication l"existance du nom d'utilisateur Function */
  function verifier_username_exist($username)
  {
    try {
      $sql = "SELECT * FROM personne WHERE username = :username";
      //verifier si le nom d'utilisateur existe
      if ($stmt = $this->pdo->prepare($sql)) {
        //bind parameters
        $stmt->bindParam(":username", $username);


        if ($stmt->execute()) {
          if ($stmt->rowCount() == 1) {
            if ($row = $stmt->fetch()) {
              return $row;
            }
          } else {
            return false;
          }
        }
      }
    } catch (PDOException $e) {
      echo "Oops ! il ya un erreur...";
    }

    //Close statement
    unset($stmt);
  }

  // ***************** Redirect function ******************************* */
  public function redirect($url)
  {
    header("Location: $url");
  }

  // ****************** Login Function ************************ */
  function login($email, $password)
  {
    try {
      if ($row = $this->verifier_email_exist($email)) {

        // Check if email exists, if yes then verify password
        if ($row !== false) {
          $email = $row["email"];
          $encrpt_password = $row["password"];

          if (password_verify($password, $encrpt_password)) {
            return $email;
          } else {
            return "password_err";
          }
        }
      } else {
        return "email_err";
      }
    } catch (PDOException $e) {
      echo "Oops ! il ya un erreur...";
    }
  }


  // ****************** le type de personne Function ************************ */

  public function typePersonne($email)
  {

    try {

      $sql = "SELECT type FROM personne WHERE email = :email";

      if ($stmt = $this->pdo->prepare($sql)) {
        //Set the parameters
        $param_email = $email;

        //Bind parameters
        $stmt->bindParam(":email", $param_email);

        if ($stmt->execute()) {
          if ($stmt->rowCount() == 1) {
            if ($row = $stmt->fetch()) {
              return $row["type"];
            }
          }
        }
      }
    } catch (PDOException $e) {
      echo "Oops ! il ya un erreur...";
    }

    //Close statement
    unset($stmt);
  }

  // ***** verifier si le utilisateur est connecté sur ce compte  Function ******* */

  public function is_loggedin()
  {
    // Check if the user is already logged in, if yes then redirect him to home page
    if (isset($_SESSION["loggedIn"]) && $_SESSION["loggedIn"] === true) {
      return true;
    } else {
      return false;
    }
  }

  // *************** Déconnection Function ********************************
  public function logout()
  {
    // remove all session variables
    session_unset();

    // destroy the session
    session_destroy();
    $this->redirect("/cfpa/index.php");
  }

  // *************** récupérer le données de profile Function *****************

  public function fetch_profile($email)
  {
    try {
      //Create sql statement
      $sql = "SELECT * FROM personne WHERE email = :email";

      //prepare a statement
      if ($stmt = $this->pdo->prepare($sql)) {
        //set the parameters
        $param_email = $email;
        //bind parameters
        $stmt->bindParam(":email", $param_email);

        //execute statement
        if ($stmt->execute()) {
          if ($row = $stmt->fetch()) {
            return $row;
          }
        }
      }
      //Close statement
      unset($stmt);
    } catch (PDOException $e) {
      echo "Oops ! il ya un erreur...";
    }
  }

  // *************** récupérer le données de profile Function *****************

  public function fetch_apprenant_info($email)
  {
    try {
      //Create sql statement
      $sql = "SELECT * FROM apprenant WHERE email_app = :email";

      //prepare a statement
      if ($stmt = $this->pdo->prepare($sql)) {
        //set the parameters
        $param_email = $email;
        //bind parameters
        $stmt->bindParam(":email", $param_email);

        //execute statement
        if ($stmt->execute()) {
          if ($row = $stmt->fetch()) {
            return $row;
          }
        }
      }
      //Close statement
      unset($stmt);
    } catch (PDOException $e) {
      echo "Oops ! il ya un erreur...";
    }
  }

  //*********************** is active page Function ***************************
  public function active_page($uri): bool
  {
    if ($_SERVER['SCRIPT_NAME'] == $uri) {
      return true;
    } else {
      return false;
    }
  }

  //********* Trouver session ID aprés la selection du formulaire Function ***********
  public function trouver_sessID($etabID, $modForm, $date_sess, $specID)
  {
    try {
      $sql = "SELECT id FROM sessionformation WHERE id_etab = :id_etab AND id_spe = :id_spec AND type = :modForm AND date_sess = :date_sess";
      //verifier si le nom d'utilisateur existe
      if ($stmt = $this->pdo->prepare($sql)) {
        //set the parameters
        $param_etabID = $etabID;
        $param_modForm = $modForm;
        $param_date_sess = $date_sess;
        $param_specID = $specID;
        //bind parameters
        $stmt->bindParam(":id_etab", $param_etabID);
        $stmt->bindParam(":modForm", $param_modForm);
        $stmt->bindParam(":date_sess", $param_date_sess);
        $stmt->bindParam(":id_spec", $param_specID);
        if ($stmt->execute()) {
          if ($stmt->rowCount() == 1) {
            if ($row = $stmt->fetch()) {
              return $row["id"];
            }
          } else {
            return false;
          }
        }
      }
    } catch (PDOException $e) {
      echo "Oops ! il ya un erreur...";
    }
  }

  //************** Afficher les choix d'apprenant Function **************
  public function afficher_choix($sessID)
  {
    try {
      $sql = "SELECT sessionformation.type , sessionformation.date_sess , etablissment.designation , specialite.designation_spe
       FROM 
       ((sessionformation INNER JOIN etablissment ON sessionformation.id_etab = etablissment.id) 
                  INNER JOIN specialite ON sessionformation.id_spe = specialite.id)
                    WHERE sessionformation.id = :sessID ";
      //verifier si le nom d'utilisateur existe
      if ($stmt = $this->pdo->prepare($sql)) {
        //set the parameters
        $param_sessID = $sessID;

        //bind parameters
        $stmt->bindParam(":sessID", $param_sessID);

        if ($stmt->execute()) {
          if ($stmt->rowCount() == 1) {
            if ($row = $stmt->fetch()) {
              return $row;
            }
          } else {
            return false;
          }
        }
      }
    } catch (PDOException $e) {
      echo "Oops ! il ya un erreur...";
    }
  }
  //********************** Choisir spécialité Function ***************************
  public function choisir_spe($email, $sessID): bool
  {
    try {
      //Create sql statement
      $sql = "UPDATE `apprenant` SET `id_sess` = :id_sess WHERE `apprenant`.`email_app` = :email;";

      //prepare a statement
      if ($stmt = $this->pdo->prepare($sql)) {
        //set the parameters
        $param_email = $email;
        $param_sessID = $sessID;
        //bind parameters
        $stmt->bindParam(":email", $param_email);
        $stmt->bindParam(":id_sess", $param_sessID);

        //execute statement
        if ($stmt->execute()) {
          $sql = "UPDATE `sessionformation` SET `nbr_choix` = `nbr_choix` + 1 WHERE `sessionformation`.`id` = :sessID;";
          if ($stmt = $this->pdo->prepare($sql)) {
            //set the parameters
            $param_sessID = $sessID;
            //bind parameters
            $stmt->bindParam(":sessID", $param_sessID);
            if ($stmt->execute()) {
              return true;
            } else {
              return false;
            }
          }
        }
      }
      //Close statement
      unset($stmt);
    } catch (PDOException $e) {
      echo "Oops ! il ya un erreur...";
    }
  }

  //******** verification si l'apprenant déja choisi une spécialité Function ********
  public function deja_choisi($email)
  {
    try {
      //Create sql statement
      $sql = "SELECT id_sess FROM apprenant where email_app = :email";

      //prepare a statement
      if ($stmt = $this->pdo->prepare($sql)) {
        //set the parameters
        $param_email = $email;
        //bind parameters
        $stmt->bindParam(":email", $param_email);

        //execute statement
        if ($stmt->execute()) {
          if ($stmt->rowCount() == 1) {
            if ($row = $stmt->fetch()) {
              if ($row["id_sess"] == NULL) {
                return false;
              } else {
                return $row["id_sess"];
              }
            }
          }
        }
      }
      //Close statement
      unset($stmt);
    } catch (PDOException $e) {
      echo "Oops ! il ya un erreur...";
    }
  }

  //*********************** afficher spécialitée select Function *********************
  public function specSel_fetch($etabID, $modForm, $date_sess)
  {
    try {

      $sql = "SELECT specialite.id , specialite.designation_spe
      FROM 
      specialite     
                 INNER JOIN sessionformation ON specialite.id = sessionformation.id_spe
                 
                   WHERE  sessionformation.`id_etab`= :id_etab AND sessionformation.`type`= :modForm AND sessionformation.`date_sess`= :date_sess";
      //prepare statement
      if ($stmt = $this->pdo->prepare($sql)) {
        //set the parameters
        $param_etabID = $etabID;
        $param_modForm = $modForm;
        $param_date_sess = $date_sess;
        //bind parameters
        $stmt->bindParam(":id_etab", $param_etabID);
        $stmt->bindParam(":modForm", $param_modForm);
        $stmt->bindParam(":date_sess", $param_date_sess);
        if ($stmt->execute()) {
          if ($stmt->rowCount() > 0) {
            return $stmt;
          } else {
            return "";
          }
        }
      }
    } catch (PDOException $e) {
      echo "Oops ! Something went wrong...";
    }
  }

  //*********************** afficher spécialitée select Function *********************
  public function fetchUsers()
  {
    try {

      $sql = "SELECT * FROM personne 
                  INNER JOIN 
                  apprenant 
                  ON personne.email = apprenant.email_app WHERE personne.type = 'apprenant' ";
      //prepare statement
      if ($stmt = $this->pdo->prepare($sql)) {
        if ($stmt->execute()) {
          if ($stmt->rowCount() > 0) {
            return $stmt;
          } else {
            return "";
          }
        }
      }
    } catch (PDOException $e) {
      echo "Oops ! Something went wrong...";
    }
  }

  //*********************** Supprimer utilisateur Function *********************
  public function supprimer_user($email): bool
  {
    try {

      $sql = "DELETE FROM personne WHERE email = :email ";
      //prepare statement
      if ($stmt = $this->pdo->prepare($sql)) {
        //set the parameters
        $param_email = $email;
        //bind parameters
        $stmt->bindParam(":email", $param_email);
        if ($stmt->execute()) {
          $sql = "DELETE FROM apprenant WHERE email_app = :email ";
          //prepare statement
          if ($stmt = $this->pdo->prepare($sql)) {
            //set the parameters
            $param_email = $email;
            //bind parameters
            $stmt->bindParam(":email", $param_email);
            if ($stmt->execute()) {
              return true;
            } else {
              return false;
            }
          }
        } else {
          return false;
        }
      }
    } catch (PDOException $e) {
      echo "Oops ! Something went wrong...";
    }
  }

  //*********************** Supprimer établissement Function *********************
  public function supprimer_etab($id): bool
  {
    try {

      $sql = "DELETE FROM etablissment WHERE id = :id ";
      //prepare statement
      if ($stmt = $this->pdo->prepare($sql)) {
        //set the parameters
        $param_id = $id;
        //bind parameters
        $stmt->bindParam(":id", $param_id);
        if ($stmt->execute()) {

          return true;
        } else {
          return false;
        }
      }
    } catch (PDOException $e) {
      echo "Oops ! Something went wrong...";
    }
  }

  //*********************** Supprimer formation Function *********************
  public function supprimer_form($id): bool
  {
    try {
      $sql = "DELETE FROM branche WHERE id = :id ";
      //prepare statement
      if ($stmt = $this->pdo->prepare($sql)) {
        //set the parameters
        $param_id = $id;
        //bind parameters
        $stmt->bindParam(":id", $param_id);
        if ($stmt->execute()) {

          return true;
        } else {
          return false;
        }
      }
    } catch (PDOException $e) {
      echo "Oops ! Something went wrong...";
    }
  }

  //*********************** Supprimer spécialitée Function *********************
  public function supprimer_spec($id): bool
  {
    try {

      $sql = "DELETE FROM specialite WHERE id = :id ";
      //prepare statement
      if ($stmt = $this->pdo->prepare($sql)) {
        //set the parameters
        $param_id = $id;
        //bind parameters
        $stmt->bindParam(":id", $param_id);
        if ($stmt->execute()) {
          return true;
        } else {
          return false;
        }
      }
    } catch (PDOException $e) {
      echo "Oops ! Il ya un erreur...";
    }
  }

  public function change_personalInfo($email, $nv_nom, $nv_prenom, $nv_age, $nv_adress, $nv_niv, $nv_tlf): bool
  {
    try {
      $sql = "UPDATE `personne` SET `nom` = :nv_nom , `prenom` = :nv_prenom  , `date_naissance` = :nv_age , `tlf` = :nv_tlf   WHERE `personne`.`email` = :email;";
      if ($stmt = $this->pdo->prepare($sql)) {
        //set the parameters
        $param_email = $email;
        $param_nom = $nv_nom;
        $param_prenom = $nv_prenom;
        $param_age = $nv_age;
        $param_tlf = $nv_tlf;
        //bind parameters
        $stmt->bindParam(":email", $param_email);
        $stmt->bindParam(":nv_nom", $param_nom);
        $stmt->bindParam(":nv_prenom", $param_prenom);
        $stmt->bindParam(":nv_age", $param_age);
        $stmt->bindParam(":nv_tlf", $param_tlf);
        if ($stmt->execute()) {
          $sql = "UPDATE `apprenant` SET `adress` = :nv_adress , `niveau` = :nv_niv  WHERE `apprenant`.`email_app` = :email;";
          if ($stmt = $this->pdo->prepare($sql)) {
            //set the parameters
            $param_email = $email;
            $param_adress = $nv_adress;
            $param_niv = $nv_niv;

            //bind parameters
            $stmt->bindParam(":email", $param_email);
            $stmt->bindParam(":nv_adress", $param_adress);
            $stmt->bindParam(":nv_niv", $param_niv);

            if ($stmt->execute()) {
              return true;
            } else {
              return false;
            }
          }
        }
      }
    } catch (PDOException $e) {
      echo "Oops ! Il ya un erreur...";
    }
  }
  // ******************** Commenter Function ****************************
  public function commmnter($email_app, $date_eval, $commentaire): bool
  {
    try {
      // // On récupère les données dans la base
      $sql = "SELECT id FROM apprenant WHERE email_app = :email";

      if ($stmt = $this->pdo->prepare($sql)) {
        //Set the parameters
        $param_email = $email_app;

        //bind the parameters
        $stmt->bindValue(':email', $param_email);
        if ($stmt->execute()) {
          if ($stmt->rowCount() == 1) {
            if ($row = $stmt->fetch()) {
              if ($id_app = $row["id"]) {

                // // On récupère les données dans la base
                $sql = "INSERT INTO evaluation VALUES (:id_app, :date_eval, :commentaire , NULL) ";

                if ($stmt = $this->pdo->prepare($sql)) {
                  //Set the parameters
                  $param_id_app = $id_app;
                  $param_date_eval = $date_eval;
                  $param_commentaire = $commentaire;

                  //bind the parameters
                  $stmt->bindValue(':id_app', $param_id_app);
                  $stmt->bindValue(':date_eval', $param_date_eval);
                  $stmt->bindValue(':commentaire', $param_commentaire);

                  if ($stmt->execute()) {
                    return true;
                  } else {
                    return false;
                  }
                }
              }
            }
          }
        }
      }
    } catch (PDOException $e) {
      echo "Oops !Il ya un erreur ...";
    }
  }



  public function afficher_commenataire()
  {
    try {

      $sql = "SELECT personne.nom , personne.prenom , evaluation.commentaire , evaluation.date_eval FROM 
       ((apprenant INNER JOIN evaluation ON apprenant.id = evaluation.id_app) 
                  INNER JOIN personne ON personne.email = apprenant.email_app)
                    ";
      //prepare statement
      if ($stmt = $this->pdo->prepare($sql)) {

        if ($stmt->execute()) {
          if ($stmt->rowCount() > 0) {
            return $stmt;
          } else {
            return "";
          }
        }
      }
    } catch (PDOException $e) {
      echo "Oops ! Il ya un erreur...";
    }
  }

  public function deja_commenter($email): bool
  {
    try {
      // // On récupère les données dans la base
      $sql = "SELECT id FROM apprenant WHERE email_app = :email";

      if ($stmt = $this->pdo->prepare($sql)) {
        //Set the parameters
        $param_email = $email;

        //bind the parameters
        $stmt->bindValue(':email', $param_email);
        if ($stmt->execute()) {
          if ($stmt->rowCount() == 1) {
            if ($row = $stmt->fetch()) {
              if ($id_app = $row["id"]) {

                // // On récupère les données dans la base
                $sql = "SELECT commentaire FROM evaluation WHERE id_app = :id_app ";

                if ($stmt = $this->pdo->prepare($sql)) {
                  //Set the parameters
                  $param_id_app = $id_app;

                  //bind the parameters
                  $stmt->bindValue(':id_app', $param_id_app);

                  if ($stmt->execute()) {
                    if ($stmt->rowCount() == 1) {
                      return true;
                    } else {
                      return false;
                    }
                  }
                }
              }
            }
          }
        }
      }
    } catch (PDOException $e) {
      echo "Oops !Il ya un erreur ...";
    }
  }
}
