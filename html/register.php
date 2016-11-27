<?php
session_start();

require("../include/helper.php");

if (isLogged())
  header("location: portfolio.php");

if (isset($_POST['user']) && isset($_POST['pass1'])) {

  $user= $_POST['user'];
  $password= $_POST['pass1'];

  insertUser($user,$password);

  $_SESSION['logged'] = true;

  header ("location: ./portfolio.php");
}
?>

<?php require("../view/header.php") ?>
<?php require("../view/registration-form.php") ?>
<?php require("../view/footer.php") ?>
