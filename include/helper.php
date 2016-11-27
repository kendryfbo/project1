<?php

define ("HOST",'127.0.0.1');
define ("DB",'finance');
define ("USER",'root');
define ("PASS",'19017070');

function connect()
{
  $conexion = new PDO('mysql:host=localhost;dbname=finances',USER,PASS);

  return $conexion;
}


/* Check user and password */

function login($user,$password)
{
// Verificacion de Usuario en base de datos - deshabilitado para pruebas sin base de datos.
/*
  $conexion = new PDO('mysql:host=localhost;dbname=finances',USER,PASS);

  if ($conexion)
  {
    $sentencia = $conexion->prepare("SELECT 1 FROM users WHERE user=:user AND password=:password");

    $sentencia->bindParam(':user', $user);
    $sentencia->bindParam(':password', $password);

    $sentencia->execute();

    $value= $sentencia->fetchColumn();

    return $value;
  }
  */

// Sustituto de Funcion login Temporal

if ($user == "kendryfbo" && $password == "19017070")

  return true;

else

  return false;

}

function isLogged() {

  if (isset($_SESSION['logged']) && ($_SESSION['logged']))
    return true;

return false;

}




function insertUser($user,$password)
{
  $conexion = new PDO('mysql:host=localhost;dbname=finances',USER,PASS);
  if ($conexion){
    $sentencia = $conexion->prepare("INSERT INTO users (user,password) VALUES (:user,:password)");
    $sentencia->bindParam(':user', $user);
    $sentencia->bindParam(':password', $password);
    $sentencia->execute();
  }
}


/* Get Stack Price */

function stackPrice($symbol)
{
  $s = urlencode($symbol);
  $url = "http://download.finance.yahoo.com/d/quotes.csv?s={$s}&f=sl1d1t1c1ohgv&e=.csv";

  $file = fopen($url,"r");
  $row = fgetcsv($file);

  return $row[1];
}

 ?>
