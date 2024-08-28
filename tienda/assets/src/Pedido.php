<?php

namespace tododeporte;

class Pedido
{
    private $config;
    private $cn = null;

    public function __construct()
    {
        $this->config = parse_ini_file(__DIR__ . '/../config.ini');

        $this->cn = new \PDO(
            $this->config['dns'],
            $this->config['usuario'],
            $this->config['clave'],
            array(
                \PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'
            )
        );
    }
    public function getConnection() {
        return $this->cn;
    }
    public function getLastError() {
        return $this->cn->errorInfo()[2];
    }
    
    // Método para registrar un nuevo pedido
    public function registrar($_params)
{
    $sql = "INSERT INTO `pedidos`(`cliente_dni`, `total`, `fecha`, `estado`) 
            VALUES (:cliente_dni, :total, :fecha, :estado)";

    $resultado = $this->cn->prepare($sql);

    $_array = array(
        ":cliente_dni" => $_params['cliente_dni'], // Cambiado a cliente_dni
        ":total" => $_params['total'],
        ":fecha" => $_params['fecha'],
        ":estado" => $_params['estado'] // Cambiado a $_params['estado']
    );

    if ($resultado->execute($_array)) {
        return $this->cn->lastInsertId(); // Devuelve el ID del último pedido insertado
    }

    return false;
}
public function actualizarEstadoPorTransaccion($transactionId, $estado) {
    // Asume que tienes una tabla "ventas" con transaction_id y pedido_id relacionados
    $sql = "UPDATE pedidos p
            JOIN ventas v ON p.id = v.pedido_id
            SET p.estado = :estado
            WHERE v.transaction_id = :transaction_id";
    $stmt = $this->cn->prepare($sql);
    $stmt->execute([
        ':estado' => $estado,
        ':transaction_id' => $transactionId
    ]);

    return $this->cn->lastInsertId(); // Devuelve el ID del pedido
}

    // Método para registrar un detalle de pedido
    public function registrarDetalle($_params)
    {
        $sql = "INSERT INTO `detalles_pedidos`(`pedido_id`, `producto_id`, `precio`, `cantidad`) 
                VALUES (:pedido_id, :producto_id, :precio, :cantidad)";

        $resultado = $this->cn->prepare($sql);

        $_array = array(
            ":pedido_id" => $_params['pedido_id'],
            ":producto_id" => $_params['producto_id'],
            ":precio" => $_params['precio'],
            ":cantidad" => $_params['cantidad']
        );

        if ($resultado->execute($_array)) {
            return true;
        }

        return false;
    }

    // Método para mostrar todos los pedidos

public function mostrar()
{
    $sql = "SELECT p.id, c.nombre, c.apellidos, c.email, p.total, p.fecha, p.estado 
            FROM pedidos p 
            INNER JOIN clientes_registrados c ON p.cliente_dni = c.dni 
            ORDER BY p.id DESC";

    $resultado = $this->cn->prepare($sql);

    if ($resultado->execute()) {
        return $resultado->fetchAll(); // Devuelve todos los pedidos
    }

    return false;
}

    // Método para mostrar un pedido por su ID


    // Método para mostrar los detalles de un pedido por su ID de pedido
    public function mostrarDetallePorIdPedido($pedido_id)
    {
        $sql = "SELECT dp.id, pr.nombre, dp.precio, dp.cantidad, pr.foto, p.estado
                FROM detalles_pedidos dp
                INNER JOIN productos pr ON pr.id = dp.producto_id
                INNER JOIN pedidos p ON p.id = dp.pedido_id
                WHERE dp.pedido_id = :pedido_id";
    
        $resultado = $this->cn->prepare($sql);
    
        $_array = array(':pedido_id' => $pedido_id);
    
        if ($resultado->execute($_array)) {
            return $resultado->fetchAll(\PDO::FETCH_ASSOC);
        }
    
        return false;
    }

public function mostrarPedidosPorClienteId($cliente_dni)
{
    $sql = "SELECT p.id, c.nombre, c.apellidos, p.total, p.fecha 
            FROM pedidos p 
            INNER JOIN clientes_registrados c ON p.cliente_dni = c.dni 
            WHERE p.cliente_dni = :cliente_dni 
            ORDER BY p.id DESC";

    $resultado = $this->cn->prepare($sql);

    $_array = array(':cliente_dni' => $cliente_dni);

    if ($resultado->execute($_array)) {
        return $resultado->fetchAll();
    }

    return false;
}
public function actualizarCantidad($detalle_id, $nueva_cantidad)
{
    // Asegúrate de que la nueva cantidad sea un valor válido (número positivo)
    $nueva_cantidad = (int)$nueva_cantidad;
    if ($nueva_cantidad < 1) {
        return false; // Retorna false si la cantidad es inválida
    }

    // Actualizar la cantidad del detalle del pedido en la base de datos
    $sql = "UPDATE detalles_pedidos SET cantidad = :cantidad WHERE id = :detalle_id";
    $stmt = $this->cn->prepare($sql);

    // Ejecutar la consulta
    $resultado = $stmt->execute([
        ':cantidad' => $nueva_cantidad,
        ':detalle_id' => $detalle_id,
    ]);

    return $resultado;
}

public function mostrarFacturasOrdenadasPorFecha() {
    $sql = "SELECT p.fecha, c.nombre AS cliente, SUM(p.total) AS total 
            FROM pedidos p 
            INNER JOIN clientes_registrados c ON p.cliente_dni = c.dni 
            GROUP BY p.fecha, c.nombre 
            ORDER BY p.fecha";
    $stmt = $this->cn->query($sql);
    return $stmt->fetchAll(\PDO::FETCH_ASSOC);
}
public function mostrarFacturasPendientes() {
    $sql = "SELECT p.fecha, c.nombre AS cliente_, SUM(p.total) AS total 
            FROM pedidos p 
            INNER JOIN clientes_registrados c ON p.cliente_dni = c.dni 
            WHERE p.estado = 'Pendiente'
            GROUP BY p.fecha, c.nombre 
            ORDER BY p.fecha";
    $stmt = $this->cn->query($sql);
    return $stmt->fetchAll(\PDO::FETCH_ASSOC);
}
public function mostrarPorId($id) {
    $sql = "SELECT p.*, c.nombre, c.apellidos, c.email
            FROM pedidos p
            INNER JOIN clientes_registrados c ON p.cliente_dni = c.dni
            WHERE p.id = :id";
    
    $stmt = $this->cn->prepare($sql);
    $stmt->execute(['id' => $id]);
    return $stmt->fetch();
}








// Calcular el total a cobrar


// Registrar información en la tabla de ventas
public function registrarVenta($id_pedido, $cliente_dni, $total, $metodo_pago, $estado_pago) {
    $sql = "INSERT INTO ventas (id_pedido, fecha, cliente_dni, total, metodo_pago, estado_pago)
            VALUES (:id_pedido, CURDATE(), :cliente_dni, :total, :metodo_pago, :estado_pago)";
    $stmt = $this->cn->prepare($sql);
    $stmt->bindParam(':id_pedido', $id_pedido);
    $stmt->bindParam(':cliente_dni', $cliente_dni);
    $stmt->bindParam(':total', $total);
    $stmt->bindParam(':metodo_pago', $metodo_pago);
    $stmt->bindParam(':estado_pago', $estado_pago);
    $stmt->execute();
}



public function mostrarFacturasOrdenadasPorCliente() {
    $sql = "SELECT c.nombre AS cliente, SUM(p.total) AS total 
            FROM pedidos p 
            INNER JOIN clientes_registrados c ON p.cliente_dni = c.dni 
            GROUP BY c.nombre 
            ORDER BY c.nombre";
    $stmt = $this->cn->query($sql);
    return $stmt->fetchAll(\PDO::FETCH_ASSOC);
}



public function entregar($id) {
    echo "Ejecutando método entregar para el ID: $id";
    $sql = "UPDATE pedidos SET estado = 'Entregado' WHERE id = :id";
    $stmt = $this->cn->prepare($sql);
    if ($stmt->execute([':id' => $id])) {
        echo "Pedido actualizado correctamente";
        return true;
    } else {
        $error = $stmt->errorInfo();
        echo "Error en entregar: " . $error[2];
        return false;
    }
}

public function anular($id) {
    $sql = "UPDATE pedidos SET estado = 'Anulado' WHERE id = :id";
    $stmt = $this->cn->prepare($sql);
    if ($stmt->execute([':id' => $id])) {
        return true;
    } else {
        $error = $stmt->errorInfo();
        echo "Error en anular: " . $error[2];
        return false;
    }
}

public function actualizarEstado($id, $estado) {
    try {
        $stmt = $this->cn->prepare("UPDATE pedidos SET estado = :estado WHERE id = :id");
        $stmt->bindParam(':estado', $estado);
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    } catch (\PDOException $e) {
        // Manejo de errores
        echo "Error: " . $e->getMessage();
        return false;
    }
}

public function eliminar($id) {
    try {
        // Primero, eliminar los detalles del pedido
        $stmt_detalles = $this->cn->prepare("DELETE FROM detalles_pedidos WHERE pedido_id = :id");
        $stmt_detalles->bindParam(':id', $id);
        $stmt_detalles->execute();

        // Finalmente, eliminar el pedido
        $stmt_pedido = $this->cn->prepare("DELETE FROM pedidos WHERE id = :id");
        $stmt_pedido->bindParam(':id', $id);
        if ($stmt_pedido->execute()) {
            return true;
        } else {
            throw new \Exception("No se pudo eliminar el pedido.");
        }
    } catch (\PDOException $e) {
        return "Error en la eliminación: " . $e->getMessage();
    }
}



    
public function moverAPedidosHistoricos($pedido_id) {
    try {
        // Obtener los datos del pedido actual
        $stmt = $this->cn->prepare("SELECT * FROM pedidos WHERE id = :pedido_id");
        $stmt->execute(['pedido_id' => $pedido_id]);
        $pedido = $stmt->fetch();

        if ($pedido) {
            // Insertar en la tabla pedidos_historicos
            $stmt_historico = $this->cn->prepare("
                INSERT INTO pedidos_historicos (id, fecha, cliente_dni, total, estado, fecha_entrega, detalles)
                VALUES (:id, :fecha, :cliente_dni, :total, 'Entregado', NOW(), :detalles)
            ");
            $stmt_historico->execute([
                'id' => $pedido['id'],
                'fecha' => $pedido['fecha'],
                'cliente_dni' => $pedido['cliente_dni'],
                'total' => $pedido['total'],
                'detalles' => $pedido['detalles'] ?? '' // Usa un valor por defecto si 'detalles' no está presente
            ]);

            // Eliminar el pedido de la tabla pedidos
            $stmt_eliminar = $this->cn->prepare("DELETE FROM pedidos WHERE id = :pedido_id");
            $stmt_eliminar->execute(['pedido_id' => $pedido_id]);

            // Verificar si la eliminación fue exitosa
            if ($stmt_eliminar->rowCount() > 0) {
                return true;
            } else {
                echo "El pedido no se eliminó.";
                return false;
            }
        } else {
            echo "El pedido no se encontró.";
        }
        return false;
    } catch (\PDOException $e) {
        // Manejo de errores
        echo "Error: " . $e->getMessage();
        return false;
    }
}
public function cambiarEstado($pedido_id, $nuevo_estado) {
    $sql = "UPDATE pedidos SET estado = :estado WHERE id = :id";
    $stmt = $this->cn->prepare($sql);
    $stmt->bindParam(':estado', $nuevo_estado);
    $stmt->bindParam(':id', $pedido_id, \PDO::PARAM_INT);
    
    return $stmt->execute();
}





public function entregarPedido($id) {
    // Cambiar el estado del pedido a 'Entregado'
    if ($this->entregar($id)) {
        // Mover el pedido a la tabla histórica
        if ($this->moverAPedidosHistoricos($id)) {
            // No eliminaré las ventas, ya que ahora están relacionadas con `pedidos_historicos`
            return true;
        } else {
            echo "Error al mover el pedido a la tabla histórica.";
        }
    } else {
        echo "Error al cambiar el estado del pedido a 'Entregado'.";
    }
    return false;
}
    public function mostrarPedidosPorClienteDni($dni)
    {
        $sql = "SELECT * FROM pedidos WHERE cliente_dni = :dni";
        $stmt = $this->cn->prepare($sql);
        $stmt->bindParam(':dni', $dni, \PDO::PARAM_STR);
        $stmt->execute();
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

}
