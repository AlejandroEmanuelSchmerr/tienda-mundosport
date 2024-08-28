<?php


namespace tododeporte;

class Venta {
    private $cn;

    public function __construct($cn) {
        $this->cn = $cn;
    }
        public function registrar($data) {
            $sql = "INSERT INTO ventas (pedido_id, metodo_pago, transaction_id) VALUES (:pedido_id, :metodo_pago, :transaction_id)";
            $stmt = $this->cn->prepare($sql);
            $stmt->execute([
                ':pedido_id' => $data['pedido_id'],
                ':metodo_pago' => $data['metodo_pago'],
                ':transaction_id' => $data['transaction_id']
            ]);
        }
    public function registrarVenta($pedido_historico_id, $cliente_dni, $total) {
        $stmt = $this->cn->prepare("
            INSERT INTO ventas (pedido_historico_id, cliente_dni, monto, fecha, metodo_pago, estado_pago)
            VALUES (:pedido_historico_id, :cliente_dni, :total, NOW(), 'Tarjeta de crédito', 'Pagado')
        ");
        $stmt->execute([
            'pedido_historico_id' => $pedido_historico_id,
            'cliente_dni' => $cliente_dni,
            'total' => $total
        ]);
    }
}

