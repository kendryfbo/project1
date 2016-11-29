<?php
session_start();

require("../include/helper.php");

if (isLogged())
  header("location: portfolio.php");

if (isset($_POST['register'])) {

  if (validarRegistro($_POST['user'],$_POST['pass1'],$_POST['pass2'])) {

    $user= $_POST['user'];
    $password= $_POST['pass1'];
    
    insertUser($user,$password);

    if (login($user,$password)) {

      header("location: ./portfolio.php");

    }
  }
}
?>

<?php require("../view/header.php") ?>
<?php require("../view/registration-form.php") ?>
<?php require("../view/footer.php") ?>
