<?php
session_start();

require("../include/helper.php");

if (!isLogged())
  header ("location: ./login.php");

if (isset($_GET['symbol']) && !empty($_GET['symbol']))
{
  $price = stackPrice($_GET['symbol']);
  $_GET['price'] = $price;
 }
 ?>

 <?php require("../view/header.php"); ?>
 <?php require("../view/portfolio.php") ?>
 <?php require("../view/footer.php"); ?>
