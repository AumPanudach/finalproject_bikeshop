-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Oct 17, 2023 at 03:32 PM
-- Server version: 8.0.17
-- PHP Version: 7.3.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bikeshopdb2`
--

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'อะไหล่', NULL, NULL),
(2, 'เครื่องแต่งกาย', NULL, NULL),
(3, 'รองเท้า', NULL, NULL),
(4, 'แว่นตา', NULL, NULL),
(5, 'อุปกรณ์เสริม', NULL, NULL),
(6, 'อิเล็กทรอนิกส์', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(15, '2023_08_10_131213_create_category_table', 2),
(16, '2023_08_10_131517_create_product_table', 2),
(17, '2023_10_16_064531_create_order_table', 2),
(18, '2023_10_16_064548_create_order_detail_table', 2);

-- --------------------------------------------------------

--
-- Table structure for table `order`
--

CREATE TABLE `order` (
  `id` int(10) UNSIGNED NOT NULL,
  `order_name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `order_email` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `serial_po` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `status` int(11) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `order`
--

INSERT INTO `order` (`id`, `order_name`, `order_email`, `serial_po`, `user_id`, `status`, `created_at`, `updated_at`) VALUES
(1, 'boss', 'bosscraft500@gmail.com', 'PO202310171', 6, 0, '2023-10-17 07:52:26', '2023-10-17 07:52:26'),
(2, 'bump', 'bump@gmail.com', 'PO202310172', 5, 1, '2023-10-17 07:53:26', '2023-10-17 07:53:36'),
(3, 'Pokpong', 'p@gmail.com', 'PO202310173', 11, 1, '2023-10-17 07:55:37', '2023-10-17 07:56:11'),
(4, 'Pokpong', 'p@gmail.com', 'PO202310174', 11, 0, '2023-10-17 08:02:43', '2023-10-17 08:02:43'),
(5, 'Pokpong', 'p@gmail.com', 'PO202310175', 11, 0, '2023-10-17 15:03:29', '2023-10-17 15:03:29'),
(6, 'Pokpong', 'p@gmail.com', 'PO202310176', 11, 0, '2023-10-17 15:10:22', '2023-10-17 15:10:22'),
(7, 'Pokpong', 'p@gmail.com', 'PO202310177', 11, 0, '2023-10-17 15:15:10', '2023-10-17 15:15:10'),
(8, 'Pokpong', 'p@gmail.com', 'PO202310178', 11, 0, '2023-10-17 15:20:13', '2023-10-17 15:20:13'),
(9, 'Pokpong', 'p@gmail.com', 'PO202310179', 11, 0, '2023-10-17 15:28:44', '2023-10-17 15:28:44');

-- --------------------------------------------------------

--
-- Table structure for table `order_detail`
--

CREATE TABLE `order_detail` (
  `id` int(10) UNSIGNED NOT NULL,
  `order_id` int(10) UNSIGNED NOT NULL,
  `product_name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `qty` int(10) UNSIGNED NOT NULL,
  `price` double(8,2) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `order_detail`
--

INSERT INTO `order_detail` (`id`, `order_id`, `product_name`, `qty`, `price`, `created_at`, `updated_at`) VALUES
(1, 1, 'ใบจาร', 1, 300.00, '2023-10-17 07:52:26', '2023-10-17 07:52:26'),
(2, 1, 'UVEX', 1, 6450.00, '2023-10-17 07:52:26', '2023-10-17 07:52:26'),
(3, 1, 'เกียร์', 1, 369.00, '2023-10-17 07:52:26', '2023-10-17 07:52:26'),
(4, 2, 'เสือหมอบ JAVA', 1, 11900.00, '2023-10-17 07:53:26', '2023-10-17 07:53:26'),
(5, 2, 'OAKLEY', 1, 2500.00, '2023-10-17 07:53:26', '2023-10-17 07:53:26'),
(6, 3, 'เกียร์', 1, 369.00, '2023-10-17 07:55:37', '2023-10-17 07:55:37'),
(7, 3, 'ยาง', 1, 10.00, '2023-10-17 07:55:38', '2023-10-17 07:55:38'),
(8, 3, 'ใบจาร', 1, 300.00, '2023-10-17 07:55:38', '2023-10-17 07:55:38'),
(9, 3, 'OAKLEY', 2, 2500.00, '2023-10-17 07:55:38', '2023-10-17 07:55:38'),
(10, 3, 'เสือหมอบ JAVA', 1, 11900.00, '2023-10-17 07:55:38', '2023-10-17 07:55:38'),
(11, 4, 'เสือหมอบ JAVA', 2, 11900.00, '2023-10-17 08:02:43', '2023-10-17 08:02:43'),
(12, 5, 'ใบจาร', 1, 300.00, '2023-10-17 15:03:29', '2023-10-17 15:03:29'),
(13, 6, 'เสือหมอบ วินเทจ Cannello Silvia', 1, 5000.00, '2023-10-17 15:10:22', '2023-10-17 15:10:22'),
(14, 7, 'เสือหมอบ วินเทจ Cannello Silvia', 1, 5000.00, '2023-10-17 15:15:10', '2023-10-17 15:15:10'),
(15, 8, 'เสือหมอบ วินเทจ Cannello Silvia', 1, 5000.00, '2023-10-17 15:20:13', '2023-10-17 15:20:13'),
(16, 9, 'เสือหมอบ วินเทจ Cannello Silvia', 1, 5000.00, '2023-10-17 15:28:44', '2023-10-17 15:28:44'),
(17, 9, 'UVEX', 1, 6450.00, '2023-10-17 15:28:44', '2023-10-17 15:28:44');

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `id` int(10) UNSIGNED NOT NULL,
  `code` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `category_id` int(10) UNSIGNED NOT NULL,
  `price` double(8,2) DEFAULT NULL,
  `stock_qty` int(11) DEFAULT NULL,
  `image_url` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`id`, `code`, `name`, `category_id`, `price`, `stock_qty`, `image_url`, `created_at`, `updated_at`) VALUES
(1, 'P001', 'เสือหมอบ JAVA', 1, 11900.00, 2, 'upload/images/2.png', NULL, '2023-10-17 07:45:51'),
(2, 'P002', 'เสือหมอบ วินเทจ Cannello Silvia', 1, 5000.00, 4, 'upload/images/3.jpg', NULL, '2023-10-17 07:45:58'),
(3, 'P003', 'เสือหมอบ Panther March', 1, 6500.00, 2, 'upload/images/66.jpg', NULL, '2023-10-17 07:51:25'),
(4, 'P004', 'ใบจาร', 5, 300.00, 20, 'upload/images/4.jpg', '2023-10-17 07:46:45', '2023-10-17 07:47:15'),
(5, 'P005', 'เกียร์', 5, 369.00, 3, 'upload/images/5.jpg', '2023-10-17 07:47:56', '2023-10-17 07:47:56'),
(6, 'P006', 'ยาง', 5, 10.00, 69, 'upload/images/6.jpg', '2023-10-17 07:48:40', '2023-10-17 07:48:40'),
(7, 'P007', 'OAKLEY', 4, 2500.00, 5, 'upload/images/11.jpg', '2023-10-17 07:50:15', '2023-10-17 07:50:15'),
(8, 'P008', 'UVEX', 4, 6450.00, 6, 'upload/images/22.jpg', '2023-10-17 07:50:50', '2023-10-17 07:50:50');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(5, 'bump', 'bump@gmail.com', NULL, '$2y$10$YnQ1k3HBJP6zwVfTXc5SIOnJc0yxa29tUehMAdLagrjIvt7SHVu5y', NULL, '2023-10-17 01:12:20', '2023-10-17 01:12:20'),
(6, 'boss', 'bosscraft500@gmail.com', NULL, '$2y$10$O2mIdk5WJv1wRkNK2pRy1uF/HPyUonB2WSJDmzJKl6mGE1/c5WUBK', NULL, '2023-10-17 02:06:42', '2023-10-17 02:06:42'),
(11, 'Pokpong', 'p@gmail.com', NULL, '$2y$10$QsFTt3uZxEE3AG1NWmw6aOu7e6lJe2VOnvqO05kO5k4gkPf1oWrru', NULL, '2023-10-17 07:54:04', '2023-10-17 07:54:04');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order`
--
ALTER TABLE `order`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_user_id_foreign` (`user_id`);

--
-- Indexes for table `order_detail`
--
ALTER TABLE `order_detail`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_detail_order_id_foreign` (`order_id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_category_id_foreign` (`category_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `order`
--
ALTER TABLE `order`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `order_detail`
--
ALTER TABLE `order_detail`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `order`
--
ALTER TABLE `order`
  ADD CONSTRAINT `order_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `order_detail`
--
ALTER TABLE `order_detail`
  ADD CONSTRAINT `order_detail_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `order` (`id`);

--
-- Constraints for table `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `product_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `category` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
