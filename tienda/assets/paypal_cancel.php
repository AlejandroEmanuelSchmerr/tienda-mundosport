<?php
session_start();

// Aquí podrías mostrar un mensaje al usuario indicando que la transacción ha sido cancelada
// y permitirles regresar al carrito o continuar comprando.

?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pago Cancelado</title>
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
</head>
<body>
    <?php include('header.php'); ?>
    <div class="container">
        <h1>Pago Cancelado</h1>
        <p>La transacción ha sido cancelada. No se ha realizado ningún cargo.</p>
        <a href="carrito.php" class="btn btn-info">Regresar al carrito</a>
        <a href="productos.php" class="btn btn-primary">Seguir Comprando</a>
    </div>
    <?php include('includes/footer.html'); ?>
    <?php include('includes/js.html'); ?>
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
</body>
</html>
