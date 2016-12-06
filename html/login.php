<?php
session_start();
require("../include/helper.php");

if (isLogged())
  header("location: portfolio.php");

if (isset($_POST['user']) && isset($_POST['pass'])) {

  $user= $_POST['user'];
  $pass= $_POST['pass'];

  if (login($user,$pass)) {

    $_SESSION['data'] = getUserData($_SESSION['userid']);
    header("location: ./portfolio.php");
    exit;
  } else {

    $_POST['error'] = true;
    $_SESSION['logged'] = false;

  }
}
 ?>

<?php require("../view/header.php"); ?>

<?php require("../view/login-form.php"); ?>

<?php require("../view/footer.php"); ?>
