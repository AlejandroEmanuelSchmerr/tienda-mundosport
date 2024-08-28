


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio</title>
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="icon" type="image/x-icon" href="../assets/images/logo.png">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Jost:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    </head>
<body>
<style>
        .products {
            display: flex;
            flex-direction: column;
            gap: 20px;
        }
        .product-row {
            display: flex;
            justify-content: space-between;
        }
        .product-item {
            width: 30%;
            text-align: left;
        }
        .image-container img {
            width: 100%;
            height: auto;
        }
        .product-row img {
            width: 100%;
            height: auto;
        }
        .product-row img:hover{
            transform: scale(1.1) !important;
        }
        .ratting{
            line-height: 30px;
            font-size: 20px;
            font-weight: 600;
        }
        
    
    </style>

    <header id="header">
        <a href="efecto.html" class="logo"><img src="../assets/images/logo.png" alt="Logo"></a>
        <ul class="navmenu">
            <li><a href="index.php">Inicio</a></li>
        
            <li><a href="productos.php">Productos</a></li>
            <li><a href="acerca.html">Acerca de</a></li>
            
        </ul>
    </header>
	
<script src="../assets/js/java.js"></script>

    <section class="main-home">
        <div class="main-text">
            <h5>Colección de invierno</h5>
            <h1>Nuevos<br> lanzamientos</h1>
            <p>El deporte nos une</p>
            <a href="productos.php" class="main-btn">Comprar Ahora <i class='bx bx-right-arrow-alt'></i></a>
        </div>
        <div class="down-arrow">
            <a href="#trending" class="down"><i class='bx bx-down-arrow-alt'></i></a>
        </div>
    </section>

    <section class="trending-product" id="trending">
        <br>
        <div class="center-text">
            <h2>Nuestros <span>Productos</span></h2>
        </div>
        <br>
        <br>
        <div class="product-row">
                <div class="product-item">
                    <div class="image-container">
                        <img src="upload/zapa1.1.png" alt="Zapatilla 1">
                        <div class="product-text">
                            <br>
                            <h5>Sale</h5>
                        </div>
                        <div class="heart-icon">
                            <i class='bx bx-heart'></i>
                        </div>
                    </div>
                    <div class="ratting">
                        <i class='bx bxs-star'></i>
                        <i class='bx bxs-star'></i>
                        <i class='bx bxs-star'></i>
                        <i class='bx bx-star'></i>
                        <i class='bx bx-star'></i>   
                        <div class="price">
                            <a href="productos.php" class="link">Zapatilla Munchen 24<p>$1 USD</p></a>   
                            
                        </div>           
                    </div>
                </div>
                <div class="product-item">
                    <div class="image-container">
                        <img src="upload/zapa2.1.png" alt="Zapatilla 2">
                        <div class="product-text">
                            <br>

                        </div>
                        <div class="heart-icon">
                            <i class='bx bx-heart'></i>
                        </div>
                    </div>
                    <div class="ratting">
                        <i class='bx bxs-star'></i>
                        <i class='bx bxs-star'></i>
                        <i class='bx bxs-star'></i>
                        <i class='bx bxs-star'></i>
                        <i class='bx bxs-star'></i>   
                        <div class="price"><a href="productos.php" class="link"><h4>Zapatillas X_PLR Path</h4>
                        <p>$2 USD</p> </a>
                        </div>           
                    </div>
                </div>
                <div class="product-item">
                    <div class="image-container">
                        <img src="upload/zapa3.2.avif" alt="zapatilla3">
                        <div class="product-text">
                            <br>
                            <h5>Hot</h5>
                        </div>
                        <div class="heart-icon">
                            <i class='bx bx-heart'></i>
                        </div>
                    </div>
                    <div class="ratting">
                        <i class='bx bxs-star'></i>
                        <i class='bx bxs-star'></i>
                        <i class='bx bxs-star'></i>
                        <i class='bx bx-star'></i>
                        <i class='bx bx-star'></i>   
                        <div class="price">
                        <a href="productos.php" class="link"><h4>Zapatillas Everyset</h4>
                        <p>$3 USD</p></a>
                            
                        </div>           
                    </div>
                </div>
            </div>
            <br>
            <br>
            <br>
            <!-- Primera fila de conjuntos -->
            <div class="product-row">
                <div class="product-item">
                    <div class="image-container">
                        <img src="upload/conjunto1.1.avif" alt="Conjunto 1">
                        <div class="product-text">
                            <br>
                            <h5>Sale</h5>
                        </div>
                        <div class="heart-icon">
                            <i class='bx bx-heart'></i>
                        </div>
                    </div>
                    <div class="ratting">
                        <i class='bx bxs-star'></i>
                        <i class='bx bxs-star'></i>
                        <i class='bx bxs-star'></i>
                        <i class='bx bx-star'></i>
                        <i class='bx bx-star-half'></i>
                        <i class='bx bx-star' ></i>                           
                        <div class="price">
                        <a href="productos.php" class="link"><h4>Conjunto Linear Logo Tricot</h4>
                        <p>$4 USD</p></a>
                            
                        </div>           
                    </div>
                </div>
                <div class="product-item">
                    <div class="image-container">
                        <img src="upload/conjunto2.1.avif" alt="Conjunto 2">
                        <div class="product-text">
                            <br>

                        </div>
                        <div class="heart-icon">
                            <i class='bx bx-heart'></i>
                        </div>
                    </div>
                    <div class="ratting">
                    
                        <i class='bx bxs-star'></i>
                        <i class='bx bxs-star'></i>
                        <i class='bx bxs-star'></i> 
                        <i class='bx bxs-star'></i>
                        <i class='bx bxs-star'></i>   
                        <div class="price">
                        <a href="productos.php" class="link"><h4>Conjunto Ajustado con Cierre</h4>
                        <p>$3 USD</p></a>
                        </div>           
                    </div>
                </div>
                <div class="product-item">
                    <div class="image-container">
                        <img src="upload/conjunto3.1.avif" alt="Conjunto 3">
                        <div class="product-text">
                            <br>
                            <h5>Hot</h5>
                        </div>
                        <div class="heart-icon">
                            <i class='bx bx-heart'></i>
                        </div>
                    </div>
                    <div class="ratting">
                        <i class='bx bxs-star'></i>
                        <i class='bx bxs-star'></i>
                        <i class='bx bxs-star'></i>
                        <i class='bx bx-star'></i>
                        <i class='bx bx-star'></i>   
                        <div class="price">
                        <a href="productos.php" class="link"><h4>Conjunto Adidas liso</h4>
                        <p>$2 USD</p></a>
                            
                        </div>           
                    </div>
                </div>
            </div>
            <br>
            <br>
            <br>
            <br>
            <br>
            <br>
            <!-- Segunda fila de conjuntos -->
            <div class="product-row">
                <div class="product-item">
                    <div class="image-container">
                        <img src="upload/camiseta1.1.avif" alt="Conjunto 1">
                        <div class="product-text">
                            <br>
                            <h5>Hot</h5>
                        </div>
                        <div class="heart-icon">
                            <i class='bx bx-heart'></i>
                        </div>
                    </div>
                    <div class="ratting">
                        <i class='bx bxs-star'></i>
                        <i class='bx bxs-star'></i>
                        <i class='bx bxs-star'></i>
                        <i class='bx bx-star'></i>
                        <i class='bx bx-star'></i>   
                        <div class="price">
                        <a href="productos.php" class="link"><h4>Camiseta Argentina Messi tr jsy</h4>
                        <p>$4 USD</p></a>
                            
                        </div>           
                    </div>
                </div>
                <div class="product-item">
                    <div class="image-container">
                        <img src="upload/camiseta3.1.webp" alt="Conjunto 2">
                        <div class="product-text">
                            <br>
                            <h5>Hot</h5>
                        </div>
                        <div class="heart-icon">
                            <i class='bx bx-heart'></i>
                        </div>
                    </div>
                    <div class="ratting">
                        <i class='bx bxs-star'></i>
                        <i class='bx bxs-star'></i>
                        <i class='bx bxs-star'></i>
                        <i class='bx bx-star'></i>
                        <i class='bx bx-star'></i>   
                        <div class="price">
                        <a href="productos.php" class="link"><h4>FC Barcelona complementario 2023/24 </h4>
                        <p>$3 USD</p></a>
                            
                        </div>           
                    </div>
                </div>
                <div class="product-item">
                    <div class="image-container">
                        <img src="upload/camiseta2.2.avif" alt="Conjunto 3">
                        <div class="product-text">
                            <br>
                        </div>
                        <div class="heart-icon">
                            <i class='bx bx-heart'></i>
                        </div>
                    </div>
                    <div class="ratting">
                        <i class='bx bxs-star'></i>
                        <i class='bx bxs-star'></i>
                        <i class='bx bxs-star'></i>
                        <i class='bx bxs-star'></i>
                        <i class='bx bxs-star'></i>   
                        <div class="price">
                        <a href="productos.php" class="link"><h4>Camiseta Tercer Uniforme Messi Inter Miami CF 24</h4>
                        <p>$2 USD</p></a>
                            
                        </div>           
                    </div>
                </div>
            </div>
        </div>
        <br>
        <br>
        <br>
        <br>
        <br>
        <div class="down-arrow2">
        <a href="index.php" class="down"><i class='bx bx-up-arrow-alt' ></i></i></a>
        </div>

        <div class="productos">
            <p><a href="productos.php">Ver mas productos</a></p>
        </div>
        
        
    </section>

     <?php include('includes/footer.html'); ?>
    </div>
    <?php include('includes/js.html'); ?>
</body>
</html>
