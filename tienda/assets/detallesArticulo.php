<?php
session_start();
require 'funciones.php';
require 'vendor/autoload.php';

if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id = $_GET['id'];

    $producto = new tododeporte\Producto;
    $info_producto = $producto->mostrarPorId($id);

    if ($info_producto) {
        // Aquí puedes usar los detalles del producto para mostrarlos en la página
        ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link rel="stylesheet" type="text/css" href="assets/css/bootstrap4/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="assets/css/main_styles.css">
    <link rel="stylesheet" type="text/css" href="assets/css/responsive.css">
    <link rel="stylesheet" type="text/css" href="assets/css/single_styles.css">
    <link rel="stylesheet" type="text/css" href="assets/css/single_responsive.css">
    <link rel="stylesheet" href="assets/css/button_cart.css">
    <link rel="stylesheet" href="assets/css/loader.css">
    <link rel="icon" type="image/x-icon" href="../assets/images/logo.png">
    <title>Detalles del Producto</title>
    <script>
        function agregarAlCarrito(productId) {
            window.location.href = 'carrito.php?id=' + productId;
        }
    </script>
</head>
<body>
    <div class="super_container">
        <?php include('header.php'); ?>

        <div class="container single_product_container">
            <div class="row">
                <!-- Imagen del producto -->
                <div class="col-lg-6">
                    <div class="single_product_image">
                        <?php if (!empty($info_producto['foto']) && file_exists('upload/'.$info_producto['foto'])): ?>
                            <img src="<?php print 'upload/'.$info_producto['foto']; ?>" class="img-responsive" alt="Imagen del producto">
                        <?php else: ?>
                            <img src="assets/imagenes/not-found.jpg" class="img-responsive" alt="Imagen no disponible">
                        <?php endif; ?>
                    </div>
                </div>

                <!-- Detalles del producto -->
                <div class="col-lg-6">
                    <div class="product_details_title">
                        <h2 id="titleArticulo">
                            <a href="productos.php">
                                <i class="fas fa-angle-left" style="color: #666;"></i>
                            </a>
                            &nbsp;
                            <?php print $info_producto['nombre']; ?>
                        </h2>
                        <p><strong>Descripción:</strong> <?php print $info_producto['descripcion']; ?></p>
                        <p><strong>Precio:</strong> <?php print $info_producto['precio']; ?></p>
                        <p><strong>Talle:</strong> <?php print $info_producto['talle']; ?></p>
                        <p><strong>Stock:</strong> <?php print $info_producto['stock']; ?></p>
                        <p><strong>Estado:</strong> <?php print $info_producto['estado']; ?></p>
                        
                        </a>
                        <p>
                            <button class="button cart-button btn block" onclick="agregarAlCarrito(<?php print $info_producto['id']; ?>)">
                                <span>Agregar a Carrito</span>
                                <div class="cart">
                                    <svg viewBox="0 0 36 26">
                                        <polyline points="1 2.5 6 2.5 10 18.5 25.5 18.5 28.5 7.5 7.5 7.5"></polyline>
                                        <polyline points="15 13.5 17 15.5 22 10.5"></polyline>
                                    </svg>
                                </div>
                            </button>
                        </p>
                        
                    </div>
                </div>
            </div>
        </div>

        <?php include('includes/footer.html'); ?>
    </div>
    <?php include('includes/js.html'); ?>
</body>
</html>

        <?php
    } else {
        echo "El producto no existe.";
    }
} else {
    echo "ID de producto inválido.";
}
?>
