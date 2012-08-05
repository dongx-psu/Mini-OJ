-- phpMyAdmin SQL Dump
-- version 3.4.5
-- http://www.phpmyadmin.net
--
-- 主机: localhost
-- 生成日期: 2012 年 07 月 13 日 15:26
-- 服务器版本: 5.5.16
-- PHP 版本: 5.3.8

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+08:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- 数据库: `testbase`
--

-- --------------------------------------------------------

--
-- 表的结构 `logins`
--

CREATE TABLE IF NOT EXISTS `logins` (
  `id` bigint(11) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint(11) unsigned NOT NULL,
  `ip_address` bigint(11) unsigned NOT NULL,
  `login_time` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `problems`
--

CREATE TABLE IF NOT EXISTS `problems` (
  `id` bigint(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(80) NOT NULL,
  `title` varchar(80) NOT NULL,
  `description` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `records`
--

CREATE TABLE IF NOT EXISTS `records` (
  `id` bigint(11) unsigned NOT NULL AUTO_INCREMENT,
  `problem_id` bigint(11) unsigned NOT NULL,
  `time_used` int(11) NOT NULL DEFAULT '0',
  `memory_used` int(11) NOT NULL DEFAULT '0',
  `user_id` bigint(11) unsigned NOT NULL,
  `language` enum('C++','C','JAVA') NOT NULL,
  `source_code` text NOT NULL,
  `status` enum('Waiting','Running','Accepted','Time Limit Exceeded','Memory Limit Exceeded','Runtime Error','Compile Error','Wrong Answer', 'Unknown Error') NOT NULL DEFAULT 'Waiting',
  `score` int(11) NOT NULL DEFAULT '-1',
  `submit_time` datetime NOT NULL,
  `update_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `problem_id` (`problem_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `testcases`
--

CREATE TABLE IF NOT EXISTS `testcases` (
  `id` bigint(11) unsigned NOT NULL AUTO_INCREMENT,
  `problem_id` bigint(11) unsigned NOT NULL,
  `time_limit` int(11) NOT NULL,
  `memory_limit` int(11) NOT NULL,
  `case_score` int(11) NOT NULL,
  `file_name` varchar(30) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `problem_id` (`problem_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint(11) unsigned NOT NULL AUTO_INCREMENT,
  `student_no` varchar(40) NOT NULL,
  `pass` varchar(80) NOT NULL,
  `salt` varchar(80) NOT NULL,
  `iter` int(11) NOT NULL,
  `ip_address` bigint(11) unsigned NOT NULL,
  `display_name` varchar(80) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `student_no` (`student_no`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- 限制导出的表
--

--
-- 限制表 `logins`
--
ALTER TABLE `logins`
  ADD CONSTRAINT `logins_idfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- 限制表 `records`
--
ALTER TABLE `records`
  ADD CONSTRAINT `records_ibfk_1` FOREIGN KEY (`problem_id`) REFERENCES `problems` (`id`),
  ADD CONSTRAINT `records_idfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- 限制表 `testcases`
--
ALTER TABLE `testcases`
  ADD CONSTRAINT `testcases_ibfk_1` FOREIGN KEY (`problem_id`) REFERENCES `problems` (`id`) ON DELETE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

