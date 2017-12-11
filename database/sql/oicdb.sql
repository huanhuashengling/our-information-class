-- phpMyAdmin SQL Dump
-- version 4.4.15.5
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: 2017-12-11 01:30:52
-- 服务器版本： 5.7.11
-- PHP Version: 5.4.35

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `oicdb`
--

-- --------------------------------------------------------

--
-- 表的结构 `admins`
--

CREATE TABLE IF NOT EXISTS `admins` (
  `id` int(10) unsigned NOT NULL,
  `username` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `remember_token` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- 转存表中的数据 `admins`
--

INSERT INTO `admins` (`id`, `username`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Garland Jaskolski', '$2y$10$Rgp3q9WmbTL2yLAjELkLNOBRjFV5lxYJsktZKONcJ46gAofhHGEza', 'YapnGV1Nm4', '2017-12-10 06:34:21', '2017-12-10 06:34:21'),
(2, 'Raul Wilderman I', '$2y$10$Rgp3q9WmbTL2yLAjELkLNOBRjFV5lxYJsktZKONcJ46gAofhHGEza', 'mlRQk0wlnY', '2017-12-10 06:34:21', '2017-12-10 06:34:21'),
(3, 'Lorenzo Flatley', '$2y$10$Rgp3q9WmbTL2yLAjELkLNOBRjFV5lxYJsktZKONcJ46gAofhHGEza', 'YOBewxNyBx', '2017-12-10 06:34:21', '2017-12-10 06:34:21');

-- --------------------------------------------------------

--
-- 表的结构 `comments`
--

CREATE TABLE IF NOT EXISTS `comments` (
  `id` int(10) unsigned NOT NULL,
  `posts_id` int(10) unsigned NOT NULL,
  `content` text COLLATE utf8_unicode_ci,
  `teachers_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- 转存表中的数据 `comments`
--

INSERT INTO `comments` (`id`, `posts_id`, `content`, `teachers_id`, `created_at`, `updated_at`) VALUES
(1, 2, '作业做得不错，继续加油！！', 1, '2017-12-10 07:01:55', '2017-12-10 07:01:55');

-- --------------------------------------------------------

--
-- 表的结构 `groups`
--

CREATE TABLE IF NOT EXISTS `groups` (
  `id` int(10) unsigned NOT NULL,
  `name` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `leader_id` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- 转存表中的数据 `groups`
--

INSERT INTO `groups` (`id`, `name`, `description`, `leader_id`, `created_at`, `updated_at`) VALUES
(1, '雄鹰高飞', '雄鹰高飞', '1', NULL, NULL),
(2, '蓝天组', '蓝天组', '1', NULL, NULL);

-- --------------------------------------------------------

--
-- 表的结构 `lessons`
--

CREATE TABLE IF NOT EXISTS `lessons` (
  `id` int(10) unsigned NOT NULL,
  `lesson_code` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `title` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `subtitle` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `allow_post_file_types` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `help_md_doc` text COLLATE utf8_unicode_ci,
  `description` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `teachers_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- 转存表中的数据 `lessons`
--

INSERT INTO `lessons` (`id`, `lesson_code`, `title`, `subtitle`, `allow_post_file_types`, `help_md_doc`, `description`, `teachers_id`, `created_at`, `updated_at`) VALUES
(1, NULL, '画图工具', '曲线画鱼', 'jpg', '##我是帮助文档##', NULL, 2, NULL, NULL),
(2, NULL, '幻灯片', '自旋图形绘制笑脸', 'jpg', '##我是帮助文档##', NULL, 2, NULL, NULL),
(3, NULL, 'Flash', 'flash补间动画', 'jpg', '##我是帮助文档##', NULL, 2, NULL, NULL),
(4, NULL, 'PowerPoint', '自定义动画', 'jpg', '##我是帮助文档##', NULL, 2, NULL, NULL),
(5, NULL, '电子表格', '纪录生活中的电器', 'jpg', '##我是帮助文档##', NULL, 2, NULL, NULL);

-- --------------------------------------------------------

--
-- 表的结构 `lesson_logs`
--

CREATE TABLE IF NOT EXISTS `lesson_logs` (
  `id` int(10) unsigned NOT NULL,
  `lessons_id` int(10) unsigned NOT NULL,
  `status` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ended_at` timestamp NULL DEFAULT NULL,
  `teachers_id` int(10) unsigned NOT NULL,
  `sclasses_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- 转存表中的数据 `lesson_logs`
--

INSERT INTO `lesson_logs` (`id`, `lessons_id`, `status`, `ended_at`, `teachers_id`, `sclasses_id`, `created_at`, `updated_at`) VALUES
(1, 1, 'close', NULL, 1, 1, '2017-12-10 06:47:38', '2017-12-10 07:50:01');

-- --------------------------------------------------------

--
-- 表的结构 `marks`
--

CREATE TABLE IF NOT EXISTS `marks` (
  `id` int(10) unsigned NOT NULL,
  `posts_id` int(10) unsigned NOT NULL,
  `students_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- 表的结构 `migrations`
--

CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int(10) unsigned NOT NULL,
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=195 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- 转存表中的数据 `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(183, '2017_11_01_133856_create_admins_table', 1),
(184, '2017_11_02_142635_create_schools_table', 1),
(185, '2017_11_02_142666_create_sclasses_table', 1),
(186, '2017_11_02_143014_create_teachers_table', 1),
(187, '2017_11_02_143253_create_groups_table', 1),
(188, '2017_11_02_144122_create_students_table', 1),
(189, '2017_11_02_144529_create_lessons_table', 1),
(190, '2017_11_02_144917_create_lesson_logs_table', 1),
(191, '2017_11_02_150204_create_posts_table', 1),
(192, '2017_11_02_150644_create_comments_table', 1),
(193, '2017_11_19_094501_create_post_rates_table', 1),
(194, '2017_12_10_134254_create_marks_table', 1);

-- --------------------------------------------------------

--
-- 表的结构 `posts`
--

CREATE TABLE IF NOT EXISTS `posts` (
  `id` int(10) unsigned NOT NULL,
  `lesson_logs_id` int(10) unsigned NOT NULL,
  `students_id` int(10) unsigned NOT NULL,
  `storage_name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `original_name` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `mime_type` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `file_ext` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `post_code` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `content` text COLLATE utf8_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- 转存表中的数据 `posts`
--

INSERT INTO `posts` (`id`, `lesson_logs_id`, `students_id`, `storage_name`, `original_name`, `mime_type`, `file_ext`, `post_code`, `content`, `created_at`, `updated_at`) VALUES
(1, 1, 3, '20171210-5a2d499d135b7.png', 'Screen Shot 2015-03-31 at 8.51.28 PM.png', 'image/png', 'png', '5a2d499d135b7', '', '2017-12-10 06:50:05', '2017-12-10 06:50:05'),
(2, 1, 4, 'Screen Shot 2015-03-31 at 8.54.02 PM.png-5a2d4a8ba8101.png', 'Screen Shot 2015-03-31 at 8.54.02 PM.png', 'image/png', 'png', '5a2d4a8ba8101', '', '2017-12-10 06:54:03', '2017-12-10 06:54:03'),
(3, 1, 5, '尤文杰个人简历.xls-5a2d4bc13dbdf.xls', '尤文杰个人简历.xls', 'application/vnd.ms-excel', 'xls', '5a2d4bc13dbdf', '', '2017-12-10 06:59:13', '2017-12-10 06:59:13');

-- --------------------------------------------------------

--
-- 表的结构 `post_rates`
--

CREATE TABLE IF NOT EXISTS `post_rates` (
  `id` int(10) unsigned NOT NULL,
  `posts_id` int(10) unsigned NOT NULL,
  `rate` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `teachers_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- 转存表中的数据 `post_rates`
--

INSERT INTO `post_rates` (`id`, `posts_id`, `rate`, `teachers_id`, `created_at`, `updated_at`) VALUES
(1, 2, 'outstanding', 1, '2017-12-10 07:01:38', '2017-12-10 07:01:38');

-- --------------------------------------------------------

--
-- 表的结构 `schools`
--

CREATE TABLE IF NOT EXISTS `schools` (
  `id` int(10) unsigned NOT NULL,
  `title` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `district` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `description` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- 表的结构 `sclasses`
--

CREATE TABLE IF NOT EXISTS `sclasses` (
  `id` int(10) unsigned NOT NULL,
  `schools_id` int(10) unsigned NOT NULL,
  `enter_school_year` int(11) NOT NULL,
  `class_title` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `class_num` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- 转存表中的数据 `sclasses`
--

INSERT INTO `sclasses` (`id`, `schools_id`, `enter_school_year`, `class_title`, `class_num`, `created_at`, `updated_at`) VALUES
(1, 1, 2013, '丙', 3, '2017-12-10 06:34:21', '2017-12-10 06:34:21'),
(2, 1, 2014, '丙', 3, '2017-12-10 06:34:21', '2017-12-10 06:34:21'),
(3, 1, 2012, '丙', 3, '2017-12-10 06:34:21', '2017-12-10 06:34:21');

-- --------------------------------------------------------

--
-- 表的结构 `students`
--

CREATE TABLE IF NOT EXISTS `students` (
  `id` int(10) unsigned NOT NULL,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `gender` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `level` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `score` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `remember_token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `groups_id` int(10) unsigned DEFAULT NULL,
  `sclasses_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=61 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- 转存表中的数据 `students`
--

INSERT INTO `students` (`id`, `username`, `email`, `gender`, `level`, `score`, `password`, `remember_token`, `groups_id`, `sclasses_id`, `created_at`, `updated_at`) VALUES
(1, 'Dr. Laury Maggio MD', 'grant63@shanahan.org', '1', '0', '0', '$2y$10$emmaAEbRAoabRvrsMyNNtuaG.8X5qc4mlBcMNpjxhWUJw1Y9a5X6C', 'q4O66x5kANpxRmNs9fJDWOTyItiNDzYtjqGIRXfq3AmRpUGeipIKUfSDvkrz', 2, 2, '2017-12-10 06:34:21', '2017-12-10 06:48:23'),
(2, 'Terrence Balistreri', 'chyna.connelly@hotmail.com', '0', '0', '0', '$2y$10$emmaAEbRAoabRvrsMyNNtuaG.8X5qc4mlBcMNpjxhWUJw1Y9a5X6C', 'gB4LsgYQdV', 1, 2, '2017-12-10 06:34:21', '2017-12-10 06:34:21'),
(3, 'Kailey Mertz PhD', 'kirlin.raphael@yahoo.com', '1', '0', '0', '$2y$10$emmaAEbRAoabRvrsMyNNtuaG.8X5qc4mlBcMNpjxhWUJw1Y9a5X6C', 'MP6JWrS9IAWYfBFxfmw5PjTM0LIVPF0p5bSMNma8Pu9XGHzIkuNa7XNrBvQz', 2, 1, '2017-12-10 06:34:21', '2017-12-10 06:53:42'),
(4, 'Alvina Veum', 'marc91@zemlak.com', '0', '0', '0', '$2y$10$emmaAEbRAoabRvrsMyNNtuaG.8X5qc4mlBcMNpjxhWUJw1Y9a5X6C', 'cOjeMJ4phSaBZY0hfCJe16O89w1G11A1AWMsiBLONdAEGPjXL8AjcIfqw0uQ', 2, 1, '2017-12-10 06:34:21', '2017-12-10 06:55:39'),
(5, 'Elinor Schaefer DVM', 'qbeier@gmail.com', '1', '0', '0', '$2y$10$emmaAEbRAoabRvrsMyNNtuaG.8X5qc4mlBcMNpjxhWUJw1Y9a5X6C', 'gbqH6AHVV0HuEQCg3rG6gedGJJP1aubjJJfY6ClDXTsPhAxZxRCa9eZzkC3x', 1, 1, '2017-12-10 06:34:21', '2017-12-10 07:02:15'),
(6, 'Eliane Kovacek', 'mkoch@cassin.com', '0', '0', '0', '$2y$10$emmaAEbRAoabRvrsMyNNtuaG.8X5qc4mlBcMNpjxhWUJw1Y9a5X6C', '0cMwSCKHc8', 1, 3, '2017-12-10 06:34:21', '2017-12-10 06:34:21'),
(7, 'Miss Camila Bradtke PhD', 'rodolfo43@gmail.com', '0', '0', '0', '$2y$10$emmaAEbRAoabRvrsMyNNtuaG.8X5qc4mlBcMNpjxhWUJw1Y9a5X6C', 'nVpPHmcuFE', 1, 1, '2017-12-10 06:34:21', '2017-12-10 06:34:21'),
(8, 'Jennyfer Murazik MD', 'king.carrie@buckridge.com', '1', '0', '0', '$2y$10$emmaAEbRAoabRvrsMyNNtuaG.8X5qc4mlBcMNpjxhWUJw1Y9a5X6C', 'O2Fp0re43O', 2, 3, '2017-12-10 06:34:21', '2017-12-10 06:34:21'),
(9, 'Jeramie Parisian', 'baron78@hotmail.com', '1', '0', '0', '$2y$10$emmaAEbRAoabRvrsMyNNtuaG.8X5qc4mlBcMNpjxhWUJw1Y9a5X6C', 'Zkjtoau4jO', 1, 3, '2017-12-10 06:34:21', '2017-12-10 06:34:21'),
(10, 'Yasmeen Abbott', 'treutel.eloy@hotmail.com', '0', '0', '0', '$2y$10$emmaAEbRAoabRvrsMyNNtuaG.8X5qc4mlBcMNpjxhWUJw1Y9a5X6C', 'fI0Jv3Gif8', 1, 1, '2017-12-10 06:34:21', '2017-12-10 06:34:21'),
(11, 'Augustus Hauck', 'grimes.arlene@hotmail.com', '1', '0', '0', '$2y$10$emmaAEbRAoabRvrsMyNNtuaG.8X5qc4mlBcMNpjxhWUJw1Y9a5X6C', '8CMI7DlhSQ', 1, 1, '2017-12-10 06:34:21', '2017-12-10 06:34:21'),
(12, 'Itzel Wisozk', 'quinn68@vonrueden.com', '0', '0', '0', '$2y$10$emmaAEbRAoabRvrsMyNNtuaG.8X5qc4mlBcMNpjxhWUJw1Y9a5X6C', 'gJhWZFVQ0Q', 1, 3, '2017-12-10 06:34:21', '2017-12-10 06:34:21'),
(13, 'Mrs. Fannie Reynolds IV', 'dcorwin@yahoo.com', '1', '0', '0', '$2y$10$emmaAEbRAoabRvrsMyNNtuaG.8X5qc4mlBcMNpjxhWUJw1Y9a5X6C', 'SSVuyPDkce', 2, 3, '2017-12-10 06:34:21', '2017-12-10 06:34:21'),
(14, 'Miss Marian McClure', 'gbrekke@yahoo.com', '0', '0', '0', '$2y$10$emmaAEbRAoabRvrsMyNNtuaG.8X5qc4mlBcMNpjxhWUJw1Y9a5X6C', 'CljEXNkbT9', 2, 2, '2017-12-10 06:34:21', '2017-12-10 06:34:21'),
(15, 'Prof. Elroy Armstrong', 'ilabadie@mraz.com', '1', '0', '0', '$2y$10$emmaAEbRAoabRvrsMyNNtuaG.8X5qc4mlBcMNpjxhWUJw1Y9a5X6C', 'arxYj8qVac', 2, 3, '2017-12-10 06:34:21', '2017-12-10 06:34:21'),
(16, 'Davion Cummerata', 'kkiehn@smith.com', '1', '0', '0', '$2y$10$emmaAEbRAoabRvrsMyNNtuaG.8X5qc4mlBcMNpjxhWUJw1Y9a5X6C', 'XkxEOsLwHz', 1, 1, '2017-12-10 06:34:21', '2017-12-10 06:34:21'),
(17, 'Maurine Grimes', 'hailee22@roberts.com', '0', '0', '0', '$2y$10$emmaAEbRAoabRvrsMyNNtuaG.8X5qc4mlBcMNpjxhWUJw1Y9a5X6C', 'NLGVwzbgg0', 2, 2, '2017-12-10 06:34:21', '2017-12-10 06:34:21'),
(18, 'Maynard Herzog', 'nkuhn@russel.info', '0', '0', '0', '$2y$10$emmaAEbRAoabRvrsMyNNtuaG.8X5qc4mlBcMNpjxhWUJw1Y9a5X6C', 'eGcTHwnbRZ', 2, 3, '2017-12-10 06:34:21', '2017-12-10 06:34:21'),
(19, 'Kevin Prosacco', 'bergnaum.demond@hotmail.com', '1', '0', '0', '$2y$10$emmaAEbRAoabRvrsMyNNtuaG.8X5qc4mlBcMNpjxhWUJw1Y9a5X6C', 'xScwBNti0F', 1, 1, '2017-12-10 06:34:21', '2017-12-10 06:34:21'),
(20, 'Miss America Romaguera III', 'edgardo05@gmail.com', '1', '0', '0', '$2y$10$emmaAEbRAoabRvrsMyNNtuaG.8X5qc4mlBcMNpjxhWUJw1Y9a5X6C', 'JbMNL3WKtk', 2, 2, '2017-12-10 06:34:21', '2017-12-10 06:34:21'),
(21, 'Marlen Hermiston', 'scrist@yahoo.com', '1', '0', '0', '$2y$10$emmaAEbRAoabRvrsMyNNtuaG.8X5qc4mlBcMNpjxhWUJw1Y9a5X6C', 'Rnajw76XOi', 1, 1, '2017-12-10 06:34:21', '2017-12-10 06:34:21'),
(22, 'Mrs. Erna Murazik', 'romaguera.watson@graham.net', '1', '0', '0', '$2y$10$emmaAEbRAoabRvrsMyNNtuaG.8X5qc4mlBcMNpjxhWUJw1Y9a5X6C', 'Wy5GHiSkzJ', 1, 3, '2017-12-10 06:34:21', '2017-12-10 06:34:21'),
(23, 'Vella Heaney', 'sid.rempel@terry.com', '1', '0', '0', '$2y$10$emmaAEbRAoabRvrsMyNNtuaG.8X5qc4mlBcMNpjxhWUJw1Y9a5X6C', 'PduGKm7aZE', 1, 1, '2017-12-10 06:34:21', '2017-12-10 06:34:21'),
(24, 'Lyric Koepp', 'talia25@stark.com', '1', '0', '0', '$2y$10$emmaAEbRAoabRvrsMyNNtuaG.8X5qc4mlBcMNpjxhWUJw1Y9a5X6C', 'fmvWyQl5VW', 1, 3, '2017-12-10 06:34:21', '2017-12-10 06:34:21'),
(25, 'Miss Rose Brown I', 'major32@ritchie.org', '0', '0', '0', '$2y$10$emmaAEbRAoabRvrsMyNNtuaG.8X5qc4mlBcMNpjxhWUJw1Y9a5X6C', 'xEJ4weIKDE', 2, 2, '2017-12-10 06:34:21', '2017-12-10 06:34:21'),
(26, 'Abbigail Roberts', 'maximillia09@marks.info', '1', '0', '0', '$2y$10$emmaAEbRAoabRvrsMyNNtuaG.8X5qc4mlBcMNpjxhWUJw1Y9a5X6C', 'Fq2alfjmcs', 1, 2, '2017-12-10 06:34:21', '2017-12-10 06:34:21'),
(27, 'Maurine Mraz', 'margaret57@harvey.com', '0', '0', '0', '$2y$10$emmaAEbRAoabRvrsMyNNtuaG.8X5qc4mlBcMNpjxhWUJw1Y9a5X6C', 'e9NZzR3bYG', 2, 1, '2017-12-10 06:34:21', '2017-12-10 06:34:21'),
(28, 'Grover Langworth', 'paige37@friesen.biz', '0', '0', '0', '$2y$10$emmaAEbRAoabRvrsMyNNtuaG.8X5qc4mlBcMNpjxhWUJw1Y9a5X6C', '6OokcHrGxf', 1, 2, '2017-12-10 06:34:21', '2017-12-10 06:34:21'),
(29, 'Sherwood Gorczany', 'eichmann.antonetta@okon.com', '1', '0', '0', '$2y$10$emmaAEbRAoabRvrsMyNNtuaG.8X5qc4mlBcMNpjxhWUJw1Y9a5X6C', 'IeEXE1Px7T', 1, 3, '2017-12-10 06:34:21', '2017-12-10 06:34:21'),
(30, 'Bethany Mitchell', 'hfeil@harvey.com', '1', '0', '0', '$2y$10$emmaAEbRAoabRvrsMyNNtuaG.8X5qc4mlBcMNpjxhWUJw1Y9a5X6C', 'BE0J4M3FuO', 2, 1, '2017-12-10 06:34:21', '2017-12-10 06:34:21'),
(31, 'Roel Marks', 'adelia19@yahoo.com', '1', '0', '0', '$2y$10$emmaAEbRAoabRvrsMyNNtuaG.8X5qc4mlBcMNpjxhWUJw1Y9a5X6C', 'HRyeXBpyBs', 2, 1, '2017-12-10 06:34:21', '2017-12-10 06:34:21'),
(32, 'Mr. Gregg Sawayn', 'pstroman@rogahn.biz', '0', '0', '0', '$2y$10$emmaAEbRAoabRvrsMyNNtuaG.8X5qc4mlBcMNpjxhWUJw1Y9a5X6C', 'XKGDMP7LHu', 2, 1, '2017-12-10 06:34:21', '2017-12-10 06:34:21'),
(33, 'Lucious Ernser', 'bernard.quitzon@flatley.com', '1', '0', '0', '$2y$10$emmaAEbRAoabRvrsMyNNtuaG.8X5qc4mlBcMNpjxhWUJw1Y9a5X6C', 'LE2RSgPPBI', 2, 1, '2017-12-10 06:34:21', '2017-12-10 06:34:21'),
(34, 'Scotty Schumm', 'kassulke.polly@hotmail.com', '1', '0', '0', '$2y$10$emmaAEbRAoabRvrsMyNNtuaG.8X5qc4mlBcMNpjxhWUJw1Y9a5X6C', 'G2cEl92ixQ', 1, 2, '2017-12-10 06:34:21', '2017-12-10 06:34:21'),
(35, 'Mrs. Cordie Goodwin DDS', 'pemard@rosenbaum.net', '0', '0', '0', '$2y$10$emmaAEbRAoabRvrsMyNNtuaG.8X5qc4mlBcMNpjxhWUJw1Y9a5X6C', 'AHn1pGEqBj', 2, 1, '2017-12-10 06:34:21', '2017-12-10 06:34:21'),
(36, 'Thaddeus Schneider', 'theo.bins@gmail.com', '1', '0', '0', '$2y$10$emmaAEbRAoabRvrsMyNNtuaG.8X5qc4mlBcMNpjxhWUJw1Y9a5X6C', 'zvbleqNWmM', 2, 3, '2017-12-10 06:34:21', '2017-12-10 06:34:21'),
(37, 'Alek Blanda', 'walter.hayley@yost.net', '0', '0', '0', '$2y$10$emmaAEbRAoabRvrsMyNNtuaG.8X5qc4mlBcMNpjxhWUJw1Y9a5X6C', 'sJs6DHEr0o', 1, 1, '2017-12-10 06:34:21', '2017-12-10 06:34:21'),
(38, 'Soledad Buckridge', 'boehm.carolina@yahoo.com', '0', '0', '0', '$2y$10$emmaAEbRAoabRvrsMyNNtuaG.8X5qc4mlBcMNpjxhWUJw1Y9a5X6C', 'DtRxrMeu8E', 2, 3, '2017-12-10 06:34:21', '2017-12-10 06:34:21'),
(39, 'Daisy Abbott', 'luella15@gmail.com', '1', '0', '0', '$2y$10$emmaAEbRAoabRvrsMyNNtuaG.8X5qc4mlBcMNpjxhWUJw1Y9a5X6C', 'nOUYxEUMTB', 2, 2, '2017-12-10 06:34:21', '2017-12-10 06:34:21'),
(40, 'Reggie Morissette', 'chadrick.stark@morissette.com', '0', '0', '0', '$2y$10$emmaAEbRAoabRvrsMyNNtuaG.8X5qc4mlBcMNpjxhWUJw1Y9a5X6C', '7sPSsynzZs', 1, 1, '2017-12-10 06:34:21', '2017-12-10 06:34:21'),
(41, 'Mr. Dillon Hartmann', 'kgorczany@leannon.info', '1', '0', '0', '$2y$10$emmaAEbRAoabRvrsMyNNtuaG.8X5qc4mlBcMNpjxhWUJw1Y9a5X6C', 'fXqaUUF6aJ', 1, 3, '2017-12-10 06:34:21', '2017-12-10 06:34:21'),
(42, 'Miss Heidi Runolfsson', 'arielle.anderson@nader.com', '1', '0', '0', '$2y$10$emmaAEbRAoabRvrsMyNNtuaG.8X5qc4mlBcMNpjxhWUJw1Y9a5X6C', '8Fys7vZeIs', 2, 3, '2017-12-10 06:34:21', '2017-12-10 06:34:21'),
(43, 'Bettie Berge', 'kemmer.zelma@yahoo.com', '1', '0', '0', '$2y$10$emmaAEbRAoabRvrsMyNNtuaG.8X5qc4mlBcMNpjxhWUJw1Y9a5X6C', 'm9jKqWf1z0', 2, 1, '2017-12-10 06:34:21', '2017-12-10 06:34:21'),
(44, 'Nicole Brekke', 'roy.beier@gmail.com', '0', '0', '0', '$2y$10$emmaAEbRAoabRvrsMyNNtuaG.8X5qc4mlBcMNpjxhWUJw1Y9a5X6C', 'meRTavl4Mp', 2, 2, '2017-12-10 06:34:21', '2017-12-10 06:34:21'),
(45, 'Ezequiel Williamson Jr.', 'bednar.madyson@herzog.com', '0', '0', '0', '$2y$10$emmaAEbRAoabRvrsMyNNtuaG.8X5qc4mlBcMNpjxhWUJw1Y9a5X6C', 'Z5ocVrOL0c', 2, 1, '2017-12-10 06:34:21', '2017-12-10 06:34:21'),
(46, 'Brown Harber DDS', 'camilla.zieme@yahoo.com', '1', '0', '0', '$2y$10$emmaAEbRAoabRvrsMyNNtuaG.8X5qc4mlBcMNpjxhWUJw1Y9a5X6C', '3PAHQJToch', 1, 1, '2017-12-10 06:34:21', '2017-12-10 06:34:21'),
(47, 'Ronny Padberg', 'gaylord.tamia@bode.com', '0', '0', '0', '$2y$10$emmaAEbRAoabRvrsMyNNtuaG.8X5qc4mlBcMNpjxhWUJw1Y9a5X6C', 'GPEkk4Z47p', 2, 3, '2017-12-10 06:34:21', '2017-12-10 06:34:21'),
(48, 'Mrs. Alia Runolfsson', 'dock.boyer@gmail.com', '0', '0', '0', '$2y$10$emmaAEbRAoabRvrsMyNNtuaG.8X5qc4mlBcMNpjxhWUJw1Y9a5X6C', 'QIr6c9oe3n', 2, 2, '2017-12-10 06:34:21', '2017-12-10 06:34:21'),
(49, 'Shawna Senger', 'randy.greenholt@bartoletti.com', '0', '0', '0', '$2y$10$emmaAEbRAoabRvrsMyNNtuaG.8X5qc4mlBcMNpjxhWUJw1Y9a5X6C', '2tRvHm4cJG', 1, 3, '2017-12-10 06:34:21', '2017-12-10 06:34:21'),
(50, 'Rico Will I', 'wiza.violet@ohara.org', '1', '0', '0', '$2y$10$emmaAEbRAoabRvrsMyNNtuaG.8X5qc4mlBcMNpjxhWUJw1Y9a5X6C', 'VQIpK4oGYm', 1, 3, '2017-12-10 06:34:21', '2017-12-10 06:34:21'),
(51, 'Alison Barton', 'don.nolan@swift.info', '0', '0', '0', '$2y$10$emmaAEbRAoabRvrsMyNNtuaG.8X5qc4mlBcMNpjxhWUJw1Y9a5X6C', '3Vt3QPyuHM', 1, 3, '2017-12-10 06:34:21', '2017-12-10 06:34:21'),
(52, 'Prof. Leonora Hartmann', 'uconnelly@hotmail.com', '1', '0', '0', '$2y$10$emmaAEbRAoabRvrsMyNNtuaG.8X5qc4mlBcMNpjxhWUJw1Y9a5X6C', 'tqwXknUm3t', 2, 2, '2017-12-10 06:34:21', '2017-12-10 06:34:21'),
(53, 'Aliya Lebsack', 'abeahan@kuhlman.com', '1', '0', '0', '$2y$10$emmaAEbRAoabRvrsMyNNtuaG.8X5qc4mlBcMNpjxhWUJw1Y9a5X6C', 'VlYuZFF8Io', 1, 3, '2017-12-10 06:34:21', '2017-12-10 06:34:21'),
(54, 'Dr. Felton Labadie', 'zschamberger@kreiger.info', '1', '0', '0', '$2y$10$emmaAEbRAoabRvrsMyNNtuaG.8X5qc4mlBcMNpjxhWUJw1Y9a5X6C', 'a0aN9fkRVq', 1, 3, '2017-12-10 06:34:21', '2017-12-10 06:34:21'),
(55, 'Deangelo Kassulke', 'jamaal47@kessler.biz', '0', '0', '0', '$2y$10$emmaAEbRAoabRvrsMyNNtuaG.8X5qc4mlBcMNpjxhWUJw1Y9a5X6C', 'hzj48zHIUI', 1, 3, '2017-12-10 06:34:21', '2017-12-10 06:34:21'),
(56, 'Ms. Frances Schowalter I', 'tkerluke@thiel.biz', '1', '0', '0', '$2y$10$emmaAEbRAoabRvrsMyNNtuaG.8X5qc4mlBcMNpjxhWUJw1Y9a5X6C', '4fPAorTOza', 2, 1, '2017-12-10 06:34:21', '2017-12-10 06:34:21'),
(57, 'Prof. Amani Ruecker', 'ike.jacobi@yahoo.com', '1', '0', '0', '$2y$10$emmaAEbRAoabRvrsMyNNtuaG.8X5qc4mlBcMNpjxhWUJw1Y9a5X6C', '2o6phIM1AJ', 2, 1, '2017-12-10 06:34:21', '2017-12-10 06:34:21'),
(58, 'Keagan O''Conner', 'qbosco@frami.com', '0', '0', '0', '$2y$10$emmaAEbRAoabRvrsMyNNtuaG.8X5qc4mlBcMNpjxhWUJw1Y9a5X6C', 'd3KOAY6Zsq', 2, 2, '2017-12-10 06:34:21', '2017-12-10 06:34:21'),
(59, 'Mrs. Keely Durgan', 'delta.lind@hagenes.com', '1', '0', '0', '$2y$10$emmaAEbRAoabRvrsMyNNtuaG.8X5qc4mlBcMNpjxhWUJw1Y9a5X6C', 'KhcwAK0XqN', 1, 3, '2017-12-10 06:34:21', '2017-12-10 06:34:21'),
(60, 'Camilla Hilpert', 'fgoodwin@dach.com', '0', '0', '0', '$2y$10$emmaAEbRAoabRvrsMyNNtuaG.8X5qc4mlBcMNpjxhWUJw1Y9a5X6C', 'Dr8uIIf1pz', 2, 3, '2017-12-10 06:34:21', '2017-12-10 06:34:21');

-- --------------------------------------------------------

--
-- 表的结构 `teachers`
--

CREATE TABLE IF NOT EXISTS `teachers` (
  `id` int(10) unsigned NOT NULL,
  `username` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `remember_token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `schools_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- 转存表中的数据 `teachers`
--

INSERT INTO `teachers` (`id`, `username`, `email`, `password`, `remember_token`, `schools_id`, `created_at`, `updated_at`) VALUES
(1, 'Eusebio Larkin', 'djohnson@yahoo.com', '$2y$10$b4bDzbOFYl0YxmCBTabmfe.SJfkLqmxv5MhApcIGwRrSXe7CX5wVe', 'vZgwdYeAqCBkMxNAdroRmKlopQlwbxQ2z2W9COardhONRBqpr3HfwUNnaHOx', 1, '2017-12-10 06:34:21', '2017-12-10 08:00:00'),
(2, 'Stefanie Greenholt', 'ariel.champlin@friesen.com', '$2y$10$b4bDzbOFYl0YxmCBTabmfe.SJfkLqmxv5MhApcIGwRrSXe7CX5wVe', 'ZaW973ghxl', 1, '2017-12-10 06:34:21', '2017-12-10 06:34:21');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_comments_posts1_idx` (`posts_id`),
  ADD KEY `fk_comments_teachers1_idx` (`teachers_id`);

--
-- Indexes for table `groups`
--
ALTER TABLE `groups`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `lessons`
--
ALTER TABLE `lessons`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_lessons_teachers1_idx` (`teachers_id`);

--
-- Indexes for table `lesson_logs`
--
ALTER TABLE `lesson_logs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_lesson_logs_teachers1_idx` (`teachers_id`),
  ADD KEY `fk_lesson_logs_lessons1_idx` (`lessons_id`),
  ADD KEY `fk_lesson_logs_sclasses1_idx` (`sclasses_id`);

--
-- Indexes for table `marks`
--
ALTER TABLE `marks`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_marks_posts1_idx` (`posts_id`),
  ADD KEY `fk_marks_students1_idx` (`students_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_posts_lesson_logs1_idx` (`lesson_logs_id`),
  ADD KEY `fk_posts_students1_idx` (`students_id`);

--
-- Indexes for table `post_rates`
--
ALTER TABLE `post_rates`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_post_rates_teachers1_idx` (`teachers_id`),
  ADD KEY `fk_post_rates_posts1_idx` (`posts_id`);

--
-- Indexes for table `schools`
--
ALTER TABLE `schools`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sclasses`
--
ALTER TABLE `sclasses`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_school_classes_schools1_idx` (`schools_id`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_students_sclasses1_idx` (`sclasses_id`),
  ADD KEY `fk_students_groups1_idx` (`groups_id`);

--
-- Indexes for table `teachers`
--
ALTER TABLE `teachers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_teachers_schools2_idx` (`schools_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `groups`
--
ALTER TABLE `groups`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `lessons`
--
ALTER TABLE `lessons`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `lesson_logs`
--
ALTER TABLE `lesson_logs`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `marks`
--
ALTER TABLE `marks`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=195;
--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `post_rates`
--
ALTER TABLE `post_rates`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `schools`
--
ALTER TABLE `schools`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `sclasses`
--
ALTER TABLE `sclasses`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=61;
--
-- AUTO_INCREMENT for table `teachers`
--
ALTER TABLE `teachers`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- 限制导出的表
--

--
-- 限制表 `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `fk_comments_posts1_idx` FOREIGN KEY (`posts_id`) REFERENCES `posts` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_comments_teachers1_idx` FOREIGN KEY (`teachers_id`) REFERENCES `teachers` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- 限制表 `lessons`
--
ALTER TABLE `lessons`
  ADD CONSTRAINT `fk_lessons_teachers1_idx` FOREIGN KEY (`teachers_id`) REFERENCES `teachers` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- 限制表 `lesson_logs`
--
ALTER TABLE `lesson_logs`
  ADD CONSTRAINT `fk_lesson_logs_lessons1_idx` FOREIGN KEY (`lessons_id`) REFERENCES `lessons` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_lesson_logs_sclasses1_idx` FOREIGN KEY (`sclasses_id`) REFERENCES `sclasses` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_lesson_logs_teachers1_idx` FOREIGN KEY (`teachers_id`) REFERENCES `teachers` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- 限制表 `marks`
--
ALTER TABLE `marks`
  ADD CONSTRAINT `fk_marks_posts1_idx` FOREIGN KEY (`posts_id`) REFERENCES `posts` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_marks_students1_idx` FOREIGN KEY (`students_id`) REFERENCES `students` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- 限制表 `posts`
--
ALTER TABLE `posts`
  ADD CONSTRAINT `fk_posts_lesson_logs1_idx` FOREIGN KEY (`lesson_logs_id`) REFERENCES `lesson_logs` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_posts_students1_idx` FOREIGN KEY (`students_id`) REFERENCES `students` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- 限制表 `post_rates`
--
ALTER TABLE `post_rates`
  ADD CONSTRAINT `fk_post_rates_posts1_idx` FOREIGN KEY (`posts_id`) REFERENCES `posts` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_post_rates_teachers1_idx` FOREIGN KEY (`teachers_id`) REFERENCES `teachers` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- 限制表 `sclasses`
--
ALTER TABLE `sclasses`
  ADD CONSTRAINT `fk_school_classes_schools1_idx` FOREIGN KEY (`schools_id`) REFERENCES `schools` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- 限制表 `students`
--
ALTER TABLE `students`
  ADD CONSTRAINT `fk_students_groups1_idx` FOREIGN KEY (`groups_id`) REFERENCES `groups` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_students_sclasses1_idx` FOREIGN KEY (`sclasses_id`) REFERENCES `sclasses` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- 限制表 `teachers`
--
ALTER TABLE `teachers`
  ADD CONSTRAINT `fk_teachers_schools2_idx` FOREIGN KEY (`schools_id`) REFERENCES `schools` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
