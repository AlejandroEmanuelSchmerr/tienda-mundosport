<?php
session_start();
require 'funciones.php';
require 'vendor/autoload.php';

// Verifica si se envió una consulta de búsqueda
$query = '';
$resultados = [];

if (isset($_GET['query'])) {
    $query = trim($_GET['query']);

    // Instancia de la clase Producto
    $producto = new tododeporte\Producto;

    // Realiza la búsqueda de productos por nombre o descripción
    $resultados = $producto->buscarProductos($query);
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/x-icon" href="../assets/images/logo.png">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link rel="stylesheet" type="text/css" href="assets/css/bootstrap4/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="assets/css/main_styles.css">
    <link rel="stylesheet" type="text/css" href="assets/css/responsive.css">
    <title>Resultados de Búsqueda</title>
</head>

<body>
    <?php include('header.php'); ?>

        <div class="container mt-5 pt-5">
            <div class="titulo">
                <div class="col-lg-12 text-center mt-5">
                    <div class="section_title">
                        <h2>Resultados de la búsqueda: <span>"<?php echo htmlspecialchars($query); ?>"</span></h2>
                    </div>
                </div>
            </div>

            <section id="prod">
                <div class="row align-items-center">
                    <?php if (count($resultados) > 0): ?>
                        <?php foreach ($resultados as $item): ?>
                            <div class="col-6 col-md-3 mt-5 text-center Products">
                                <div class="card" style="max-height: 400px !important; min-height: 400px !important;">
                                    <?php
                                        $foto = 'upload/'.$item['foto'];
                                        if (file_exists($foto)) {
                                    ?>
                                        <div>
                                            <img class="card-img-top" src="<?php echo htmlspecialchars($foto); ?>" class="img-responsive">
                                        </div>
                                    <?php } else { ?>
                                        <img src="assets/imagenes/not-found.jpg" class="img-responsive">
                                    <?php } ?>
                                    <div class="card-body text-center">
                                        <h5 class="card-title card_title"><?php echo htmlspecialchars($item['nombre']); ?></h5>
                                        <br>
                                        <?php
                                            $isEven = $item["id"] % 2 == 0;
                                            for ($i = 1; $i <= 5; $i++) {
                                                echo '<span><i class="bi bi-star-fill" style="padding: 0px 2px; color:' . ($isEven ? '#ffb90c' : ($i <= 3 ? '#ffb90c' : '')) . ';"></i></span>';
                                            }
                                        ?>
                                        <hr>
                                        <p class="card-text p_puntos ">$<?php echo number_format($item['precio'], 2); ?></p>
                                    </div>
                                    <a href="detallesArticulo.php?id=<?php echo $item['id']; ?>" class="red_button btn_puntos">
                                        Ver producto <i class="bi bi-arrow-right-circle"></i>
                                    </a>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <div class="col-12">
                            <h4>No se encontraron productos que coincidan con tu búsqueda.</h4>
                        </div>
                    <?php endif; ?>
                </div>
            </section>
        </div>
    

    <?php include('includes/footer.html'); ?>
    <?php include('includes/js.html'); ?>
</body>
</html>
