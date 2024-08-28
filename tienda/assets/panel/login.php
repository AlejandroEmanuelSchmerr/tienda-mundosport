<?php




if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // Habilitar reporte de errores
    error_reporting(E_ALL);
    ini_set('display_errors', 1);

    // Verificar si los parámetros están presentes
    if (isset($_POST['nombre_usuario']) && isset($_POST['clave'])) {
        $nombre_usuario = $_POST['nombre_usuario'];
        $clave = $_POST['clave'];
        
        // Depuración
        var_dump($nombre_usuario, $clave);

        require '../vendor/autoload.php';

        $usuario = new tododeporte\Usuario;
        $resultado = $usuario->Login($nombre_usuario, $clave);

        // Depuración
        var_dump($resultado);

        if ($resultado) {
            session_start();
            $_SESSION['usuario_info'] = array(
                'nombre_usuario' => $resultado['nombre_usuario'],
                'estado' => 1
            );
            header('Location: dashboard.php');
            exit();
        } else {
            exit(json_encode(array('estado' => FALSE, 'mensaje' => 'Error al iniciar sesión')));
        }
    } else {
        exit(json_encode(array('estado' => FALSE, 'mensaje' => 'Datos incompletos')));
    }
}
