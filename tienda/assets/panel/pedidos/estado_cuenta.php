<?php
session_start();

if (!isset($_SESSION['usuario_info']) || empty($_SESSION['usuario_info'])) {
    header('Location: ../index.php');
    exit();
}

require '../../vendor/autoload.php';
$pedido = new tododeporte\Pedido;

$facturas_por_fecha = $pedido->mostrarFacturasOrdenadasPorFecha();
$facturas_por_cliente = $pedido->mostrarFacturasOrdenadasPorCliente();
$facturas_pendientes = $pedido->mostrarFacturasPendientes(); 


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Estado de Cuenta</title>
    <link rel="stylesheet" href="../../assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="../../assets/css/estilos.css">
</head>
<body>
    <nav class="navbar navbar-default navbar-fixed-top">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                    <span class="sr-only">Mundo sport</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="../dashboard.php">Mundo Sport</a>
            </div>
            <div id="navbar" class="navbar-collapse collapse">
                <ul class="nav navbar-nav pull-right">
                    <li><a href="index.php" class="btn">Pedidos</a></li>
                    <li><a href="../productos/index.php" class="btn">Productos</a></li>
                    <li><a href="estado_cuenta.php" class="btn">Estado de Cuenta</a></li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Salir<span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li><a href="../cerrar_session.php">Salir</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container" id="main">
        <div class="row">
            <div class="col-md-12">
                <fieldset>
                    <legend>Facturas por Fecha</legend>
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Fecha</th>
                                <th>Cliente</th>
                                <th>Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($facturas_por_fecha as $index => $factura): ?>
                                <tr>
                                    <td><?php echo $index + 1; ?></td>
                                    <td><?php echo htmlspecialchars($factura['fecha']); ?></td>
                                    <td><?php echo htmlspecialchars($factura['cliente']); ?></td>
                                    <td><?php echo htmlspecialchars($factura['total']); ?> </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </fieldset>

                <fieldset>
                    <legend>Facturas por Cliente</legend>
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Cliente</th>
                                <th>Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($facturas_por_cliente as $index => $factura): ?>
                                <tr>
                                    <td><?php echo $index + 1; ?></td>
                                    <td><?php echo htmlspecialchars($factura['cliente']); ?></td>
                                    <td><?php echo htmlspecialchars($factura['total']); ?> </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </fieldset>

                <fieldset>
                    <legend>Facturas a Cobrar</legend>
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Fecha</th>
                                <th>Cliente</th>
                                <th>Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($facturas_pendientes as $index => $factura): ?>
                                <tr>
                                    <td><?php echo $index + 1; ?></td>
                                    <td><?php echo htmlspecialchars($factura['fecha']); ?></td>
                                    <td><?php echo htmlspecialchars($factura['cliente_']); ?></td> <!-- Asegúrate de usar el campo correcto -->
                                    <td><?php echo htmlspecialchars($factura['total']); ?> </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </fieldset>
            </div>
        </div>
    </div>

    <script src="../../assets/js/jquery.min.js"></script>
    <script src="../../assets/js/bootstrap.min.js"></script>
</body>
</html>
