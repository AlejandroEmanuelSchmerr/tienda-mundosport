
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Mundo Sport</title>
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/css/estilos.css">
    <link rel="icon" type="image/x-icon" href="../assets/images/logo.png">
  </head>
  <body>

    <nav class="navbar navbar-default navbar-fixed-top">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Mundo Sport</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="index.php">Mundo Sport</a>
        </div>
      </div>
    </nav>

    <div class="container" id="main">
        <div class="main-login">
            <form action="login.php" method="post">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="text-center">ACCESOS AL PANEL</h3>
        </div>
        <div class="panel-body">
            <p class="text-center">
                <img src="../assets/imagenes/logo.png" alt="">
            </p>
            <div class="form-group">
                <label>Usuario</label>
                <input type="text" class="form-control" name="nombre_usuario" placeholder="Usuario" required>
            </div>
            <div class="form-group">
                <label>Password</label>
                <input type="password" class="form-control" name="clave" placeholder="Password" required>
            </div>
            <button type="submit" class="btn btn-primary btn-block">LOGIN</button>
        </div>
    </div>
</form>

        </div>

    </div>
    <script src="../assets/js/jquery.min.js"></script>
    <script src="../assets/js/bootstrap.min.js"></script>

  </body>
</html>