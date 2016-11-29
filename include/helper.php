<?php

define ("HOST",'127.0.0.1');
define ("DB",'finances');
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
}

function isLogged() {

  if (isset($_SESSION['logged']) && ($_SESSION['logged']))
    return true;

return false;

}

/* registrar Nuevo Usuario */
function insertUser($user,$password) {

  $balance = 10000;
  $conexion = new PDO('mysql:host=localhost;dbname=finances',USER,PASS);
  if ($conexion){
    $sentencia = $conexion->prepare("INSERT INTO users (user,password,balance) VALUES (:user,:password,:balance)");
    $sentencia->bindParam(':user', $user);
    $sentencia->bindParam(':password', $password);
    $sentencia->bindParam(':balance', $balance);
    $sentencia->execute();
  }
}


function getUserData($id) {

  $conexion = new PDO('mysql:host=localhost;dbname=finances',USER,PASS);
  if ($conexion){
    $sentencia = $conexion->prepare("SELECT user,balance FROM users WHERE id=:id");
    $sentencia->bindParam(':id', $id);
    $sentencia->execute();
    $value= [$sentencia->fetchColumn(0)];

    return $value;
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
