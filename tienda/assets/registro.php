<?php
session_start();
require 'vendor/autoload.php';
require 'funciones.php';


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $dni = $_POST['dni'];
    $nombre = $_POST['nombre'];
    $apellidos = $_POST['apellidos'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $telefono = $_POST['telefono'] ?? '';  
    $comentario = $_POST['comentario'] ?? ''; 

    if (empty($dni) || empty($nombre) || empty($apellidos) || empty($email) || empty($password)) {
        $mensaje = 'Todos los campos son obligatorios.';
    } else {
        $cliente = new tododeporte\ClienteRegistrado;
        $password_hash = password_hash($password, PASSWORD_BCRYPT);

        $_params = array(
            'dni' => $dni,
            'nombre' => $nombre,
            'apellidos' => $apellidos,
            'email' => $email,
            'password' => $password_hash,
            'telefono' => $telefono,
            'comentario' => $comentario
        );

        // Depuración
        echo "<pre>";
        print_r($_params);
        echo "</pre>";

        if ($cliente->registrar($_params)) {
            header('Location: login.php');
            exit();
        } else {
            $mensaje = 'Error al registrar el cliente.';
        }
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Registro de Cliente</title>
    <link rel="stylesheet" href="assets/css/registros.css">
    <link rel="icon" type="image/x-icon" href="../assets/images/logo.png">
</head>
<body>
    

    <div class="container">
        <br><br><br><br><br>
        <h1>Registro de Cliente</h1>
        <?php if (isset($mensaje)): ?>
            <p><?php echo htmlspecialchars($mensaje); ?></p>
        <?php endif; ?>
        <form action="" method="post">
            <label for="dni">DNI:</label>
            <input type="text" id="dni" name="dni">
            
            <label for="nombre">Nombre:</label>
            <input type="text" id="nombre" name="nombre">
            
            <label for="apellidos">Apellidos:</label>
            <input type="text" id="apellidos" name="apellidos">
            
            <label for="email">Email:</label>
            <input type="email" id="email" name="email">
            
            <label for="password">Contraseña:</label>
            <input type="password" id="password" name="password">
            
            <label for="telefono">Teléfono:</label>
            <input type="text" id="telefono" name="telefono">
            
            <label for="comentario">Comentario:</label>
            <textarea id="comentario" name="comentario"></textarea>
            
            <button type="submit">Registrar</button>
            <a href="login.php">Ya tengo cuenta</a>
        </form>
        
    </div>
</body>

</html>
