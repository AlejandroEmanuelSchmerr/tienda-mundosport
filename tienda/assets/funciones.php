<?php


if (!function_exists('agregarProducto')) {
    function agregarProducto($resultado, $id, $cantidad = 1) {
        $_SESSION['carrito'][$id] = array(
            'id' => $resultado['id'],
            'nombre' => $resultado['nombre'],
            'foto' => $resultado['foto'],
            'precio' => $resultado['precio'],
            'cantidad' => $cantidad // Usar la variable $cantidad pasada a la función
        );
    }
}



if (!function_exists('actualizarProducto')) {
    function actualizarProducto($id, $cantidad = FALSE) {
        if ($cantidad) {
            $_SESSION['carrito'][$id]['cantidad'] = $cantidad;
        } else {
            $_SESSION['carrito'][$id]['cantidad'] += 1;
        }
    }
}


if (!function_exists('calcularTotal')) {
    function calcularTotal() {
        $total = 0;
        if (isset($_SESSION['carrito'])) {
            foreach ($_SESSION['carrito'] as $indice => $value) {
                $total += $value['precio'] * $value['cantidad'];
            }
        }
        return $total;
    }
}

if (!function_exists('cantidadProducto')) {
    function cantidadProducto() {
        $cantidad = 0;
        if (isset($_SESSION['carrito'])) {
            foreach ($_SESSION['carrito'] as $indice => $value) {
                $cantidad++;
            }
        }
        return $cantidad;
    }
}