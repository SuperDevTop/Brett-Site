-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 20, 2022 at 05:22 PM
-- Server version: 10.4.20-MariaDB
-- PHP Version: 8.0.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `weedmaps`
--

-- --------------------------------------------------------

--
-- Table structure for table `advertisement_banners`
--

CREATE TABLE `advertisement_banners` (
  `id` int(11) NOT NULL,
  `banner_image` varchar(255) DEFAULT NULL,
  `third_party_code` longtext DEFAULT NULL,
  `location` varchar(255) DEFAULT NULL,
  `type` varchar(255) DEFAULT NULL,
  `status` int(11) DEFAULT 1,
  `lat` varchar(255) NOT NULL,
  `lon` varchar(255) NOT NULL,
  `redirect_url` varchar(255) NOT NULL,
  `location_name` varchar(255) NOT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `advertisement_banners`
--

INSERT INTO `advertisement_banners` (`id`, `banner_image`, `third_party_code`, `location`, `type`, `status`, `lat`, `lon`, `redirect_url`, `location_name`, `created_at`, `updated_at`) VALUES
(19, '1725837840659249.png', NULL, 'user_profile', 'web', 1, '31.4515431', '74.3949027', '', 'Lahore Ring Road, Block A Bankers Town, Lahore, Pakistan', '2022-02-26 19:53:42', NULL),
(20, '1725837920203518.jpg', NULL, 'user_profile', 'web', 1, '31.4515431', '74.3949027', '', 'Lahore Ring Road, Block A Bankers Town, Lahore, Pakistan', '2022-02-26 19:54:58', NULL),
(21, '1725838494041746.jpg', NULL, 'map_page', 'web', 1, '31.4515431', '74.3949027', '', 'Lahore Ring Road, Block A Bankers Town, Lahore, Pakistan', '2022-02-26 20:04:06', NULL),
(22, '1727561337117335.png', '', 'user_profile', 'web', 1, '31.52980299999999', '74.2591272', 'test.com', 'Lahore-Islamabad Motorway, Sabzazar Block E Sabzazar Housing Scheme Phase 1 & 2 Lahore, Pakistan', '2022-03-17 20:27:57', '2022-03-17 15:29:00'),
(23, '1727561664442113.png', NULL, 'map_page', 'web', 1, '31.52980299999999', '74.2591272', 'https://www.google.com/', 'Lahore-Islamabad Motorway, Sabzazar Block E Sabzazar Housing Scheme Phase 1 & 2 Lahore, Pakistan', '2022-03-17 20:33:09', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `amenities`
--

CREATE TABLE `amenities` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `cat_image` varchar(255) DEFAULT NULL,
  `updated_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `amenities`
--

INSERT INTO `amenities` (`id`, `name`, `cat_image`, `updated_at`) VALUES
(1, 'Accessible', '1712589832535865.png', '2021-10-03 09:22:17'),
(2, 'Minimium Age', '1712589196307218.png', '2021-10-03 09:12:11'),
(3, 'ATM', '1712589255309747.png', '2021-10-03 14:13:07'),
(4, 'Security', '1712589266852208.png', '2021-10-03 14:13:18'),
(5, 'Brand Verified', '1712589293098483.png', '2021-10-03 14:13:43'),
(6, 'Videos', '1712589302549668.png', '2021-10-03 14:13:52'),
(7, 'Best of Bud & Carriage', '1712589328552429.png', '2021-10-03 14:14:17');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` int(11) NOT NULL COMMENT '1=active, 0=Deactive',
  `cat_image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `status`, `cat_image`, `created_at`, `updated_at`) VALUES
(1, 'Doctors', 1, '1709808377567271.jpg', NULL, '2021-09-02 11:32:15'),
(2, 'Dispensaries', 1, '1709808394180001.jpg', NULL, '2021-09-02 11:32:31'),
(3, 'Deliveries', 1, '1709808369610708.png', NULL, '2021-09-02 11:32:08');

-- --------------------------------------------------------

--
-- Table structure for table `cms_landing_pages`
--

CREATE TABLE `cms_landing_pages` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image_name` varchar(2048) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cms_landing_pages`
--

INSERT INTO `cms_landing_pages` (`id`, `title`, `description`, `image_name`, `created_at`, `updated_at`) VALUES
(1, 'About Bud & Carriage', 'The company was founded in 2008 with a strong belief in the power of cannabis and the importance of enabling safe, legal access to consumers worldwide. Since then, WM Technology has worked tirelessly, not only to be the most comprehensive platform for consumers, but to build the software solutions that power businesses compliantly in the space, to advocate for legalization, social equity, and licensing in many jurisdictions, and to facilitate further learning through partnering with dozens of subject matter experts on providing detailed, accurate information about the plant.\n\n \n\nWM Technology’s mission is to power a transparent and inclusive global cannabis economy. Now in its second decade, \n\nWM Technology has been a driving force behind much of the legislative change we’ve seen in the past 10 years.\n\nOur signature consumer-facing platform (available on the web at www.weedmaps.com, as well as through native Android and iOS apps), provides consumers with information regarding cannabis products, including online ordering, local retailer and brand listings, product discovery, and consumer education on cannabis and its history, uses, and legal status. \n\n\n\n', '1724491119714805.png', NULL, '2022-02-11 13:08:09'),
(2, 'Business Plan Description', 'The company was founded in 2008 with a strong belief in the power of cannabis and the importance of enabling safe, legal access to consumers worldwide. Since then, WM Technology has worked tirelessly, not only to be the most comprehensive platform for consumers, but to build the software solutions that power businesses compliantly in the space, to advocate for legalization, social equity, and licensing in many jurisdictions, and to facilitate further learning through partnering with dozens of subject matter experts on providing detailed, accurate information about the plant. WM Technology’s mission is to power a transparent and inclusive global cannabis economy. Now in its second decade, WM Technology has been a driving force behind much of the legislative change we’ve seen in the past 10 years. Our signature consumer-facing platform (available on the web at www.weedmaps.com, as well as through native Android and iOS apps), provides consumers with information regarding cannabis products, including online ordering, local retailer and brand listings, product discovery, and consumer education on cannabis and its history, uses, and legal status.', '1729328862571304.jpg', NULL, '2022-04-05 22:42:31');

-- --------------------------------------------------------

--
-- Table structure for table `cms_product_pages`
--

CREATE TABLE `cms_product_pages` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `menu` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `details` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `deals` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `review` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `media` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cms_product_pages`
--

INSERT INTO `cms_product_pages` (`id`, `menu`, `details`, `deals`, `review`, `media`, `created_at`, `updated_at`) VALUES
(1, 'Menu', 'Details', 'Deals', 'Review', 'Media', NULL, '2022-02-15 11:10:34');

-- --------------------------------------------------------

--
-- Table structure for table `contact_us_queries`
--

CREATE TABLE `contact_us_queries` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `subject` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `message` longtext NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `contact_us_queries`
--

INSERT INTO `contact_us_queries` (`id`, `name`, `email`, `subject`, `phone`, `message`, `created_at`) VALUES
(3, 'Myles Duncan Allen Compton', 'wyzij@mailinator.com', 'Sed nesciunt sit t', '', 'Cupiditate id dolore', '2022-03-24 22:16:25');

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
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `favourites`
--

CREATE TABLE `favourites` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `prod_deal_id` int(11) NOT NULL,
  `store_id` int(11) NOT NULL,
  `type` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `favourites`
--

INSERT INTO `favourites` (`id`, `user_id`, `prod_deal_id`, `store_id`, `type`, `created_at`) VALUES
(31, 5630, 25, 42, '', '2022-03-27 22:08:03'),
(32, 5630, 12, 43, '', '2022-03-27 22:08:46'),
(33, 5649, 25, 42, '', '2022-04-09 15:10:48'),
(34, 5649, 12, 43, '', '2022-04-09 15:11:36'),
(35, 5649, 37, 42, '', '2022-04-09 15:12:08'),
(36, 5649, 28, 42, '', '2022-04-09 15:12:42');

-- --------------------------------------------------------

--
-- Table structure for table `followers`
--

CREATE TABLE `followers` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `store_id` int(11) NOT NULL,
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `followers`
--

INSERT INTO `followers` (`id`, `user_id`, `store_id`, `created_at`) VALUES
(32, 5631, 42, '2022-02-26 20:07:45'),
(33, 5631, 43, '2022-03-12 12:15:22');

-- --------------------------------------------------------

--
-- Table structure for table `footer_cms`
--

CREATE TABLE `footer_cms` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `url` varchar(255) NOT NULL,
  `parent_child_relation` int(11) NOT NULL,
  `order_by` int(11) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `footer_cms`
--

INSERT INTO `footer_cms` (`id`, `name`, `url`, `parent_child_relation`, `order_by`, `created_at`) VALUES
(1, 'About', '', 0, 1, '2022-04-08 22:08:46'),
(2, 'Contact Us', '', 0, 0, '2022-04-08 22:09:03'),
(3, 'Social', '', 0, 0, '2022-04-08 22:09:11'),
(4, 'Contact Link 1', '', 2, 1, '2022-04-08 22:09:20'),
(5, 'Contact Link 2', '', 2, 2, '2022-04-08 22:09:27'),
(6, 'S Link 1', '', 3, 0, '2022-04-08 22:09:48'),
(7, 'About 1', '', 1, 0, '2022-04-08 22:09:58'),
(8, 'About 2', '', 1, 0, '2022-04-08 22:10:04'),
(9, 'About 3', '', 1, 0, '2022-04-08 22:10:11');

-- --------------------------------------------------------

--
-- Table structure for table `location_banners`
--

CREATE TABLE `location_banners` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `cat_image` varchar(255) DEFAULT NULL,
  `lat` varchar(255) DEFAULT NULL,
  `lon` varchar(255) DEFAULT NULL,
  `updated_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `location_banners`
--

INSERT INTO `location_banners` (`id`, `name`, `cat_image`, `lat`, `lon`, `updated_at`) VALUES
(16, 'Lahore-Islamabad Motorway, Sabzazar Block E Sabzazar Housing Scheme Phase 1 & 2 Lahore, Pakistan', '1726753280647006.jpg', '31.52980299999999', '74.2591272', '2022-03-08 22:24:14');

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
(5, '2021_08_30_152610_create_categories_table', 2),
(8, '2021_08_31_135805_create_plans_table', 3),
(9, '2021_09_01_152221_create_stores_table', 4),
(11, '2021_09_02_131856_create_cms_landing_pages_table', 5),
(12, '2021_09_02_163755_create_cms_product_pages_table', 6);

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `id` int(11) NOT NULL,
  `store_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 0,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `notifications`
--

INSERT INTO `notifications` (`id`, `store_id`, `name`, `email`, `phone`, `status`, `created_at`) VALUES
(1, 42, 'name', 'asdasd@gmail.com', '157465', 2, '2022-03-22 19:37:37'),
(9, 42, 'Tobias Logan Scott Velasquez', 'vaceby@mailinator.com', '36', 0, '2022-03-24 22:46:20'),
(10, 42, 'Tobias Logan Scott Velasquez', 'vaceby@mailinator.com', '36', 0, '2022-03-24 22:46:27'),
(11, 50, 'Nafees khan Lodhi', 'nafeeskhanlodhi2@gmail.com', '0324413626', 0, '2022-04-10 19:39:09');

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
-- Table structure for table `payment_method_settings`
--

CREATE TABLE `payment_method_settings` (
  `id` int(11) NOT NULL,
  `method_name_static` varchar(255) NOT NULL,
  `method_name` varchar(255) NOT NULL,
  `method_key` varchar(255) NOT NULL,
  `method_secret` varchar(255) NOT NULL,
  `method_redirect_url` varchar(255) NOT NULL,
  `fee_measurement` varchar(255) NOT NULL,
  `processing_fee` varchar(255) NOT NULL,
  `status` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `payment_method_settings`
--

INSERT INTO `payment_method_settings` (`id`, `method_name_static`, `method_name`, `method_key`, `method_secret`, `method_redirect_url`, `fee_measurement`, `processing_fee`, `status`) VALUES
(1, 'Paypal', 'Paypal', 'mHaLMYdtf83Lqpaijft7hzXg', 'zS58vIC7ZlXUWjbGNcyuVc9X', 'http://localhost/budcarriage', 'fixed', '15', 0),
(2, 'Stripe', 'Stripe', 'pk_test_51HUbKcKOosMXqESwrNVTxPJ5tWmbDOODQUGDFiZ8i3OufUH3M8GcZOfAbHGEbweutL4Wc6xvTWEI2RPT3gfj1uhS00KDJr3E7I', 'sk_test_51HUbKcKOosMXqESwaziyz0GEfXClruqbHu7wnwYBC04fEqs4f2i1AcQPR77pVVvqIr64tA8Sc3QjsfAHZP72BUDv00NGX8QvsZ', 'http://localhost/budcarriage', 'percentage', '25', 1);

-- --------------------------------------------------------

--
-- Table structure for table `plans`
--

CREATE TABLE `plans` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `plane_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` double(8,2) NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `plan_options_checkboxes` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `plan_options_checkboxes_value` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `feature_listing_rotation` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `products_shoe_of_category` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `category_id` int(11) NOT NULL,
  `status` int(11) NOT NULL COMMENT '1=active, 0=Deactive',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `plans`
--

INSERT INTO `plans` (`id`, `plane_name`, `price`, `image`, `description`, `plan_options_checkboxes`, `plan_options_checkboxes_value`, `feature_listing_rotation`, `products_shoe_of_category`, `category_id`, `status`, `created_at`, `updated_at`) VALUES
(1, 'BASIC FREE PLAN', 0.00, '1725664695957841.png', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s,', '{\"show_company_name\":\"Company Name\",\"show_address\":\"Company Address\",\"show_company_logo\":\"Company Logo\",\"show_markers_on_maps\":\"Markes on Maps\",\"premium_map_icons\":\"Premium Bigger Map Icon\",\"show_store_hours\":\"Business Hours\",\"show_phone_number\":\"Business Phone NUmber\",\"feature_listing_x_per_day\":null,\"products_to_show\":null}', '{\"show_company_name\":\"Company Name\",\"show_address\":\"Company Address\",\"show_company_logo\":\"Company Logo\",\"show_markers_on_maps\":\"Markes on Maps\",\"premium_map_icons\":\"Premium Bigger Map Icon\",\"show_store_hours\":\"Business Hours\",\"show_phone_number\":\"Business Phone NUmber\",\"feature_listing_x_per_day\":null,\"products_to_show\":null}', NULL, NULL, 1, 1, NULL, '2022-02-24 12:01:39'),
(2, 'Tier 1', 20.00, '1725664710786429.png', 'It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using \'Content here, content here\',', '{\"show_review_on_listing_page\":\"Reviews on Listing Page\",\"offer_discounts_deals\":\"Business Deals\",\"include_photos\":\"Include Business Photos\",\"import_photos\":\"Import Business Photos\",\"import_videos\":\"Import Business Videos\",\"about_us_information\":\"About Us Information\",\"feature_listing_x_per_day\":\"2\",\"products_to_show\":null}', '{\"show_review_on_listing_page\":\"Reviews on Listing Page\",\"offer_discounts_deals\":\"Business Deals\",\"include_photos\":\"Include Business Photos\",\"import_photos\":\"Import Business Photos\",\"import_videos\":\"Import Business Videos\",\"about_us_information\":\"About Us Information\",\"feature_listing_x_per_day\":\"2\",\"products_to_show\":null}', '2', NULL, 1, 1, NULL, '2022-02-24 12:01:53'),
(3, 'Tier 1', 50.00, '1725664869660028.png', 'Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia', '{\"show_company_name\":\"Company Name\",\"show_address\":\"Company Address\",\"show_company_logo\":\"Company Logo\",\"show_markers_on_maps\":\"Markes on Maps\",\"premium_map_icons\":\"Premium Bigger Map Icon\",\"show_store_hours\":\"Business Hours\",\"show_phone_number\":\"Business Phone NUmber\",\"feature_listing_x_per_day\":null,\n\"products_to_show\":\"5\"}', '{\"show_company_name\":\"Company Name\",\"show_address\":\"Company Address\",\"show_company_logo\":\"Company Logo\",\"show_markers_on_maps\":\"Markes on Maps\",\"premium_map_icons\":\"Premium Bigger Map Icon\",\"show_store_hours\":\"Business Hours\",\"show_phone_number\":\"Business Phone NUmber\",\"feature_listing_x_per_day\":null,\n\"products_to_show\":\"5\"}', NULL, '5', 3, 1, NULL, NULL),
(4, 'Tier 2', 125.00, '1725665166619605.png', 'There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don\'t look even slightly believable.', '{\"show_company_name\":\"Company Name\",\"show_address\":\"Company Address\",\"show_company_logo\":\"Company Logo\",\"show_markers_on_maps\":\"Markes on Maps\",\"premium_map_icons\":\"Premium Bigger Map Icon\",\"show_store_hours\":\"Business Hours\",\"show_review_on_listing_page\":\"Reviews on Listing Page\",\"show_phone_number\":\"Business Phone Number\",\"about_us_information\":\"About Us Information\",\"feature_listing_x_per_day\":\"5\",\"products_to_show\":\"20\"}', '{\"show_company_name\":\"Company Name\",\"show_address\":\"Company Address\",\"show_company_logo\":\"Company Logo\",\"show_markers_on_maps\":\"Markes on Maps\",\"premium_map_icons\":\"Premium Bigger Map Icon\",\"show_store_hours\":\"Business Hours\",\"show_review_on_listing_page\":\"Reviews on Listing Page\",\"show_phone_number\":\"Business Phone Number\",\"about_us_information\":\"About Us Information\",\"feature_listing_x_per_day\":\"5\",\"products_to_show\":\"20\"}', '5', '20', 3, 1, NULL, NULL),
(5, 'Tier 2', 200.00, '1725665231728221.png', 'There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don\'t look even slightly believable.', '{\"show_company_name\":\"Company Name\",\"show_address\":\"Company Address\",\"show_company_logo\":\"Company Logo\",\"show_markers_on_maps\":\"Markes on Maps\",\"premium_map_icons\":\"Premium Bigger Map Icon\",\"show_store_hours\":\"Business Hours\",\"show_review_on_listing_page\":\"Reviews on Listing Page\",\"offer_discounts_deals\":\"Business Deals\",\"show_phone_number\":\"Business Phone NUmber\",\"include_photos\":\"Include Business Photos\",\"import_photos\":\"Import Business Photos\",\"import_videos\":\"Import Business Videos\",\"delivery_service_description\":\"Delivery Service Description\",\"about_us_information\":\"About Us Information\",\"feature_listing_x_per_day\":\"5\",\n\"products_to_show\":\"250\"}', '{\"show_company_name\":\"Company Name\",\"show_address\":\"Company Address\",\"show_company_logo\":\"Company Logo\",\"show_markers_on_maps\":\"Markes on Maps\",\"premium_map_icons\":\"Premium Bigger Map Icon\",\"show_store_hours\":\"Business Hours\",\"show_review_on_listing_page\":\"Reviews on Listing Page\",\"offer_discounts_deals\":\"Business Deals\",\"show_phone_number\":\"Business Phone NUmber\",\"include_photos\":\"Include Business Photos\",\"import_photos\":\"Import Business Photos\",\"import_videos\":\"Import Business Videos\",\"delivery_service_description\":\"Delivery Service Description\",\"about_us_information\":\"About Us Information\",\"feature_listing_x_per_day\":\"5\",\n\"products_to_show\":\"250\"}', '5', '250', 3, 1, NULL, NULL),
(6, 'BASIC FREE PLAN', 0.00, '1725665669672229.png', 'There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don\'t look even slightly believable.', '{\"show_company_name\":\"Company Name\",\"show_address\":\"Company Address\",\"show_company_logo\":\"Company Logo\",\"show_markers_on_maps\":\"Markes on Maps\",\"premium_map_icons\":\"Premium Bigger Map Icon\",\"feature_listing_x_per_day\":null,\"products_to_show\":\"3\"}', '{\"show_company_name\":\"Company Name\",\"show_address\":\"Company Address\",\"show_company_logo\":\"Company Logo\",\"show_markers_on_maps\":\"Markes on Maps\",\"premium_map_icons\":\"Premium Bigger Map Icon\",\"feature_listing_x_per_day\":null,\"products_to_show\":\"3\"}', NULL, '3', 2, 1, NULL, NULL),
(7, 'Tier 1', 50.00, '1725665947425861.png', 'There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don\'t look even slightly believable.', '{\"show_company_name\":\"Company Name\",\"show_address\":\"Company Address\",\"show_business_description\":\"Business Description\",\"show_store_hours\":\"Business Hours\",\"show_phone_number\":\"Business Phone NUmber\",\"delivery_service_description\":\"Delivery Service Description\",\"feature_listing_x_per_day\":null,\"products_to_show\":\"5\"}', '{\"show_company_name\":\"Company Name\",\"show_address\":\"Company Address\",\"show_business_description\":\"Business Description\",\"show_store_hours\":\"Business Hours\",\"show_phone_number\":\"Business Phone NUmber\",\"delivery_service_description\":\"Delivery Service Description\",\"feature_listing_x_per_day\":null,\"products_to_show\":\"5\"}', NULL, '5', 2, 1, NULL, NULL),
(8, 'TIER 2', 150.00, '1725666056388621.png', 'There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don\'t look even slightly believable.', '{\"show_company_name\":\"Company Name\",\"show_address\":\"Company Address\",\"show_company_logo\":\"Company Logo\",\"show_business_description\":\"Business Address\",\"link_to_website_listing_page\":\"Link to Business Website\",\"link_with_social_media\":\"Link to Social Media\",\"show_store_hours\":\"Business Hours\",\"show_review_on_listing_page\":\"Reviews on Listing Page\",\"show_phone_number\":\"Business Phone NUmber\",\"include_photos\":\"Include Business Photos\",\"import_photos\":\"Import Business Photos\",\"delivery_service_description\":\"Delivery Service Description\",\"feature_listing_x_per_day\":null,\n\"products_to_show\":\"10\"}', '{\"show_company_name\":\"Company Name\",\"show_address\":\"Company Address\",\"show_company_logo\":\"Company Logo\",\"show_business_description\":\"Business Address\",\"link_to_website_listing_page\":\"Link to Business Website\",\"link_with_social_media\":\"Link to Social Media\",\"show_store_hours\":\"Business Hours\",\"show_review_on_listing_page\":\"Reviews on Listing Page\",\"show_phone_number\":\"Business Phone NUmber\",\"include_photos\":\"Include Business Photos\",\"import_photos\":\"Import Business Photos\",\"delivery_service_description\":\"Delivery Service Description\",\"feature_listing_x_per_day\":null,\n\"products_to_show\":\"10\"}', NULL, '10', 2, 1, NULL, NULL),
(9, 'TIER 3', 250.00, '1725666097065333.png', 'There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don\'t look even slightly believable.', '{\"show_company_name\":\"Company Name\",\"show_address\":\"Company Address\",\"show_company_logo\":\"Company Logo\",\"show_business_description\":\"Business Description\",\"show_markers_on_maps\":\"Markes on Maps\",\"premium_map_icons\":\"Premium Bigger Map Icon\",\"link_to_website_listing_page\":\"Link to Business Website\",\"link_with_social_media\":\"Link to Social Media\",\"show_store_hours\":\"Business Hours\",\"show_review_on_listing_page\":\"Reviews on Listing Page\",\"offer_discounts_deals\":\"Business Deals\",\"show_phone_number\":\"Business Phone NUmber\",\"include_photos\":\"Include Business Photos\",\"import_photos\":\"Import Business Photos\",\"import_videos\":\"Import Business Videos\",\"delivery_service_description\":\"Delivery Service Description\",\"about_us_information\":\"About Us Information\",\"feature_listing_x_per_day\":null,\"products_to_show\":\"200\"}', '{\"show_company_name\":\"Company Name\",\"show_address\":\"Company Address\",\"show_company_logo\":\"Company Logo\",\"show_business_description\":\"Business Description\",\"show_markers_on_maps\":\"Markes on Maps\",\"premium_map_icons\":\"Premium Bigger Map Icon\",\"link_to_website_listing_page\":\"Link to Business Website\",\"link_with_social_media\":\"Link to Social Media\",\"show_store_hours\":\"Business Hours\",\"show_review_on_listing_page\":\"Reviews on Listing Page\",\"offer_discounts_deals\":\"Business Deals\",\"show_phone_number\":\"Business Phone NUmber\",\"include_photos\":\"Include Business Photos\",\"import_photos\":\"Import Business Photos\",\"import_videos\":\"Import Business Videos\",\"delivery_service_description\":\"Delivery Service Description\",\"about_us_information\":\"About Us Information\",\"feature_listing_x_per_day\":null,\"products_to_show\":\"200\"}', NULL, '200', 2, 1, NULL, NULL),
(11, 'Halla Watts', 468.00, '', 'Quis nisi pariatur', '{\"show_business_description\":\"Business Description\",\"show_markers_on_maps\":\"Markes on Maps\",\"premium_map_icons\":\"Premium Bigger Map Icon\",\"link_with_social_media\":\"Link to Social Media\",\"show_store_hours\":\"Business Hours\",\"show_review_on_listing_page\":\"Reviews on Listing Page\",\"include_photos\":\"Include Business Photos\",\"import_photos\":\"Import Business Photos\",\"about_us_information\":\"About Us Information\",\"feature_listing_x_per_day\":\"9\",\"products_to_show\":\"2\"}', '{\"show_business_description\":\"Business Description\",\"show_markers_on_maps\":\"Markes on Maps\",\"premium_map_icons\":\"Premium Bigger Map Icon\",\"link_with_social_media\":\"Link to Social Media\",\"show_store_hours\":\"Business Hours\",\"show_review_on_listing_page\":\"Reviews on Listing Page\",\"include_photos\":\"Include Business Photos\",\"import_photos\":\"Import Business Photos\",\"about_us_information\":\"About Us Information\",\"feature_listing_x_per_day\":\"9\",\"products_to_show\":\"2\"}', '9', '2', 1, 0, NULL, NULL),
(12, 'Gareth Gardner', 272.00, '', 'Quaerat rerum laboru', '{\"show_address\":\"Company Address\",\"show_business_description\":\"Business Address\",\"show_markers_on_maps\":\"Markes on Maps\",\"link_to_website_listing_page\":\"Link to Business Website\",\"show_store_hours\":\"Business Hours\",\"show_phone_number\":\"Business Phone Number\",\"include_photos\":\"Include Business Photos\",\"about_us_information\":\"About Us Information\",\"feature_listing_x_per_day\":\"9\",\"products_to_show\":\"95\"}', '{\"show_address\":\"Company Address\",\"show_business_description\":\"Business Address\",\"show_markers_on_maps\":\"Markes on Maps\",\"link_to_website_listing_page\":\"Link to Business Website\",\"show_store_hours\":\"Business Hours\",\"show_phone_number\":\"Business Phone Number\",\"include_photos\":\"Include Business Photos\",\"about_us_information\":\"About Us Information\",\"feature_listing_x_per_day\":\"9\",\"products_to_show\":\"95\"}', '9', '95', 2, 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `plan_category_details`
--

CREATE TABLE `plan_category_details` (
  `id` int(11) NOT NULL,
  `doctor_detail` longtext NOT NULL,
  `delivery_detail` longtext NOT NULL,
  `dispensary_detail` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `plan_category_details`
--

INSERT INTO `plan_category_details` (`id`, `doctor_detail`, `delivery_detail`, `dispensary_detail`) VALUES
(1, 'Doctor Plan DescriptionDoctor Plan DescriptionDoctor Plan DescriptionDoctor Plan DescriptionDoctor Plan DescriptionDoctor Plan DescriptionDoctor Plan DescriptionDoctor Plan DescriptionDoctor Plan DescriptionDoctor Plan DescriptionDoctor Plan DescriptionDoctor Plan DescriptionDoctor Plan Description', 'Delivery Plan DescriptionDelivery Plan DescriptionDelivery Plan DescriptionDelivery Plan DescriptionDelivery Plan DescriptionDelivery Plan DescriptionDelivery Plan DescriptionDelivery Plan DescriptionDelivery Plan DescriptionDelivery Plan DescriptionDelivery Plan DescriptionDelivery Plan DescriptionDelivery Plan DescriptionDelivery Plan DescriptionDelivery Plan DescriptionDelivery Plan DescriptionDelivery Plan DescriptionDelivery Plan DescriptionDelivery Plan DescriptionDelivery Plan DescriptionDelivery Plan DescriptionDelivery Plan DescriptionDelivery Plan DescriptionDelivery Plan DescriptionDelivery Plan DescriptionDelivery Plan DescriptionDelivery Plan DescriptionDelivery Plan DescriptionDelivery Plan DescriptionDelivery Plan DescriptionDelivery Plan DescriptionDelivery Plan DescriptionDelivery Plan DescriptionDelivery Plan DescriptionDelivery Plan DescriptionDelivery Plan DescriptionDelivery Plan DescriptionDelivery Plan DescriptionDelivery Plan DescriptionDelivery Plan Description', 'Dispensary Plan DescriptionDispensary Plan DescriptionDispensary Plan DescriptionDispensary Plan DescriptionDispensary Plan DescriptionDispensary Plan DescriptionDispensary Plan DescriptionDispensary Plan DescriptionDispensary Plan DescriptionDispensary Plan DescriptionDispensary Plan DescriptionDispensary Plan DescriptionDispensary Plan DescriptionDispensary Plan DescriptionDispensary Plan DescriptionDispensary Plan DescriptionDispensary Plan DescriptionDispensary Plan DescriptionDispensary Plan DescriptionDispensary Plan DescriptionDispensary Plan DescriptionDispensary Plan DescriptionDispensary Plan DescriptionDispensary Plan DescriptionDispensary Plan DescriptionDispensary Plan DescriptionDispensary Plan DescriptionDispensary Plan DescriptionDispensary Plan DescriptionDispensary Plan DescriptionDispensary Plan DescriptionDispensary Plan DescriptionDispensary Plan DescriptionDispensary Plan DescriptionDispensary Plan DescriptionDispensary Plan DescriptionDispensary Plan DescriptionDispensary Plan DescriptionDispensary Plan DescriptionDispensary Plan DescriptionDispensary Plan Description');

-- --------------------------------------------------------

--
-- Table structure for table `portal_settings`
--

CREATE TABLE `portal_settings` (
  `id` int(11) NOT NULL,
  `project_name` varchar(255) DEFAULT NULL,
  `logo` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `location` varchar(255) DEFAULT NULL,
  `reviews_show_hide_status` int(11) DEFAULT NULL,
  `radius` varchar(255) NOT NULL,
  `footer_logo` varchar(255) NOT NULL,
  `favi_logo` varchar(255) NOT NULL,
  `google_api_key` varchar(255) NOT NULL,
  `discord_link` varchar(255) NOT NULL,
  `reddit_link` varchar(255) NOT NULL,
  `under_footer_logo_text` longtext NOT NULL,
  `copyright_text` longtext NOT NULL,
  `updated_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `portal_settings`
--

INSERT INTO `portal_settings` (`id`, `project_name`, `logo`, `phone`, `email`, `location`, `reviews_show_hide_status`, `radius`, `footer_logo`, `favi_logo`, `google_api_key`, `discord_link`, `reddit_link`, `under_footer_logo_text`, `copyright_text`, `updated_at`) VALUES
(1, 'Bud & Carriage', '1726924468805379.jpg', '03030303030303', 'mindinstructions@gmail.com', 'House # 8, street # 16, ramghar bazar mu', 1, '500', '1727559894331595.jfif', '1727559903263305.png', 'AIzaSyCAD0fqVjhRXQVUp5H_gqbjO2L8lxNSxdk', 'https://discord.gg/SK2STTpwWC', 'https://www.reddit.com/r/BudandCarriage/', 'A community connecting cannabis consumers, patients, retailers, doctors, and brands since 2008.1', 'Copyright © 2021 Bud & Carriage. Bud & Carriage are registered trademarks of Ghost Management Group, LLC. All Rights Reserved.1', '2022-04-07 12:23:34');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `category_id` int(11) NOT NULL,
  `product_category_id` int(11) DEFAULT NULL,
  `store_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `seo_image_name` varchar(255) NOT NULL,
  `seo_title` varchar(255) NOT NULL,
  `seo_keyword` varchar(255) NOT NULL,
  `seo_description` varchar(255) NOT NULL,
  `deal_simple_product_status` int(11) NOT NULL COMMENT '0=simple_product, 1=Deal',
  `featured` int(11) NOT NULL,
  `heading` varchar(255) DEFAULT NULL,
  `description` longtext NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `status` int(11) NOT NULL,
  `regular_price` int(11) DEFAULT NULL,
  `discount_price` int(11) DEFAULT NULL,
  `discount_status` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT current_timestamp(),
  `weight` varchar(255) NOT NULL,
  `size` varchar(255) NOT NULL,
  `quantity` varchar(255) NOT NULL,
  `start_date_time` datetime DEFAULT NULL,
  `end_date_time` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `category_id`, `product_category_id`, `store_id`, `user_id`, `seo_image_name`, `seo_title`, `seo_keyword`, `seo_description`, `deal_simple_product_status`, `featured`, `heading`, `description`, `image`, `status`, `regular_price`, `discount_price`, `discount_status`, `created_at`, `updated_at`, `weight`, `size`, `quantity`, `start_date_time`, `end_date_time`) VALUES
(10, 'dfg dfg', 3, 7, 35, 5630, '', '', '', '', 0, 1, NULL, 'fdg fsdg', NULL, 0, 100, 100, '0', '2022-02-25 15:41:40', '2022-02-25 20:41:40', '', '', '', NULL, NULL),
(11, 'Colby Eaton', 2, 2, 35, 5630, '', '', '', '', 0, 0, NULL, 'Eum maxime voluptate', '1725852617419007.jpg', 0, 682, 682, '0', '2022-02-26 18:48:35', '2022-02-26 23:48:35', '', '', '', NULL, NULL),
(12, 'Jack Watts', 2, 6, 43, 5630, '', '', '', '', 1, 1, NULL, 'Quis quia similique', '1725852632458083.png', 1, 300, 300, '0', '2022-02-26 18:48:49', '2022-02-26 23:48:49', '', '', '', NULL, NULL),
(13, '2', 1, 3, 42, 5630, '', '', '', '', 0, 0, NULL, '2', '1727930530717744.jpg', 1, 2, 2, '0', '2022-03-21 17:16:07', '2022-02-27 23:41:45', '2', '2', '2', NULL, NULL),
(14, 'f sdfsdf', 1, 2, 42, 5630, '1728921132956052.jpg', '', '', '', 1, 0, NULL, 'd xdgdfg', '1725942823242269.jpg', 1, 444, 444, '0', '2022-04-01 15:42:13', '2022-02-27 23:42:22', '', '', '', NULL, NULL),
(15, 'Medge Watkins', 2, 7, 42, 5630, '', '', '', '', 0, 0, NULL, 'Nihil enim eaque vit', '1726102760725621.png', 1, 729, 729, '0', '2022-03-01 13:04:30', '2022-03-01 18:04:30', '', '', '', NULL, NULL),
(16, 'Stephanie Paul', 2, 2, 42, 5630, '', '', '', '', 0, 0, NULL, 'Aliquam id laborum', '1726102798656295.png', 1, 544, 544, '0', '2022-03-01 13:05:06', '2022-03-01 18:05:06', '', '', '', NULL, NULL),
(17, 'Emerson Tillman', 2, 5, 43, 5638, '', '', '', '', 0, 1, NULL, 'Debitis quas ea veli', '1726109468944187.jfif', 1, 838, 838, '0', '2022-03-01 14:51:07', '2022-03-01 19:51:07', '', '', '', NULL, NULL),
(19, 'Destiny Duncan', 1, 6, 42, 5630, '', '', '', '', 0, 0, NULL, 'Vel cum ab qui perfe', NULL, 1, 492, 492, '0', '2022-03-18 15:19:34', '2022-03-18 20:19:34', 'At iste odio atque h', 'Deleniti ullam expli', '540', NULL, NULL),
(20, 'Mark Trevino', 1, 9, 42, 5630, '', '', '', '', 0, 0, NULL, 'Consectetur a nisi a', NULL, 1, 906, 906, '0', '2022-03-18 15:20:03', '2022-03-18 20:20:03', '46', '29', '371', NULL, NULL),
(25, 'Felicia Walter', 2, 1, 42, 5630, '', '', '', '', 1, 1, NULL, 'Consequat Consectet', '1728463757519922.jpg', 1, 769, 769, '0', '2022-03-27 14:31:32', '2022-03-27 19:31:32', '53', '32', '256', '2022-03-27 00:00:00', '2022-04-09 00:00:00'),
(26, 'Orla Bullock', 2, 2, 42, 5630, '', '', '', '', 0, 0, NULL, 'Optio sint aut nobi', '1728469318334703.jpg', 1, 100, 100, '0', '2022-03-27 15:59:55', '2022-03-27 20:59:55', '1', '2', '3', NULL, NULL),
(27, 'Amanda Baker', 2, 2, 42, 5630, '', '', '', '', 0, 0, NULL, 'Facere autem impedit', NULL, 1, 129, 129, '0', '2022-03-31 15:44:42', '2022-03-31 20:44:42', '73', '81', '576', NULL, NULL),
(28, 'Phyllis Schwartz', 2, 5, 42, 5630, '', '', '', '', 0, 0, NULL, 'Fugiat tempora ullam', NULL, 1, 815, 815, '0', '2022-03-31 15:44:55', '2022-03-31 20:44:55', '15', '16', '695', NULL, NULL),
(29, 'Emily Melendez', 3, 6, 46, 5641, '1728833133358595.jpg', '1', '2', '3333', 0, 0, NULL, 'Corporis vero volupt', NULL, 0, 111, 111, '0', '2022-03-31 16:22:36', '2022-03-31 21:22:36', '73', '61', '587', NULL, NULL),
(30, 'Emily Melendez', 3, 6, 46, 5641, '1728833143447665.jpg', '1', '2', '3333', 0, 0, NULL, 'Corporis vero volupt', NULL, 0, 111, 111, '0', '2022-03-31 16:22:46', '2022-03-31 21:22:46', '73', '61', '587', NULL, NULL),
(31, 'Mariko Conrad', 3, 1, 46, 5641, '', 'Consectetur sit quas', 'Quam ex atque invent', 'Quo expedita do reru', 0, 0, NULL, 'Sequi eveniet sed b', NULL, 0, 841, 841, '0', '2022-03-31 16:22:59', '2022-03-31 21:22:59', '12', '28', '474', NULL, NULL),
(32, 'Nita Lara', 1, 4, 46, 5641, '1728834207722344.png', '11', '22', '33', 0, 0, NULL, 'Suscipit alias amet', NULL, 0, 995, 995, '0', '2022-03-31 16:39:41', '2022-03-31 21:23:49', '17', '53', '357', NULL, NULL),
(33, 'Farrah Burke', 2, 3, 46, 5641, '1728833520264758.jfif', 'Veritatis quos dolor', 'Non consectetur hic', 'Deserunt numquam fac', 0, 1, NULL, 'Non in in assumenda', NULL, 0, 531, 531, '0', '2022-03-31 16:28:45', '2022-03-31 21:28:45', '74', '56', '43', NULL, NULL),
(34, 'Cairo Holcomb', 2, 7, 47, 5642, '1728834866924805.png', 'q', 'w', 'rrrrr1', 1, 0, NULL, 'Iusto consequatur q', '1728839641876411.jpg', 1, 801, 801, '0', '2022-03-31 18:06:03', '2022-03-31 21:45:30', '10', '52', '517', '2007-07-13 00:00:00', '1998-08-11 00:00:00'),
(35, 'Hadassah Solis', 1, 3, 47, 5642, '1728835211792359.png', 'Est rerum ullam sit', 'Earum quisquam provi', 'Ut unde veniam ulla', 0, 1, NULL, 'Placeat quasi commo', NULL, 1, 361, 361, '0', '2022-03-31 16:55:38', '2022-03-31 21:52:51', '92', '79', '109', NULL, NULL),
(36, 'Kennedy Phillips', 2, 1, 42, 5630, '', '', '', '', 0, 0, NULL, 'Eum pariatur Ad lab', NULL, 1, 682, 682, '0', '2022-04-08 17:13:53', '2022-04-08 22:13:53', '37', '72', '272', NULL, NULL),
(37, 'Aspen Stephenson', 3, 8, 42, 5630, '', '', '', '', 1, 0, NULL, 'Et dolores cupiditat', NULL, 1, 993, 993, '0', '2022-04-08 17:14:08', '2022-04-08 22:14:08', '12', '58', '789', '1983-01-01 00:00:00', '1999-08-20 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `products_categories`
--

CREATE TABLE `products_categories` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `cat_image` varchar(255) DEFAULT NULL,
  `updated_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `products_categories`
--

INSERT INTO `products_categories` (`id`, `name`, `cat_image`, `updated_at`) VALUES
(1, 'Vape Pens', '1.jpg', '2021-10-03 14:00:47'),
(2, 'Flowers', '2.jpg', '2021-10-03 09:12:11'),
(3, 'Concentrates', '3.jpg', '2021-10-03 14:13:07'),
(4, 'Edibles', '4.jpg', '2021-10-03 14:13:18'),
(5, 'CBD', '5.jpg', '2021-10-03 14:13:43'),
(6, 'Gear', '6.jpg', '2021-10-03 14:13:52'),
(7, 'Cultivation', '7.jpg', '2021-10-03 14:14:17'),
(8, 'Topicals', '8.jpg', '2021-10-03 14:14:17'),
(9, 'Per Roll', '9.jpg', '2021-10-03 14:14:17'),
(11, 'sdasd', NULL, '2022-02-03 23:13:48');

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

CREATE TABLE `reviews` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `store_id` int(11) NOT NULL,
  `heading` varchar(255) DEFAULT NULL,
  `description` longtext DEFAULT NULL,
  `rating` int(11) DEFAULT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `reviews`
--

INSERT INTO `reviews` (`id`, `user_id`, `store_id`, `heading`, `description`, `rating`, `created_at`) VALUES
(29, 5631, 43, 'Amazing Weed Store', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', 4, '2022-02-26 15:08:35'),
(30, 5631, 42, 'I am Heading', 'I am Heading I am Heading I am Heading I am Heading I am Heading I am Heading I am Heading I am Heading I am Heading I am Heading', 4, '2022-03-01 18:11:44');

-- --------------------------------------------------------

--
-- Table structure for table `stores`
--

CREATE TABLE `stores` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `bussiness_user_id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `store_location` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `store_amenity` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `category` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `seo_title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `seo_description` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `seo_keyword` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `seo_image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `logo` varchar(2048) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `link_to_website_listing_page` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `link_with_social_media` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `store_hours` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `store_location_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `radius` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` int(11) NOT NULL COMMENT '1=active, 0=Deactive',
  `lat` varchar(2048) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `long` varchar(2048) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `delivery_service_info` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `about_us_info` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `company_name_status` int(11) NOT NULL DEFAULT 0,
  `show_address_status` int(11) NOT NULL DEFAULT 0,
  `company_logo_status` int(11) NOT NULL DEFAULT 0,
  `business_descripotion_status` int(11) NOT NULL DEFAULT 0,
  `marker_status` int(11) NOT NULL DEFAULT 0,
  `premium_marker_status` int(11) NOT NULL DEFAULT 0,
  `link_to_website_status` int(11) NOT NULL DEFAULT 0,
  `link_to_social_media_status` int(11) NOT NULL DEFAULT 0,
  `store_hours_status` int(11) NOT NULL DEFAULT 0,
  `reviews_on_listing_status` int(11) NOT NULL DEFAULT 0,
  `create_view_deals_status` int(11) NOT NULL DEFAULT 0,
  `phone_number_status` int(11) NOT NULL DEFAULT 0,
  `import_photos_status` int(11) NOT NULL DEFAULT 0,
  `import_videos_status` int(11) NOT NULL DEFAULT 0,
  `delivery_Service_description_status` int(11) NOT NULL DEFAULT 0,
  `about_us_information_status` int(11) NOT NULL DEFAULT 0,
  `subscription_active` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `stores`
--

INSERT INTO `stores` (`id`, `bussiness_user_id`, `name`, `address`, `store_location`, `store_amenity`, `category`, `seo_title`, `seo_description`, `seo_keyword`, `seo_image`, `email`, `logo`, `description`, `link_to_website_listing_page`, `phone`, `link_with_social_media`, `store_hours`, `store_location_name`, `radius`, `status`, `lat`, `long`, `delivery_service_info`, `about_us_info`, `company_name_status`, `show_address_status`, `company_logo_status`, `business_descripotion_status`, `marker_status`, `premium_marker_status`, `link_to_website_status`, `link_to_social_media_status`, `store_hours_status`, `reviews_on_listing_status`, `create_view_deals_status`, `phone_number_status`, `import_photos_status`, `import_videos_status`, `delivery_Service_description_status`, `about_us_information_status`, `subscription_active`, `created_at`, `updated_at`) VALUES
(42, 5630, 'Ball and Doyle Trading', 'Lahore', 'Lahore', '1', '3', '', '', '', '', 'mindinstructions@gmail.com', '1728284503753093.png', NULL, 'https://www.mewugugohewemi.cm', '+254469671157', 'https://twitter.com/waseemjewellers', '{\"monday_time\":\"09:00AM - 10:00PM\",\"tuesday_time\":\"09:00AM - 10:00PM\",\"wednesday_time\":\"09:00AM - 10:00PM\",\"thursday_time\":\"09:00AM - 10:00PM\",\"friday_time\":\"09:00AM - 10:00PM\",\"saturday_time\":\"09:00AM - 10:00PM\",\"sunday_time\":\"09:00AM - 10:00PM\"}', 'Lahore', '1000', 1, '31.5203696', '74.35874729999999', 'Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum', 'Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum', 0, 1, 1, 0, 1, 1, 0, 0, 1, 1, 1, 1, 1, 1, 1, 1, 1, NULL, NULL),
(43, 5638, 'Driscoll Woodward', 'Pakistan Chowk, Saddar Karachi, Pakistan', 'Lahore', '1,3,7,5,2,4,6', '2', '', '', '', '', 'cuxofoxa@mailinator.com', '1726109438124095.jfif', NULL, 'https://www.netyzocoqeb.cc', '+1 (549) 209-2033', 'A ea sit nostrud seq', 'Id placeat non quas', '', 'In ea velit nulla si', 1, '', '', 'Culpa quas voluptat', 'Nisi non exercitatio', 0, 1, 1, 0, 1, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1, NULL, NULL),
(44, 5639, NULL, NULL, '', NULL, '2', '', '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, 1, NULL, NULL, NULL, NULL, 0, 1, 0, 1, 0, 0, 0, 0, 1, 0, 0, 1, 0, 0, 1, 0, 1, NULL, NULL),
(45, 5640, NULL, NULL, '', NULL, '1', '', '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, 1, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1, 1, 0, 1, 1, 0, 1, 1, NULL, NULL),
(46, 0, 'Walker Olson', 'Lahore Ring Road, Block A Bankers Town, Lahore, Pakistan', 'Lahore', '1', '2', 'Testing Title', 'Description Goes Here Description Goes Here Description Goes Here Description Goes Here Description Goes Here Description Goes Here Description Goes Here Description Goes Here', 'title,word,test,ko', '', 'lepun@mailinator.com', '1728825554731044.jfif', 'There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don\'t look even slightly believable.', 'https://www.xekenoryda.co.uk', '+1 (542) 876-4077', 'https://twitter.com/home', '{\"monday_time\":\"9\",\"tuesday_time\":\"22\",\"wednesday_time\":\"19\",\"thursday_time\":\"28\",\"friday_time\":\"13\",\"saturday_time\":\"22\",\"sunday_time\":\"1\"}', 'Lahore', '105', 1, '31.4515431', '74.3949027', 'Perferendis Nam in ePerferendis Nam in ePerferendis Nam in ePerferendis Nam in ePerferendis Nam in ePerferendis Nam in ePerferendis Nam in ePerferendis Nam in ePerferendis Nam in e', 'Dolore sunt exercitaDolore sunt exercitaDolore sunt exercitaDolore sunt exercitaDolore sunt exercitaDolore sunt exercitaDolore sunt exercitaDolore sunt exercitaDolore sunt exercitaDolore sunt exercitaDolore sunt exercitaDolore sunt exercitaDolore sunt exercita', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1, NULL, '2022-04-11 09:55:10'),
(47, 5642, NULL, NULL, '', NULL, '3', '', '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, 1, NULL, NULL, NULL, NULL, 0, 1, 1, 0, 1, 1, 0, 0, 1, 1, 1, 1, 1, 1, 1, 1, 1, NULL, NULL),
(48, 5643, NULL, NULL, '', NULL, '0', '', '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, 1, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, NULL, NULL),
(49, 5644, NULL, NULL, '', NULL, '0', '', '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, 1, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, NULL, NULL),
(50, 5645, 'Chastity Gregory', 'Ut laborum Quis rem', 'Sahiwal Club, Sahiwal, Pakistan', '', '3', '', '', '', '', 'mymi@mailinator.com', '1729003324436579.jpg', NULL, 'https://www.vimowokyha.net', '+1 (514) 927-3565', 'Voluptate enim neque', '{\"monday_time\":\"27\",\"tuesday_time\":\"21\",\"wednesday_time\":\"3\",\"thursday_time\":\"10\",\"friday_time\":\"21\",\"saturday_time\":\"8\",\"sunday_time\":\"23\"}', 'Sahiwal - ساہیوال', 'Voluptatem ab quia n', 1, '30.6750636', '73.0969499', 'In voluptatem conseq', 'Doloremque sed sed r', 0, 1, 1, 0, 1, 1, 0, 0, 1, 1, 1, 1, 1, 1, 1, 1, 1, NULL, NULL),
(51, 5646, NULL, NULL, '', NULL, NULL, '', '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, 1, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, NULL, NULL),
(52, 5649, NULL, NULL, '', NULL, NULL, '', '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, 1, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, NULL, NULL),
(53, 5650, NULL, NULL, '', NULL, NULL, '', '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, 1, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, NULL, NULL),
(54, 5651, NULL, NULL, '', NULL, NULL, '', '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, 1, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, NULL, NULL),
(55, 5652, NULL, NULL, '', NULL, NULL, '', '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, 1, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, NULL, NULL),
(56, 5653, NULL, NULL, '', NULL, NULL, '', '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, 1, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, NULL, NULL),
(57, 5654, NULL, NULL, '', NULL, NULL, '', '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, 1, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, NULL, NULL),
(58, 5656, NULL, NULL, '', NULL, NULL, '', '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, 1, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, NULL, NULL),
(59, 5657, NULL, NULL, '', NULL, NULL, '', '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, 1, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, NULL, NULL),
(60, 5658, NULL, NULL, '', NULL, NULL, '', '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, 1, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, NULL, NULL),
(61, 5659, NULL, NULL, '', NULL, NULL, '', '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, 1, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, NULL, NULL),
(62, 5660, NULL, NULL, '', NULL, NULL, '', '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, 1, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, NULL, NULL),
(63, 5661, NULL, NULL, '', NULL, NULL, '', '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, 1, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, NULL, NULL),
(64, 5662, NULL, NULL, '', NULL, NULL, '', '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, 1, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, NULL, NULL),
(65, 5663, NULL, NULL, '', NULL, '3', '', '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, 1, NULL, NULL, NULL, NULL, 0, 1, 1, 0, 1, 1, 0, 0, 1, 1, 1, 1, 1, 1, 1, 1, 1, NULL, NULL),
(66, 5664, NULL, NULL, '', NULL, '2', '', '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, 1, NULL, NULL, NULL, NULL, 0, 1, 1, 1, 0, 0, 1, 1, 1, 1, 0, 1, 1, 0, 1, 0, 1, NULL, NULL),
(67, 5665, NULL, NULL, '', NULL, '2', '', '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, 1, NULL, NULL, NULL, NULL, 0, 1, 1, 1, 0, 0, 1, 1, 1, 1, 0, 1, 1, 0, 1, 0, 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `store_media`
--

CREATE TABLE `store_media` (
  `id` int(11) NOT NULL,
  `store_id` int(11) NOT NULL,
  `media_name` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `store_media`
--

INSERT INTO `store_media` (`id`, `store_id`, `media_name`, `created_at`) VALUES
(32, 42, '1725942544745142.png', '2022-02-27 18:37:56'),
(33, 42, '1725942544761421.png', '2022-02-27 18:37:56'),
(34, 42, '1725942544765555.jpg', '2022-02-27 18:37:56');

-- --------------------------------------------------------

--
-- Table structure for table `subscription_plans`
--

CREATE TABLE `subscription_plans` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `business_store_id` int(11) NOT NULL,
  `payment_method` varchar(255) NOT NULL,
  `processing_fee` double NOT NULL,
  `monthy_annual` varchar(255) NOT NULL,
  `plan_id` int(11) NOT NULL,
  `subscription_date` datetime NOT NULL,
  `subscription_start_date` datetime NOT NULL,
  `subscription_end_date` datetime NOT NULL,
  `status_active_deactive` int(11) NOT NULL,
  `plane_name` varchar(255) NOT NULL,
  `price` double NOT NULL,
  `image` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `plan_options_checkboxes` longtext NOT NULL,
  `category_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `subscription_plans`
--

INSERT INTO `subscription_plans` (`id`, `user_id`, `business_store_id`, `payment_method`, `processing_fee`, `monthy_annual`, `plan_id`, `subscription_date`, `subscription_start_date`, `subscription_end_date`, `status_active_deactive`, `plane_name`, `price`, `image`, `description`, `plan_options_checkboxes`, `category_id`) VALUES
(1, 5630, 42, 'Stripe', 25, 'monthly', 5, '2022-02-27 18:36:02', '2022-02-27 18:36:02', '2022-03-27 18:36:01', 1, 'Tier 2', 200, '1725665231728221.png', 'There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don\'t look even slightly believable.', '{\"show_company_name\":\"Company Name\",\"show_address\":\"Company Address\",\"show_company_logo\":\"Company Logo\",\"show_markers_on_maps\":\"Markes on Maps\",\"premium_map_icons\":\"Premium Bigger Map Icon\",\"show_store_hours\":\"Business Hours\",\"show_review_on_listing_page\":\"Reviews on Listing Page\",\"offer_discounts_deals\":\"Business Deals\",\"show_phone_number\":\"Business Phone NUmber\",\"include_photos\":\"Include Business Photos\",\"import_photos\":\"Import Business Photos\",\"import_videos\":\"Import Business Videos\",\"delivery_service_description\":\"Delivery Service Description\",\"about_us_information\":\"About Us Information\",\"feature_listing_x_per_day\":\"5\",\n\"products_to_show\":\"250\"}', 3),
(2, 5638, 43, 'Stripe', 0, 'monthly', 6, '2022-03-01 14:37:18', '2022-03-01 14:37:18', '2022-04-01 14:37:18', 1, 'BASIC FREE PLAN', 0, '1725665669672229.png', 'There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don\'t look even slightly believable.', '{\"show_company_name\":\"Company Name\",\"show_address\":\"Company Address\",\"show_company_logo\":\"Company Logo\",\"show_markers_on_maps\":\"Markes on Maps\",\"premium_map_icons\":\"Premium Bigger Map Icon\",\"feature_listing_x_per_day\":null,\"products_to_show\":\"3\"}', 2),
(3, 5639, 44, 'Stripe', 25, 'monthly', 7, '2022-03-07 17:23:18', '2022-03-07 17:23:18', '2022-04-07 17:23:16', 1, 'Tier 1', 50, '1725665947425861.png', 'There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don\'t look even slightly believable.', '{\"show_company_name\":\"Company Name\",\"show_address\":\"Company Address\",\"show_business_description\":\"Business Description\",\"show_store_hours\":\"Business Hours\",\"show_phone_number\":\"Business Phone NUmber\",\"delivery_service_description\":\"Delivery Service Description\",\"feature_listing_x_per_day\":null,\"products_to_show\":\"5\"}', 2),
(4, 5640, 45, 'Stripe', 25, 'monthly', 2, '2022-03-08 14:58:35', '2022-03-08 14:58:35', '2022-04-08 14:58:32', 1, 'Tier 1', 20, '1725664710786429.png', 'It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using \'Content here, co', '{\"show_review_on_listing_page\":\"Reviews on Listing Page\",\"offer_discounts_deals\":\"Business Deals\",\"include_photos\":\"Include Business Photos\",\"import_photos\":\"Import Business Photos\",\"import_videos\":\"Import Business Videos\",\"about_us_information\":\"About Us Information\",\"feature_listing_x_per_day\":\"2\",\"products_to_show\":null}', 1),
(5, 5641, 46, 'Stripe', 0, 'monthly', 1, '2022-03-30 16:27:08', '2022-03-30 16:27:08', '2022-04-30 16:27:08', 0, 'BASIC FREE PLAN', 0, '1725664695957841.png', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s,', '{\"show_company_name\":\"Company Name\",\"show_address\":\"Company Address\",\"show_company_logo\":\"Company Logo\",\"show_markers_on_maps\":\"Markes on Maps\",\"premium_map_icons\":\"Premium Bigger Map Icon\",\"show_store_hours\":\"Business Hours\",\"show_phone_number\":\"Business Phone NUmber\",\"feature_listing_x_per_day\":null,\"products_to_show\":null}', 1),
(6, 5642, 47, 'Stripe', 25, 'monthly', 5, '2022-03-31 16:42:39', '2022-03-31 16:42:39', '2022-05-01 16:42:37', 1, 'Tier 2', 200, '1725665231728221.png', 'There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don\'t look even slightly believable.', '{\"show_company_name\":\"Company Name\",\"show_address\":\"Company Address\",\"show_company_logo\":\"Company Logo\",\"show_markers_on_maps\":\"Markes on Maps\",\"premium_map_icons\":\"Premium Bigger Map Icon\",\"show_store_hours\":\"Business Hours\",\"show_review_on_listing_page\":\"Reviews on Listing Page\",\"offer_discounts_deals\":\"Business Deals\",\"show_phone_number\":\"Business Phone NUmber\",\"include_photos\":\"Include Business Photos\",\"import_photos\":\"Import Business Photos\",\"import_videos\":\"Import Business Videos\",\"delivery_service_description\":\"Delivery Service Description\",\"about_us_information\":\"About Us Information\",\"feature_listing_x_per_day\":\"5\",\n\"products_to_show\":\"250\"}', 3),
(7, 5645, 50, 'Stripe', 25, 'monthly', 5, '2022-04-02 13:27:14', '2022-04-02 13:27:14', '2022-05-02 13:27:12', 1, 'Tier 2', 200, '1725665231728221.png', 'There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don\'t look even slightly believable.', '{\"show_company_name\":\"Company Name\",\"show_address\":\"Company Address\",\"show_company_logo\":\"Company Logo\",\"show_markers_on_maps\":\"Markes on Maps\",\"premium_map_icons\":\"Premium Bigger Map Icon\",\"show_store_hours\":\"Business Hours\",\"show_review_on_listing_page\":\"Reviews on Listing Page\",\"offer_discounts_deals\":\"Business Deals\",\"show_phone_number\":\"Business Phone NUmber\",\"include_photos\":\"Include Business Photos\",\"import_photos\":\"Import Business Photos\",\"import_videos\":\"Import Business Videos\",\"delivery_service_description\":\"Delivery Service Description\",\"about_us_information\":\"About Us Information\",\"feature_listing_x_per_day\":\"5\",\n\"products_to_show\":\"250\"}', 3),
(8, 5663, 65, 'Stripe', 25, 'monthly', 5, '2022-04-10 10:06:10', '2022-04-10 10:06:10', '2022-05-10 10:06:08', 1, 'Tier 2', 200, '1725665231728221.png', 'There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don\'t look even slightly believable.', '{\"show_company_name\":\"Company Name\",\"show_address\":\"Company Address\",\"show_company_logo\":\"Company Logo\",\"show_markers_on_maps\":\"Markes on Maps\",\"premium_map_icons\":\"Premium Bigger Map Icon\",\"show_store_hours\":\"Business Hours\",\"show_review_on_listing_page\":\"Reviews on Listing Page\",\"offer_discounts_deals\":\"Business Deals\",\"show_phone_number\":\"Business Phone NUmber\",\"include_photos\":\"Include Business Photos\",\"import_photos\":\"Import Business Photos\",\"import_videos\":\"Import Business Videos\",\"delivery_service_description\":\"Delivery Service Description\",\"about_us_information\":\"About Us Information\",\"feature_listing_x_per_day\":\"5\",\n\"products_to_show\":\"250\"}', 3),
(9, 5664, 66, 'Stripe', 25, 'monthly', 8, '2022-04-10 10:41:20', '2022-04-10 10:41:20', '2022-05-10 10:41:19', 1, 'TIER 2', 150, '1725666056388621.png', 'There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don\'t look even slightly believable.', '{\"show_company_name\":\"Company Name\",\"show_address\":\"Company Address\",\"show_company_logo\":\"Company Logo\",\"show_business_description\":\"Business Address\",\"link_to_website_listing_page\":\"Link to Business Website\",\"link_with_social_media\":\"Link to Social Media\",\"show_store_hours\":\"Business Hours\",\"show_review_on_listing_page\":\"Reviews on Listing Page\",\"show_phone_number\":\"Business Phone NUmber\",\"include_photos\":\"Include Business Photos\",\"import_photos\":\"Import Business Photos\",\"delivery_service_description\":\"Delivery Service Description\",\"feature_listing_x_per_day\":null,\n\"products_to_show\":\"10\"}', 2),
(10, 5665, 67, 'Stripe', 25, 'monthly', 8, '2022-04-10 11:11:27', '2022-04-10 11:11:27', '2022-05-10 11:11:25', 1, 'TIER 2', 150, '1725666056388621.png', 'There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don\'t look even slightly believable.', '{\"show_company_name\":\"Company Name\",\"show_address\":\"Company Address\",\"show_company_logo\":\"Company Logo\",\"show_business_description\":\"Business Address\",\"link_to_website_listing_page\":\"Link to Business Website\",\"link_with_social_media\":\"Link to Social Media\",\"show_store_hours\":\"Business Hours\",\"show_review_on_listing_page\":\"Reviews on Listing Page\",\"show_phone_number\":\"Business Phone NUmber\",\"include_photos\":\"Include Business Photos\",\"import_photos\":\"Import Business Photos\",\"delivery_service_description\":\"Delivery Service Description\",\"feature_listing_x_per_day\":null,\n\"products_to_show\":\"10\"}', 2),
(11, 5641, 46, 'from_admin_panel', 0, 'monthly', 6, '2022-04-11 14:51:16', '2022-04-11 14:51:16', '2022-05-11 14:51:16', 0, 'BASIC FREE PLAN', 0, '1725665669672229.png', 'There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don\'t look even slightly believable.', '{\"show_company_name\":\"Company Name\",\"show_address\":\"Company Address\",\"show_company_logo\":\"Company Logo\",\"show_markers_on_maps\":\"Markes on Maps\",\"premium_map_icons\":\"Premium Bigger Map Icon\",\"feature_listing_x_per_day\":null,\"products_to_show\":\"3\"}', 2),
(12, 5641, 46, 'from_admin_panel', 0, 'monthly', 6, '2022-04-11 14:51:41', '2022-04-11 14:51:41', '2022-05-11 14:51:41', 0, 'BASIC FREE PLAN', 0, '1725665669672229.png', 'There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don\'t look even slightly believable.', '{\"show_company_name\":\"Company Name\",\"show_address\":\"Company Address\",\"show_company_logo\":\"Company Logo\",\"show_markers_on_maps\":\"Markes on Maps\",\"premium_map_icons\":\"Premium Bigger Map Icon\",\"feature_listing_x_per_day\":null,\"products_to_show\":\"3\"}', 2),
(13, 5641, 46, 'from_admin_panel', 0, 'monthly', 6, '2022-04-11 14:52:46', '2022-04-11 14:52:46', '2022-05-11 14:52:46', 0, 'BASIC FREE PLAN', 0, '1725665669672229.png', 'There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don\'t look even slightly believable.', '{\"show_company_name\":\"Company Name\",\"show_address\":\"Company Address\",\"show_company_logo\":\"Company Logo\",\"show_markers_on_maps\":\"Markes on Maps\",\"premium_map_icons\":\"Premium Bigger Map Icon\",\"feature_listing_x_per_day\":null,\"products_to_show\":\"3\"}', 2),
(14, 5641, 46, 'from_admin_panel', 0, 'monthly', 6, '2022-04-11 14:52:56', '2022-04-11 14:52:56', '2022-05-11 14:52:56', 0, 'BASIC FREE PLAN', 0, '1725665669672229.png', 'There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don\'t look even slightly believable.', '{\"show_company_name\":\"Company Name\",\"show_address\":\"Company Address\",\"show_company_logo\":\"Company Logo\",\"show_markers_on_maps\":\"Markes on Maps\",\"premium_map_icons\":\"Premium Bigger Map Icon\",\"feature_listing_x_per_day\":null,\"products_to_show\":\"3\"}', 2),
(15, 5641, 46, 'from_admin_panel', 0, 'monthly', 6, '2022-04-11 14:54:37', '2022-04-11 14:54:37', '2022-05-11 14:54:37', 1, 'BASIC FREE PLAN', 0, '1725665669672229.png', 'There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don\'t look even slightly believable.', '{\"show_company_name\":\"Company Name\",\"show_address\":\"Company Address\",\"show_company_logo\":\"Company Logo\",\"show_markers_on_maps\":\"Markes on Maps\",\"premium_map_icons\":\"Premium Bigger Map Icon\",\"feature_listing_x_per_day\":null,\"products_to_show\":\"3\"}', 2),
(16, 0, 46, 'from_admin_panel', 0, 'monthly', 6, '2022-04-11 14:55:10', '2022-04-11 14:55:10', '2022-05-11 14:55:10', 1, 'BASIC FREE PLAN', 0, '1725665669672229.png', 'There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don\'t look even slightly believable.', '{\"show_company_name\":\"Company Name\",\"show_address\":\"Company Address\",\"show_company_logo\":\"Company Logo\",\"show_markers_on_maps\":\"Markes on Maps\",\"premium_map_icons\":\"Premium Bigger Map Icon\",\"feature_listing_x_per_day\":null,\"products_to_show\":\"3\"}', 2);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `first_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `lat` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `long` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` int(11) NOT NULL COMMENT '1=active, 0=Deactive',
  `category` int(11) DEFAULT NULL,
  `zip_code` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `dob` datetime DEFAULT NULL,
  `redit_link` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `discord_link` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_type` enum('administrator','business','customer') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'customer',
  `social_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `social_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `google_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `email_verification_sent_status` int(11) NOT NULL DEFAULT 0,
  `email_verification_code` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_verify_flag` int(11) NOT NULL DEFAULT 0,
  `profile_photo_path` varchar(2048) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password_tmp` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_type_status` int(11) NOT NULL,
  `category_selected_status` int(11) NOT NULL,
  `selected_plan` int(11) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `first_name`, `last_name`, `email`, `lat`, `long`, `status`, `category`, `zip_code`, `dob`, `redit_link`, `discord_link`, `user_type`, `social_id`, `social_type`, `google_id`, `email_verified_at`, `email_verification_sent_status`, `email_verification_code`, `email_verify_flag`, `profile_photo_path`, `password`, `password_tmp`, `remember_token`, `user_type_status`, `category_selected_status`, `selected_plan`, `created_at`, `updated_at`) VALUES
(1, 'Axcel', 'World', 'axcelworld@gmail.com', NULL, NULL, 0, 0, '11111', NULL, 'https://www.reddit.com/', 'https://discord.com/', 'administrator', '', '', '', NULL, 0, '', 0, '1711982443354346.jpg', '$2y$10$Wz6..jaIdaDIxsrxJudraekkbhmysD21e7iuMzRPWaT8Yu4MX/yDe', '', NULL, 1, 1, 0, '2021-08-24 12:54:13', '2022-02-07 14:18:31'),
(5630, 'Business', 'Customer', 'b_user@gmail.com', NULL, NULL, 1, 0, NULL, '1970-01-01 00:00:00', 'https://www.reddit.com/', 'https://discord.com/', 'business', '', '', '', NULL, 0, '', 0, '1725750683907470.jpg', '$2y$10$tca0IYwuKYP50.JD0gWIReteyuiluSrhpBWhDiGOBeUd.Juhjjyxe', '', NULL, 1, 1, 1, '2022-02-01 13:44:54', '2022-02-25 15:48:23'),
(5631, 'Nafees Khan', 'Lodhi', 's_user@gmail.com', NULL, NULL, 1, 0, NULL, NULL, NULL, NULL, 'customer', '', '', '', NULL, 0, '', 0, NULL, '$2y$10$6ZNK92cmvShy8XtLBQfQh.D.anwb7tbrUQVepUJ75CYyxu2iPNkxW', '', NULL, 1, 1, 1, '2022-02-27 07:20:02', '2022-02-27 07:20:02'),
(5638, 'Business User', 'Test', 'b_user_test@gmail.com', NULL, NULL, 1, 0, '5400', '1970-01-16 00:00:00', NULL, NULL, 'business', '', '', '', NULL, 0, '', 0, '1726108643383308.jpg', '$2y$10$vRL9GTYNMrGBjrvag2lzguxJGthQzQxN/UqSVmVELRnqbbM7dyKwK', '', NULL, 1, 1, 1, '2022-03-01 14:36:44', '2022-03-01 14:38:00'),
(5639, 'test', 'test', 'test@gmail.com', NULL, NULL, 1, 0, NULL, NULL, NULL, NULL, 'business', '', '', '102418448309185626407', NULL, 0, '', 0, NULL, '$2y$10$JMd5av1jOTYg/NthZYzbiefcY3H3IE/Wym30Qh/iKipoOgXXVQd7S', '', NULL, 1, 1, 1, '2022-03-07 17:22:35', '2022-03-07 17:22:35'),
(5640, 'testingb_user', 'testingb_user', 'testingb_user@mail.com', NULL, NULL, 1, 0, '54000', '1969-12-03 00:00:00', NULL, NULL, 'business', '1522333828138739', '', '', NULL, 0, '', 0, '1726744161230975.jfif', '$2y$10$MamlPjFjIGssMxcuQaCY2e5zzb08g2iDwFimzUyZD2E7jpeUialXG', '', NULL, 1, 1, 1, '2022-03-08 14:57:56', '2022-03-08 14:59:17'),
(5641, 'test2@gmail.com', 'test2@gmail.com', 'test2@gmail.com', NULL, NULL, 1, 0, NULL, NULL, NULL, NULL, 'business', '', '', '', NULL, 0, '', 0, NULL, '$2y$10$T.bgWG5d/afslZ8ofserd.X26RJqMR7gdBeJ4iQVtbXTVZAc7KXFi', '', NULL, 1, 1, 1, '2022-03-30 16:26:47', '2022-03-30 16:26:47'),
(5642, 'test4@gmail.com', 'test4@gmail.com', 'test4@gmail.com', NULL, NULL, 1, 0, NULL, NULL, NULL, NULL, 'business', '', '', '', NULL, 0, '', 0, NULL, '$2y$10$j2V3GRejZ4GgNQyUslhqAOBa3JazmNy.n77bY8.qwblwTFXgQ3Q.S', '', NULL, 1, 1, 1, '2022-03-31 16:41:55', '2022-03-31 16:41:55'),
(5643, 'Sylvia', 'Munoz', 'nokecebefi@mailinator.com', NULL, NULL, 1, NULL, '95583', '2020-12-16 00:00:00', 'Nulla aut reprehende', 'Molestias aliquam co', 'business', '', '', '', NULL, 0, '', 0, NULL, '$2y$10$k0tEKVAb37Y0u00lRQCw8OFpPX6pF4gU5PFi56VwusMI1AwOSo/RK', '', NULL, 0, 0, 0, '2022-04-02 13:03:37', NULL),
(5644, 'Macey', 'Raymond', 'hanun@mailinator.com', NULL, NULL, 1, NULL, '78128', '2005-03-23 00:00:00', 'Dolore sint et et ne', 'Amet architecto exe', 'business', '', '', '', NULL, 0, '', 0, NULL, '$2y$10$7gfh.2gzwhCiWomd3WiHwew7ZfXPcPvPXrn0tc4WFlM7eWRAd8QcW', '', NULL, 0, 0, 0, '2022-04-02 13:03:57', '2022-04-02 13:04:02'),
(5645, 'khan@gmail.com', 'khan@gmail.com', 'khan@gmail.com', NULL, NULL, 1, 0, NULL, NULL, NULL, NULL, 'business', '', '', '', NULL, 0, '', 0, NULL, '$2y$10$/.MxsNK5qj9Ze.r1ae5ATeUFQovAAM2uE50eWHxGjChPivSFVU47K', '', NULL, 1, 1, 1, '2022-04-02 13:26:49', '2022-04-02 13:26:49'),
(5649, 'Nafees', 'Khan', 'sede@mailinator.com', NULL, NULL, 1, 0, NULL, NULL, NULL, NULL, 'customer', '', '', '', NULL, 0, '', 1, NULL, '$2y$10$xLHIH5Nx0MzhqJ84D4i15OcoVNEWhwoSSagG55YUMWqwgkv08/wxu', '', NULL, 1, 1, 1, '2022-04-09 06:29:50', '2022-04-09 06:29:50'),
(5650, 'David Fuentes', 'Martin Head', 'xahaluluq@mailinator.com', NULL, NULL, 1, 0, NULL, NULL, NULL, NULL, 'customer', '', '', '', NULL, 1, 'IX4mfkVYxA', 0, NULL, '$2y$10$s8tEQkwEdcjGo9nOxDmqQezCpNQWkAP9xFcV2p5ZrZ/H/hxRXaw9S', '', NULL, 0, 0, 0, '2022-04-09 15:23:48', '2022-04-09 15:23:48'),
(5651, 'Alfonso Camacho', 'Brittany Cline', 'wiqohyv@mailinator.com', NULL, NULL, 1, 0, NULL, NULL, NULL, NULL, 'customer', '', '', '', NULL, 0, '', 1, NULL, '$2y$10$G67.B.ag.t24hTZH4mIs2u/awIFf5cRltXpXF.EpUW0Z2GXBVzRX2', '', NULL, 1, 1, 1, '2022-04-09 15:23:58', '2022-04-09 15:23:58'),
(5652, 'Moana Cole', 'Gareth Mccullough', 'bucysat@mailinator.com', NULL, NULL, 1, 0, NULL, NULL, NULL, NULL, 'customer', '', '', '', NULL, 1, 'at43bIUW8q', 0, NULL, '$2y$10$30emm/lD8yUtfa4WpJ8MfeXzj80HXIBIsuFiLWuO/LD19P86R5BUe', '', NULL, 0, 0, 0, '2022-04-09 15:28:56', '2022-04-09 15:28:56'),
(5653, 'Amela Monroe', 'Medge Mayo', 'dyheg@mailinator.com', NULL, NULL, 1, 0, NULL, NULL, NULL, NULL, 'customer', '', '', '', NULL, 1, '0pqZ4PhRqu', 0, NULL, '$2y$10$w/kgiFhZ7vytxlLsfF8oT.MDkfA.5JKZIKKWDq0Un8MhsOsY9eRJq', '', NULL, 0, 0, 0, '2022-04-09 15:31:48', '2022-04-09 15:31:48'),
(5654, 'Wyatt Shannon', 'Tamara Singleton', 'wajubym@mailinator.com', NULL, NULL, 1, 0, NULL, NULL, NULL, NULL, 'customer', '', '', '', NULL, 0, '1', 1, NULL, '$2y$10$WEdv.BiGsFpN2qTjobxDUuXct6N/Qzg94k/TAVi0aGc1sHP9w1Pg2', '', NULL, 1, 1, 0, '2022-04-10 06:34:59', '2022-04-10 06:34:59'),
(5656, 'April Douglas', 'Kiara Clements', 'jujaxohus@mailinator.com', NULL, NULL, 1, 0, NULL, NULL, NULL, NULL, 'customer', '', '', '', NULL, 1, '5hAE5qtr9B', 0, NULL, '$2y$10$qLD/Q/qOXq8JHLo9SHTtR.T83CZ2Rim.OKN0hZhWB1HkQJmWZj11e', '', NULL, 0, 0, 0, '2022-04-10 06:43:48', '2022-04-10 06:43:48'),
(5657, 'Destiny Vargas', 'Anastasia Fisher', 'xyturi@mailinator.com', NULL, NULL, 1, 0, NULL, NULL, NULL, NULL, 'customer', '', '', '', NULL, 1, 'SgcCHk0Xat', 0, NULL, '$2y$10$Bz0PUVz0u9NzXeCb5ij8Qu6C5t1G3InN9FL5fQM6RGA0vnF7wZyd.', '', NULL, 0, 0, 0, '2022-04-10 06:44:44', '2022-04-10 06:44:44'),
(5658, 'Indira Miranda', 'Xanthus Mcknight', 'teasdsadst@gmail.com', NULL, NULL, 1, 0, NULL, NULL, NULL, NULL, 'customer', '', '', '', NULL, 0, '1', 1, NULL, '$2y$10$MpAoqPapcQPTXMgZngnW1uwXx7EbdKz9n9CYhi71G3BV/RXaWfz8O', '', NULL, 1, 1, 0, '2022-04-10 06:58:57', '2022-04-10 06:58:57'),
(5659, 'Cheyenne Austin', 'Octavia Mccullough', 'qalepice@mailinator.com', NULL, NULL, 1, 0, NULL, NULL, NULL, NULL, 'customer', '', '', '', NULL, 0, '1', 1, NULL, '$2y$10$Wecjjie/SGEfkJeFZuQ.Pe6E5gR5C0x1Owttr8zMIcwQ5lXXTHgyu', '', NULL, 1, 1, 0, '2022-04-10 07:09:13', '2022-04-10 07:09:13'),
(5660, 'Elijah Dillon', 'Eagan Merritt', 'kydoxaron@mailinator.com', NULL, NULL, 1, 0, NULL, NULL, NULL, NULL, 'customer', '', '', '', NULL, 0, NULL, 1, NULL, '$2y$10$hKUicXFk8PsW.gr.191C4eHANK.qEepDLLrahxFSuhgd5EidwqsfG', '', NULL, 1, 1, 1, '2022-04-10 07:12:50', '2022-04-10 07:12:50'),
(5661, 'Owen Chapman', 'Selma Flowers', 'kemuf@mailinator.com', NULL, NULL, 1, 0, NULL, NULL, NULL, NULL, 'customer', '', '', '', NULL, 0, NULL, 1, NULL, '$2y$10$LXG5h4eF4MhDGN4WJmGQBu.K2xzTW/KyE2OrOApml3v2bMlJ9gQTC', '', NULL, 1, 1, 1, '2022-04-10 09:52:27', '2022-04-10 09:52:27'),
(5662, 'Whitney Guzman', 'Adria Adkins', 'vaka@mailinator.com', NULL, NULL, 1, 0, NULL, NULL, NULL, NULL, 'customer', '', '', '', NULL, 1, 'iyu0osZIVU', 0, NULL, '$2y$10$hb7Mnw.cS0jm6ARQsj4jEOUibGaKxn0uuRfyX3KKg1sztiDe7mgxm', 'vaka@mailinator.com', NULL, 0, 0, 0, '2022-04-10 09:58:41', '2022-04-10 09:58:41'),
(5663, 'Levi Brennan', 'Allegra Dunlap', 'sovobapyno@mailinator.com', NULL, NULL, 1, 0, NULL, NULL, NULL, NULL, 'customer', '', '', '', NULL, 0, NULL, 1, NULL, '$2y$10$9ZxeuG40SWHT.3p6g3cjSO2DDwu5XtQG2p/t39g3p1o.UXnHNNA9G', 'sovobapyno', NULL, 1, 1, 1, '2022-04-10 09:58:52', '2022-04-10 09:58:52'),
(5664, 'Jordan Noble', 'Zelda Gamble', 'temax@mailinator.com', NULL, NULL, 1, 0, NULL, NULL, NULL, NULL, 'customer', '', '', '', NULL, 0, NULL, 1, NULL, '$2y$10$nD9elG7pDNEiAwFNZ1tPKubLbti6yrSvidOoyHCj8IQNvNuOjbK5O', 'temax@mailinator.com', NULL, 1, 1, 1, '2022-04-10 10:40:26', '2022-04-10 10:40:26'),
(5665, 'Madonna', 'Estes', 'gevisoge@mailinator.com', NULL, NULL, 1, NULL, '81106', '1985-08-07 00:00:00', 'Ex dolore porro cupi', 'Nisi sint quas volup', 'business', '', '', '', NULL, 0, NULL, 0, NULL, '$2y$10$bs.RNp81spC/dzno0icnZO7Yk6AdM9iscc7aqN642kiSRAVuZv6Vy', '', NULL, 1, 1, 1, '2022-04-10 11:03:31', '2022-04-10 11:03:31');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `advertisement_banners`
--
ALTER TABLE `advertisement_banners`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `amenities`
--
ALTER TABLE `amenities`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cms_landing_pages`
--
ALTER TABLE `cms_landing_pages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cms_product_pages`
--
ALTER TABLE `cms_product_pages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contact_us_queries`
--
ALTER TABLE `contact_us_queries`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `favourites`
--
ALTER TABLE `favourites`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `followers`
--
ALTER TABLE `followers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `footer_cms`
--
ALTER TABLE `footer_cms`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `location_banners`
--
ALTER TABLE `location_banners`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `payment_method_settings`
--
ALTER TABLE `payment_method_settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `plans`
--
ALTER TABLE `plans`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `plan_category_details`
--
ALTER TABLE `plan_category_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `portal_settings`
--
ALTER TABLE `portal_settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products_categories`
--
ALTER TABLE `products_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `stores`
--
ALTER TABLE `stores`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `store_media`
--
ALTER TABLE `store_media`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `subscription_plans`
--
ALTER TABLE `subscription_plans`
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
-- AUTO_INCREMENT for table `advertisement_banners`
--
ALTER TABLE `advertisement_banners`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `amenities`
--
ALTER TABLE `amenities`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `cms_landing_pages`
--
ALTER TABLE `cms_landing_pages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `cms_product_pages`
--
ALTER TABLE `cms_product_pages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `contact_us_queries`
--
ALTER TABLE `contact_us_queries`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `favourites`
--
ALTER TABLE `favourites`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `followers`
--
ALTER TABLE `followers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `footer_cms`
--
ALTER TABLE `footer_cms`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `location_banners`
--
ALTER TABLE `location_banners`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `payment_method_settings`
--
ALTER TABLE `payment_method_settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `plans`
--
ALTER TABLE `plans`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `plan_category_details`
--
ALTER TABLE `plan_category_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `portal_settings`
--
ALTER TABLE `portal_settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `products_categories`
--
ALTER TABLE `products_categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `reviews`
--
ALTER TABLE `reviews`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `stores`
--
ALTER TABLE `stores`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=68;

--
-- AUTO_INCREMENT for table `store_media`
--
ALTER TABLE `store_media`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `subscription_plans`
--
ALTER TABLE `subscription_plans`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5666;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
