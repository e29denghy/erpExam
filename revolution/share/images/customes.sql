-- phpMyAdmin SQL Dump
-- version 3.4.10.1
-- http://www.phpmyadmin.net
--
-- 主机: localhost
-- 生成日期: 2015 年 05 月 31 日 05:34
-- 服务器版本: 5.5.20
-- PHP 版本: 5.3.10

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- 数据库: `epay`
--

-- --------------------------------------------------------

--
-- 表的结构 `customes`
--

CREATE TABLE IF NOT EXISTS `customes` (
  `cRealName` varchar(20) NOT NULL COMMENT '真实姓名',
  `cid` int(11) NOT NULL AUTO_INCREMENT COMMENT 'id',
  `cUserName` varchar(20) NOT NULL COMMENT '用户名',
  `birthday` date NOT NULL COMMENT '生日',
  `pwd` varchar(20) NOT NULL COMMENT '用户密码',
  `email` varchar(40) NOT NULL COMMENT '邮件地址',
  `pnole` char(11) NOT NULL COMMENT '手机电话',
  `address` varchar(200) NOT NULL COMMENT '住址',
  PRIMARY KEY (`cid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
