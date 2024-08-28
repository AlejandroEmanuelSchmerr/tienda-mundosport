<?php

require '../vendor/autoload.php';

use tododeporte\Producto;

session_start();

if (!isset($_SESSION['usuario_info']) || empty($_SESSION['usuario_info'])) {
    header('Location: ../index.php');
    exit();
}

$producto = new Producto();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $accion = $_POST['accion'];
    
    if ($accion === 'Registrar') {
        if (empty($_POST['nombre']) || empty($_POST['descripcion']) || empty($_POST['categoria_id']) || !is_numeric($_POST['categoria_id'])) {
            exit('Completar nombre, descripcion y categoría válida');
        }

        $_params = [
            'nombre' => $_POST['nombre'],
            'descripcion' => $_POST['descripcion'],
            'precio' => $_POST['precio'],
            'talle' => $_POST['talle'],
            'stock' => $_POST['stock'],
            'categoria_id' => $_POST['categoria_id'],
            'fecha' => date('Y-m-d'),
            'estado' => $_POST['estado'],
            'foto' => subirFoto(),
        ];

        $rpt = $producto->registrar($_params);

        if ($rpt) {
            header('Location: productos/index.php');
        } else {
            print 'Error al registrar un producto';
        }
    }

    if ($accion === 'Actualizar') {
        if (empty($_POST['nombre']) || empty($_POST['descripcion']) || empty($_POST['categoria_id']) || !is_numeric($_POST['categoria_id'])) {
            exit('Completar nombre, descripcion y categoría válida');
        }

        $_params = [
            'nombre' => $_POST['nombre'],
            'descripcion' => $_POST['descripcion'],
            'precio' => $_POST['precio'],
            'talle' => $_POST['talle'],
            'stock' => $_POST['stock'],
            'categoria_id' => $_POST['categoria_id'],
            'fecha' => date('Y-m-d'),
            'estado' => $_POST['estado'],
            'id' => $_POST['id'],
        ];

        if (!empty($_POST['foto_temp'])) {
            $_params['foto'] = $_POST['foto_temp'];
        }

        if (!empty($_FILES['foto']['name'])) {
            $_params['foto'] = subirFoto();
        }

        $rpt = $producto->actualizar($_params);

        if ($rpt) {
            header('Location: productos/index.php');
        } else {
            print 'Error al actualizar un producto';
        }
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['id'])) {
    $id = $_GET['id'];
    $rpt = $producto->eliminar($id);

    if ($rpt) {
        header('Location: productos/index.php');
    } else {
        print 'Error al eliminar un producto';
    }
}

function subirFoto() {
    $carpeta = __DIR__ . '/../upload/';
    $nombreArchivo = $_FILES['foto']['name'];
    $archivo = $carpeta . basename($nombreArchivo);

    if (move_uploaded_file($_FILES['foto']['tmp_name'], $archivo)) {
        return $nombreArchivo;
    } else {
        return null;  // O manejar el error de manera adecuada
    }
}

