-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 28-Nov-2019 às 19:39
-- Versão do servidor: 10.4.6-MariaDB
-- versão do PHP: 7.3.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `redsocial`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `comentarios`
--

CREATE TABLE `comentarios` (
  `idcomentario` int(11) NOT NULL,
  `idPublicacion` int(11) NOT NULL,
  `idUser` int(11) NOT NULL,
  `contenidoComentario` longtext NOT NULL,
  `fechaComentario` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `comentarios`
--

INSERT INTO `comentarios` (`idcomentario`, `idPublicacion`, `idUser`, `contenidoComentario`, `fechaComentario`) VALUES
(12, 13, 10, 'Hola amigo', '2019-11-28 18:34:24'),
(13, 14, 10, 'Hola mongolon', '2019-11-28 18:34:28');

-- --------------------------------------------------------

--
-- Estrutura da tabela `fotos`
--

CREATE TABLE `fotos` (
  `idFoto` int(11) NOT NULL,
  `nombreFoto` varchar(200) NOT NULL,
  `rutaFoto` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `likes`
--

CREATE TABLE `likes` (
  `idlike` int(11) NOT NULL,
  `idPublicacion` int(11) NOT NULL,
  `idUser` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `likes`
--

INSERT INTO `likes` (`idlike`, `idPublicacion`, `idUser`) VALUES
(17, 11, 7),
(22, 12, 7),
(23, 13, 7),
(27, 11, 8),
(28, 12, 8),
(31, 14, 8),
(32, 13, 8),
(33, 14, 10),
(34, 13, 10);

-- --------------------------------------------------------

--
-- Estrutura da tabela `mensajes`
--

CREATE TABLE `mensajes` (
  `idmensaje` int(11) NOT NULL,
  `usuarios_idusuario` int(11) NOT NULL,
  `usuarioMando` int(11) NOT NULL,
  `contenido` longtext NOT NULL,
  `fechaMensaje` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `mensajes`
--

INSERT INTO `mensajes` (`idmensaje`, `usuarios_idusuario`, `usuarioMando`, `contenido`, `fechaMensaje`) VALUES
(1, 5, 3, 'Para cuando robotica? :v', '2019-11-14 14:00:48');

-- --------------------------------------------------------

--
-- Estrutura da tabela `notificaciones`
--

CREATE TABLE `notificaciones` (
  `idnotificacion` int(11) NOT NULL,
  `idUsuario` int(11) NOT NULL,
  `usuarioAccion` int(11) NOT NULL,
  `tipoNotificaion` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `notificaciones`
--

INSERT INTO `notificaciones` (`idnotificacion`, `idUsuario`, `usuarioAccion`, `tipoNotificaion`) VALUES
(9, 7, 7, 1),
(10, 4, 7, 1),
(11, 8, 7, 1),
(12, 8, 7, 1),
(13, 8, 7, 1),
(14, 7, 7, 2),
(15, 8, 7, 2),
(16, 8, 7, 1),
(17, 8, 7, 1),
(18, 8, 8, 1),
(19, 8, 8, 2),
(20, 8, 7, 1),
(21, 7, 7, 1),
(22, 7, 7, 1),
(23, 7, 7, 1),
(24, 8, 7, 1),
(25, 7, 7, 1),
(26, 7, 7, 1),
(27, 7, 7, 1),
(28, 7, 7, 1),
(29, 7, 7, 1),
(30, 7, 7, 1),
(31, 7, 8, 1),
(32, 7, 8, 1),
(33, 8, 8, 1),
(34, 8, 8, 1),
(35, 7, 8, 1),
(36, 7, 8, 1),
(37, 7, 7, 2),
(38, 8, 8, 1),
(39, 8, 8, 1),
(40, 7, 8, 1),
(41, 7, 8, 2),
(42, 7, 9, 2),
(43, 7, 10, 2),
(44, 8, 10, 2),
(45, 8, 10, 1),
(46, 7, 10, 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `perfil`
--

CREATE TABLE `perfil` (
  `idperfil` int(11) NOT NULL,
  `idUsuario` int(11) NOT NULL,
  `fotoPerfil` varchar(200) NOT NULL,
  `nombreCompleto` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `perfil`
--

INSERT INTO `perfil` (`idperfil`, `idUsuario`, `fotoPerfil`, `nombreCompleto`) VALUES
(1, 3, 'img/imagenesPerfil/descarga.jpg', 'Marco Campoverde'),
(2, 4, 'img/imagenesPerfil/fe0374d7-cc8f-4979-80c1-f89231d87960.jpg', 'Alvaro Pelaez'),
(3, 5, 'img/imagenesPerfil/Student.jpg', 'Michael Cuicapusa'),
(4, 6, 'img/imagenesPerfil/Byte.png', 'Alvaro Franco'),
(5, 7, 'img/imagenesPerfil/Byte.png', 'Alvaro Franco'),
(6, 8, 'img/imagenesPerfil/MarketPrincipalPromo.PNG', 'Pep Guardiola'),
(7, 9, 'img/imagenesPerfil/Byte.png', 'Libertadores'),
(8, 10, 'img/imagenesPerfil/Persona.jpg', 'Pep Guardiola');

-- --------------------------------------------------------

--
-- Estrutura da tabela `privilegios`
--

CREATE TABLE `privilegios` (
  `idPrivilegio` int(11) NOT NULL,
  `nombrePrivilegio` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `privilegios`
--

INSERT INTO `privilegios` (`idPrivilegio`, `nombrePrivilegio`) VALUES
(1, 'Admin'),
(2, 'Gamer');

-- --------------------------------------------------------

--
-- Estrutura da tabela `publicaciones`
--

CREATE TABLE `publicaciones` (
  `idpublicacion` int(11) NOT NULL,
  `idUserPublico` int(11) NOT NULL,
  `contenidoPublicacion` longtext NOT NULL,
  `fotoPublicacion` varchar(200) NOT NULL,
  `num_likes` int(11) DEFAULT NULL,
  `fechaPublicacion` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `publicaciones`
--

INSERT INTO `publicaciones` (`idpublicacion`, `idUserPublico`, `contenidoPublicacion`, `fotoPublicacion`, `num_likes`, `fechaPublicacion`) VALUES
(13, 7, 'Soy un  crack', 'img/imagenesPublicaciones/auriculares-bluetooth-inalambricos-i7s-tws-inear-airpods-base-recargable-para-android-y-iphone-D_NQ_NP_901096-MLA32296779421_092019-F.jpg', 3, '2019-11-27 22:38:01'),
(14, 8, 'adasd', 'img/imagenesPublicaciones/', 2, '2019-11-27 23:06:21'),
(15, 10, 'Nada tengo hambre', 'img/imagenesPublicaciones/', NULL, '2019-11-28 18:34:37'),
(16, 10, 'como comida', 'img/imagenesPublicaciones/', NULL, '2019-11-28 18:34:56');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tiposnotificaciones`
--

CREATE TABLE `tiposnotificaciones` (
  `idtiposNotificaciones` int(11) NOT NULL,
  `nombreTipo` varchar(60) NOT NULL,
  `mensajeNotificacion` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `tiposnotificaciones`
--

INSERT INTO `tiposnotificaciones` (`idtiposNotificaciones`, `nombreTipo`, `mensajeNotificacion`) VALUES
(1, 'Like', 'le ha dado me gusta a tu publicacion'),
(2, 'Comentario', 'ha comentado tu publicacion');

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuarios`
--

CREATE TABLE `usuarios` (
  `idusuario` int(11) NOT NULL,
  `idPrivilegio` int(11) NOT NULL,
  `correo` varchar(100) NOT NULL,
  `usuario` varchar(50) NOT NULL,
  `contrasena` varchar(255) NOT NULL,
  `fecha_registro` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `usuarios`
--

INSERT INTO `usuarios` (`idusuario`, `idPrivilegio`, `correo`, `usuario`, `contrasena`, `fecha_registro`) VALUES
(7, 2, 'alvarofranco@gmail.com', 'macaco100%REAL', '$2y$10$SqdoXrtYdkhzy7LQQGCntuYhDoi0a1gZmSiZVwqTmWn3TXEDwXTJe', '2019-11-15 01:33:03'),
(8, 1, 'alvarofranco2020@lmail.com', 'mm', '$2y$10$lK6mUta3JjSBh9HapCbQXuNgY32xeWgdpapi8E0HTCX9DE6aZlWSe', '2019-11-16 13:22:16'),
(9, 2, 'alvaro@gmail.com', 'Alvarooo7', '$2y$10$WlGYb/cVHKpvw5hKNj9KvuXO9tCjKFwW3Crsr54zj6q5x8g1kO2iK', '2019-10-28 16:53:16'),
(10, 2, 'a20@gmail.com', 'rr', '$2y$10$MOg1aIdvmVbe7WvNTau3Xu15sFBwhkubNzXy59KUZLq6MPKTcRqZC', '2019-11-28 18:33:59');

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `comentarios`
--
ALTER TABLE `comentarios`
  ADD PRIMARY KEY (`idcomentario`),
  ADD KEY `comentarioPublicacion_idx` (`idPublicacion`);

--
-- Índices para tabela `fotos`
--
ALTER TABLE `fotos`
  ADD PRIMARY KEY (`idFoto`);

--
-- Índices para tabela `likes`
--
ALTER TABLE `likes`
  ADD PRIMARY KEY (`idlike`),
  ADD KEY `publiLikes_idx` (`idPublicacion`);

--
-- Índices para tabela `mensajes`
--
ALTER TABLE `mensajes`
  ADD PRIMARY KEY (`idmensaje`),
  ADD KEY `fk_mensajes_usuarios1_idx` (`usuarios_idusuario`);

--
-- Índices para tabela `notificaciones`
--
ALTER TABLE `notificaciones`
  ADD PRIMARY KEY (`idnotificacion`);

--
-- Índices para tabela `perfil`
--
ALTER TABLE `perfil`
  ADD PRIMARY KEY (`idperfil`),
  ADD KEY `perfilUser_idx` (`idUsuario`);

--
-- Índices para tabela `privilegios`
--
ALTER TABLE `privilegios`
  ADD PRIMARY KEY (`idPrivilegio`);

--
-- Índices para tabela `publicaciones`
--
ALTER TABLE `publicaciones`
  ADD PRIMARY KEY (`idpublicacion`),
  ADD KEY `publicacioesUser_idx` (`idUserPublico`);

--
-- Índices para tabela `tiposnotificaciones`
--
ALTER TABLE `tiposnotificaciones`
  ADD PRIMARY KEY (`idtiposNotificaciones`);

--
-- Índices para tabela `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`idusuario`),
  ADD KEY `priviUser_idx` (`idPrivilegio`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `comentarios`
--
ALTER TABLE `comentarios`
  MODIFY `idcomentario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT de tabela `fotos`
--
ALTER TABLE `fotos`
  MODIFY `idFoto` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `likes`
--
ALTER TABLE `likes`
  MODIFY `idlike` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT de tabela `mensajes`
--
ALTER TABLE `mensajes`
  MODIFY `idmensaje` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de tabela `notificaciones`
--
ALTER TABLE `notificaciones`
  MODIFY `idnotificacion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT de tabela `perfil`
--
ALTER TABLE `perfil`
  MODIFY `idperfil` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de tabela `privilegios`
--
ALTER TABLE `privilegios`
  MODIFY `idPrivilegio` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de tabela `publicaciones`
--
ALTER TABLE `publicaciones`
  MODIFY `idpublicacion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT de tabela `tiposnotificaciones`
--
ALTER TABLE `tiposnotificaciones`
  MODIFY `idtiposNotificaciones` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de tabela `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `idusuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
