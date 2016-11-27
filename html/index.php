<?php
session_start();

if (isset($_POST['log-in']))
  header("location: ./login.php");

else if (isset($_POST['log-out']))
  header("location: logout.php");

else if (isset($_POST['register']))
  header("location: register.php");

else if (isset($_POST['portfolio']))
  header("location: portfolio.php");

 ?>

<?php require("../view/header.php"); ?>

<div class="container text-xs-center">
  <h1>Welcome to CS75 Appliance</h1>
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
