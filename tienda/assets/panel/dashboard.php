<?php
session_start();

if(! isset($_SESSION['usuario_info'])OR empty($_SESSION['usuario_info']))
  header('Location: ../index.php')
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Mundo Sport</title>
    <link rel="icon" type="image/x-icon" href="../assets/images/logo.png">
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/css/estilos.css">
  </head>

  <body>


    <nav class="navbar navbar-default navbar-fixed-top">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="index.php">Mundo Sport</a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
          <ul class="nav navbar-nav pull-right">
            <li>
              <a href="pedidos/index.php" class="btn">Pedidos</a>
            </li> 
            <li>
              <a href="productos/index.php" class="btn">Productos</a>
            </li>
            <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Salir<span class="caret"></span></a>
                <ul class="dropdown-menu">
                    <li><a href="cerrar_session.php">Salir</a></li>
                </ul>
            </li>
          </ul>
        </div>>
      </div>
    </nav>

    <div class="container" id="main">
    
    </div> 
    <div class="welcome-message">
    <h1>Bienvenido Jefe de Ventas</h1>
    </div>



    <script src="../assets/js/jquery.min.js"></script>
    <script src="../assets/js/bootstrap.min.js"></script>

  </body>
</html>
