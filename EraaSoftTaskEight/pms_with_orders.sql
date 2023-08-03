-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 03, 2023 at 05:48 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pms`
--

-- --------------------------------------------------------

--
-- Table structure for table `carts`
--

CREATE TABLE `carts` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `product_id` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `update_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `carts`
--

INSERT INTO `carts` (`id`, `user_id`, `product_id`, `created_at`, `update_at`) VALUES
(11, 13, 11, '2023-08-03 01:14:27', '0000-00-00 00:00:00'),
(14, 13, 12, '2023-08-03 01:35:10', '0000-00-00 00:00:00'),
(15, 13, 12, '2023-08-03 01:37:32', '0000-00-00 00:00:00'),
(16, 13, 12, '2023-08-03 01:42:31', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `cat_name` varchar(255) NOT NULL,
  `cat_description` varchar(255) DEFAULT NULL,
  `user_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `update_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `cat_name`, `cat_description`, `user_id`, `created_at`, `update_at`) VALUES
(14, 'elecortincs', 'for all who have interest in elctronics, bla bla bla, bbbbb', 6, '2023-08-01 00:06:43', '0000-00-00 00:00:00'),
(15, 'sports', 'for all who have interest in sports, bla bla bla, bbbbb', 6, '2023-08-01 15:02:34', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `product_id` int(11) DEFAULT NULL,
  `users_id` int(11) DEFAULT NULL,
  `size` varchar(50) NOT NULL,
  `price` varchar(50) DEFAULT NULL,
  `quantity` varchar(50) DEFAULT NULL,
  `discount` varchar(50) DEFAULT NULL,
  `total` varchar(50) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `update_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `product_id`, `users_id`, `size`, `price`, `quantity`, `discount`, `total`, `created_at`, `update_at`) VALUES
(14, 11, 13, 's', '100$', '2', '20%', '180$', '2023-08-03 03:41:18', '0000-00-00 00:00:00'),
(15, 11, 13, 's', '100$', '2', '20%', '160$', '2023-08-03 03:45:39', '0000-00-00 00:00:00'),
(17, 11, 1, 's', '100$', '3', '20%', '240$', '2023-08-03 03:46:06', '0000-00-00 00:00:00'),
(18, 11, 6, 's', '100$', '4', '20%', '320$', '2023-08-03 03:46:34', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `phones`
--

CREATE TABLE `phones` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `country_code` varchar(10) NOT NULL,
  `phone_number` int(20) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `phones`
--

INSERT INTO `phones` (`id`, `user_id`, `country_code`, `phone_number`, `created_at`, `updated_at`) VALUES
(1, 1, '+02', 1149725209, '2023-07-29 13:09:37', '2023-07-29 15:08:51'),
(2, 2, '+02', 1121979081, '2023-07-29 13:09:37', '2023-07-29 15:08:51');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `prd_name` varchar(255) NOT NULL,
  `prd_quantity` varchar(50) NOT NULL,
  `prd_price` varchar(50) NOT NULL,
  `prd_brand_name` varchar(255) DEFAULT NULL,
  `prd_discount` varchar(50) DEFAULT NULL,
  `prd_size` enum('s','m','l','xl','xxl','xs') DEFAULT NULL,
  `prd_image` varchar(255) NOT NULL,
  `user_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `update_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `prd_name`, `prd_quantity`, `prd_price`, `prd_brand_name`, `prd_discount`, `prd_size`, `prd_image`, `user_id`, `category_id`, `created_at`, `update_at`) VALUES
(6, 'FCB_TSHIRT', '9', '100$', 'NIKE', '0%', 'xxl', 'IMG-1979497394.jpg', 6, 15, '2023-08-01 15:59:15', NULL),
(9, 'FCB_TSHIRT', '10', '100$', 'NIKE', '0%', '', 'IMG-1979497394.jpg', 6, 14, '2023-08-01 16:01:50', NULL),
(10, 'FCB_TSHIRT', '20', '100$', 'NIKE', '0%', 'xxl', 'IMG-890166524.jpg', 6, 14, '2023-08-01 16:38:48', NULL),
(11, 'RMD_TSHIRT', '100', '100$', 'PUMA', '20%', 'xxl', 'IMG-2119150098.jpeg', 13, 15, '2023-08-02 23:32:05', NULL),
(12, 'FCB_TSHIRT', '400', '100$', 'NIKE', '20%', NULL, 'IMG-329009484.jpg', 13, 15, '2023-08-03 01:30:57', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(255) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `profile_img` varchar(255) DEFAULT NULL,
  `role` enum('admin','user') NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `update_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `profile_img`, `role`, `created_at`, `update_at`) VALUES
(1, 'mohamedsebai', 'mohamedseabeai@gmail.com', '123456', 'img-ms.jpg', 'admin', '2023-07-25 13:21:12', '2023-07-25 15:20:42'),
(2, 'mohamed khalifa', 'mohamedkhalifa@gmail.com', '12345', 'img-kh.jpg', 'admin', '2023-07-25 13:22:08', '2023-07-25 15:21:23'),
(6, 'mohamedseabeai', 'mohamedseabeaiss@gmail.com', '$2y$10$HKi1R3zVarJqBS6SKVqGI.UfwbO0XITdZAGek4PV6CI0eKOgfLUOm', 'IMG-549264080.jpg', 'admin', '2023-07-31 16:54:14', '0000-00-00 00:00:00'),
(13, 'mohamedseabeaiuser', 'mohamedseabeaiuser@gmail.com', '$2y$10$qDT8ivJLuBO7ruJEYojsDeoiUWLOQydSmVcNZ6Q2yFyvLwPn2vquG', 'IMG-788209037.jpeg', 'user', '2023-08-02 23:18:50', '0000-00-00 00:00:00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `carts`
--
ALTER TABLE `carts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `users_conts_for_cart` (`user_id`),
  ADD KEY `products_conts_for_cart` (`product_id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cat_belong_to_user` (`user_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `prd_const` (`product_id`),
  ADD KEY `user_const` (`users_id`);

--
-- Indexes for table `phones`
--
ALTER TABLE `phones`
  ADD PRIMARY KEY (`id`),
  ADD KEY `phone_belong_to_user` (`user_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `belong_to_user` (`user_id`),
  ADD KEY `belong_to_category` (`category_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `carts`
--
ALTER TABLE `carts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `phones`
--
ALTER TABLE `phones`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `carts`
--
ALTER TABLE `carts`
  ADD CONSTRAINT `products_conts_for_cart` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `users_conts_for_cart` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `categories`
--
ALTER TABLE `categories`
  ADD CONSTRAINT `cat_belong_to_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `prd_const` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `user_const` FOREIGN KEY (`users_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `phones`
--
ALTER TABLE `phones`
  ADD CONSTRAINT `phone_belong_to_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `belong_to_category` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `belong_to_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
