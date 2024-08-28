function solicitarArrepentimiento() {
    // Obtener el ID del pedido actual
    const pedidoId = prompt("Por favor, ingrese el ID de su pedido para proceder con el arrepentimiento:");

    if (pedidoId) {
        // Enviar solicitud al servidor para anular el pedido
        fetch('arrepentimiento.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify({ pedidoId: pedidoId })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                alert("El pedido ha sido anulado correctamente.");
                // Actualizar la interfaz o redirigir al usuario si es necesario
            } else {
                alert("Hubo un problema al anular el pedido.");
            }
        })
        .catch((error) => {
            console.error('Error:', error);
        });
    }
}
