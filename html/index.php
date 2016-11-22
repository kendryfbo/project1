<?php
session_start();

if (isset($_POST['log-in'])) {

    header("location: ./login.php");
}

if (isset($_POST['log-out'])) {

  $_SESSION['logged'] = false;

}

if (isset($_POST['register'])) {

  $_SESSION['logged'] = false;
  header("location: ./register.php");
}


 ?>

<?php require("../view/header.php"); ?>

<div class="container text-xs-center">
  <h1>INDEX PAGE</h1>
</div>
<div class="container text-xs-center">
  <spam>
    <i class="fa fa-certificate fa-5x bg-active"></i>
    <i class="fa fa-certificate fa-5x bg-active"></i>
    <i class="fa fa-certificate fa-5x bg-active"></i>
    <i class="fa fa-certificate fa-5x bg-inactive"></i>
    <i class="fa fa-certificate fa-5x bg-inactive"></i>
  <spam>
</div>
<?php require("../view/footer.php"); ?>
