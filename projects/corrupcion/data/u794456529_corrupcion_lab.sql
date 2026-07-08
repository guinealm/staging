-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1:3306
-- Tiempo de generación: 08-07-2026 a las 15:02:33
-- Versión del servidor: 11.8.8-MariaDB-log
-- Versión de PHP: 7.2.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `u794456529_corrupcion_lab`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `corr_casos`
--

CREATE TABLE `corr_casos` (
  `id` int(11) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `partido_id` int(11) DEFAULT NULL,
  `fase_id` int(11) DEFAULT NULL,
  `tribunal_id` int(11) DEFAULT NULL,
  `gravedad` varchar(50) DEFAULT NULL,
  `vinculo` varchar(255) DEFAULT NULL,
  `estado` varchar(255) DEFAULT NULL,
  `visible_publico` tinyint(1) NOT NULL DEFAULT 1,
  `observaciones` text DEFAULT NULL,
  `ultima_revision` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `corr_casos`
--

INSERT INTO `corr_casos` (`id`, `nombre`, `partido_id`, `fase_id`, `tribunal_id`, `gravedad`, `vinculo`, `estado`, `visible_publico`, `observaciones`, `ultima_revision`) VALUES
(1, 'Caso Koldo / Ábalos', 4, 7, 6, 'Alta', 'Exministro, exasesor, contratación pública', 'Activo', 1, 'Varias piezas. Diferenciar Supremo por aforados y Audiencia Nacional para otros investigados.', '2026-05-27'),
(2, 'Operación Kitchen', 5, 3, 2, 'Alta', 'Exministro y altos cargos del Gobierno del PP', 'Activo', 1, 'Presunta operación parapolicial relacionada con documentación de Bárcenas.', '2026-05-27'),
(3, 'Caso 3%', 6, 8, 2, 'Alta', 'Presunta financiación irregular de partido', 'Activo', 1, 'Caso comparable a otros procedimientos de financiación irregular mediante adjudicaciones públicas.', '2026-05-27'),
(4, 'Financiación / préstamo húngaro', 7, 9, 7, 'Dudosa', 'Partido', 'Excluido', 0, 'No incluir en tabla principal si la vía penal está archivada.', '2026-05-27');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `corr_caso_persona`
--

CREATE TABLE `corr_caso_persona` (
  `caso_id` int(11) NOT NULL,
  `persona_id` int(11) NOT NULL,
  `rol` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `corr_caso_persona`
--

INSERT INTO `corr_caso_persona` (`caso_id`, `persona_id`, `rol`) VALUES
(1, 1, 'pendiente de clasificar'),
(1, 2, 'pendiente de clasificar'),
(1, 3, 'pendiente de clasificar'),
(1, 4, 'pendiente de clasificar'),
(2, 5, 'pendiente de clasificar'),
(2, 6, 'pendiente de clasificar'),
(2, 7, 'pendiente de clasificar'),
(2, 8, 'pendiente de clasificar'),
(3, 9, 'pendiente de clasificar'),
(3, 10, 'pendiente de clasificar'),
(3, 11, 'pendiente de clasificar'),
(3, 12, 'pendiente de clasificar'),
(4, 13, 'partido');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `corr_fases`
--

CREATE TABLE `corr_fases` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `orden` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `corr_fases`
--

INSERT INTO `corr_fases` (`id`, `nombre`, `orden`) VALUES
(1, 'Investigación', 1),
(2, 'Instrucción', 2),
(3, 'Juicio oral', 3),
(4, 'Condena', 4),
(5, 'Archivo', 5),
(6, 'Recurso', 6),
(7, 'Visto para sentencia', 4),
(8, 'Juicio oral pendiente', 3),
(9, 'Archivado', 5);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `corr_fuentes`
--

CREATE TABLE `corr_fuentes` (
  `id` int(11) NOT NULL,
  `caso_id` int(11) NOT NULL,
  `titulo` varchar(255) DEFAULT NULL,
  `url` text DEFAULT NULL,
  `fecha_consulta` date DEFAULT NULL,
  `observaciones` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `corr_fuentes`
--

INSERT INTO `corr_fuentes` (`id`, `caso_id`, `titulo`, `url`, `fecha_consulta`, `observaciones`) VALUES
(1, 1, 'Fuente pendiente', NULL, '2026-05-27', 'El campo fuente estaba vacío en el JSON inicial.'),
(2, 2, 'Fuente pendiente', NULL, '2026-05-27', 'El campo fuente estaba vacío en el JSON inicial.'),
(3, 3, 'Fuente pendiente', NULL, '2026-05-27', 'El campo fuente estaba vacío en el JSON inicial.'),
(4, 4, 'Fuente pendiente', NULL, '2026-05-27', 'El campo fuente estaba vacío en el JSON inicial.');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `corr_partidos`
--

CREATE TABLE `corr_partidos` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `sigla` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `corr_partidos`
--

INSERT INTO `corr_partidos` (`id`, `nombre`, `sigla`) VALUES
(1, 'PSOE', 'PSOE'),
(2, 'PP', 'PP'),
(3, 'Otros', 'Otros'),
(4, 'PSOE / entorno PSOE', 'PSOE'),
(5, 'PP / entorno PP', 'PP'),
(6, 'Junts / CDC / PDeCAT', 'Junts/CDC/PDeCAT'),
(7, 'Vox', 'Vox');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `corr_personas`
--

CREATE TABLE `corr_personas` (
  `id` int(11) NOT NULL,
  `nombre` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `corr_personas`
--

INSERT INTO `corr_personas` (`id`, `nombre`) VALUES
(1, 'José Luis Ábalos'),
(2, 'Koldo García'),
(3, 'Víctor de Aldama'),
(4, 'Otros investigados - Caso Koldo / Ábalos'),
(5, 'Jorge Fernández Díaz'),
(6, 'Francisco Martínez'),
(7, 'José Manuel Villarejo'),
(8, 'Otros investigados - Operación Kitchen'),
(9, 'CDC'),
(10, 'PDeCAT'),
(11, 'Exgerentes'),
(12, 'Empresarios'),
(13, 'Vox como partido');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `corr_tribunales`
--

CREATE TABLE `corr_tribunales` (
  `id` int(11) NOT NULL,
  `nombre` varchar(200) NOT NULL,
  `ambito` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `corr_tribunales`
--

INSERT INTO `corr_tribunales` (`id`, `nombre`, `ambito`) VALUES
(1, 'Tribunal Supremo', 'Estatal'),
(2, 'Audiencia Nacional', 'Estatal'),
(3, 'Juzgado de Instrucción', 'Local'),
(4, 'Audiencia Provincial', 'Provincial'),
(5, 'Tribunal Superior de Justicia', 'Autonómico'),
(6, 'Tribunal Supremo / Audiencia Nacional', 'Estatal'),
(7, 'Fiscalía Anticorrupción / Tribunal de Cuentas', 'Estatal');

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `corr_v_casos_json`
-- (Véase abajo para la vista actual)
--
CREATE TABLE `corr_v_casos_json` (
`partido` varchar(100)
,`caso` varchar(255)
,`fase` varchar(100)
,`tribunal` varchar(200)
,`personas` longtext
,`gravedad` varchar(50)
,`vinculo` varchar(255)
,`estado` varchar(255)
,`observaciones` text
,`fuente` char(0)
,`ultimaRevision` date
);

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `corr_v_casos_json_con_id`
-- (Véase abajo para la vista actual)
--
CREATE TABLE `corr_v_casos_json_con_id` (
`id` int(11)
,`partido` varchar(100)
,`caso` varchar(255)
,`fase` varchar(100)
,`tribunal` varchar(200)
,`personas` longtext
,`gravedad` varchar(50)
,`vinculo` varchar(255)
,`estado` varchar(255)
,`visible_publico` tinyint(1)
,`observaciones` text
,`fuente` char(0)
,`ultimaRevision` date
);

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `corr_v_casos_publicos`
-- (Véase abajo para la vista actual)
--
CREATE TABLE `corr_v_casos_publicos` (
`partido` varchar(100)
,`caso` varchar(255)
,`fase` varchar(100)
,`tribunal` varchar(200)
,`personas` longtext
,`gravedad` varchar(50)
,`vinculo` varchar(255)
,`estado` varchar(255)
,`observaciones` text
,`fuente` char(0)
,`ultimaRevision` date
);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `corr_casos`
--
ALTER TABLE `corr_casos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_corr_casos_partido` (`partido_id`),
  ADD KEY `fk_corr_casos_fase` (`fase_id`),
  ADD KEY `fk_corr_casos_tribunal` (`tribunal_id`);

--
-- Indices de la tabla `corr_caso_persona`
--
ALTER TABLE `corr_caso_persona`
  ADD PRIMARY KEY (`caso_id`,`persona_id`),
  ADD KEY `fk_corr_cp_persona` (`persona_id`);

--
-- Indices de la tabla `corr_fases`
--
ALTER TABLE `corr_fases`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `corr_fuentes`
--
ALTER TABLE `corr_fuentes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_corr_fuentes_caso` (`caso_id`);

--
-- Indices de la tabla `corr_partidos`
--
ALTER TABLE `corr_partidos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `corr_personas`
--
ALTER TABLE `corr_personas`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `corr_tribunales`
--
ALTER TABLE `corr_tribunales`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `corr_casos`
--
ALTER TABLE `corr_casos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `corr_fases`
--
ALTER TABLE `corr_fases`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `corr_fuentes`
--
ALTER TABLE `corr_fuentes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `corr_partidos`
--
ALTER TABLE `corr_partidos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `corr_personas`
--
ALTER TABLE `corr_personas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT de la tabla `corr_tribunales`
--
ALTER TABLE `corr_tribunales`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

-- --------------------------------------------------------

--
-- Estructura para la vista `corr_v_casos_json`
--
DROP TABLE IF EXISTS `corr_v_casos_json`;

CREATE ALGORITHM=UNDEFINED DEFINER=`u794456529_admin`@`127.0.0.1` SQL SECURITY DEFINER VIEW `corr_v_casos_json`  AS SELECT `corr_v_casos_json_con_id`.`partido` AS `partido`, `corr_v_casos_json_con_id`.`caso` AS `caso`, `corr_v_casos_json_con_id`.`fase` AS `fase`, `corr_v_casos_json_con_id`.`tribunal` AS `tribunal`, `corr_v_casos_json_con_id`.`personas` AS `personas`, `corr_v_casos_json_con_id`.`gravedad` AS `gravedad`, `corr_v_casos_json_con_id`.`vinculo` AS `vinculo`, `corr_v_casos_json_con_id`.`estado` AS `estado`, `corr_v_casos_json_con_id`.`observaciones` AS `observaciones`, `corr_v_casos_json_con_id`.`fuente` AS `fuente`, `corr_v_casos_json_con_id`.`ultimaRevision` AS `ultimaRevision` FROM `corr_v_casos_json_con_id` ;

-- --------------------------------------------------------

--
-- Estructura para la vista `corr_v_casos_json_con_id`
--
DROP TABLE IF EXISTS `corr_v_casos_json_con_id`;

CREATE ALGORITHM=UNDEFINED DEFINER=`u794456529_admin`@`127.0.0.1` SQL SECURITY DEFINER VIEW `corr_v_casos_json_con_id`  AS SELECT `c`.`id` AS `id`, `p`.`nombre` AS `partido`, `c`.`nombre` AS `caso`, `f`.`nombre` AS `fase`, `t`.`nombre` AS `tribunal`, group_concat(`pe`.`nombre` order by `pe`.`nombre` ASC separator ', ') AS `personas`, `c`.`gravedad` AS `gravedad`, `c`.`vinculo` AS `vinculo`, `c`.`estado` AS `estado`, `c`.`visible_publico` AS `visible_publico`, `c`.`observaciones` AS `observaciones`, '' AS `fuente`, `c`.`ultima_revision` AS `ultimaRevision` FROM (((((`corr_casos` `c` left join `corr_partidos` `p` on(`c`.`partido_id` = `p`.`id`)) left join `corr_fases` `f` on(`c`.`fase_id` = `f`.`id`)) left join `corr_tribunales` `t` on(`c`.`tribunal_id` = `t`.`id`)) left join `corr_caso_persona` `cp` on(`cp`.`caso_id` = `c`.`id`)) left join `corr_personas` `pe` on(`pe`.`id` = `cp`.`persona_id`)) GROUP BY `c`.`id`, `p`.`nombre`, `c`.`nombre`, `f`.`nombre`, `t`.`nombre`, `c`.`gravedad`, `c`.`vinculo`, `c`.`estado`, `c`.`visible_publico`, `c`.`observaciones`, `c`.`ultima_revision` ;

-- --------------------------------------------------------

--
-- Estructura para la vista `corr_v_casos_publicos`
--
DROP TABLE IF EXISTS `corr_v_casos_publicos`;

CREATE ALGORITHM=UNDEFINED DEFINER=`u794456529_admin`@`127.0.0.1` SQL SECURITY DEFINER VIEW `corr_v_casos_publicos`  AS SELECT `corr_v_casos_json`.`partido` AS `partido`, `corr_v_casos_json`.`caso` AS `caso`, `corr_v_casos_json`.`fase` AS `fase`, `corr_v_casos_json`.`tribunal` AS `tribunal`, `corr_v_casos_json`.`personas` AS `personas`, `corr_v_casos_json`.`gravedad` AS `gravedad`, `corr_v_casos_json`.`vinculo` AS `vinculo`, `corr_v_casos_json`.`estado` AS `estado`, `corr_v_casos_json`.`observaciones` AS `observaciones`, `corr_v_casos_json`.`fuente` AS `fuente`, `corr_v_casos_json`.`ultimaRevision` AS `ultimaRevision` FROM `corr_v_casos_json` WHERE `corr_v_casos_json`.`estado` = 'Activo' ;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `corr_casos`
--
ALTER TABLE `corr_casos`
  ADD CONSTRAINT `fk_corr_casos_fase` FOREIGN KEY (`fase_id`) REFERENCES `corr_fases` (`id`),
  ADD CONSTRAINT `fk_corr_casos_partido` FOREIGN KEY (`partido_id`) REFERENCES `corr_partidos` (`id`),
  ADD CONSTRAINT `fk_corr_casos_tribunal` FOREIGN KEY (`tribunal_id`) REFERENCES `corr_tribunales` (`id`);

--
-- Filtros para la tabla `corr_caso_persona`
--
ALTER TABLE `corr_caso_persona`
  ADD CONSTRAINT `fk_corr_cp_caso` FOREIGN KEY (`caso_id`) REFERENCES `corr_casos` (`id`),
  ADD CONSTRAINT `fk_corr_cp_persona` FOREIGN KEY (`persona_id`) REFERENCES `corr_personas` (`id`);

--
-- Filtros para la tabla `corr_fuentes`
--
ALTER TABLE `corr_fuentes`
  ADD CONSTRAINT `fk_corr_fuentes_caso` FOREIGN KEY (`caso_id`) REFERENCES `corr_casos` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
