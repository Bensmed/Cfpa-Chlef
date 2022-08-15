<?php
session_start();
// connection bdd
$server = "localhost";
$dbname = "cfpa";
$username = "root";
$password = "";
$dsn = "mysql:host={$server};dbname={$dbname}";

try {
  //Make the connection
  $pdo = new PDO($dsn, $username, $password);
  // set the PDO error mode to exception
  $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {

  echo "Could not connect : " . $e->getMessage();
}

// PATH
define('ROOT_PATH', realpath(dirname(__FILE__))); // path to the root folder
define('LOGIC_PATH', realpath(dirname(__FILE__) . '/logic')); // Path to includes folder
define('LAYOUTS_PATH', realpath(dirname(__FILE__) . '/layouts')); // path to the root folder



//RELIER BDD AVEC CLASS
include_once("admin/users/class.user.php");
$user = new USER($pdo);

//RELIER BDD AVEC CLASS
include_once("admin/users/class.map.php");
$map = new MAP($pdo);
