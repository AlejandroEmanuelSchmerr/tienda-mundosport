<?php

namespace tododeporte;

class Producto{

    private $config;
    private $cn = null;

    public function __construct(){

        $this->config = parse_ini_file(__DIR__.'/../config.ini') ;

        $this->cn = new \PDO( $this->config['dns'], $this->config['usuario'],$this->config['clave'],array(
            \PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'
        ));
        
    }

public function obtenerUltimoId() {
    $sql = "SELECT LAST_INSERT_ID()";
    $resultado = $this->cn->query($sql);
    return $resultado->fetchColumn();
}

    public function registrar($_params){
        $sql = "INSERT INTO `productos`(`nombre`, `descripcion`, `precio`, `talle`, `stock`, `categoria_id`,`fecha`, `estado`, `foto`) 
        VALUES (:nombre,:descripcion,:precio,:talle,:stock,:categoria_id,:fecha,:estado,:foto)";

        $resultado = $this->cn->prepare($sql);

        $_array = array(
            ":nombre" => $_params['nombre'],
            ":descripcion" => $_params['descripcion'],
            ":precio" => $_params['precio'],
            ":talle" => $_params['talle'],
            ":stock" => $_params['stock'],
            ":categoria_id" => $_params['categoria_id'],
            ":fecha" => $_params['fecha'],
            ":estado" => $_params['estado'],
            ":foto" => $_params['foto'],
        );

        if($resultado->execute($_array))
            return true;

        return false;
    }

    public function actualizar($_params){
        $sql = "UPDATE `productos` SET `nombre`=:nombre,`descripcion`=:descripcion,`precio`=:precio,`talle`=:talle,`stock`=:stock,`categoria_id`=:categoria_id,`fecha`=:fecha,`estado`=:estado,`foto`=:foto  WHERE `id`=:id";

        $resultado = $this->cn->prepare($sql);

        $_array = array(
            ":nombre" => $_params['nombre'],
            ":descripcion" => $_params['descripcion'],
            ":precio" => $_params['precio'],
            ":talle" => $_params['talle'],
            ":stock" => $_params['stock'],
            ":categoria_id" => $_params['categoria_id'],
            ":fecha" => $_params['fecha'],
            ":estado" => $_params['estado'],
            ":foto" => $_params['foto'],
            ":id" =>  $_params['id']
        );

        if($resultado->execute($_array))
            return true;

        return false;
    }

    public function eliminar($id){
        $sql = "DELETE FROM `productos` WHERE `id`=:id ";

        $resultado = $this->cn->prepare($sql);
        
        $_array = array(
            ":id" =>  $id
        );

        if($resultado->execute($_array))
            return true;

        return false;
    }
    public function mostrar(){
        
        
        $sql = "SELECT 
                    productos.id, 
                    productos.nombre AS nombre_producto, 
                    productos.descripcion, 
                    productos.precio, 
                    productos.talle, 
                    productos.stock, 
                    productos.categoria_id, 
                    productos.fecha, 
                    productos.estado, 
                    productos.foto, 
                    categorias.nombre AS nombre_categoria 
                FROM 
                    productos 
                INNER JOIN 
                    categorias 
                ON 
                    productos.categoria_id = categorias.id 
                ORDER BY 
                    productos.id ASC";
        
        $resultado = $this->cn->prepare($sql);
    
        if($resultado->execute())
            return $resultado->fetchAll();
    
        return false;
    }
    function actualizarProducto($id) {
        // Asumiendo que $_SESSION['carrito'] tiene el formato correcto
        if (isset($_SESSION['carrito'][$id])) {
            $_SESSION['carrito'][$id]['cantidad'] = $_POST['cantidad'];
        }
    }
    
    function agregarProducto($resultado, $id) {
        $_SESSION['carrito'][$id] = array(
            'id' => $id,
            'nombre' => $resultado['nombre'],
            'precio' => $resultado['precio'],
            'cantidad' => 1, // O la cantidad predeterminada
            'foto' => $resultado['foto']
        );
    }

    public function mostrarPorId($id){
        
        $sql = "SELECT * FROM `productos` WHERE `id`=:id ";
        
        $resultado = $this->cn->prepare($sql);
        $_array = array(
            ":id" =>  $id
        );

        if($resultado->execute($_array))
            return $resultado->fetch();

        return false;
    }

    public function buscarProductos($query) {
        $sql = "SELECT * FROM productos WHERE nombre LIKE :query OR descripcion LIKE :query";
        $stmt = $this->cn->prepare($sql);
        $stmt->execute(['query' => '%' . $query . '%']);
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }


    public function mostrarDetallesPorId($id) {
        $sql = "SELECT 
                    productos.id, 
                    productos.nombre, 
                    productos.descripcion, 
                    productos.precio, 
                    productos.talle, 
                    productos.stock, 
                    productos.categoria_id, 
                    productos.fecha, 
                    productos.estado, 
                    productos.foto, 
                    categorias.nombre AS nombre_categoria 
                FROM 
                    productos 
                INNER JOIN 
                    categorias 
                ON 
                    productos.categoria_id = categorias.id 
                WHERE 
                    productos.id = :id";
        
        $resultado = $this->cn->prepare($sql);
        $_array = array(
            ":id" => $id
        );
    
        if ($resultado->execute($_array)) {
            return $resultado->fetch();
        }
    
        return false;
    }
    function detalles_producto_seleccionado($con, $idProd)
    {
        // Prepara la consulta SQL
        $sqlDetalleProducto = "
            SELECT 
                p.id AS prodId,
                p.nameProd,
                p.description_Prod,
                p.precio,
                p.talle,
                p.stock,
                p.categoria_id,
                p.fecha,
                p.estado,
                f.foto1,
                f.foto2,
                f.foto3
            FROM 
                products AS p
            INNER JOIN
                fotoproducts AS f
            ON 
                p.id = f.products_id
            WHERE
                p.id = ?
            LIMIT 1;
        ";
    
     


    
}
function subirFoto() {
    $carpeta = __DIR__ . '/../upload/';
    
    // Verifica si el archivo fue enviado y no tiene errores
    if (isset($_FILES['foto']) && $_FILES['foto']['error'] === UPLOAD_ERR_OK) {
        $nombreArchivo = basename($_FILES['foto']['name']);
        $archivoDestino = $carpeta . $nombreArchivo;

        // Verifica que el archivo no exista en el destino
        if (file_exists($archivoDestino)) {
            return null; // Puedes manejar este caso si es necesario
        }

        // Mueve el archivo al directorio de destino
        if (move_uploaded_file($_FILES['foto']['tmp_name'], $archivoDestino)) {
            return $nombreArchivo; // Retorna el nombre del archivo si la carga fue exitosa
        } else {
            return null; // Retorna null si hubo un error al mover el archivo
        }
    }

    return null; // Retorna null si no se ha enviado ningún archivo o hubo un error
}

    
}


