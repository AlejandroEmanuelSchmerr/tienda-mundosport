-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 29-08-2024 a las 01:11:00
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `tienda_online`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categorias`
--

CREATE TABLE `categorias` (
  `id` int(10) NOT NULL,
  `nombre` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `categorias`
--

INSERT INTO `categorias` (`id`, `nombre`) VALUES
(1, 'Calzado'),
(2, 'Conjuntos'),
(3, 'Camisetas'),
(4, 'Pantalones Cortos');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clientes_registrados`
--

CREATE TABLE `clientes_registrados` (
  `dni` int(11) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `apellidos` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `telefono` varchar(20) NOT NULL,
  `comentario` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalles_pedidos`
--

CREATE TABLE `detalles_pedidos` (
  `id` int(11) NOT NULL,
  `pedido_id` int(11) NOT NULL,
  `producto_id` int(11) NOT NULL,
  `precio` decimal(10,2) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `estado` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `fotos`
--

CREATE TABLE `fotos` (
  `id` int(11) NOT NULL,
  `producto_id` int(11) DEFAULT NULL,
  `ruta` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pedidos`
--

CREATE TABLE `pedidos` (
  `id` int(10) NOT NULL,
  `cliente_dni` int(11) DEFAULT NULL,
  `total` decimal(10,2) NOT NULL,
  `fecha` date NOT NULL,
  `estado` varchar(25) NOT NULL DEFAULT 'PENDIENTE'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pedidos_historicos`
--

CREATE TABLE `pedidos_historicos` (
  `id` int(11) NOT NULL,
  `fecha` date DEFAULT NULL,
  `cliente_dni` int(11) DEFAULT NULL,
  `total` decimal(10,2) DEFAULT NULL,
  `estado` varchar(20) DEFAULT NULL,
  `fecha_entrega` date DEFAULT NULL,
  `detalles` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `id` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `descripcion` varchar(300) NOT NULL,
  `precio` decimal(10,2) NOT NULL,
  `talle` int(11) NOT NULL,
  `stock` int(100) NOT NULL,
  `categoria_id` int(10) NOT NULL,
  `fecha` date NOT NULL,
  `estado` int(11) NOT NULL DEFAULT 1,
  `foto` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`id`, `nombre`, `descripcion`, `precio`, `talle`, `stock`, `categoria_id`, `fecha`, `estado`, `foto`) VALUES
(1, 'Zapatillas Munchen 24', 'Aventurate a nuevos destinos con un estilo de inspiración retro. Estas zapatillas te transportan a Múnich, sede de algunos de los partidos más importantes de la UEFA Euro 2024. La parte superior de gamuza prémium y la suela de caucho evocan el legado deportivo de adidas, mientras que los detalles en', 1.00, 39, 10, 1, '2024-08-28', 0, 'zapa1.1.png'),
(2, 'Zapatillas X_PLR Path', 'Sin importar si estás explorando las calles de la ciudad o paseando por tu vecindario, estas zapatillas X_PLR Path de adidas brindan estilo y comodidad a cada paso del camino. La ligera mediasuela Cloudfoam brinda amortiguación en todo momento, mientras que la suela de caucho te permite explorar con', 2.00, 40, 11, 1, '2024-08-28', 0, 'zapa2.1.png'),
(3, 'Zapatillas Everysets', 'Entrenar es un viaje. Estas zapatillas de training adidas se han diseñado para ayudarte a alcanzar todas tus objetivos. El tejido exterior es suave, transpirable y muy cómodo. La mediasuela de doble densidad con espuma EVA más firme en el exterior y un interior de EVA más suave te ofrecen el equili', 3.00, 41, 10, 1, '2024-08-28', 0, 'zapa3.2.avif'),
(4, 'Zapatillas de Running Supernova', 'Hemos diseñado las Supernova Rise para ofrecer máxima comodidad en cada paso. Nuestra tecnología Dreamstrike+ amortigua la mediasuela con ​una espuma rediseñada. ¿Sabes qué la hace tan increíble? Ofrece el equilibrio perfecto entre comodidad y soporte para mantenerte cómodo kilómetro tras kilómetro.', 4.00, 40, 12, 1, '2024-08-28', 0, 'zapa4.1.avif'),
(6, ' Conjunto Linear Logo Tricot', 'Entrá en calor. Desconectate. Salí. No importa en qué dirección te dirijas, este conjunto adidas es lo que necesitás. Su estilo minimalista y atlético y el tejido de tricot suave te dan comodidad sin importar el ritmo. Subí el cierre, ponete el pantalón estilizado y cómodo y preparate para el día. E', 4.00, 0, 16, 2, '2024-08-28', 0, 'conjunto1.1.avif'),
(7, 'Conjunto Ajustado con Cierre', 'Ya tenés una rutina. Aunque no tenemos opiniones sobre esta, sí tenemos una opinión sobre cómo te ves mientras te enfrentás a él. Por eso creamos este conjunto adidas. Cada parte está hecha pensando en la comodidad. La tecnología de absorción AEROREADY mantiene la piel seca cuando sube la temperatur', 3.00, 0, 10, 2, '2024-08-28', 0, 'conjunto2.1.avif'),
(8, 'Conjunto M 3S DK TS', 'M 3S Dk Ts es un nuevo producto para Hombre de adidas. Te invitamos a ver las imágenes para apreciar más detalles desde diferentes ángulos. Si ya conocés M 3S Dk Ts podés dejar una reseña abajo; siempre nos encanta conocer tu opinión. Aún estamos trabajando para tener más información de M 3S Dk Ts, ', 2.00, 0, 12, 2, '2024-08-28', 0, 'conjunto3.1.avif'),
(9, ' Conjunto Tiro Argentina 24', 'Seguí a Argentina hasta la cima del fútbol mundial. Este conjunto adidas tiene una campera estilizada y un pantalón cómodo para que puedas moverte con fluidez. Incorpora tecnología de absorción AEROREADY que se encarga del sudor para mantener tu cuerpo seco y tu mente enfocado en la cancha. El escud', 1.00, 0, 10, 2, '2024-08-28', 0, 'conjunto4.1.avif'),
(10, 'Camiseta MESSI TR JSY', 'Messi Tr Jsy es un nuevo producto para Hombre de adidas. Te invitamos a ver las imágenes para apreciar más detalles desde diferentes ángulos. Si ya conocés Messi Tr Jsy podés dejar una reseña abajo; siempre nos encanta conocer tu opinión. Aún estamos trabajando para tener más información de Messi Tr', 4.00, 0, 9, 3, '2024-08-28', 0, 'camiseta1.1.avif'),
(11, 'Camiseta  Messi Inter Miami', 'Destacate con un toque del legado deportivo de Miami. Este tercer uniforme del Inter Miami CF de adidas incorpora detalles clásicos y luce tonos naranja brillante que rinden homenaje al icónico Orange Bowl. La tecnología AEROREADY mantiene secas las hinchas de fútbol mientras apoyan a su equipo. Est', 2.00, 0, 10, 3, '2024-08-28', 0, 'camiseta2.2.avif'),
(12, 'Camiseta FC Barcelona 2023/24', 'Nuestra colección Stadium combina detalles del diseño tipo réplica con tecnología absorbente de sudor para darte un look listo para el partido inspirado en tu equipo favorito. Beneficios •La tela transpirable con tecnología Nike Dri-FIT absorbe el sudor de la piel para facilitar la evaporación y man', 3.00, 0, 20, 3, '2024-08-28', 0, 'camiseta3.1.webp'),
(13, 'Camiseta  Manchester United ', 'Old Trafford es la casa del Manchester United. Los seguidores locales adoran este estadio e incluso los rivales no pueden evitar admirarlo. Para esta temporada 24/25, el uniforme de local del club apuesta por una estética llamativa y atemporal, con bloques de color rojo en los costados y un sutil es', 2.00, 0, 10, 3, '2024-08-28', 0, 'camiseta4.2.avif'),
(14, 'Shorts Own The Run', 'Sin importar si estás haciendo entrenamientos de intervalos, carreras de ritmo o carreras de larga distancia, sentite seguro con el soporte que te brindan estos shorts de running adidas. La tecnología AEROREADY mantiene tu cuerpo seco kilómetro tras kilómetro para que puedas acelerar tu ritmo. Los d', 1.00, 0, 14, 4, '2024-08-28', 0, 'short1.3.avif'),
(16, 'Shorts de Entrenamiento', 'Para los mejores equipos de fútbol, el campo de entrenamiento trae los premios más grandes al alcance. Luciendo una versión termotransferida del famoso escudo de la Selección Argentina, estos shorts adidas hacen parte de la ropa de entrenamiento del equipo.. La tecnología de absorción AEROREADY y el', 4.00, 0, 9, 4, '2024-08-28', 0, 'short2.1.avif'),
(17, ' Shorts Portero Tiro 23 Pro', 'Estos shorts de fútbol adidas presentan un corte ajustado que se adapta a las piernas cómodamente. Su tejido ultraelástico te ofrece la libertad de movimiento que necesitas para llegar a cualquier balón. La tecnología transpirable AEROREADY mantiene la piel seca del primer al último minuto. Este pro', 2.00, 0, 15, 4, '2024-08-28', 0, 'short3.1.avif'),
(18, 'Shorts Manchester United Icon', 'Este es el look que tendrían los jugadores del Manchester United con la emblemática indumentaria Equipment de adidas. Estos shorts de fútbol fusionan detalles modernos y clásicos, con un diseño dominado por las icónicas 3 Tiras de gran tamaño que se hicieron famosas en las canchas a principios de lo', 3.00, 2, 11, 4, '2024-08-28', 0, 'short4.1.avif');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `nombre_usuario` varchar(100) NOT NULL,
  `clave` varchar(159) NOT NULL,
  `estado` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `nombre_usuario`, `clave`, `estado`) VALUES
(1, 'admin', '$2y$10$uvM4bEGzk2bczUM3.ABsZeCb1Ic5xbUQEzgMvPiULBadWtKL9Yy3i', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ventas`
--

CREATE TABLE `ventas` (
  `id` int(11) NOT NULL,
  `fecha` date DEFAULT NULL,
  `monto` decimal(10,2) DEFAULT NULL,
  `metodo_pago` varchar(50) DEFAULT NULL,
  `cliente_dni` int(11) DEFAULT NULL,
  `estado_pago` varchar(20) DEFAULT NULL,
  `pedido_historico_id` int(11) DEFAULT NULL,
  `transaction_id` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `categorias`
--
ALTER TABLE `categorias`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `clientes_registrados`
--
ALTER TABLE `clientes_registrados`
  ADD PRIMARY KEY (`dni`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indices de la tabla `detalles_pedidos`
--
ALTER TABLE `detalles_pedidos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_detalles_pedidos_producto` (`producto_id`),
  ADD KEY `fk_detalles_pedidos_pedido` (`pedido_id`);

--
-- Indices de la tabla `fotos`
--
ALTER TABLE `fotos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `producto_id` (`producto_id`);

--
-- Indices de la tabla `pedidos`
--
ALTER TABLE `pedidos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_cliente` (`cliente_dni`);

--
-- Indices de la tabla `pedidos_historicos`
--
ALTER TABLE `pedidos_historicos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cliente_dni` (`cliente_dni`);

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_categoria` (`categoria_id`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `ventas`
--
ALTER TABLE `ventas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_cliente_dni` (`cliente_dni`),
  ADD KEY `fk_ventas_pedidos_historicos` (`pedido_historico_id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `categorias`
--
ALTER TABLE `categorias`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `detalles_pedidos`
--
ALTER TABLE `detalles_pedidos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT de la tabla `fotos`
--
ALTER TABLE `fotos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `pedidos`
--
ALTER TABLE `pedidos`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT de la tabla `pedidos_historicos`
--
ALTER TABLE `pedidos_historicos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `ventas`
--
ALTER TABLE `ventas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `detalles_pedidos`
--
ALTER TABLE `detalles_pedidos`
  ADD CONSTRAINT `fk_detalles_pedidos_pedido` FOREIGN KEY (`pedido_id`) REFERENCES `pedidos` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_detalles_pedidos_producto` FOREIGN KEY (`producto_id`) REFERENCES `productos` (`id`);

--
-- Filtros para la tabla `fotos`
--
ALTER TABLE `fotos`
  ADD CONSTRAINT `fotos_ibfk_1` FOREIGN KEY (`producto_id`) REFERENCES `productos` (`id`);

--
-- Filtros para la tabla `pedidos`
--
ALTER TABLE `pedidos`
  ADD CONSTRAINT `fk_cliente` FOREIGN KEY (`cliente_dni`) REFERENCES `clientes_registrados` (`dni`);

--
-- Filtros para la tabla `pedidos_historicos`
--
ALTER TABLE `pedidos_historicos`
  ADD CONSTRAINT `pedidos_historicos_ibfk_1` FOREIGN KEY (`cliente_dni`) REFERENCES `clientes_registrados` (`dni`) ON DELETE CASCADE;

--
-- Filtros para la tabla `productos`
--
ALTER TABLE `productos`
  ADD CONSTRAINT `fk_categoria` FOREIGN KEY (`categoria_id`) REFERENCES `categorias` (`id`);

--
-- Filtros para la tabla `ventas`
--
ALTER TABLE `ventas`
  ADD CONSTRAINT `fk_cliente_dni` FOREIGN KEY (`cliente_dni`) REFERENCES `clientes_registrados` (`dni`),
  ADD CONSTRAINT `fk_ventas_pedidos_historicos` FOREIGN KEY (`pedido_historico_id`) REFERENCES `pedidos_historicos` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
