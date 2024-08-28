<?php

require '../../vendor/autoload.php';

use tododeporte\Pedido;

session_start();

if (!isset($_SESSION['usuario_info']) || empty($_SESSION['usuario_info'])) {
    header('Location: ../index.php');
    exit();
}

$pedido = new Pedido();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $accion = $_POST['accion'];
    $id = $_POST['id'];
    $estado = isset($_POST['estado']) ? $_POST['estado'] : '';

    try {
        if ($accion === 'actualizar_estado') {
            if ($pedido->actualizarEstado($id, $estado)) {
                header('Location: ver.php?id=' . $id . '&mensaje=estado_actualizado');
                exit();
            } else {
                throw new Exception("Error al actualizar el estado del pedido.");
            }
        }

        if ($accion === 'eliminar_pedido') {
            if ($pedido->eliminar($id)) {
                header('Location: index.php?mensaje=pedido_eliminado');
                exit();
            } else {
                throw new Exception("Error al eliminar el pedido.");
            }
        }
    } catch (Exception $e) {
        echo $e->getMessage();
    }
}
