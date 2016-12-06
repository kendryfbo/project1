<?php
session_start();

require("../include/helper.php");

if (!isLogged()) {

  header ("location: ./login.php");
  exit;
}

if ( isset($_POST['id']) && isset($_POST['symbol']) && isset($_POST['quantity']) && isset($_POST['price']) ) {

  $id = $_POST['id'];
  $symbol = $_POST['symbol'];
  $price = $_POST['price'];
  $quantity = $_POST['quantity'];

  if (buyStack($id,$symbol,$quantity,$price)) {
    $_SESSION['data'] = getUserData($_SESSION['userid']);
    echo "COMPRADA";
  } else {
    echo "ERROR...";
  }
} else {
  echo "FALTAN VALORES";
}
?>
