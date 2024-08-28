<?php

namespace tododeporte;

class Pago {
    public function procesarCobro($total, $cliente_dni) {
        $response = $this->simularCobroAPI($total);

        if ($response['status'] == 'success') {
            return true;
        } else {
            return false;
        }
    }

    private function simularCobroAPI($total) {
        return [
            'status' => 'success',
            'transaction_id' => uniqid(),
        ];
    }
}
