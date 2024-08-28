<?php
session_start();

require 'vendor/autoload.php';
require 'funciones.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $cliente = new tododeporte\ClienteRegistrado;
    $user = $cliente->validar($email);
    
    if ($user) {
        echo "<pre>";
        echo "Datos del usuario en la base de datos:<br>";
        print_r($user);
        echo "Contraseña ingresada: " . $password . "<br>";
        echo "Hash almacenado en la base de datos: " . $user['password'] . "<br>";
        echo "</pre>";

        if (password_verify($password, $user['password'])) {
            echo "Contraseña verificada correctamente.";
            $_SESSION['cliente_dni'] = $user['dni']; // Usa dni si cambiaste de id a dni
            header('Location: index.php');
            exit();
        } else {
            echo "La contraseña no coincide.";
            $mensaje = 'Credenciales incorrectas.';
        }
    } else {
        echo "Usuario no encontrado.";
        $mensaje = 'Credenciales incorrectas.';
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link rel="stylesheet" href="assets/css/login.css">
</head>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link rel="stylesheet" href="assets/css/login_cliente.css"> <!-- Asegúrate de vincular el CSS -->
</head>
<body>
    <div class="container">
        <h1>Iniciar Sesión</h1>
        <?php if (isset($mensaje)): ?>
            <p><?php echo htmlspecialchars($mensaje); ?></p>
        <?php endif; ?>
        <form action="" method="post">
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>
            
            <label for="password">Contraseña:</label>
            <input type="password" id="password" name="password" required>
            
            <button type="submit">Ingresar</button>
        </form>
        <a href="registro.php">Crear una cuenta</a> <!-- Enlace para redirigir al formulario de registro -->
    </div>
</body>
</html>

