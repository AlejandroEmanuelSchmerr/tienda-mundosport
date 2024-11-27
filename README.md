
# Sistema de Tienda de Deportes

**Autor:** Emanuel Schmer  
**Contacto:** emanuelschmer@hotmail.com  

## Descripción

Este proyecto es una **Tienda de Deportes** en línea, diseñada para la venta de ropa y artículos deportivos. Proporciona funcionalidades para clientes, administradores y jefes de ventas, integrando pagos a través de PayPal y opciones de gestión avanzadas.

### Funcionalidades

#### Página principal
- Visualización de productos destacados con botones para explorar más detalles.
- Redirección a la página de productos para ver más artículos y precios.

#### Productos
- Página que muestra todos los productos disponibles.
- Botón **Ver Producto** que redirige a una página de detalles específica del producto seleccionado.

#### Carrito de Compras
- Acceso limitado: necesitas registrarte o iniciar sesión para agregar productos al carrito.
- Opciones en el carrito:
  - Actualizar la cantidad de productos.
  - Eliminar productos.
  - Continuar comprando (redirige a la página de productos).
  - Marcar el pedido como **Pendiente**.

#### Pedidos
- Vista de pedidos marcados como pendientes, mostrando:
  - ID del pedido.
  - Precio total.
  - Fecha.
- Opciones en cada pedido:
  - Ver detalles del pedido.
  - Modificar cantidades de los productos.
  - Eliminar el pedido.
  - Pagar mediante PayPal.

#### Sección "Acerca de"
- Información sobre la tienda.

#### Botón de arrepentimiento (en el footer)
- Solicitud de cancelación con un formulario que solicita el ID del pedido.

#### Contacto
- Información de contacto en el footer.

#### Página de efectos
- Página especial con efectos visuales.

#### Administración (Jefe de Ventas y Administradores)
- Iniciar sesión con credenciales predefinidas.
- Funciones disponibles tras el inicio de sesión:
  - **Pedidos:** 
    - Listado de pedidos en tabla.
    - Opción de ver detalles de cada pedido.
    - Actualización del estado de la compra.
    - Eliminación del pedido.
    - Impresión de detalles del pedido.
  - **Productos:** 
    - Listado de productos.
    - Agregar nuevos productos.
    - Editar información de productos existentes.
    - Eliminar productos.
  - **Estado de cuenta:** 
    - Facturas por fecha.
    - Facturas por cliente.
    - Facturas pendientes por cobrar.
- Opción para cerrar sesión.

---

## Tecnologías utilizadas

- **Lenguajes:** PHP, JavaScript, HTML, CSS.
- **Librerías y herramientas:**
  - Bootstrap.
  - Composer.
  - Configuración mediante `config.ini`.
- **Base de datos:** MySQL.
- **Otros archivos relevantes:**
  - `.htaccess`.
  - `composer.json` y `composer.lock`.
- **Editor recomendado:** Visual Studio Code.
- **Servidor local:** XAMPP.

---

## Requisitos

1. **Software necesario:**
   - [XAMPP](https://www.apachefriends.org/index.html) (incluye Apache y MySQL).
   - [Visual Studio Code](https://code.visualstudio.com/).
   - Navegador web.

2. **Extensiones de PHP activas:**
   - `mysqli`
   - `mbstring`
   - `gd`

3. **Archivos del proyecto:** Descargar desde este repositorio.

---

## Instalación

1. Descarga el repositorio como archivo ZIP desde la opción **"Code"** en GitHub y descomprímelo.
2. Mueve la carpeta del proyecto a la carpeta `htdocs` de XAMPP.
3. Inicia XAMPP y activa los módulos **Apache** y **MySQL**.
4. Configura la base de datos:
   - Abre `phpMyAdmin` en tu navegador (`http://localhost/phpmyadmin`).
   - Crea una nueva base de datos llamada `tienda_online`.
   - Importa el archivo SQL que se encuentra en la carpeta `bd` llamado `tienda_online.sql`.

---

## Ejecución

1. Inicia el servidor desde XAMPP.
2. Accede al sistema en tu navegador ingresando a `http://localhost/nombre-de-tu-proyecto` (cambia "nombre-de-tu-proyecto" según el nombre de la carpeta donde se colocó el proyecto).

---

## Estado

El proyecto aún está en desarrollo y faltan algunas funcionalidades por implementar. Es importante estar pendiente de los próximos cambios y actualizaciones para completar el sistema.

---

## Agradecimientos

Gracias por revisar y considerar mi proyecto. Si tienes dudas o necesitas soporte, puedes contactarme en **emanuelschmer@hotmail.com**.  
