-- phpMyAdmin SQL Dump
-- version 3.2.0.1
-- http://www.phpmyadmin.net
--
-- 主机: localhost
-- 生成日期: 2011 年 03 月 22 日 07:57
-- 服务器版本: 5.1.36
-- PHP 版本: 5.2.2

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- 数据库: `guestbook`
--

-- --------------------------------------------------------

--
-- 表的结构 `messages`
--

CREATE TABLE IF NOT EXISTS `messages` (
  `message_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nickname` varchar(50) NOT NULL,
  `content` text NOT NULL,
  `dateline` int(10) unsigned NOT NULL,
  PRIMARY KEY (`message_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=31 ;

--
-- 转存表中的数据 `messages`
--

INSERT INTO `messages` (`message_id`, `nickname`, `content`, `dateline`) VALUES
(29, 'dd', 'dd', 1292387616),
(30, 'lyctestd', 'neirongsss', 123442333),
(27, 'sfd', 'asafa', 1280542980),
(28, 'sf', 'saf', 1280542984),
(25, 'sadf', 'asf', 1280539321),
(26, 'safd', 'sadf', 1280542977),
(22, '游客', 'sdf', 1281946939),
(21, '游客', 'dd', 1281941358),
(23, '单调', '的', 1282011345),
(24, 'sdaf', 'dsaf', 1282612181);
