<?php

session_start();
require 'funciones.php';


// Verificar si el usuario está autenticado

if (!isset($_SESSION['cliente_dni'])) {
    header('Location: registro.php'); // Redirigir a registro si no está autenticado
    exit();
}

if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id = $_GET['id'];
    require 'vendor/autoload.php';
    $producto = new tododeporte\Producto;
    $resultado = $producto->mostrarPorId($id);
    
    
    if (!$resultado) {
        header('Location: carrito.php'); // Redirigir al carrito de compras
        exit();
    }

    if (isset($_SESSION['carrito'])) { // SI EL CARRITO EXISTE
        // SI EL PRODUCTO EXISTE EN EL CARRITO
        if (array_key_exists($id, $_SESSION['carrito'])) {
            actualizarProducto($id);
        } else {
            // SI EL PRODUCTO NO EXISTE EN EL CARRITO
            agregarProducto($resultado, $id);
        }
    } else {
        // SI EL CARRITO NO EXISTE
        agregarProducto($resultado, $id);
    }
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

    <title>Carrito</title>
    <link rel="icon" type="image/x-icon" href="../assets/images/logo.png">
 
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/estilos.css">
  </head>

  <body>

  <?php include('header.php'); ?>
  
  
    <div class="container" id="main">
    <a href="cerrar_sesion.php" class="btn btn-danger">Cerrar sesión</a>
        <table class="table table-bordered table-hover">
              <thead>
                <tr>
                  <th>#</th>
                  <th>Producto</th>
                  <th>Foto</th>
                  <th>Precio</th>
                  <th>Cantidad</th>
                  <th>Total</th>
                  <th></th>
                </tr>
              </thead>
              <tbody>
                  <?php
                    if(isset($_SESSION['carrito']) && !empty($_SESSION['carrito'])){
                        $c=0;
                        foreach($_SESSION['carrito'] as $indice => $value){
                            $c++;
                            $total = $value['precio'] * $value['cantidad'];
                  ?>
                    <tr>
                        <form action="actualizar_carrito.php" method="post">
                            <td><?php print $c ?></td>
                            <td><?php print $value['nombre']  ?></td>
                            <td>
                                <?php
                                    $foto = 'upload/'.$value['foto'];
                                    if(file_exists($foto)){
                                    ?>
                                    <img src="<?php print $foto; ?>" width="35">
                                <?php }else{?>
                                    <img src="assets/imagenes/not-found.jpg" width="35">
                                <?php }?>
                            </td>
                            <td><?php print $value['precio']  ?> $</td>
                            <td>
                            <input type="hidden" name="id"  value="<?php print $value['id'] ?>">
                                <input type="text" name="cantidad" class="form-control u-size-100" value="<?php print $value['cantidad'] ?>">
                            </td>
                            <td>
                                <?php print $total  ?> $
                            </td>
                            <td>
                                <button type="submit" class="btn btn-success btn-xs">
                                    <span class="glyphicon glyphicon-refresh"></span> 
                                </button>

                                <a href="eliminar_carrito.php?id=<?php print $value['id']  ?>" class="btn btn-danger btn-xs">
                                    <span class="glyphicon glyphicon-trash"></span> 
                                </a>
                            </td>
                        </form>
                    </tr>
                    
                <?php
                    }
                    }else{
                ?>
                    <tr>
                        <td colspan="7">NO HAY PRODUCTOS EN EL CARRITO</td>
                    </tr>
                <?php
                    }
                ?>
            </tbody>
            <tfoot>
                    <tr>
                        <td colspan="5" class="text-right">Total</td>
                        <td><?php print calcularTotal(); ?> $</td>
                        <td></td>
                    </tr>
            </tfoot>
        </table>
        <hr>
        <?php
            if(isset($_SESSION['carrito']) && !empty($_SESSION['carrito'])){
        ?>  
            <div class="row">
    <div class="pull-left">
        <a href="productos.php" class="btn btn-info">Seguir Comprando</a>
    </div>
    <div class="pull-right">
        <form action="completar_pedido.php" method="post">
            <button type="submit" class="btn btn-success">Marcar como pendiente</button>
            
        </form>
        
    </div>
</div>

        <?php
            }
        ?>
    </div> <!-- /container -->
    <?php include('includes/footer.html'); ?>
    <?php include('includes/js.html'); ?>
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
  </body>
</html>
