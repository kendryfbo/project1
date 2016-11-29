<?php

define ("HOST",'127.0.0.1');
define ("DB",'finances');
define ("USER",'root');
define ("PASS",'19017070');
define ("GIFT",10000);

/* check connection to DB */ 
function connect() {
  $conexion = new PDO('mysql:host=localhost;dbname=finances',USER,PASS);

  return $conexion;
}

/* Check user and password */
function login($user,$password) {

  $conexion = new PDO('mysql:host=localhost;dbname=finances',USER,PASS);

  if ($conexion)
  {
    $sentencia = $conexion->prepare("SELECT id FROM users WHERE user=:user AND password=:password");

    $sentencia->bindParam(':user', $user);
    $sentencia->bindParam(':password', $password);

    $sentencia->execute();

    $value= $sentencia->fetchColumn();

    if ($value) {

      $_SESSION['logged'] = true;
      $_SESSION['userid'] = $value;

    } else {

      $_SESSION['logged'] = false;
      $_SESSION['userid'] = "";
    }

    return $value;

  }
}

/* Verify if logged */
function isLogged() {

  if (isset($_SESSION['logged']) && ($_SESSION['logged']))
    return true;

  return false;

}

/* registrar Nuevo Usuario */
function insertUser($user,$password) {

  $balance = GIFT;
  $conexion = new PDO('mysql:host=localhost;dbname=finances',USER,PASS);

  if ($conexion){
    $sentencia = $conexion->prepare("INSERT INTO users (user,password,balance) VALUES (:user,:password,:balance)");
    $sentencia->bindParam(':user', $user);
    $sentencia->bindParam(':password', $password);
    $sentencia->bindParam(':balance', $balance);

    return $sentencia->execute();
  }

}

/* Get user date */
function getUserData($id) {

  $conexion = new PDO('mysql:host=localhost;dbname=finances',USER,PASS);
  if ($conexion){

    $sentencia = $conexion->prepare("SELECT user,balance FROM users WHERE id=:id");
    $sentencia->bindParam(':id', $id);
    $sentencia->execute();
    $info= $sentencia->fetch(PDO::FETCH_ASSOC);

    $sentencia = $conexion->prepare("SELECT id,symbol,quantity FROM stacks WHERE userid=:id");
    $sentencia->bindParam(':id', $id);
    $sentencia->execute();
    $stacks= $sentencia->fetchAll(PDO::FETCH_ASSOC);
    $data = [$info,$stacks];

    return $data;
  }
}

/* Get Stack Price */
function stackPrice($symbol) {

  $s = urlencode($symbol);
  $url = "http://download.finance.yahoo.com/d/quotes.csv?s={$s}&f=sl1d1t1c1ohgv&e=.csv";

  $file = fopen($url,"r");
  $row = fgetcsv($file);

  return $row[1];
}

/* Valida Registro de usuario */
function validarRegistro($user,$pass1,$pass2) {

  $_POST['error'] = [false,""];

  if (empty($user) || empty($pass1) || empty($pass2))
    $_POST['error'] = [true,"Debe llenar todos los campos"];

  else if ($pass1 != $pass2)
    $_POST['error'] = [true,"Las contraseñas no concuerdan"];

  else if (!validateUser($user))
    $_POST['error'] = [true,"Usuario no cumplen con los criterios establecidos"];

  else if (userExist($user))
    $_POST['error'] = [true,"Usuario ya se encuentra Registrado"];

  else if (!validatePassword($pass1))
    $_POST['error'] = [true,"Password no cumplen con los criterios establecidos"];

  return !$_POST['error'][0];
}

/* validate User */
function validateUser($user) {

  if (filter_var($user,FILTER_VALIDATE_EMAIL))
    return true;

  return false;
}

/* Verificar si Usuario esta registrado */
function userExist($user) {
  $conexion = new PDO('mysql:host=localhost;dbname=finances',USER,PASS);
  if ($conexion){
    $sentencia = $conexion->prepare("SELECT 1 FROM users WHERE user=:user");
    $sentencia->bindParam(':user', $user);
    $sentencia->execute();
    $value = $sentencia->fetchColumn();
    return $value;
  }

}

/* validate Password */
function validatePassword($password) {

  $length = 6;
  $arrayPassword = str_split($password, 1);

  if (strlen($password) < $length)
    return false;

  if (preg_match('/[A-Z]+[a-z]+[0-9]+/', $password))
    return true;

  return false;

}

 ?>
