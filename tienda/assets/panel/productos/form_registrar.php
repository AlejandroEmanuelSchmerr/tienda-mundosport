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
                <a class="navbar-brand" href="../dashboard.php">Mundo  Sport</a>
            </div>
        </div>
    </nav>

    <div class="container" id="main">
        <div class="row">
            <div class="col-md-12">
                <fieldset>
                    <legend>Datos del Producto</legend>
                    <form method="POST" action="../acciones.php" enctype="multipart/form-data">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Nombre</label>
                                    <input type="text" class="form-control" name="nombre" required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Descripción</label>
                                    <textarea class="form-control" name="descripcion" cols="3" required></textarea>
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
                                        require '../../vendor/autoload.php';
                                        $categoria = new tododeporte\Categoria;
                                        $info_categoria = $categoria->mostrar();
                                        foreach ($info_categoria as $item) {
                                            echo "<option value=\"{$item['id']}\">{$item['nombre']}</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Talle</label>
                                    <input type="text" class="form-control" name="talle" required>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Stock</label>
                                    <input type="number" class="form-control" name="stock" required>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Estado</label>
                                    <select class="form-control" name="estado" required>
                                        <option value="1">Activo</option>
                                        <option value="0">Inactivo</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Foto</label>
                                    <input type="file" class="form-control" name="foto" required>
                                    
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Precio</label>
                                    <input type="text" class="form-control" name="precio" placeholder="0.00" required>
                                </div>
                            </div>
                        </div>
                        <input type="submit" name="accion" class="btn btn-primary" value="Registrar">
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
