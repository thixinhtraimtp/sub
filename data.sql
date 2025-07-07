-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: localhost:3306
-- Thời gian đã tạo: Th2 23, 2025 lúc 12:25 PM
-- Phiên bản máy phục vụ: 10.6.21-MariaDB
-- Phiên bản PHP: 8.3.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `cloudgam_testdata`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `bankings`
--

CREATE TABLE `bankings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `bank_name` varchar(255) DEFAULT NULL,
  `account_name` varchar(255) DEFAULT NULL,
  `account_number` varchar(255) DEFAULT NULL,
  `logo` longtext DEFAULT NULL,
  `bank_account` longtext DEFAULT NULL,
  `bank_password` longtext DEFAULT NULL,
  `min_recharge` longtext DEFAULT NULL,
  `status` enum('active','inactive') NOT NULL DEFAULT 'active',
  `token` longtext DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `domain` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `cards`
--

CREATE TABLE `cards` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `username` varchar(255) DEFAULT NULL,
  `card_type` varchar(255) DEFAULT NULL,
  `card_amount` varchar(255) DEFAULT NULL,
  `card_code` varchar(255) DEFAULT NULL,
  `card_serial` varchar(255) DEFAULT NULL,
  `card_real_amount` varchar(255) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `note` varchar(255) DEFAULT NULL,
  `tranid` varchar(255) DEFAULT NULL,
  `promotion` varchar(255) DEFAULT NULL,
  `discount` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `domain` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `cards`
--

INSERT INTO `cards` (`id`, `username`, `card_type`, `card_amount`, `card_code`, `card_serial`, `card_real_amount`, `status`, `note`, `tranid`, `promotion`, `discount`, `created_at`, `updated_at`, `domain`) VALUES
(1, 'khanhdz1996', 'VIETTEL', '50000', '014472685637252', '10010856114559', '0', 'Pending', 'Đang chờ xử lý', '810834', NULL, NULL, '2025-02-05 06:35:22', '2025-02-05 06:35:22', 'khosubvip.top'),
(2, 'Hungsy', 'VIETTEL', '10000', '815151758993425', '10010748513466', '0', 'active', '', '366366', NULL, NULL, '2025-02-11 23:07:29', '2025-02-11 23:07:29', 'khosubvip.top'),
(3, 'minhtuan0108', 'VIETTEL', '20000', '119233921564097', '10010770617577', '0', 'active', '', '378405', NULL, NULL, '2025-02-17 08:14:33', '2025-02-17 08:14:33', 'khosubvip.top'),
(4, 'minhtuan0108', 'VIETTEL', '20000', '112379019744627', '10010770617728', '0', 'Pending', 'Đang chờ xử lý', '379440', NULL, NULL, '2025-02-17 14:29:25', '2025-02-17 14:29:25', 'khosubvip.top');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `configs`
--

CREATE TABLE `configs` (
  `id` int(11) NOT NULL,
  `api_deposit` varchar(255) DEFAULT 'api.sieuthicode.net',
  `api_recharge_card` varchar(255) NOT NULL DEFAULT 'trumcardre.vn',
  `urgent_notice` longtext DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `configs`
--

INSERT INTO `configs` (`id`, `api_deposit`, `api_recharge_card`, `urgent_notice`) VALUES
(1, 'api.vpnfast.vn', 'paycard1s.sbs', '<p>Bắt buộc chạy Cron để cập nhật gi&aacute; v&agrave; lấy trạng th&aacute;i đơn h&agrave;ng,Thu&ecirc; cron gi&aacute; rẻ tại <a href=\"https://client.dichvudark.vip/cronjob\">https://client.dichvudark.vip/cronjob</a></p>\r\n<p>&nbsp;</p>');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `config_sites`
--

CREATE TABLE `config_sites` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name_site` varchar(255) DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `description` longtext DEFAULT NULL,
  `keywords` longtext DEFAULT NULL,
  `author` longtext DEFAULT NULL,
  `thumbnail` varchar(255) DEFAULT NULL,
  `logo` varchar(255) DEFAULT NULL,
  `favicon` varchar(255) DEFAULT NULL,
  `facebook` varchar(255) DEFAULT NULL,
  `nameadmin` text DEFAULT NULL,
  `avatar_admin` varchar(255) DEFAULT 'https://cdn-icons-png.flaticon.com/128/13756/13756316.png',
  `madon` varchar(255) DEFAULT NULL,
  `percent` varchar(255) DEFAULT NULL,
  `zalo` varchar(255) DEFAULT NULL,
  `telegram` varchar(255) DEFAULT NULL,
  `maintenance` enum('on','off') NOT NULL DEFAULT 'off',
  `collaborator` longtext DEFAULT NULL COMMENT 'Mức nạp cộng tác viên',
  `agency` longtext DEFAULT NULL COMMENT 'Mức nạp đại lý',
  `distributor` longtext DEFAULT NULL COMMENT 'Mức nạp nhà phân phối',
  `start_promotion` varchar(255) DEFAULT NULL,
  `end_promotion` varchar(255) DEFAULT NULL,
  `percent_promotion` varchar(255) DEFAULT NULL,
  `transfer_code` varchar(255) DEFAULT NULL,
  `telegram_chat_id` varchar(255) DEFAULT NULL,
  `telegram_bot_token` varchar(255) DEFAULT NULL,
  `telegram_bot_username` varchar(255) DEFAULT NULL,
  `telegram_bot_chat_id` varchar(255) DEFAULT NULL,
  `telegram_bot_chat_token` varchar(255) DEFAULT NULL,
  `telegram_bot_chat_username` longtext DEFAULT NULL,
  `notice` longtext DEFAULT NULL,
  `script_head` longtext DEFAULT NULL,
  `script_body` longtext DEFAULT NULL,
  `script_footer` longtext DEFAULT NULL,
  `admin_username` varchar(255) DEFAULT NULL,
  `site_token` longtext DEFAULT NULL,
  `status` enum('active','pending','inactive') DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `domain` varchar(255) DEFAULT NULL,
  `partner_key` text DEFAULT NULL,
  `partner_id` text DEFAULT NULL,
  `price` text DEFAULT NULL,
  `price_collaborator` text DEFAULT NULL,
  `price_agency` text DEFAULT NULL,
  `price_distributor` text DEFAULT NULL,
  `tigia` text DEFAULT NULL,
  `rule` longtext NOT NULL,
  `status_massorder` enum('on','off') DEFAULT 'off',
  `status_services` enum('on','off') DEFAULT 'off',
  `status_smm` varchar(255) NOT NULL DEFAULT 'off',
  `theme` varchar(100) DEFAULT '2',
  `theme_mode` varchar(255) DEFAULT NULL,
  `theme_admin` varchar(255) DEFAULT '1',
  `landing` varchar(255) DEFAULT '0',
  `auth_image` varchar(999) NOT NULL,
  `maintain` varchar(255) DEFAULT 'off',
  `min_withdraw_ref` int(11) NOT NULL DEFAULT 10000,
  `max_withdraw_ref` int(11) NOT NULL DEFAULT 500000,
  `telegram_chat_id_dontay` varchar(255) NOT NULL,
  `api_deposit` varchar(255) NOT NULL DEFAULT 'api.sieuthicode.net',
  `confirm_payment` tinyint(1) DEFAULT 0,
  `telegram_chat_id_box` bigint(20) DEFAULT NULL,
  `percentage_commission_affiliate` int(11) NOT NULL DEFAULT 0,
  `telegram_chat_id_withdraw` bigint(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `failed_jobs`
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
-- Cấu trúc bảng cho bảng `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `log_refs`
--

CREATE TABLE `log_refs` (
  `id` int(11) NOT NULL,
  `username` varchar(999) DEFAULT NULL,
  `ref_id` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `domain` varchar(999) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `notice_services`
--

CREATE TABLE `notice_services` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `color` varchar(255) NOT NULL DEFAULT 'info',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `domain` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `notice_systems`
--

CREATE TABLE `notice_systems` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `color` varchar(255) NOT NULL DEFAULT 'info',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `domain` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `orders`
--

CREATE TABLE `orders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `service_id` bigint(20) UNSIGNED NOT NULL,
  `server_id` bigint(20) UNSIGNED NOT NULL,
  `orderProviderName` varchar(255) DEFAULT NULL,
  `orderProviderServer` varchar(255) DEFAULT NULL,
  `orderProviderPath` text DEFAULT NULL,
  `order_package` varchar(255) DEFAULT NULL,
  `object_server` varchar(255) DEFAULT NULL,
  `object_id` varchar(255) DEFAULT NULL,
  `order_id` longtext DEFAULT NULL,
  `order_code` longtext DEFAULT NULL,
  `order_data` longtext DEFAULT NULL,
  `start` longtext DEFAULT NULL,
  `buff` longtext DEFAULT NULL,
  `duration` longtext DEFAULT NULL,
  `remaining` longtext DEFAULT NULL,
  `posts` longtext DEFAULT NULL,
  `price` longtext DEFAULT NULL,
  `payment` longtext DEFAULT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'Processing',
  `ip` varchar(255) DEFAULT NULL,
  `note` longtext DEFAULT NULL,
  `error` longtext DEFAULT NULL,
  `time` longtext DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `domain` varchar(255) DEFAULT NULL,
  `voucher` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `order_products`
--

CREATE TABLE `order_products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `total` decimal(10,2) NOT NULL,
  `status` varchar(255) NOT NULL,
  `note` text DEFAULT NULL,
  `data` text NOT NULL,
  `domain` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `partner_websites`
--

CREATE TABLE `partner_websites` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `url` varchar(255) NOT NULL,
  `status` enum('active','inactive','pending') NOT NULL DEFAULT 'inactive',
  `zone_id` varchar(255) DEFAULT NULL,
  `zone_name` varchar(255) DEFAULT NULL,
  `zone_status` varchar(255) DEFAULT NULL,
  `zone_data` longtext DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `domain` varchar(255) NOT NULL,
  `name_sever1` text DEFAULT NULL,
  `name_sever2` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `payments`
--

CREATE TABLE `payments` (
  `id` int(11) NOT NULL,
  `user_id` varchar(255) DEFAULT NULL,
  `code` varchar(255) DEFAULT NULL,
  `amount` varchar(255) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `domain` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `personal_access_tokens`
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

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `products`
--

CREATE TABLE `products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `category_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `data` text DEFAULT NULL,
  `status` varchar(255) DEFAULT '0',
  `user_buy_id` bigint(20) UNSIGNED DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `domain` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `produc_categories`
--

CREATE TABLE `produc_categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `note` varchar(255) DEFAULT NULL,
  `slug` varchar(255) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `code` varchar(255) DEFAULT NULL,
  `price` decimal(10,2) DEFAULT NULL,
  `domain` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `produc_categories`
--

INSERT INTO `produc_categories` (`id`, `name`, `description`, `note`, `slug`, `image`, `code`, `price`, `domain`, `created_at`, `updated_at`) VALUES
(8, 'Random LQ 100% trên 100 skin trải nghiệm', '<blockquote>\r\n<ol>\r\n<li>Random 100% tr&ecirc;n 100 skin trải nghiệm<br><em><strong>Chắc chắn skin tr&ecirc;n 100, ae test xem sao nh&eacute;, h&agrave;ng trải nghiệm kh&ocirc;ng bao log kh&ocirc;ng bao ban</strong></em></li>\r\n</ol>\r\n</blockquote>', 'Random 100% trên 100 skin trải nghiệm', 'acclienquangiarev1', '[\"uploads\\/1736582297893.jpg\"]', NULL, 1000.00, 'khosubvip.top', '2025-01-11 07:58:17', '2025-02-06 15:21:40'),
(22, 'Random LQ 25Đ- 50 ACC', '<p>Random LQ 25Đ- 50 ACC</p>', 'Random LQ 25Đ- 50 ACC', 'acclqvip1', '[\"uploads\\/1736702814529.jpg\"]', NULL, 1250.00, 'khosubvip.top', '2025-01-12 17:26:54', '2025-02-06 15:21:36'),
(23, 'Random LQ 25Đ- 100 ACC', '<p>Random LQ 25Đ- 100 ACC</p>', 'Random LQ 25Đ- 100 ACC', 'acclqvip2', '[\"uploads\\/1736702845540.jpg\"]', NULL, 2500.00, 'khosubvip.top', '2025-01-12 17:27:25', '2025-02-06 15:21:34'),
(25, 'Random FREE FIRE - Hàng Trải Nghiệm', '<p>Random FREE FIRE - H&agrave;ng Trải Nghiệm&nbsp;</p>', NULL, 'accffvip', '[\"uploads\\/1736703094211.png\"]', NULL, 100.00, 'khosubvip.top', '2025-01-12 17:31:34', '2025-02-06 15:21:31'),
(27, 'Random FREE FIRE - 100 ACC', '<p>Random FREE FIRE - 100 ACC </p>', 'Random FREE FIRE - 100 ACC', 'accffvip2', '[\"uploads\\/1736703225462.png\"]', NULL, 9500.00, 'khosubvip.top', '2025-01-12 17:33:25', '2025-02-06 15:20:13'),
(31, 'ACC VIP 1', '<p>TƯỚNG:98<br>TRANG PHỤC:141<br>RANK:KIM CƯƠNG<br>TH&Ocirc;NG TIN:TRẮNG</p>\r\n<p>Link ảnh đầy đủ : https://photos.app.goo.gl/zNuYFf1n8ArCNfwk7</p>', 'ACC TRẮNG THÔNG TIN', 'acclqvip1pro', '[\"uploads\\/desktop.png\"]', NULL, 300000.00, 'khosubvip.top', '2025-02-06 15:41:14', '2025-02-06 15:43:48'),
(32, 'ACC VIP 2', '<p>TƯỚNG:82<br>TRANG PHỤC:130<br>RANK:KIM CƯƠNG<br>TH&Ocirc;NG TIN:TRẮNG</p>\r\n<p>Link ảnh : https://photos.app.goo.gl/aZdAQx6XTnR1nvYY6</p>', 'ACC TRẮNG THÔNG TIN', 'acclqvip2pro', '[\"uploads\\/1738857327246.png\"]', NULL, 270000.00, 'khosubvip.top', '2025-02-06 15:55:27', '2025-02-06 15:55:27'),
(33, 'Netflix 1 tháng', '<p>Nếu qu&aacute; tải phải chờ bớt người rồi v&agrave;o xem</p>', 'Acc dùng chung', 'netflix', '[\"uploads\\/1738945896784.png\"]', NULL, 50000.00, 'khosubvip.top', '2025-02-07 16:31:36', '2025-02-07 16:31:36'),
(34, 'TUT REG ACC CAPCUT PRO', '<p>Hướng dẫn chi tiết gi&aacute; rẻ kh&ocirc;ng hỗ trợ qua ultra,c&oacute; h&igrave;nh ảnh đầy đủ</p>', 'Tut reg acc capcut pro 77days', 'tut-reg-acc-capcut-pro', '[\"uploads\\/1738977296536.jpg\"]', NULL, 5000.00, 'khosubvip.top', '2025-02-08 01:14:56', '2025-02-08 01:14:56');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `recharges`
--

CREATE TABLE `recharges` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `order_code` varchar(255) NOT NULL,
  `payment_method` varchar(255) NOT NULL,
  `bank_name` varchar(255) DEFAULT NULL,
  `bank_code` varchar(255) DEFAULT NULL,
  `amount` longtext DEFAULT NULL,
  `real_amount` longtext DEFAULT NULL,
  `status` enum('Success','Pending','Failed') NOT NULL DEFAULT 'Success',
  `note` longtext DEFAULT NULL,
  `is_send_telegram` tinyint(1) NOT NULL DEFAULT 0,
  `is_read` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `domain` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `server_actions`
--

CREATE TABLE `server_actions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `server_id` bigint(20) UNSIGNED NOT NULL,
  `get_uid` enum('on','off') NOT NULL DEFAULT 'off',
  `auto_price` enum('on','off') DEFAULT 'off',
  `quantity_status` enum('on','off') NOT NULL DEFAULT 'on',
  `reaction_status` enum('on','off') NOT NULL DEFAULT 'off',
  `reaction_data` longtext DEFAULT NULL,
  `comments_status` enum('on','off') NOT NULL DEFAULT 'off',
  `comments_data` longtext DEFAULT NULL,
  `minutes_status` enum('on','off') NOT NULL DEFAULT 'off',
  `minutes_data` longtext DEFAULT NULL,
  `posts_status` enum('on','off') NOT NULL DEFAULT 'off',
  `posts_data` longtext DEFAULT NULL,
  `time_status` enum('on','off') NOT NULL DEFAULT 'off',
  `time_data` longtext DEFAULT NULL,
  `duration_status` enum('on','off') NOT NULL DEFAULT 'off',
  `duration_data` longtext DEFAULT NULL,
  `warranty_status` enum('on','off') NOT NULL DEFAULT 'off',
  `refund_status` enum('on','off') NOT NULL DEFAULT 'on',
  `renews_status` enum('on','off') NOT NULL DEFAULT 'off',
  `renew_type` enum('auto','manual') NOT NULL DEFAULT 'auto',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `domain` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `services`
--

CREATE TABLE `services` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `order` int(11) NOT NULL DEFAULT 0,
  `code` varchar(255) DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `description` longtext DEFAULT NULL,
  `note` longtext DEFAULT NULL,
  `details` longtext DEFAULT NULL,
  `blogs` longtext DEFAULT NULL,
  `package` varchar(255) DEFAULT NULL,
  `slug` varchar(255) NOT NULL,
  `image` longtext DEFAULT NULL,
  `status` enum('active','inactive') NOT NULL DEFAULT 'active',
  `platform_id` bigint(20) UNSIGNED NOT NULL,
  `reaction_status` enum('on','off') NOT NULL DEFAULT 'off',
  `quantity_status` enum('on','off') NOT NULL DEFAULT 'off',
  `comments_status` enum('on','off') NOT NULL DEFAULT 'off',
  `minutes_status` enum('on','off') NOT NULL DEFAULT 'off',
  `time_status` enum('on','off') NOT NULL DEFAULT 'off',
  `posts_status` enum('on','off') NOT NULL DEFAULT 'off',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `domain` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `service_platforms`
--

CREATE TABLE `service_platforms` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `order` int(11) NOT NULL DEFAULT 0,
  `code` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `description` longtext DEFAULT NULL,
  `slug` varchar(255) NOT NULL,
  `image` longtext DEFAULT NULL,
  `status` enum('active','inactive') NOT NULL DEFAULT 'active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `domain` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `service_servers`
--

CREATE TABLE `service_servers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `service_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `details` longtext DEFAULT NULL,
  `package_id` int(11) DEFAULT NULL,
  `price` longtext DEFAULT NULL,
  `price_update` varchar(255) NOT NULL,
  `price_member` longtext DEFAULT NULL,
  `price_collaborator` longtext DEFAULT NULL,
  `price_agency` longtext DEFAULT NULL,
  `price_distributor` longtext DEFAULT NULL,
  `min` int(11) NOT NULL DEFAULT 1,
  `max` int(11) NOT NULL DEFAULT 1,
  `limit_day` int(11) NOT NULL DEFAULT 0,
  `percents` text DEFAULT NULL,
  `status` enum('active','inactive') NOT NULL DEFAULT 'active',
  `visibility` enum('public','private') NOT NULL DEFAULT 'public',
  `providerLink` longtext DEFAULT NULL,
  `providerServer` longtext DEFAULT NULL,
  `providerName` longtext DEFAULT NULL,
  `providerKey` longtext DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `domain` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `smms`
--

CREATE TABLE `smms` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `token` text DEFAULT NULL,
  `tigia` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `domain` varchar(255) DEFAULT NULL,
  `code` varchar(255) DEFAULT NULL,
  `order` int(11) DEFAULT NULL,
  `balance` text DEFAULT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'inactive'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tickets`
--

CREATE TABLE `tickets` (
  `id` int(11) NOT NULL,
  `username` varchar(999) DEFAULT NULL,
  `title` longtext DEFAULT NULL,
  `body` longtext DEFAULT NULL,
  `reply` longtext DEFAULT NULL,
  `level` varchar(255) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `domain` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `tickets`
--

INSERT INTO `tickets` (`id`, `username`, `title`, `body`, `reply`, `level`, `status`, `created_at`, `updated_at`, `domain`) VALUES
(1, '1', '_17387391484770', 'Tăng tốc', '<p>Ok</p>', 'Thấp', 'success', '2025-02-05 07:10:16', '2025-02-05 07:10:42', 'khosubvip.top'),
(3, '92', 'nạp tiền k vào', 'nạp tiền k vào', '<p>v&agrave;o chưa bạn</p>', 'Cao', 'success', '2025-02-11 13:23:54', '2025-02-18 04:15:25', 'khosubvip.top'),
(4, '127', 'Nạp tiền thẻ cào lâu', 'Alo', '<p>nghe b</p>', 'Khẩn Cấp', 'success', '2025-02-17 08:17:40', '2025-02-18 04:15:33', 'khosubvip.top');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `transactions`
--

CREATE TABLE `transactions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `tran_code` varchar(255) NOT NULL,
  `type` varchar(255) DEFAULT NULL,
  `action` enum('add','sub') NOT NULL DEFAULT 'add',
  `first_balance` longtext DEFAULT NULL,
  `before_balance` longtext DEFAULT NULL,
  `after_balance` longtext DEFAULT NULL,
  `note` longtext DEFAULT NULL,
  `ip` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `domain` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(999) DEFAULT '$argon2id$v=19$m=65536,t=4,p=1$Z09rZWNIdnkyS1FRb1ZjWA$gqkZlyyTAaT1sLwL6W+N5CI+J6581x6V6l2VZ7FiRzs',
  `konkac` varchar(255) DEFAULT 'fZgIgRLpZASc41qN',
  `role` enum('member','admin') NOT NULL DEFAULT 'member' COMMENT 'Chức vụ của người dùng',
  `level` enum('member','collaborator','agency','distributor') NOT NULL DEFAULT 'member' COMMENT 'Cấp độ của người dùng',
  `balance` longtext NOT NULL COMMENT 'Số dư tài khoản',
  `total_recharge` longtext NOT NULL COMMENT 'Tổng số dư tài khoản',
  `status` enum('active','inactive','banned') NOT NULL DEFAULT 'active' COMMENT 'Trạng thái của người dùng',
  `facebook` varchar(255) DEFAULT NULL COMMENT 'Đường dẫn tới facebook của người dùng',
  `telegram_link` varchar(255) DEFAULT NULL COMMENT 'Đường dẫn tới telegram của người dùng',
  `telegram_id` varchar(255) DEFAULT NULL COMMENT 'ID telegram của người dùng',
  `notification_email` enum('yes','no') NOT NULL DEFAULT 'yes' COMMENT 'Cho phép gửi thông báo qua email',
  `notification_telegram` enum('yes','no') NOT NULL DEFAULT 'yes' COMMENT 'Cho phép gửi thông báo qua telegram',
  `two_factor_auth` enum('yes','no') NOT NULL DEFAULT 'no' COMMENT 'Cho phép xác thực 2 yếu tố',
  `two_factor_secret` varchar(255) DEFAULT NULL COMMENT 'Mã bí mật xác thực 2 yếu tố',
  `avatar` varchar(255) DEFAULT NULL COMMENT 'Ảnh đại diện của người dùng',
  `api_token` longtext DEFAULT NULL COMMENT 'Token của người dùng',
  `last_login` varchar(255) DEFAULT NULL COMMENT 'Thời gian đăng nhập cuối cùng',
  `last_ip` varchar(255) DEFAULT NULL COMMENT 'Địa chỉ IP đăng nhập cuối cùng',
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `domain` varchar(255) DEFAULT NULL COMMENT 'Tên miền của người dùng',
  `ref_id` varchar(255) DEFAULT NULL,
  `total_money_ref` varchar(255) DEFAULT NULL,
  `referral_money` varchar(255) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `user_activities`
--

CREATE TABLE `user_activities` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `ip` varchar(255) NOT NULL,
  `user_agent` varchar(255) NOT NULL,
  `activity` varchar(255) NOT NULL,
  `note` longtext DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `domain` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `vouchers`
--

CREATE TABLE `vouchers` (
  `id` int(11) NOT NULL,
  `name` text DEFAULT NULL,
  `percent` varchar(255) DEFAULT NULL,
  `limitUser` varchar(255) DEFAULT NULL,
  `user_voucher` text DEFAULT NULL,
  `timeStart` varchar(999) DEFAULT NULL,
  `timeEnd` varchar(999) DEFAULT NULL,
  `order` varchar(255) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `domain` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `withdraws`
--

CREATE TABLE `withdraws` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` varchar(255) DEFAULT NULL,
  `amount` varchar(999) DEFAULT NULL,
  `bank_name` varchar(255) DEFAULT NULL,
  `account_number` varchar(255) DEFAULT NULL,
  `account_name` varchar(255) DEFAULT NULL,
  `status` varchar(999) NOT NULL DEFAULT 'open',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `domain` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `bankings`
--
ALTER TABLE `bankings`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Chỉ mục cho bảng `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- Chỉ mục cho bảng `cards`
--
ALTER TABLE `cards`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `configs`
--
ALTER TABLE `configs`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `config_sites`
--
ALTER TABLE `config_sites`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Chỉ mục cho bảng `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Chỉ mục cho bảng `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `notice_services`
--
ALTER TABLE `notice_services`
  ADD PRIMARY KEY (`id`),
  ADD KEY `notice_services_user_id_foreign` (`user_id`);

--
-- Chỉ mục cho bảng `notice_systems`
--
ALTER TABLE `notice_systems`
  ADD PRIMARY KEY (`id`),
  ADD KEY `notice_systems_user_id_foreign` (`user_id`);

--
-- Chỉ mục cho bảng `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `partner_websites`
--
ALTER TABLE `partner_websites`
  ADD PRIMARY KEY (`id`),
  ADD KEY `partner_websites_user_id_foreign` (`user_id`);

--
-- Chỉ mục cho bảng `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Chỉ mục cho bảng `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`id`);

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
  ADD PRIMARY KEY (`id`),
  ADD KEY `category_id` (`category_id`);

--
-- Chỉ mục cho bảng `produc_categories`
--
ALTER TABLE `produc_categories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `slug` (`slug`);

--
-- Chỉ mục cho bảng `recharges`
--
ALTER TABLE `recharges`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `recharges_order_code_unique` (`order_code`),
  ADD KEY `recharges_user_id_foreign` (`user_id`);

--
-- Chỉ mục cho bảng `server_actions`
--
ALTER TABLE `server_actions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `server_actions_server_id_foreign` (`server_id`);

--
-- Chỉ mục cho bảng `services`
--
ALTER TABLE `services`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `services_slug_unique` (`slug`),
  ADD UNIQUE KEY `services_code_unique` (`code`),
  ADD UNIQUE KEY `services_package_unique` (`package`),
  ADD KEY `services_platform_id_foreign` (`platform_id`);

--
-- Chỉ mục cho bảng `service_platforms`
--
ALTER TABLE `service_platforms`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `service_platforms_code_unique` (`code`),
  ADD UNIQUE KEY `service_platforms_slug_unique` (`slug`);

--
-- Chỉ mục cho bảng `service_servers`
--
ALTER TABLE `service_servers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `service_servers_service_id_foreign` (`service_id`);

--
-- Chỉ mục cho bảng `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Chỉ mục cho bảng `smms`
--
ALTER TABLE `smms`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `tickets`
--
ALTER TABLE `tickets`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `transactions`
--
ALTER TABLE `transactions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `transactions_tran_code_unique` (`tran_code`),
  ADD KEY `transactions_user_id_foreign` (`user_id`);

--
-- Chỉ mục cho bảng `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Chỉ mục cho bảng `user_activities`
--
ALTER TABLE `user_activities`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_activities_user_id_foreign` (`user_id`);

--
-- Chỉ mục cho bảng `vouchers`
--
ALTER TABLE `vouchers`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `bankings`
--
ALTER TABLE `bankings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `cards`
--
ALTER TABLE `cards`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT cho bảng `configs`
--
ALTER TABLE `configs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT cho bảng `config_sites`
--
ALTER TABLE `config_sites`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `notice_services`
--
ALTER TABLE `notice_services`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `notice_systems`
--
ALTER TABLE `notice_systems`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `orders`
--
ALTER TABLE `orders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `partner_websites`
--
ALTER TABLE `partner_websites`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `payments`
--
ALTER TABLE `payments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `produc_categories`
--
ALTER TABLE `produc_categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT cho bảng `recharges`
--
ALTER TABLE `recharges`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `server_actions`
--
ALTER TABLE `server_actions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `services`
--
ALTER TABLE `services`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `service_platforms`
--
ALTER TABLE `service_platforms`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `service_servers`
--
ALTER TABLE `service_servers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `smms`
--
ALTER TABLE `smms`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `tickets`
--
ALTER TABLE `tickets`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT cho bảng `transactions`
--
ALTER TABLE `transactions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `user_activities`
--
ALTER TABLE `user_activities`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `vouchers`
--
ALTER TABLE `vouchers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `produc_categories` (`id`) ON DELETE CASCADE;

--
-- Các ràng buộc cho bảng `services`
--
ALTER TABLE `services`
  ADD CONSTRAINT `services_platform_id_foreign` FOREIGN KEY (`platform_id`) REFERENCES `service_platforms` (`id`);

--
-- Các ràng buộc cho bảng `service_servers`
--
ALTER TABLE `service_servers`
  ADD CONSTRAINT `service_servers_service_id_foreign` FOREIGN KEY (`service_id`) REFERENCES `services` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
