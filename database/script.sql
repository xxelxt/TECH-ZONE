-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th6 20, 2024 lúc 04:40 AM
-- Phiên bản máy phục vụ: 10.4.32-MariaDB
-- Phiên bản PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `php_final`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `abouts`
--

CREATE TABLE `abouts` (
  `id` int(10) UNSIGNED NOT NULL,
  `icon` varchar(191) NOT NULL,
  `logo` varchar(191) NOT NULL,
  `name` varchar(191) DEFAULT NULL,
  `title` varchar(191) DEFAULT NULL,
  `phone` varchar(191) DEFAULT NULL,
  `email` varchar(191) DEFAULT NULL,
  `address` varchar(191) DEFAULT NULL,
  `linkfanpage` varchar(191) DEFAULT NULL,
  `copyright` varchar(191) DEFAULT NULL,
  `worktime` varchar(191) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `abouts`
--

INSERT INTO `abouts` (`id`, `icon`, `logo`, `name`, `title`, `phone`, `email`, `address`, `linkfanpage`, `copyright`, `worktime`, `created_at`, `updated_at`) VALUES
(1, 'icon.jpg', 'logo.png', 'TechZone', 'Nhóm 3', '0912345678', 'group3@gmail.com', '12 Chùa Bộc, Đống Đa, Hà Nội', 'https://www.facebook.com/hocviennganhang1961', 'TechZone', '7:00 - 17:30', NULL, NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `banners`
--

CREATE TABLE `banners` (
  `id` int(10) UNSIGNED NOT NULL,
  `image` varchar(191) NOT NULL,
  `active` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `banners`
--

INSERT INTO `banners` (`id`, `image`, `active`, `created_at`, `updated_at`) VALUES
(6, 'BbCG-unnamed (2) (1).png', 1, '2024-06-19 22:19:38', '2024-06-19 22:19:38'),
(7, 'SdKp-unnamed (3)2.png', 1, '2024-06-19 22:19:48', '2024-06-19 22:19:48'),
(8, 'yUBb-unnamed (4).png', 1, '2024-06-19 22:19:58', '2024-06-19 22:19:58');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `brands`
--

CREATE TABLE `brands` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) NOT NULL,
  `image` varchar(191) DEFAULT NULL,
  `active` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `brands`
--

INSERT INTO `brands` (`id`, `name`, `image`, `active`, `created_at`, `updated_at`) VALUES
(1, 'Apple', 'iJo1-Apple-Logo.png', 1, '2024-06-19 21:34:19', '2024-06-19 21:35:41'),
(2, 'Lenovo', 'QfHR-Lenovo_logo_2015.svg.png', 1, '2024-06-19 21:34:33', '2024-06-19 21:34:33'),
(3, 'Dell', 'K8F2-Dell-Logo.png', 1, '2024-06-19 21:34:44', '2024-06-19 21:36:20'),
(4, 'MSI', 'OF8u-MSI-Logo.jpg', 1, '2024-06-19 21:34:57', '2024-06-19 21:34:57'),
(5, 'Samsung', '1yxV-Samsung-Symbol.png', 1, '2024-06-19 21:37:20', '2024-06-19 21:37:20'),
(6, 'Sony', 'i8h1-Sony-logo.png', 1, '2024-06-19 21:38:10', '2024-06-19 21:38:10'),
(7, 'Microsoft', 'Q9vS-Microsoft-logo.jpg', 1, '2024-06-19 21:39:05', '2024-06-19 21:39:46'),
(8, 'Nintendo', 'nEQc-Nintendo-Logo-1983.png', 1, '2024-06-19 21:42:45', '2024-06-19 21:42:45'),
(9, 'Asus', 'jop7-Asus-Logo.png', 1, '2024-06-20 01:50:43', '2024-06-20 01:50:43');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `categories`
--

CREATE TABLE `categories` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) NOT NULL,
  `active` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `categories`
--

INSERT INTO `categories` (`id`, `name`, `active`, `created_at`, `updated_at`) VALUES
(1, 'Laptop', 1, '2024-06-19 21:05:01', '2024-06-19 21:05:01'),
(2, 'PC', 1, '2024-06-19 21:05:11', '2024-06-20 01:47:53'),
(3, 'Console', 1, '2024-06-19 21:05:35', '2024-06-19 21:05:35'),
(4, 'Linh kiện máy tính', 1, '2024-06-19 21:06:22', '2024-06-19 21:06:22'),
(5, 'Màn hình máy tính', 1, '2024-06-19 21:06:33', '2024-06-19 21:06:33'),
(6, 'Thiết bị nghe nhìn', 1, '2024-06-19 21:06:58', '2024-06-19 21:06:58'),
(7, 'Thiết bị văn phòng', 1, '2024-06-19 21:08:55', '2024-06-19 21:09:24'),
(8, 'Bàn phím - Chuột', 1, '2024-06-19 21:09:39', '2024-06-19 21:09:39'),
(9, 'Thiết bị - Phụ kiện khác', 1, '2024-06-19 21:09:58', '2024-06-19 21:09:58'),
(10, 'Điện thoại - Phụ kiện', 1, '2024-06-19 22:22:39', '2024-06-19 22:22:39'),
(11, 'Nhà thông minh', 1, '2024-06-19 22:23:48', '2024-06-19 22:23:48');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `discounts`
--

CREATE TABLE `discounts` (
  `id` int(10) UNSIGNED NOT NULL,
  `code` varchar(191) NOT NULL,
  `discounts` int(11) DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `active` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `discounts`
--

INSERT INTO `discounts` (`id`, `code`, `discounts`, `quantity`, `active`, `created_at`, `updated_at`) VALUES
(1, 'NEWZONE30', 30, 30, 1, '2024-06-19 22:25:55', '2024-06-19 22:25:55'),
(2, 'PLAYMORE', 10, 100, 1, '2024-06-19 22:26:36', '2024-06-19 22:26:36');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(191) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `imagelibraries`
--

CREATE TABLE `imagelibraries` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `products_id` int(10) UNSIGNED NOT NULL,
  `image_library` varchar(191) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `imagelibraries`
--

INSERT INTO `imagelibraries` (`id`, `products_id`, `image_library`, `created_at`, `updated_at`) VALUES
(1, 1, 'rhAg-83854_macbook14__1_.jpg', '2024-06-19 22:46:27', '2024-06-19 22:46:27'),
(2, 1, 'CEgf-83854_macbook14__2_.jpg', '2024-06-19 22:46:27', '2024-06-19 22:46:27'),
(3, 1, 'LyEP-83854_macbook14__3_.jpg', '2024-06-19 22:46:27', '2024-06-19 22:46:27'),
(4, 1, 'mow9-83854_macbook14__4_.jpg', '2024-06-19 22:46:27', '2024-06-19 22:46:27'),
(5, 1, 'OUTQ-83854_macbook14__5_.jpg', '2024-06-19 22:46:27', '2024-06-19 22:46:27'),
(6, 2, 'mbBv-82681_laptop_apple_macbook_air__z15s006j7__1.jpg', '2024-06-19 22:51:25', '2024-06-19 22:51:25'),
(7, 2, 'XMbH-82681_laptop_apple_macbook_air__z15s006j7__2.jpg', '2024-06-19 22:51:25', '2024-06-19 22:51:25'),
(8, 2, 'xMdY-82681_laptop_apple_macbook_air__z15s006j7__3.jpg', '2024-06-19 22:51:25', '2024-06-19 22:51:25'),
(9, 2, 'ayup-82681_laptop_apple_macbook_air__z15s006j7__4.jpg', '2024-06-19 22:51:25', '2024-06-19 22:51:25'),
(10, 3, '3S7P-0011421_silver.jpeg', '2024-06-19 23:00:20', '2024-06-19 23:00:20'),
(11, 3, 'Rxwv-0011427_silver.jpeg', '2024-06-19 23:00:20', '2024-06-19 23:00:20'),
(12, 3, 'XeG8-0011425_silver.jpeg', '2024-06-19 23:00:20', '2024-06-19 23:00:20'),
(15, 5, 'hVMr-75589_laptop_lenovo_thinkpad_l14_gen_4__21h1003ava___3_.jpg', '2024-06-19 23:23:58', '2024-06-19 23:23:58'),
(16, 5, 'Tguq-75589_laptop_lenovo_thinkpad_l14_gen_4__21h1003ava___4_.jpg', '2024-06-19 23:23:58', '2024-06-19 23:23:58'),
(17, 5, 'uYcT-75589_laptop_lenovo_thinkpad_l14_gen_4__21h1003ava___5_.jpg', '2024-06-19 23:23:58', '2024-06-19 23:23:58'),
(18, 4, 'RgEc-surface-pro-x_08.jpg', '2024-06-19 23:26:56', '2024-06-19 23:26:56'),
(19, 4, 'yTbE-surface-pro-x_07.jpg', '2024-06-19 23:26:56', '2024-06-19 23:26:56'),
(20, 4, 'xKEw-surface-pro-x_06.jpg', '2024-06-19 23:26:56', '2024-06-19 23:26:56'),
(21, 4, 'VqnB-surface-pro-x_03.jpg', '2024-06-19 23:26:56', '2024-06-19 23:26:56'),
(22, 4, 'YAdO-surface-pro-x_02.jpg', '2024-06-19 23:26:56', '2024-06-19 23:26:56'),
(23, 6, 'TJ6m-76817_laptop_lenovo_ideapad_slim_5_16aih7__83bg004evn__2.jpg', '2024-06-19 23:35:27', '2024-06-19 23:35:27'),
(24, 6, 'DAQn-76817_laptop_lenovo_ideapad_slim_5_16aih7__83bg004evn__4.jpg', '2024-06-19 23:35:27', '2024-06-19 23:35:27'),
(25, 6, 'T66b-76817_laptop_lenovo_ideapad_slim_5_16aih7__83bg004evn__1.jpg', '2024-06-19 23:35:28', '2024-06-19 23:35:28'),
(26, 7, 'YXQ4-77286_laptop_lenovo_yoga_6_14irh8__83e00008vn___4_.jpg', '2024-06-19 23:41:27', '2024-06-19 23:41:27'),
(27, 7, 'jyZA-77286_laptop_lenovo_yoga_6_14irh8__83e00008vn___5_.jpg', '2024-06-19 23:41:27', '2024-06-19 23:41:27'),
(28, 7, '99Kg-77286_laptop_lenovo_yoga_6_14irh8__83e00008vn___2_.jpg', '2024-06-19 23:41:27', '2024-06-19 23:41:27'),
(29, 8, 'Iv5w-76259_laptop_dell_inspiron_14_5430__71015634_.jpg', '2024-06-19 23:47:40', '2024-06-19 23:47:40'),
(30, 8, 'W0Iw-76259_laptop_dell_inspiron_14_5430__71015636_.jpg', '2024-06-19 23:47:40', '2024-06-19 23:47:40'),
(31, 8, 'FNBE-76259_laptop_dell_inspiron_14_5430__71015639_.jpg', '2024-06-19 23:47:40', '2024-06-19 23:47:40'),
(32, 8, 'Eq47-76259_laptop_dell_inspiron_14_5430__71015640_.jpg', '2024-06-19 23:47:40', '2024-06-19 23:47:40'),
(33, 9, 'CkLY-76266_laptop_dell_xps_15_9530__71015717_.jpg', '2024-06-19 23:52:40', '2024-06-19 23:52:40'),
(34, 9, 'YPM6-76266_laptop_dell_xps_15_9530__71015718_.jpg', '2024-06-19 23:52:40', '2024-06-19 23:52:40'),
(35, 10, 'VZlb-81819_may_choi_game_sony_playstation_5_ps5_slim_standard_hang_chinh_hang_4.jpg', '2024-06-19 23:56:14', '2024-06-19 23:56:14'),
(36, 10, 'WJ72-81819_may_choi_game_sony_playstation_5_ps5_slim_standard_hang_chinh_hang_3.jpg', '2024-06-19 23:56:14', '2024-06-19 23:56:14'),
(37, 10, 'wvmh-81819_may_choi_game_sony_playstation_5_ps5_slim_standard_hang_chinh_hang_1.jpg', '2024-06-19 23:56:14', '2024-06-19 23:56:14'),
(38, 11, 'ITj8-83588_may_choi_game_microsoft_xbox_one_series_s_512gb_refurbished_2.jpg', '2024-06-19 23:59:18', '2024-06-19 23:59:18'),
(39, 12, 'virD-71438_may_choi_game_nintendo_switch_gray_v2_0002_3.jpg', '2024-06-20 00:08:50', '2024-06-20 00:08:50'),
(40, 12, '2yOW-71438_may_choi_game_nintendo_switch_gray_v2_0003_4.jpg', '2024-06-20 00:08:50', '2024-06-20 00:08:50'),
(41, 13, 'lfmh-75542_may_choi_game_sony_playstation_5_ps5_standard_marvel_s_spider_man_2_limited_5.jpg', '2024-06-20 00:58:32', '2024-06-20 00:58:32'),
(42, 13, '3eX4-75542_may_choi_game_sony_playstation_5_ps5_standard_marvel_s_spider_man_2_limited_4.jpg', '2024-06-20 00:58:32', '2024-06-20 00:58:32'),
(43, 13, 'xliR-75542_may_choi_game_sony_playstation_5_ps5_standard_marvel_s_spider_man_2_limited_3.jpg', '2024-06-20 00:58:32', '2024-06-20 00:58:32'),
(44, 13, '0W6n-75542_may_choi_game_sony_playstation_5_ps5_standard_marvel_s_spider_man_2_limited_2.jpg', '2024-06-20 00:58:32', '2024-06-20 00:58:32'),
(45, 14, 'BDNg-69970_may_choi_game_sony_playstation_4_ps4_slim_1tb_cuh_2218b_hang_chinh_hang_0000_1.jpg', '2024-06-20 01:01:44', '2024-06-20 01:01:44'),
(46, 14, 'Mjbp-69970_may_choi_game_sony_playstation_4_ps4_slim_1tb_cuh_2218b_hang_chinh_hang_0003_4.jpg', '2024-06-20 01:01:44', '2024-06-20 01:01:44'),
(47, 15, '9o2f-69259_may_choi_game_nintendo_switch_oled_white_trang_0003_4.jpg', '2024-06-20 01:06:04', '2024-06-20 01:06:04'),
(48, 15, 'xGyD-69259_may_choi_game_nintendo_switch_oled_white_trang_0004_5.jpg', '2024-06-20 01:06:04', '2024-06-20 01:06:04'),
(49, 15, 'HSNc-69259_may_choi_game_nintendo_switch_oled_white_trang_0006_7.jpg', '2024-06-20 01:06:04', '2024-06-20 01:06:04'),
(50, 15, 'mrJD-69259_may_choi_game_nintendo_switch_oled_white_trang_0000_1.jpg', '2024-06-20 01:06:04', '2024-06-20 01:06:04'),
(51, 15, '9UmY-69259_may_choi_game_nintendo_switch_oled_white_trang_0002_3.jpg', '2024-06-20 01:06:04', '2024-06-20 01:06:04'),
(52, 16, 'Npa1-70178_may_choi_game_nintendo_switch_neon_red_blue_v2_hop_mau_moi_0002_3.jpg', '2024-06-20 01:06:44', '2024-06-20 01:06:44'),
(53, 16, 'glJI-70178_may_choi_game_nintendo_switch_neon_red_blue_v2_hop_mau_moi_0000_1.jpg', '2024-06-20 01:06:44', '2024-06-20 01:06:44'),
(54, 17, 'XU2F-80916_tay_cam_choi_game_khong_day_xbox_series_x_controller_dream_vapor_special_edition_4.jpg', '2024-06-20 01:34:20', '2024-06-20 01:34:20'),
(55, 17, 'NZA1-80916_tay_cam_choi_game_khong_day_xbox_series_x_controller_dream_vapor_special_edition_3.jpg', '2024-06-20 01:34:20', '2024-06-20 01:34:20'),
(56, 17, 'yH0j-80916_tay_cam_choi_game_khong_day_xbox_series_x_controller_dream_vapor_special_edition_2.jpg', '2024-06-20 01:34:20', '2024-06-20 01:34:20'),
(57, 18, '80PK-82311_tay_cam_choi_game_khong_day_xbox_series_x_controller_nocturnal_vapor_special_edition_4.jpg', '2024-06-20 01:35:04', '2024-06-20 01:35:04'),
(58, 18, '22x7-82311_tay_cam_choi_game_khong_day_xbox_series_x_controller_nocturnal_vapor_special_edition_3.jpg', '2024-06-20 01:35:04', '2024-06-20 01:35:04'),
(59, 18, 'ArdZ-82311_tay_cam_choi_game_khong_day_xbox_series_x_controller_nocturnal_vapor_special_edition_2.jpg', '2024-06-20 01:35:04', '2024-06-20 01:35:04'),
(60, 19, 'nY8e-70222_tay_cam_choi_game_sony_ps5_dualsense_mau_trang_3.jpg', '2024-06-20 01:36:47', '2024-06-20 01:36:47'),
(61, 19, 'feow-70222_tay_cam_choi_game_sony_ps5_dualsense_mau_trang_4.jpg', '2024-06-20 01:36:47', '2024-06-20 01:36:47'),
(62, 19, 'ywiL-70222_tay_cam_choi_game_sony_ps5_dualsense_mau_trang_1.jpg', '2024-06-20 01:36:47', '2024-06-20 01:36:47'),
(63, 20, 'WZSo-66724_tay_cam_choi_game_khong_day_nintendo_switch_pro_controller_super_smash_bros_ultimate_limited_2.jpg', '2024-06-20 01:39:01', '2024-06-20 01:39:01'),
(64, 20, '092d-66724_tay_cam_choi_game_khong_day_nintendo_switch_pro_controller_super_smash_bros_ultimate_limited_1.jpg', '2024-06-20 01:39:01', '2024-06-20 01:39:01'),
(65, 21, 'eeiZ-69987_tay_cam_choi_game_sony_ps5_dualsense_edge_5.jpg', '2024-06-20 01:41:26', '2024-06-20 01:41:26'),
(66, 21, 'mt2H-69987_tay_cam_choi_game_sony_ps5_dualsense_edge_3.jpg', '2024-06-20 01:41:26', '2024-06-20 01:41:26'),
(67, 21, 'j4CG-69987_tay_cam_choi_game_sony_ps5_dualsense_edge_6.jpg', '2024-06-20 01:41:26', '2024-06-20 01:41:26'),
(68, 21, 'rsT7-69987_tay_cam_choi_game_sony_ps5_dualsense_edge_1.jpg', '2024-06-20 01:41:26', '2024-06-20 01:41:26'),
(69, 21, 'Mjjr-69987_tay_cam_choi_game_sony_ps5_dualsense_edge_4.jpg', '2024-06-20 01:41:26', '2024-06-20 01:41:26'),
(70, 21, 'zxxS-69987_tay_cam_choi_game_sony_ps5_dualsense_edge_2.jpg', '2024-06-20 01:41:26', '2024-06-20 01:41:26'),
(71, 22, 'vckJ-83318_pc_asus_all_in_one_a3402wbak_wpc048w_4.jpg', '2024-06-20 01:53:09', '2024-06-20 01:53:09'),
(72, 22, 'h818-83318_pc_asus_all_in_one_a3402wbak_wpc048w_3.jpg', '2024-06-20 01:53:09', '2024-06-20 01:53:09'),
(73, 22, 'ilH4-83318_pc_asus_all_in_one_a3402wbak_wpc048w_2.jpg', '2024-06-20 01:53:09', '2024-06-20 01:53:09'),
(74, 23, 'tI19-81181_bo_mini_pc_asus_intel_nuc13_prodesk_nuc13vyki5_5a.jpg', '2024-06-20 01:56:26', '2024-06-20 01:56:26'),
(75, 23, '1fCj-81181_bo_mini_pc_asus_intel_nuc13_prodesk_nuc13vyki5_4a.jpg', '2024-06-20 01:56:26', '2024-06-20 01:56:26'),
(76, 23, 'VFrB-81181_bo_mini_pc_asus_intel_nuc13_prodesk_nuc13vyki5_3a.jpg', '2024-06-20 01:56:26', '2024-06-20 01:56:26'),
(77, 23, 'HuqK-81181_bo_mini_pc_asus_intel_nuc13_prodesk_nuc13vyki5_2a.jpg', '2024-06-20 01:56:26', '2024-06-20 01:56:26'),
(78, 24, 'VM2w-70906_apple_mac_mini_mmfk3sa_850x850_2.jpg', '2024-06-20 01:57:25', '2024-06-20 01:57:25'),
(79, 24, 'z7kp-70906_apple_mac_mini_mmfk3sa_850x850_5.jpg', '2024-06-20 01:57:25', '2024-06-20 01:57:25'),
(80, 24, 'Y7gs-70906_apple_mac_mini_mmfk3sa_850x850_1.jpg', '2024-06-20 01:57:25', '2024-06-20 01:57:25'),
(81, 25, 'Tjzq-74496_pc_lenovo_all_in_one_thinkcentre_neo_30a_2a.jpg', '2024-06-20 01:58:35', '2024-06-20 01:58:35'),
(82, 25, 'RHjY-74496_pc_lenovo_all_in_one_thinkcentre_neo_30a_24_3.jpg', '2024-06-20 01:58:35', '2024-06-20 01:58:35'),
(83, 25, '9S98-74496_pc_lenovo_all_in_one_thinkcentre_neo_30a_24_1.jpg', '2024-06-20 01:58:35', '2024-06-20 01:58:35'),
(84, 26, 'Mfj6-77897_server_asus_ts100_e11_pi4_2314041z_90sf02n1_m004j0_6.jpg', '2024-06-20 02:05:37', '2024-06-20 02:05:37'),
(85, 26, '08zN-77897_server_asus_ts100_e11_pi4_2314041z_90sf02n1_m004j0_2.jpg', '2024-06-20 02:05:37', '2024-06-20 02:05:37'),
(86, 26, 'CbyH-77897_server_asus_ts100_e11_pi4_2314041z_90sf02n1_m004j0_3.jpg', '2024-06-20 02:05:37', '2024-06-20 02:05:37'),
(87, 26, 'ZEkh-77897_server_asus_ts100_e11_pi4_2314041z_90sf02n1_m004j0_1.jpg', '2024-06-20 02:05:37', '2024-06-20 02:05:37'),
(88, 26, '9dBK-77897_server_asus_ts100_e11_pi4_2314041z_90sf02n1_m004j0_5.jpg', '2024-06-20 02:05:37', '2024-06-20 02:05:37'),
(89, 27, 'CAqK-65774_pc_msi_creator_p50_850x850_6.jpg', '2024-06-20 02:07:12', '2024-06-20 02:07:12'),
(90, 27, '25ge-65774_pc_msi_creator_p50_850x850_9.jpg', '2024-06-20 02:07:12', '2024-06-20 02:07:12'),
(91, 27, 'Ql2S-65774_pc_msi_creator_p50_850x850_4.jpg', '2024-06-20 02:07:12', '2024-06-20 02:07:12'),
(92, 27, 'Ka0q-65774_pc_msi_creator_p50_850x850_3.jpg', '2024-06-20 02:07:12', '2024-06-20 02:07:12'),
(93, 27, 'kYA5-65774_pc_msi_creator_p50_850x850_2.jpg', '2024-06-20 02:07:12', '2024-06-20 02:07:12'),
(94, 28, 'P2w3-75905_mainboard_asus_pro_ws_w790e_sage_se_850x850_4.jpg', '2024-06-20 02:10:53', '2024-06-20 02:10:53'),
(95, 28, '87br-75905_mainboard_asus_pro_ws_w790e_sage_se_850x850_2.jpg', '2024-06-20 02:10:53', '2024-06-20 02:10:53'),
(96, 28, 'KKkl-75905_mainboard_asus_pro_ws_w790e_sage_se_850x850_1.jpg', '2024-06-20 02:10:53', '2024-06-20 02:10:53'),
(97, 29, 'HXSS-66605_pc_asus_rog_strix_g15cf_850x850_3.jpg', '2024-06-20 02:13:04', '2024-06-20 02:13:04'),
(98, 29, '24Uy-66605_pc_asus_rog_strix_g15cf_850x850_5.jpg', '2024-06-20 02:13:04', '2024-06-20 02:13:04'),
(99, 29, 'dApd-66605_pc_asus_rog_strix_g15cf_850x850_6.jpg', '2024-06-20 02:13:04', '2024-06-20 02:13:04'),
(100, 29, '6w7j-66605_pc_asus_rog_strix_g15cf_850x850_7.jpg', '2024-06-20 02:13:04', '2024-06-20 02:13:04'),
(101, 29, 'nodi-66605_pc_asus_rog_strix_g15cf_850x850_8.jpg', '2024-06-20 02:13:04', '2024-06-20 02:13:04'),
(102, 30, 'V5Y6-0022027_airpods-pro-2-usb-c-2023_550.jpeg', '2024-06-20 02:17:36', '2024-06-20 02:17:36'),
(103, 30, 'ugeO-0022026_airpods-pro-2-usb-c-2023_550.jpeg', '2024-06-20 02:17:36', '2024-06-20 02:17:36'),
(104, 30, 'qHcg-0022025_airpods-pro-2-usb-c-2023_550.jpeg', '2024-06-20 02:17:36', '2024-06-20 02:17:36'),
(105, 30, 'MlWq-0022023_airpods-pro-2-usb-c-2023.jpeg', '2024-06-20 02:17:36', '2024-06-20 02:17:36'),
(106, 30, 'frID-0022022_airpods-pro-2-usb-c-2023.jpeg', '2024-06-20 02:17:36', '2024-06-20 02:17:36'),
(107, 31, 'aKjC-0006060_tai-nghe-apple-airpods-3-sac-co-day-lightning.jpeg', '2024-06-20 02:18:44', '2024-06-20 02:18:44'),
(108, 31, 'uGBy-0006059_tai-nghe-apple-airpods-3-sac-co-day-lightning.jpeg', '2024-06-20 02:18:44', '2024-06-20 02:18:44'),
(109, 31, 'z7bm-0006058_tai-nghe-apple-airpods-3-sac-co-day-lightning.jpeg', '2024-06-20 02:18:44', '2024-06-20 02:18:44'),
(110, 33, '5b5q-0012019_space-gray.png', '2024-06-20 02:21:48', '2024-06-20 02:21:48'),
(111, 32, 'Feg6-0022180_earpods-with-usb-c.jpeg', '2024-06-20 02:23:29', '2024-06-20 02:23:29'),
(112, 32, 'VyO7-0022179_earpods-with-usb-c.jpeg', '2024-06-20 02:23:29', '2024-06-20 02:23:29'),
(113, 32, 'KjGn-0022178_earpods-with-usb-c.jpeg', '2024-06-20 02:23:29', '2024-06-20 02:23:29'),
(114, 32, '24Zl-0022177_earpods-with-usb-c.jpeg', '2024-06-20 02:23:29', '2024-06-20 02:23:29');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(191) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(2, '2024_06_16_085530_create_abouts_table', 1),
(3, '2024_06_16_085530_create_banners_table', 1),
(4, '2024_06_16_085530_create_brands_table', 1),
(5, '2024_06_16_085530_create_categories_table', 1),
(6, '2024_06_16_085530_create_discounts_table', 1),
(7, '2024_06_16_085530_create_failed_jobs_table', 1),
(8, '2024_06_16_085530_create_imagelibraries_table', 1),
(9, '2024_06_16_085530_create_model_has_permissions_table', 1),
(10, '2024_06_16_085530_create_model_has_roles_table', 1),
(11, '2024_06_16_085530_create_orders__details_table', 1),
(12, '2024_06_16_085530_create_orders_table', 1),
(13, '2024_06_16_085530_create_password_resets_table', 1),
(14, '2024_06_16_085530_create_permissions_table', 1),
(15, '2024_06_16_085530_create_products_table', 1),
(16, '2024_06_16_085530_create_ratings_table', 1),
(17, '2024_06_16_085530_create_role_has_permissions_table', 1),
(18, '2024_06_16_085530_create_roles_table', 1),
(19, '2024_06_16_085530_create_subcategories_table', 1),
(20, '2024_06_16_085530_create_users_table', 1),
(21, '2024_06_16_085530_create_wishlists_table', 1),
(22, '2024_06_16_085533_add_foreign_keys_to_imagelibraries_table', 1),
(23, '2024_06_16_085533_add_foreign_keys_to_model_has_permissions_table', 1),
(24, '2024_06_16_085533_add_foreign_keys_to_model_has_roles_table', 1),
(25, '2024_06_16_085533_add_foreign_keys_to_orders__details_table', 1),
(26, '2024_06_16_085533_add_foreign_keys_to_orders_table', 1),
(27, '2024_06_16_085533_add_foreign_keys_to_ratings_table', 1),
(28, '2024_06_16_085533_add_foreign_keys_to_role_has_permissions_table', 1),
(29, '2024_06_18_174620_add_payment_status_to_orders_table', 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `model_has_permissions`
--

CREATE TABLE `model_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(191) NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `model_has_permissions`
--

INSERT INTO `model_has_permissions` (`permission_id`, `model_type`, `model_id`) VALUES
(1, 'App\\Models\\User', 1),
(1, 'App\\Models\\User', 3),
(1, 'App\\Models\\User', 4),
(1, 'App\\Models\\User', 5),
(1, 'App\\Models\\User', 6),
(2, 'App\\Models\\User', 1),
(2, 'App\\Models\\User', 3),
(2, 'App\\Models\\User', 4),
(3, 'App\\Models\\User', 1),
(3, 'App\\Models\\User', 3),
(3, 'App\\Models\\User', 4),
(3, 'App\\Models\\User', 5),
(3, 'App\\Models\\User', 6),
(4, 'App\\Models\\User', 1),
(4, 'App\\Models\\User', 3),
(4, 'App\\Models\\User', 4),
(5, 'App\\Models\\User', 1),
(5, 'App\\Models\\User', 3),
(5, 'App\\Models\\User', 4),
(5, 'App\\Models\\User', 5),
(5, 'App\\Models\\User', 6),
(6, 'App\\Models\\User', 1),
(6, 'App\\Models\\User', 3),
(6, 'App\\Models\\User', 4),
(7, 'App\\Models\\User', 1),
(7, 'App\\Models\\User', 3),
(7, 'App\\Models\\User', 4),
(7, 'App\\Models\\User', 5),
(7, 'App\\Models\\User', 6),
(8, 'App\\Models\\User', 1),
(8, 'App\\Models\\User', 3),
(8, 'App\\Models\\User', 4),
(9, 'App\\Models\\User', 1),
(9, 'App\\Models\\User', 3),
(9, 'App\\Models\\User', 4),
(9, 'App\\Models\\User', 5),
(9, 'App\\Models\\User', 6),
(10, 'App\\Models\\User', 1),
(10, 'App\\Models\\User', 3),
(10, 'App\\Models\\User', 4),
(11, 'App\\Models\\User', 1),
(11, 'App\\Models\\User', 3),
(11, 'App\\Models\\User', 4),
(11, 'App\\Models\\User', 5),
(11, 'App\\Models\\User', 6),
(12, 'App\\Models\\User', 1),
(12, 'App\\Models\\User', 3),
(12, 'App\\Models\\User', 4),
(13, 'App\\Models\\User', 1),
(13, 'App\\Models\\User', 3),
(13, 'App\\Models\\User', 4),
(13, 'App\\Models\\User', 5),
(13, 'App\\Models\\User', 6),
(14, 'App\\Models\\User', 1),
(14, 'App\\Models\\User', 3),
(14, 'App\\Models\\User', 4),
(15, 'App\\Models\\User', 1),
(15, 'App\\Models\\User', 3),
(15, 'App\\Models\\User', 4),
(16, 'App\\Models\\User', 1),
(16, 'App\\Models\\User', 3),
(16, 'App\\Models\\User', 4),
(17, 'App\\Models\\User', 1),
(17, 'App\\Models\\User', 3),
(17, 'App\\Models\\User', 4),
(17, 'App\\Models\\User', 5),
(17, 'App\\Models\\User', 6),
(18, 'App\\Models\\User', 1),
(18, 'App\\Models\\User', 3),
(18, 'App\\Models\\User', 4),
(19, 'App\\Models\\User', 1),
(19, 'App\\Models\\User', 3),
(19, 'App\\Models\\User', 4),
(20, 'App\\Models\\User', 1),
(20, 'App\\Models\\User', 3),
(20, 'App\\Models\\User', 4),
(20, 'App\\Models\\User', 5),
(20, 'App\\Models\\User', 6),
(21, 'App\\Models\\User', 1),
(21, 'App\\Models\\User', 3),
(21, 'App\\Models\\User', 4),
(22, 'App\\Models\\User', 1),
(22, 'App\\Models\\User', 3),
(22, 'App\\Models\\User', 4),
(22, 'App\\Models\\User', 5),
(22, 'App\\Models\\User', 6),
(23, 'App\\Models\\User', 1),
(23, 'App\\Models\\User', 3),
(23, 'App\\Models\\User', 4),
(24, 'App\\Models\\User', 1),
(24, 'App\\Models\\User', 3),
(24, 'App\\Models\\User', 4),
(24, 'App\\Models\\User', 5),
(24, 'App\\Models\\User', 6),
(25, 'App\\Models\\User', 1),
(25, 'App\\Models\\User', 3),
(25, 'App\\Models\\User', 4);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `model_has_roles`
--

CREATE TABLE `model_has_roles` (
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(191) NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `model_has_roles`
--

INSERT INTO `model_has_roles` (`role_id`, `model_type`, `model_id`) VALUES
(1, 'App\\Models\\User', 1),
(2, 'App\\Models\\User', 3),
(2, 'App\\Models\\User', 4),
(2, 'App\\Models\\User', 5),
(2, 'App\\Models\\User', 6),
(3, 'App\\Models\\User', 2),
(3, 'App\\Models\\User', 7);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `orders`
--

CREATE TABLE `orders` (
  `id` int(10) UNSIGNED NOT NULL,
  `users_id` int(10) UNSIGNED NOT NULL,
  `lastname` varchar(191) NOT NULL,
  `firstname` varchar(191) NOT NULL,
  `address` varchar(191) NOT NULL,
  `district` varchar(191) NOT NULL,
  `city` varchar(191) NOT NULL,
  `phone` varchar(191) NOT NULL,
  `email` varchar(191) NOT NULL,
  `content` longtext DEFAULT NULL,
  `total` int(11) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `payment_status` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `orders`
--

INSERT INTO `orders` (`id`, `users_id`, `lastname`, `firstname`, `address`, `district`, `city`, `phone`, `email`, `content`, `total`, `status`, `payment_status`, `created_at`, `updated_at`) VALUES
(1, 7, 'Nguyễn Văn', 'An', '21 Chùa Bộc', 'Đống Đa', 'Hà Nội', '0967895432', 'testkhachhang10@gmail.com', NULL, 12990000, 3, 2, '2024-06-20 02:31:17', '2024-06-20 02:40:09'),
(2, 2, 'Lê', 'Quỳnh Chi', '1 Phạm Ngọc Thạch', 'Đống Đa', 'Hà Nội', '0876543219', 'finalphp302@gmail.com', NULL, 5490000, 1, 2, '2024-06-20 02:33:25', '2024-06-20 02:34:01');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `orders__details`
--

CREATE TABLE `orders__details` (
  `orders_id` int(10) UNSIGNED NOT NULL,
  `product_id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) NOT NULL,
  `image` varchar(191) NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `orders__details`
--

INSERT INTO `orders__details` (`orders_id`, `product_id`, `name`, `image`, `quantity`, `price`, `created_at`, `updated_at`) VALUES
(1, 10, 'Sony PlayStation 5 (PS5) Slim Standard', 'pnAF-81819_may_choi_game_sony_playstation_5_ps5_slim_standard_hang_chinh_hang_2.jpg', 1, 12990000, '2024-06-20 02:31:17', '2024-06-20 02:31:17'),
(2, 30, 'AirPods Pro 2 (USB-C) (2023)', 'vtEv-0022024_airpods-pro-2-usb-c-2023.jpeg', 1, 5490000, '2024-06-20 02:33:25', '2024-06-20 02:33:25');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(191) NOT NULL,
  `token` varchar(191) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `permissions`
--

CREATE TABLE `permissions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) NOT NULL,
  `guard_name` varchar(191) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `permissions`
--

INSERT INTO `permissions` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'list category', 'web', '2024-06-19 20:58:20', '2024-06-19 20:58:20'),
(2, 'add category', 'web', '2024-06-19 20:58:20', '2024-06-19 20:58:20'),
(3, 'edit category', 'web', '2024-06-19 20:58:20', '2024-06-19 20:58:20'),
(4, 'delete category', 'web', '2024-06-19 20:58:20', '2024-06-19 20:58:20'),
(5, 'list brands', 'web', '2024-06-19 20:58:20', '2024-06-19 20:58:20'),
(6, 'add brands', 'web', '2024-06-19 20:58:20', '2024-06-19 20:58:20'),
(7, 'edit brands', 'web', '2024-06-19 20:58:20', '2024-06-19 20:58:20'),
(8, 'delete brands', 'web', '2024-06-19 20:58:20', '2024-06-19 20:58:20'),
(9, 'list products', 'web', '2024-06-19 20:58:20', '2024-06-19 20:58:20'),
(10, 'add products', 'web', '2024-06-19 20:58:20', '2024-06-19 20:58:20'),
(11, 'edit products', 'web', '2024-06-19 20:58:20', '2024-06-19 20:58:20'),
(12, 'delete products', 'web', '2024-06-19 20:58:20', '2024-06-19 20:58:20'),
(13, 'list users', 'web', '2024-06-19 20:58:20', '2024-06-19 20:58:20'),
(14, 'delete users', 'web', '2024-06-19 20:58:21', '2024-06-19 20:58:21'),
(15, 'list discounts', 'web', '2024-06-19 20:58:21', '2024-06-19 20:58:21'),
(16, 'add discounts', 'web', '2024-06-19 20:58:21', '2024-06-19 20:58:21'),
(17, 'edit discounts', 'web', '2024-06-19 20:58:21', '2024-06-19 20:58:21'),
(18, 'delete discounts', 'web', '2024-06-19 20:58:21', '2024-06-19 20:58:21'),
(19, 'list orders', 'web', '2024-06-19 20:58:21', '2024-06-19 20:58:21'),
(20, 'edit orders', 'web', '2024-06-19 20:58:21', '2024-06-19 20:58:21'),
(21, 'delete orders', 'web', '2024-06-19 20:58:21', '2024-06-19 20:58:21'),
(22, 'list banners', 'web', '2024-06-19 20:58:21', '2024-06-19 20:58:21'),
(23, 'add banners', 'web', '2024-06-19 20:58:21', '2024-06-19 20:58:21'),
(24, 'edit banners', 'web', '2024-06-19 20:58:21', '2024-06-19 20:58:21'),
(25, 'delete banners', 'web', '2024-06-19 20:58:21', '2024-06-19 20:58:21');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(191) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `products`
--

CREATE TABLE `products` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) NOT NULL,
  `categories_id` bigint(20) UNSIGNED NOT NULL,
  `users_id` bigint(20) UNSIGNED NOT NULL,
  `brands_id` bigint(20) UNSIGNED NOT NULL,
  `sub_id` bigint(20) UNSIGNED NOT NULL,
  `size` varchar(191) DEFAULT NULL,
  `price` double DEFAULT NULL,
  `price_new` double DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `image` varchar(191) DEFAULT NULL,
  `link` varchar(191) DEFAULT NULL,
  `content` longtext DEFAULT NULL,
  `featured_product` int(11) NOT NULL DEFAULT 0,
  `active` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `products`
--

INSERT INTO `products` (`id`, `name`, `categories_id`, `users_id`, `brands_id`, `sub_id`, `size`, `price`, `price_new`, `quantity`, `image`, `link`, `content`, `featured_product`, `active`, `created_at`, `updated_at`) VALUES
(1, 'Apple MacBook Pro 14 inch 2023 M3 (16GB/512GB SSD)', 1, 1, 1, 1, NULL, 44990000, 44490000, 30, 'zuMe-83854_macbook14__6_.jpg', NULL, '<p><img src=\"https://hanoicomputercdn.com/media/lib/18-12-2023/macbook-m3-mota1.jpg\" alt=\"Apple Macbook Pro 14 (MRX43SA/A) \"></p><p><img src=\"https://hanoicomputercdn.com/media/lib/18-12-2023/macbook-m3-mota2.jpg\" alt=\"Apple Macbook Pro 14 (MRX43SA/A) \"></p><p><img src=\"https://hanoicomputercdn.com/media/lib/18-12-2023/macbook-m3-mota3.jpg\" alt=\"Apple Macbook Pro 14 (MRX43SA/A) \"></p><p><img src=\"https://hanoicomputercdn.com/media/lib/18-12-2023/macbook-m3-mota4.jpg\" alt=\"Apple Macbook Pro 14 (MRX43SA/A) \"></p>', 1, 1, '2024-06-19 22:46:27', '2024-06-19 23:02:14'),
(2, 'Apple MacBook Air 15.3 inch M2 (8GB/ 256GB SSD/8C CPU/10C GPU)', 1, 1, 1, 1, NULL, 34790000, 27290000, 50, '799I-82681_laptop_apple_macbook_air__z15s006j7_.jpg', NULL, '<h3><strong>Thiết kế hoàn hảo</strong></h3><p>Mặc dù có ngoại hình mỏng và khối lượng nhẹ hơn song MacBook Air mới vẫn không kém phần chắc chắn, độ hoàn thiện tốt so với trước đây. Khung máy cứng, nắp máy gần như không uốn cong khi mình tác động lực và vẫn có thể mở lên bằng một ngón tay. Apple luôn đứng đầu khi nói đến chất lượng sản xuất và chiếc Air mới cũng không ngoại lệ.</p><p><img src=\"https://hanoicomputercdn.com/media/lib/07-06-2024/laptopapplemacbookair2.jpeg\" alt=\"Laptop Apple Macbook Air (Z15S006J7) (Apple M2/8C CPU/10C GPU/16GB RAM/256GB SSD/13.6/Mac OS/Xám) 1 \"></p><p>&nbsp;</p><h3><strong>Phá vỡ mọi giới hạn nhờ sức mạnh từ bộ vi xử lý Apple M2</strong></h3><p>Bộ vi xử lý Apple M2 tuy có mặt cấu tạo tương đồng với M1 nhưng hiệu suất hoạt động cao hơn 18% và nhanh hơn 1.9 lần so với các dòng laptop sở hữu bộ vi xử lý 10 lõi khác, dư sức cân mọi tác vụ từ học tập, làm việc đến đồ họa đến kỹ thuật chuyên sâu. Đồ họa GPU 8 nhân cho khả năng hoạt động mạnh mẽ hơn 35%, xử lý lên đến 15.8 nghìn tỷ tác vụ trong 1 giây nên các công việc liên quan đến hình ảnh, đồ họa, video,... đều được giải quyết rất mượt mà.</p><p><img src=\"https://hanoicomputercdn.com/media/lib/07-06-2024/laptopapplemacbookair3.jpeg\" alt=\"Laptop Apple Macbook Air (Z15S006J7) (Apple M2/8C CPU/10C GPU/16GB RAM/256GB SSD/13.6/Mac OS/Xám) 2 \"></p><h3><strong>Cân mọi tác vụ với 16GB RAM</strong></h3><p>Máy đáp ứng hoàn hảo việc chỉnh sửa video và ảnh nhẹ, đặc biệt nếu bạn sử dụng ứng dụng Ảnh hoặc iMovie của Apple cho các tác vụ đó. Laptop RAM 16GB cho phép mình sử dụng cùng lúc nhiều cửa sổ ứng dụng khác nhau với độ đa nhiệm mượt mà đáng kể, vừa làm việc trên Photoshop vừa nghe nhạc vẫn rất trơn tru.</p><p><img src=\"https://hanoicomputercdn.com/media/lib/07-06-2024/laptopapplemacbookair4.jpeg\" alt=\"Laptop Apple Macbook Air (Z15S006J7) (Apple M2/8C CPU/10C GPU/16GB RAM/256GB SSD/13.6/Mac OS/Xám) 3 \"></p><p>Không gian ổ cứng SSD 256 GB vừa đủ cho các tài liệu, ứng dụng học tập.</p><p><img src=\"https://hanoicomputercdn.com/media/lib/07-06-2024/laptopapplemacbookair6.jpeg\" alt=\"Laptop Apple Macbook Air (Z15S006J7) (Apple M2/8C CPU/10C GPU/16GB RAM/256GB SSD/13.6/Mac OS/Xám) 4 \"></p><h3><strong>Linh hoạt trong phương thức tương tác</strong></h3><p>Phiên bản MacBook Air M2 tiếp tục duy trì phương thức sạc qua cổng MagSafe – cực kỳ tiện lợi cho thao tác kết nối, tháo lắp nhờ cơ chế từ tính thông minh. Nhằm tối ưu khả năng tương tác cho sản phẩm, Apple đặt ở cạnh trái của máy hai cổng Thunderbolt với nhiều ưu thế về năng lực kết nối. Sự hỗ trợ của Thunderbolt cho phép chủ nhân MacBook Air M2 xuất tín hiệu hình ảnh 6K ra màn hình ngoài. Ngoài ra, cổng âm thanh 3.5 mm quen thuộc vẫn được hiện diện ở cạnh phải thiết bị.<img src=\"https://hanoicomputercdn.com/media/lib/07-06-2024/laptopapplemacbookair7.jpeg\" alt=\"Laptop Apple Macbook Air (Z15S006J7) (Apple M2/8C CPU/10C GPU/16GB RAM/256GB SSD/13.6/Mac OS/Xám) 5 \"></p><h3><strong>Truy cập siêu tốc nhờ Touch ID</strong></h3><p>Hệ thống bàn phím Magic Keyboard đem lại cảm nhận mượt mà khi soạn thảo văn bản. Thiết kế thông minh đem tới trải nghiệm thoải mái mà vẫn yên tĩnh khi sử dụng.</p><p>Apple đã bố trí công nghệ nhận diện vân tay Touch ID ở góc phải thiết bị, giúp chủ nhân MacBook Air M2 2022 dễ dàng đăng nhập vào màn hình chính mà không cần phải gõ mật khẩu rườm rà, đồng thời nhanh chóng xác thực khi tiến hành giao dịch trên môi trường internet. Không gian cảm ứng Force Touch lớn hỗ trợ tối ưu cho quá trình thao tác với độ nhạy và chính xác rất cao.</p><p><img src=\"https://hanoicomputercdn.com/media/lib/07-06-2024/laptopapplemacbookair1.jpeg\" alt=\"Laptop Apple Macbook Air (Z15S006J7) (Apple M2/8C CPU/10C GPU/16GB RAM/256GB SSD/13.6/Mac OS/Xám) 6 \"></p>', 1, 1, '2024-06-19 22:51:25', '2024-06-20 01:59:24'),
(3, 'Apple MacBook Pro 14 inch (M2 Pro/ 16GB/ SSD 512GB)', 1, 1, 1, 1, NULL, 45990000, NULL, 10, 'WRNN-0011420_silver.jpeg', NULL, '<figure class=\"image\"><img src=\"https://shopdunk.com/images/uploaded/pro1.jpg\"></figure><figure class=\"image\"><img src=\"https://shopdunk.com/images/uploaded/pro2.jpg\"></figure><figure class=\"image\"><img src=\"https://shopdunk.com/images/uploaded/pro3.jpg\"></figure><figure class=\"image\"><img src=\"https://shopdunk.com/images/uploaded/pro4.jpg\"></figure>', 1, 1, '2024-06-19 23:00:20', '2024-06-19 23:00:20'),
(4, 'Microsoft Surface Pro X SQ1/8GB/128GB LTE', 1, 1, 7, 4, NULL, 21490000, NULL, 10, 'Th6S-1691377383_2076_a7aee58cb73c391eaa4241c86d1a7c94.png', NULL, NULL, 1, 1, '2024-06-19 23:13:51', '2024-06-19 23:26:56'),
(5, 'Lenovo ThinkPad L14 Gen 4 (21H1003AVA) (i7-1360P/16GB RAM/512GB SSD)', 1, 1, 2, 2, NULL, 24890000, NULL, 20, 'sp3d-75589_laptop_lenovo_thinkpad_l14_gen_4__21h1003ava___1_.jpg', NULL, '<h3>Đơn giản, mỏng nhẹ nhưng rất sang trọng</h3><p>Laptop Lenovo ThinkPad L14 GEN 4 21H1003AVA với form khối với đường nét vuông vức và đậm tính di động. sở hữu độ mỏng chỉ 19.6 mm cùng trọng lượng 1,4 kg nên chiếc laptop này rất gọn nhẹ tương đương với một quyển sách nên bạn có thể dễ dàng mang theo nó đến khắp mọi nơi phục vụ cho công việc của mình.</p><p>Cùng tone màu đen sang trọng, đơn giản nên Lenovo ThinkPad L14 phù hợp với bất cứ môi trường sử dụng, bất cứ đối tượng khách hàng, ở mọi độ tuổi, giới tính, phong cách.</p><p>Bản lề của chiếc này được thiết kế với góc mở lên đến 180 độ giúp người dùng có thể tự do điều chỉnh các góc máy sao cho phù hợp nhất với mỗi tình huống thực tế, đặc biệt hữu ích trong môi trường văn phòng cần chia sẻ thông tin với nhau</p><p>Với vỏ nhôm nguyên khối làm cho chiếc laptop này có độ bền bỉ đáng kinh ngạc, đạt tiêu chuẩn độ bền quân đội Mỹ với 12 yêu cầu cấp quân sự và 200 bài kiểm tra chất lượng nên bạn hoàn toàn có thể yên tâm sử dụng lâu dài chiếc máy này</p><h3><img src=\"https://phucanhcdn.com/media/lib/20-12-2023/laptop-lenovo-thinkpad-l14-gen-4-21h1003ava-3.jpg\" alt=\"Laptop Lenovo ThinkPad L14 GEN 4 21H1003AVA\"></h3><h3>Hiệu năng ổn định nâng cấp dễ dàng về sau</h3><p>Sở hữu sức mạnh vượt trội khi được trang bị bộ vi xử lý Core i7 1360P (12 nhân, 16 luồng) cùng xung nhịp tối đa lên đến 5.0 GHz. Core i7 1360P mang đến tốc độ phản hồi các tác vụ nhanh chóng, rút ngắn thời gian chờ đợi khi xử lý những tác vụ nặng và cũng rất tiết kiệm điện</p><p>Kèm với đó là nhân đồ họa Intel Iris Xe Graphics đem đến khả năng xử lý hình ảnh tuyệt vời từ 2D cho đến 3D để bạn đa nhiệm, không chỉ sử dụng với các phần mềm office thông thường mà cả với các phần mềm đồ họa chuyên dụng</p><p>Với 16GB RAM và 512GB SSD Nvme tốc độ cao sẽ đem đến trải nghiệm sử dụng mượt mà mở đến cả chục ứng dụng/tabs và chuyển đổi liên tục giữa chúng mà không gặp bất cứ vấn đề nào để tốc độ làm việc hiệu quả hơn&nbsp;</p><p><img src=\"https://phucanhcdn.com/media/lib/20-12-2023/laptop-lenovo-thinkpad-l14-gen-4-21h1003ava-4.jpg\" alt=\"Laptop Lenovo ThinkPad L14 GEN 4 21H1003AVA\"></p><h3>Đã mắt với màn hình chất lượng</h3><p><a href=\"https://www.phucanh.vn/may-tinh-xach-tay-laptop-lenovo.html\"><strong>Laptop Lenovo</strong></a>&nbsp;ThinkPad L14 GEN 4 sở hữu màn hình 14 inch chất lượng Full HD với tấm nền IPS có độ sáng 250 nits. Chiếc màn hình này đảm bảo hình ảnh luôn nét, màu sắc luôn chuẩn ở mọi góc nhìn dù bạn có nhìn chiếc laptop này ở bất cứ góc độ nào</p><p>Màn hình Lenovo ThinkPad L14 GEN 4 còn trang bị tính năng chống chói Anti-Glare để hình ảnh hiển thị chính xác, chi tiết trong mọi điều kiện ánh sáng dù là gay gắt nhất. Tính năng chống chói này cũng bảo vệ thị lực người dùng và giữ cho mắt dễ chịu, thoải mái khi phải làm việc nhiều giờ liền trước máy tính.</p><p><img src=\"https://phucanhcdn.com/media/lib/20-12-2023/laptop-lenovo-thinkpad-l14-gen-4-21h1003ava-1.jpg\" alt=\"Laptop Lenovo ThinkPad L14 GEN 4 21H1003AVA\"></p><h3>Bảo vệ dữ liệu máy tính toàn diện không sợ rò rỉ thông tin</h3><p>Với các công nghệ bảo mật tiên tiến của Lenovo ThinkPad L14 GEN 4 sẽ đảm bảo dữ liệu của bạn luôn được an toàn khỏi các cuộc tấn công nhờ chip bảo mật TPM 2.0, bảo mật dữ liệu nhạy cảm trên ổ cứng một cách toàn diện</p><p>Chỉ có chủ nhân của laptop mới có thể đăng nhập với nhận dạng vân tay 1 chạm trên nút nguồn cùng windows hello nhận diện khuân mặt, đảm bảo yên tâm làm việc ở bất kì môi trường nào khi chính bạn chính là chìa khóa để mở máy</p><p>Không sợ bị theo dõi và rò rỉ các hình ảnh không mong muốn với màn trập webcam - Privacy Shutter khóa camera hiện đại không không có nhu cầu sử dụng webcam để làm việc</p><p><img src=\"https://phucanhcdn.com/media/lib/20-12-2023/laptop-lenovo-thinkpad-l14-gen-4-21h1003ava-2.jpg\" alt=\"Laptop Lenovo ThinkPad L14 GEN 4 21H1003AVA\"></p><h3>Kết nối dễ dàng với thế giới</h3><p>Laptop Lenovo ThinkPad L14 GEN 4 21H1003AVA giúp bạn kết nối siêu nhanh với Wi-Fi® 6, &nbsp;Bluetooth 5.1 để bạn kết nối không dây nhanh chóng phục vụ cho việc học tập, công việc và các hoạt động giải trí khác của mình</p><p>Cho dù là chiếc laptop mỏng nhẹ nhưng Lenovo ThinkPad L14 GEN 4 vẫn có đầy đủ các kết nối tiên tiến và phổ biến để phục vụ công việc trong môi trường văn phòng, học tập bao gồm:</p><p>1x USB 3.2 Gen 1</p><p>1x USB 3.2 Gen 1 (Always On)</p><p>1x USB-C® 3.2 Gen 2 (support data transfer, Power Delivery 3.0 and DisplayPort™ 1.4)</p><p>1x Thunderbolt™ 4 / USB4® 40Gbps (support data transfer, Power Delivery 3.0 and DisplayPort™ 1.4)</p><p>1x HDMI® 2.1,</p><p>1x microSD card reader</p><p>1x Ethernet (RJ-45)</p><p>1x Headphone (3.5mm)</p><p><img src=\"https://phucanhcdn.com/media/lib/20-12-2023/laptop-lenovo-thinkpad-l14-gen-4-21h1003ava.jpg\" alt=\"Laptop Lenovo ThinkPad L14 GEN 4 21H1003AVA\"></p>', 1, 1, '2024-06-19 23:23:58', '2024-06-19 23:23:58'),
(6, 'Lenovo IdeaPad Slim 5 16AIH8 (83BG004EVN) (i5-12450H/16GB RAM/1TB SSD)', 1, 1, 2, 2, NULL, 16990000, 16490000, 15, 'PtNS-76817_laptop_lenovo_ideapad_slim_5_16aih7__83bg004evn_.jpg', NULL, '<p>Lenovo IdeaPad Slim 5 16IAH8 là một sự kết hợp tuyệt vời giữa tính di động và hiệu suất. Với màn hình rộng lên đến <strong>16 inch</strong>, máy vẫn giữ được sự mảnh mai và nhẹ nhàng, làm cho việc mang theo dễ dàng hơn bao giờ hết. Được trang bị bộ vi xử lý <strong>Intel Core i5 12450H</strong> mạnh mẽ, cùng với <strong>16GB RAM DDR5</strong>, IdeaPad Slim 5 đảm bảo sẽ đáp ứng tất cả các nhu cầu làm việc của bạn một cách mượt mà và hiệu quả.</p><h3><strong>Thiết kế di động</strong></h3><p>Lenovo IdeaPad Slim 5 16IAH8 không chỉ là sự kết hợp hoàn hảo giữa màn hình lớn và hiệu suất mạnh mẽ, mà còn giữ được tính di động tối ưu. Với độ mỏng chỉ <strong>17,9mm</strong> và trọng lượng <strong>1,89kg</strong>, laptop vẫn giữ được sự nhẹ nhàng và dễ dàng mang theo, không làm bạn cảm thấy bất tiện khi di chuyển. Thiết kế thanh lịch, viền màn hình mỏng và màu xám bạc thời thượng làm cho IdeaPad Slim 5 trở nên nổi bật và thu hút mọi ánh nhìn.</p><p><img src=\"https://hanoicomputercdn.com/media/lib/28-05-2024/lenovo-ideapad-slim-5-16iah8-1.jpg\" alt=\"Laptop Lenovo IdeaPad Slim 5 16AIH8 (83BG004EVN)\"></p><h3><strong>Cấu hình mạnh mẽ</strong></h3><p>Lenovo IdeaPad Slim 5 với bộ vi xử lý <strong>Core i5-12450H </strong>đem lại hiệu suất ổn định, từ tốc độ cơ bản 2.0 GHz đến tối đa <strong>4.4 GHz</strong>, đủ để xử lý các tác vụ văn phòng như thực hiện công việc trên tài liệu văn bản, soạn thảo báo cáo hoặc duyệt web một cách mượt mà. Với bộ nhớ cache lên đến 18MB và <strong>8 nhân, 12 luồng</strong>, máy dễ dàng xử lý nhiều tác vụ đồng thời một cách hiệu quả.</p><p>Ngoài ra Lenovo IdeaPad Slim 5 trang bị <strong>16GB RAM DDR5 4800 MHz</strong>. Với dung lượng RAM lớn và chuẩn băng thông cao mới, việc đa nhiệm trên IdeaPad Slim 5 16IAH8 được nâng lên một tầm cao mới. Bạn có thể mở đồng thời nhiều ứng dụng, hoàn thành nhiều công việc mà không gặp trục trặc về hiệu suất. Lenovo IdeaPad Slim 5 giúp bạn tận dụng hết tiềm năng của mình mà không gặp hạn chế nào.</p><p><img src=\"https://hanoicomputercdn.com/media/lib/28-05-2024/lenovo-ideapad-slim-5-16iah8-6.jpg\" alt=\"Laptop Lenovo IdeaPad Slim 5 16AIH8 (83BG004EVN)\"></p><h2><strong>Màn hình</strong></h2><p>Laptop Lenovo này được trang bị màn hình lớn kích thước <strong>16 inch WUXGA</strong>, độ phân giải <strong>1920 x 1200 pixel</strong>, mang lại trải nghiệm sử dụng với hình ảnh và nội dung chi tiết, sắc nét. Bạn có thể thấy rõ từng chi tiết và thông tin trên màn hình một cách chính xác và rõ ràng. Ngoài ra, máy tính cũng được trang bị <strong>FHD webcam</strong>, giúp bạn tham gia các cuộc họp hoặc gặp gỡ trực tuyến một cách thuận tiện.<img src=\"https://hanoicomputercdn.com/media/lib/28-05-2024/lenovo-ideapad-slim-5-16iah8-2.jpg\" alt=\"Laptop Lenovo IdeaPad Slim 5 16AIH8 (83BG004EVN)\"></p><p>Lenovo IdeaPad Slim 5 sử dụng hệ điều hành Windows 11 Home, với nhiều tính năng mới và giao diện thanh taskbar mới đa dạng. Một trong những tính năng đáng chú ý là cải tiến về bảo mật, bao gồm tính năng Windows Hello, cho phép bạn đăng nhập nhanh chóng bằng khuôn mặt hoặc dấu vân tay.</p><p>Hệ thống Lenovo IdeaPad Slim 5 16IAH8 được điều khiển bởi công nghệ Lenovo AI Engine, áp dụng trí tuệ nhân tạo để tối ưu hóa hiệu năng. Tính năng Smart Power sẽ điều chỉnh hiệu năng hệ thống, thời lượng pin và nhiệt độ theo thời gian thực tùy theo mức độ của bạn. Tính năng Smart Wireless cho bạn kết nối lâu và ổn định hơn. Các tính năng Tự phục hồi và Bảo vệ tệp tin sẽ bảo vệ dữ liệu của bạn, không lo bị tin tặc hack hay xâm nhập.</p>', 1, 1, '2024-06-19 23:35:27', '2024-06-19 23:36:08'),
(7, 'Lenovo Yoga Slim 6 14IRH8 (83E00008VN) (i7-13700H/16GB RAM/512GB SSD)', 1, 1, 2, 2, NULL, 23590000, NULL, 20, 'nnPK-77286_laptop_lenovo_yoga_6_14irh8__83e00008vn___3_.jpg', NULL, NULL, 1, 1, '2024-06-19 23:41:27', '2024-06-19 23:41:27'),
(8, 'Dell Inspiron 14 5430 (71015633) (i7-1360P/16GB RAM/1TB SSD/RTX2050 4G)', 1, 1, 3, 3, NULL, 27990000, 26990000, 15, 'VFFR-76259_laptop_dell_inspiron_14_5430__20dy3___2_.jpg', NULL, '<h3><strong>Âm thanh xuất sắc khiến bạn rung động</strong></h3><p>Từ âm nhạc đến phim ảnh và chương trình truyền hình, đem đến trải nghiệm như thật với âm thanh không gian Dolby Atmos®.</p><p><img src=\"https://hanoicomputercdn.com/media/lib/12-06-2024/laptop-dell-inspiron-14-5430-71015633-i7-1360p-16gb-ram-1tb-ssd-rtx2050-4g-140-inch-21.jpeg\" alt=\"Laptop Dell Inspiron 14 5430 (71015633) (i7 1360P/16GB RAM/1TB SSD/RTX2050 4G/14.0 inch 2.5K/Win11/Office HS21/Bạc) 1\"></p><h3><strong>Loa nổi, âm thanh hàng đầu</strong></h3><p>Tận hưởng chất lượng âm thanh vượt trội mọi lúc mọi nơi với loa tăng tốc truyền âm thanh theo hướng của bạn.</p><p><img src=\"https://hanoicomputercdn.com/media/lib/12-06-2024/laptop-dell-inspiron-14-5430-71015633-i7-1360p-16gb-ram-1tb-ssd-rtx2050-4g-140-inch-22.jpeg\" alt=\"Laptop Dell Inspiron 14 5430 (71015633) (i7 1360P/16GB RAM/1TB SSD/RTX2050 4G/14.0 inch 2.5K/Win11/Office HS21/Bạc) 2 \"></p><h3><strong>Bao quanh bạn với những rung cảm bạn yêu thích</strong></h3><p>Trải nghiệm nội dung của bạn một cách trọn vẹn từ bất kỳ đâu với âm thanh lớn và rõ ràng từ loa của Inspiron 14. Nghe podcast và danh sách phát từ điện thoại trên máy tính của bạn qua kết nối Bluetooth.</p><p><img src=\"https://hanoicomputercdn.com/media/lib/12-06-2024/laptop-dell-inspiron-14-5430-71015633-i7-1360p-16gb-ram-1tb-ssd-rtx2050-4g-140-inch-23.jpeg\" alt=\"Laptop Dell Inspiron 14 5430 (71015633) (i7 1360P/16GB RAM/1TB SSD/RTX2050 4G/14.0 inch 2.5K/Win11/Office HS21/Bạc) 3\"></p><h3><strong>Tích hợp tính năng bảo mật cho sự an tâm</strong></h3><p>ExpressSign-in kết hợp với Windows Hello giúp trải nghiệm đăng nhập của bạn trở nên dễ dàng hơn nhờ công nghệ phát hiện hiện diện.</p><p>Máy tính của bạn sẽ tự động bật khi bạn đến gần và khóa lại khi bạn rời đi. Hơn nữa, khi có người nhìn trộm màn hình của bạn từ bên cạnh hoặc phía sau, máy tính sẽ tự động làm mờ màn hình để bảo mật và giảm độ sáng khi bạn không nhìn vào.</p><p><img src=\"https://hanoicomputercdn.com/media/lib/12-06-2024/laptop-dell-inspiron-14-5430-71015633-i7-1360p-16gb-ram-1tb-ssd-rtx2050-4g-140-inch-24.jpeg\" alt=\"Laptop Dell Inspiron 14 5430 (71015633) (i7 1360P/16GB RAM/1TB SSD/RTX2050 4G/14.0 inch 2.5K/Win11/Office HS21/Bạc) 4 \"></p><h3><strong>Hiệu năng mạnh mẽ</strong></h3><p>Bộ xử lý Intel® Core™ thế hệ thứ 13 nâng cao khả năng tính toán trong thế giới thực và mang lại khả năng thực hiện đa tác vụ cực kỳ hiệu quả. Đạt hiệu suất cao nhất với bộ nhớ LPDDR5 nhanh như chớp và tiết kiệm điện năng, cho phép bạn chuyển đổi ứng dụng dễ dàng đồng thời tối đa hóa thời lượng pin.</p><h3><strong><img src=\"https://hanoicomputercdn.com/media/lib/12-06-2024/laptop-dell-inspiron-14-5430-71015633-i7-1360p-16gb-ram-1tb-ssd-rtx2050-4g-140-inch-25.jpeg\" alt=\"Laptop Dell Inspiron 14 5430 (71015633) (i7 1360P/16GB RAM/1TB SSD/RTX2050 4G/14.0 inch 2.5K/Win11/Office HS21/Bạc) 5\"></strong></h3><h3><strong>Thiết kế bảo đảm môi trường</strong></h3><p>Inspiron 14 được thiết kế với các vật liệu bền vững và được đóng gói bằng bao bì làm từ tối đa 100% nội dung tái chế hoặc tái tạo và cũng hoàn toàn có thể tái chế. Một số mẫu Inspiron sử dụng công nghệ logo liền mạch trên nắp, giúp giảm thiểu lãng phí trong quá trình sản xuất. Dòng Inspiron mới được đăng ký EPEAT Silver và đạt chứng nhận Energy Star.</p><p><img src=\"https://hanoicomputercdn.com/media/lib/12-06-2024/laptop-dell-inspiron-14-5430-71015633-i7-1360p-16gb-ram-1tb-ssd-rtx2050-4g-140-inch-26.jpeg\" alt=\"Laptop Dell Inspiron 14 5430 (71015633) (i7 1360P/16GB RAM/1TB SSD/RTX2050 4G/14.0 inch 2.5K/Win11/Office HS21/Bạc) 6\"></p>', 1, 1, '2024-06-19 23:47:40', '2024-06-19 23:47:40'),
(9, 'Dell XPS 15 9530 (71015716) (i7-13700H/16GB RAM/512GB SSD/RTX4050 6G)', 1, 1, 3, 3, NULL, 67990000, NULL, 5, 'QJ2q-76266_laptop_dell_xps_15_9530__71015716_.jpg', NULL, NULL, 1, 1, '2024-06-19 23:52:40', '2024-06-19 23:52:40'),
(10, 'Sony PlayStation 5 (PS5) Slim Standard', 3, 1, 6, 8, NULL, 13990000, 12990000, 11, 'pnAF-81819_may_choi_game_sony_playstation_5_ps5_slim_standard_hang_chinh_hang_2.jpg', NULL, NULL, 1, 1, '2024-06-19 23:56:14', '2024-06-20 02:31:17'),
(11, 'Microsoft Xbox One Series S/512GB', 3, 1, 7, 10, NULL, 6290000, 5790000, 6, 'nsKP-83588_may_choi_game_microsoft_xbox_one_series_s_512gb_refurbished_1.jpg', NULL, '<h3><strong>Mở rộng, không làm giảm hiệu năng</strong></h3><p>Thẻ mở rộng lưu trữ Seagate 1TB dành cho Xbox Series X | S cắm vào mặt sau của bảng điều khiển thông qua cổng mở rộng chuyên dụng và tái tạo trải nghiệm SSD tùy chỉnh của bảng điều khiển, cung cấp thêm bộ nhớ trò chơi với cùng hiệu suất. ( Sản phẩm bán riêng, không đi kèm máy )</p><p><img src=\"https://hanoicomputercdn.com/media/lib/29-11-2022/may-choi-game-microsoft-xbox-one-series-s-34.png\" alt=\"Máy chơi game Microsoft Xbox One Series S /512GB 3\"></p><h3><strong>Âm thanh vòm sống động</strong></h3><p>3D Spatial Audio&nbsp;là bước tiến tiếp theo trong công nghệ âm thanh, sử dụng các thuật toán tiên tiến để tạo ra thế giới sống động như thật, đặt bạn vào trung tâm trải nghiệm của mình.</p><p><img src=\"https://hanoicomputercdn.com/media/lib/29-11-2022/may-choi-game-microsoft-xbox-one-series-s-33.png\" alt=\"Máy chơi game Microsoft Xbox One Series S /512GB 4\"></p><h3><strong>Tay cầm điều khiển hoàn hảo</strong></h3><p>Bộ điều khiển không dây Xbox mới mang đến thiết kế trang nhã, sự thoải mái tinh tế và khả năng chia sẻ tức thì với một thiết bị yêu thích quen thuộc.</p><p><img src=\"https://hanoicomputercdn.com/media/lib/29-11-2022/may-choi-game-microsoft-xbox-one-series-s-36.png\" alt=\"Máy chơi game Microsoft Xbox One Series S /512GB 7\"></p>', 1, 1, '2024-06-19 23:59:18', '2024-06-19 23:59:18'),
(12, 'Nintendo Switch Gray V2', 3, 1, 8, 9, NULL, 6490000, NULL, 13, 'hQpN-71438_may_choi_game_nintendo_switch_gray_v2_0000_1.jpg', NULL, NULL, 1, 1, '2024-06-20 00:08:50', '2024-06-20 00:09:17'),
(13, 'Sony PlayStation 5 (PS5) Standard Marvel\'s Spider-Man 2 LIMITED', 3, 1, 6, 8, NULL, 15090000, NULL, 2, '6Jkw-75542_may_choi_game_sony_playstation_5_ps5_standard_marvel_s_spider_man_2_limited_1.jpg', NULL, '<p><img src=\"https://hanoicomputercdn.com/media/lib/08-08-2023/may-choi-game-sony-playstation-5-ps5-standard-marvel-s-spider-man-2-limited1.jpg\" alt=\"Máy chơi game Sony Playstation 5 (PS5) Standard Marvel\'s Spider-Man 2 Limited 1\"></p><p><img src=\"https://hanoicomputercdn.com/media/lib/08-08-2023/may-choi-game-sony-playstation-5-ps5-standard-marvel-s-spider-man-2-limited2.png\" alt=\"Máy chơi game Sony Playstation 5 (PS5) Standard Marvel\'s Spider-Man 2 Limited 2\"></p><p><img src=\"https://hanoicomputercdn.com/media/lib/08-08-2023/may-choi-game-sony-playstation-5-ps5-standard-marvel-s-spider-man-2-limited2.jpg\" alt=\"Máy chơi game Sony Playstation 5 (PS5) Standard Marvel\'s Spider-Man 2 Limited 3\"></p><p><img src=\"https://hanoicomputercdn.com/media/lib/08-08-2023/may-choi-game-sony-playstation-5-ps5-standard-marvel-s-spider-man-2-limited3.jpg\" alt=\"Máy chơi game Sony Playstation 5 (PS5) Standard Marvel\'s Spider-Man 2 Limited 4\"></p><p><img src=\"https://hanoicomputercdn.com/media/lib/08-08-2023/may-choi-game-sony-playstation-5-ps5-standard-marvel-s-spider-man-2-limited4.jpg\" alt=\"Máy chơi game Sony Playstation 5 (PS5) Standard Marvel\'s Spider-Man 2 Limited 5\"></p><p><img src=\"https://hanoicomputercdn.com/media/lib/08-08-2023/may-choi-game-sony-playstation-5-ps5-standard-marvel-s-spider-man-2-limited5.jpg\" alt=\"Máy chơi game Sony Playstation 5 (PS5) Standard Marvel\'s Spider-Man 2 Limited 6\"></p><p><img src=\"https://hanoicomputercdn.com/media/lib/08-08-2023/may-choi-game-sony-playstation-5-ps5-standard-marvel-s-spider-man-2-limited3.png\" alt=\"Máy chơi game Sony Playstation 5 (PS5) Standard Marvel\'s Spider-Man 2 Limited 7\"></p><h4><strong>Cải thiện tốc độ load game</strong></h4><p>SSD thế hệ mới với tốc độ cực cao tối ưu thời gian chơi game của bạn với việc load game cực nhanh</p><h4><strong>Mở ra những cách sáng tạo game mới</strong></h4><p>Việc load các chi tiết một cách nhanh chóng, dễ dàng, kể cả với những chi tiết phức tạp, giúp cho nhà phát triển game có thể sáng tạo thêm các chi tiết, cách chơi mới trong game</p><h4><strong>Có thể nâng cấp</strong></h4><p>Ngoài chiếc SSD được tích hợp trên bo mạch, người dùng có thể nâng cấp dung lượng thông qua khe SSD M2 được bố trí khá dễ dàng lắp đặt</p><p>*Lưu ý: Máy tương thích với SSD M2 NVMe Gen 4x4</p><p><img src=\"https://hanoicomputercdn.com/media/lib/08-08-2023/may-choi-game-sony-playstation-5-ps5-standard-marvel-s-spider-man-2-limited1.png\" alt=\"Máy chơi game Sony Playstation 5 (PS5) Standard Marvel\'s Spider-Man 2 Limited 8\"></p><h3><strong>Đồ hoạ cải tiến đáng kinh ngạc</strong></h3><p>Với phần cứng mạnh mẽ, PS5 có thể đáp ứng các tiêu chí đồ hoạ cao cấp mà vẫn mang lại sự mượt mà cho trải nghiệm chơi game</p><p><img src=\"https://hanoicomputercdn.com/media/lib/08-08-2023/may-choi-game-sony-playstation-5-ps5-standard-marvel-s-spider-man-2-limited6.jpg\" alt=\"Máy chơi game Sony Playstation 5 (PS5) Standard Marvel\'s Spider-Man 2 Limited 9\"></p><p><img src=\"https://hanoicomputercdn.com/media/lib/08-08-2023/may-choi-game-sony-playstation-5-ps5-standard-marvel-s-spider-man-2-limited7.jpg\" alt=\"Máy chơi game Sony Playstation 5 (PS5) Standard Marvel\'s Spider-Man 2 Limited 10\"></p><p><img src=\"https://hanoicomputercdn.com/media/lib/08-08-2023/may-choi-game-sony-playstation-5-ps5-standard-marvel-s-spider-man-2-limited8.jpg\" alt=\"Máy chơi game Sony Playstation 5 (PS5) Standard Marvel\'s Spider-Man 2 Limited 11\"></p><p><img src=\"https://hanoicomputercdn.com/media/lib/08-08-2023/may-choi-game-sony-playstation-5-ps5-standard-marvel-s-spider-man-2-limited9.jpg\" alt=\"Máy chơi game Sony Playstation 5 (PS5) Standard Marvel\'s Spider-Man 2 Limited 13\"></p>', 1, 1, '2024-06-20 00:58:32', '2024-06-20 00:58:32'),
(14, 'Sony PlayStation 4 (PS4) Slim 1TB', 3, 1, 6, 8, NULL, 7990000, NULL, 10, 'XBSY-69970_may_choi_game_sony_playstation_4_ps4_slim_1tb_cuh_2218b_hang_chinh_hang_0002_3.jpg', NULL, NULL, 1, 1, '2024-06-20 01:01:44', '2024-06-20 01:07:24'),
(15, 'Nintendo Switch OLED White', 3, 1, 8, 9, NULL, 7490000, 7090000, 5, 'VVoA-69259_may_choi_game_nintendo_switch_oled_white_trang_0007_8.jpg', NULL, NULL, 1, 1, '2024-06-20 01:05:06', '2024-06-20 01:06:04'),
(16, 'Nintendo Switch Neon Red Blue V2', 3, 1, 8, 9, NULL, 6490000, NULL, 6, 'TtWI-70178_may_choi_game_nintendo_switch_neon_red_blue_v2_hop_mau_moi_0001_2.jpg', NULL, NULL, 1, 1, '2024-06-20 01:06:44', '2024-06-20 01:06:44'),
(17, 'Microsoft Xbox Series X Controller - Dream Vapor Special Edition', 3, 1, 7, 11, NULL, 1690000, NULL, 6, 'f2PY-80916_tay_cam_choi_game_khong_day_xbox_series_x_controller_dream_vapor_special_edition_1.jpg', NULL, '<p>Trải nghiệm thiết kế hiện đại của tay cầm Xbox thế hệ mới với kiểu dáng tinh tế để nâng cao trải nghiệm khi chơi game. Di chuyển và bám sát dễ dàng với D-pad Hybrid. Chụp chia sẻ nhanh chóng với nút Share. Dễ dàng chuyển đổi giữa các thiết bị bao gồm Xbox Series X | S, Xbox One, Windows 10 PC và Android và cả IOS</p><h3><strong>Nút chia sẻ chuyên dụng</strong></h3><p><img src=\"https://hanoicomputercdn.com/media/lib/27-02-2024/tay-cam-choi-game-khong-day-xbox-series-x-controller-dream-vapor-special-edition5.png\" alt=\"Tay cầm chơi game không dây Xbox Series X Controller - Dream Vapor Special Edition 1\"></p><h3><strong>Bám sát mục tiêu</strong></h3><p><img src=\"https://hanoicomputercdn.com/media/lib/27-02-2024/tay-cam-choi-game-khong-day-xbox-series-x-controller-dream-vapor-special-edition2.png\" alt=\"Tay cầm chơi game không dây Xbox Series X Controller - Dream Vapor Special Edition 2\"></p><h3><strong>Thay đổi thiết bị dễ dàng</strong></h3><p><img src=\"https://hanoicomputercdn.com/media/lib/27-02-2024/tay-cam-choi-game-khong-day-xbox-series-x-controller-dream-vapor-special-edition4.png\" alt=\"Tay cầm chơi game không dây Xbox Series X Controller - Dream Vapor Special Edition 3\"></p><h3><strong>Khả năng tương thích</strong></h3><p><img src=\"https://hanoicomputercdn.com/media/lib/27-02-2024/tay-cam-choi-game-khong-day-xbox-series-x-controller-dream-vapor-special-edition3.png\" alt=\"Tay cầm chơi game không dây Xbox Series X Controller - Dream Vapor Special Edition 5\"></p>', 1, 1, '2024-06-20 01:34:20', '2024-06-20 01:34:20'),
(18, 'Microsoft Xbox Series X Controller - Nocturnal Vapor Special Edition', 3, 1, 7, 11, NULL, 1690000, NULL, 4, 'xryl-82311_tay_cam_choi_game_khong_day_xbox_series_x_controller_nocturnal_vapor_special_edition_1.jpg', NULL, NULL, 1, 1, '2024-06-20 01:35:04', '2024-06-20 01:35:04'),
(19, 'Sony PlayStation 5 (PS5) DualSense Wireless Controller White', 3, 1, 6, 11, NULL, 1590000, NULL, 8, '3ISK-70222_tay_cam_choi_game_sony_ps5_dualsense_mau_trang_2.jpg', NULL, '<p><img src=\"https://hanoicomputercdn.com/media/lib/30-07-2022/tay-cam-choi-game-sony-ps5-dualsense2.png\" alt=\"Tay cầm chơi Game Sony PS5 DualSense 1\"></p><h3><strong>Nâng cao cảm giác của bạn</strong></h3><p>Tay cầm Dualsense cung cấp các tính năng cao cấp như: Haptic Feedback (phản hồi rung) , Dynamic Adaptive Trigger (Bộ kích hoạt thích ứng động với nút cò Trigger), Jack Audio kiêm Microphone, tất cả được tích hợp vào trong vào trong một thiết kế hoàn chỉnh mang tính biểu tượng của Sony</p><h3><strong>Adaptive Triggers</strong></h3><p><img src=\"https://hanoicomputercdn.com/media/lib/30-07-2022/tay-cam-choi-game-sony-ps5-dualsense1.jpg\" alt=\"Tay cầm chơi Game Sony PS5 DualSense 2\"></p><h3><strong>Tính năng phản hồi rung</strong></h3><p><img src=\"https://hanoicomputercdn.com/media/lib/30-07-2022/tay-cam-choi-game-sony-ps5-dualsense2.jpg\" alt=\"Tay cầm chơi Game Sony PS5 DualSense 3\"></p><h3><strong>Microphone tích hợp / Jack 3.5mm</strong></h3><p>Trò chuyện với bạn bè trực tuyến bằng micrô tích hợp - hoặc bằng cách kết nối tai nghe với giắc cắm 3,5 mm. Dễ dàng tắt tính năng chụp ảnh bằng giọng nói ngay lập tức bằng nút tắt tiếng chuyên dụng.</p><p><img src=\"https://hanoicomputercdn.com/media/lib/30-07-2022/tay-cam-choi-game-sony-ps5-dualsense3.jpg\" alt=\"Tay cầm chơi Game Sony PS5 DualSense 4\"></p><h3><strong>Nút Share tiện lợi</strong></h3><p><img src=\"https://hanoicomputercdn.com/media/lib/30-07-2022/tay-cam-choi-game-sony-ps5-dualsense4.jpg\" alt=\"Tay cầm chơi Game Sony PS5 DualSense 5\"></p><h3><strong>Các tính năng quen thuộc</strong></h3><p><img src=\"https://hanoicomputercdn.com/media/lib/30-07-2022/tay-cam-choi-game-sony-ps5-dualsense1.png\" alt=\"Tay cầm chơi Game Sony PS5 DualSense 6\"></p>', 1, 1, '2024-06-20 01:36:47', '2024-06-20 01:37:25'),
(20, 'Nintendo Switch Pro Controller - Super Smash Bros Ultimate Limited', 3, 1, 8, 11, NULL, 2290000, NULL, 3, 'kTuY-66724_tay_cam_choi_game_khong_day_nintendo_switch_pro_controller_super_smash_bros_ultimate_limited_3.jpg', NULL, '<h3><strong>Đưa trải nghiệm chơi game của bạn lên một tầm cao!</strong></h3><p>Nintendo Switch Pro là một chiếc tay cầm với chất lượng cao cấp. Tay cầm có các nút tương tự như trên chiếc Nintendo Switch và được thiết kế để người chơi có thể cầm một thoải mái và thực hiện các thao tác chơi game ở mọi lúc, mọi nơi một cách dễ dàng.</p><p><img src=\"https://hanoicomputercdn.com/media/lib/19-12-2022/tay-cam-choi-game-khong-day-nintendo-switch-pro-controller-super-smash-bros-ultimate-limited-2.jpg\" alt=\"Tay cầm chơi game không dây Nintendo Switch Pro Controller - Super Smash Bros Ultimate Limited\"></p><h3><strong>Các đặc điểm chính</strong></h3><p>Tay cầm Pro Switch sở hữu nhiều tính năng tuyệt vời tương tự như chiếc Joy-Con bao gồm như: (motion controls) điều khiển theo chuyển động, HD rumble (Độ Rung HD), tích hợp chức năng quét amiibo và nhiều chức năng khác nữa.v.v... Sự khác biệt cơ bản trong ở việc điều khiển của tay cầm này là trong khi bạn sử dụng directional control trên Joy-Con (L) được tạo thành từ các nút khác nhau, thì trên tay cầm Pro, thì bạn chỉ cần một + Control Pad duy nhất, tương tự như các hệ thống trước đó.</p><p><img src=\"https://hanoicomputercdn.com/media/lib/19-12-2022/tay-cam-choi-game-khong-day-nintendo-switch-pro-controller-super-smash-bros-ultimate-limited-1.jpg\" alt=\"Tay cầm chơi game không dây Nintendo Switch Pro Controller - Super Smash Bros Ultimate Limited\"></p><p>Tay cầm Nintendo Switch Pro chứa 2 bộ truyền động cộng hưởng tuyến tính, mỗi bộ đều có khả năng tạo Độ Rung HD độc ​​lập, mang đến hiệu ứng tương tự như với chiếc tay cầm Joy-Con. Chức năng Rung HD được tích hợp sẵn trong tay cầm Nintendo Switch Pro sẽ mang đến cho bạn những trải nghiệm chơi game nhập vai chân thât không chỉ với những hình ảnh và là còn với cả âm âm thanh.</p><p>Bạn cũng có thể sử dụng amiibo trên Nintendo Switch của mình bằng cách chạm chúng vào điểm NFC trên tay cầm Nintendo Switch Pro! Phụ kiện đi kèm với tay cầm sẽ bao gồm một đầu nối USB Type-C và một cáp USB Type-C giúp cho bạn sạc nhanh chóng chiếc tay cầm của mình.&nbsp;</p><p>Thời lượng pin của một chiếc tay cầm Nintendo Switch Pro là khoảng 40 giờ. Các bạn hãy lưu ý đây chỉ là thời lượng pin ước tính. Tùy thuộc vào điều kiện sử dụng mà thời lượng pin của tay cầm có thể thay đổi khác nhau một chút, nhưng sẽ không hề đáng kể.</p><p><img src=\"https://hanoicomputercdn.com/media/lib/19-12-2022/tay-cam-choi-game-khong-day-nintendo-switch-pro-controller-super-smash-bros-ultimate-limited-3.jpg\" alt=\"Tay cầm chơi game không dây Nintendo Switch Pro Controller - Super Smash Bros Ultimate Limited\"></p>', 1, 1, '2024-06-20 01:39:01', '2024-06-20 01:39:01'),
(21, 'Sony PlayStation 5 (PS5) DualSense Edge Controller White', 3, 1, 6, 11, NULL, 5390000, 5190000, 3, 'kQcA-69987_tay_cam_choi_game_sony_ps5_dualsense_edge_7.jpg', NULL, '<p><img src=\"https://hanoicomputercdn.com/media/lib/18-01-2023/tay-cam-choi-game-sony-ps5-dualsense-edge-04.jpg\" alt=\"Tay cầm chơi Game Sony PS5 DualSense Edge\"></p><p><img src=\"https://hanoicomputercdn.com/media/lib/18-01-2023/tay-cam-choi-game-sony-ps5-dualsense-edge-02.jpg\" alt=\"Tay cầm chơi Game Sony PS5 DualSense Edge\"></p><p><img src=\"https://hanoicomputercdn.com/media/lib/18-01-2023/tay-cam-choi-game-sony-ps5-dualsense-edge-01.jpg\" alt=\"Tay cầm chơi Game Sony PS5 DualSense Edge\"></p><p><img src=\"https://hanoicomputercdn.com/media/lib/18-01-2023/tay-cam-choi-game-sony-ps5-dualsense-edge-05.jpg\" alt=\"Tay cầm chơi Game Sony PS5 DualSense Edge\"></p><p><img src=\"https://hanoicomputercdn.com/media/lib/18-01-2023/tay-cam-choi-game-sony-ps5-dualsense-edge-03.jpg\" alt=\"Tay cầm chơi Game Sony PS5 DualSense Edge\"></p><p><img src=\"https://hanoicomputercdn.com/media/lib/18-01-2023/tay-cam-choi-game-sony-ps5-dualsense-edge-06.jpg\" alt=\"Tay cầm chơi Game Sony PS5 DualSense Edge\"></p>', 1, 1, '2024-06-20 01:41:26', '2024-06-20 01:41:42'),
(22, 'PC Asus ALL IN ONE A3402WBAK-WPC048W (i3-1215U/8GB/512GB)', 2, 1, 9, 7, NULL, 13290000, NULL, 3, 'lpSV-83318_pc_asus_all_in_one_a3402wbak_wpc048w_1.jpg', NULL, '<h3><strong>PC Asus All in One A3402WB là bộ máy tính hợp sẵn màn hình, tối giản không gian cùng tăng tính thẩm mỹ sử dụng.</strong></h3><p><a href=\"https://hacom.vn/tim?q=ASUS+A3402\">ASUS A3402</a> sở hữu lối thiết kế NanoEdge viền mỏng mang lại tỷ lệ màn hình so với thân máy lên tới 86% để tăng năng suất. Màn hình rộng, đẹp mắt này được hưởng lợi từ gam màu 100% sRGB và công nghệ góc nhìn rộng 178° cho hình ảnh thực sự tuyệt vời. Kết hợp với âm thanh ASUS SonicMaster Premium tiên tiến giúp đắm chìm trong trải nghiệm giải trí đỉnh cao.</p><p><img src=\"https://hanoicomputercdn.com/media/lib/26-04-2024/vi-vn-asus-expertcenter-aio-a340.jpg\" alt=\"\"></p><h3><strong>Asus All in One A3402WB có thiết kế tinh xảo</strong></h3><p>ASUS A3402 có diện mạo hoàn toàn mới với giá đỡ tích hợp thanh lịch mà cổ điển làm tô điểm thêm cho phong cách quý phái của bạn. Được thiết kế để đảm bảo tính ổn định tuyệt đối và diện mạo thanh mảnh, hình dạng của chân đế lấy cảm hứng từ chữ 人 trong tiếng Hán, biểu tượng cho nét đẹp của con người. Bản lề cân bằng hoàn hảo giúp giữ chắc màn hình, đồng thời cho phép bạn nghiêng màn hình theo góc thoải mái nhất.</p><p><img src=\"https://hanoicomputercdn.com/media/lib/31-07-2023/vi-vn-asus-expertcenter-aio-a3402wbat-i5-wa013w--1.jpg\" alt=\"\"></p><h3><strong>Sức mạnh tiềm tàng bên trong Asus All in One A3402WB</strong></h3><p>Được trang bị bộ vi xử lý Intel®&nbsp;Core™&nbsp;i3 1215U mới nhất, tiết kiệm điện năng, ASUS A3402 là sự kết hợp giữa hiệu năng và hiệu quả, cho phép xử lý mọi tác vụ mượt mà. Ngoài ra, giải pháp lưu trữ kép mang đến tốc độ đọc và ghi dữ liệu siêu nhanh, cho phép làm việc hiệu suất và sáng tạo một cách trơn tru, đồng thời có nhiều không gian lưu trữ ảnh và video. Tóm lại, ASUS A3402 đem lại hiệu năng mạnh mẽ để đáp ứng thao tác đa nhiệm.</p><p><img src=\"https://hanoicomputercdn.com/media/lib/26-04-2024/vi-vn-asus-expertcenter-aio-a340-1.jpg\" alt=\"\"></p><h3><strong>Viền màn hình siêu mỏng</strong></h3><p>ASUS A3402 mỏng và gọn gàng ấn tượng, và màn hình NanoEdge&nbsp;đi kèm có viền mỏng cho tỷ lệ hiển thị trên thân máy lên tới 86%, đem lại trải nghiệm xem tràn viền. <a href=\"https://hacom.vn/man-hinh-may-tinh\">Màn hình</a> rộng tuyệt vời này được trang bị công nghệ góc nhìn rộng, rất phù hợp để chia sẻ hình ảnh hoặc video với gia đình và bạn bè. Với màn hình 23.8 inch FHD (1920 x 1080), mọi thứ bạn tạo ra đều cho chi tiết sống động, với màu sắc và độ tương phản tuyệt vời, dù làm việc hay giải trí.</p><p><strong><img src=\"https://hanoicomputercdn.com/media/lib/31-07-2023/vi-vn-asus-expertcenter-aio-a3402wbat-i5-wa013w--4.jpg\" alt=\"\"></strong></p><h3><strong>Chất lượng hiển thị sống động</strong></h3><p>Góc nhìn siêu rộng 178° nhằm đảm bảo màu sắc và độ tương phản luôn sống động và sắc nét. Khả năng tái tạo 100% dải màu sRGB cho màu sắc sống động và chân thực. Sản phẩm cũng được trang bị công nghệ ASUS Splendid độc quyền đảm bảo màu sắc chân thực, cho dù đó là hình ảnh hoàng hôn bầu trời trong xanh hay tông màu da tinh tế. Sản phẩm còn có cả chế độ Sống động đặc biệt cho những khoảnh khắc sáng tạo đó, cho phép bạn đạt được tỷ lệ bão hòa màu tổng thể giúp cải thiện tông màu, giúp hình ảnh trông luôn thật hấp dẫn.</p><p><strong><img src=\"https://hanoicomputercdn.com/media/lib/04-04-2023/5_display_7.jpg\" alt=\"\"></strong></p><h3><strong>Khử tiếng ồn tích hợp AI</strong></h3><p>Trang bị công nghệ khử ồn 2 chiều AI giúp tận dụng các kỹ thuật máy học tinh vi. Công nghệ này cho phép lọc ồn ở cả chiều người dùng và người đầu dây bên kia để đem tới chất lượng đàm thoại rõ ràng nhất.</p><p><strong><img src=\"https://hanoicomputercdn.com/media/lib/04-04-2023/9_noise-cancellation.jpg\" alt=\"\"></strong></p><h3><strong>Âm thanh ấn tượng</strong></h3><p>Được thiết kế bởi hệ thống âm thanh mạnh mẽ. Hệ thống loa stereo công suất 6 W cho âm thanh căng, sâu và dày dặn. Bên cạnh đó là dải âm trầm phản xạ cao cấp, một thiết kế thường chỉ có trên các hệ thống loa hi-fi có độ chân thực cao, nhằm đem lại âm thanh toàn dải trong trẻo. Công nghệ Dolby Atmos tái tạo hiệu ứng âm thanh vòm chuẩn rạp chiếu phim, đem tới trải nghiệm toàn đắm chìm trong các tác vụ giải trí.</p><p><img src=\"https://hanoicomputercdn.com/media/lib/31-07-2023/vi-vn-asus-expertcenter-aio-a3402wbat-i5-wa013w--3.jpg\" alt=\"\"></p><h3><strong>Kết nối thuận tiện</strong></h3><p>4x USB 3.2 Gen 1 để kết nối tất cả các thiết bị ngoại vi, 1x HDMI để kết nối màn hình bên ngoài và một đầu đọc thẻ SD (tùy chọn) giúp thuận tiện cho mọi hoạt động hàng ngày</p><p><img src=\"https://hanoicomputercdn.com/media/lib/31-07-2023/vi-vn-asus-expertcenter-aio-a3402wbat-i5-wa013w--5.jpg\" alt=\"\"></p><p><br>&nbsp;</p>', 1, 1, '2024-06-20 01:53:09', '2024-06-20 01:53:09'),
(23, 'Mini PC Asus Intel NUC13 Prodesk NUC13VYKI5 (i5-1340P/2XDDR4-3200/2XNVME, SATA)', 2, 1, 9, 7, NULL, 12390000, NULL, 3, 'kgmM-81181_bo_mini_pc_asus_intel_nuc13_prodesk_nuc13vyki5_1a.jpg', NULL, NULL, 1, 1, '2024-06-20 01:56:26', '2024-06-20 01:56:26'),
(24, 'Apple Mac Mini (MMFK3SA/A) (M2 8C CPU/10C GPU/8G RAM/512GB SSD)', 2, 1, 1, 7, NULL, 19190000, NULL, 5, 'uowv-70906_apple_mac_mini_mmfk3sa_850x850_3.jpg', NULL, NULL, 1, 1, '2024-06-20 01:57:25', '2024-06-20 01:57:25'),
(25, 'PC Lenovo ThinkCentre AIO Neo 30a 24 Gen 3 (i7-1260P/8GB RAM/512GB SSD)', 2, 1, 2, 7, NULL, 15490000, NULL, 3, 'nX2W-74496_pc_lenovo_all_in_one_thinkcentre_neo_30a_24_2.jpg', NULL, NULL, 1, 1, '2024-06-20 01:58:35', '2024-06-20 01:58:35'),
(26, 'Server Asus TS100-E11-PI4-2314041Z (E-2314/16GB RAM/1TB HDD/300W)', 2, 1, 9, 6, NULL, 22290000, NULL, 2, 'ut2i-77897_server_asus_ts100_e11_pi4_2314041z_90sf02n1_m004j0_4.jpg', NULL, NULL, 1, 1, '2024-06-20 02:05:37', '2024-06-20 02:05:37'),
(27, 'PC MSI Creator P50 (i5-11400/16GB (2X8GB)/512GB SSD/GTX1660S/WL+BT) (11SI-058XVN)', 2, 1, 4, 5, NULL, 27490000, NULL, 2, 'FA9h-65774_pc_msi_creator_p50_850x850_1.jpg', NULL, NULL, 1, 1, '2024-06-20 02:07:12', '2024-06-20 02:08:21'),
(28, 'Mainboard Asus PRO WS W790E-SAGE SE', 2, 1, 9, 6, NULL, 34690000, NULL, 1, 'uX2l-75905_mainboard_asus_pro_ws_w790e_sage_se_850x850_5.jpg', NULL, NULL, 1, 1, '2024-06-20 02:10:53', '2024-06-20 02:10:53'),
(29, 'PC Asus ROG Strix G15CF (i5-12400F/16GB RAM/512GB SSD/RTX3060TI)', 2, 1, 9, 5, NULL, 24990000, NULL, 2, 'aS4S-66605_pc_asus_rog_strix_g15cf_i5_12400f_16gb_ram_512gb_ssd_rtx3060ti_wl_bt_win_11_g15cf_51240f141w.jpg', NULL, '<p><a href=\"https://hacom.vn/pc-asus-rog-strix-g15cf-i5-12400f-16gb-ram-512gb-ssd-rtx3060ti-wl-bt-win-11-g15cf-51240f141w\"><strong>PC Asus ROG Strix G15CF</strong></a> 2022 là máy bộ gaming đầu tiên sở hữu bộ vi xử lý Intel thế hệ 12. Cấu hình mạnh mẽ đi cùng thiết kế đầy cảm hứng của sản phẩm hứa hẹn “đánh thức nhà vô địch” trong mỗi game thủ.</p><p>Vẻ ngoài hiện đại và tính năng Aura Sync cho phép đồng bộ hệ thống LED RGB giữa các thiết bị thuộc hệ sinh thái ROG, dịch vụ bảo hành tận nơi 2 năm góp phần quan trọng làm nên sức hút riêng cho bộ đôi máy bộ chơi game thế hệ mới từ ROG</p><p><img src=\"https://hanoicomputercdn.com/media/lib/24-06-2022/pc_asus_rog_strix_g15cf_mota1.jpg\" alt=\"PC Asus ROG Strix G15CF G15CF-51240F141W 1\"></p><h4><strong>Vóc dáng đặc trưng gaming</strong></h4><p><img src=\"https://hanoicomputercdn.com/media/lib/24-06-2022/pc_asus_rog_strix_g15cf_mota2.jpg\" alt=\"PC Asus ROG Strix G15CF G15CF-51240F141W 2\"></p><h4><strong>Tích hợp móc treo tai nghe</strong></h4><p><img src=\"https://hanoicomputercdn.com/media/lib/24-06-2022/pc_asus_rog_strix_g15cf_mota3.jpg\" alt=\"PC Asus ROG Strix G15CF G15CF-51240F141W 3\"></p><h4><strong>Hỗ trợ quai xách</strong></h4><p><img src=\"https://hanoicomputercdn.com/media/lib/24-06-2022/pc_asus_rog_strix_g15cf_mota5.jpg\" alt=\"PC Asus ROG Strix G15CF G15CF-51240F141W  4\"></p><h4><strong>Hiệu năng vượt trội</strong></h4><p><strong>Card đồ họa:&nbsp;</strong>dựa trên kiến trúc Turing hàng đầu của NVIDIA. Nhân cuda, RT và Tensor chuyên biệt dành cho đổ bóng có thể lập trình. Kết hợp tạo nên hiệu ứng mới tuyệt đẹp như ánh sáng ngoài đời thực, phản xạ và đổ bóng tăng cảm giác đắm chìm trong khi chơi game.</p><p><strong>Bộ vi xử lý: </strong>các tác vụ và tựa game nặng hoạt động mượt mà trên chip Intel Core i thế hệ thứ 12. <a href=\"https://www.hacom.vn/cpu-bo-vi-xu-ly\"><strong>CPU</strong></a> sở hữu công nghệ siêu phân luồng Hyper-Threading cho phép hoạt động lên tới 20 luồng song song giúp tăng tốc xử lý tác vụ đa nhiệm phức tạp. Các phần mềm về thiết kế, biên tập video và render 3D được thực hiện nhanh và hiệu quả hơn.</p><p><strong>Bộ nhớ trong:&nbsp;</strong>hỗ trợ nâng cấp lên tới 64GB cùng xung nhịp 3200MHz. Đảm bảo trải nghiệm mượt mà hơn, bất kể máy đang mở bao nhiêu tab trên trình duyệt hay nhiều ứng dụng.</p><p><img src=\"https://hanoicomputercdn.com/media/lib/24-06-2022/pc_asus_rog_strix_g15cf_mota6.jpg\" alt=\"PC Asus ROG Strix G15CF G15CF-51240F141W  5\"></p><h4><strong>Tản nhiệt vừa đủ</strong></h4><p><img src=\"https://hanoicomputercdn.com/media/lib/24-06-2022/screenshot_1656059560.jpg\" alt=\"PC Asus ROG Strix G15CF G15CF-51240F141W 6\"></p><h4><strong>Cá nhân hóa</strong></h4><p><img src=\"https://hanoicomputercdn.com/media/lib/24-06-2022/pc_asus_rog_strix_g15cf_mota7a.jpg\" alt=\"PC Asus ROG Strix G15CF G15CF-51240F141W 7\"></p><h4><strong>Luôn luôn kết nối</strong></h4><p>Kết nối các thiết bị yêu thích và nhanh chóng đắm mình trò chơi. GT15 được trang bị một cổng Type-C™ (USB-C™) kết nối hai chiều với băng thông giao diện tối đa 10Gbps qua USB 3.2 thế hệ 2 truyền dữ liệu và sạc nhanh, cộng thêm sáu cổng USB 3.2 Type-A giúp bạn có đủ không gian cho tất cả các thiết bị ngoại vi ưa thích. Để chơi game hoặc phát trực tuyến video 4K trên màn hình lớn, hãy kết nối qua cổng HDMI 2.0 hoặc sử cổng DisplayPort 1.4 với màn hình gaming tốc độ làm mới cao.</p><p><img src=\"https://hanoicomputercdn.com/media/lib/24-06-2022/pc_asus_rog_strix_g15cf_mota4.jpeg\" alt=\"PC Asus ROG Strix G15CF G15CF-51240F141W 8\"></p><p><strong>Lưu ý</strong>: Các cổng I/O có thể thay đổi tùy theo cấu hình. Quý khách vui lòng kiểm tra kĩ càng trước khi thanh toán</p>', 1, 1, '2024-06-20 02:13:04', '2024-06-20 02:13:04'),
(30, 'AirPods Pro 2 (USB-C) (2023)', 6, 1, 1, 26, NULL, 6790000, 5490000, 22, 'vtEv-0022024_airpods-pro-2-usb-c-2023.jpeg', NULL, NULL, 1, 1, '2024-06-20 02:17:36', '2024-06-20 02:33:25'),
(31, 'AirPods 3 (Sạc dây Lightning) (2021)', 6, 1, 1, 26, NULL, 5490000, 3990000, 18, 'cLDq-0006057_tai-nghe-apple-airpods-3-sac-co-day-lightning.jpeg', NULL, NULL, 1, 1, '2024-06-20 02:18:44', '2024-06-20 02:18:44'),
(32, 'EarPods with USB-C', 6, 1, 1, 26, NULL, 550000, NULL, 22, 'sDyT-0022176_earpods-with-usb-c.jpeg', NULL, NULL, 1, 1, '2024-06-20 02:21:24', '2024-06-20 02:23:29'),
(33, 'AirPods Max', 6, 1, 1, 26, NULL, 12590000, NULL, 10, '4Ajg-0012018_silver.png', NULL, NULL, 1, 1, '2024-06-20 02:21:48', '2024-06-20 02:21:48');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `ratings`
--

CREATE TABLE `ratings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `products_id` int(10) UNSIGNED NOT NULL,
  `users_id` int(10) UNSIGNED NOT NULL,
  `ratings` int(11) NOT NULL,
  `content` longtext DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) NOT NULL,
  `guard_name` varchar(191) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `roles`
--

INSERT INTO `roles` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'web', '2024-06-19 20:58:20', '2024-06-19 20:58:20'),
(2, 'staff', 'web', '2024-06-19 20:58:20', '2024-06-19 20:58:20'),
(3, 'user', 'web', '2024-06-19 20:58:20', '2024-06-19 20:58:20');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `role_has_permissions`
--

CREATE TABLE `role_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `subcategories`
--

CREATE TABLE `subcategories` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) NOT NULL,
  `sort_name` varchar(191) NOT NULL,
  `cat_id` bigint(20) UNSIGNED NOT NULL,
  `active` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `subcategories`
--

INSERT INTO `subcategories` (`id`, `name`, `sort_name`, `cat_id`, `active`, `created_at`, `updated_at`) VALUES
(1, 'Apple (MacBook)', 'apple-macbook-', 1, 1, '2024-06-19 21:12:03', '2024-06-19 21:12:03'),
(2, 'Lenovo', 'lenovo', 1, 1, '2024-06-19 21:12:27', '2024-06-19 21:12:27'),
(3, 'Dell', 'dell', 1, 1, '2024-06-19 21:12:43', '2024-06-19 21:12:43'),
(4, 'Surface', 'surface', 1, 1, '2024-06-19 21:13:43', '2024-06-19 23:03:38'),
(5, 'Gaming', 'gaming', 2, 1, '2024-06-19 21:15:19', '2024-06-19 21:15:19'),
(6, 'Workstation', 'workstation', 2, 1, '2024-06-19 21:16:00', '2024-06-19 21:16:00'),
(7, 'Văn phòng - Làm việc', 'van-phong-lam-viec', 2, 1, '2024-06-19 21:16:23', '2024-06-19 21:16:23'),
(8, 'PlayStation', 'playstation', 3, 1, '2024-06-19 21:17:02', '2024-06-19 21:17:02'),
(9, 'Nintendo', 'nintendo', 3, 1, '2024-06-19 21:17:18', '2024-06-19 21:17:18'),
(10, 'Xbox', 'xbox', 3, 1, '2024-06-19 21:17:37', '2024-06-19 21:17:37'),
(11, 'Tay cầm', 'tay-cam', 3, 1, '2024-06-19 21:18:43', '2024-06-19 21:18:43'),
(12, 'Đĩa game', 'dia-game', 3, 1, '2024-06-19 21:19:03', '2024-06-19 21:19:03'),
(13, 'CPU', 'cpu', 4, 1, '2024-06-19 21:19:34', '2024-06-19 21:19:34'),
(14, 'Mainboard', 'mainboard', 4, 1, '2024-06-19 21:19:46', '2024-06-19 21:19:46'),
(15, 'RAM', 'ram', 4, 1, '2024-06-19 21:20:13', '2024-06-19 21:20:13'),
(16, 'VGA', 'vga', 4, 1, '2024-06-19 21:20:25', '2024-06-19 21:20:25'),
(17, 'Ổ cứng', 'o-cung', 4, 1, '2024-06-19 21:20:51', '2024-06-19 21:20:51'),
(18, 'Case', 'case', 4, 1, '2024-06-19 21:21:07', '2024-06-19 21:21:07'),
(19, 'Màn hình Gaming', 'man-hinh-gaming', 5, 1, '2024-06-19 21:23:05', '2024-06-19 21:23:05'),
(20, 'Màn hình đồ hoạ', 'man-hinh-do-hoa', 5, 1, '2024-06-19 21:23:19', '2024-06-19 21:23:19'),
(21, 'Màn hình văn phòng', 'man-hinh-van-phong', 5, 1, '2024-06-19 21:23:44', '2024-06-19 21:23:44'),
(22, 'Màn hình cong', 'man-hinh-cong', 5, 1, '2024-06-19 21:23:57', '2024-06-19 21:23:57'),
(23, 'Màn hình Ultrawide', 'man-hinh-ultrawide', 5, 1, '2024-06-19 21:24:15', '2024-06-19 21:24:15'),
(24, 'Phụ kiện màn hình', 'phu-kien-man-hinh', 5, 1, '2024-06-19 21:24:29', '2024-06-19 21:24:29'),
(25, 'Loa', 'loa', 6, 1, '2024-06-19 21:24:50', '2024-06-19 21:24:50'),
(26, 'Tai nghe', 'tai-nghe', 6, 1, '2024-06-19 21:25:01', '2024-06-19 21:25:01'),
(27, 'Microphone', 'microphone', 6, 1, '2024-06-19 21:25:26', '2024-06-19 21:25:26'),
(28, 'Webcam', 'webcam', 6, 1, '2024-06-19 21:25:38', '2024-06-19 21:25:38'),
(29, 'Máy in', 'may-in', 7, 1, '2024-06-19 21:26:24', '2024-06-19 21:26:24'),
(30, 'Máy chiếu', 'may-chieu', 7, 1, '2024-06-19 21:26:34', '2024-06-19 21:26:34'),
(31, 'Máy chấm công', 'may-cham-cong', 7, 1, '2024-06-19 21:27:01', '2024-06-19 21:27:01'),
(32, 'Bàn phím cơ', 'ban-phim-co', 8, 1, '2024-06-19 21:27:50', '2024-06-19 21:27:50'),
(33, 'Bàn phím không dây', 'ban-phim-khong-day', 8, 1, '2024-06-19 21:28:02', '2024-06-19 21:28:02'),
(34, 'Bàn phím Gaming', 'ban-phim-gaming', 8, 1, '2024-06-19 21:28:14', '2024-06-19 21:28:14'),
(35, 'Chuột phổ thông', 'chuot-pho-thong', 8, 1, '2024-06-19 21:28:39', '2024-06-19 21:28:39'),
(36, 'Chuột không dây', 'chuot-khong-day', 8, 1, '2024-06-19 21:28:53', '2024-06-19 21:28:53'),
(37, 'Chuột Gaming', 'chuot-gaming', 8, 1, '2024-06-19 21:29:07', '2024-06-19 21:29:07'),
(38, 'Thiết bị mạng', 'thiet-bi-mang', 9, 1, '2024-06-19 21:30:16', '2024-06-19 21:30:16'),
(39, 'Camera giám sát', 'camera-giam-sat', 9, 1, '2024-06-19 21:30:33', '2024-06-19 21:30:33'),
(40, 'Thẻ nhớ', 'the-nho', 9, 1, '2024-06-19 21:30:52', '2024-06-19 21:30:52'),
(41, 'Ổ cứng di động', 'o-cung-di-dong', 9, 1, '2024-06-19 21:31:06', '2024-06-19 21:31:06');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `firstname` varchar(191) NOT NULL,
  `lastname` varchar(191) DEFAULT NULL,
  `username` varchar(191) NOT NULL,
  `email` varchar(191) NOT NULL,
  `password` varchar(191) NOT NULL,
  `image` varchar(191) DEFAULT NULL,
  `active` int(11) NOT NULL DEFAULT 1,
  `facebook` varchar(191) DEFAULT NULL,
  `phone` varchar(191) DEFAULT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `reset_token` varchar(191) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `users`
--

INSERT INTO `users` (`id`, `firstname`, `lastname`, `username`, `email`, `password`, `image`, `active`, `facebook`, `phone`, `remember_token`, `reset_token`, `created_at`, `updated_at`) VALUES
(1, 'admin', '', 'admin', 'admin@techzone.vn', '$2y$10$/.FFprwzpalVE4eB94N0t.4f3i7zt./eC5M3kA5Zhfyk6lPJpYYgi', 'avatar.jpg', 1, NULL, NULL, NULL, NULL, '2024-06-19 20:58:20', '2024-06-19 20:58:20'),
(2, 'Khách hàng không đăng nhập', '', 'guest_customer', 'null', '$2y$10$S8sPWYz8z0gIXnj1l9UwF.U1pN.nfFKSIcbHxYH/vZVIKSafRSRdi', 'avatar.jpg', 1, NULL, NULL, NULL, NULL, '2024-06-19 20:58:20', '2024-06-19 20:58:20'),
(3, 'Bảo', 'Hà Gia', 'tznhgb', '24a4042425@hvnh.edu.vn', '$2y$10$jw0lNnnPFFtkeMRqsjOnieQB.Nfj2xyEx.wwQrYhhsX24tPy6dE1q', 'avatar.jpg', 1, NULL, '0889379199', NULL, NULL, '2024-06-19 22:33:10', '2024-06-19 22:33:10'),
(4, 'Nghiệp', 'Phạm Ngọc', 'tznelt', '24a4042603@hvnh.edu.vn', '$2y$10$r/HIZ4agY/zJ/AJXoQp2Guj5z4d6HQXjyi9stqvOngElZqSwChubW', 'avatar.jpg', 1, NULL, '0859735529', NULL, NULL, '2024-06-19 22:33:52', '2024-06-19 22:33:52'),
(5, 'Linh', 'Nguyễn Thị', 'tznntl', '24a4040328@hvnh.edu.vn', '$2y$10$Qqo3YJkkyoFZ2qbDpYYrr.T8ggY1cpvC8RP3L0BJQmv4AqayB6sv.', 'avatar.jpg', 1, NULL, NULL, NULL, NULL, '2024-06-19 22:34:42', '2024-06-19 22:34:42'),
(6, 'Vui', 'Nguyễn Kim', 'tznnkv', '24a4040453@hvnh.edu.vn', '$2y$10$7HADtoumD1ZdRhjtl9NsWeAa6LCuGdlKhJIzsNsUW/z17vuRRHXn6', 'avatar.jpg', 1, NULL, NULL, NULL, NULL, '2024-06-19 22:36:01', '2024-06-19 22:36:01'),
(7, 'An', 'Nguyễn Văn', 'nguyenvana', 'testkhachhang10@gmail.com', '$2y$10$J0fqZ9S9P.U2lxHgT3TO0u0zLd5Ud7KFA81OSkkK/yuo4sc0n7U5O', 'avatar.jpg', 1, NULL, NULL, NULL, NULL, '2024-06-20 02:29:53', '2024-06-20 02:29:53');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `wishlists`
--

CREATE TABLE `wishlists` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `products_id` bigint(20) UNSIGNED NOT NULL,
  `users_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `abouts`
--
ALTER TABLE `abouts`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `banners`
--
ALTER TABLE `banners`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `brands`
--
ALTER TABLE `brands`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `discounts`
--
ALTER TABLE `discounts`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Chỉ mục cho bảng `imagelibraries`
--
ALTER TABLE `imagelibraries`
  ADD PRIMARY KEY (`id`),
  ADD KEY `imagelibraries_products_id_foreign` (`products_id`);

--
-- Chỉ mục cho bảng `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  ADD KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Chỉ mục cho bảng `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  ADD KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Chỉ mục cho bảng `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `orders_users_id_foreign` (`users_id`);

--
-- Chỉ mục cho bảng `orders__details`
--
ALTER TABLE `orders__details`
  ADD KEY `orders__details_orders_id_foreign` (`orders_id`),
  ADD KEY `orders__details_product_id_foreign` (`product_id`);

--
-- Chỉ mục cho bảng `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Chỉ mục cho bảng `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `permissions_name_guard_name_unique` (`name`,`guard_name`);

--
-- Chỉ mục cho bảng `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Chỉ mục cho bảng `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `ratings`
--
ALTER TABLE `ratings`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ratings_products_id_foreign` (`products_id`),
  ADD KEY `ratings_users_id_foreign` (`users_id`);

--
-- Chỉ mục cho bảng `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `roles_name_guard_name_unique` (`name`,`guard_name`);

--
-- Chỉ mục cho bảng `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`role_id`),
  ADD KEY `role_has_permissions_role_id_foreign` (`role_id`);

--
-- Chỉ mục cho bảng `subcategories`
--
ALTER TABLE `subcategories`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_username_unique` (`username`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Chỉ mục cho bảng `wishlists`
--
ALTER TABLE `wishlists`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `abouts`
--
ALTER TABLE `abouts`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT cho bảng `banners`
--
ALTER TABLE `banners`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT cho bảng `brands`
--
ALTER TABLE `brands`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT cho bảng `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT cho bảng `discounts`
--
ALTER TABLE `discounts`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT cho bảng `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `imagelibraries`
--
ALTER TABLE `imagelibraries`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=115;

--
-- AUTO_INCREMENT cho bảng `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT cho bảng `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT cho bảng `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT cho bảng `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `products`
--
ALTER TABLE `products`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT cho bảng `ratings`
--
ALTER TABLE `ratings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT cho bảng `subcategories`
--
ALTER TABLE `subcategories`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT cho bảng `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT cho bảng `wishlists`
--
ALTER TABLE `wishlists`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `imagelibraries`
--
ALTER TABLE `imagelibraries`
  ADD CONSTRAINT `imagelibraries_products_id_foreign` FOREIGN KEY (`products_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- Các ràng buộc cho bảng `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD CONSTRAINT `model_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE;

--
-- Các ràng buộc cho bảng `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD CONSTRAINT `model_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Các ràng buộc cho bảng `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_users_id_foreign` FOREIGN KEY (`users_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Các ràng buộc cho bảng `orders__details`
--
ALTER TABLE `orders__details`
  ADD CONSTRAINT `orders__details_orders_id_foreign` FOREIGN KEY (`orders_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `orders__details_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- Các ràng buộc cho bảng `ratings`
--
ALTER TABLE `ratings`
  ADD CONSTRAINT `ratings_products_id_foreign` FOREIGN KEY (`products_id`) REFERENCES `products` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `ratings_users_id_foreign` FOREIGN KEY (`users_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Các ràng buộc cho bảng `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
