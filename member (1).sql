-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- 主機： 127.0.0.1
-- 產生時間： 
-- 伺服器版本： 10.4.11-MariaDB
-- PHP 版本： 7.4.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- 資料庫： `group_project`
--

-- --------------------------------------------------------

--
-- 資料表結構 `member`
--

CREATE TABLE `member` (
  `SId` char(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Name` varchar(5) COLLATE utf8mb4_unicode_ci NOT NULL,
  `NickName` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '匿名',
  `Friend` char(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Integral` int(2) DEFAULT NULL,
  `Password` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0000',
  `email` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'u06xu4@gmail.com'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- 傾印資料表的資料 `member`
--

INSERT INTO `member` (`SId`, `Name`, `NickName`, `Friend`, `Integral`, `Password`, `email`) VALUES
('B031020001', '華晨宇', '華晨宇(花花)', NULL, NULL, '0000', 'u06xu4@gmail.com'),
('B031020002', '吳青峰', '青峰', NULL, NULL, '0000', 'u06xu4@gmail.com'),
('B031060002', '李仁浩', '視覺效果藝術家李仁浩', NULL, NULL, '0000', 'u06xu4@gmail.com'),
('B033040053', '彭錦銘', '澎澎', NULL, NULL, '0000', 'u06xu4@gmail.com'),
('B044020025', '陳耀融', '孟儒的寶貝', NULL, NULL, '0000', 'u06xu4@gmail.com'),
('B052030059', '韓素希', '韓素希', NULL, NULL, '0000', 'u06xu4@gmail.com'),
('B054011032', '洪雅珊', '姍姍來遲', NULL, NULL, '0000', 'u06xu4@gmail.com'),
('B061010018', '簡孟倪', '夢夢', NULL, NULL, '0000', 'u06xu4@gmail.com'),
('B061020047', '郭佳偲', '佳佳', NULL, NULL, '0000', 'u06xu4@gmail.com'),
('B063021019', '陳詠平', '匿名', NULL, NULL, '0000', 'u06xu4@gmail.com'),
('B063021038', '陳傳安', '匿名', NULL, NULL, '0000', 'u06xu4@gmail.com'),
('B071020001', '郭韋辰', '匿名', NULL, NULL, '0000', 'u06xu4@gmail.com'),
('B071020016', '藍于軒', '學霸', NULL, NULL, '0000', 'u06xu4@gmail.com'),
('B071020033', '陳時遠', '匿名', NULL, NULL, '0000', 'u06xu4@gmail.com'),
('B072020005', '南柱赫', '南柱赫', NULL, NULL, '0000', 'u06xu4@gmail.com'),
('B073022010', '黃品振', '匿名', NULL, NULL, '0000', 'u06xu4@gmail.com'),
('B073022021', '黃邦晏', '匿名', NULL, NULL, '0000', 'u06xu4@gmail.com'),
('B073022024', '鄭宇辰', '匿名', NULL, NULL, '0000', 'u06xu4@gmail.com'),
('B073022025', '邱昱程', '匿名', NULL, NULL, '0000', 'u06xu4@gmail.com'),
('B073022026', '紀冠仲', '匿名', NULL, NULL, '0000', 'u06xu4@gmail.com'),
('B073040047', '楊志璿', '匿名', NULL, NULL, '0000', 'u06xu4@gmail.com'),
('B073090008', '蔡緒恩', '匿名', NULL, NULL, '0000', 'u06xu4@gmail.com'),
('B073090012', '張郁淇', '匿名', NULL, NULL, '0000', 'u06xu4@gmail.com'),
('B073090020', '陳侑欣', '匿名', NULL, NULL, '0000', 'u06xu4@gmail.com'),
('B073090027', '楊凱鈞', '匿名', NULL, NULL, '0000', 'u06xu4@gmail.com'),
('B073090030', '解子毅', '匿名', NULL, NULL, '0000', 'u06xu4@gmail.com'),
('B073100008', '陳彥婷', '匿名', NULL, NULL, '0000', 'u06xu4@gmail.com'),
('B073100018', '李宜臻', '匿名', NULL, NULL, '0000', 'u06xu4@gmail.com'),
('B073100025', '林哲遠', '匿名', NULL, NULL, '0000', 'u06xu4@gmail.com'),
('B073100035', '賴玟妤', '匿名', NULL, NULL, '0000', 'u06xu4@gmail.com'),
('B074011008', '陳冠豪', '匿名', NULL, NULL, '0000', 'u06xu4@gmail.com'),
('B074011028', '林子傑', '匿名', NULL, NULL, '0000', 'u06xu4@gmail.com'),
('B074012031', '李宜潔', '匿名', NULL, NULL, '0000', 'u06xu4@gmail.com'),
('B074020001', '吳虹燕', '小燕子', NULL, NULL, '0000', 'u06xu4@gmail.com'),
('B074020002', '林育萱', '萱萱', NULL, NULL, '0000', 'u06xu4@gmail.com'),
('B074020003', '胡予瑄', '鬍子', NULL, NULL, '0000', 'u06xu4@gmail.com'),
('B074020004', '蔡宜庭', '庭庭', NULL, NULL, '0000', 'u06xu4@gmail.com'),
('B074020005', '甘家菱', '阿甘', NULL, NULL, '0000', 'u06xu4@gmail.com'),
('B074020006', '胡哲思', '思哲', NULL, NULL, '0000', 'u06xu4@gmail.com'),
('B074020007', '徐啟軒', '阿軒', NULL, NULL, '0000', 'u06xu4@gmail.com'),
('B074020008', '鄭名圻', '公子', NULL, NULL, '0000', 'u06xu4@gmail.com'),
('B074020009', '曾奕瑄', '曾曾', NULL, NULL, '0000', 'u06xu4@gmail.com'),
('B074020010', '林宜璇', '宜璇', NULL, NULL, '0000', 'u06xu4@gmail.com'),
('B074020012', '陳柏言', '言哥', NULL, NULL, '0000', 'u06xu4@gmail.com'),
('B074020013', '林孟儒', '欠怒', NULL, NULL, '0000', 'u06xu4@gmail.com'),
('B074020015', '李瑋宸', '宸宸', NULL, NULL, '0000', 'u06xu4@gmail.com'),
('B074020016', '侯登耀', '阿登', NULL, NULL, '0000', 'u06xu4@gmail.com'),
('B074020017', '杜俞萱', '杜杜', NULL, NULL, '0000', 'u06xu4@gmail.com'),
('B074020018', '張芳瑜', '阿芳', NULL, NULL, '0000', 'u06xu4@gmail.com'),
('B074020019', '許瀚元', '元元', NULL, NULL, '0000', 'u06xu4@gmail.com'),
('B074020020', '林于暄', '包', NULL, NULL, '0000', 'u06xu4@gmail.com'),
('B074020021', '林子紘', '紫紅', NULL, NULL, '0000', 'u06xu4@gmail.com'),
('B074020022', '李祐陞', '幼幼', NULL, NULL, '0000', 'u06xu4@gmail.com'),
('B074020023', '劉晏彤', '晏彤', NULL, NULL, '0000', 'u06xu4@gmail.com'),
('B074020024', '陳智原', '智哥', NULL, NULL, '0000', 'u06xu4@gmail.com'),
('B074020025', '葉家銓', '家犬', NULL, NULL, '0000', 'u06xu4@gmail.com'),
('B074020027', '黃佑鈞', '巧飛思', NULL, NULL, '0000', 'u06xu4@gmail.com'),
('B074020029', '陳光泓', '小光', NULL, NULL, '0000', 'u06xu4@gmail.com'),
('B074020030', '施怡安', '施大安', NULL, NULL, '0000', 'u06xu4@gmail.com'),
('B074020031', '吳咨賢', '咨賢', NULL, NULL, '0000', 'u06xu4@gmail.com'),
('B074020032', '顏利', 'zico拉拉拉', NULL, NULL, '0000', 'u06xu4@gmail.com'),
('B074020033', '蔡尚諺', '小菜', NULL, NULL, '0000', 'u06xu4@gmail.com'),
('B074020035', '張瓊之', '之之', NULL, NULL, '0000', 'u06xu4@gmail.com'),
('B074020036', '黃彥翔', '翔翔', NULL, NULL, '0000', 'u06xu4@gmail.com'),
('B074020037', '陳柏豪', '柏豪', NULL, NULL, '0000', 'u06xu4@gmail.com'),
('B074020038', '劉易承', 'Liu', NULL, NULL, '0000', 'u06xu4@gmail.com'),
('B074020039', '王菩恩', '陪恩', NULL, NULL, '0000', 'u06xu4@gmail.com'),
('B074020040', '林霈瑄', '霈霈', NULL, NULL, '0000', 'u06xu4@gmail.com'),
('B074020041', '黃亭諺', '亭諺', NULL, NULL, '0000', 'u06xu4@gmail.com'),
('B074020042', '卓裕超', 'york', NULL, NULL, '0000', 'u06xu4@gmail.com'),
('B074020043', '楊佳真', '真真', NULL, NULL, '0000', 'u06xu4@gmail.com'),
('B074020044', '康芸瑄', '康康', NULL, NULL, '0000', 'u06xu4@gmail.com'),
('B074020045', '余昌旻', 'fish', NULL, NULL, '0000', 'u06xu4@gmail.com'),
('B074020046', '何允中', '允中', NULL, NULL, '0000', 'u06xu4@gmail.com'),
('B074020047', '鄭乃禎', '珍珠', NULL, NULL, '0000', 'u06xu4@gmail.com'),
('B074020048', '黃于千', '魚籤', NULL, NULL, '0000', 'u06xu4@gmail.com'),
('B074020049', '黃秀伶', 'esther', NULL, NULL, '0000', 'u06xu4@gmail.com'),
('B074020050', '黃襄傑', '襄襄', NULL, NULL, '0000', 'u06xu4@gmail.com'),
('B074020051', '蕭順景', 'ivan', NULL, NULL, '0000', 'u06xu4@gmail.com'),
('B074020052', '陳秋贊', 'jason', NULL, NULL, '0000', 'u06xu4@gmail.com'),
('B074020053', '譚雯琳', 'gabby', NULL, NULL, '0000', 'u06xu4@gmail.com'),
('B074020054', '林將明', 'masaki', NULL, NULL, '0000', 'u06xu4@gmail.com'),
('B074020056', '廖仕雅', '仕雅', NULL, NULL, '0000', 'u06xu4@gmail.com'),
('B074020057', '林韋翰', '韋翰', NULL, NULL, '0000', 'u06xu4@gmail.com'),
('B074020059', '陳昶叡', '廠廠', NULL, NULL, '0000', 'u06xu4@gmail.com'),
('B074020060', '黃瀚程', '阿程', NULL, NULL, '0000', 'u06xu445@gmail.com'),
('B074030023', '陳佳宜', '佳宜', NULL, NULL, '0000', 'u06xu4@gmail.com'),
('B075020041', '翁浥軒', '匿名', NULL, NULL, '0000', 'u06xu4@gmail.com'),
('B075090041', '林澄緯', '匿名', NULL, NULL, '0000', 'u06xu4@gmail.com'),
('B076060050', '劉昌豪', '匿名', NULL, NULL, '0000', 'u06xu4@gmail.com'),
('B084020002', '周明楓', '匿名', NULL, NULL, '0000', 'u06xu4@gmail.com'),
('B084020003', '張景淳', '匿名', NULL, NULL, '0000', 'u06xu4@gmail.com'),
('B084020004', '林冠沛', '匿名', NULL, NULL, '0000', 'u06xu4@gmail.com'),
('B084020006', '林婕馡', '匿名', NULL, NULL, '0000', 'u06xu4@gmail.com'),
('B084020008', '李亭熙', '匿名', NULL, NULL, '0000', 'u06xu4@gmail.com'),
('B084020011', '吳蕎安', '匿名', NULL, NULL, '0000', 'u06xu4@gmail.com'),
('B084020012', '周韻文', '匿名', NULL, NULL, '0000', 'u06xu4@gmail.com'),
('B084020014', '鄭惠方', '匿名', NULL, NULL, '0000', 'u06xu4@gmail.com'),
('B1234567', '張瓊之', '之之', NULL, NULL, '1234', 'u06xu4@gmail.com'),
('M084050001', '程子棠', '匿名', NULL, NULL, '0000', 'u06xu4@gmail.com'),
('M084050004', '莊孟婕', '匿名', NULL, NULL, '0000', 'u06xu4@gmail.com'),
('M084050006', '張騏媛', '匿名', NULL, NULL, '0000', 'u06xu4@gmail.com');

--
-- 已傾印資料表的索引
--

--
-- 資料表索引 `member`
--
ALTER TABLE `member`
  ADD PRIMARY KEY (`SId`),
  ADD KEY `member_ibfk_1` (`Friend`);

--
-- 已傾印資料表的限制式
--

--
-- 資料表的限制式 `member`
--
ALTER TABLE `member`
  ADD CONSTRAINT `member_ibfk_1` FOREIGN KEY (`Friend`) REFERENCES `member` (`SId`) ON DELETE SET NULL ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
