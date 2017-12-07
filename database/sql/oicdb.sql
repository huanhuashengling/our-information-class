-- phpMyAdmin SQL Dump
-- version 4.4.15.5
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: 2017-12-07 08:19:11
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
(1, 'Denis Friesen', '$2y$10$Wkr3900B82KuEJNIOECb7.qC5Mngi.EFN1vFUyd6M6ggjnmFOD.7y', 'DG2L0zvDUUEVqvSHz1upY671dBPCCqsMZiSWRRe6Nxb71p8AmYkhAHoh3Pat', '2017-11-09 06:26:18', '2017-12-05 21:31:17'),
(2, 'Isom Bahringer', '$2y$10$Wkr3900B82KuEJNIOECb7.qC5Mngi.EFN1vFUyd6M6ggjnmFOD.7y', '4FUfKbSOJ7', '2017-11-09 06:26:18', '2017-11-09 06:26:18'),
(3, 'Lucienne Hagenes', '$2y$10$Wkr3900B82KuEJNIOECb7.qC5Mngi.EFN1vFUyd6M6ggjnmFOD.7y', 'Gt6cvBBX3j', '2017-11-09 06:26:18', '2017-11-09 06:26:18');

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
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- 转存表中的数据 `comments`
--

INSERT INTO `comments` (`id`, `posts_id`, `content`, `teachers_id`, `created_at`, `updated_at`) VALUES
(1, 44, 'asasas', 2, '2017-11-19 06:14:27', '2017-11-19 06:14:27'),
(2, 48, '填写评价内容', 2, '2017-12-06 06:12:16', '2017-12-06 06:12:16');

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
(4, NULL, 'PowerPoint', '自定义动画', 'jpg', '##我是帮助文档##\r\n###请提交一份你的画图作品\r\n---\r\n请根据一下步骤完成你的作业任务：\r\n1. 到往上搜索一份ppt模板\r\n2. 修改封面为自己的名字\r\n3. 自己定义标题，以及插入一张背景图片\r\n![\\Screen Shot 2015-03-28 at 11.08.04 AM.png][0.01162620310759177]\r\n\r\n\r\n  [0.01162620310759177]: http://www.oic.com:8001/uploads/md/befa042c72086ac8a438f5bc7f9b5446.png', NULL, 2, NULL, '2017-12-06 06:36:00'),
(5, NULL, '电子表格', '纪录生活中的电器', 'jpg', '##记录生活中的电器##\r\n\r\n1. 打开电子表格\r\n2. 列出生活中的几样电器\r\n3. 将它们的特征写下来\r\n\r\n\r\n---\r\n\r\n![\\茶油1.jpg][0.49547782869081836]\r\n\r\n> 电视机\r\n> 冰箱\r\n\r\n![\\Screen Shot 2015-03-28 at 11.08.04 AM.png][0.011323653581183812]\r\n\r\n  [0.011323653581183812]: http://www.oic.com:8001/uploads/md/80795fda9adcd82b3611ab672b8e1991.png\r\n\r\n  [0.49547782869081836]: http://www.oic.com:8001/uploads/md/fdeb38adf77f1999d3b1a3b2a77b7948.jpg', NULL, 2, NULL, '2017-12-05 21:34:56');

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
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- 转存表中的数据 `lesson_logs`
--

INSERT INTO `lesson_logs` (`id`, `lessons_id`, `status`, `ended_at`, `teachers_id`, `sclasses_id`, `created_at`, `updated_at`) VALUES
(1, 1, 'close', NULL, 2, 1, NULL, NULL),
(2, 2, 'close', NULL, 2, 1, NULL, NULL),
(3, 3, 'close', NULL, 2, 1, NULL, NULL),
(4, 4, 'close', NULL, 2, 1, NULL, NULL),
(5, 5, 'open', NULL, 2, 1, NULL, NULL);

-- --------------------------------------------------------

--
-- 表的结构 `migrations`
--

CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int(10) unsigned NOT NULL,
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=131 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- 转存表中的数据 `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(121, '2017_11_01_133856_create_admins_table', 1),
(122, '2017_11_02_142635_create_schools_table', 1),
(123, '2017_11_02_142666_create_sclasses_table', 1),
(124, '2017_11_02_143014_create_teachers_table', 1),
(125, '2017_11_02_143253_create_groups_table', 1),
(126, '2017_11_02_144122_create_students_table', 1),
(127, '2017_11_02_144529_create_lessons_table', 1),
(128, '2017_11_02_144917_create_lesson_logs_table', 1),
(129, '2017_11_02_150204_create_posts_table', 1),
(130, '2017_11_02_150644_create_comments_table', 1);

-- --------------------------------------------------------

--
-- 表的结构 `posts`
--

CREATE TABLE IF NOT EXISTS `posts` (
  `id` int(10) unsigned NOT NULL,
  `lesson_logs_id` int(10) unsigned NOT NULL,
  `file_path` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `post_code` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `content` text COLLATE utf8_unicode_ci,
  `students_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=51 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- 转存表中的数据 `posts`
--

INSERT INTO `posts` (`id`, `lesson_logs_id`, `file_path`, `post_code`, `content`, `students_id`, `created_at`, `updated_at`) VALUES
(2, 1, '/uploads/12647.png', '12647', 'asasasasas', 4, '2017-11-09 06:26:18', '2017-11-09 06:26:18'),
(3, 1, '/uploads/12647.png', '12647', 'asasasasas', 5, '2017-11-09 06:26:18', '2017-11-09 06:26:18'),
(4, 1, '/uploads/12647.png', '12647', 'asasasasas', 6, '2017-11-09 06:26:18', '2017-11-09 06:26:18'),
(5, 1, '/uploads/12647.png', '12647', 'asasasasas', 7, '2017-11-09 06:26:18', '2017-11-09 06:26:18'),
(6, 1, '/uploads/12647.png', '12647', 'asasasasas', 8, '2017-11-09 06:26:18', '2017-11-09 06:26:18'),
(7, 1, '/uploads/12647.png', '12647', 'asasasasas', 9, '2017-11-09 06:26:18', '2017-11-09 06:26:18'),
(8, 1, '/uploads/12647.png', '12647', 'asasasasas', 10, '2017-11-09 06:26:18', '2017-11-09 06:26:18'),
(9, 2, '/uploads/12647.png', '12647', 'asasasasas', 4, '2017-11-09 06:26:18', '2017-11-09 06:26:18'),
(10, 2, '/uploads/12647.png', '12647', 'asasasasas', 5, '2017-11-09 06:26:18', '2017-11-09 06:26:18'),
(11, 2, '/uploads/12647.png', '12647', 'asasasasas', 6, '2017-11-09 06:26:18', '2017-11-09 06:26:18'),
(12, 2, '/uploads/12647.png', '12647', 'asasasasas', 7, '2017-11-09 06:26:18', '2017-11-09 06:26:18'),
(13, 2, '/uploads/12647.png', '12647', 'asasasasas', 8, '2017-11-09 06:26:18', '2017-11-09 06:26:18'),
(14, 2, '/uploads/12647.png', '12647', 'asasasasas', 9, '2017-11-09 06:26:18', '2017-11-09 06:26:18'),
(15, 2, '/uploads/12647.png', '12647', 'asasasasas', 10, '2017-11-09 06:26:18', '2017-11-09 06:26:18'),
(16, 2, '/uploads/12647.png', '12647', 'asasasasas', 11, '2017-11-09 06:26:18', '2017-11-09 06:26:18'),
(17, 3, '/uploads/12647.png', '12647', 'asasasasas', 4, '2017-11-09 06:26:18', '2017-11-09 06:26:18'),
(18, 3, '/uploads/12647.png', '12647', 'asasasasas', 5, '2017-11-09 06:26:18', '2017-11-09 06:26:18'),
(19, 3, '/uploads/12647.png', '12647', 'asasasasas', 6, '2017-11-09 06:26:18', '2017-11-09 06:26:18'),
(20, 3, '/uploads/12647.png', '12647', 'asasasasas', 7, '2017-11-09 06:26:18', '2017-11-09 06:26:18'),
(21, 3, '/uploads/12647.png', '12647', 'asasasasas', 8, '2017-11-09 06:26:18', '2017-11-09 06:26:18'),
(22, 3, '/uploads/12647.png', '12647', 'asasasasas', 9, '2017-11-09 06:26:18', '2017-11-09 06:26:18'),
(23, 3, '/uploads/12647.png', '12647', 'asasasasas', 10, '2017-11-09 06:26:18', '2017-11-09 06:26:18'),
(24, 3, '/uploads/12647.png', '12647', 'asasasasas', 11, '2017-11-09 06:26:18', '2017-11-09 06:26:18'),
(25, 3, '/uploads/12647.png', '12647', 'asasasasas', 12, '2017-11-09 06:26:18', '2017-11-09 06:26:18'),
(26, 4, '/uploads/12647.png', '12647', 'asasasasas', 4, '2017-11-09 06:26:18', '2017-11-09 06:26:18'),
(27, 4, '/uploads/12647.png', '12647', 'asasasasas', 5, '2017-11-09 06:26:18', '2017-11-09 06:26:18'),
(28, 4, '/uploads/12647.png', '12647', 'asasasasas', 6, '2017-11-09 06:26:18', '2017-11-09 06:26:18'),
(29, 4, '/uploads/12647.png', '12647', 'asasasasas', 7, '2017-11-09 06:26:18', '2017-11-09 06:26:18'),
(30, 4, '/uploads/12647.png', '12647', 'asasasasas', 8, '2017-11-09 06:26:18', '2017-11-09 06:26:18'),
(31, 4, '/uploads/12647.png', '12647', 'asasasasas', 9, '2017-11-09 06:26:18', '2017-11-09 06:26:18'),
(32, 4, '/uploads/12647.png', '12647', 'asasasasas', 10, '2017-11-09 06:26:18', '2017-11-09 06:26:18'),
(33, 4, '/uploads/12647.png', '12647', 'asasasasas', 11, '2017-11-09 06:26:18', '2017-11-09 06:26:18'),
(34, 4, '/uploads/12647.png', '12647', 'asasasasas', 12, '2017-11-09 06:26:18', '2017-11-09 06:26:18'),
(35, 5, '/uploads/12647.png', '12647', 'asasasasas', 4, '2017-11-09 06:26:18', '2017-11-09 06:26:18'),
(36, 5, '/uploads/12647.png', '12647', 'asasasasas', 5, '2017-11-09 06:26:18', '2017-11-09 06:26:18'),
(37, 5, '/uploads/12647.png', '12647', 'asasasasas', 6, '2017-11-09 06:26:18', '2017-11-09 06:26:18'),
(38, 5, '/uploads/12647.png', '12647', 'asasasasas', 7, '2017-11-09 06:26:18', '2017-11-09 06:26:18'),
(39, 5, '/uploads/12647.png', '12647', 'asasasasas', 8, '2017-11-09 06:26:18', '2017-11-09 06:26:18'),
(40, 5, '/uploads/12647.png', '12647', 'asasasasas', 9, '2017-11-09 06:26:18', '2017-11-09 06:26:18'),
(41, 5, '/uploads/12647.png', '12647', 'asasasasas', 10, '2017-11-09 06:26:18', '2017-11-09 06:26:18'),
(42, 5, '/uploads/12647.png', '12647', 'asasasasas', 11, '2017-11-09 06:26:18', '2017-11-09 06:26:18'),
(43, 5, '/uploads/12647.png', '12647', 'asasasasas', 12, '2017-11-09 06:26:18', '2017-11-09 06:26:18'),
(44, 5, '20171113052503--5a092cafb5689.png', '5a092cafb5689', '', 1, '2017-11-12 21:25:03', '2017-11-12 21:25:03'),
(45, 5, '20171113053053--5a092e0d0b106.png', '5a092e0d0b106', '', 1, '2017-11-12 21:30:53', '2017-11-12 21:30:53'),
(46, 5, '20171113-5a0983914c04a.png', '5a0983914c04a', '', 1, '2017-11-13 03:35:45', '2017-11-13 03:35:45'),
(47, 5, '20171113-5a09a62979046.png', '5a09a62979046', '', 1, '2017-11-13 06:03:21', '2017-11-13 06:03:21'),
(48, 5, '20171119-5a121379c470f.png', '5a121379c470f', '', 1, '2017-11-19 15:27:53', '2017-11-19 15:27:53'),
(49, 4, '20171206-5a280450b5c64.png', '5a280450b5c64', '', 1, '2017-12-06 06:53:04', '2017-12-06 06:53:04'),
(50, 3, '20171206-5a2804db3d517.pdf', '5a2804db3d517', '', 1, '2017-12-06 06:55:23', '2017-12-06 06:55:23');

-- --------------------------------------------------------

--
-- 表的结构 `post_rates`
--

CREATE TABLE IF NOT EXISTS `post_rates` (
  `id` int(10) unsigned NOT NULL,
  `posts_id` int(11) NOT NULL,
  `rate` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `teachers_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- 转存表中的数据 `post_rates`
--

INSERT INTO `post_rates` (`id`, `posts_id`, `rate`, `teachers_id`, `created_at`, `updated_at`) VALUES
(1, 36, 'good', 2, '2017-11-19 02:59:37', '2017-11-19 03:01:07'),
(2, 44, 'lower', 2, '2017-11-19 03:46:48', '2017-11-19 06:10:11'),
(3, 48, 'good', 2, '2017-12-06 06:12:06', '2017-12-06 06:12:06');

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

--
-- 转存表中的数据 `schools`
--

INSERT INTO `schools` (`id`, `title`, `district`, `description`, `created_at`, `updated_at`) VALUES
(1, '燕山小学', '芙蓉区', '城区学校', NULL, NULL);

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
(1, 1, 2013, '丙', 3, '2017-11-09 06:26:18', '2017-11-09 06:26:18'),
(2, 1, 2012, '丙', 3, '2017-11-09 06:26:18', '2017-11-09 06:26:18'),
(3, 1, 2014, '丙', 3, '2017-11-09 06:26:18', '2017-11-09 06:26:18');

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
(1, 'Dr. Brielle Purdy', 'pfeffer.mckenna@king.org', '1', '0', '0', '$2y$10$esztVqaH7VMjgfGxyL14T.O5dpFou4nia6Kw2lI6jxinGn/6sbCo6', 'crvzHRJ98j3o4P2VbWbWOcEZl24cPVTlMneTmHOYLcKDWCV42xZe5MGbINZD', 1, 1, '2017-11-09 06:26:18', '2017-12-06 06:26:30'),
(2, 'Isac Schuster', 'jamey.powlowski@baumbach.com', '1', '0', '0', '$2y$10$esztVqaH7VMjgfGxyL14T.O5dpFou4nia6Kw2lI6jxinGn/6sbCo6', 'QsTBjQ4RQq', 1, 3, '2017-11-09 06:26:18', '2017-11-09 06:26:18'),
(3, 'Salvador Raynor Sr.', 'nhayes@hotmail.com', '1', '0', '0', '$2y$10$esztVqaH7VMjgfGxyL14T.O5dpFou4nia6Kw2lI6jxinGn/6sbCo6', '9xY9d0mnZ8', 1, 1, '2017-11-09 06:26:18', '2017-11-09 06:26:18'),
(4, 'Ms. Angelica Jones II', 'ejerde@gmail.com', '0', '0', '0', '$2y$10$esztVqaH7VMjgfGxyL14T.O5dpFou4nia6Kw2lI6jxinGn/6sbCo6', '3XmOS8Kq6Z', 1, 3, '2017-11-09 06:26:18', '2017-11-09 06:26:18'),
(5, 'Raymundo Cummerata', 'bashirian.gisselle@marquardt.net', '1', '0', '0', '$2y$10$esztVqaH7VMjgfGxyL14T.O5dpFou4nia6Kw2lI6jxinGn/6sbCo6', 'BLTD0KaCjr', 1, 2, '2017-11-09 06:26:18', '2017-11-09 06:26:18'),
(6, 'Marcella Ankunding III', 'pmurphy@yahoo.com', '0', '0', '0', '$2y$10$esztVqaH7VMjgfGxyL14T.O5dpFou4nia6Kw2lI6jxinGn/6sbCo6', 'LO5LusL4nt', 1, 2, '2017-11-09 06:26:18', '2017-11-09 06:26:18'),
(7, 'Alford Hudson IV', 'presley.beatty@hotmail.com', '1', '0', '0', '$2y$10$esztVqaH7VMjgfGxyL14T.O5dpFou4nia6Kw2lI6jxinGn/6sbCo6', 'NrwjTj9aBy', 1, 3, '2017-11-09 06:26:18', '2017-11-09 06:26:18'),
(8, 'Golda Kautzer', 'will.charlene@yahoo.com', '0', '0', '0', '$2y$10$esztVqaH7VMjgfGxyL14T.O5dpFou4nia6Kw2lI6jxinGn/6sbCo6', 'M4JID375Fg', 2, 2, '2017-11-09 06:26:18', '2017-11-09 06:26:18'),
(9, 'Alfredo Rutherford', 'yfunk@hotmail.com', '1', '0', '0', '$2y$10$esztVqaH7VMjgfGxyL14T.O5dpFou4nia6Kw2lI6jxinGn/6sbCo6', 'eZw5BzGCHd', 2, 2, '2017-11-09 06:26:18', '2017-11-09 06:26:18'),
(10, 'Mrs. Ottilie Lang', 'kemmer.teresa@koch.com', '1', '0', '0', '$2y$10$esztVqaH7VMjgfGxyL14T.O5dpFou4nia6Kw2lI6jxinGn/6sbCo6', 'L2XljnnIna', 2, 3, '2017-11-09 06:26:18', '2017-11-09 06:26:18'),
(11, 'Stanton Yost', 'savanna12@ziemann.biz', '0', '0', '0', '$2y$10$esztVqaH7VMjgfGxyL14T.O5dpFou4nia6Kw2lI6jxinGn/6sbCo6', 'SGhRq71BZx', 2, 3, '2017-11-09 06:26:18', '2017-11-09 06:26:18'),
(12, 'Dejah Runolfsson', 'cristopher85@cole.info', '0', '0', '0', '$2y$10$esztVqaH7VMjgfGxyL14T.O5dpFou4nia6Kw2lI6jxinGn/6sbCo6', '9H0BaSGmZW', 1, 3, '2017-11-09 06:26:18', '2017-11-09 06:26:18'),
(13, 'Colten Dooley', 'alayna25@gmail.com', '1', '0', '0', '$2y$10$esztVqaH7VMjgfGxyL14T.O5dpFou4nia6Kw2lI6jxinGn/6sbCo6', '6nYkJ0S6oH', 1, 3, '2017-11-09 06:26:18', '2017-11-09 06:26:18'),
(14, 'Mona Dare', 'frankie97@mraz.org', '0', '0', '0', '$2y$10$esztVqaH7VMjgfGxyL14T.O5dpFou4nia6Kw2lI6jxinGn/6sbCo6', 'i21G9kYa7t', 1, 1, '2017-11-09 06:26:18', '2017-11-09 06:26:18'),
(15, 'Ofelia Marvin', 'maryse.von@hotmail.com', '1', '0', '0', '$2y$10$esztVqaH7VMjgfGxyL14T.O5dpFou4nia6Kw2lI6jxinGn/6sbCo6', 'vyj7ZHPkHp', 2, 3, '2017-11-09 06:26:18', '2017-11-09 06:26:18'),
(16, 'Ericka Kautzer', 'krystal22@yahoo.com', '1', '0', '0', '$2y$10$esztVqaH7VMjgfGxyL14T.O5dpFou4nia6Kw2lI6jxinGn/6sbCo6', 'pHzZ8a9jtr', 1, 3, '2017-11-09 06:26:18', '2017-11-09 06:26:18'),
(17, 'Hope Bahringer', 'aufderhar.gerda@gmail.com', '0', '0', '0', '$2y$10$esztVqaH7VMjgfGxyL14T.O5dpFou4nia6Kw2lI6jxinGn/6sbCo6', '0s1VvE9JSf', 1, 3, '2017-11-09 06:26:18', '2017-11-09 06:26:18'),
(18, 'Dr. Margarett Durgan Sr.', 'efren35@gmail.com', '1', '0', '0', '$2y$10$esztVqaH7VMjgfGxyL14T.O5dpFou4nia6Kw2lI6jxinGn/6sbCo6', '6ls8aLVNrK', 1, 3, '2017-11-09 06:26:18', '2017-11-09 06:26:18'),
(19, 'Mr. Jacques Hermann', 'thaddeus.lakin@hyatt.com', '1', '0', '0', '$2y$10$esztVqaH7VMjgfGxyL14T.O5dpFou4nia6Kw2lI6jxinGn/6sbCo6', 'FX3MPRXiGg', 2, 3, '2017-11-09 06:26:18', '2017-11-09 06:26:18'),
(20, 'Melany Stanton IV', 'zboncak.stewart@yahoo.com', '0', '0', '0', '$2y$10$esztVqaH7VMjgfGxyL14T.O5dpFou4nia6Kw2lI6jxinGn/6sbCo6', 'CGtTwmBqBd', 2, 3, '2017-11-09 06:26:18', '2017-11-09 06:26:18'),
(21, 'Prof. Kenton Gusikowski', 'hturcotte@keeling.com', '1', '0', '0', '$2y$10$esztVqaH7VMjgfGxyL14T.O5dpFou4nia6Kw2lI6jxinGn/6sbCo6', '2RTcAqZmYG', 1, 2, '2017-11-09 06:26:18', '2017-11-09 06:26:18'),
(22, 'Norris Donnelly', 'merlin.wehner@kub.com', '0', '0', '0', '$2y$10$esztVqaH7VMjgfGxyL14T.O5dpFou4nia6Kw2lI6jxinGn/6sbCo6', 'U8jX3sj3QI', 1, 1, '2017-11-09 06:26:18', '2017-11-09 06:26:18'),
(23, 'Cristina McGlynn', 'estrella.altenwerth@dickinson.com', '0', '0', '0', '$2y$10$esztVqaH7VMjgfGxyL14T.O5dpFou4nia6Kw2lI6jxinGn/6sbCo6', 'xDGPndyaPF', 2, 3, '2017-11-09 06:26:18', '2017-11-09 06:26:18'),
(24, 'Lonie Walker', 'bayer.angelica@hotmail.com', '0', '0', '0', '$2y$10$esztVqaH7VMjgfGxyL14T.O5dpFou4nia6Kw2lI6jxinGn/6sbCo6', 'UIWDeZP5CY', 1, 2, '2017-11-09 06:26:18', '2017-11-09 06:26:18'),
(25, 'Raymundo Farrell', 'zsauer@yahoo.com', '1', '0', '0', '$2y$10$esztVqaH7VMjgfGxyL14T.O5dpFou4nia6Kw2lI6jxinGn/6sbCo6', 'n8SE2awCxc', 1, 2, '2017-11-09 06:26:18', '2017-11-09 06:26:18'),
(26, 'Angie Botsford', 'cletus95@gmail.com', '1', '0', '0', '$2y$10$esztVqaH7VMjgfGxyL14T.O5dpFou4nia6Kw2lI6jxinGn/6sbCo6', 'I3MLNANt85', 2, 1, '2017-11-09 06:26:18', '2017-11-09 06:26:18'),
(27, 'Turner Kozey', 'wabshire@ferry.info', '0', '0', '0', '$2y$10$esztVqaH7VMjgfGxyL14T.O5dpFou4nia6Kw2lI6jxinGn/6sbCo6', 'HlzHTCC1m8', 2, 3, '2017-11-09 06:26:18', '2017-11-09 06:26:18'),
(28, 'Dr. Hipolito Effertz', 'justina.reichel@yahoo.com', '1', '0', '0', '$2y$10$esztVqaH7VMjgfGxyL14T.O5dpFou4nia6Kw2lI6jxinGn/6sbCo6', '0IWBwbxKg3', 1, 2, '2017-11-09 06:26:18', '2017-11-09 06:26:18'),
(29, 'Elva Langworth', 'dino.brekke@fay.biz', '0', '0', '0', '$2y$10$esztVqaH7VMjgfGxyL14T.O5dpFou4nia6Kw2lI6jxinGn/6sbCo6', 'e6IqQ3Ay83', 1, 2, '2017-11-09 06:26:18', '2017-11-09 06:26:18'),
(30, 'Flavie Fahey DDS', 'reynold.lueilwitz@yahoo.com', '0', '0', '0', '$2y$10$esztVqaH7VMjgfGxyL14T.O5dpFou4nia6Kw2lI6jxinGn/6sbCo6', 'ci12uyaq4r', 1, 3, '2017-11-09 06:26:18', '2017-11-09 06:26:18'),
(31, 'Joanne Hyatt V', 'maude00@gmail.com', '1', '0', '0', '$2y$10$esztVqaH7VMjgfGxyL14T.O5dpFou4nia6Kw2lI6jxinGn/6sbCo6', '0QqtL8wA3v', 2, 2, '2017-11-09 06:26:18', '2017-11-09 06:26:18'),
(32, 'Dejon Stokes', 'keebler.kristoffer@yahoo.com', '0', '0', '0', '$2y$10$esztVqaH7VMjgfGxyL14T.O5dpFou4nia6Kw2lI6jxinGn/6sbCo6', 'I9wfxhRSPD', 2, 2, '2017-11-09 06:26:18', '2017-11-09 06:26:18'),
(33, 'Mr. Garth Ullrich', 'yherzog@mclaughlin.com', '1', '0', '0', '$2y$10$esztVqaH7VMjgfGxyL14T.O5dpFou4nia6Kw2lI6jxinGn/6sbCo6', 'lWYKmycZdG', 1, 2, '2017-11-09 06:26:18', '2017-11-09 06:26:18'),
(34, 'Rico Sipes', 'sydnie.powlowski@gmail.com', '0', '0', '0', '$2y$10$esztVqaH7VMjgfGxyL14T.O5dpFou4nia6Kw2lI6jxinGn/6sbCo6', 'dP2rAX69Ll', 1, 1, '2017-11-09 06:26:18', '2017-11-09 06:26:18'),
(35, 'Serenity Gutkowski', 'lubowitz.bridie@schoen.com', '0', '0', '0', '$2y$10$esztVqaH7VMjgfGxyL14T.O5dpFou4nia6Kw2lI6jxinGn/6sbCo6', 'ZIW2hvzQ6j', 1, 3, '2017-11-09 06:26:18', '2017-11-09 06:26:18'),
(36, 'Dorothea Frami', 'reynold.jerde@yahoo.com', '1', '0', '0', '$2y$10$esztVqaH7VMjgfGxyL14T.O5dpFou4nia6Kw2lI6jxinGn/6sbCo6', 'rpmBAxj0kI', 1, 1, '2017-11-09 06:26:18', '2017-11-09 06:26:18'),
(37, 'Dr. Wilfredo Ullrich V', 'wwillms@gmail.com', '0', '0', '0', '$2y$10$esztVqaH7VMjgfGxyL14T.O5dpFou4nia6Kw2lI6jxinGn/6sbCo6', 'IbSIr5S7r2', 2, 1, '2017-11-09 06:26:18', '2017-11-09 06:26:18'),
(38, 'Travon Kirlin', 'schmitt.bert@tromp.org', '0', '0', '0', '$2y$10$esztVqaH7VMjgfGxyL14T.O5dpFou4nia6Kw2lI6jxinGn/6sbCo6', 'moO9KFQp3l', 1, 3, '2017-11-09 06:26:18', '2017-11-09 06:26:18'),
(39, 'Dr. Willa Wiegand V', 'wanda20@weimann.net', '1', '0', '0', '$2y$10$esztVqaH7VMjgfGxyL14T.O5dpFou4nia6Kw2lI6jxinGn/6sbCo6', 'lkmCwbpkiC', 1, 1, '2017-11-09 06:26:18', '2017-11-09 06:26:18'),
(40, 'Alysa Thiel', 'stephania.lockman@swift.info', '0', '0', '0', '$2y$10$esztVqaH7VMjgfGxyL14T.O5dpFou4nia6Kw2lI6jxinGn/6sbCo6', 'bneM2JJea6', 1, 2, '2017-11-09 06:26:18', '2017-11-09 06:26:18'),
(41, 'Hudson Abbott', 'tbraun@volkman.biz', '1', '0', '0', '$2y$10$esztVqaH7VMjgfGxyL14T.O5dpFou4nia6Kw2lI6jxinGn/6sbCo6', 'mrfY8lJmhR', 2, 3, '2017-11-09 06:26:18', '2017-11-09 06:26:18'),
(42, 'Melyna Zulauf', 'victor.nikolaus@miller.biz', '1', '0', '0', '$2y$10$esztVqaH7VMjgfGxyL14T.O5dpFou4nia6Kw2lI6jxinGn/6sbCo6', '0Yz28mLXQz', 2, 3, '2017-11-09 06:26:18', '2017-11-09 06:26:18'),
(43, 'Cleora Howe', 'shemar57@heathcote.com', '0', '0', '0', '$2y$10$esztVqaH7VMjgfGxyL14T.O5dpFou4nia6Kw2lI6jxinGn/6sbCo6', 'VXvpfW7ytb', 1, 1, '2017-11-09 06:26:18', '2017-11-09 06:26:18'),
(44, 'Gregoria Parisian', 'murray.wilmer@hotmail.com', '0', '0', '0', '$2y$10$esztVqaH7VMjgfGxyL14T.O5dpFou4nia6Kw2lI6jxinGn/6sbCo6', 'cjUsPEmYo7', 2, 1, '2017-11-09 06:26:18', '2017-11-09 06:26:18'),
(45, 'Tyra Ferry', 'ywill@yahoo.com', '0', '0', '0', '$2y$10$esztVqaH7VMjgfGxyL14T.O5dpFou4nia6Kw2lI6jxinGn/6sbCo6', 'zF4kq1N8Oj', 1, 2, '2017-11-09 06:26:18', '2017-11-09 06:26:18'),
(46, 'Solon Daugherty', 'coby.effertz@mayert.biz', '0', '0', '0', '$2y$10$esztVqaH7VMjgfGxyL14T.O5dpFou4nia6Kw2lI6jxinGn/6sbCo6', '3ItCY1GHe2', 2, 2, '2017-11-09 06:26:18', '2017-11-09 06:26:18'),
(47, 'Monserrate Willms II', 'considine.sydni@gmail.com', '1', '0', '0', '$2y$10$esztVqaH7VMjgfGxyL14T.O5dpFou4nia6Kw2lI6jxinGn/6sbCo6', '9pq0SpckoR', 2, 2, '2017-11-09 06:26:18', '2017-11-09 06:26:18'),
(48, 'Lamar Nikolaus', 'lora.keeling@farrell.com', '1', '0', '0', '$2y$10$esztVqaH7VMjgfGxyL14T.O5dpFou4nia6Kw2lI6jxinGn/6sbCo6', 'c6FFgJ3syF', 1, 2, '2017-11-09 06:26:18', '2017-11-09 06:26:18'),
(49, 'Ashtyn Stoltenberg', 'pvonrueden@yahoo.com', '1', '0', '0', '$2y$10$esztVqaH7VMjgfGxyL14T.O5dpFou4nia6Kw2lI6jxinGn/6sbCo6', 'Y9eKt1iQRR', 2, 2, '2017-11-09 06:26:18', '2017-11-09 06:26:18'),
(50, 'Lucio Armstrong', 'julio.quigley@yahoo.com', '0', '0', '0', '$2y$10$esztVqaH7VMjgfGxyL14T.O5dpFou4nia6Kw2lI6jxinGn/6sbCo6', '09wsgAtue4', 2, 3, '2017-11-09 06:26:18', '2017-11-09 06:26:18'),
(51, 'Moises VonRueden I', 'levi94@considine.org', '0', '0', '0', '$2y$10$esztVqaH7VMjgfGxyL14T.O5dpFou4nia6Kw2lI6jxinGn/6sbCo6', 'di8OmERqyk', 2, 1, '2017-11-09 06:26:18', '2017-11-09 06:26:18'),
(52, 'Anais Ebert', 'theresia.koelpin@yahoo.com', '1', '0', '0', '$2y$10$esztVqaH7VMjgfGxyL14T.O5dpFou4nia6Kw2lI6jxinGn/6sbCo6', 'CowF4gbZWX', 2, 2, '2017-11-09 06:26:18', '2017-11-09 06:26:18'),
(53, 'Garret Yost', 'wilderman.carissa@denesik.com', '1', '0', '0', '$2y$10$esztVqaH7VMjgfGxyL14T.O5dpFou4nia6Kw2lI6jxinGn/6sbCo6', 'qBGlH1DnPr', 1, 1, '2017-11-09 06:26:18', '2017-11-09 06:26:18'),
(54, 'Madalyn Mitchell', 'willa.schneider@hotmail.com', '1', '0', '0', '$2y$10$esztVqaH7VMjgfGxyL14T.O5dpFou4nia6Kw2lI6jxinGn/6sbCo6', 'CzcyySJdFw', 2, 3, '2017-11-09 06:26:18', '2017-11-09 06:26:18'),
(55, 'Dave Shields', 'lafayette17@yahoo.com', '1', '0', '0', '$2y$10$esztVqaH7VMjgfGxyL14T.O5dpFou4nia6Kw2lI6jxinGn/6sbCo6', 'KsM0o91AEv', 2, 1, '2017-11-09 06:26:18', '2017-11-09 06:26:18'),
(56, 'Modesto Mitchell MD', 'koss.miguel@hotmail.com', '1', '0', '0', '$2y$10$esztVqaH7VMjgfGxyL14T.O5dpFou4nia6Kw2lI6jxinGn/6sbCo6', 'xY266WsfYD', 1, 1, '2017-11-09 06:26:18', '2017-11-09 06:26:18'),
(57, 'Prof. Aliyah Bradtke Jr.', 'blick.stanley@gmail.com', '0', '0', '0', '$2y$10$esztVqaH7VMjgfGxyL14T.O5dpFou4nia6Kw2lI6jxinGn/6sbCo6', 'nEeCKda4tF', 2, 3, '2017-11-09 06:26:18', '2017-11-09 06:26:18'),
(58, 'Mia Hessel', 'dina11@considine.com', '1', '0', '0', '$2y$10$esztVqaH7VMjgfGxyL14T.O5dpFou4nia6Kw2lI6jxinGn/6sbCo6', 'PkCw8uJwGr', 2, 3, '2017-11-09 06:26:18', '2017-11-09 06:26:18'),
(59, 'Dr. Isaias Schaden III', 'ruecker.dustin@veum.biz', '0', '0', '0', '$2y$10$esztVqaH7VMjgfGxyL14T.O5dpFou4nia6Kw2lI6jxinGn/6sbCo6', 'HKHATu1oEP', 1, 2, '2017-11-09 06:26:18', '2017-11-09 06:26:18'),
(60, 'Prof. Tobin Haley', 'tharvey@yahoo.com', '0', '0', '0', '$2y$10$esztVqaH7VMjgfGxyL14T.O5dpFou4nia6Kw2lI6jxinGn/6sbCo6', 'EXGKAh4zMc', 1, 1, '2017-11-09 06:26:18', '2017-11-09 06:26:18');

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
(1, 'Mr. Jacey Haley DDS', 'nitzsche.delmer@kub.info', '$2y$10$FxSnrGOCjtg.M.JNhCxx9eZ3y95fBhGjr.KDOt6dH62PaEZGNwmPq', 'EWBheN39UO', 1, '2017-11-09 06:26:18', '2017-11-09 06:26:18'),
(2, 'Dexter Reinger', 'fkutch@hotmail.com', '$2y$10$FxSnrGOCjtg.M.JNhCxx9eZ3y95fBhGjr.KDOt6dH62PaEZGNwmPq', 'JgtKuQhaAHQ3vU6RuBn0uFcVCMWC9rH2Mc5N26SEoEteShJYvFqYcgjD5Hil', 1, '2017-11-09 06:26:18', '2017-12-06 07:04:34');

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
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
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
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=131;
--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=51;
--
-- AUTO_INCREMENT for table `post_rates`
--
ALTER TABLE `post_rates`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
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
-- 限制表 `posts`
--
ALTER TABLE `posts`
  ADD CONSTRAINT `fk_posts_lesson_logs1_idx` FOREIGN KEY (`lesson_logs_id`) REFERENCES `lesson_logs` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_posts_students1_idx` FOREIGN KEY (`students_id`) REFERENCES `students` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

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
