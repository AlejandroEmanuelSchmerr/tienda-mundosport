<?php
session_start();
require 'vendor/autoload.php';

use tododeporte\Pedido;


if (!isset($_SESSION['cliente_dni'])) {
    header('Location: login.php');
    exit();
}

$mensaje = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $pedido_id = $_POST['pedido_id'] ?? null;
    
    if ($pedido_id) {
        $pedido = new Pedido();
        $resultado = $pedido->cambiarEstado($pedido_id, 'Anulado'); 
        
        if ($resultado) {
            $mensaje = "El pedido ha sido anulado correctamente.";
        } else {
            $mensaje = "Hubo un problema al anular el pedido. Verifica el ID del pedido.";
        }
    } else {
        $mensaje = "Por favor, ingrese un ID de pedido válido.";
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Solicitud de Arrepentimiento</title>
    <link rel="stylesheet" href="assets/css/arrepentimiento.css">
</head>
<body>
    <div class="container">
        <h1>Solicitud de Arrepentimiento de Orden</h1>
        <?php if ($mensaje): ?>
            <p class="message <?php echo ($resultado ? '' : 'error'); ?>">
                <?php echo htmlspecialchars($mensaje); ?>
            </p>
        <?php endif; ?>
        <form action="arrepentimiento.php" method="post">
            <label for="pedido_id">ID del Pedido:</label>
            <input type="text" id="pedido_id" name="pedido_id" required>
            <button type="submit">Enviar</button>
        </form>
    </div>
</body>
</html>