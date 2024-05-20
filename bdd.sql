-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 20-05-2024 a las 02:38:38
-- Versión del servidor: 10.4.27-MariaDB-log
-- Versión de PHP: 8.1.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `deposit_calculator`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `credits_details`
--

CREATE TABLE `credits_details` (
  `credit_detail_id` int(11) NOT NULL,
  `week_id` int(11) NOT NULL,
  `credit_people_id` int(11) NOT NULL,
  `credit_detail_description` text NOT NULL,
  `credit_detail_value` double(10,2) NOT NULL,
  `credit_detail_status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `credits_details`
--

INSERT INTO `credits_details` (`credit_detail_id`, `week_id`, `credit_people_id`, `credit_detail_description`, `credit_detail_value`, `credit_detail_status`) VALUES
(19, 18, 1, 'ASDAS', 100.00, 1),
(21, 19, 1, 'TEST 12', 250.00, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `credits_people`
--

CREATE TABLE `credits_people` (
  `credit_people_id` int(11) NOT NULL,
  `credit_people_name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `credits_people`
--

INSERT INTO `credits_people` (`credit_people_id`, `credit_people_name`) VALUES
(1, 'EDGAR GALARZA'),
(2, 'CELIANO GALARZA'),
(3, 'SANDER'),
(5, 'JUAN QUINATOA'),
(6, 'CONSUELO'),
(7, 'ING SAN VICENTGE'),
(8, 'VECINO RAUL'),
(9, 'CANCHA SECTOR 3'),
(10, 'TIENDA SAN VICENTE'),
(11, 'TIENDA ROSALIA'),
(12, 'MERCEDES CEPEDA'),
(13, 'GUITIEREZ');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `personal_access_tokens`
--

INSERT INTO `personal_access_tokens` (`id`, `tokenable_type`, `tokenable_id`, `name`, `token`, `abilities`, `last_used_at`, `expires_at`, `created_at`, `updated_at`) VALUES
(28, 'App\\Models\\User', 1, 'auth-token', '13f2ecca99e369f24984908a09132e8bc1480e4fea861da943300b05a7bca6b3', '[\"*\"]', '2024-05-20 05:37:02', NULL, '2024-05-20 04:04:09', '2024-05-20 05:37:02');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `products`
--

CREATE TABLE `products` (
  `product_id` int(11) NOT NULL,
  `product_name` varchar(100) NOT NULL,
  `product_sale_price` double(10,2) NOT NULL,
  `product_purchase_price` double(10,2) NOT NULL,
  `product_img` text NOT NULL,
  `product_status` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `products`
--

INSERT INTO `products` (`product_id`, `product_name`, `product_sale_price`, `product_purchase_price`, `product_img`, `product_status`) VALUES
(1, 'PILSENER 600C', 16.00, 15.50, 'https://cms-prod.global.ssl.fastly.net/media/11-20-2023-baf92506-6f36-44e8-8b92-adb310478ac4-a429ca8a.jpeg?width=240&height=240&fit=bounds&canvas=240,240', 1),
(2, 'PILSENER2', 21.00, 22.00, 'https://i0.wp.com/chiplote.imk3.net/wp-content/uploads/2021/03/Pilsener-Cerveza-330ml-Solo-1.jpg?fit=1200%2C1200&ssl=1', 2),
(3, 'PILSENER3', 23.99, 22.00, 'https://i0.wp.com/chiplote.imk3.net/wp-content/uploads/2021/03/Pilsener-Cerveza-330ml-Solo-1.jpg?fit=1200%2C1200&ssl=1', 2),
(4, 'SIEMBRA 1000CC', 21.00, 19.20, 'https://cms-prod.global.ssl.fastly.net/media/08-03-2023-71295dc0-6916-4b34-bfa8-86bc9491aa6d-8cf40bb5.jpeg?width=240&height=240&fit=bounds&canvas=240,240', 1),
(5, 'PILSENER 1000CC', 22.00, 20.99, 'https://cms-prod.global.ssl.fastly.net/media/11-20-2023-2decb7a7-f600-45d8-b0a1-fd283b89b13c-4622b3d0.jpeg?width=240&height=240&fit=bounds&canvas=240,240', 1),
(6, 'CLUB PLATINO 850CC', 29.00, 26.50, 'https://cms-prod.global.ssl.fastly.net/media/08-02-2023-e227d7f7-051d-4027-93c7-c330bb778411-ab471658.jpeg?width=240&height=240&fit=bounds&canvas=240,240', 1),
(7, 'CIGARRILLOS LARK', 40.00, 31.46, 'https://cms-prod.global.ssl.fastly.net/media/09-06-2023-00ad7831-6a8f-4a20-8eac-6961cc8612b4-124377b3.jpeg', 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `rol_id` int(11) DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `rol_id`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'KEVIN GALARZA', 'jimenezkev1040@gmail.com', 1, '2023-12-22 03:13:16', '$2y$12$PlRcofyZ.QBVc7NWP.F7E.Eg5cSz95eT4pZjFW7vpzKVbzPWtiVwu', '8axQxfFMZP', '2023-12-22 03:13:16', '2023-12-22 03:13:16');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `weeks`
--

CREATE TABLE `weeks` (
  `week_id` int(11) NOT NULL,
  `week_alias` varchar(150) NOT NULL,
  `week_date` date NOT NULL,
  `week_status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `weeks`
--

INSERT INTO `weeks` (`week_id`, `week_alias`, `week_date`, `week_status`) VALUES
(18, 'TEST 1', '2024-05-20', 1),
(19, 'TEST 2', '2024-05-27', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `week_details`
--

CREATE TABLE `week_details` (
  `week_detail_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `week_id` int(11) NOT NULL,
  `week_detail_quantity` int(11) NOT NULL,
  `week_detail_product_name` varchar(100) NOT NULL,
  `week_detail_product_sale_price` double(10,2) NOT NULL,
  `week_detail_product_purchase_price` double(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `credits_details`
--
ALTER TABLE `credits_details`
  ADD PRIMARY KEY (`credit_detail_id`),
  ADD KEY `fk_credits_detail_credits_people` (`credit_people_id`),
  ADD KEY `fk_credits_detail_week` (`week_id`);

--
-- Indices de la tabla `credits_people`
--
ALTER TABLE `credits_people`
  ADD PRIMARY KEY (`credit_people_id`);

--
-- Indices de la tabla `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indices de la tabla `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indices de la tabla `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indices de la tabla `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`product_id`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indices de la tabla `weeks`
--
ALTER TABLE `weeks`
  ADD PRIMARY KEY (`week_id`);

--
-- Indices de la tabla `week_details`
--
ALTER TABLE `week_details`
  ADD PRIMARY KEY (`week_detail_id`),
  ADD KEY `FK_week_detail_product` (`product_id`),
  ADD KEY `FK_week_detail_week` (`week_id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `credits_details`
--
ALTER TABLE `credits_details`
  MODIFY `credit_detail_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT de la tabla `credits_people`
--
ALTER TABLE `credits_people`
  MODIFY `credit_people_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT de la tabla `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT de la tabla `products`
--
ALTER TABLE `products`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `weeks`
--
ALTER TABLE `weeks`
  MODIFY `week_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT de la tabla `week_details`
--
ALTER TABLE `week_details`
  MODIFY `week_detail_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `credits_details`
--
ALTER TABLE `credits_details`
  ADD CONSTRAINT `fk_credits_detail_credits_people` FOREIGN KEY (`credit_people_id`) REFERENCES `credits_people` (`credit_people_id`),
  ADD CONSTRAINT `fk_credits_detail_week` FOREIGN KEY (`week_id`) REFERENCES `weeks` (`week_id`);

--
-- Filtros para la tabla `week_details`
--
ALTER TABLE `week_details`
  ADD CONSTRAINT `FK_week_detail_product` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`),
  ADD CONSTRAINT `FK_week_detail_week` FOREIGN KEY (`week_id`) REFERENCES `weeks` (`week_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
