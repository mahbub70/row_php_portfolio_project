-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 04, 2022 at 09:13 PM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 8.1.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `probizz`
--

-- --------------------------------------------------------

--
-- Table structure for table `abouts`
--

CREATE TABLE `abouts` (
  `id` int(11) NOT NULL,
  `small_title` varchar(100) NOT NULL,
  `big_title` varchar(100) NOT NULL,
  `about_text` text NOT NULL,
  `image` varchar(255) NOT NULL,
  `status` int(1) NOT NULL,
  `created_at` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `abouts`
--

INSERT INTO `abouts` (`id`, `small_title`, `big_title`, `about_text`, `image`, `status`, `created_at`) VALUES
(6, 'Who We Are Who We', '&gt;About us', 'About Text A Little BriefAbout Text A Little BriefAbout Text A Little BriefAbout Text A Little BriefAbout Text A Little BriefAbout Text A Little BriefAbout Text A Little BriefAbout Text A Little BriefAbout Text A Little BriefAbout Text A Little BriefAbout Text A Little BriefAbout Text A Little BriefAbout Text A Little BriefAbout Text A Little BriefAbout Text A Little BriefAbout Text A Little BriefAbout Text A Little BriefAbout Text A Little BriefAbout Text A Little BriefAbout Text A Little BriefAbout Text A Little BriefAbout Text A Little BriefAbout Text A Little Brief', 'about_image_6.png', 1, '01:20:30 AM,05-01-2022'),
(7, 'Who We Are', 'A Little Brief &gt;About Us', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sed aliquam adipisci rem, natus similique vitae.\r\n\r\nlibero temporibus modi commodi molestias perspiciatis, enim dolorum! Magni tenetur error cum quaerat iste, dolorum explicabo fugiat! Pariatur rerum impedit assumenda at deleniti tempore voluptate, itaque modi et amet magni autem.\r\n\r\nlibero temporibus modi commodi molestias perspiciatis, enim dolorum! Magni tenetur error cum quaerat iste, dolorum explicabo fugiat! Pariatur rerum impedit assumenda at deleniti tempore voluptate, itaque modi et amet magni autem.', 'about_image_7.png', 0, '04:27:43 PM,23-12-2021');

-- --------------------------------------------------------

--
-- Table structure for table `banners`
--

CREATE TABLE `banners` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `image` varchar(100) NOT NULL,
  `status` int(1) NOT NULL,
  `created_at` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `banners`
--

INSERT INTO `banners` (`id`, `title`, `description`, `image`, `status`, `created_at`) VALUES
(6, 'ummy text everen book. It', 'taining Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', 'banner_image_6.jpg', 1, '11:00:42 PM,21-12-2021');

-- --------------------------------------------------------

--
-- Table structure for table `banner_buttons`
--

CREATE TABLE `banner_buttons` (
  `id` int(11) NOT NULL,
  `button_name` varchar(100) NOT NULL,
  `button_link` varchar(255) NOT NULL,
  `status` int(1) NOT NULL,
  `created_at` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `banner_buttons`
--

INSERT INTO `banner_buttons` (`id`, `button_name`, `button_link`, `status`, `created_at`) VALUES
(2, 'Contact US', 'https://www.facebook.com/', 1, '09:37:06 PM,21-12-2021'),
(3, 'Info', 'https://www.facebook.com/', 1, '06:28:12 PM,21-12-2021'),
(4, 'Contact US', 'https://www.facebook.com/', 0, '06:39:33 PM,21-12-2021'),
(5, 'Contact US', 'https://www.facebook.com/', 0, '06:39:44 PM,21-12-2021'),
(6, 'Info', 'https://www.facebook.com/', 0, '06:39:55 PM,21-12-2021'),
(10, 'NEW', '', 1, '02:04:56 AM,05-01-2022');

-- --------------------------------------------------------

--
-- Table structure for table `blogs`
--

CREATE TABLE `blogs` (
  `id` int(11) NOT NULL,
  `created_user_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `image` varchar(100) NOT NULL,
  `creater_role` varchar(100) NOT NULL,
  `total_like` int(11) NOT NULL DEFAULT 0,
  `likers_id` longtext NOT NULL,
  `created_at` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `blogs`
--

INSERT INTO `blogs` (`id`, `created_user_id`, `title`, `description`, `image`, `creater_role`, `total_like`, `likers_id`, `created_at`) VALUES
(5, 1, 'Blog', 'description', '', 'Super Admin', 0, '', 'Dec 31, 2021'),
(8, 1, 'Blog Title', 'Blog Description', 'blog_image_8.jpg', 'Super Admin', 0, '', 'Jan 02, 2022'),
(9, 1, 'Blog 2', 'Blog 2 Description', 'blog_image_9.jpg', 'Super Admin', 0, '', 'Jan 02, 2022'),
(10, 1, 'new blog', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quaerat id ex, facilis provident delectus, tempore.Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quaerat id ex, facilis provident delectus, tempore.Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quaerat id ex, facilis provident delectus, tempore.Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quaerat id ex, facilis provident delectus, tempore.Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quaerat id ex, facilis provident delectus, tempore.Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quaerat id ex, facilis provident delectus, tempore.Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quaerat id ex, facilis provident delectus, tempore.', '', 'Super Admin', 0, '', 'Jan 04, 2022'),
(14, 16, 'User Blog', 'New Blog Description', 'blog_image_14.jpg', '', 1, ',16', 'Jan 04, 2022'),
(17, 17, 'New User Blog', 'Description', 'blog_image_17.jpg', '', 0, '', 'Jan 04, 2022'),
(18, 17, 'New User Post', 'New User Description', 'blog_image_18.jpg', 'User', 0, '', 'Jan 04, 2022');

-- --------------------------------------------------------

--
-- Table structure for table `blog_comments`
--

CREATE TABLE `blog_comments` (
  `id` int(11) NOT NULL,
  `blog_id` int(11) NOT NULL,
  `commenter_id` int(11) NOT NULL,
  `comment` text NOT NULL,
  `created_at` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `blog_comments`
--

INSERT INTO `blog_comments` (`id`, `blog_id`, `commenter_id`, `comment`, `created_at`) VALUES
(4, 6, 5, 'this is first client comment.', 'Dec 31, 2021'),
(5, 6, 5, 'this is second client comment', 'Dec 31, 2021');

-- --------------------------------------------------------

--
-- Table structure for table `blog_header`
--

CREATE TABLE `blog_header` (
  `id` int(11) NOT NULL,
  `small_title` varchar(255) NOT NULL,
  `big_title` varchar(255) NOT NULL,
  `description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `blog_header`
--

INSERT INTO `blog_header` (`id`, `small_title`, `big_title`, `description`) VALUES
(1, 'Up To Date', 'Our Latest &gt; Blog', 'mmLorem ipsum dolor sit amet, consectetur adipisicing elit. Nostrum autem similique obcaecati non magni rerum maxime Officia.');

-- --------------------------------------------------------

--
-- Table structure for table `business`
--

CREATE TABLE `business` (
  `id` int(11) NOT NULL,
  `business_text` text NOT NULL DEFAULT ' We Provide All Kind Of Business Services. Do You Need Any Service ?',
  `btn_text` varchar(50) NOT NULL DEFAULT ' Contact Now',
  `btn_link` varchar(255) NOT NULL,
  `image` varchar(100) NOT NULL,
  `created_at` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `business`
--

INSERT INTO `business` (`id`, `business_text`, `btn_text`, `btn_link`, `image`, `created_at`) VALUES
(1, 'We Provide All Kind &gt; Of Business Services. Do You Need Any Service ?', 'Contact Now now', '', 'business_image_1.png', '09:55:00 PM,04-01-2022');

-- --------------------------------------------------------

--
-- Table structure for table `company_header`
--

CREATE TABLE `company_header` (
  `id` int(11) NOT NULL,
  `small_title` varchar(100) NOT NULL,
  `big_title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `image` varchar(100) NOT NULL,
  `created_at` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `company_header`
--

INSERT INTO `company_header` (`id`, `small_title`, `big_title`, `description`, `image`, `created_at`) VALUES
(1, 'Why Choose Our Company ?', 'We Are Best Service &gt; Provider Company Of The Industry', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ipsum labore minus dolore ab itaque animi sit, quae non quas architecto quaerat fugit in temporibus sequi laboriosam, repellat tempore consequuntur voluptatem.', 'company_image_1.png', '10:26:20 PM,26-12-2021');

-- --------------------------------------------------------

--
-- Table structure for table `consultant_header`
--

CREATE TABLE `consultant_header` (
  `id` int(11) NOT NULL,
  `small_title` varchar(255) NOT NULL,
  `big_title` varchar(255) NOT NULL,
  `description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `consultant_header`
--

INSERT INTO `consultant_header` (`id`, `small_title`, `big_title`, `description`) VALUES
(1, 'We are expert', 'Meet Our &gt; Consultant', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Nostrum autem similique obcaecati non magni rerum maxime Officia.');

-- --------------------------------------------------------

--
-- Table structure for table `contact_header`
--

CREATE TABLE `contact_header` (
  `id` int(11) NOT NULL,
  `small_title` varchar(255) NOT NULL,
  `big_title` varchar(255) NOT NULL,
  `description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `contact_header`
--

INSERT INTO `contact_header` (`id`, `small_title`, `big_title`, `description`) VALUES
(1, 'Need Any Help ?', 'Contact With &gt; Us', 'mmLorem ipsum dolor sit amet, consectetur adipisicing elit. Nostrum autem similique obcaecati non magni rerum maxime Officia.');

-- --------------------------------------------------------

--
-- Table structure for table `contact_us`
--

CREATE TABLE `contact_us` (
  `id` int(11) NOT NULL,
  `address` varchar(255) NOT NULL,
  `telephone` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `contact_us`
--

INSERT INTO `contact_us` (`id`, `address`, `telephone`) VALUES
(1, '', '');

-- --------------------------------------------------------

--
-- Table structure for table `counters`
--

CREATE TABLE `counters` (
  `id` int(11) NOT NULL,
  `client` varchar(255) NOT NULL,
  `rating` varchar(255) NOT NULL,
  `award` varchar(255) NOT NULL,
  `complete_project` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `counters`
--

INSERT INTO `counters` (`id`, `client`, `rating`, `award`, `complete_project`) VALUES
(1, '1050', '555', '55', '105');

-- --------------------------------------------------------

--
-- Table structure for table `counter_section`
--

CREATE TABLE `counter_section` (
  `id` int(11) NOT NULL,
  `image` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `counter_section`
--

INSERT INTO `counter_section` (`id`, `image`) VALUES
(1, 'cunter_image_1.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `facilitys`
--

CREATE TABLE `facilitys` (
  `id` int(11) NOT NULL,
  `facility` varchar(100) NOT NULL,
  `icon` varchar(100) NOT NULL DEFAULT 'fas fa-check'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `facilitys`
--

INSERT INTO `facilitys` (`id`, `facility`, `icon`) VALUES
(4, 'High Quality Service', 'fas fa-check'),
(5, 'No Extra Or Hidden Charge', 'fas fa-check'),
(6, '100% Satisfiction Gurantee', 'fas fa-check'),
(7, 'All Kinds Of Business Support', 'fas fa-check'),
(8, 'Dedicated Customer Support', 'fas fa-check'),
(9, 'Great and Effective Tips', 'fas fa-check'),
(10, 'Special Promotion Technique', 'fas fa-check'),
(11, '24/7 Dedicated Support', 'fas fa-check'),
(12, 'We are expert', 'fas fa-check'),
(13, 'We are expert', 'fas fa-check'),
(14, 'We are expert', 'fas fa-check'),
(15, 'We are expert', 'fas fa-check'),
(16, 'We are expert', 'fas fa-check'),
(17, 'We are expert', 'fas fa-check'),
(18, 'We are expert', 'fas fa-check'),
(19, 'We are expert', 'fas fa-check'),
(20, 'aaddcd aaddcd aaddcd aaddcd', 'fas fa-check');

-- --------------------------------------------------------

--
-- Table structure for table `features`
--

CREATE TABLE `features` (
  `id` int(11) NOT NULL,
  `title` varchar(50) NOT NULL,
  `description` varchar(255) NOT NULL,
  `image` varchar(100) NOT NULL,
  `status` int(1) NOT NULL,
  `created_at` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `features`
--

INSERT INTO `features` (`id`, `title`, `description`, `image`, `status`, `created_at`) VALUES
(5, 'Feature &gt; Title', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quaerat id ex, facilis provident delectus, tempore. provident delectus, tempore.', 'feature_image_5.png', 1, '01:35:18 AM,04-01-2022'),
(6, 'Feature Title', 'Feature Description', 'feature_image_6.jpg', 1, '08:56:42 PM,21-12-2021'),
(7, 'Feature Title', 'Feature Description', 'feature_image_7.jpg', 1, '08:57:27 PM,21-12-2021'),
(8, 'Feature Title', 'Feature Description', 'feature_image_8.jpg', 0, '12:36:14 AM,22-12-2021'),
(9, 'Update Title 3', 'Update Description 3', 'feature_image_9.jpg', 0, '12:31:40 AM,22-12-2021');

-- --------------------------------------------------------

--
-- Table structure for table `important_links`
--

CREATE TABLE `important_links` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `link` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `important_links`
--

INSERT INTO `important_links` (`id`, `title`, `link`) VALUES
(2, 'Terms and Condition', ''),
(3, 'Our Policy', ''),
(4, 'Copyright Notice', ''),
(5, 'Our Best Services', ''),
(6, 'Product Promotion Tips', '');

-- --------------------------------------------------------

--
-- Table structure for table `logos`
--

CREATE TABLE `logos` (
  `id` int(11) NOT NULL,
  `logo` varchar(255) NOT NULL,
  `type` varchar(50) NOT NULL,
  `status` int(1) NOT NULL,
  `created_at` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `logos`
--

INSERT INTO `logos` (`id`, `logo`, `type`, `status`, `created_at`) VALUES
(5, 'logo_image_5.png', 'Image', 1, '02:30:39 PM,21-12-2021');

-- --------------------------------------------------------

--
-- Table structure for table `menu`
--

CREATE TABLE `menu` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `link` varchar(255) NOT NULL,
  `status` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `menu`
--

INSERT INTO `menu` (`id`, `name`, `link`, `status`) VALUES
(2, 'Mahbub', '', 1),
(3, 'HHHHH', '', 1),
(4, 'PORTFOLIO', '', 1),
(5, 'PRICING', '', 1),
(6, 'OUR TEAM', '', 1),
(7, 'CONTACT US', '', 1),
(8, 'TEST', '', 1),
(9, 'TEST', '', 1),
(10, 'test 2', '', 1),
(11, 'NEw', '', 0);

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `subject` varchar(100) NOT NULL,
  `message` text NOT NULL,
  `status` int(1) NOT NULL,
  `created_at` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`id`, `name`, `email`, `subject`, `message`, `status`, `created_at`) VALUES
(7, 'kjfdkjfkb', 'sgkfhkjhk@gmail.com', 'gkjhfxjkgkj', 'gidfhdfghkjh', 1, '08:52:01 PM,01-01-2022'),
(8, 'kjfdkjfkb', 'sgkfhkjhk@gmail.com', 'gkjhfxjkgkj', 'gidfhdfghkjh', 1, '08:52:06 PM,01-01-2022'),
(9, 'kjfdkjfkb', 'sgkfhkjhk@gmail.com', 'gkjhfxjkgkj', 'gidfhdfghkjh', 1, '08:52:11 PM,01-01-2022'),
(10, 'kjfdkjfkb', 'sgkfhkjhk@gmail.com', 'gkjhfxjkgkj', 'gidfhdfghkjh', 1, '08:52:45 PM,01-01-2022'),
(11, 'kjfdkjfkb', 'sgkfhkjhk@gmail.com', 'gkjhfxjkgkj', 'gidfhdfghkjh', 1, '08:52:50 PM,01-01-2022'),
(12, 'jhdghgjk', 'kjfhdjh@gmail.com', 'kfdhkjgkjgk', 'dfkjhfghkjfg', 1, '08:54:34 PM,01-01-2022'),
(13, 'jhjhh', 'khkhhjkh@gmail.vom', '', 'jgjvgh', 1, '12:49:43 PM,02-01-2022'),
(14, 'Mahbub', 'rokon@gmail.com', 'Dilam', 'Hello World!', 1, '04:19:11 PM,02-01-2022');

-- --------------------------------------------------------

--
-- Table structure for table `packages`
--

CREATE TABLE `packages` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `price` varchar(100) NOT NULL,
  `button_text` varchar(255) NOT NULL DEFAULT 'Buy Now',
  `status` int(1) NOT NULL,
  `created_at` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `packages`
--

INSERT INTO `packages` (`id`, `name`, `price`, `button_text`, `status`, `created_at`) VALUES
(2, 'Premium', '$ 20.99', 'Buy Now', 1, '12:05:41 PM,29-12-2021'),
(5, 'Silver', '$ 10.00', 'Buy Now', 1, '02:20:05 PM,29-12-2021');

-- --------------------------------------------------------

--
-- Table structure for table `package_header`
--

CREATE TABLE `package_header` (
  `id` int(11) NOT NULL,
  `small_title` varchar(255) NOT NULL,
  `big_title` varchar(255) NOT NULL,
  `description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `package_header`
--

INSERT INTO `package_header` (`id`, `small_title`, `big_title`, `description`) VALUES
(1, 'Choose Best One', 'Our Pricing &gt; Plan', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Nostrum autem similique obcaecati non magni rerum maxime Officia.');

-- --------------------------------------------------------

--
-- Table structure for table `package_services`
--

CREATE TABLE `package_services` (
  `id` int(11) NOT NULL,
  `package_id` int(11) NOT NULL,
  `service_text` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `package_services`
--

INSERT INTO `package_services` (`id`, `package_id`, `service_text`) VALUES
(9, 2, 'PDF Reports'),
(10, 2, 'Basic Quota'),
(11, 2, 'Five Brand Monitors'),
(12, 2, '24/7 Free Support'),
(13, 2, 'Private Forums'),
(15, 5, 'PDF Reports'),
(16, 5, 'Basic Quota'),
(17, 5, 'Five Brand Monitors'),
(18, 5, '24/7 Free Support'),
(19, 5, 'Private Forums'),
(20, 7, 'bubuibub');

-- --------------------------------------------------------

--
-- Table structure for table `portfolios`
--

CREATE TABLE `portfolios` (
  `id` int(11) NOT NULL,
  `category` varchar(100) NOT NULL,
  `portfolio_image` varchar(100) NOT NULL,
  `status` int(1) NOT NULL,
  `created_at` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `portfolios`
--

INSERT INTO `portfolios` (`id`, `category`, `portfolio_image`, `status`, `created_at`) VALUES
(15, 'graphics-design', 'portfolio_image_15.png', 0, '02:47:35 PM,25-12-2021'),
(16, 'web-designer', 'portfolio_image_16.png', 0, '10:57:21 PM,26-12-2021'),
(17, 'graphics-design', 'portfolio_image_17.png', 0, '10:57:30 PM,26-12-2021'),
(18, 'web-designer', 'portfolio_image_18.png', 0, '10:57:42 PM,26-12-2021');

-- --------------------------------------------------------

--
-- Table structure for table `portfolio_categores`
--

CREATE TABLE `portfolio_categores` (
  `id` int(11) NOT NULL,
  `category_name` varchar(100) NOT NULL,
  `status` int(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `portfolio_categores`
--

INSERT INTO `portfolio_categores` (`id`, `category_name`, `status`) VALUES
(12, 'Web Designer', 1),
(13, 'Graphics Design', 1);

-- --------------------------------------------------------

--
-- Table structure for table `portfolio_header`
--

CREATE TABLE `portfolio_header` (
  `id` int(11) NOT NULL,
  `small_title` varchar(100) NOT NULL DEFAULT 'Work Sample',
  `big_title` varchar(255) NOT NULL DEFAULT 'Our Portfolio',
  `text` text NOT NULL DEFAULT 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Nostrum autem similique obcaecati non magni rerum maxime Officia.',
  `created_at` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `portfolio_header`
--

INSERT INTO `portfolio_header` (`id`, `small_title`, `big_title`, `text`, `created_at`) VALUES
(1, 'Work Sample Edit mm', 'Our &gt; Portfolio', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Nostrum autem similique obcaecati non magni rerum maxime Officia.', '03:29:07 PM,25-12-2021');

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

CREATE TABLE `reviews` (
  `id` int(11) NOT NULL,
  `client_id` int(11) NOT NULL,
  `rating` varchar(10) NOT NULL,
  `review` text NOT NULL,
  `status` int(1) NOT NULL DEFAULT 0,
  `created_at` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `reviews`
--

INSERT INTO `reviews` (`id`, `client_id`, `rating`, `review`, `status`, `created_at`) VALUES
(1, 1, '0', 'Mahbub', 1, '08:11:32 PM,30-12-2021'),
(9, 1, '3', 'Mahbub', 1, '08:33:26 PM,30-12-2021'),
(11, 1, '4', 'lskhrgskhfkh', 1, '12:53:45 AM,31-12-2021'),
(14, 1, '3', 'This is Claint Review.', 1, '03:09:28 AM,31-12-2021'),
(15, 1, '4', 'Test', 1, '03:11:01 AM,31-12-2021');

-- --------------------------------------------------------

--
-- Table structure for table `services`
--

CREATE TABLE `services` (
  `id` int(11) NOT NULL,
  `title` varchar(100) NOT NULL,
  `description` varchar(255) NOT NULL,
  `image` varchar(100) NOT NULL,
  `status` int(1) NOT NULL,
  `created_at` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `services`
--

INSERT INTO `services` (`id`, `title`, `description`, `image`, `status`, `created_at`) VALUES
(2, 'MAHBUB', 'New Description', 'service_image_2.png', 1, '11:53:59 PM,23-12-2021'),
(3, 'FINANCE', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quaerat id ex, facilis provident delectus, tempore.', 'service_image_3.png', 1, '08:08:01 PM,23-12-2021'),
(4, 'ADVERTISING', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quaerat id ex, facilis provident delectus, tempore.', 'service_image_4.png', 0, '08:08:26 PM,23-12-2021'),
(5, 'FINANCE', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quaerat id ex, facilis provident delectus, tempore.', 'service_image_5.png', 0, '08:08:49 PM,23-12-2021'),
(6, 'ADVERTISING', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quaerat id ex, facilis provident delectus, tempore.', 'service_image_6.png', 1, '08:09:22 PM,23-12-2021'),
(7, 'SUPPORT', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quaerat id ex, facilis provident delectus, tempore.', 'service_image_7.png', 1, '08:09:54 PM,23-12-2021');

-- --------------------------------------------------------

--
-- Table structure for table `service_header`
--

CREATE TABLE `service_header` (
  `id` int(11) NOT NULL,
  `small_title` varchar(100) NOT NULL DEFAULT 'What We Do',
  `big_title` varchar(255) NOT NULL DEFAULT 'Our Services',
  `text` text NOT NULL DEFAULT 'We work with you to build comprehensive, thoughtful, and purpose-driven identities and experiences. Let’s talk about job.',
  `created_at` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `service_header`
--

INSERT INTO `service_header` (`id`, `small_title`, `big_title`, `text`, `created_at`) VALUES
(1, 'What We Do Want', 'Our &gt; Services', 'sssWe work with you to build comprehensive, thoughtful, and purpose-driven identities and experiences. Let’s talk about job.gg', '11:55:04 PM,23-12-2021');

-- --------------------------------------------------------

--
-- Table structure for table `social_links`
--

CREATE TABLE `social_links` (
  `id` int(11) NOT NULL,
  `site_name` varchar(50) NOT NULL,
  `site_icon` varchar(100) NOT NULL,
  `site_link` varchar(255) NOT NULL,
  `status` int(1) NOT NULL,
  `created_at` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `social_links`
--

INSERT INTO `social_links` (`id`, `site_name`, `site_icon`, `site_link`, `status`, `created_at`) VALUES
(3, 'facebook', 'fab fa-facebook', 'www.bdsl.com', 1, '01:44:40 AM,05-01-2022'),
(4, 'linkedin', 'fab fa-linkedin', 'https://www.linkedin.com', 1, '10:46:49 AM,21-12-2021'),
(5, 'linkedin', 'fab fa-linkedin', 'https://www.facebook.com/', 1, '01:34:54 AM,05-01-2022'),
(6, 'facebook', 'anticon anticon-bar-chart', 'https://www.facebook.com/', 1, '12:26:46 AM,21-12-2021');

-- --------------------------------------------------------

--
-- Table structure for table `subscribers`
--

CREATE TABLE `subscribers` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `created_at` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `subscribers`
--

INSERT INTO `subscribers` (`id`, `email`, `created_at`) VALUES
(5, 'egrfknk@gmail.com', '01:12:26 PM,28-12-2021'),
(6, 'abc@gmail.com', '01:17:38 PM,28-12-2021'),
(8, 'malml@gmail.com', '01:20:38 PM,28-12-2021'),
(10, 'huhkjkjnkn@gmail.com', '12:48:56 PM,02-01-2022'),
(11, 'abmahbub@gmail.com', '04:16:30 PM,02-01-2022'),
(12, 'test@gmail.com', '04:17:40 PM,02-01-2022'),
(13, 'test2@gmail.com', '04:18:30 PM,02-01-2022');

-- --------------------------------------------------------

--
-- Table structure for table `subscriber_header`
--

CREATE TABLE `subscriber_header` (
  `id` int(11) NOT NULL,
  `small_title` varchar(255) NOT NULL,
  `big_title` varchar(255) NOT NULL,
  `description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `subscriber_header`
--

INSERT INTO `subscriber_header` (`id`, `small_title`, `big_title`, `description`) VALUES
(1, 'Get Touch With Us ME', 'Subscribe &gt; Newsletter', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Nostrum autem similique obcaecati non magni rerum maxime Officia.');

-- --------------------------------------------------------

--
-- Table structure for table `testimonial_header`
--

CREATE TABLE `testimonial_header` (
  `id` int(11) NOT NULL,
  `small_title` varchar(255) NOT NULL,
  `big_title` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `testimonial_header`
--

INSERT INTO `testimonial_header` (`id`, `small_title`, `big_title`) VALUES
(1, 'Our Client Reviews', 'Our &gt; Testimonials mm');

-- --------------------------------------------------------

--
-- Table structure for table `top_header`
--

CREATE TABLE `top_header` (
  `id` int(11) NOT NULL,
  `contact_icon` varchar(50) NOT NULL DEFAULT 'fas fa-mobile-alt',
  `contact_number` varchar(50) NOT NULL,
  `email_icon` varchar(50) NOT NULL DEFAULT 'far fa-envelope',
  `contact_email` varchar(100) NOT NULL,
  `status` varchar(50) NOT NULL DEFAULT '0',
  `created_at` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `top_header`
--

INSERT INTO `top_header` (`id`, `contact_icon`, `contact_number`, `email_icon`, `contact_email`, `status`, `created_at`) VALUES
(2, 'anticon anticon-phone', '01860545395', 'anticon anticon-mail', 'mahbub70@gmail.com', '1', '01:28:13 AM,05-01-2022'),
(3, 'fas fa-mobile-alt', '01860545395', 'far fa-envelope', 'abc@gmail.com', '0', '07:49:11 PM,20-12-2021');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `full_name` varchar(50) NOT NULL,
  `user_name` varchar(30) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `profile_image` varchar(100) NOT NULL DEFAULT 'default.jpg',
  `designation` varchar(100) NOT NULL,
  `phone_number` varchar(20) NOT NULL,
  `location` varchar(255) NOT NULL,
  `bio` text NOT NULL,
  `role` int(2) NOT NULL DEFAULT 7,
  `status` int(1) NOT NULL DEFAULT 1,
  `client_site_status` int(1) NOT NULL,
  `created_at` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `full_name`, `user_name`, `email`, `password`, `profile_image`, `designation`, `phone_number`, `location`, `bio`, `role`, `status`, `client_site_status`, `created_at`) VALUES
(1, 'Rokon', 'mahbub70', 'www.rokon7070@gmail.com', '$2y$10$.WqfXj7BsNVKuxEmmC0TTevZLCoC5EYsP1o9Nk48LHGK6Inh0LqBK', 'rokon_1.png', 'Web Developer', '01730505469', '14/5 Solimullah Road, Mohammadpur, Dhaka - 1207', 'Hi, I\'m Mahbubur Rahman Rokon. I am a Professional Web Development.', 1, 1, 1, '03:06:46,18-12-21'),
(8, 'Mahadi Tahsan', 'tahsan70', 'tahsan@gmail.com', '$2y$10$XllG2YxlaBHnZttqd5boa.O5IPa9HM7001201FpFDwYqP8UpUH7Ou', 'mahadi_tahsan_8.jpg', 'Web Developer', '', '', '', 2, 1, 0, '11:46:43,29-12-21'),
(17, 'New User', 'user', 'user@gmail.com', '$2y$10$IzJNxEUucp9Ca67.Jeg/Auv2fpwHP1pItqEYTOc6fGq6N86D2BeGu', 'default.jpg', '', '', '', '', 6, 1, 0, '08:03:02 PM,04-01-2022');

-- --------------------------------------------------------

--
-- Table structure for table `user_social_links`
--

CREATE TABLE `user_social_links` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `site_name` varchar(100) NOT NULL,
  `icon` varchar(100) NOT NULL,
  `link` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_social_links`
--

INSERT INTO `user_social_links` (`id`, `user_id`, `site_name`, `icon`, `link`) VALUES
(2, 1, 'facebook', 'fab fa-facebook-f', 'https://www.facebook.com/'),
(3, 1, 'twitter', 'fab fa-twitter', 'https://twitter.com/'),
(4, 1, 'pinterest', 'fab fa-pinterest-p', 'https://www.pinterest.com/'),
(5, 1, 'linkedin', 'fab fa-linkedin-in', 'https://www.linkedin.com/'),
(7, 8, 'facebook', 'fab fa-facebook-f', 'https://www.facebook.com/mahadi.tahsan');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `abouts`
--
ALTER TABLE `abouts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `banners`
--
ALTER TABLE `banners`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `banner_buttons`
--
ALTER TABLE `banner_buttons`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `blogs`
--
ALTER TABLE `blogs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `blog_comments`
--
ALTER TABLE `blog_comments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `blog_header`
--
ALTER TABLE `blog_header`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `business`
--
ALTER TABLE `business`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `company_header`
--
ALTER TABLE `company_header`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `consultant_header`
--
ALTER TABLE `consultant_header`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contact_header`
--
ALTER TABLE `contact_header`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contact_us`
--
ALTER TABLE `contact_us`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `facilitys`
--
ALTER TABLE `facilitys`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `features`
--
ALTER TABLE `features`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `important_links`
--
ALTER TABLE `important_links`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `logos`
--
ALTER TABLE `logos`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `menu`
--
ALTER TABLE `menu`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `packages`
--
ALTER TABLE `packages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `package_header`
--
ALTER TABLE `package_header`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `package_services`
--
ALTER TABLE `package_services`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `portfolios`
--
ALTER TABLE `portfolios`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `portfolio_categores`
--
ALTER TABLE `portfolio_categores`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `portfolio_header`
--
ALTER TABLE `portfolio_header`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `services`
--
ALTER TABLE `services`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `service_header`
--
ALTER TABLE `service_header`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `social_links`
--
ALTER TABLE `social_links`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `subscribers`
--
ALTER TABLE `subscribers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `subscriber_header`
--
ALTER TABLE `subscriber_header`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `testimonial_header`
--
ALTER TABLE `testimonial_header`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `top_header`
--
ALTER TABLE `top_header`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_social_links`
--
ALTER TABLE `user_social_links`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `abouts`
--
ALTER TABLE `abouts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `banners`
--
ALTER TABLE `banners`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `banner_buttons`
--
ALTER TABLE `banner_buttons`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `blogs`
--
ALTER TABLE `blogs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `blog_comments`
--
ALTER TABLE `blog_comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `blog_header`
--
ALTER TABLE `blog_header`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `business`
--
ALTER TABLE `business`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `company_header`
--
ALTER TABLE `company_header`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `consultant_header`
--
ALTER TABLE `consultant_header`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `contact_header`
--
ALTER TABLE `contact_header`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `facilitys`
--
ALTER TABLE `facilitys`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `features`
--
ALTER TABLE `features`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `important_links`
--
ALTER TABLE `important_links`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `logos`
--
ALTER TABLE `logos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `menu`
--
ALTER TABLE `menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `packages`
--
ALTER TABLE `packages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `package_header`
--
ALTER TABLE `package_header`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `package_services`
--
ALTER TABLE `package_services`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `portfolios`
--
ALTER TABLE `portfolios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `portfolio_categores`
--
ALTER TABLE `portfolio_categores`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `portfolio_header`
--
ALTER TABLE `portfolio_header`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `reviews`
--
ALTER TABLE `reviews`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `services`
--
ALTER TABLE `services`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `service_header`
--
ALTER TABLE `service_header`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `social_links`
--
ALTER TABLE `social_links`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `subscribers`
--
ALTER TABLE `subscribers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `subscriber_header`
--
ALTER TABLE `subscriber_header`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `top_header`
--
ALTER TABLE `top_header`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `user_social_links`
--
ALTER TABLE `user_social_links`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
