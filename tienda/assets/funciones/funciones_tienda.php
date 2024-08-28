<?php
include('config/session_start.php');
include('config/config.php');

/**
 * Funcion para obtener todos los productos
 * de mi tienda
 */
function getProductData($con)
{
    $sqlProductos = ("
        SELECT 
            p.id,
            p.nombre,
            p.descripcion,
            p.precio,
            p.talle,
            p.stock,
            p.fecha,
            p.estado,
            p.foto,
            c.nombre AS categoria_nombre
        FROM 
            productos AS p
        INNER JOIN
            categorias AS c
        ON 
            p.categoria_id = c.id;
    ");
    $queryProductos = mysqli_query($con, $sqlProductos);

    if (!$queryProductos) {
        return false;
    }
    return $queryProductos;
}

/**
 * Detalles del producto seleccionado
 */
function detalles_producto_seleccionado($con, $id)
{
    $sqlDetalleProducto = ("
        SELECT 
            p.id,
            p.nombre,
            p.descripcion,
            p.precio,
            p.talle,
            p.stock,
            p.fecha,
            p.estado,
            p.foto,
            c.nombre AS categoria_nombre
        FROM 
            productos AS p
        INNER JOIN
            categorias AS c
        ON 
            p.categoria_id = c.id
        WHERE 
            p.id = '" . intval($id) . "'
        LIMIT 1;
    ");
    $queryProductosSeleccionado = mysqli_query($con, $sqlDetalleProducto);

    if (!$queryProductosSeleccionado || mysqli_num_rows($queryProductosSeleccionado) == 0) {
        return false;  // Retorna false si no hay resultados
    }
    return $queryProductosSeleccionado;
}

/**
 * Funciona para validar si el carrito tiene algun producto
 */
function validando_carrito()
{
    if (isset($_SESSION['tokenStoragel']) == "") {
        return '
            <div class="row align-items-center">
                <div class="col-lg-12 text-center mt-5">
                    <div class="alert alert-warning alert-dismissible fade show" role="alert">
                        <strong>Ops.!</strong> Tu carrito está vacío.
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                </div>
                <div class="col-lg-12 text-center mt-5 mb-5">
                    <a href="./" class="red_button btn_raza" style="padding: 5px 20px;">
                    <i class="bi bi-arrow-left-circle"></i>  Volver a la Tienda</a>
                </div>
            </div>';
    }
}

/**
 * Retornando productos del carrito de compra
 */
function mi_carrito_de_compra($con)
{
    if (isset($_SESSION['tokenStoragel']) != "") {
        $sqlCarritoCompra = ("
            SELECT 
                p.id,
                p.nombre,
                p.description_Prod,
                p.precio,
                p.foto,
                pt.id AS tempId,
                pt.producto_id,
                pt.cantidad,
                pt.tokenCliente
            FROM 
                products AS p
            INNER JOIN
                fotoproducts AS f ON p.id = f.products_id
            INNER JOIN
                pedidostemporales AS pt ON p.id = pt.producto_id
            WHERE 
                pt.tokenCliente = '" . $_SESSION['tokenStoragel'] . "'
        ");
        $queryCarrito   = mysqli_query($con, $sqlCarritoCompra);
        if (!$queryCarrito) {
            return false;
        }
        return $queryCarrito;
    } else {
        return 0;
    }
}

