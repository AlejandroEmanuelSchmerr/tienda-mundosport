<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mundo Sport</title>
    <link rel="icon" type="image/x-icon" href="assets/images/logo.png">
    <link rel="stylesheet" href="assets/css/style.css"> <!-- Corregí el nombre del archivo CSS -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Jost:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
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
</head>
<body>
    <header id="header">
        <a href="efecto.html" class="logo"><img src="../assets/images/logo.png" alt="Logo"></a>
        <ul class="navmenu">
            <li><a href="index.php">Inicio</a></li>
        
            <li><a href="productos.php">Productos</a></li>
            <li><a href="acerca.html">Acerca de</a></li>
            <li><a href="pedidos.php">Pedidos</a></li>
            
        </ul>
        <div class="nav-icon">
        <form action="search.php" method="get" class="form-inline my-2 my-lg-0" style="display: flex; align-items: center;">
    <input class="form-control mr-sm-2" type="search" name="query" placeholder="Buscar productos" aria-label="Buscar" style="padding: 10px 15px; height: 40px;">
    <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Buscar</button>
</form>

            
<a href="carrito.php" class="btn"><span class="badge"><?php print cantidadProducto(); ?></span><i class='bx bx-cart'></i></a>
            
        </div>
    </header>
	
<script src="../assets/js/java.js"></script>