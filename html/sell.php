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
  $quantity = $_POST['quantity'];
  $price = $_POST['price'];

  if (sellStack($id,$symbol,$quantity,$price)) {
    $_SESSION['data'] = getUserData($_SESSION['userid']);
    echo "STACKS VENDIDAS";
  }

}


 ?>
