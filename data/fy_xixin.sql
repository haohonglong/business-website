-- phpMyAdmin SQL Dump
-- version 4.4.15.10
-- https://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: 2019-10-30 12:24:14
-- 服务器版本： 5.7.26-log
-- PHP Version: 5.6.40

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `fy_information`
--

-- --------------------------------------------------------

--
-- 表的结构 `fy_xixin`
--

CREATE TABLE IF NOT EXISTS `fy_xixin` (
  `id` int(10) NOT NULL,
  `name` varchar(225) NOT NULL DEFAULT '' COMMENT '姓名',
  `sex` tinyint(1) NOT NULL COMMENT '1 男  2 女',
  `age` int(10) NOT NULL,
  `mingzu` varchar(225) NOT NULL DEFAULT '' COMMENT '民族',
  `unit` varchar(225) NOT NULL DEFAULT '' COMMENT '工作单位',
  `post` varchar(225) NOT NULL DEFAULT '' COMMENT '职务',
  `professor` varchar(225) NOT NULL DEFAULT '' COMMENT '职称',
  `code` varchar(225) NOT NULL DEFAULT '' COMMENT '邮编',
  `address` varchar(225) NOT NULL DEFAULT '' COMMENT '通讯地址',
  `phone` varchar(225) NOT NULL DEFAULT '' COMMENT '联系电话',
  `fax` varchar(225) NOT NULL DEFAULT '' COMMENT '传真',
  `email` varchar(225) NOT NULL DEFAULT '' COMMENT '电子邮箱',
  `lid` varchar(225) NOT NULL COMMENT '会议id(json)',
  `fate` int(10) NOT NULL DEFAULT '0' COMMENT '天数',
  `islive` int(4) NOT NULL DEFAULT '0' COMMENT '1同意 2  不同意',
  `personnum` int(10) NOT NULL DEFAULT '0' COMMENT '人数',
  `time` int(10) NOT NULL DEFAULT '0' COMMENT '来程时间',
  `flight` varchar(225) NOT NULL DEFAULT '' COMMENT '来程航班',
  `place` varchar(225) NOT NULL DEFAULT '' COMMENT '地点',
  `time1` int(10) NOT NULL DEFAULT '0' COMMENT '返程时间',
  `flight1` varchar(225) NOT NULL DEFAULT '' COMMENT '返程航班',
  `place1` varchar(225) NOT NULL DEFAULT '' COMMENT '返程地点',
  `type` tinyint(4) NOT NULL,
  `create_time` datetime NOT NULL,
  `update_time` datetime NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4;

--
-- 转存表中的数据 `fy_xixin`
--

INSERT INTO `fy_xixin` (`id`, `name`, `sex`, `age`, `mingzu`, `unit`, `post`, `professor`, `code`, `address`, `phone`, `fax`, `email`, `lid`, `fate`, `islive`, `personnum`, `time`, `flight`, `place`, `time1`, `flight1`, `place1`, `type`, `create_time`, `update_time`) VALUES
(1, '施先生', 1, 26, '汉', '中国电信', '分管副总', '领导', '400010', '重庆市', '18996186586', '400-888888', 'shishuo0315@163.com', '["1","2","3","4","5","6"]', 7, 0, 3, 1575165600, 'AIR88888', '江北国际机场', 1576828080, 'AIR88888', '江北机场', 0, '2019-10-28 23:21:20', '2019-10-28 23:21:20'),
(2, '潇洒', 1, 24, '汉', '源琪', '设计', 'UI', '638100', '重庆', '17761226714', '023-326813', '1761226714@qq.com', '["2","3"]', 3, 0, 12, 1577545260, 'D30074', '北站', 1572190080, 'D30074', '福建', 0, '2019-10-28 23:32:51', '2019-10-28 23:32:51'),
(3, '张三', 1, 28, '汉', '中国瓷器协会', '处级干部', '秘书长', '400010', '重庆市', '02367743986', '400－888888', 'shishuo0315@163.com', '["1","2","3"]', 10, 0, 2, 1571451600, '测试', '测试地点', 1571740020, '测试', '测试地址2', 0, '2019-10-28 23:33:28', '2019-10-28 23:33:28');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `fy_xixin`
--
ALTER TABLE `fy_xixin`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `fy_xixin`
--
ALTER TABLE `fy_xixin`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
CREATE TABLE IF NOT EXISTS `fy_xinxiz` (
  `id` int(10) NOT NULL,
  `xid` int(10) NOT NULL COMMENT '信息主表id',
  `name` varchar(225) NOT NULL DEFAULT '' COMMENT '信息',
  `sex` tinyint(1) NOT NULL DEFAULT '0' COMMENT '1 男  2 女',
  `post` varchar(225) NOT NULL DEFAULT '' COMMENT '职务',
  `personnum` int(10) NOT NULL DEFAULT '0' COMMENT '人数',
  `create_time` datetime NOT NULL,
  `update_time` datetime NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4;

--
-- 转存表中的数据 `fy_xinxiz`
--

INSERT INTO `fy_xinxiz` (`id`, `xid`, `name`, `sex`, `post`, `personnum`, `create_time`, `update_time`) VALUES
(1, 1, '张三', 1, '秘书', 0, '2019-10-28 23:21:20', '2019-10-28 23:21:20'),
(2, 1, '李四', 1, '部门负责人', 0, '2019-10-28 23:21:20', '2019-10-28 23:21:20'),
(3, 2, '星期五', 1, '科长', 0, '2019-10-28 23:32:51', '2019-10-28 23:32:51'),
(4, 3, '文强', 1, '科员', 0, '2019-10-28 23:33:28', '2019-10-28 23:33:28'),
(5, 4, '5', 1, '5', 0, '2019-10-29 17:50:31', '2019-10-29 17:50:31');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `fy_xinxiz`
--
ALTER TABLE `fy_xinxiz`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `fy_xinxiz`
--
ALTER TABLE `fy_xinxiz`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
