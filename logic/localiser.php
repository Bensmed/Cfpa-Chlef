<?php
require_once "C:/xampp\htdocs\cfpa\config.php";


// On autorise les requêtes Ajax pour toutes les sources
header('Access-Control-Allow-Origin: *');
// On vérifie qu'on utilise la méthode GET
if ($_SERVER['REQUEST_METHOD'] == 'GET') {
  // Ici on utilise la méthode GET
  // On se connecte à la base


  $result = $map->localiser($_GET["lat"], $_GET["lon"], $_GET["distance"]);

  // // On envoie le code de confirmation
  http_response_code(200);

  // // On envoie les données en json
  echo json_encode($result);

  // On se déconnecte de la base
  $db = null;
} else {
  http_response_code(405);
  echo 'La méthode pas autorisée';
}
