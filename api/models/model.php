
<?php
    require_once 'db/config.php';
    class Model {
        protected $db;

        public function __construct() {
            $this->crearDb();
            $this->db = new PDO(
                'mysql:host='. MYSQL_HOST .
                ';dbname='. MYSQL_DB .
                ';charset=utf8', MYSQL_USER, MYSQL_PASS
            );
            $this->deploy();
        }

        private function deploy(){
            $query = $this->db->query('SHOW TABLES');
            $tables = $query->fetchAll();
            if(count($tables) == 0) {
                $password='$2y$10$/5NWKVyxKiYbO7lmSSYnxO5G1Ug7tPrkcZKm1NISv9dnHyLMJ1GSi';
                $sql =<<<END
                CREATE TABLE `instrumentos` (
                `id` int(255) NOT NULL,
                `instrumento` varchar(85) NOT NULL,
                `precio` int(11) NOT NULL,
                `stock` int(11) NOT NULL,
                `ID_MARCAS` int(11) DEFAULT NULL
                ) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

                --
                -- Volcado de datos para la tabla `instrumentos`
                --

                INSERT INTO `instrumentos` (`id`, `instrumento`, `precio`, `stock`, `ID_MARCAS`) VALUES
                (30, 'microfono', 5000, 2, 21);

                -- --------------------------------------------------------

                --
                -- Estructura de tabla para la tabla `marcas_de_instrumento`
                --

                CREATE TABLE `marcas_de_instrumento` (
                `ID_MARCAS` int(250) NOT NULL,
                `nombre_de_marca` varchar(20) NOT NULL,
                `direccion` varchar(11) NOT NULL
                ) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

                --
                -- Volcado de datos para la tabla `marcas_de_instrumento`
                --

                INSERT INTO `marcas_de_instrumento` (`ID_MARCAS`, `nombre_de_marca`, `direccion`) VALUES
                (17, 'FENDER', 'WASHINGTON '),
                (18, 'BOSS', 'CALIFORNIA'),
                (21, 'Marshall', 'Reino unido');

                -- --------------------------------------------------------

                --
                -- Estructura de tabla para la tabla `usuarios`
                --

                CREATE TABLE `usuarios` (
                `id_usuario` int(11) NOT NULL,
                `email` varchar(50) NOT NULL,
                `contraseña` varchar(255) NOT NULL
                ) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

                --
                -- Volcado de datos para la tabla `usuarios`
                --

                INSERT INTO `usuarios` (`id_usuario`, `email`, `contraseña`) VALUES
                (4, 'webadmin@gmail.com','$password');

                --
                -- Índices para tablas volcadas
                --

                --
                -- Indices de la tabla `instrumentos`
                --
                ALTER TABLE `instrumentos`
                ADD PRIMARY KEY (`id`),
                ADD KEY `fk_ID_MARCAS` (`ID_MARCAS`);

                --
                -- Indices de la tabla `marcas_de_instrumento`
                --
                ALTER TABLE `marcas_de_instrumento`
                ADD PRIMARY KEY (`ID_MARCAS`);

                --
                -- Indices de la tabla `usuarios`
                --
                ALTER TABLE `usuarios`
                ADD PRIMARY KEY (`id_usuario`),
                ADD UNIQUE KEY `usuario` (`email`);

                --
                -- AUTO_INCREMENT de las tablas volcadas
                --

                --
                -- AUTO_INCREMENT de la tabla `instrumentos`
                --
                ALTER TABLE `instrumentos`
                MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

                --
                -- AUTO_INCREMENT de la tabla `marcas_de_instrumento`
                --
                ALTER TABLE `marcas_de_instrumento`
                MODIFY `ID_MARCAS` int(250) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

                --
                -- AUTO_INCREMENT de la tabla `usuarios`
                --
                ALTER TABLE `usuarios`
                MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

                --
                -- Restricciones para tablas volcadas
                --

                --
                -- Filtros para la tabla `instrumentos`
                --
                ALTER TABLE `instrumentos`
                ADD CONSTRAINT `fk_ID_MARCAS` FOREIGN KEY (`ID_MARCAS`) REFERENCES `marcas_de_instrumento` (`ID_MARCAS`) ON DELETE CASCADE ON UPDATE CASCADE;
                COMMIT;
                END;
                $this->db->query($sql);
            }

        }

        private function crearDb(){
            $nombreDb = MYSQL_DB;
            $pdo = new PDO('mysql:host =' . MYSQL_HOST.';charset = utf8', MYSQL_USER, MYSQL_PASS);
            $query = "CREATE DATABASE IF NOT EXISTS $nombreDb";
            $pdo->exec($query);
        }

    }
