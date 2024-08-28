<?php
require '../../vendor/autoload.php';


use tododeporte\Producto;


if (!isset($_GET['id']) || empty($_GET['id'])) {
    die('ID del producto no proporcionado.');
}

$producto_id = $_GET['id'];

$producto = new Producto;


$resultado = $producto->mostrarDetallesPorId($producto_id);

if (!$resultado) {
    die('Producto no encontrado.');
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
    <link rel="icon" type="image/x-icon" href="../assets/images/logo.png">
</head>
<body>
    <nav class="navbar navbar-default navbar-fixed-top">
        <div class="container">
            <div class="navbar-header">
                <a class="navbar-brand" href="../dashboard.php">Mundo Sport</a>
            </div>
        </div>
    </nav>

    <div class="container" id="main">
        <div class="row">
            <div class="col-md-12">
                <fieldset>
                    <legend>Actualizar Producto</legend>
                    <form method="POST" action="../acciones.php" enctype="multipart/form-data">
                        <input type="hidden" name="id" value="<?php echo htmlspecialchars($resultado['id']); ?>">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Nombre</label>
                                    <input value="<?php echo htmlspecialchars($resultado['nombre']); ?>" type="text" class="form-control" name="nombre" required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Descripción</label>
                                    <textarea class="form-control" name="descripcion" cols="3" required><?php echo htmlspecialchars($resultado['descripcion']); ?></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Categoría</label>
                                    <select class="form-control" name="categoria_id" required>
                                        <option value="">--SELECCIONE--</option>
                                        <?php
                                        $categoria = new tododeporte\Categoria;
                                        $info_categoria = $categoria->mostrar();
                                        foreach ($info_categoria as $item) {
                                            echo "<option value=\"{$item['id']}\" " . ($resultado['categoria_id'] == $item['id'] ? 'selected' : '') . ">{$item['nombre']}</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Talle</label>
                                    <input value="<?php echo htmlspecialchars($resultado['talle']); ?>" type="text" class="form-control" name="talle" required>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Stock</label>
                                    <input value="<?php echo htmlspecialchars($resultado['stock']); ?>" type="number" class="form-control" name="stock" required>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Estado</label>
                                    <select class="form-control" name="estado" required>
                                        <option value="activo" <?php echo ($resultado['estado'] == 'activo' ? 'selected' : ''); ?>>Activo</option>
                                        <option value="inactivo" <?php echo ($resultado['estado'] == 'inactivo' ? 'selected' : ''); ?>>Inactivo</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Foto</label>
                                    <input type="file" class="form-control" name="foto">
                                    <input type="hidden" name="foto_temp" value="<?php echo htmlspecialchars($resultado['foto']); ?>">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Precio</label>
                                    <input value="<?php echo htmlspecialchars($resultado['precio']); ?>" type="text" class="form-control" name="precio" placeholder="0.00" required>
                                </div>
                            </div>
                        </div>
                        <input type="submit" class="btn btn-primary" name="accion" value="Actualizar">
                        <a href="index.php" class="btn btn-default">Cancelar</a>
                    </form>
                </fieldset>
            </div>
        </div>
    </div>

    <script src="../../assets/js/jquery.min.js"></script>
    <script src="../../assets/js/bootstrap.min.js"></script>
</body>
</html>
