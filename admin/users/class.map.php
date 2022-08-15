<?php

class MAP
{
  public $pdo;

  function __construct($pdo)
  {
    $this->pdo = $pdo;
  }


  //****************** Exporter les données d'établissments **************

  public function fetch_etabs()
  {
    try {

      $sql = "SELECT * FROM etablissment";
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

  public function fetch_forms()
  {
    try {

      $sql = "SELECT * FROM branche";
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

  public function fetch_spes()
  {
    try {

      $sql = "SELECT * FROM 
      branche     
                 INNER JOIN specialite ON branche.id = specialite.id_branche
                 
                   WHERE specialite.id_branche = branche.id ";
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

  public function localiser($lat, $lon, $distance)
  {
    try {
      // // On récupère les données dans la base
      $sql = "SELECT id, designation , latitude, longitude, ( 6371 * acos( cos( radians(:lat) ) * cos( radians( latitude ) ) * cos( radians( longitude ) - radians(:lon) ) + sin( radians(:lat) ) * sin( radians( latitude ) ) ) ) AS distance FROM `etablissment` HAVING distance < :distance ORDER BY distance";

      if ($stmt = $this->pdo->prepare($sql)) {
        $stmt->bindValue(':lat', $lat, PDO::PARAM_STR);
        $stmt->bindValue(':lon', $lon, PDO::PARAM_STR);
        $stmt->bindValue(':distance', $distance, PDO::PARAM_INT);

        if ($stmt->execute()) {
          if ($result = $stmt->fetchAll()) {
            return $result;
          }
        }
      }
    } catch (PDOException $e) {
      echo "Oops ! Something went wrong...";
    }
  }

  // ********************** Ajouter établissement Function ******************
  public function ajouterEtab($designation, $email, $ville, $tlf, $lon, $lat): bool
  {
    try {
      // On inesrt la ligne dans la bdd
      $sql = "INSERT INTO etablissment VALUES (NULL ,:email, :designation, :ville , :lon , :lat , :tlf , NULL)";

      if ($stmt = $this->pdo->prepare($sql)) {
        //Set the parameters
        $param_email = $email;
        $param_designation = $designation;
        $param_ville = $ville;
        $param_lon = $lon;
        $param_lat = $lat;
        $param_tlf = $tlf;
        //bind the parameters
        $stmt->bindValue(':designation', $param_designation);
        $stmt->bindValue(':email', $param_email);
        $stmt->bindValue(':ville', $param_ville);
        $stmt->bindValue(':lat', $param_lat);
        $stmt->bindValue(':lon', $param_lon);
        $stmt->bindValue(':tlf', $param_tlf);

        if ($stmt->execute()) {
          return true;
        } else {
          return false;
        }
      }
    } catch (PDOException $e) {
      echo "Oops !Il ya un erreur ...";
    }
  }

  // ********************** Ajouter formation Function ******************
  public function ajouterForm($designation, $abriviation): bool
  {
    try {
      // // On récupère les données dans la base
      $sql = "INSERT INTO branche VALUES (NULL ,:abriviation, :designation, NULL , NULL)";

      if ($stmt = $this->pdo->prepare($sql)) {
        //Set the parameters
        $param_designation = $designation;
        $param_abriviation = $abriviation;

        //bind the parameters
        $stmt->bindValue(':designation', $param_designation);
        $stmt->bindValue(':abriviation', $param_abriviation);


        if ($stmt->execute()) {
          return true;
        } else {
          return false;
        }
      }
    } catch (PDOException $e) {
      echo "Oops !Il ya un erreur ...";
    }
  }

  // ********************** Ajouter spécialitée Function ******************
  public function ajouterSpec($designation , $nivQualif , $diplome , $dureeForm , $niv  , $mod_form , $id_branche): bool
  {
    try {
      // // On récupère les données dans la base
      $sql = "INSERT INTO specialite VALUES (NULL , :designation , :nivQualif , :diplome , :dureeForm , :niv  , :mod_form , :id_branche)";

      if ($stmt = $this->pdo->prepare($sql)) {
        //Set the parameters
        $param_designation = $designation;
        $param_nivQualif = $nivQualif;
        $param_diplome = $diplome;
        $param_dureeForm = $dureeForm;
        $param_niv = $niv;
        $param_mod_form = $mod_form;
        $param_id_branche = $id_branche;

        //bind the parameters
        $stmt->bindValue(':designation', $param_designation);
        $stmt->bindValue(':nivQualif', $param_nivQualif);
        $stmt->bindValue(':diplome', $param_diplome);
        $stmt->bindValue(':dureeForm', $param_dureeForm);
        $stmt->bindValue(':niv', $param_niv);
        $stmt->bindValue(':mod_form', $param_mod_form);
        $stmt->bindValue(':id_branche', $param_id_branche);

        if ($stmt->execute()) {
          return true;
        } else {
          return false;
        }
      }
    } catch (PDOException $e) {
      echo "Oops !Il ya un erreur ...";
    }
  }

  

}
