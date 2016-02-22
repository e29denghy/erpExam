-- phpMyAdmin SQL Dump
-- version 3.4.10.1
-- http://www.phpmyadmin.net
--
-- 主机: localhost
-- 生成日期: 2016 年 02 月 22 日 06:59
-- 服务器版本: 5.5.20
-- PHP 版本: 5.3.10

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- 数据库: `erpexam`
--

-- --------------------------------------------------------

--
-- 表的结构 `flow_answers`
--

CREATE TABLE IF NOT EXISTS `flow_answers` (
  `flow_answer_id` bigint(20) NOT NULL AUTO_INCREMENT COMMENT '答案id',
  `flow_questions_id` bigint(20) NOT NULL COMMENT '答案对应流程题目id',
  `flow_answers_steps_id` bigint(20) NOT NULL COMMENT '答案步骤id',
  `flow_answers_steps_option1` bigint(20) DEFAULT NULL COMMENT '步骤选项1编号',
  `flow_answers_steps_option2` bigint(20) DEFAULT NULL COMMENT '步骤选项2编号',
  `flow_answers_steps_option3` bigint(20) DEFAULT NULL COMMENT '步骤选项3编号',
  `flow_answers_steps_option4` bigint(20) DEFAULT NULL COMMENT '步骤选项4编号',
  `flow_answers_steps_option5` bigint(20) DEFAULT NULL COMMENT '步骤选项5编号',
  `flow_answers_steps_option6` bigint(20) DEFAULT NULL COMMENT '步骤选项6编号',
  `flow_answers_steps_option7` bigint(20) DEFAULT NULL COMMENT '步骤选项7编号',
  `flow_answers_steps_option8` bigint(20) DEFAULT NULL COMMENT '步骤选项8编号',
  `flow_answers_steps_option9` bigint(20) DEFAULT NULL COMMENT '步骤选项9编号',
  `flow_answers_steps_option10` bigint(20) DEFAULT NULL COMMENT '步骤选项10编号',
  `flow_answers_steps_branchsign` tinyint(1) NOT NULL COMMENT '分支标记',
  `flow_answers_steps_branchid` bigint(20) DEFAULT NULL COMMENT '分支号',
  `flow_answers_steps_branchpoint` tinyint(1) NOT NULL COMMENT '分支点',
  PRIMARY KEY (`flow_answer_id`),
  KEY `flow_answers_steps_option1` (`flow_answers_steps_option1`),
  KEY `flow_answers_steps_option2` (`flow_answers_steps_option2`),
  KEY `flow_answers_steps_option3` (`flow_answers_steps_option3`),
  KEY `flow_answers_steps_option4` (`flow_answers_steps_option4`),
  KEY `flow_answers_steps_option5` (`flow_answers_steps_option5`),
  KEY `flow_answers_steps_option6` (`flow_answers_steps_option6`),
  KEY `flow_answers_steps_option7` (`flow_answers_steps_option7`),
  KEY `flow_answers_steps_option8` (`flow_answers_steps_option8`),
  KEY `flow_answers_steps_option9` (`flow_answers_steps_option9`),
  KEY `flow_answers_steps_option10` (`flow_answers_steps_option10`),
  KEY `flow_questions_id` (`flow_questions_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='用于存储流程题答案相关信息' AUTO_INCREMENT=1428 ;

--
-- 转存表中的数据 `flow_answers`
--

INSERT INTO `flow_answers` (`flow_answer_id`, `flow_questions_id`, `flow_answers_steps_id`, `flow_answers_steps_option1`, `flow_answers_steps_option2`, `flow_answers_steps_option3`, `flow_answers_steps_option4`, `flow_answers_steps_option5`, `flow_answers_steps_option6`, `flow_answers_steps_option7`, `flow_answers_steps_option8`, `flow_answers_steps_option9`, `flow_answers_steps_option10`, `flow_answers_steps_branchsign`, `flow_answers_steps_branchid`, `flow_answers_steps_branchpoint`) VALUES
(454, 51, 2, 11, 47, 35, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0),
(456, 51, 4, 18, 47, 35, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0),
(457, 52, 1, 11, 26, 35, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0),
(458, 52, 2, 11, 47, 35, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0),
(461, 53, 1, 11, 26, 35, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0),
(462, 53, 2, 11, 47, 35, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0),
(465, 54, 1, 11, 26, 35, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0),
(466, 54, 2, 11, 47, 35, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0),
(843, 73, 1, 72, 65, 37, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0),
(844, 73, 2, 72, 47, 38, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0),
(845, 73, 3, 73, 83, 37, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0),
(846, 73, 4, 73, 47, 38, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0),
(881, 77, 1, 72, 65, 37, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0),
(882, 77, 2, 72, 47, 38, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0),
(883, 77, 3, 73, 83, 37, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0),
(884, 77, 4, 73, 47, 38, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0),
(885, 77, 5, 72, 80, 38, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0),
(886, 77, 6, 73, 80, 38, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0),
(887, 78, 1, 72, 65, 37, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0),
(888, 78, 2, 72, 47, 38, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0),
(889, 78, 3, 73, 83, 37, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0),
(890, 78, 4, 73, 83, 38, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0),
(891, 78, 5, 75, 84, 37, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0),
(892, 78, 6, 75, 47, 38, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0),
(893, 78, 7, 76, 47, 40, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0),
(894, 78, 8, 89, 85, 35, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0),
(895, 78, 9, 89, 86, 36, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0),
(896, 78, 10, 90, 47, 40, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0),
(947, 62, 1, 13, 65, 35, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 1, 0),
(948, 62, 2, 13, 47, 36, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 1, 0),
(949, 62, 3, 14, 61, 35, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 1, 0),
(950, 62, 4, 14, 47, 36, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 1, 0),
(951, 62, 5, 19, 62, 35, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 1, 0),
(952, 62, 6, 19, 47, 36, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 1, 0),
(953, 62, 7, 11, 63, 39, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 1, 0),
(954, 62, 8, 11, 47, 40, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 1, 0),
(955, 62, 9, 20, 64, 35, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 1, 0),
(956, 62, 10, 22, 60, 35, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 1, 0),
(957, 62, 11, 67, 26, 41, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 1, 1),
(958, 62, 12, 67, 27, 41, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 1, 1),
(959, 62, 13, 29, 47, 43, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 1, 1),
(960, 62, 14, 29, 31, 43, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 1, 1),
(961, 62, 1, 13, 65, 35, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 2, 0),
(962, 62, 2, 13, 47, 36, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 2, 0),
(963, 62, 3, 14, 61, 35, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 2, 0),
(964, 62, 4, 14, 47, 36, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 2, 0),
(965, 62, 5, 19, 62, 35, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 2, 0),
(966, 62, 6, 19, 47, 36, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 2, 0),
(967, 62, 7, 11, 63, 39, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 2, 0),
(968, 62, 8, 11, 47, 40, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 2, 0),
(969, 62, 9, 20, 64, 35, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 2, 0),
(970, 62, 10, 22, 60, 35, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 2, 0),
(971, 62, 11, 29, 47, 43, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 2, 1),
(972, 62, 12, 29, 31, 43, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 2, 1),
(973, 62, 13, 67, 26, 41, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 2, 1),
(974, 62, 14, 67, 27, 41, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 2, 1),
(975, 72, 1, 72, 65, 37, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0),
(976, 72, 2, 72, 47, 38, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0),
(977, 72, 3, 73, 83, 37, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0),
(978, 72, 4, 73, 47, 38, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0),
(979, 72, 5, 75, 84, 37, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0),
(980, 72, 6, 75, 47, 38, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0),
(981, 72, 7, 76, 47, 40, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0),
(982, 72, 8, 77, 86, 37, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0),
(983, 72, 9, 77, 79, 38, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0),
(984, 72, 10, 74, 87, 37, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0),
(985, 72, 11, 74, 47, 38, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0),
(986, 72, 12, 88, 47, 43, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0),
(987, 72, 13, 88, 31, 43, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0),
(988, 72, 14, 77, 26, 41, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0),
(989, 72, 15, 77, 27, 41, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0),
(990, 74, 1, 75, 84, 37, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0),
(991, 74, 2, 75, 47, 38, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0),
(992, 74, 3, 76, 47, 40, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0),
(993, 74, 4, 77, 86, 37, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0),
(994, 74, 5, 77, 58, 37, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0),
(995, 74, 6, 77, 79, 38, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0),
(996, 74, 7, 77, 86, 37, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0),
(997, 74, 8, 77, 79, 38, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0),
(998, 74, 9, 78, 87, 37, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0),
(999, 74, 10, 78, 47, 38, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0),
(1000, 74, 11, 88, 47, 43, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0),
(1001, 74, 12, 88, 31, 43, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0),
(1002, 74, 13, 77, 26, 41, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0),
(1003, 74, 14, 77, 27, 41, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0),
(1004, 75, 1, 77, 85, 37, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0),
(1005, 75, 2, 77, 58, 37, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0),
(1006, 75, 3, 77, 79, 38, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0),
(1007, 75, 4, 88, 47, 43, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0),
(1008, 75, 5, 88, 31, 43, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0),
(1009, 75, 6, 77, 26, 41, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0),
(1010, 75, 7, 77, 27, 41, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0),
(1011, 76, 1, 77, 85, 37, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0),
(1012, 76, 2, 77, 79, 38, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0),
(1013, 76, 3, 88, 47, 43, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0),
(1014, 76, 4, 88, 31, 43, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0),
(1015, 76, 5, 77, 26, 41, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0),
(1016, 76, 6, 77, 27, 41, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0),
(1049, 64, 1, 13, 65, 35, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0),
(1050, 64, 2, 13, 47, 36, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0),
(1051, 64, 3, 14, 61, 35, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0),
(1052, 64, 4, 14, 47, 36, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0),
(1053, 64, 5, 19, 62, 35, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0),
(1054, 64, 6, 19, 47, 36, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0),
(1055, 64, 7, 11, 63, 39, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0),
(1056, 64, 8, 11, 47, 40, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0),
(1057, 64, 9, 20, 64, 35, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0),
(1058, 64, 10, 20, 58, 35, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0),
(1059, 64, 11, 68, 65, 35, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0),
(1060, 64, 12, 68, 58, 35, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0),
(1061, 64, 13, 23, 59, 35, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0),
(1062, 64, 14, 29, 47, 43, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0),
(1063, 64, 15, 29, 31, 43, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0),
(1064, 64, 16, 67, 26, 41, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0),
(1065, 64, 17, 67, 27, 41, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0),
(1066, 65, 1, 13, 65, 35, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0),
(1067, 65, 2, 13, 47, 36, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0),
(1068, 65, 3, 14, 61, 35, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0),
(1069, 65, 4, 14, 47, 36, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0),
(1070, 65, 5, 19, 62, 35, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0),
(1071, 65, 6, 19, 47, 36, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0),
(1072, 65, 7, 11, 63, 39, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0),
(1073, 65, 8, 11, 47, 40, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0),
(1074, 65, 9, 20, 62, 35, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0),
(1075, 65, 10, 22, 59, 35, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0),
(1076, 65, 11, 29, 47, 43, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0),
(1077, 65, 12, 29, 31, 43, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0),
(1078, 65, 13, 67, 26, 41, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0),
(1079, 65, 14, 67, 27, 41, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0),
(1080, 66, 1, 13, 65, 35, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0),
(1081, 66, 2, 13, 47, 36, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0),
(1082, 66, 3, 14, 61, 35, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0),
(1083, 66, 4, 14, 47, 36, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0),
(1084, 66, 5, 19, 62, 35, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0),
(1085, 66, 6, 19, 47, 36, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0),
(1086, 66, 7, 11, 63, 39, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0),
(1087, 66, 8, 11, 47, 40, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0),
(1088, 66, 9, 20, 62, 35, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0),
(1089, 66, 10, 22, 59, 35, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0),
(1090, 66, 11, 29, 47, 43, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0),
(1091, 66, 12, 29, 31, 43, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0),
(1092, 66, 13, 67, 26, 41, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0),
(1093, 66, 14, 67, 27, 41, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0),
(1094, 67, 1, 13, 65, 35, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0),
(1095, 67, 2, 13, 47, 36, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0),
(1096, 67, 3, 14, 61, 35, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0),
(1097, 67, 4, 14, 47, 36, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0),
(1098, 67, 5, 19, 62, 35, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0),
(1099, 67, 6, 19, 47, 36, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0),
(1100, 67, 7, 32, 63, 35, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0),
(1101, 67, 8, 32, 47, 36, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0),
(1102, 67, 9, 11, 63, 39, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0),
(1103, 67, 10, 11, 47, 40, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0),
(1104, 67, 11, 20, 64, 35, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0),
(1105, 67, 12, 22, 59, 35, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0),
(1106, 67, 13, 29, 47, 43, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0),
(1107, 67, 14, 29, 31, 43, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0),
(1108, 67, 15, 67, 26, 41, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0),
(1109, 67, 16, 67, 27, 41, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0),
(1110, 68, 1, 13, 65, 35, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0),
(1111, 68, 2, 13, 47, 36, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0),
(1112, 68, 3, 14, 61, 35, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0),
(1113, 68, 4, 14, 47, 36, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0),
(1114, 68, 5, 19, 62, 35, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0),
(1115, 68, 6, 19, 47, 36, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0),
(1116, 68, 7, 11, 63, 39, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0),
(1117, 68, 8, 11, 47, 40, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0),
(1118, 68, 9, 32, 64, 35, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0),
(1119, 68, 10, 32, 47, 36, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0),
(1120, 68, 11, 33, 63, 39, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0),
(1121, 68, 12, 33, 47, 40, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0),
(1122, 68, 13, 20, 64, 35, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0),
(1123, 68, 14, 24, 59, 35, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0),
(1124, 68, 15, 29, 47, 43, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0),
(1125, 68, 16, 29, 31, 43, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0),
(1126, 68, 17, 67, 26, 41, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0),
(1127, 68, 18, 67, 27, 41, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0),
(1128, 69, 1, 13, 65, 35, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0),
(1129, 69, 2, 13, 47, 36, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0),
(1130, 69, 3, 14, 61, 35, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0),
(1131, 69, 4, 14, 47, 36, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0),
(1132, 69, 5, 19, 62, 35, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0),
(1133, 69, 6, 19, 47, 36, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0),
(1134, 69, 7, 11, 63, 39, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0),
(1135, 69, 8, 11, 47, 40, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0),
(1136, 69, 9, 20, 64, 35, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0),
(1137, 69, 10, 32, 63, 35, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0),
(1138, 69, 11, 32, 47, 36, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0),
(1139, 69, 12, 33, 63, 39, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0),
(1140, 69, 13, 33, 47, 40, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0),
(1141, 69, 14, 34, 64, 35, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0),
(1142, 69, 15, 25, 60, 35, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0),
(1143, 69, 16, 29, 47, 43, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0),
(1144, 69, 17, 29, 31, 43, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0),
(1145, 69, 18, 67, 26, 41, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0),
(1146, 69, 19, 67, 27, 41, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0),
(1147, 70, 1, 13, 65, 35, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0),
(1148, 70, 2, 13, 47, 36, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0),
(1149, 70, 3, 14, 61, 35, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0),
(1150, 70, 4, 14, 47, 36, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0),
(1151, 70, 5, 19, 62, 35, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0),
(1152, 70, 6, 19, 47, 36, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0),
(1153, 70, 7, 11, 63, 39, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0),
(1154, 70, 8, 11, 47, 40, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0),
(1155, 70, 9, 20, 64, 35, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0),
(1156, 70, 10, 22, 60, 35, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0),
(1157, 70, 11, 29, 47, 43, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0),
(1158, 70, 12, 29, 31, 43, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0),
(1159, 70, 13, 67, 26, 41, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0),
(1160, 70, 14, 67, 27, 41, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0),
(1161, 70, 15, 32, 63, 35, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0),
(1162, 70, 16, 32, 47, 36, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0),
(1163, 70, 17, 33, 63, 39, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0),
(1164, 70, 18, 33, 47, 40, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0),
(1165, 70, 19, 34, 64, 35, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0),
(1166, 70, 20, 22, 60, 35, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0),
(1167, 70, 21, 29, 47, 43, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0),
(1168, 70, 22, 29, 31, 43, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0),
(1169, 70, 23, 67, 26, 41, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0),
(1170, 70, 24, 67, 27, 41, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0),
(1171, 71, 1, 20, 64, 35, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0),
(1172, 71, 2, 22, 60, 35, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0),
(1173, 71, 3, 67, 69, 41, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0),
(1174, 71, 4, 70, 27, 41, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0),
(1175, 71, 5, 71, 27, 41, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0),
(1176, 71, 6, 29, 47, 43, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0),
(1177, 71, 7, 29, 31, 43, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0),
(1178, 82, 1, 77, 65, 37, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0),
(1179, 82, 2, 77, 58, 37, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0),
(1180, 82, 3, 77, 79, 38, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0),
(1181, 82, 4, 76, 47, 38, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0),
(1182, 82, 5, 88, 47, 43, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0),
(1183, 82, 6, 88, 31, 43, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0),
(1184, 82, 7, 77, 26, 41, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0),
(1185, 82, 8, 77, 27, 41, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0),
(1216, 79, 1, 77, 65, 37, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0),
(1217, 79, 2, 77, 79, 38, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0),
(1218, 79, 3, 76, 85, 39, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0),
(1219, 79, 4, 76, 47, 40, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0),
(1220, 79, 5, 93, 87, 37, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0),
(1221, 79, 6, 93, 79, 38, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0),
(1222, 79, 7, 88, 47, 43, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0),
(1223, 79, 8, 88, 31, 43, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0),
(1224, 79, 9, 88, 47, 43, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0),
(1225, 79, 10, 88, 31, 43, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0),
(1226, 79, 11, 77, 26, 41, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0),
(1227, 79, 12, 77, 27, 41, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0),
(1228, 79, 13, 93, 26, 41, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0),
(1229, 79, 14, 93, 27, 41, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0),
(1238, 80, 1, 77, 65, 37, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0),
(1239, 80, 2, 77, 58, 37, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0),
(1240, 80, 3, 77, 79, 38, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0),
(1241, 80, 4, 76, 47, 39, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0),
(1242, 80, 5, 88, 47, 43, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0),
(1243, 80, 6, 88, 31, 43, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0),
(1244, 80, 7, 77, 26, 41, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0),
(1245, 80, 8, 77, 27, 41, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0),
(1246, 80, 9, 93, 87, 37, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0),
(1247, 80, 10, 93, 58, 37, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0),
(1248, 80, 11, 93, 79, 38, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0),
(1249, 80, 12, 76, 47, 40, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0),
(1250, 80, 13, 88, 47, 43, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0),
(1251, 80, 14, 88, 31, 43, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0),
(1252, 80, 15, 77, 26, 41, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0),
(1253, 80, 16, 77, 27, 41, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0),
(1254, 83, 1, 77, 65, 37, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0),
(1255, 83, 2, 77, 79, 38, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0),
(1256, 83, 3, 76, 87, 39, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0),
(1257, 83, 4, 76, 47, 40, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0),
(1258, 83, 5, 76, 87, 39, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0),
(1259, 83, 6, 77, 47, 40, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0),
(1260, 83, 7, 88, 47, 43, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0),
(1261, 83, 8, 88, 31, 43, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0),
(1262, 83, 9, 95, 65, 43, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0),
(1263, 83, 10, 95, 47, 43, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0),
(1264, 83, 11, 95, 31, 43, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0),
(1265, 83, 12, 77, 26, 41, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0),
(1266, 83, 13, 77, 27, 41, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0),
(1267, 84, 1, 96, 65, 37, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0),
(1268, 84, 2, 96, 47, 38, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0),
(1269, 84, 3, 98, 84, 35, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0),
(1270, 84, 4, 98, 47, 36, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0),
(1271, 84, 5, 99, 62, 35, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0),
(1272, 84, 6, 97, 84, 37, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0),
(1273, 84, 7, 97, 79, 38, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0),
(1274, 84, 8, 29, 47, 43, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0),
(1275, 84, 9, 88, 47, 43, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0),
(1276, 84, 10, 88, 31, 43, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0),
(1277, 84, 11, 99, 94, 41, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0),
(1278, 84, 12, 97, 94, 41, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0),
(1279, 84, 13, 99, 27, 41, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0),
(1280, 84, 14, 97, 27, 41, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0),
(1281, 63, 1, 13, 65, 35, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0),
(1282, 63, 2, 13, 47, 36, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0),
(1283, 63, 3, 14, 61, 35, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0),
(1284, 63, 4, 14, 47, 36, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0),
(1285, 63, 5, 19, 62, 35, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0),
(1286, 63, 6, 19, 47, 36, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0),
(1287, 63, 7, 11, 63, 39, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0),
(1288, 63, 8, 11, 47, 40, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0),
(1289, 63, 9, 20, 64, 35, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0),
(1290, 63, 10, 20, 58, 35, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0),
(1291, 63, 11, 68, 65, 35, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0),
(1292, 63, 12, 23, 59, 35, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0),
(1293, 63, 13, 29, 47, 43, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0),
(1294, 63, 14, 29, 31, 43, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0),
(1295, 63, 15, 67, 26, 41, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0),
(1296, 63, 16, 67, 27, 41, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0),
(1300, 32, 1, 11, 47, 35, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 0, 1),
(1301, 32, 2, 14, 59, 35, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 0, 1),
(1302, 32, 3, 14, 59, 35, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 0, 1),
(1315, 85, 1, 13, 65, 35, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0),
(1316, 85, 2, 13, 47, 36, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0),
(1317, 85, 3, 14, 61, 35, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0),
(1318, 85, 4, 14, 47, 36, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0),
(1319, 85, 5, 19, 62, 35, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0),
(1320, 85, 6, 19, 47, 36, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0),
(1321, 85, 7, 32, 62, 35, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0),
(1322, 85, 8, 32, 47, 36, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0),
(1323, 85, 9, 11, 63, 39, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0),
(1324, 85, 10, 11, 47, 40, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0),
(1325, 85, 11, 20, 64, 35, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0),
(1326, 85, 12, 34, 63, 35, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0),
(1327, 85, 13, 100, 59, 35, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0),
(1328, 85, 14, 29, 47, 43, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0),
(1329, 85, 15, 29, 31, 43, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0),
(1330, 85, 16, 67, 26, 41, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0),
(1331, 85, 17, 67, 27, 41, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0),
(1362, 86, 1, 13, 65, 35, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0),
(1363, 86, 2, 13, 47, 36, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0),
(1364, 86, 3, 14, 61, 35, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0),
(1365, 86, 4, 14, 47, 36, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0),
(1366, 86, 5, 19, 62, 35, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0),
(1367, 86, 6, 19, 47, 36, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0),
(1368, 86, 7, 11, 63, 39, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0),
(1369, 86, 8, 11, 47, 40, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0),
(1370, 86, 9, 20, 62, 35, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0),
(1371, 86, 10, 20, 58, 35, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0),
(1372, 86, 11, 22, 59, 35, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0),
(1373, 86, 12, 29, 47, 43, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0),
(1374, 86, 13, 29, 31, 43, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0),
(1375, 86, 14, 67, 26, 41, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0),
(1376, 86, 15, 67, 27, 41, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0),
(1377, 87, 1, 13, 65, 35, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0),
(1378, 87, 2, 13, 47, 36, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0),
(1379, 87, 3, 14, 61, 35, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0),
(1380, 87, 4, 14, 47, 36, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0),
(1381, 87, 5, 13, 80, 36, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0),
(1382, 87, 6, 14, 80, 36, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0),
(1383, 88, 1, 72, 65, 37, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0),
(1384, 88, 2, 72, 47, 38, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0),
(1385, 88, 3, 73, 83, 37, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0),
(1386, 88, 4, 73, 47, 38, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0),
(1387, 88, 5, 75, 84, 37, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0),
(1388, 88, 6, 75, 47, 38, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0),
(1389, 88, 7, 76, 47, 40, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0),
(1390, 88, 8, 77, 86, 37, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0),
(1391, 88, 9, 77, 79, 38, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0),
(1392, 88, 10, 74, 87, 37, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0),
(1393, 88, 11, 74, 47, 38, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0),
(1394, 88, 12, 88, 47, 43, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0),
(1395, 88, 13, 88, 31, 43, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0),
(1396, 88, 14, 77, 26, 41, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0),
(1397, 88, 15, 77, 27, 41, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0),
(1398, 88, 16, 95, 65, 43, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0),
(1399, 88, 17, 95, 31, 43, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0),
(1400, 89, 1, 72, 65, 37, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0),
(1401, 89, 2, 72, 47, 38, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0),
(1402, 89, 3, 73, 83, 37, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0),
(1403, 89, 4, 73, 47, 38, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0),
(1404, 89, 5, 75, 84, 37, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0),
(1405, 89, 6, 75, 47, 38, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0),
(1406, 89, 7, 76, 47, 40, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0),
(1407, 89, 8, 89, 84, 37, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0),
(1408, 89, 9, 89, 47, 38, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0),
(1409, 89, 10, 90, 47, 40, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0),
(1410, 89, 11, 77, 86, 37, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0),
(1411, 89, 12, 77, 79, 38, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0),
(1412, 89, 13, 88, 47, 43, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0),
(1413, 89, 14, 88, 31, 43, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0),
(1414, 89, 15, 77, 26, 41, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0),
(1415, 89, 16, 77, 27, 41, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0),
(1416, 90, 1, 96, 65, 37, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0),
(1417, 90, 2, 96, 47, 38, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0),
(1418, 90, 3, 98, 84, 35, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0),
(1419, 90, 4, 98, 47, 36, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0),
(1420, 90, 5, 99, 62, 35, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0),
(1421, 90, 6, 97, 66, 37, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0),
(1422, 90, 7, 97, 79, 38, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0),
(1423, 90, 8, 29, 47, 43, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0),
(1424, 90, 9, 99, 94, 41, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0),
(1425, 90, 10, 97, 94, 41, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0),
(1426, 90, 11, 99, 27, 41, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0),
(1427, 90, 12, 97, 27, 41, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0);

-- --------------------------------------------------------

--
-- 表的结构 `flow_answers_other`
--

CREATE TABLE IF NOT EXISTS `flow_answers_other` (
  `answers_other_id` bigint(20) NOT NULL AUTO_INCREMENT COMMENT '答案选项id',
  `answers_is_add` tinyint(1) NOT NULL COMMENT '是否为附加题答案',
  `answers_other_question_id` bigint(20) NOT NULL COMMENT '答案选项所对应的题目id',
  `answers_other_description` text COLLATE utf8_unicode_ci NOT NULL COMMENT '答案选项描述',
  `answers_other_explanation` text COLLATE utf8_unicode_ci COMMENT '答案选项注释',
  `answers_other_isright` tinyint(1) NOT NULL COMMENT '答案选项是否正确',
  `answers_other_enabled` tinyint(1) NOT NULL DEFAULT '1' COMMENT '答案选项是否可用',
  PRIMARY KEY (`answers_other_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='存储非流程题的题目答案选项' AUTO_INCREMENT=51 ;

--
-- 转存表中的数据 `flow_answers_other`
--

INSERT INTO `flow_answers_other` (`answers_other_id`, `answers_is_add`, `answers_other_question_id`, `answers_other_description`, `answers_other_explanation`, `answers_other_isright`, `answers_other_enabled`) VALUES
(1, 0, 1, 'A答案A答案A答案A答案', NULL, 1, 1),
(2, 1, 22, '我的爱，海阔天空', NULL, 0, 1),
(3, 1, 22, '第一个问附加题的论证', NULL, 1, 1),
(4, 0, 1, '选项2', NULL, 0, 1),
(5, 0, 1, '选项4', NULL, 0, 1),
(6, 0, 1, '选项3', NULL, 0, 1),
(7, 0, 3, '海阔天空', NULL, 1, 1),
(8, 0, 3, '天涯海角', NULL, 0, 1),
(9, 0, 3, '东西南北', NULL, 1, 1),
(10, 0, 3, '天天看书', NULL, 0, 1),
(11, 0, 4, '东方神起', NULL, 0, 1),
(12, 0, 4, '撒旦的订单', NULL, 0, 1),
(13, 0, 2, '东方神起D大调', NULL, 1, 1),
(14, 0, 2, '得分的道德', NULL, 0, 1),
(15, 0, 2, '得分的道德', NULL, 0, 1),
(16, 0, 2, '得分的道德', NULL, 0, 1),
(19, 0, 4, '撒旦的订单', NULL, 0, 1),
(20, 0, 4, '撒旦的订单', NULL, 0, 1),
(21, 1, 22, '我的爱，海阔天空我的爱，海阔天空', NULL, 1, 1),
(22, 1, 22, '题的题目答案选项', NULL, 0, 1),
(23, 1, 23, '天天看书', NULL, 0, 1),
(24, 1, 23, '天天打架', NULL, 1, 1),
(25, 1, 23, '天天打架', NULL, 1, 1),
(26, 1, 23, '天天痴呆', NULL, 0, 1),
(27, 1, 25, '看书天天', NULL, 0, 1),
(28, 1, 25, '阿道夫', NULL, 1, 1),
(29, 1, 25, '淡淡道', NULL, 0, 1),
(30, 1, 25, '文文强D大调多大', NULL, 1, 1),
(31, 1, 26, 'A			', NULL, 1, 1),
(32, 1, 26, 'B', NULL, 0, 1),
(33, 1, 26, 'C', NULL, 0, 1),
(34, 1, 26, 'D', NULL, 0, 1),
(35, 1, 27, 'A  			', NULL, 1, 1),
(36, 1, 27, 'B', NULL, 0, 1),
(37, 1, 27, 'C', NULL, 0, 1),
(38, 1, 27, 'D', NULL, 0, 1),
(39, 1, 28, 'A		  			', NULL, 0, 1),
(40, 1, 28, 'C', NULL, 0, 1),
(41, 1, 28, 'C', NULL, 1, 1),
(42, 1, 28, 'D', NULL, 0, 1),
(43, 1, 29, 'A', NULL, 1, 1),
(44, 1, 29, 'B', NULL, 0, 1),
(45, 1, 29, 'C', NULL, 0, 1),
(46, 1, 29, 'D', NULL, 0, 1),
(47, 1, 30, 'A 			', NULL, 1, 1),
(48, 1, 30, 'B', NULL, 0, 1),
(49, 1, 30, 'D', NULL, 0, 1),
(50, 1, 30, 'C', NULL, 0, 1);

-- --------------------------------------------------------

--
-- 表的结构 `flow_class`
--

CREATE TABLE IF NOT EXISTS `flow_class` (
  `class_id` int(11) NOT NULL AUTO_INCREMENT COMMENT '班级id',
  `class_name` varchar(16) NOT NULL COMMENT '班级名字',
  PRIMARY KEY (`class_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=47 ;

--
-- 转存表中的数据 `flow_class`
--

INSERT INTO `flow_class` (`class_id`, `class_name`) VALUES
(3, '金工1201'),
(4, '金工1202'),
(5, '全金融1201'),
(6, '金融1201'),
(7, '电商1201'),
(8, '电商1202'),
(9, '金融1204'),
(10, '金融1205'),
(11, '税务1201'),
(12, '税务1202'),
(13, '保险1201'),
(14, '保险1202'),
(15, '经济1201'),
(16, '经济1202'),
(17, '税务1203'),
(18, '会计1201'),
(19, '会计1202'),
(20, '物流1201'),
(21, '物流1202'),
(22, '会计1203'),
(23, '会计1204'),
(24, '物流1203'),
(25, '全人管1201'),
(26, '工管1201'),
(27, '全营销1201'),
(28, '全营销1202'),
(29, '会计创新1201'),
(30, '工管1202'),
(31, '国商1201'),
(32, '国商1202'),
(33, '商务英语1201'),
(34, '商务英语1202'),
(35, '商务英语1203'),
(36, '商务英语1204'),
(37, '商务英语1205'),
(38, '商务英语1206'),
(39, '商务英语1207'),
(40, '商务英语1208'),
(41, '商务英语1209'),
(42, '商务英语1210'),
(43, '商务英语1211'),
(44, '商务英语1212'),
(45, '商务英语创新1201'),
(46, '商务英语创新1202');

-- --------------------------------------------------------

--
-- 表的结构 `flow_exam`
--

CREATE TABLE IF NOT EXISTS `flow_exam` (
  `exam_id` bigint(20) NOT NULL AUTO_INCREMENT COMMENT '考试id',
  `exam_module_id` bigint(20) unsigned NOT NULL COMMENT '考试科目(module)id',
  `test_id` bigint(20) NOT NULL COMMENT '测验id',
  `exam_begin_time` datetime NOT NULL COMMENT '开始时间',
  `exam_end_time` datetime NOT NULL COMMENT '结束时间',
  `exam_duration_time` smallint(10) NOT NULL COMMENT '考试时长',
  `exam_announce_score_time` datetime NOT NULL COMMENT '成绩公布时间',
  `exam_where` smallint(10) NOT NULL COMMENT '考场数量',
  `judge_strategy_id` bigint(20) NOT NULL COMMENT '判卷策略id',
  `exam_name` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '考试名字',
  `exam_mode` int(10) NOT NULL COMMENT '考试模式 1是考试 2为课堂练习',
  PRIMARY KEY (`exam_id`),
  UNIQUE KEY `exam_name` (`exam_name`),
  KEY `test_id` (`test_id`),
  KEY `judge_strategy_id` (`judge_strategy_id`),
  KEY `exam_module_id` (`exam_module_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='存储考试管理信息' AUTO_INCREMENT=5 ;

--
-- 转存表中的数据 `flow_exam`
--

INSERT INTO `flow_exam` (`exam_id`, `exam_module_id`, `test_id`, `exam_begin_time`, `exam_end_time`, `exam_duration_time`, `exam_announce_score_time`, `exam_where`, `judge_strategy_id`, `exam_name`, `exam_mode`) VALUES
(3, 1, 3, '2015-07-02 10:41:00', '2015-07-09 10:41:00', 10, '2015-07-25 10:41:00', 1, 1, '教材练习-采购和销售', 1),
(4, 1, 4, '2015-07-10 08:00:00', '2015-07-11 12:00:00', 240, '2015-07-11 12:30:00', 1, 1, '第一次正式考试0710上', 1);

-- --------------------------------------------------------

--
-- 表的结构 `flow_examination_log`
--

CREATE TABLE IF NOT EXISTS `flow_examination_log` (
  `examination_log_id` bigint(20) NOT NULL AUTO_INCREMENT COMMENT '考生考试记录id',
  `users_id` bigint(20) unsigned NOT NULL COMMENT '考生id',
  `exam_id` bigint(20) NOT NULL COMMENT '考试id',
  `papers_id` bigint(20) NOT NULL COMMENT '试卷id',
  `users_ip` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT '考生ip',
  `is_end` tinyint(1) NOT NULL DEFAULT '0' COMMENT '是否结束考试',
  PRIMARY KEY (`examination_log_id`),
  KEY `users_id` (`users_id`),
  KEY `exam_id` (`exam_id`),
  KEY `papers_id` (`papers_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='考场记录表' AUTO_INCREMENT=324 ;

--
-- 转存表中的数据 `flow_examination_log`
--

INSERT INTO `flow_examination_log` (`examination_log_id`, `users_id`, `exam_id`, `papers_id`, `users_ip`, `is_end`) VALUES
(322, 2, 4, 10, '192.168.248.22', 0),
(323, 8, 4, 10, '202.116.204.199', 0);

-- --------------------------------------------------------

--
-- 表的结构 `flow_examination_log_oncourse`
--

CREATE TABLE IF NOT EXISTS `flow_examination_log_oncourse` (
  `examination_log_id` bigint(20) NOT NULL AUTO_INCREMENT COMMENT '考生考试记录id',
  `users_id` bigint(20) unsigned NOT NULL COMMENT '考生id',
  `exam_id` bigint(20) NOT NULL COMMENT '考试id',
  `papers_id` bigint(20) NOT NULL COMMENT '试卷id',
  `users_ip` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT '考生ip',
  `is_end` tinyint(1) NOT NULL DEFAULT '0' COMMENT '是否结束考试',
  PRIMARY KEY (`examination_log_id`),
  KEY `users_id` (`users_id`),
  KEY `exam_id` (`exam_id`),
  KEY `papers_id` (`papers_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='考场记录表' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `flow_examlog_useransw`
--

CREATE TABLE IF NOT EXISTS `flow_examlog_useransw` (
  `examlog_useransw_id` bigint(20) NOT NULL AUTO_INCREMENT COMMENT '流程题考生答案记录id',
  `examination_log_id` bigint(20) NOT NULL COMMENT '考生考试记录id',
  `papers_question_id` bigint(20) NOT NULL COMMENT '考卷试题id',
  `usersansw_steps_id` bigint(20) NOT NULL COMMENT '考生答案步骤id',
  `usersansw_steps_option1` bigint(20) DEFAULT NULL COMMENT '考生答案步骤选项1编号',
  `usersansw_steps_option2` bigint(20) DEFAULT NULL COMMENT '考生答案步骤选项2编号',
  `usersansw_steps_option3` bigint(20) DEFAULT NULL COMMENT '考生答案步骤选项3编号',
  `usersansw_steps_option4` bigint(20) DEFAULT NULL COMMENT '考生答案步骤选项4编号',
  `usersansw_steps_option5` bigint(20) DEFAULT NULL COMMENT '考生答案步骤选项5编号',
  `usersansw_steps_option6` bigint(20) DEFAULT NULL COMMENT '考生答案步骤选项6编号',
  `usersansw_steps_option7` bigint(20) DEFAULT NULL COMMENT '考生答案步骤选项7编号',
  `usersansw_steps_option8` bigint(20) DEFAULT NULL COMMENT '考生答案步骤选项8编号',
  `usersansw_steps_option9` bigint(20) DEFAULT NULL COMMENT '考生答案步骤选项9编号',
  `usersansw_steps_option10` bigint(20) DEFAULT NULL COMMENT '考生答案步骤选项10编号',
  PRIMARY KEY (`examlog_useransw_id`),
  KEY `examination_log_id` (`examination_log_id`),
  KEY `usersansw_steps_option1` (`usersansw_steps_option1`),
  KEY `usersansw_steps_option2` (`usersansw_steps_option2`),
  KEY `usersansw_steps_option3` (`usersansw_steps_option3`),
  KEY `usersansw_steps_option4` (`usersansw_steps_option4`),
  KEY `usersansw_steps_option5` (`usersansw_steps_option5`),
  KEY `usersansw_steps_option6` (`usersansw_steps_option6`),
  KEY `usersansw_steps_option7` (`usersansw_steps_option7`),
  KEY `usersansw_steps_option8` (`usersansw_steps_option8`),
  KEY `usersansw_steps_option10` (`usersansw_steps_option10`),
  KEY `usersansw_steps_option9` (`usersansw_steps_option9`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='用于存储流程题考生答案' AUTO_INCREMENT=20707 ;

--
-- 转存表中的数据 `flow_examlog_useransw`
--

INSERT INTO `flow_examlog_useransw` (`examlog_useransw_id`, `examination_log_id`, `papers_question_id`, `usersansw_steps_id`, `usersansw_steps_option1`, `usersansw_steps_option2`, `usersansw_steps_option3`, `usersansw_steps_option4`, `usersansw_steps_option5`, `usersansw_steps_option6`, `usersansw_steps_option7`, `usersansw_steps_option8`, `usersansw_steps_option9`, `usersansw_steps_option10`) VALUES
(20700, 322, 1, 1, 100, 58, 35, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(20701, 322, 1, 2, 100, 58, 35, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(20702, 322, 1, 3, 100, 58, 35, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(20703, 322, 2, 1, 25, 58, 35, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(20704, 322, 2, 2, 25, 58, 35, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(20705, 322, 2, 3, 25, 58, 35, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(20706, 322, 2, 4, 25, 58, 35, NULL, NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- 表的结构 `flow_examlog_useransw_add`
--

CREATE TABLE IF NOT EXISTS `flow_examlog_useransw_add` (
  `examination_log_id` bigint(20) NOT NULL,
  `paperquestions_id` bigint(20) NOT NULL,
  `questions_add_id` bigint(20) NOT NULL,
  `useransw_id` bigint(20) NOT NULL,
  `examlog_score` decimal(10,3) NOT NULL,
  PRIMARY KEY (`examination_log_id`,`paperquestions_id`,`questions_add_id`,`useransw_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='附加题考生答案记录';

--
-- 转存表中的数据 `flow_examlog_useransw_add`
--

INSERT INTO `flow_examlog_useransw_add` (`examination_log_id`, `paperquestions_id`, `questions_add_id`, `useransw_id`, `examlog_score`) VALUES
(96, 7, 22, 3, '0.000'),
(96, 7, 23, 23, '0.000'),
(96, 7, 23, 24, '0.000'),
(96, 7, 23, 25, '0.000'),
(96, 7, 23, 26, '0.000'),
(96, 7, 25, 28, '0.000'),
(101, 1, 22, 22, '0.000'),
(101, 1, 25, 27, '0.000'),
(101, 2, 26, 33, '0.000'),
(101, 3, 27, 37, '0.000'),
(101, 4, 28, 40, '0.000'),
(101, 5, 30, 49, '0.000'),
(104, 1, 22, 21, '0.000'),
(104, 1, 25, 28, '0.000'),
(172, 3, 27, 36, '0.000');

-- --------------------------------------------------------

--
-- 表的结构 `flow_examlog_useransw_concept`
--

CREATE TABLE IF NOT EXISTS `flow_examlog_useransw_concept` (
  `examination_log_id` bigint(20) NOT NULL COMMENT '考生考试记录id',
  `paperquestions_id` bigint(20) NOT NULL COMMENT '非流程题目id',
  `useransw_id` bigint(20) NOT NULL COMMENT '考生所选答案选项id',
  `examlog_score` decimal(10,3) DEFAULT NULL COMMENT '得分',
  PRIMARY KEY (`examination_log_id`,`paperquestions_id`,`useransw_id`),
  KEY `useransw_id` (`useransw_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='理论题考生答案记录';

-- --------------------------------------------------------

--
-- 表的结构 `flow_examlog_useransw_oncourse`
--

CREATE TABLE IF NOT EXISTS `flow_examlog_useransw_oncourse` (
  `examlog_useransw_id` bigint(20) NOT NULL AUTO_INCREMENT COMMENT '流程题考生答案记录id',
  `examination_log_id` bigint(20) NOT NULL COMMENT '考生考试记录id',
  `repeat_id` int(11) NOT NULL COMMENT '考生重复考试的次数',
  `papers_question_id` bigint(20) NOT NULL COMMENT '考卷试题id',
  `usersansw_steps_id` bigint(20) NOT NULL COMMENT '考生答案步骤id',
  `usersansw_steps_option1` bigint(20) DEFAULT NULL COMMENT '考生答案步骤选项1编号',
  `usersansw_steps_option2` bigint(20) DEFAULT NULL COMMENT '考生答案步骤选项2编号',
  `usersansw_steps_option3` bigint(20) DEFAULT NULL COMMENT '考生答案步骤选项3编号',
  `usersansw_steps_option4` bigint(20) DEFAULT NULL COMMENT '考生答案步骤选项4编号',
  `usersansw_steps_option5` bigint(20) DEFAULT NULL COMMENT '考生答案步骤选项5编号',
  `usersansw_steps_option6` bigint(20) DEFAULT NULL COMMENT '考生答案步骤选项6编号',
  `usersansw_steps_option7` bigint(20) DEFAULT NULL COMMENT '考生答案步骤选项7编号',
  `usersansw_steps_option8` bigint(20) DEFAULT NULL COMMENT '考生答案步骤选项8编号',
  `usersansw_steps_option9` bigint(20) DEFAULT NULL COMMENT '考生答案步骤选项9编号',
  `usersansw_steps_option10` bigint(20) DEFAULT NULL COMMENT '考生答案步骤选项10编号',
  PRIMARY KEY (`examlog_useransw_id`),
  KEY `examination_log_id` (`examination_log_id`),
  KEY `usersansw_steps_option1` (`usersansw_steps_option1`),
  KEY `usersansw_steps_option2` (`usersansw_steps_option2`),
  KEY `usersansw_steps_option3` (`usersansw_steps_option3`),
  KEY `usersansw_steps_option4` (`usersansw_steps_option4`),
  KEY `usersansw_steps_option5` (`usersansw_steps_option5`),
  KEY `usersansw_steps_option6` (`usersansw_steps_option6`),
  KEY `usersansw_steps_option7` (`usersansw_steps_option7`),
  KEY `usersansw_steps_option8` (`usersansw_steps_option8`),
  KEY `usersansw_steps_option10` (`usersansw_steps_option10`),
  KEY `usersansw_steps_option9` (`usersansw_steps_option9`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='用于存储流程题考生答案' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `flow_exam_grade`
--

CREATE TABLE IF NOT EXISTS `flow_exam_grade` (
  `examination_log_id` bigint(20) NOT NULL,
  `grade` decimal(10,3) NOT NULL,
  PRIMARY KEY (`examination_log_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='总分表';

-- --------------------------------------------------------

--
-- 表的结构 `flow_exam_grade_oncourse`
--

CREATE TABLE IF NOT EXISTS `flow_exam_grade_oncourse` (
  `examination_log_id` bigint(20) NOT NULL,
  `grade` decimal(10,3) NOT NULL,
  PRIMARY KEY (`examination_log_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='总分表';

-- --------------------------------------------------------

--
-- 表的结构 `flow_exam_judge`
--

CREATE TABLE IF NOT EXISTS `flow_exam_judge` (
  `examlog_useransw_id` bigint(20) NOT NULL COMMENT '考生答案记录id',
  `match_branch_id` bigint(20) DEFAULT NULL COMMENT '匹配分支号',
  `match_steps_id` bigint(20) DEFAULT NULL COMMENT '匹配标准答案中的步骤编号',
  `score` decimal(10,3) NOT NULL COMMENT '判分',
  `judge` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT '判分算子',
  `judge_remark` text COLLATE utf8_unicode_ci COMMENT '备注，将当前步骤的判分处理情况以文本形式表述',
  PRIMARY KEY (`examlog_useransw_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='用于存储流程题考生答案与标准答案匹配及判分';

-- --------------------------------------------------------

--
-- 表的结构 `flow_exam_judge_oncourse`
--

CREATE TABLE IF NOT EXISTS `flow_exam_judge_oncourse` (
  `examlog_useransw_id` bigint(20) NOT NULL COMMENT '考生答案记录id',
  `repeat_id` int(30) NOT NULL COMMENT '重复id',
  `match_branch_id` bigint(20) DEFAULT NULL COMMENT '匹配分支号',
  `match_steps_id` bigint(20) DEFAULT NULL COMMENT '匹配标准答案中的步骤编号',
  `score` decimal(10,3) NOT NULL COMMENT '判分',
  `judge` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT '判分算子',
  `judge_remark` text COLLATE utf8_unicode_ci COMMENT '备注，将当前步骤的判分处理情况以文本形式表述',
  PRIMARY KEY (`examlog_useransw_id`,`repeat_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='用于存储流程题考生答案与标准答案匹配及判分';

-- --------------------------------------------------------

--
-- 表的结构 `flow_exam_paper`
--

CREATE TABLE IF NOT EXISTS `flow_exam_paper` (
  `paper_id` bigint(20) NOT NULL COMMENT '试卷id',
  `exam_id` bigint(20) NOT NULL COMMENT '考试id',
  PRIMARY KEY (`paper_id`,`exam_id`),
  KEY `exam_id` (`exam_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='存储试卷考试关联信息';

--
-- 转存表中的数据 `flow_exam_paper`
--

INSERT INTO `flow_exam_paper` (`paper_id`, `exam_id`) VALUES
(8, 3),
(10, 4);

-- --------------------------------------------------------

--
-- 表的结构 `flow_exam_result`
--

CREATE TABLE IF NOT EXISTS `flow_exam_result` (
  `users_id` bigint(20) unsigned NOT NULL COMMENT '考生id',
  `exam_id` bigint(20) NOT NULL COMMENT '考试id',
  `papers_id` bigint(20) NOT NULL COMMENT '考卷id',
  `papers_question_id` bigint(20) NOT NULL COMMENT '考卷试题id',
  `score` decimal(10,3) NOT NULL COMMENT '得分',
  `result_remark` text COLLATE utf8_unicode_ci COMMENT '备注，用文字表述判分计算式子',
  PRIMARY KEY (`users_id`,`exam_id`,`papers_id`,`papers_question_id`),
  KEY `exam_id` (`exam_id`),
  KEY `papers_id` (`papers_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='用于存储每道题考试结果';

--
-- 转存表中的数据 `flow_exam_result`
--

INSERT INTO `flow_exam_result` (`users_id`, `exam_id`, `papers_id`, `papers_question_id`, `score`, `result_remark`) VALUES
(2, 3, 8, 1, '0.000', '考生答案序列u_step:1、2,匹配到标准答案序列s_step:9、9。得分序列:。正确步骤应得分为：0分。该题总得分为：0'),
(2, 3, 8, 2, '0.000', '考生答案序列u_step:1、2、3、4,匹配到标准答案序列s_step:23、23、23、23。得分序列:。正确步骤应得分为：0分。该题总得分为：0'),
(2, 3, 8, 13, '0.000', '考生答案序列u_step:1、2,匹配到标准答案序列s_step:19、19。得分序列:。正确步骤应得分为：0分。该题总得分为：0'),
(2, 3, 8, 14, '0.000', '考生答案序列u_step:1、2、3,匹配到标准答案序列s_step:12、12、12。得分序列:。正确步骤应得分为：0分。该题总得分为：0'),
(8, 3, 8, 2, '4.933', '考生答案序列u_step:1、2、3、4、5、6、7、8、9、10、11、12、13、14、15、16,匹配到标准答案序列s_step:1、2、3、4、5、6、7、8、9、10、11、12、13、14、15、16。得分序列:1、2、3、4、5、6、7、8、9、10、11、12、13、14、15、16。正确步骤应得分为：4.9333333333333分。考生答案第1步u_step(1)匹配到标准答案第1步s_step(1)，得分为：0.30833333333333分。考生答案第2步u_step(2)匹配到标准答案第2步s_step(2)，得分为：0.30833333333333分。考生答案第3步u_step(3)匹配到标准答案第3步s_step(3)，得分为：0.30833333333333分。考生答案第4步u_step(4)匹配到标准答案第4步s_step(4)，得分为：0.30833333333333分。考生答案第5步u_step(5)匹配到标准答案第5步s_step(5)，得分为：0.30833333333333分。考生答案第6步u_step(6)匹配到标准答案第6步s_step(6)，得分为：0.30833333333333分。考生答案第7步u_step(7)匹配到标准答案第7步s_step(7)，得分为：0.30833333333333分。考生答案第8步u_step(8)匹配到标准答案第8步s_step(8)，得分为：0.30833333333333分。考生答案第9步u_step(9)匹配到标准答案第9步s_step(9)，得分为：0.30833333333333分。考生答案第10步u_step(10)匹配到标准答案第10步s_step(10)，得分为：0.30833333333333分。考生答案第11步u_step(11)匹配到标准答案第11步s_step(11)，得分为：0.30833333333333分。考生答案第12步u_step(12)匹配到标准答案第12步s_step(12)，得分为：0.30833333333333分。考生答案第13步u_step(13)匹配到标准答案第13步s_step(13)，得分为：0.30833333333333分。考生答案第14步u_step(14)匹配到标准答案第14步s_step(14)，得分为：0.30833333333333分。考生答案第15步u_step(15)匹配到标准答案第15步s_step(15)，得分为：0.30833333333333分。考生答案第16步u_step(16)匹配到标准答案第16步s_step(16)，得分为：0.30833333333333分。该题总得分为：4.9333333333333'),
(8, 3, 8, 6, '0.208', '考生答案序列u_step:1,匹配到标准答案序列s_step:1。得分序列:1。正确步骤应得分为：0.208375分。考生答案第1步u_step(1)匹配到标准答案第1步s_step(1)，得分为：0.208375分。该题总得分为：0.208375');

-- --------------------------------------------------------

--
-- 表的结构 `flow_exam_result_oncourse`
--

CREATE TABLE IF NOT EXISTS `flow_exam_result_oncourse` (
  `users_id` bigint(20) unsigned NOT NULL COMMENT '考生id',
  `exam_id` bigint(20) NOT NULL COMMENT '考试id',
  `papers_id` bigint(20) NOT NULL COMMENT '考卷id',
  `papers_question_id` bigint(20) NOT NULL COMMENT '考卷试题id',
  `score` decimal(10,3) NOT NULL COMMENT '得分',
  `result_remark` text COLLATE utf8_unicode_ci COMMENT '备注，用文字表述判分计算式子',
  PRIMARY KEY (`users_id`,`exam_id`,`papers_id`,`papers_question_id`),
  KEY `exam_id` (`exam_id`),
  KEY `papers_id` (`papers_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='用于存储每道题考试结果';

-- --------------------------------------------------------

--
-- 表的结构 `flow_exam_usergroups`
--

CREATE TABLE IF NOT EXISTS `flow_exam_usergroups` (
  `usergroups_id` bigint(20) unsigned NOT NULL COMMENT '考生组id',
  `exam_id` bigint(20) NOT NULL COMMENT '考试id',
  PRIMARY KEY (`usergroups_id`,`exam_id`),
  KEY `exam_id` (`exam_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='用于关联考生组与考试的相关信息';

--
-- 转存表中的数据 `flow_exam_usergroups`
--

INSERT INTO `flow_exam_usergroups` (`usergroups_id`, `exam_id`) VALUES
(3, 3),
(3, 4);

-- --------------------------------------------------------

--
-- 表的结构 `flow_judge_error`
--

CREATE TABLE IF NOT EXISTS `flow_judge_error` (
  `error_id` bigint(20) NOT NULL AUTO_INCREMENT COMMENT '异常id',
  `exam_id` bigint(20) NOT NULL COMMENT '考试id',
  `papers_id` bigint(20) NOT NULL COMMENT '试卷id',
  `questions_id` bigint(20) NOT NULL COMMENT '题目id',
  `questions_type` smallint(5) NOT NULL COMMENT '题目类型（流程题、理论题、附加题）',
  `student_id` bigint(20) unsigned NOT NULL COMMENT '考生id',
  `teacher_id` bigint(20) unsigned NOT NULL COMMENT '创建该题用户id',
  `is_solve` tinyint(1) NOT NULL DEFAULT '0' COMMENT '是否已处理',
  `solve_time` datetime DEFAULT NULL COMMENT '处理时间',
  `solve_remark` text COLLATE utf8_unicode_ci COMMENT '处理情况',
  PRIMARY KEY (`error_id`),
  KEY `exam_id` (`exam_id`),
  KEY `papers_id` (`papers_id`),
  KEY `student_id` (`student_id`),
  KEY `teacher_id` (`teacher_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='判卷异常表' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `flow_judge_strategy`
--

CREATE TABLE IF NOT EXISTS `flow_judge_strategy` (
  `judge_strategy_id` bigint(20) NOT NULL AUTO_INCREMENT COMMENT '判卷策略id',
  `logic_deduct` decimal(10,3) NOT NULL COMMENT '逻辑扣分比例',
  `branch_control` smallint(5) NOT NULL COMMENT '分支监控情况，取值1、2、3…',
  `extra_steps_control` tinyint(1) NOT NULL COMMENT '多余步骤扣分策略，取值1不扣分，取值2首尾出现多余步骤扣逻辑分',
  `score_step_add` decimal(10,3) NOT NULL COMMENT '步骤中步骤分与附加题分比值',
  PRIMARY KEY (`judge_strategy_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='用于存储判分策略' AUTO_INCREMENT=2 ;

--
-- 转存表中的数据 `flow_judge_strategy`
--

INSERT INTO `flow_judge_strategy` (`judge_strategy_id`, `logic_deduct`, `branch_control`, `extra_steps_control`, `score_step_add`) VALUES
(1, '0.050', 1, 1, '1.000');

-- --------------------------------------------------------

--
-- 表的结构 `flow_makepapers_strategys`
--

CREATE TABLE IF NOT EXISTS `flow_makepapers_strategys` (
  `mps_item_id` bigint(20) NOT NULL AUTO_INCREMENT COMMENT '组卷策略条目id',
  `mpstrategy_id` bigint(20) NOT NULL COMMENT '组卷策略id',
  `subject_id` bigint(20) unsigned NOT NULL COMMENT '主题/章节(subject)的id',
  `subject_flow_num` smallint(10) NOT NULL COMMENT '该章节选择的流程题数量',
  `subject_concept_num` smallint(10) NOT NULL COMMENT '该章节选择的理论题数量',
  `subject_flow_difficulty` smallint(5) NOT NULL COMMENT '该章节选择的流程题难度',
  `subject_concept_difficulty` smallint(5) NOT NULL COMMENT '该章节选择的理论题难度',
  `subject_flow_score` decimal(10,3) NOT NULL COMMENT '该章节选择的流程题分值比例',
  `subject_concept_score` decimal(10,3) NOT NULL COMMENT '该章节选择的理论题分值比例',
  `subject_question_select_order` tinyint(1) NOT NULL COMMENT '题目挑选顺序是否为随机',
  `subject_selectoptions_order` tinyint(1) NOT NULL COMMENT '选择题选项顺序是否为随机',
  PRIMARY KEY (`mps_item_id`),
  KEY `subject_id` (`subject_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='用于存储组卷策略' AUTO_INCREMENT=44 ;

--
-- 转存表中的数据 `flow_makepapers_strategys`
--

INSERT INTO `flow_makepapers_strategys` (`mps_item_id`, `mpstrategy_id`, `subject_id`, `subject_flow_num`, `subject_concept_num`, `subject_flow_difficulty`, `subject_concept_difficulty`, `subject_flow_score`, `subject_concept_score`, `subject_question_select_order`, `subject_selectoptions_order`) VALUES
(2, 0, 6, 5, 0, 1, 9, '20.000', '10.000', 1, 1),
(5, 1, 18, 2, 2, 3, 4, '10.000', '10.000', 1, 1),
(6, 1, 6, 3, 3, 3, 4, '10.000', '10.000', 1, 1),
(33, 2, 19, 3, 0, 1, 1, '20.000', '10.000', 1, 1),
(34, 2, 20, 2, 0, 1, 1, '20.000', '10.000', 1, 1),
(35, 3, 6, 1, 1, 1, 1, '25.000', '25.000', 0, 0),
(36, 3, 6, 1, 1, 1, 1, '25.000', '25.000', 0, 0),
(37, 4, 19, 3, 0, 1, 1, '5.550', '10.000', 1, 1),
(38, 4, 20, 2, 0, 1, 1, '8.335', '10.000', 1, 1),
(39, 4, 21, 5, 0, 1, 1, '3.334', '10.000', 1, 1),
(40, 4, 22, 6, 0, 1, 1, '2.778', '10.000', 1, 1),
(41, 4, 24, 2, 0, 1, 1, '8.335', '10.000', 1, 1),
(42, 4, 23, 4, 0, 1, 1, '4.168', '10.000', 1, 1),
(43, 5, 26, 6, 0, 1, 1, '16.667', '0.000', 1, 1);

-- --------------------------------------------------------

--
-- 表的结构 `flow_paper`
--

CREATE TABLE IF NOT EXISTS `flow_paper` (
  `paper_id` bigint(20) NOT NULL AUTO_INCREMENT COMMENT '试卷id',
  `test_id` bigint(20) NOT NULL COMMENT '测验id',
  `mpstrategy_id` bigint(20) NOT NULL COMMENT '组卷策略id',
  PRIMARY KEY (`paper_id`),
  KEY `test_id` (`test_id`),
  KEY `mpstrategy_id` (`mpstrategy_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='存储试卷信息' AUTO_INCREMENT=11 ;

--
-- 转存表中的数据 `flow_paper`
--

INSERT INTO `flow_paper` (`paper_id`, `test_id`, `mpstrategy_id`) VALUES
(6, 1, 0),
(7, 2, 2),
(8, 3, 4),
(10, 4, 5);

-- --------------------------------------------------------

--
-- 表的结构 `flow_papers_questions`
--

CREATE TABLE IF NOT EXISTS `flow_papers_questions` (
  `papers_id` bigint(20) NOT NULL COMMENT '该题的试卷试题id',
  `papers_questions_id` bigint(20) NOT NULL COMMENT '所属试卷id',
  `questions_id` bigint(20) NOT NULL COMMENT '流程题或概念题id',
  `is_flow` tinyint(1) NOT NULL COMMENT '是否为流程题',
  `score` decimal(10,3) NOT NULL COMMENT '试题分值',
  PRIMARY KEY (`papers_id`,`papers_questions_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='用于存储测验组成的试卷试题信息';

--
-- 转存表中的数据 `flow_papers_questions`
--

INSERT INTO `flow_papers_questions` (`papers_id`, `papers_questions_id`, `questions_id`, `is_flow`, `score`) VALUES
(0, 1, 53, 1, '23.333'),
(4, 1, 2, 0, '0.000'),
(4, 2, 4, 0, '0.000'),
(4, 3, 6, 0, '0.000'),
(4, 4, 5, 0, '0.000'),
(4, 5, 32, 1, '0.000'),
(6, 1, 32, 1, '20.000'),
(6, 2, 51, 1, '20.000'),
(6, 3, 52, 1, '20.000'),
(6, 4, 53, 1, '20.000'),
(6, 5, 54, 1, '20.000'),
(7, 1, 62, 1, '20.000'),
(7, 2, 63, 1, '20.000'),
(7, 3, 64, 1, '20.000'),
(7, 4, 65, 1, '20.000'),
(7, 5, 66, 1, '20.000'),
(8, 1, 62, 1, '5.550'),
(8, 2, 63, 1, '5.550'),
(8, 3, 64, 1, '5.550'),
(8, 4, 65, 1, '8.335'),
(8, 5, 66, 1, '8.335'),
(8, 6, 67, 1, '3.334'),
(8, 7, 68, 1, '3.334'),
(8, 8, 69, 1, '3.334'),
(8, 9, 70, 1, '3.334'),
(8, 10, 71, 1, '3.334'),
(8, 11, 72, 1, '2.778'),
(8, 12, 73, 1, '2.778'),
(8, 13, 74, 1, '2.778'),
(8, 14, 75, 1, '2.778'),
(8, 15, 76, 1, '2.778'),
(8, 16, 77, 1, '2.778'),
(8, 17, 82, 1, '8.335'),
(8, 18, 83, 1, '8.335'),
(8, 19, 78, 1, '4.168'),
(8, 20, 79, 1, '4.168'),
(8, 21, 80, 1, '4.168'),
(8, 22, 81, 1, '4.168'),
(10, 1, 85, 1, '16.667'),
(10, 2, 86, 1, '16.667'),
(10, 3, 87, 1, '16.667'),
(10, 4, 88, 1, '16.667'),
(10, 5, 89, 1, '16.667'),
(10, 6, 90, 1, '16.667');

-- --------------------------------------------------------

--
-- 表的结构 `flow_questions`
--

CREATE TABLE IF NOT EXISTS `flow_questions` (
  `flow_questions_id` bigint(20) NOT NULL AUTO_INCREMENT COMMENT '流程题目id',
  `flow_questions_subject_id` bigint(20) unsigned NOT NULL COMMENT '所属主题/章节(subject)',
  `flow_questions_description` text COLLATE utf8_unicode_ci NOT NULL COMMENT '题干',
  `flow_questions_explanation` text COLLATE utf8_unicode_ci COMMENT '注释',
  `flow_questions_difficulty` smallint(6) NOT NULL DEFAULT '1' COMMENT '难度',
  `flow_questions_enabled` tinyint(1) NOT NULL DEFAULT '1' COMMENT '是否能被使用',
  `flow_questions_user_id` bigint(20) unsigned NOT NULL COMMENT '添加该题的用户（教师）id',
  PRIMARY KEY (`flow_questions_id`),
  KEY `flow_questions_subject_id` (`flow_questions_subject_id`),
  KEY `flow_questions_user_id` (`flow_questions_user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='用于存储流程题题目相关信息' AUTO_INCREMENT=91 ;

--
-- 转存表中的数据 `flow_questions`
--

INSERT INTO `flow_questions` (`flow_questions_id`, `flow_questions_subject_id`, `flow_questions_description`, `flow_questions_explanation`, `flow_questions_difficulty`, `flow_questions_enabled`, `flow_questions_user_id`) VALUES
(32, 6, '2014年12月6日，环宇跑步鞋180对，单价140元，入运动鞋库，购自青岛环宇体育用品公司\n', '', 1, 1, 7),
(51, 6, '2014年12月8日，贝亚特公路自行车100辆，单价480，如自行车仓库，木器公司自温州贝亚特公路自行车公司\n', NULL, 1, 1, 2),
(52, 6, '(1) 2015年1月1日，采购部提出采购订单，向深圳健步体育用品公司采购健步篮球鞋和健步足球鞋各500对，报价分别为110元/对和130元/对。当日采购部向健步体育用品公司发出订单，对方认为报价太低，经协商，双方达成成交价格为120元|对和140元|对，数量不变，同时，订货合同要求本月5日到货。1月5日，收到深圳健步体育用品公司发来的健步篮球鞋和相应增值税专用发票，发票号码JB00188，增值税率17%。经检验产品质量全部合格，办理了入库手续，财务部门确认该笔存货成本和应付款项，尚未付款。\r\n', NULL, 6, 1, 2),
(53, 6, ' 2015年1月6日，批发部提出采购请求，请求向青岛环宇体育用品公司采购环宇篮球鞋200对，报价220元|对；羽毛球1000筒，报价40元|筒。对方同意报价后，当日采购部发出订单，订货合同要求本月10日到货。1月10日，收到青岛环宇体育用品公司发来的商品和相应发票，发票号码HY00668，增值税率17%，对方代垫运费，收到运输发票一张，载明运输费用1000元，可抵扣增值税进项税，税率7%，依据签订的合同，运输费用由本公司承担暂未支付。经检验产品质量全部合格并入库，办理了入库手续的同时财务部门确认了商品入库成本，同时支付了货物的价税款项（转账支票ZZ0001）。\r\n', NULL, 3, 1, 2),
(54, 6, '(3) 2015年1月10日，采购部发出订单，向温州贝亚特自行车公司订购贝亚特休闲车100辆，单价320元|辆，订货合同要求本月15日到货。1月15日，收到温州贝亚特自行车公司发来的商品和相应发票，发票号码BYT0288，增值税率17%，同时对方代垫运杂费，附有运杂费发票一张，载明运杂费2000元，不可抵扣增值税进项税，依据签订的合同，运杂费用由本公司承担。经检验产品质量全部合格并入库，同时财务部门确认了商品入库成本，支付了运费，支付了全部货款价税合计的50%（现金支票XJ0002）。\r\n', NULL, 10, 1, 2),
(55, 18, '2015年1月12日，向青岛环宇体育用品公司订购羽毛球2000筒，单价40元|筒，订货合同要求本月18日到货。1月18日，收到青岛环宇体育用品公司发来的商品和相应发票，发票号码HY00686，增值税率17%，发票上载明羽毛球2000筒，单价40元，增值税率17%。经检验产品损坏了2筒，确认为运输途中的合理损耗。合格商品在办理了入库手续后，财务部门确认采购成本和应付款项，尚未付款。\r\n', NULL, 10, 1, 2),
(56, 18, '(2) 2015年1月15日，向珠海飞龙自行车公司订购飞龙山地车 150辆，价格 2000 元|辆，订货合同要求本月18日到货。1月18日，收到珠海飞龙自行车公司发来的商品和相应发票，发票号码 FL00688，增值税率 17%，发票上载明飞龙山地车 150 辆，单价 2000 元。入库时经检验发现损坏了 20 辆，确认为运输部门责任，运输部门同意赔偿20 辆自行车的价税款。其它商品在办理了入库手续后，财务部门确认采购成本并开出转账支票（支票号 ZZ0002）支付了相应的款项。\r\n', NULL, 10, 1, 2),
(57, 18, '2015 年 1 月 20 日，本公司向深圳健步体育用品公司订购健步足球鞋 150 对，双方协商订购价为 150 元，本公司于 23 日收到全部货物，次日验收入库时发现 10 对有质量问题，与公司家沟通后，将有质量问题的运动鞋退回，其他商品在办理了入库手续。26 日收到公司家开具的专用发票，发票号码 JB00189，发票上载明健步足球鞋 140 对，单价 150元，财务部门确认采购成本并确认了应付款项。\r\n', NULL, 10, 1, 2),
(58, 18, '2015 年 1 月 25 日，本公司向珠海飞龙自行车公司订购飞龙休闲车 300 辆，双方协商订购价为 300 元，本公司于 28 日收到全部货物，并办理了入库手续。次日，验收发现 10辆有质量问题，与公司家沟通后，将有质量问题的自行车退回，同时收到对方开具的数量为290 的专用发票，发票号码 HL00689，财务部门确认采购成本和应付款项。\r\n', NULL, 10, 1, 2),
(59, 18, '2015 年 1 月 27 日，本公司向青岛环宇体育用品公司订购环宇跑步鞋 100 对，双方协商订购价为 150 元，本公司于 29日收到全部货物和专用发票，办理了入库手续，但发票尚未结算。次日发现 10 对有质量问题，与公司家沟通后，将有质量问题的运动鞋退财务部门确认采购成本和应付款项。\r\n', NULL, 10, 1, 2),
(60, 18, '2015 年 1 月 28 日，本公司向温州贝亚特自行车公司订购贝亚特休闲车 100 辆，双方协商订购价为 300 元，本公司于 30 日收到全部货物和专用发票，办理了入库手续、发票结算手续、确认库存成本和应付款项。次日发现 15 辆有质量问题，与公司家沟通后，将有质量问题的自行车退回，并办理了相应手续和财务处理。\r\n', NULL, 10, 1, 2),
(61, 18, '2015 年 1 月 20 日，收到 2014 年 12 月 6 日暂估入库的 180 对环宇跑步鞋的专用发票，发票号 HY00689，发票上载明环宇跑步鞋 180 对，单价 150 元。财务部门确认采购成本并开出现金支票（支票号 XJ0001）支付了全部款项。\r\n', NULL, 10, 1, 2),
(62, 19, '2014年1月1日，采购部提出采购订单，向深圳健步体育用品公司采购健步篮球鞋和健步足球鞋各500对，报价分别为110元/对和130元/对。当日采购部向健步体育用品公司发出订单，对方认为报价太低，经协商，双方达成成交价格为120元/对和140元/对，数量不变，同时，订货合同要求本月5日到货。\n1月5日，收到深圳健步体育用品公司发来的健步篮球鞋和相应增值税专用发票，发票号码为JB00188，增值税率17%。经检验，产品质量全部合格，办理了入库手续，财务部门确认该笔存货成本和应付款项，尚未付款。		', NULL, 1, 1, 2),
(63, 19, '2014年1月6日，批发部提出采购请求，请求向青岛环宇体育用品厂采购环宇篮球鞋200对，报价220元/对。对方同意报价后，当日采购部发出订单，订货合同要求本月10日到货。\n1月10日，收到青岛环宇体育用品厂发来的商品和相应发票，发票号码HY00668，增值税率17%，对方代垫运费，收到运输发票一张，载明运输费用1000元，可抵扣增值税进项税，税率7%，依据签订合同，运输费用由本公司承担暂未支付。经检验，产品质量全部合格并入库，办理了入库手续的同时财务部门确认了商品入库成本，同时支付了货物的价税款项（转账支票zz0001）\n\n', NULL, 2, 1, 7),
(64, 19, '2014年1月10日，采购部发出订单，向温州贝亚特自行车厂订购贝亚特休闲车100辆，单价320元/辆，订货合同要求本月15日到货。\n1月15日，收到温州贝亚特自行车厂发来的商品和相应发票，发票号码BYT0288，增值税率17%。同时对方代垫运杂费，附有运杂费发票一张，载明运杂费2000元，不可抵扣增值税进项税，依据签订的合同，运杂费用由本公司承担。经检验产品质量全部合格并入库，同时财务部门确认了商品入库成本，支付了运费，支付了全部货款价税合计的50%（现金支票XJ0002）', NULL, 3, 1, 2),
(65, 20, '2014年1月12日，向青岛环宇体育用品厂订购羽毛球2000筒，单价40元/筒，订货合同要求本月18日到货。\n1月18日，收到青岛环宇体育用品厂发来的商品和相应发票，发票号码HY00686，增值税率17%，发票上载明羽毛球2000筒，单价40元，增值税率17%。经检验产品损坏2筒，确认为运输途中的合理损耗。合格商品在办理了入库手续后，财务部门确认采购成本和应付款项，尚未付款。			', NULL, 2, 1, 2),
(66, 20, '2014年1月15日，向珠海飞龙自行车厂订购飞龙山地车150辆，价格2000元/辆，订货合同要求本月18日到货。\n1月18日，收到珠海飞龙自行车厂发来的商品和相应发票，发票号码FL00688，增值税率17%，发票上载明飞龙山地车150辆，单价2000元。入库时经检验发现损坏了20辆，确认为运输部门责任，运输部门同意赔偿20辆自行车的价税款。其他商品在办理了入库手续后，财务部门确认采购成本并开出转账支票（支票号ZZ0002）支付了相应的款项。\n', NULL, 4, 1, 2),
(67, 21, '2014年1月20日，本公司向深圳健步体育用品公司订购健步足球鞋15箱（150对），双方协商订购价为1500元/箱，本公司于23日收到全部货物，次日验收入库时发现10对有质量问题，与公司沟通后，将有质量问题的运动鞋退回，其他商品办理了入库手续。26日收到公司开具的专用发票，发票号码为JB00189，发票上载明健步足球鞋140对，单价150元，财务部门确认采购成本并确认了应付款项。						', NULL, 2, 1, 8),
(68, 21, '2014年1月25日，本公司向珠海飞龙自行车公司订购飞龙休闲车300辆，双方协商订购价为300元/辆，本公司于28日收到全部货物，并办理了入库手续。次日，验收发现10辆有质量问题，与公司沟通后，将有质量问题的自行车退回，同时收到对方开具的数量为290的专用发票，发票号码为HL00689，财务部门确认采购成本和应付款项。', NULL, 3, 1, 8),
(69, 21, '2014年1月27日，本公司向青岛环宇体育用品公司订购环宇跑步鞋10箱（100对），双方协商订购价为1500/箱，本公司于29日收到全部货物和专用发票，办理了入库手续，但发票尚未结算。次日发现10对有质量问题，与公司沟通后，将有质量问题的运动鞋退回，结算后财务部门确认采购成本和应付款项。', NULL, 4, 1, 8),
(70, 21, '2014年1月28日，本公司向温州贝亚特自行车公司订购贝亚特休闲车100辆，双方协商价为300元/辆，本公司于30日收到全部货物和专用发票，办理了入库手续、发票结算手续，确认库存成本和应付款项。次日发现15辆有质量问题，与公司沟通后，将有质量问题的自行车退回，并办理了相应手续和财务处理。', NULL, 4, 1, 8),
(71, 21, '2014年1月20日，收到2013年12月6日暂估入库的180对环宇跑步鞋的专用发票，发票号为HY00689，发票上载明环宇跑步鞋180对，单价150元。财务部门确认采购成本并开出现金支票（支票号为XJ0001），支付了全部款项。', NULL, 4, 1, 8),
(72, 22, '2014年1月8日，北京东单商场打算订购贝亚特山地车1000辆，出价2800元/辆。要求本月13日发货，本公司报价为3100元/辆。10日，本公司与北京东单商场协商，对方同意贝亚特山地车销售单价为3100元，但订货数量减为800辆。本公司确认后于1月13日发货（自行车仓），本公司以现金代垫运费1000元。次日开具销售专用发票，发票号为BYT01288，货款尚未收到。', NULL, 2, 1, 8),
(73, 22, '2014年1月13日，广州百货公司有意向本公司订购环宇篮球鞋800对，环宇足球鞋80箱（800对），本公司报价分别为2500元/箱和2300元/箱。14日，广州百货公司同意我公司的报价，并决定追加订货，环宇篮球鞋追加200对，环宇足球鞋追加200对，需要分批开具销售专用发票。本公司同意对方的订货要求。', NULL, 2, 1, 8),
(74, 22, '2014年1月16日，按销售订单发货（运动鞋仓）给广州百货公司分别发出环宇篮球鞋和环宇足球鞋各200对，本公司支付运杂费200元（现金支票XJ01000518）。17日为已经发货的环宇篮球鞋和环宇足球鞋开具两张销售专用发票，发票号分别为00002786和00002787。对方电汇（DH0077899）款项58500元已经收到，系付200对环宇篮球鞋的价税款。200对环宇足球鞋款项暂欠。确认出库成本。', NULL, 3, 1, 8),
(75, 22, '2014年1月6日，收到广州百货公司2013年12月5日购买羽毛球的价税款40950元（电汇DH3001476），本公司于本月2日开具销售专用发票（00001842）。', NULL, 1, 1, 8),
(76, 22, '2014年1月8日，给广州天河城百货公司开具2013年12月7日销售贝亚特山地车的销售专用发票（00001485），款项尚未收到。', NULL, 1, 1, 8),
(77, 22, '2014年1月18日，广州天河城百货公司向本公司订购环宇跑步鞋200对进行询价，本公司报价220元/对，对方初步同意。本公司根据报价单已经生成销售订单。2014年1月21日，广州天河城百货公司提出价格过高，只能接受180元/对，本公司不同意。对方撤销对本公司环宇跑步鞋的订购。', NULL, 1, 1, 8),
(78, 23, '2014年1月13日，给上海东方贸易公司销售飞龙折叠车360辆，订单价格为520元/辆，已经提货。1月23日，对方因为质量问题全部退货（退货已收到，入自行车仓）。本公司同意退货。该批自行车于1月13日发货，尚未开具发票。						', NULL, 2, 1, 8),
(79, 23, '2014年1月26日，广州百货公司向本公司订购飞龙折叠车500辆、飞龙山地车500辆。本公司报价为：飞龙折叠车600元/辆，飞龙山地车2500元/辆。双方协商订购价为飞龙折叠车550元/辆，飞龙山地车2400元/辆。本公司于27日开具销售专用发票（GBH05788），对方于当日提飞龙山地车500辆，飞龙折叠车尚未提货。财务部门确认收入并结转成本。2014年1月28日，广州百货公司提出退回飞龙折叠车500辆。', NULL, 3, 1, 8),
(80, 23, '2014年1月23日，广州百货公司有意向本公司订购羽毛球800筒。本公司报价50元/筒，经双方协商，最后以45元/筒成交。24日收到对方的电汇（DH001889），本公司当即开具销售专用发票（GBH04866）。并于2014年1月25日，给广州百货公司发货（球类仓）。财务部门确认收入并结转成本。2014年1月28日，广州百货公司因质量问题要求退回羽毛球10筒。财务部门退款后确认退货收入及结转退货成本。', NULL, 3, 1, 8),
(82, 24, '2014年1月11日，北京东单商场派采购员到本公司订购贝亚特折叠车100辆，本公司报价790元/辆。经协商，双方认定的价格为780元/辆，本公司开具销售专用发票（BJDD2989），收到双方的转帐支票（ZZ0011288）。采购员当日提货（自行车仓）。						', NULL, 1, 1, 8),
(83, 24, '2014年1月21日，广州天河城百货公司采购员到本公司采购贝亚特山地车800辆，本公司报价3200元/辆。双方协商价格为3100元/辆，本公司立即开具销售专用发票（THC003788），于23日和26日分两批发货（自行车仓），每次发货400辆。对方答应收到最后一次发货货物后，全额支付第1次和第2次两次发货款项。', NULL, 2, 1, 8),
(84, 25, '2014年1月13日，广州百货公司向本公司订购环宇跑步鞋1500对，报价为200元/对，本公司接受广州百货公司的订货。\n2014年1月13日，本公司向青岛环宇体育用品公司订购环宇跑步鞋1500对，单价为180元/对。要求本月20日将货物直接发给广州百货公司。\n2014年1月18日，本公司收到青岛环宇体育用品公司的专用发票，发票号为ZY001188。发票载明环宇跑步鞋1500对，单价为180元/对，增值税税率为17%，货物已经发给广州百货公司。本公司尚未付款。\n2014年1月19日，本公司给广州百货公司开具销售专用发票（发票号ZY006688），发票载明环宇跑步鞋1500对，单价为200元/对，增值税税率为17%，款项尚未收到。		', NULL, 4, 1, 8),
(85, 26, '2015年1月3日，我公司向川崎球厂提出采购请求，请求采购川崎全碳素碳纤维羽毛球拍1000只，报价80元/只。\n2015年1月4日，川崎球厂同意采购请求，但要求修改价格。经协商，本公司同意对方提出的采购价格：川崎全碳素碳纤维羽毛球拍85元/只，并正式签订订货合同，要求本月6日到货。\n2015年1月6日，收到川崎球厂发来的货物和专用发票，发票号码ZY00098。发票载明川崎全碳素碳纤维羽毛球拍1000只，单价85元/只。经检验，发现50只存在质量问题，与对方协商，退货50只，开具红字发票，发票号码ZY00099。验收合格的950只办理入库（羽毛球仓）手续。财务部门确认该笔存货成本和应付款项。尚未付款。\n						', NULL, 2, 1, 8),
(86, 26, '2015年1月3日，向黑貂游泳镜厂订购近视游泳镜1000副，单价140元，要求本月5日到货。2015年1月5日收到黑貂游泳镜厂发来的近视游泳镜和专用发票，发票号码ZY00112。发票上写明近视游泳镜1000副，单价140元，增值税率17%。经检验，近视游泳镜损坏5只，属于合理损耗（入游泳镜仓）。本公司确认后立即付款50%（现金支票XJ0001）。财务部门确认采购成本和应付款项。', NULL, 2, 1, 8),
(87, 26, '2015年1月5日，本公司向川崎球厂提出采购请求，请求采购碳铝羽毛球拍20只，报价45元/只，要求1月8日发货。2015年1月6日，川崎球厂同意采购请求，但要求修改价格为55元/支。本公司同意此交易，签订订单。\n2015年1月7日，本公司由于某些原因，决定暂缓此次交易，与川崎球厂沟通后，同意取消此次交易，故交易终止\n', NULL, 1, 1, 8),
(88, 26, '2015年1月4日，广州友谊商场打算采购网球拍200只，出价170元，要求本月6日发货。本公司报价190元。经协商，双方认定的价格为180元。本公司确认后于6日发货。本公司以现金代垫运费500元并开具销售专用发票（ZY000299）。财务部门确认该笔存货成本和应收款项。广州友谊商场于1月8日全额付款。(系统已勾选销售生成出库单)', NULL, 2, 1, 8),
(89, 26, '2015年1月5日，广州东山百货公司打算订碳铝羽毛球拍200只，本月7号发货，要求本公司报价。本公司报价为150元。1月6日，本公司与其协商，对方同意碳铝羽毛球拍的销售价格为130元，但订货数量减少为100只。本公司确认后于7日发货（羽毛球仓），货款尚未收到。财务部门尚未确认该笔存货成本和应收款项。\n当天，广州东山百货公司要求退货。退货碳铝羽毛球拍10只。本公司同意退货，办理相关退货手续后，财务部门开具销售发票，确认该笔存货成本和应收款项。\n', NULL, 3, 1, 8),
(90, 26, '2015年1月7日，广州市东山百货公司向本公司订购碳铝羽毛球拍100只，报价为130元，本公司接受广州市东山百货公司的订货。\n2015年1月7日，本公司向川崎球厂订购碳铝羽毛球拍100只，单价为55元。要求本月8日将货物直接发给广州市东山百货公司。\n2015年1月8日，本公司收到川崎球厂的专用发票，发票号为ZY00178。发票载明碳铝羽毛球拍100只，单价为55元，增值税税率17%，货物已经发给广州市东山百货公司。本公司尚未支付货款。\n2015年1月8日，本公司给东山百货公司开具销售专用发票（发票号ZY006688），发票载明碳铝羽毛球拍100只，单价130元，增值税率17%，款项尚未收到。\n财务部门做相应的凭证处理。\n', NULL, 4, 1, 8);

-- --------------------------------------------------------

--
-- 表的结构 `flow_questions_add`
--

CREATE TABLE IF NOT EXISTS `flow_questions_add` (
  `questions_add_id` bigint(20) NOT NULL AUTO_INCREMENT COMMENT '题目id',
  `questions_flow_id` bigint(20) NOT NULL COMMENT '流程题id',
  `questions_flow_step_id` bigint(20) NOT NULL COMMENT '流程题答案步骤id',
  `flow_steps_blanchid` smallint(6) NOT NULL,
  `questions_add_description` text COLLATE utf8_unicode_ci NOT NULL COMMENT '题干',
  `questions_add_explanation` text COLLATE utf8_unicode_ci COMMENT '题目注释',
  `questions_add_type` smallint(3) NOT NULL COMMENT '题目类型（单项、多选等）',
  `questions_add_enabled` tinyint(1) NOT NULL DEFAULT '1' COMMENT '题目是否可用',
  `questions_add_users_id` bigint(20) unsigned NOT NULL COMMENT '添加该题的用户（教师）id',
  PRIMARY KEY (`questions_add_id`),
  KEY `questions_add_users_id` (`questions_add_users_id`),
  KEY `questions_flow_id` (`questions_flow_id`),
  KEY `flow_steps_blanchid` (`flow_steps_blanchid`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='存储附加题信息' AUTO_INCREMENT=31 ;

--
-- 转存表中的数据 `flow_questions_add`
--

INSERT INTO `flow_questions_add` (`questions_add_id`, `questions_flow_id`, `questions_flow_step_id`, `flow_steps_blanchid`, `questions_add_description`, `questions_add_explanation`, `questions_add_type`, `questions_add_enabled`, `questions_add_users_id`) VALUES
(22, 32, 1, 0, ' 我的的心理只有你没有他', NULL, 0, 1, 7),
(25, 32, 1, 0, ' 如痴，如醉，如试验风欺骗你', NULL, 0, 1, 2),
(26, 51, 1, 0, '51负阿集体					', NULL, 1, 1, 2),
(27, 52, 1, 0, '52		', NULL, 1, 1, 2),
(28, 53, 1, 0, '53	', NULL, 1, 1, 2),
(29, 53, 2, 0, '532222	', NULL, 1, 1, 2),
(30, 54, 1, 0, '54			', NULL, 1, 1, 2);

-- --------------------------------------------------------

--
-- 表的结构 `flow_questions_concept`
--

CREATE TABLE IF NOT EXISTS `flow_questions_concept` (
  `questions_concept_id` bigint(20) NOT NULL AUTO_INCREMENT COMMENT '题目id',
  `questions_concept_subject_id` bigint(20) unsigned NOT NULL COMMENT '题目所属章节（主题subject）',
  `questions_concept_description` text COLLATE utf8_unicode_ci NOT NULL COMMENT '题干',
  `questions_concept_explanation` text COLLATE utf8_unicode_ci COMMENT '题目注释',
  `questions_concept_type` smallint(3) NOT NULL COMMENT '题目类型（单项、多选等）',
  `questions_concept_difficulty` smallint(6) NOT NULL DEFAULT '1' COMMENT '难度',
  `questions_concept_enabled` tinyint(1) NOT NULL DEFAULT '1' COMMENT '题目是否可用',
  `questions_concept_users_id` bigint(20) unsigned NOT NULL COMMENT '添加该题的用户（教师）id',
  PRIMARY KEY (`questions_concept_id`),
  KEY `questions_concept_subject_id` (`questions_concept_subject_id`),
  KEY `questions_concept_users_id` (`questions_concept_users_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='存储理论题信息' AUTO_INCREMENT=7 ;

--
-- 转存表中的数据 `flow_questions_concept`
--

INSERT INTO `flow_questions_concept` (`questions_concept_id`, `questions_concept_subject_id`, `questions_concept_description`, `questions_concept_explanation`, `questions_concept_type`, `questions_concept_difficulty`, `questions_concept_enabled`, `questions_concept_users_id`) VALUES
(1, 6, '理论题的主要题目', '理论题的主要题目', 1, 2, 1, 2),
(2, 6, '理论题的主要题目', '理论题的主要题目', 1, 1, 1, 2),
(3, 6, '理论题的主要题目', '理论题的主要题目', 1, 1, 1, 2),
(4, 6, '理论题的主要题目', '理论题的主要题目', 1, 1, 1, 2),
(5, 6, '理论题的主要题目', '理论题的主要题目', 1, 1, 1, 2),
(6, 6, '理论题的主要题目', '理论题的主要题目', 1, 1, 1, 4);

-- --------------------------------------------------------

--
-- 表的结构 `flow_steps`
--

CREATE TABLE IF NOT EXISTS `flow_steps` (
  `steps_module_id` bigint(20) unsigned NOT NULL COMMENT '步骤所属科目(module)id',
  `steps_type` bigint(20) NOT NULL COMMENT '步骤类型',
  `steps_options_id` bigint(20) NOT NULL COMMENT '步骤选项id',
  `steps_options` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT '选项表中选项名称',
  PRIMARY KEY (`steps_module_id`,`steps_type`,`steps_options_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='用于存储流程步骤的相关信息';

--
-- 转存表中的数据 `flow_steps`
--

INSERT INTO `flow_steps` (`steps_module_id`, `steps_type`, `steps_options_id`, `steps_options`) VALUES
(1, 1, 1, '单据'),
(1, 1, 2, '操作'),
(1, 1, 3, '角色');

-- --------------------------------------------------------

--
-- 表的结构 `flow_steps_options`
--

CREATE TABLE IF NOT EXISTS `flow_steps_options` (
  `steps_options_content_id` bigint(20) NOT NULL AUTO_INCREMENT COMMENT '选项内容id',
  `module_id` bigint(20) unsigned NOT NULL COMMENT '科目id',
  `steps_options` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT '选项名称',
  `steps_options_content` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT '选项内容',
  `step_order` int(11) NOT NULL COMMENT '顺序',
  PRIMARY KEY (`steps_options_content_id`),
  KEY `module_id` (`module_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='存储选项内容' AUTO_INCREMENT=101 ;

--
-- 转存表中的数据 `flow_steps_options`
--

INSERT INTO `flow_steps_options` (`steps_options_content_id`, `module_id`, `steps_options`, `steps_options_content`, `step_order`) VALUES
(1, 5, '单据', '入库单', 0),
(2, 5, '单据', '订货单', 0),
(3, 5, '角色', '主管', 0),
(4, 5, '角色', '出纳员', 0),
(5, 5, '操作', '审核表单', 0),
(6, 5, '操作', '发放订单', 0),
(9, 5, '提示', '请选择', 0),
(11, 1, '单据', '采购入库单', 5),
(13, 1, '单据', '请购单', 2),
(14, 1, '单据', '采购订单', 3),
(17, 1, '单据', '普通采购发票', 7),
(18, 1, '单据', '期初采购入库单', 1),
(19, 1, '单据', '到货单', 4),
(20, 1, '单据', '专用采购发票', 6),
(21, 1, '单据', '结算单列表', 13),
(22, 1, '单据', '发票+入库单', 9),
(23, 1, '单据', '发票+入库单+运费单', 10),
(24, 1, '单据', '发票+入库单+红字入库单', 11),
(25, 1, '单据', '发票+入库单+红字发票+红字入库单', 12),
(26, 1, '操作', '正常单据记账', 21),
(27, 1, '操作', '生成凭证', 24),
(28, 1, '提示', '请选择', 0),
(29, 1, '单据', '应付单据', 17),
(31, 1, '操作', '制单', 20),
(32, 1, '单据', '采购退货单', 4),
(33, 1, '单据', '红字采购入库单', 5),
(34, 1, '单据', '红字专用采购发票', 6),
(35, 1, '角色', '采购员  ', 0),
(36, 1, '角色', '采购主管', 0),
(37, 1, '角色', '销售员        ', 0),
(38, 1, '角色', '销售主管', 0),
(39, 1, '角色', '仓管员 ', 0),
(40, 1, '角色', '仓储主管', 0),
(41, 1, '角色', '管理会计', 0),
(43, 1, '角色', '会计', 0),
(47, 1, '操作', '审核', 12),
(54, 1, '操作', '查看', 14),
(58, 1, '操作', '现付', 17),
(59, 1, '操作', '手工结算', 19),
(60, 1, '操作', '自动结算', 18),
(61, 1, '操作', '根据请购单生单', 2),
(62, 1, '操作', '根据采购订单生单', 3),
(63, 1, '操作', '根据到货单生单', 4),
(64, 1, '操作', '根据采购入库单生单', 5),
(65, 1, '操作', '手工录入', 1),
(66, 1, '操作', '根据采购专用发票生单', 6),
(67, 1, '单据', '结算后的采购入库单', 14),
(68, 1, '单据', '运费发票', 8),
(69, 1, '操作', '结算成本处理', 22),
(70, 1, '单据', '红字回冲单', 15),
(71, 1, '单据', '蓝字回冲单', 16),
(72, 1, '单据', '销售报价单', 18),
(73, 1, '单据', '销售订单', 19),
(74, 1, '单据', '代垫运费单', 25),
(75, 1, '单据', '销售发货单', 20),
(76, 1, '单据', '销售出库单', 22),
(77, 1, '单据', '销售专用发票', 24),
(78, 1, '单据', '销售费用支出单', 26),
(79, 1, '操作', '复核', 13),
(80, 1, '操作', '关闭', 16),
(81, 1, '操作', '打开', 15),
(83, 1, '操作', '根据销售报价单生单', 7),
(84, 1, '操作', '根据销售订单生单', 8),
(85, 1, '操作', '根据销售发货单生单', 9),
(86, 1, '操作', '根据销售出库单生单', 10),
(87, 1, '操作', '根据销售专用发票生单', 11),
(88, 1, '单据', '应收单据', 27),
(89, 1, '单据', '退货单', 21),
(90, 1, '单据', '红字销售出库单', 23),
(93, 1, '单据', '红字销售专用发票', 24),
(94, 1, '操作', '直运销售记账', 23),
(95, 1, '单据', '收款单据', 27),
(96, 1, '单据', '直运销售订单', 19),
(97, 1, '单据', '直运销售发票', 24),
(98, 1, '单据', '直运采购订单', 3),
(99, 1, '单据', '直运采购发票', 6),
(100, 1, '单据', '发票+红字发票+入库单', 11);

-- --------------------------------------------------------

--
-- 表的结构 `flow_teachers`
--

CREATE TABLE IF NOT EXISTS `flow_teachers` (
  `flow_teachers_id` int(11) NOT NULL AUTO_INCREMENT COMMENT '老师的唯一id',
  `flow_teachers_name` varchar(16) NOT NULL COMMENT '老师的姓名',
  PRIMARY KEY (`flow_teachers_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=35 ;

--
-- 转存表中的数据 `flow_teachers`
--

INSERT INTO `flow_teachers` (`flow_teachers_id`, `flow_teachers_name`) VALUES
(3, '乔万林'),
(4, '陈平仲'),
(6, '晏再庚'),
(7, '白娅娟'),
(8, '陈开华'),
(9, '陈震红'),
(10, '崔雷'),
(11, '董俊武'),
(12, '姜卉芸'),
(13, '康洁'),
(14, '康翔'),
(15, '李别'),
(16, '李孟庭'),
(17, '李宇耀'),
(18, '梁俏'),
(19, '廖信海'),
(20, '刘江辉'),
(21, '吕英俊'),
(22, '孟令春\n'),
(23, '潘星\n'),
(24, '汤亮\n'),
(25, '万万\n'),
(26, '许荷香\n'),
(27, '许建民\n'),
(28, '叶怡雄\n'),
(29, '袁静\n'),
(30, '张玲\n'),
(31, '张晓明\n'),
(32, '郑燕\n'),
(33, '周安宁\n'),
(34, '周霞\n');

-- --------------------------------------------------------

--
-- 表的结构 `flow_test`
--

CREATE TABLE IF NOT EXISTS `flow_test` (
  `test_id` bigint(20) NOT NULL AUTO_INCREMENT COMMENT '测验id',
  `test_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT '测验名称',
  `test_description` text COLLATE utf8_unicode_ci NOT NULL COMMENT '测验描述',
  `test_user_id` bigint(20) unsigned NOT NULL COMMENT '创建测验的用户ID',
  `test_enable` tinyint(1) NOT NULL COMMENT '测验是否可用',
  `test_password` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '密码',
  PRIMARY KEY (`test_id`),
  KEY `test_user_id` (`test_user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='存储测验信息' AUTO_INCREMENT=5 ;

--
-- 转存表中的数据 `flow_test`
--

INSERT INTO `flow_test` (`test_id`, `test_name`, `test_description`, `test_user_id`, `test_enable`, `test_password`) VALUES
(1, '课堂题目测试', '这是一次课堂的模拟测试！', 1, 1, ''),
(2, '课堂练习--教材', '根据教材进行课堂练习', 2, 1, ''),
(3, '教材练习--采购与销售', '教材练习-采购与销售', 2, 1, ''),
(4, '0710上午', '0710上午', 2, 1, '');

-- --------------------------------------------------------

--
-- 表的结构 `tce_answers`
--

CREATE TABLE IF NOT EXISTS `tce_answers` (
  `answer_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `answer_question_id` bigint(20) unsigned NOT NULL,
  `answer_description` text COLLATE utf8_unicode_ci NOT NULL,
  `answer_explanation` text COLLATE utf8_unicode_ci,
  `answer_isright` tinyint(1) NOT NULL DEFAULT '0',
  `answer_enabled` tinyint(1) NOT NULL DEFAULT '0',
  `answer_position` bigint(20) unsigned DEFAULT NULL,
  `answer_keyboard_key` smallint(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`answer_id`),
  KEY `p_answer_question_id` (`answer_question_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=30 ;

--
-- 转存表中的数据 `tce_answers`
--

INSERT INTO `tce_answers` (`answer_id`, `answer_question_id`, `answer_description`, `answer_explanation`, `answer_isright`, `answer_enabled`, `answer_position`, `answer_keyboard_key`) VALUES
(26, 9, 'A.中国', NULL, 1, 1, NULL, NULL),
(27, 9, 'B.广东', NULL, 1, 1, NULL, NULL),
(28, 9, 'C.黑龙江', NULL, 0, 1, NULL, NULL),
(29, 9, 'D.韩国', NULL, 0, 1, NULL, NULL);

-- --------------------------------------------------------

--
-- 表的结构 `tce_modules`
--

CREATE TABLE IF NOT EXISTS `tce_modules` (
  `module_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `module_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `module_enabled` tinyint(1) NOT NULL DEFAULT '0',
  `module_user_id` bigint(20) unsigned NOT NULL DEFAULT '1',
  PRIMARY KEY (`module_id`),
  UNIQUE KEY `ak_module_name` (`module_name`),
  KEY `p_module_user_id` (`module_user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=11 ;

--
-- 转存表中的数据 `tce_modules`
--

INSERT INTO `tce_modules` (`module_id`, `module_name`, `module_enabled`, `module_user_id`) VALUES
(1, 'ERP', 1, 1),
(8, 'ERP教材实验', 1, 2),
(9, 'ERP考试20150710上', 1, 8),
(10, 'ERP考试20150710下', 1, 8);

-- --------------------------------------------------------

--
-- 表的结构 `tce_questions`
--

CREATE TABLE IF NOT EXISTS `tce_questions` (
  `question_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `question_subject_id` bigint(20) unsigned NOT NULL,
  `question_description` text COLLATE utf8_unicode_ci NOT NULL,
  `question_explanation` text COLLATE utf8_unicode_ci,
  `question_type` smallint(3) unsigned NOT NULL DEFAULT '1',
  `question_difficulty` smallint(6) NOT NULL DEFAULT '1',
  `question_enabled` tinyint(1) NOT NULL DEFAULT '0',
  `question_position` bigint(20) unsigned DEFAULT NULL,
  `question_timer` smallint(10) DEFAULT NULL,
  `question_fullscreen` tinyint(1) NOT NULL DEFAULT '0',
  `question_inline_answers` tinyint(1) NOT NULL DEFAULT '0',
  `question_auto_next` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`question_id`),
  KEY `p_question_subject_id` (`question_subject_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=10 ;

--
-- 转存表中的数据 `tce_questions`
--

INSERT INTO `tce_questions` (`question_id`, `question_subject_id`, `question_description`, `question_explanation`, `question_type`, `question_difficulty`, `question_enabled`, `question_position`, `question_timer`, `question_fullscreen`, `question_inline_answers`, `question_auto_next`) VALUES
(9, 6, '[b]你的出生地在哪里？[/b]', NULL, 2, 1, 1, NULL, 50, 0, 0, 0);

-- --------------------------------------------------------

--
-- 表的结构 `tce_sessions`
--

CREATE TABLE IF NOT EXISTS `tce_sessions` (
  `cpsession_id` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `cpsession_expiry` datetime NOT NULL,
  `cpsession_data` text COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`cpsession_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- 转存表中的数据 `tce_sessions`
--

INSERT INTO `tce_sessions` (`cpsession_id`, `cpsession_expiry`, `cpsession_data`) VALUES
('49555f5fb3b8924487e540749946be31', '2016-01-05 16:18:34', 'session_hash|s:32:"b92ecf26d4db632365a88cbc1df474b5";session_user_id|s:1:"2";session_user_name|s:5:"admin";session_user_ip|s:39:"0000:0000:0000:0000:0000:ffff:7f00:0001";session_user_level|s:2:"10";session_user_firstname|s:0:"";session_user_lastname|s:0:"";session_test_login|s:0:"";session_last_visit|i:1452007094;');

-- --------------------------------------------------------

--
-- 表的结构 `tce_sslcerts`
--

CREATE TABLE IF NOT EXISTS `tce_sslcerts` (
  `ssl_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `ssl_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `ssl_hash` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `ssl_end_date` datetime NOT NULL,
  `ssl_enabled` tinyint(1) NOT NULL DEFAULT '0',
  `ssl_user_id` bigint(20) unsigned NOT NULL DEFAULT '1',
  PRIMARY KEY (`ssl_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `tce_subjects`
--

CREATE TABLE IF NOT EXISTS `tce_subjects` (
  `subject_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `subject_module_id` bigint(20) unsigned NOT NULL DEFAULT '1',
  `subject_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `subject_description` text COLLATE utf8_unicode_ci,
  `subject_enabled` tinyint(1) NOT NULL DEFAULT '0',
  `subject_user_id` bigint(20) unsigned NOT NULL DEFAULT '1',
  PRIMARY KEY (`subject_id`),
  UNIQUE KEY `ak_subject_name` (`subject_module_id`,`subject_name`),
  KEY `p_subject_user_id` (`subject_user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=27 ;

--
-- 转存表中的数据 `tce_subjects`
--

INSERT INTO `tce_subjects` (`subject_id`, `subject_module_id`, `subject_name`, `subject_description`, `subject_enabled`, `subject_user_id`) VALUES
(6, 1, '采购业务2\n', '采购业务', 1, 2),
(18, 1, '采购退货及跨期业务处理\n', '采购退货及跨期业务处理\r\n', 1, 2),
(19, 8, '实验五 普通采购业务', NULL, 1, 2),
(20, 8, '实验六 普通采购业务（二）', NULL, 1, 7),
(21, 8, '实验七 采购退货及跨期业务处理', NULL, 1, 8),
(22, 8, '实验九 普通销售业务（一）', NULL, 1, 8),
(23, 8, '实验十一 销售退货业务', NULL, 1, 8),
(24, 8, '实验十 普通销售业务（二）', NULL, 1, 8),
(25, 8, '实验十二 直运销售业务', NULL, 1, 8),
(26, 9, 'ERP考试20150710上', NULL, 1, 8);

-- --------------------------------------------------------

--
-- 表的结构 `tce_testgroups`
--

CREATE TABLE IF NOT EXISTS `tce_testgroups` (
  `tstgrp_test_id` bigint(20) unsigned NOT NULL,
  `tstgrp_group_id` bigint(20) unsigned NOT NULL,
  PRIMARY KEY (`tstgrp_test_id`,`tstgrp_group_id`),
  KEY `p_tstgrp_test_id` (`tstgrp_test_id`),
  KEY `p_tstgrp_group_id` (`tstgrp_group_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- 表的结构 `tce_tests`
--

CREATE TABLE IF NOT EXISTS `tce_tests` (
  `test_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `test_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `test_description` text COLLATE utf8_unicode_ci NOT NULL,
  `test_begin_time` datetime DEFAULT NULL,
  `test_end_time` datetime DEFAULT NULL,
  `test_duration_time` smallint(10) unsigned NOT NULL DEFAULT '0',
  `test_ip_range` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '*.*.*.*',
  `test_results_to_users` tinyint(1) NOT NULL DEFAULT '0',
  `test_report_to_users` tinyint(1) NOT NULL DEFAULT '0',
  `test_score_right` decimal(10,3) DEFAULT '1.000',
  `test_score_wrong` decimal(10,3) DEFAULT '0.000',
  `test_score_unanswered` decimal(10,3) DEFAULT '0.000',
  `test_max_score` decimal(10,3) NOT NULL DEFAULT '0.000',
  `test_user_id` bigint(20) unsigned NOT NULL DEFAULT '1',
  `test_score_threshold` decimal(10,3) DEFAULT '0.000',
  `test_random_questions_select` tinyint(1) NOT NULL DEFAULT '1',
  `test_random_questions_order` tinyint(1) NOT NULL DEFAULT '1',
  `test_questions_order_mode` smallint(3) unsigned NOT NULL DEFAULT '0',
  `test_random_answers_select` tinyint(1) NOT NULL DEFAULT '1',
  `test_random_answers_order` tinyint(1) NOT NULL DEFAULT '1',
  `test_answers_order_mode` smallint(3) unsigned NOT NULL DEFAULT '0',
  `test_comment_enabled` tinyint(1) NOT NULL DEFAULT '1',
  `test_menu_enabled` tinyint(1) NOT NULL DEFAULT '1',
  `test_noanswer_enabled` tinyint(1) NOT NULL DEFAULT '1',
  `test_mcma_radio` tinyint(1) NOT NULL DEFAULT '1',
  `test_repeatable` tinyint(1) NOT NULL DEFAULT '0',
  `test_mcma_partial_score` tinyint(1) NOT NULL DEFAULT '1',
  `test_logout_on_timeout` tinyint(1) NOT NULL DEFAULT '0',
  `test_password` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`test_id`),
  UNIQUE KEY `ak_test_name` (`test_name`),
  KEY `p_test_user_id` (`test_user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `tce_testsslcerts`
--

CREATE TABLE IF NOT EXISTS `tce_testsslcerts` (
  `tstssl_test_id` bigint(20) unsigned NOT NULL,
  `tstssl_ssl_id` bigint(20) unsigned NOT NULL,
  PRIMARY KEY (`tstssl_test_id`,`tstssl_ssl_id`),
  KEY `p_tstssl_test_id` (`tstssl_test_id`),
  KEY `p_tstssl_ssl_id` (`tstssl_ssl_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- 表的结构 `tce_tests_logs`
--

CREATE TABLE IF NOT EXISTS `tce_tests_logs` (
  `testlog_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `testlog_testuser_id` bigint(20) unsigned NOT NULL,
  `testlog_user_ip` varchar(39) COLLATE utf8_unicode_ci DEFAULT NULL,
  `testlog_question_id` bigint(20) unsigned NOT NULL,
  `testlog_answer_text` text COLLATE utf8_unicode_ci,
  `testlog_score` decimal(10,3) DEFAULT NULL,
  `testlog_creation_time` datetime DEFAULT NULL,
  `testlog_display_time` datetime DEFAULT NULL,
  `testlog_change_time` datetime DEFAULT NULL,
  `testlog_reaction_time` bigint(20) unsigned NOT NULL DEFAULT '0',
  `testlog_order` smallint(6) NOT NULL DEFAULT '1',
  `testlog_num_answers` smallint(5) unsigned NOT NULL DEFAULT '0',
  `testlog_comment` text COLLATE utf8_unicode_ci,
  PRIMARY KEY (`testlog_id`),
  UNIQUE KEY `ak_testuser_question` (`testlog_testuser_id`,`testlog_question_id`),
  KEY `p_testlog_question_id` (`testlog_question_id`),
  KEY `p_testlog_testuser_id` (`testlog_testuser_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `tce_tests_logs_answers`
--

CREATE TABLE IF NOT EXISTS `tce_tests_logs_answers` (
  `logansw_testlog_id` bigint(20) unsigned NOT NULL,
  `logansw_answer_id` bigint(20) unsigned NOT NULL,
  `logansw_selected` smallint(6) NOT NULL DEFAULT '-1',
  `logansw_order` smallint(6) NOT NULL DEFAULT '1',
  `logansw_position` bigint(20) unsigned DEFAULT NULL,
  PRIMARY KEY (`logansw_testlog_id`,`logansw_answer_id`),
  KEY `p_logansw_answer_id` (`logansw_answer_id`),
  KEY `p_logansw_testlog_id` (`logansw_testlog_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- 表的结构 `tce_tests_users`
--

CREATE TABLE IF NOT EXISTS `tce_tests_users` (
  `testuser_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `testuser_test_id` bigint(20) unsigned NOT NULL,
  `testuser_user_id` bigint(20) unsigned NOT NULL,
  `testuser_status` smallint(5) unsigned NOT NULL DEFAULT '0',
  `testuser_creation_time` datetime NOT NULL,
  `testuser_comment` text COLLATE utf8_unicode_ci,
  PRIMARY KEY (`testuser_id`),
  UNIQUE KEY `ak_testuser` (`testuser_test_id`,`testuser_user_id`,`testuser_status`),
  KEY `p_testuser_user_id` (`testuser_user_id`),
  KEY `p_testuser_test_id` (`testuser_test_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `tce_testuser_stat`
--

CREATE TABLE IF NOT EXISTS `tce_testuser_stat` (
  `tus_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `tus_date` datetime NOT NULL,
  PRIMARY KEY (`tus_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=5 ;

--
-- 转存表中的数据 `tce_testuser_stat`
--

INSERT INTO `tce_testuser_stat` (`tus_id`, `tus_date`) VALUES
(1, '2015-01-28 15:34:42'),
(2, '2015-01-28 15:41:37'),
(3, '2015-01-28 15:55:50'),
(4, '2015-03-14 08:06:48');

-- --------------------------------------------------------

--
-- 表的结构 `tce_test_subjects`
--

CREATE TABLE IF NOT EXISTS `tce_test_subjects` (
  `subjset_tsubset_id` bigint(20) unsigned NOT NULL,
  `subjset_subject_id` bigint(20) unsigned NOT NULL,
  PRIMARY KEY (`subjset_tsubset_id`,`subjset_subject_id`),
  KEY `p_subjset_subject_id` (`subjset_subject_id`),
  KEY `p_subjset_tsubset_id` (`subjset_tsubset_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- 表的结构 `tce_test_subject_set`
--

CREATE TABLE IF NOT EXISTS `tce_test_subject_set` (
  `tsubset_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `tsubset_test_id` bigint(20) unsigned NOT NULL,
  `tsubset_type` smallint(6) NOT NULL DEFAULT '1',
  `tsubset_difficulty` smallint(6) NOT NULL DEFAULT '1',
  `tsubset_quantity` smallint(6) NOT NULL DEFAULT '1',
  `tsubset_answers` smallint(6) NOT NULL DEFAULT '0',
  PRIMARY KEY (`tsubset_id`),
  KEY `p_tsubset_test_id` (`tsubset_test_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `tce_users`
--

CREATE TABLE IF NOT EXISTS `tce_users` (
  `user_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `user_password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `user_email` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `user_regdate` datetime NOT NULL,
  `user_ip` varchar(39) COLLATE utf8_unicode_ci NOT NULL,
  `user_firstname` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `user_lastname` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `user_birthdate` date DEFAULT NULL,
  `user_birthplace` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `user_regnumber` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `user_ssn` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `user_level` smallint(3) unsigned NOT NULL DEFAULT '1',
  `user_verifycode` varchar(32) COLLATE utf8_unicode_ci DEFAULT NULL,
  `user_otpkey` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `teacher_id` int(16) NOT NULL COMMENT '任课老师的',
  `class_id` int(16) NOT NULL COMMENT '所属的班级',
  `college` varchar(30) CHARACTER SET utf8 NOT NULL COMMENT '学校名称',
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `ak_user_name` (`user_name`),
  UNIQUE KEY `user_verifycode` (`user_verifycode`),
  UNIQUE KEY `ak_user_regnumber` (`user_regnumber`),
  UNIQUE KEY `ak_user_ssn` (`user_ssn`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=180 ;

--
-- 转存表中的数据 `tce_users`
--

INSERT INTO `tce_users` (`user_id`, `user_name`, `user_password`, `user_email`, `user_regdate`, `user_ip`, `user_firstname`, `user_lastname`, `user_birthdate`, `user_birthplace`, `user_regnumber`, `user_ssn`, `user_level`, `user_verifycode`, `user_otpkey`, `teacher_id`, `class_id`, `college`) VALUES
(1, 'anonymous', '6d068345f42a134a12adddadead25ffd', NULL, '2001-01-01 01:01:01', '0.0.0.0', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, 0, 0, ''),
(2, 'admin', 'c574b5b09ab10f4f39ae9dce6d539cf0', NULL, '2001-01-01 01:01:01', '127.0.0.0', NULL, NULL, NULL, NULL, NULL, NULL, 10, NULL, NULL, 3, 3, ''),
(6, 'quanlincong', 'ea5d015ccd4563709e0d6e19eb93f693', 'quan@qq.com', '2015-03-02 08:31:56', '0000:0000:0000:0000:0000:ffff:7f00:0001', '林聪', '全', '2015-03-01', '广东', 'quan', '110882', 1, NULL, 'EJXOMCU3I5FTCJL7', 0, 0, ''),
(8, 'teacher', 'd7819bbf275e268ba6b897b6f7dd313b', 'teacher@qq.com', '2015-06-25 14:12:26', '0000:0000:0000:0000:0000:ffff:c0a8:f816', 't', 't', '2015-06-10', NULL, NULL, NULL, 10, NULL, 'LST4GICH3EOW56DZ', 0, 0, ''),
(54, 'lyy', 'd7819bbf275e268ba6b897b6f7dd313b', '12345678@qq.com', '2015-06-26 06:39:41', '0000:0000:0000:0000:0000:ffff:7f00:0001', 'ly', 'l', '2015-06-01', NULL, NULL, NULL, 10, NULL, 'LBLBVMTQGUXKTPC4', 0, 0, ''),
(173, '20121003577', 'ea5d015ccd4563709e0d6e19eb93f693', 'quan@qq.com', '2015-07-09 14:23:49', '0000:0000:0000:0000:0000:ffff:c0a8:cd4e', '全林聪', NULL, NULL, NULL, NULL, NULL, 1, 'e1590919f9a06c41c059730fd7b14954', 'KJAVQILYKJKHC36I', 3, 3, '广外'),
(174, '201210035771', 'ea5d015ccd4563709e0d6e19eb93f693', 'quanlincong@qq.com', '2015-07-09 14:33:27', '0000:0000:0000:0000:0000:ffff:c0a8:f816', '全林聪', NULL, NULL, NULL, NULL, NULL, 1, '8d891bbfe4496a1994a8994335823e90', '6EDK7RPXASOGV7MG', 3, 3, '广外'),
(175, '201210035775', 'ea5d015ccd4563709e0d6e19eb93f693', 'quan@qq.com', '2015-07-09 14:41:11', '0000:0000:0000:0000:0000:ffff:c0a8:f816', 'quan', NULL, NULL, NULL, NULL, NULL, 1, '3d2b45cfab5a90b4a1659dcd9e611a35', 'HY4PJCDCEG7E3KKU', 3, 3, 'gw'),
(176, '201210035779', 'ea5d015ccd4563709e0d6e19eb93f693', 'quan@qq.com', '2015-07-09 14:52:50', '0000:0000:0000:0000:0000:ffff:c0a8:f816', '去', NULL, NULL, NULL, NULL, NULL, 1, 'efa85734a00a415696568f1acca4bbad', 'UM2DVUEDRFJWUQME', 3, 3, '啊'),
(177, '20120301201', '197b1756676f7e267f3f6f2a14fa069e', '308092751@qq.com', '2015-07-09 15:26:08', '0000:0000:0000:0000:0000:ffff:c0a8:0254', '唐欣然', NULL, NULL, NULL, NULL, NULL, 1, '5446c89a4b829eca459348ff9ea821c1', 'YSBDJ3J2CLZBOPT6', 17, 36, '广东外语外贸大学'),
(178, '2012100357793', '45bde7a93825781b098d8d106705b2ec', 'quan@qq.com', '2015-11-01 03:56:33', '0000:0000:0000:0000:0000:ffff:7f00:0001', 'quan', NULL, NULL, NULL, NULL, NULL, 1, 'f9cdba6edc2adab60365babebc1c43cc', 'GM5ZBROXRO5XGFUV', 3, 3, 'dfs '),
(179, '20121005799', 'd7819bbf275e268ba6b897b6f7dd313b', 'quan@qq.com', '2015-11-01 04:04:18', '0000:0000:0000:0000:0000:ffff:7f00:0001', 'admin', NULL, NULL, NULL, NULL, NULL, 1, '3c2031409b101345fa6e6c927eeb83be', '7JH4L6AHJVTAITJD', 3, 3, 'das');

-- --------------------------------------------------------

--
-- 表的结构 `tce_user_groups`
--

CREATE TABLE IF NOT EXISTS `tce_user_groups` (
  `group_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `group_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`group_id`),
  UNIQUE KEY `group_name` (`group_name`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=5 ;

--
-- 转存表中的数据 `tce_user_groups`
--

INSERT INTO `tce_user_groups` (`group_id`, `group_name`) VALUES
(1, 'default'),
(4, '改卷老师'),
(2, '监考老师'),
(3, '考生');

-- --------------------------------------------------------

--
-- 表的结构 `tce_usrgroups`
--

CREATE TABLE IF NOT EXISTS `tce_usrgroups` (
  `usrgrp_user_id` bigint(20) unsigned NOT NULL,
  `usrgrp_group_id` bigint(20) unsigned NOT NULL,
  PRIMARY KEY (`usrgrp_user_id`,`usrgrp_group_id`),
  KEY `p_usrgrp_user_id` (`usrgrp_user_id`),
  KEY `p_usrgrp_group_id` (`usrgrp_group_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- 转存表中的数据 `tce_usrgroups`
--

INSERT INTO `tce_usrgroups` (`usrgrp_user_id`, `usrgrp_group_id`) VALUES
(0, 1),
(0, 3),
(2, 1),
(2, 2),
(2, 3),
(2, 4),
(4, 3),
(5, 3),
(6, 3),
(7, 1),
(7, 2),
(7, 3),
(7, 4),
(8, 1),
(8, 2),
(8, 3),
(8, 4),
(9, 1),
(9, 3),
(10, 1),
(10, 3),
(11, 1),
(11, 3),
(12, 1),
(12, 3),
(13, 1),
(13, 3),
(14, 1),
(14, 3),
(15, 1),
(15, 3),
(16, 1),
(16, 3),
(17, 1),
(17, 3),
(18, 1),
(18, 3),
(19, 1),
(19, 3),
(20, 1),
(20, 3),
(21, 1),
(21, 3),
(22, 1),
(22, 3),
(23, 1),
(23, 3),
(24, 1),
(24, 3),
(25, 1),
(25, 3),
(26, 1),
(26, 3),
(27, 1),
(27, 3),
(28, 1),
(28, 3),
(29, 1),
(29, 3),
(30, 1),
(30, 3),
(31, 1),
(32, 1),
(32, 3),
(33, 1),
(33, 3),
(34, 1),
(34, 3),
(35, 1),
(35, 3),
(36, 1),
(36, 3),
(37, 1),
(37, 3),
(38, 1),
(38, 3),
(39, 1),
(39, 3),
(40, 1),
(40, 3),
(41, 1),
(41, 3),
(42, 1),
(42, 3),
(43, 1),
(43, 3),
(44, 1),
(44, 3),
(45, 1),
(45, 3),
(46, 1),
(46, 3),
(47, 1),
(47, 3),
(48, 1),
(48, 3),
(49, 1),
(49, 3),
(50, 1),
(50, 3),
(51, 1),
(51, 3),
(52, 1),
(52, 3),
(53, 1),
(53, 2),
(53, 4),
(54, 1),
(54, 2),
(54, 3),
(54, 4),
(55, 1),
(55, 3),
(56, 1),
(56, 3),
(57, 1),
(57, 3),
(58, 1),
(58, 3),
(59, 1),
(59, 3),
(60, 1),
(60, 4),
(61, 1),
(61, 3),
(62, 1),
(62, 3),
(63, 1),
(64, 1),
(64, 3),
(65, 1),
(65, 3),
(66, 1),
(66, 3),
(67, 1),
(67, 3),
(68, 1),
(68, 3),
(69, 1),
(69, 3),
(70, 1),
(70, 3),
(71, 1),
(71, 3),
(72, 1),
(72, 3),
(73, 1),
(73, 3),
(74, 1),
(74, 3),
(75, 1),
(75, 3),
(76, 1),
(76, 3),
(77, 1),
(77, 3),
(78, 1),
(78, 3),
(79, 1),
(79, 3),
(80, 1),
(80, 3),
(81, 1),
(81, 3),
(82, 1),
(82, 3),
(83, 1),
(83, 3),
(84, 1),
(84, 3),
(85, 1),
(85, 3),
(86, 1),
(86, 3),
(87, 1),
(87, 3),
(88, 1),
(88, 3),
(89, 1),
(89, 3),
(90, 1),
(90, 3),
(91, 1),
(91, 3),
(92, 1),
(92, 3),
(93, 1),
(93, 3),
(94, 1),
(94, 3),
(95, 1),
(95, 3),
(96, 1),
(96, 3),
(97, 1),
(97, 3),
(98, 1),
(98, 3),
(99, 1),
(99, 3),
(100, 1),
(100, 3),
(101, 1),
(101, 3),
(102, 1),
(102, 3),
(103, 1),
(103, 3),
(104, 1),
(104, 3),
(105, 1),
(105, 3),
(106, 1),
(106, 3),
(107, 1),
(107, 3),
(108, 1),
(108, 3),
(109, 1),
(109, 3),
(110, 1),
(110, 3),
(111, 1),
(111, 3),
(112, 1),
(112, 3),
(113, 1),
(113, 3),
(114, 1),
(114, 3),
(116, 1),
(116, 3),
(117, 1),
(117, 3),
(118, 1),
(118, 3),
(119, 1),
(119, 3),
(120, 1),
(120, 3),
(121, 1),
(121, 3),
(122, 1),
(122, 3),
(123, 1),
(123, 3),
(124, 1),
(124, 3),
(125, 1),
(125, 3),
(126, 1),
(126, 3),
(127, 1),
(127, 3),
(128, 1),
(128, 3),
(129, 1),
(129, 3),
(130, 1),
(130, 3),
(131, 1),
(131, 3),
(132, 1),
(132, 3),
(133, 1),
(133, 3),
(134, 1),
(134, 3),
(135, 1),
(135, 3),
(136, 1),
(136, 3),
(137, 1),
(137, 3),
(138, 1),
(138, 3),
(139, 1),
(139, 3),
(140, 1),
(140, 3),
(141, 1),
(141, 3),
(142, 1),
(142, 3),
(143, 1),
(143, 3),
(144, 1),
(144, 3),
(145, 1),
(145, 3),
(146, 1),
(146, 3),
(147, 1),
(147, 3),
(148, 1),
(148, 3),
(149, 1),
(149, 3),
(150, 1),
(150, 3),
(151, 1),
(151, 3),
(152, 1),
(152, 3),
(153, 1),
(153, 3),
(154, 1),
(154, 3),
(155, 1),
(155, 3),
(156, 1),
(156, 3),
(157, 1),
(157, 3),
(158, 1),
(158, 3),
(159, 1),
(159, 3),
(160, 1),
(160, 3),
(161, 1),
(161, 3),
(162, 1),
(162, 3),
(163, 1),
(163, 3),
(164, 1),
(164, 3),
(165, 1),
(165, 3),
(166, 1),
(166, 3),
(167, 1),
(167, 3),
(168, 1),
(168, 3),
(169, 1),
(169, 3),
(170, 1),
(170, 3),
(171, 1),
(171, 3),
(172, 1),
(172, 3),
(173, 1),
(173, 3),
(174, 1),
(174, 3),
(175, 1),
(175, 3),
(176, 1),
(176, 3),
(177, 1),
(177, 3),
(178, 1),
(178, 3),
(179, 1),
(179, 3);

--
-- 限制导出的表
--

--
-- 限制表 `flow_answers`
--
ALTER TABLE `flow_answers`
  ADD CONSTRAINT `flow_answers_ibfk_1` FOREIGN KEY (`flow_questions_id`) REFERENCES `flow_questions` (`flow_questions_id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `flow_answers_ibfk_10` FOREIGN KEY (`flow_answers_steps_option9`) REFERENCES `flow_steps_options` (`steps_options_content_id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `flow_answers_ibfk_11` FOREIGN KEY (`flow_answers_steps_option10`) REFERENCES `flow_steps_options` (`steps_options_content_id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `flow_answers_ibfk_2` FOREIGN KEY (`flow_answers_steps_option1`) REFERENCES `flow_steps_options` (`steps_options_content_id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `flow_answers_ibfk_3` FOREIGN KEY (`flow_answers_steps_option2`) REFERENCES `flow_steps_options` (`steps_options_content_id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `flow_answers_ibfk_4` FOREIGN KEY (`flow_answers_steps_option3`) REFERENCES `flow_steps_options` (`steps_options_content_id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `flow_answers_ibfk_5` FOREIGN KEY (`flow_answers_steps_option4`) REFERENCES `flow_steps_options` (`steps_options_content_id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `flow_answers_ibfk_6` FOREIGN KEY (`flow_answers_steps_option5`) REFERENCES `flow_steps_options` (`steps_options_content_id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `flow_answers_ibfk_7` FOREIGN KEY (`flow_answers_steps_option6`) REFERENCES `flow_steps_options` (`steps_options_content_id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `flow_answers_ibfk_8` FOREIGN KEY (`flow_answers_steps_option7`) REFERENCES `flow_steps_options` (`steps_options_content_id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `flow_answers_ibfk_9` FOREIGN KEY (`flow_answers_steps_option8`) REFERENCES `flow_steps_options` (`steps_options_content_id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- 限制表 `flow_exam`
--
ALTER TABLE `flow_exam`
  ADD CONSTRAINT `flow_exam_ibfk_2` FOREIGN KEY (`test_id`) REFERENCES `flow_test` (`test_id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `flow_exam_ibfk_3` FOREIGN KEY (`judge_strategy_id`) REFERENCES `flow_judge_strategy` (`judge_strategy_id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `flow_exam_ibfk_4` FOREIGN KEY (`exam_module_id`) REFERENCES `tce_modules` (`module_id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- 限制表 `flow_examination_log`
--
ALTER TABLE `flow_examination_log`
  ADD CONSTRAINT `flow_examination_log_ibfk_1` FOREIGN KEY (`users_id`) REFERENCES `tce_users` (`user_id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `flow_examination_log_ibfk_2` FOREIGN KEY (`exam_id`) REFERENCES `flow_exam` (`exam_id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `flow_examination_log_ibfk_3` FOREIGN KEY (`papers_id`) REFERENCES `flow_paper` (`paper_id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- 限制表 `flow_examlog_useransw`
--
ALTER TABLE `flow_examlog_useransw`
  ADD CONSTRAINT `flow_examlog_useransw_ibfk_1` FOREIGN KEY (`examination_log_id`) REFERENCES `flow_examination_log` (`examination_log_id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `flow_examlog_useransw_ibfk_10` FOREIGN KEY (`usersansw_steps_option9`) REFERENCES `flow_steps_options` (`steps_options_content_id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `flow_examlog_useransw_ibfk_11` FOREIGN KEY (`usersansw_steps_option10`) REFERENCES `flow_steps_options` (`steps_options_content_id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `flow_examlog_useransw_ibfk_2` FOREIGN KEY (`usersansw_steps_option1`) REFERENCES `flow_steps_options` (`steps_options_content_id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `flow_examlog_useransw_ibfk_3` FOREIGN KEY (`usersansw_steps_option2`) REFERENCES `flow_steps_options` (`steps_options_content_id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `flow_examlog_useransw_ibfk_4` FOREIGN KEY (`usersansw_steps_option3`) REFERENCES `flow_steps_options` (`steps_options_content_id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `flow_examlog_useransw_ibfk_5` FOREIGN KEY (`usersansw_steps_option4`) REFERENCES `flow_steps_options` (`steps_options_content_id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `flow_examlog_useransw_ibfk_6` FOREIGN KEY (`usersansw_steps_option5`) REFERENCES `flow_steps_options` (`steps_options_content_id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `flow_examlog_useransw_ibfk_7` FOREIGN KEY (`usersansw_steps_option6`) REFERENCES `flow_steps_options` (`steps_options_content_id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `flow_examlog_useransw_ibfk_8` FOREIGN KEY (`usersansw_steps_option7`) REFERENCES `flow_steps_options` (`steps_options_content_id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `flow_examlog_useransw_ibfk_9` FOREIGN KEY (`usersansw_steps_option8`) REFERENCES `flow_steps_options` (`steps_options_content_id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- 限制表 `flow_examlog_useransw_concept`
--
ALTER TABLE `flow_examlog_useransw_concept`
  ADD CONSTRAINT `flow_examlog_useransw_concept_ibfk_1` FOREIGN KEY (`examination_log_id`) REFERENCES `flow_examination_log` (`examination_log_id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `flow_examlog_useransw_concept_ibfk_2` FOREIGN KEY (`useransw_id`) REFERENCES `flow_answers_other` (`answers_other_id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- 限制表 `flow_exam_grade`
--
ALTER TABLE `flow_exam_grade`
  ADD CONSTRAINT `flow_exam_grade_ibfk_1` FOREIGN KEY (`examination_log_id`) REFERENCES `flow_examination_log` (`examination_log_id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- 限制表 `flow_exam_judge`
--
ALTER TABLE `flow_exam_judge`
  ADD CONSTRAINT `flow_exam_judge_ibfk_1` FOREIGN KEY (`examlog_useransw_id`) REFERENCES `flow_examlog_useransw` (`examlog_useransw_id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- 限制表 `flow_exam_paper`
--
ALTER TABLE `flow_exam_paper`
  ADD CONSTRAINT `flow_exam_paper_ibfk_1` FOREIGN KEY (`paper_id`) REFERENCES `flow_paper` (`paper_id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `flow_exam_paper_ibfk_2` FOREIGN KEY (`exam_id`) REFERENCES `flow_exam` (`exam_id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- 限制表 `flow_exam_result`
--
ALTER TABLE `flow_exam_result`
  ADD CONSTRAINT `flow_exam_result_ibfk_1` FOREIGN KEY (`users_id`) REFERENCES `tce_users` (`user_id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `flow_exam_result_ibfk_2` FOREIGN KEY (`exam_id`) REFERENCES `flow_exam` (`exam_id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `flow_exam_result_ibfk_3` FOREIGN KEY (`papers_id`) REFERENCES `flow_paper` (`paper_id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- 限制表 `flow_exam_usergroups`
--
ALTER TABLE `flow_exam_usergroups`
  ADD CONSTRAINT `flow_exam_usergroups_ibfk_1` FOREIGN KEY (`usergroups_id`) REFERENCES `tce_user_groups` (`group_id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `flow_exam_usergroups_ibfk_2` FOREIGN KEY (`exam_id`) REFERENCES `flow_exam` (`exam_id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- 限制表 `flow_judge_error`
--
ALTER TABLE `flow_judge_error`
  ADD CONSTRAINT `flow_judge_error_ibfk_1` FOREIGN KEY (`exam_id`) REFERENCES `flow_exam` (`exam_id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `flow_judge_error_ibfk_2` FOREIGN KEY (`papers_id`) REFERENCES `flow_paper` (`paper_id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `flow_judge_error_ibfk_3` FOREIGN KEY (`student_id`) REFERENCES `tce_users` (`user_id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `flow_judge_error_ibfk_4` FOREIGN KEY (`teacher_id`) REFERENCES `tce_users` (`user_id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- 限制表 `flow_makepapers_strategys`
--
ALTER TABLE `flow_makepapers_strategys`
  ADD CONSTRAINT `flow_makepapers_strategys_ibfk_1` FOREIGN KEY (`subject_id`) REFERENCES `tce_subjects` (`subject_id`) ON DELETE CASCADE ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
