<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link rel="stylesheet" type="text/css" href="assets/css/bootstrap4/bootstrap.min.css">
    <link rel="icon" type="image/x-icon" href="../assets/images/logo.png">
    <link rel="stylesheet" type="text/css" href="assets/css/main_styles.css">
    <link rel="stylesheet" type="text/css" href="assets/css/responsive.css">
    <link rel="stylesheet" href="assets/css/loader.css">
    <title>Productos</title>
</head>
<body>
    <?php
        session_start();
        require 'funciones.php';
        include('header.php');
    ?>

    <div class="main-home1">
        <div class="container mt-5 pt-5">
            <div class="row align-items-center">
                <div class="col-lg-12 text-center"></div>
                <div class="down-arrow">
                    <a href="#prod" class="down2"><i class='bx bx-down-arrow-alt'></i></a>
                </div>
            </div>
            <br><br><br><br><br><br><br>
            <br><br>
            
            <section id="prod">
                <div class="titulo">
                    <div class="col-lg-12 text-center mt-5">
                        <div class="section_title">
                            <h2>Nuestros <span>Productos</span></h2>
                        </div>
                    </div>
                </div>
                <a href="lista_productos.php">Lista de productos</a>
                <div class="row align-items-center">
                    <?php
                        require 'vendor/autoload.php';
                        $producto = new tododeporte\Producto;
                        $info_producto = $producto->mostrar(); // Obtener productos
                        
                        // Ordenar los productos por ID ascendentemente
                        usort($info_producto, function($a, $b) {
                            return $a['id'] <=> $b['id'];
                        });

                        $cantidad = count($info_producto);
                        
                        if($cantidad > 0) {
                            for($x = 0; $x < $cantidad; $x++) {
                                $item = $info_producto[$x];
                                $isEven = $item["id"] % 2 == 0;
                    ?>
                        <div class="col-6 col-md-3 mt-5 text-center Products">
                            <div class="card" style="max-height: 400px !important; min-height: 400px !important;">
                                <?php
                                    $foto = 'upload/'.$item['foto'];
                                    if(file_exists($foto)) {
                                ?>
                                    <div>
                                        <img class="card-img-top" src="<?php print $foto; ?>" class="img-responsive">
                                    </div>
                                <?php } else { ?>
                                    <img src="assets/imagenes/not-found.jpg" class="img-responsive">
                                <?php } ?>
                                
                                <div class="card-body text-center">
                                    <h5 class="card-title card_title"><?php print $item['nombre_producto'] ?></h5>
                                    <br>
                                    <?php
                                        for ($i = 1; $i <= 5; $i++) {
                                            echo '<span><i class="bi bi-star-fill" style="padding: 0px 2px; color:' . ($isEven ? '#ffb90c' : ($i <= 3 ? '#ffb90c' : '')) . ';"></i></span>';
                                        }
                                    ?>
                                    <hr>
                                    <p class="card-text p_puntos">$<?php print $item['precio'] ?> USD</p>
                                </div>
                                
                                <a href="detallesArticulo.php?id=<?php print $item['id'] ?>" class="red_button btn_puntos">
                                    ver producto
                                    <i class="bi bi-arrow-right-circle"></i>
                                </a>
                            </div>
                        </div>
                    <?php
                            }
                        } else {
                    ?>
                        <h4>NO HAY REGISTROS</h4>
                    <?php } ?>
                </div>
            </section>
        </div>

        <?php include('includes/footer.html'); ?>
    </div>
    
    <?php include('includes/js.html'); ?>
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
</body>
</html>
