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

/* Sell Stack */
function sellStack($id,$symbol,$quantity,$price) {

  $conexion = new PDO('mysql::host=localhost;dbname=finances',USER,PASS);

  if ($conexion) {

    $conexion->beginTransaction();

    $balance = getBalance($id);

    $totalSell = $quantity * $price;
    $balance = $balance + $totalSell;

    $sentencia = $conexion->prepare("UPDATE users SET balance=:balance WHERE id=:id");
    $sentencia->bindParam('id',$id);
    $sentencia->bindParam('balance',$balance);

    if (!$sentencia->execute()) {
      echo("ERROR AL ACTUALIZAR BALANCE");
      $conexion->rollBack();
      return false;
    }

    $sentencia = $conexion->prepare("DELETE FROM stacks WHERE userid=:userid AND symbol=:symbol");

    $sentencia->bindParam('userid',$id);
    $sentencia->bindParam('symbol',$symbol);

    if (!$sentencia->execute()) {
      echo("ERROR AL ELIMINAR STACKS");
      $conexion->rollBack();
      return false;
    }

    $conexion->commit();
    return true;
  }
}

/* Buy Stack */
function buyStack($id,$symbol,$quantity,$price) {

  $conexion = new PDO('mysql::host=localhost;dbname=finances',USER,PASS);

  if ($conexion) {

    if ($quantity <= 0) {
      echo "cantidad debe ser mayor a 0";
      return false;
    }

    $balance = getBalance($id);

    $totalBuy = $quantity * $price;
    $balance = $balance - $totalBuy;

    if ($balance < 0) {
      echo "COMPRANDO MAS DE LO QUE TIENE";
      $conexion->rollBack();
      return false;
    }
    
    $conexion->beginTransaction();

    $sentencia = $conexion->prepare("UPDATE users SET balance=:balance WHERE id=:id");
    $sentencia->bindParam('id',$id);
    $sentencia->bindParam('balance',$balance);

    if (!$sentencia->execute()) {
      echo("ERROR AL ACTUALIZAR BALANCE");
      $conexion->rollBack();
      return false;
    }

    $sentencia = $conexion->prepare("INSERT INTO stacks (userid,symbol,name,quantity,date)
    VALUES (:userid,:symbol,:symbol,:quantity,CURDATE())");

    $sentencia->bindParam('userid',$id);
    $sentencia->bindParam('symbol',$symbol);
    $sentencia->bindParam('quantity',$quantity);

    if (!$sentencia->execute()) {
      echo("ERROR AL ELIMINAR STACKS");
      $conexion->rollBack();
      return false;
    }

    $conexion->commit();
    return true;
  }
}

function getBalance($id) {

  $conexion = new PDO('mysql::host=localhost;dbname=finances',USER,PASS);

  if ($conexion) {

    $sentencia = $conexion->prepare("SELECT balance FROM users WHERE id=:id");
    $sentencia->bindParam('id',$id);
    $sentencia->execute();
    $balance = $sentencia->fetchColumn();
    return $balance;
  }
  return false;
}
 ?>
