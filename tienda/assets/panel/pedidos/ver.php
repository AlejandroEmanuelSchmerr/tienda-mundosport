<?php
session_start();

if (!isset($_SESSION['usuario_info']) OR empty($_SESSION['usuario_info'])) {
    header('Location: ../index.php');
    exit();
}



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
    <link rel="stylesheet" href="../../assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="../../assets/css/estilos.css">
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
          <a class="navbar-brand" href="../dashboard.php">Mundo Sport</a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
          <ul class="nav navbar-nav pull-right">
            <li class="active">
              <a href="index.php" class="btn">Pedidos</a>
            </li> 
            <li>
              <a href="../productos/index.php" class="btn">Productos</a>
            </li>
            <li><a href="estado_cuenta.php" class="btn">Estado de Cuenta</a></li>
            <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Salir<span class="caret"></span></a>
                <ul class="dropdown-menu">
                    <li><a href="../cerrar_session.php">Salir</a></li>
                </ul>
            </li>
          </ul>
        </div>
      </div>
    </nav>

    <div class="container" id="main">
      <div class="row">
        <div class="col-md-12">
          <fieldset>
            <?php
              require '../../vendor/autoload.php';
              $id = $_GET['id'];
              $pedido = new tododeporte\Pedido;
              $id = $_GET['id']; 

              
              $info_pedido = $pedido->mostrarPorId($id);
              $info_detalle_pedido = $pedido->mostrarDetallePorIdPedido($id);
            ?>

            <legend>Información de la Compra</legend>
            <div class="form-group">
              <label>Nombre</label>
              <input value="<?php print $info_pedido['nombre'] ?>" type="text" class="form-control" readonly>
            </div>
            <div class="form-group">
              <label>Apellidos</label>
              <input value="<?php print $info_pedido['apellidos'] ?>" type="text" class="form-control" readonly>
            </div>
            <div class="form-group">
              <label>Email</label>
              <input value="<?php print $info_pedido['email'] ?>" type="text" class="form-control" readonly>
            </div>
            <div class="form-group">
              <label>Fecha</label>
              <input value="<?php print $info_pedido['fecha'] ?>" type="text" class="form-control" readonly>
            </div>

            <hr>
            Productos Comprados
            <hr>
            <table class="table table-bordered">
              <thead>
                <tr>
                  <th>#</th>
                  <th>Nombre</th>
                  <th>Foto</th>
                  <th>Precio</th>
                  <th>Cantidad</th>
                  <th>Total</th>
                </tr>
              </thead>
              <tbody> 
                <?php
                  $cantidad = count($info_detalle_pedido);
                  if($cantidad > 0){
                    $c=0;
                    foreach ($info_detalle_pedido as $item) {
                      $c++;
                      $total = $item['precio'] * $item['cantidad'];
                ?>

                <tr>
                  <td><?php print $c?></td>
                  <td><?php print $item['nombre']?></td>
                  <td>
                    <?php
                      $foto = '../../upload/'.$item['foto'];
                      if(file_exists($foto)){
                    ?>
                      <img src="<?php print $foto; ?>" width="35">
                    <?php } else { ?>
                      SIN FOTO
                    <?php } ?>
                  </td>
                  <td><?php print $item['precio']?> </td>
                  <td><?php print $item['cantidad']?></td>
                  <td><?php print $total?></td>
                </tr>

                <?php
                    }
                  } else {
                ?>
                <tr>
                  <td colspan="6">NO HAY REGISTROS</td>
                </tr>

                <?php } ?>
              </tbody>
            </table>

            <div class="col-md-3">
              <div class="form-group">
                <label>Total Compra</label>
                <input value="<?php print $info_pedido['total'] ?>" type="text" class="form-control" readonly>
              </div>
            </div>

            <form method="post" action="completar_pedido.php">
    <input type="hidden" name="pedido_id" value="<?php echo $info_pedido['id']; ?>">
    <div class="form-group">
        <label for="estado">Estado del Pedido</label>
        <select name="estado" class="form-control">
            <option value="Pendiente" <?php if ($info_pedido['estado'] == 'Pendiente') echo 'selected'; ?>>Pendiente</option>
            <option value="Entregado" <?php if ($info_pedido['estado'] == 'Entregado') echo 'selected'; ?>>Entregado</option>
            <option value="Anulado" <?php if ($info_pedido['estado'] == 'Anulado') echo 'selected'; ?>>Anulado</option>
        </select>
    </div>
    <button type="submit" class="btn btn-primary">Actualizar Estado</button>
</form>
                <form action="acciones.php" method="POST" style="margin-top: 20px;">
                    <input type="hidden" name="accion" value="eliminar_pedido">
                    <input type="hidden" name="id" value="<?php echo $id; ?>">
                    <button type="submit" class="btn btn-danger">Eliminar Pedido</button>
                </form>



          </fieldset>
          
          <div class="pull-left">
            <a href="index.php" class="btn btn-default">Cancelar</a>
          </div>

          <div class="pull-right">
            <a href="javascript:;" id="btnImprimir" class="btn btn-danger">Imprimir</a>
          </div>
        </div>
      </div>
    </div>

    <script src="../../assets/js/jquery.min.js"></script>
    <script src="../../assets/js/bootstrap.min.js"></script>
    <script>
      document.getElementById('btnImprimir').addEventListener('click', function() {
        window.print();
      });
    </script>
  </body>
</html>