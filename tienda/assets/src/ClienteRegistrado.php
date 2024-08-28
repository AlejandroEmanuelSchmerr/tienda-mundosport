<?php


namespace tododeporte;

class ClienteRegistrado {

    private $config;
    private $cn = null;

    public function __construct(){
        $this->config = parse_ini_file(__DIR__.'/../config.ini');
        $this->cn = new \PDO($this->config['dns'], $this->config['usuario'], $this->config['clave'], array(
            \PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'
        ));
    }

  
    public function registrar($_params) {
        // Verificar si el email ya existe
        $sql = "SELECT COUNT(*) FROM clientes_registrados WHERE email = :email";
        $resultado = $this->cn->prepare($sql);
        $resultado->execute([':email' => $_params['email']]);
        $count = $resultado->fetchColumn();
    
        if ($count > 0) {
            throw new \Exception('El email ya está registrado.');
        }
    
        $sql = "INSERT INTO `clientes_registrados`(`dni`, `nombre`, `apellidos`, `email`, `password`, `telefono`, `comentario`) 
                VALUES (:dni, :nombre, :apellidos, :email, :password, :telefono, :comentario)";
        
        $resultado = $this->cn->prepare($sql);
    
        // Usar el password hash que ya se generó
        $_array = array(
            ":dni" => $_params['dni'],
            ":nombre" => $_params['nombre'],
            ":apellidos" => $_params['apellidos'],
            ":email" => $_params['email'],
            ":password" => $_params['password'], // El hash ya está generado en el código de registro
            ":telefono" => $_params['telefono'],
            ":comentario" => $_params['comentario']
        );
    
        return $resultado->execute($_array); // Retorna true o false
    }
    public function obtenerClientePorDni($dni) {
        $sql = "SELECT dni, nombre, apellidos, telefono, email FROM clientes_registrados WHERE dni = :dni";
        $resultado = $this->cn->prepare($sql);
        $resultado->execute([':dni' => $dni]);
        return $resultado->fetch(\PDO::FETCH_ASSOC);
    }
    
    public function validar($email) {
        $sql = "SELECT dni, password FROM clientes_registrados WHERE email = :email";
        $resultado = $this->cn->prepare($sql);
        $resultado->execute([':email' => $email]);
        $user = $resultado->fetch(\PDO::FETCH_ASSOC);
    
        if ($user) {
            return $user;
        } else {
            return false; // Devuelve false si el usuario no es encontrado
        }
    }

    public function getIdByEmail($email) {
        $sql = "SELECT id FROM clientes_registrados WHERE email = :email";
        $resultado = $this->cn->prepare($sql);
        $resultado->execute([':email' => $email]);
        return $resultado->fetchColumn();
    }


}

