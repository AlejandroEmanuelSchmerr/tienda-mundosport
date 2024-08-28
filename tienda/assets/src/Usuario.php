<?php

namespace tododeporte;

class Usuario {

    private $config;
    private $cn = null;

    public function __construct() {
        $this->config = parse_ini_file(__DIR__.'/../config.ini');

        $this->cn = new \PDO($this->config['dns'], $this->config['usuario'], $this->config['clave'], array(
            \PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'
        ));
    }

    public function Login($nombre, $clave) {
        $sql = "SELECT nombre_usuario, clave FROM `usuarios` WHERE nombre_usuario = :nombre";
        
        $resultado = $this->cn->prepare($sql);
        $resultado->execute(array(":nombre" => $nombre));

        $usuario = $resultado->fetch(\PDO::FETCH_ASSOC); // Usa FETCH_ASSOC para obtener un array asociativo

        // Verificar la contraseña usando el hash almacenado
        if ($usuario && password_verify($clave, $usuario['clave'])) {
            return array('nombre_usuario' => $usuario['nombre_usuario']);
        }

        return false;
    }
}
