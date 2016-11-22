<!DOCTYPE html>
<html>
  <head>
    <!-- Required meta tags always come first -->
   <meta charset="utf-8">
   <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
   <meta http-equiv="x-ua-compatible" content="ie=edge">

    <title>C$75 Finance</title>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="../assets/css/bootstrap.css">
    <!-- Custom.css -->
    <link rel="stylesheet" href="../assets/css/custom.css">

  </head>
  <body>

    <!-- Navbar -->
    <nav class="navbar navbar-light bg-inverse navbar-full">
      <a class="navbar-brand display-2" href="../html/index.php"><strong>C$75</strong> Finance</a>
      <ul class="nav navbar-nav pull-xs-right">
        <li class="nav-item">
          <form class="form-inline" action="../html/index.php" method="post">
            
            <?php if (isset($_SESSION['logged']) && $_SESSION['logged']) : ?>

              <button class="btn btn-sm btn-danger" type="submit" name="log-out">Log-Out</button>

            <?php else : ?>
              <button class="btn btn-sm btn-outline-primary" type="submit" name="log-in">Log-In</button>
              <button class="btn btn-sm btn-success" type="submit" name="register">Register</button>

            <?php endif; ?>

          </form>
        </li>
      </ul>
    </nav>
