-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 15, 2019 at 08:59 PM
-- Server version: 10.4.8-MariaDB
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
-- Database: `retail_business`
--

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `reg_date` date NOT NULL DEFAULT current_timestamp(),
  `expaire_date` date NOT NULL,
  `id_card` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `wifi_plan` int(11) NOT NULL,
  `monthly_bill` int(11) NOT NULL,
  `payment_method` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `agent_name` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bill_address` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `router_id` int(11) DEFAULT NULL,
  `note` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`id`, `name`, `reg_date`, `expaire_date`, `id_card`, `phone`, `address`, `wifi_plan`, `monthly_bill`, `payment_method`, `email`, `agent_name`, `bill_address`, `router_id`, `note`, `created_at`, `updated_at`) VALUES
(10, 'Shaiful 632432', '2019-11-14', '2019-12-14', '1573837933_screencapture-resume-uno-resume-23c3ed3d-5d63-4c51-8ab3-c8b5773c570e-preview-2019-11-14-01_05_22 (1).png', '45454', 'werwe', 3765, 6666, 'BP', 'mohosinmiah.iubat@gmail.com', 'gg', 'fdgfd', NULL, 'hjgjh', '2019-11-12 17:41:08', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
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
(4, '2019_11_08_153531_create_customers_table', 1),
(5, '2019_11_09_182756_create_payments_table', 2),
(6, '2019_11_13_184905_create_roters_table', 3);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `password_resets`
--

INSERT INTO `password_resets` (`email`, `token`, `created_at`) VALUES
('hamza@gmail.com', '$2y$10$2qJ.9UFw54Et2WcM6Ssb1e.Gbjp2HYhbyezFB3njmUuFCWRhnwTm2', '2019-11-15 12:40:35');

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `cust_id` int(11) NOT NULL,
  `staf_id` int(11) NOT NULL,
  `pay_date` date NOT NULL,
  `expir_date` date NOT NULL,
  `report_date` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `pay_amount` double(8,2) NOT NULL,
  `payment_method` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` int(11) NOT NULL,
  `due` double(8,2) NOT NULL,
  `note` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `payments`
--

INSERT INTO `payments` (`id`, `cust_id`, `staf_id`, `pay_date`, `expir_date`, `report_date`, `pay_amount`, `payment_method`, `status`, `due`, `note`, `created_at`, `updated_at`) VALUES
(26, 10, 1, '2019-12-13', '2020-01-12', '2019-12', 4000.00, 'SPB', 1, 0.00, NULL, '2019-11-14 22:16:08', NULL),
(27, 12, 1, '2019-10-01', '2019-10-31', '2019-10', 4.00, 'SPB', 1, 0.00, NULL, '2019-11-14 22:16:17', NULL),
(28, 10, 1, '2020-02-11', '2020-03-10', '2020-02', 4000.00, 'SPB', 1, 0.00, NULL, '2019-11-14 22:33:37', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `roters`
--

CREATE TABLE `roters` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` double(8,2) NOT NULL,
  `qty` int(11) NOT NULL,
  `sell` int(11) NOT NULL DEFAULT 0,
  `picture` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `note` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roters`
--

INSERT INTO `roters` (`id`, `name`, `model`, `price`, `qty`, `sell`, `picture`, `note`, `created_at`, `updated_at`) VALUES
(2, 'D LINK 1 t', '0022', 400.00, 5, 0, '1573759016_screencapture-resume-uno-resume-23c3ed3d-5d63-4c51-8ab3-c8b5773c570e-preview-2019-11-14-01_05_22 (1).png', 'eqrq', '2019-11-13 23:00:52', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `roll` int(11) NOT NULL DEFAULT 2,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `roll`, `remember_token`, `created_at`, `updated_at`) VALUES
(2, 'Admin', 'admin@gmail.com', NULL, '$2y$10$vqRbBHiJJhi0Zwb8IHKn8.2CKbQcg8byqfuApximt.um3Dn5jNOwq', 3, 'jsm89SUr3v51aMpKr1p7p53Vy4sQCMMjKP2iuO3a9IcI0JB4qOVu7ZMEqXvJ', '2019-11-15 12:15:56', '2019-11-15 12:15:56'),
(4, 'Hamza 34', 'hamza22@gmail.com', NULL, '$2y$10$LrQepSGhA7lc/okoEnm62uVGuLnfDhHwuV/Mc6eifVO/HZKQfFQG.', 2, NULL, '2019-11-15 13:57:52', '2019-11-15 13:57:52');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `roters`
--
ALTER TABLE `roters`
  ADD PRIMARY KEY (`id`);

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
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `roters`
--
ALTER TABLE `roters`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
