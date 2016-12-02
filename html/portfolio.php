<?php
session_start();

require("../include/helper.php");

if (!isLogged()) {

  header ("location: ./login.php");
  exit;

}

if (isset($_GET['symbol']) && !empty($_GET['symbol']))
{
  $price = stackPrice($_GET['symbol']);
  $_GET['price'] = $price;
 }

$_SESSION['data'] = getUserData($_SESSION['userid']);

 ?>

 <?php require("../view/header.php"); ?>
 <?php require("../view/portfolio.php") ?>
 <?php require("../view/footer.php"); ?>
