<?php
// Include config file
require_once "C:/xampp\htdocs\cfpa\config.php";

// Define variables and initialize with empty values
$id = $designation = $adress = $lat = $lon  = "";
$id_err = $designation_err = $adress_err = $lat_err = $lon_err = "";

if ($_SERVER['REQUEST_METHOD'] == 'GET') {

  $stmt = $map->fetch_etabs();

  $etabTbl = [];
  $etabTbl['etabs'] = [];

  // On parcourt les établissements
  while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    extract($row);

    $etab = [
      "id" => $id,
      "designation" => $designation,
      "ville" => $adress,
      "latitude" => $latitude,
      "longitude" => $longitude,
    ];
    $etabTbl['etabs'][] = $etab;
  }


  http_response_code(200);

  echo json_encode($etabTbl);
} else {

  http_response_code(405);
  echo json_encode(["message" => "Il ya un erreur !"]);
}
