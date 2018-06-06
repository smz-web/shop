-- phpMyAdmin SQL Dump
-- version phpStudy 2014
-- http://www.phpmyadmin.net
--
-- 主机: localhost
-- 生成日期: 2018 �?05 �?24 �?04:15
-- 服务器版本: 5.5.53
-- PHP 版本: 5.6.27

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- 数据库: `shop`
--

-- --------------------------------------------------------

--
-- 表的结构 `shop_article`
--

CREATE TABLE IF NOT EXISTS `shop_article` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(30) NOT NULL COMMENT '标题',
  `keywords` varchar(100) NOT NULL COMMENT '关键词',
  `descript` varchar(255) NOT NULL COMMENT '简介',
  `author` varchar(10) NOT NULL COMMENT '作者',
  `thumb` varchar(100) NOT NULL COMMENT '缩略图',
  `email` varchar(20) NOT NULL COMMENT '邮箱',
  `link` varchar(60) NOT NULL COMMENT '外链地址',
  `content` text NOT NULL COMMENT '文章内容',
  `status` smallint(1) unsigned NOT NULL DEFAULT '1' COMMENT '是否显示',
  `sort` smallint(5) unsigned NOT NULL DEFAULT '50' COMMENT '排序',
  `addtime` varchar(60) NOT NULL COMMENT '添加时间',
  `cate_id` mediumint(9) NOT NULL COMMENT '上级id',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=12 ;

--
-- 转存表中的数据 `shop_article`
--

INSERT INTO `shop_article` (`id`, `title`, `keywords`, `descript`, `author`, `thumb`, `email`, `link`, `content`, `status`, `sort`, `addtime`, `cate_id`) VALUES
(8, '系统文章', '', '', '苏晓尘', '20180513\\375ffd77e42ac946e587200f32be065a.jpg', '', '', '', 1, 51, '', 1),
(9, '新手上路文章', '', '', '苏晓尘', '20180513\\88b3bb2eba0da5ea879728e1883b0df0.jpg', '', '', '', 1, 50, '', 10),
(10, '网店帮助文章', '', '', '苏晓尘', '20180513\\284ce5d736177c9b52acaf0256d71dac.jpg', '', '', '', 1, 50, '', 4),
(11, '系统内文章2', '', '', '苏晓尘', '', '', '', '', 1, 50, '', 1);

-- --------------------------------------------------------

--
-- 表的结构 `shop_attr`
--

CREATE TABLE IF NOT EXISTS `shop_attr` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `attr_name` varchar(30) NOT NULL COMMENT '属性名称',
  `attr_type` tinyint(3) unsigned NOT NULL DEFAULT '1' COMMENT '1:唯一 2:单选',
  `values` varchar(255) NOT NULL COMMENT '属性值',
  `pid` smallint(5) unsigned NOT NULL COMMENT '所属类型',
  `sort` smallint(5) unsigned NOT NULL DEFAULT '50' COMMENT '排序',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=18 ;

--
-- 转存表中的数据 `shop_attr`
--

INSERT INTO `shop_attr` (`id`, `attr_name`, `attr_type`, `values`, `pid`, `sort`) VALUES
(4, '主色调', 2, '蓝色,白色,黑色,棕色', 2, 50),
(5, '花纹', 2, '龙纹,虎纹', 2, 50),
(6, '使用寿命', 1, '', 3, 50),
(7, '保修日期', 1, '', 3, 50),
(8, '保质期', 1, '', 4, 50),
(9, '防腐剂', 1, '', 4, 50),
(12, '容量', 2, '100t,200t,300t', 3, 50),
(14, '风格', 2, '炫酷,可爱,古风,二次元,美丽', 3, 50),
(15, '尺码', 2, 'XXS,XS,S,M,L,XL,XXL', 2, 50),
(16, '面料', 1, '皮革', 2, 50),
(17, '水洗', 1, '可以', 2, 50);

-- --------------------------------------------------------

--
-- 表的结构 `shop_brand`
--

CREATE TABLE IF NOT EXISTS `shop_brand` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `brand_name` varchar(60) NOT NULL COMMENT '品牌名称',
  `brand_url` varchar(60) NOT NULL COMMENT '品牌网址',
  `brand_desc` varchar(200) NOT NULL COMMENT '品牌简介',
  `brand_img` varchar(60) NOT NULL COMMENT '品牌logo缩略图地址',
  `brand_sort` smallint(5) unsigned NOT NULL DEFAULT '50' COMMENT '排序',
  `brand_status` smallint(1) unsigned NOT NULL DEFAULT '1' COMMENT '状态',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=15 ;

--
-- 转存表中的数据 `shop_brand`
--

INSERT INTO `shop_brand` (`id`, `brand_name`, `brand_url`, `brand_desc`, `brand_img`, `brand_sort`, `brand_status`) VALUES
(11, '特步', '', '', '', 50, 1),
(12, '坚果', '', '', '', 50, 1),
(13, '优衣库', '', '', '', 50, 1),
(14, '未知', '', '', '', 1, 1);

-- --------------------------------------------------------

--
-- 表的结构 `shop_cate`
--

CREATE TABLE IF NOT EXISTS `shop_cate` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `cate_name` varchar(60) NOT NULL COMMENT '栏目名称',
  `cate_type` smallint(1) unsigned NOT NULL DEFAULT '5' COMMENT '1:系统分类 2:帮助分类 3:网店帮助 4:网店信息 5:普通分类',
  `keywords` varchar(100) NOT NULL COMMENT '关键词',
  `descript` varchar(255) NOT NULL COMMENT '简介',
  `show_nav` smallint(1) unsigned NOT NULL DEFAULT '0' COMMENT '1:显示在导航 0:不显示在导航',
  `sort` smallint(5) unsigned NOT NULL DEFAULT '50' COMMENT '排序',
  `pid` mediumint(8) unsigned NOT NULL COMMENT '上级id',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=11 ;

--
-- 转存表中的数据 `shop_cate`
--

INSERT INTO `shop_cate` (`id`, `cate_name`, `cate_type`, `keywords`, `descript`, `show_nav`, `sort`, `pid`) VALUES
(1, '系统', 1, '系统分类关键词', '这是系统分类\r\n', 0, 3, 0),
(3, '帮助分类', 2, '', '', 0, 50, 0),
(4, '网店帮助', 3, '', '', 0, 50, 0),
(5, '网店信息', 4, '', '', 0, 50, 0),
(9, '普通栏目', 5, '', '', 0, 50, 0),
(10, '新手上路', 5, '', '', 0, 50, 3);

-- --------------------------------------------------------

--
-- 表的结构 `shop_category`
--

CREATE TABLE IF NOT EXISTS `shop_category` (
  `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `cate_name` varchar(30) NOT NULL COMMENT '分类名称',
  `cate_img` varchar(60) NOT NULL COMMENT '分类图片',
  `keywords` varchar(60) NOT NULL COMMENT '关键词',
  `desc` varchar(200) NOT NULL COMMENT '简介',
  `show_nav` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '1:显示 2:隐藏',
  `sort` tinyint(3) unsigned NOT NULL DEFAULT '50' COMMENT '排序',
  `pid` smallint(5) unsigned NOT NULL DEFAULT '0' COMMENT '上级id',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=13 ;

--
-- 转存表中的数据 `shop_category`
--

INSERT INTO `shop_category` (`id`, `cate_name`, `cate_img`, `keywords`, `desc`, `show_nav`, `sort`, `pid`) VALUES
(5, '服饰', '', '', '', 0, 1, 0),
(6, '女装', '', '', '', 0, 50, 5),
(7, '男装', '', '', '', 0, 50, 5),
(8, '童装', '', '', '', 0, 50, 5),
(9, '电子物品', '', '', '', 0, 2, 0),
(10, '手机', '', '', '', 0, 50, 9),
(11, '电脑', '', '', '', 0, 50, 9),
(12, '食品', '', '', '', 0, 3, 0);

-- --------------------------------------------------------

--
-- 表的结构 `shop_commodity`
--

CREATE TABLE IF NOT EXISTS `shop_commodity` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(30) NOT NULL COMMENT '商品名称',
  `code` char(16) NOT NULL COMMENT '商品编号',
  `picture` varchar(100) NOT NULL COMMENT '商品缩略图',
  `big_picture` varchar(100) NOT NULL COMMENT '商品大缩略图',
  `medium_picture` varchar(100) NOT NULL COMMENT '中等图片',
  `small_picture` varchar(100) NOT NULL COMMENT '商品小缩略图',
  `market_price` decimal(10,2) NOT NULL COMMENT '市场价',
  `ours_price` decimal(10,2) NOT NULL COMMENT '价格',
  `status` tinyint(3) unsigned NOT NULL COMMENT '是否上架',
  `sort` tinyint(3) unsigned NOT NULL DEFAULT '50' COMMENT '排序',
  `type_id` mediumint(8) unsigned NOT NULL COMMENT '所属类型',
  `category_id` mediumint(8) unsigned NOT NULL COMMENT '所属栏目',
  `brand_id` mediumint(8) unsigned DEFAULT '0' COMMENT '所属品牌',
  `content` longtext NOT NULL COMMENT '商品简介',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=54 ;

--
-- 转存表中的数据 `shop_commodity`
--

INSERT INTO `shop_commodity` (`id`, `name`, `code`, `picture`, `big_picture`, `medium_picture`, `small_picture`, `market_price`, `ours_price`, `status`, `sort`, `type_id`, `category_id`, `brand_id`, `content`) VALUES
(50, '这是一件玉树临风的衣衫', '1527080320', '', '', '', '', '0.00', '9999.00', 1, 1, 0, 5, 14, '<p>这件衣服超棒儿<br/></p>'),
(51, '随便手机', '1527125238', '', '', '', '', '0.00', '100.00', 1, 50, 0, 9, 14, '<p>12312312<br/></p>'),
(53, '12321', '1527131875', '', '', '', '', '0.00', '123.00', 1, 50, 0, 5, 14, '<p>123<br/></p>');

-- --------------------------------------------------------

--
-- 表的结构 `shop_commodity_attr`
--

CREATE TABLE IF NOT EXISTS `shop_commodity_attr` (
  `id` mediumint(9) NOT NULL AUTO_INCREMENT,
  `commodity_id` mediumint(8) unsigned DEFAULT NULL COMMENT '所属商品id',
  `attr_id` mediumint(8) unsigned DEFAULT NULL COMMENT '属性id',
  `attr_value` varchar(60) NOT NULL COMMENT '属性值',
  `attr_price` decimal(10,2) unsigned DEFAULT NULL COMMENT '属性价格',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=74 ;

--
-- 转存表中的数据 `shop_commodity_attr`
--

INSERT INTO `shop_commodity_attr` (`id`, `commodity_id`, `attr_id`, `attr_value`, `attr_price`) VALUES
(40, 50, 16, '皮革', NULL),
(41, 50, 17, '可以', NULL),
(42, 50, 4, '蓝色', '0.00'),
(43, 50, 4, '白色', '0.00'),
(44, 50, 4, '黑色', '0.00'),
(45, 50, 4, '棕色', '0.00'),
(46, 50, 5, '龙纹', '100.00'),
(47, 50, 5, '虎纹', '0.00'),
(48, 50, 15, 'XXS', '0.00'),
(49, 50, 15, 'XS', '0.00'),
(50, 50, 15, 'S', '0.00'),
(51, 50, 15, 'M', '0.00'),
(52, 50, 15, 'L', '0.00'),
(53, 50, 15, 'XL', '0.00'),
(54, 50, 15, 'XXL', '0.00'),
(55, 51, 6, '10年', NULL),
(56, 51, 7, '1年', NULL),
(57, 51, 12, '100t', '0.00'),
(58, 51, 12, '200t', '100.00'),
(59, 51, 14, '可爱', '0.00'),
(60, 51, 14, '可爱', '0.00'),
(61, 51, 14, '古风', '0.00'),
(62, 52, 6, '21', NULL),
(63, 52, 7, '12', NULL),
(64, 52, 12, '100t', '1.00'),
(65, 52, 12, '200t', '2.00'),
(66, 52, 14, '炫酷', '3.00'),
(67, 52, 14, '可爱', '4.00'),
(68, 53, 6, '123', NULL),
(69, 53, 7, '1234', NULL),
(70, 53, 12, '100t', '124.00'),
(71, 53, 12, '200t', '21.00'),
(72, 53, 12, '300t', '21.00'),
(73, 53, 14, '炫酷', '12.00');

-- --------------------------------------------------------

--
-- 表的结构 `shop_commodity_mprice`
--

CREATE TABLE IF NOT EXISTS `shop_commodity_mprice` (
  `level_id` smallint(5) unsigned DEFAULT NULL COMMENT '所属会员级别id',
  `commodity_id` mediumint(8) unsigned DEFAULT NULL COMMENT '所属商品id',
  `member_price` decimal(10,2) DEFAULT NULL COMMENT '价格'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `shop_commodity_picture`
--

CREATE TABLE IF NOT EXISTS `shop_commodity_picture` (
  `commodity_id` mediumint(8) unsigned NOT NULL COMMENT '所属商品id',
  `picture` varchar(100) NOT NULL COMMENT '原图',
  `big_picture` varchar(100) NOT NULL COMMENT '大图',
  `medium_picture` varchar(100) NOT NULL COMMENT '中图',
  `small_picture` varchar(100) NOT NULL COMMENT '小图'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `shop_commodity_stock`
--

CREATE TABLE IF NOT EXISTS `shop_commodity_stock` (
  `commodity_id` mediumint(8) unsigned NOT NULL COMMENT '商品ID',
  `value` mediumint(8) unsigned NOT NULL COMMENT '库存量',
  `attr_id` varchar(20) NOT NULL COMMENT '所属属性id'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `shop_commodity_stock`
--

INSERT INTO `shop_commodity_stock` (`commodity_id`, `value`, `attr_id`) VALUES
(50, 0, '42'),
(50, 0, '43'),
(50, 0, '42'),
(50, 0, '43'),
(50, 100, '42'),
(50, 100, '42'),
(50, 100, '43'),
(50, 100, '43'),
(50, 100, '44'),
(50, 100, '44'),
(52, 2, '65,66'),
(52, 2, '65,67'),
(52, 3, '64,67'),
(52, 4, '64,66'),
(52, 1, '65,66'),
(52, 2, '65,67'),
(52, 3, '64,67'),
(52, 4, '64,66'),
(51, 1, '57,59'),
(51, 100, '57,61'),
(51, 50, '58,59'),
(51, 100, '57,61'),
(53, 2, '70,73'),
(53, 2, '70,73'),
(53, 5, '70,73');

-- --------------------------------------------------------

--
-- 表的结构 `shop_conf`
--

CREATE TABLE IF NOT EXISTS `shop_conf` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(30) NOT NULL COMMENT '配置标题',
  `name` varchar(30) NOT NULL COMMENT '配置代码名',
  `area` smallint(1) unsigned NOT NULL DEFAULT '1' COMMENT '1:店铺管理 2:商品管理',
  `mold` varchar(10) NOT NULL COMMENT '配置类型',
  `value` varchar(255) NOT NULL COMMENT '默认值',
  `values` varchar(255) NOT NULL COMMENT '可选值',
  `sort` smallint(5) unsigned NOT NULL DEFAULT '50' COMMENT '排序',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=9 ;

--
-- 转存表中的数据 `shop_conf`
--

INSERT INTO `shop_conf` (`id`, `title`, `name`, `area`, `mold`, `value`, `values`, `sort`) VALUES
(2, '站点名称', 'title', 1, 'text', '2131', '', 65535),
(3, '站点状态', 'status', 1, 'radio', '关', '开,关', 20),
(4, '站点关键词', 'keywords', 1, 'text', '222', '', 50),
(5, '站点介绍', 'description', 1, 'textarea', '站点介绍1', '', 50),
(6, '测试下拉', 'selected', 1, 'select', '3', '1,2,3,4', 50),
(7, '测试复选', 'checkbox', 1, 'checkbox', '1,2,3', '1,2,3,4', 50),
(8, '测试文件', 'file', 1, 'file', '20180515\\7d1eb5e9c3ba40f6d93999c522f91c41.jpg', '', 50);

-- --------------------------------------------------------

--
-- 表的结构 `shop_link`
--

CREATE TABLE IF NOT EXISTS `shop_link` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(30) NOT NULL COMMENT '链接标题',
  `link` varchar(60) NOT NULL COMMENT '链接地址',
  `name` varchar(30) NOT NULL COMMENT '链接名称',
  `comment` varchar(200) NOT NULL COMMENT '备注',
  `status` tinyint(3) unsigned NOT NULL DEFAULT '1' COMMENT '1:开启 0:关闭',
  `sort` smallint(5) unsigned NOT NULL DEFAULT '50' COMMENT '排序',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- 转存表中的数据 `shop_link`
--

INSERT INTO `shop_link` (`id`, `title`, `link`, `name`, `comment`, `status`, `sort`) VALUES
(2, '1', 'http://1', '11', '23333', 1, 50);

-- --------------------------------------------------------

--
-- 表的结构 `shop_member_level`
--

CREATE TABLE IF NOT EXISTS `shop_member_level` (
  `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `level_name` varchar(30) NOT NULL COMMENT '级别名称',
  `bottom_integral` int(10) unsigned NOT NULL COMMENT '最低积分',
  `top_integral` int(10) unsigned NOT NULL COMMENT '最高积分',
  `discount` tinyint(3) unsigned NOT NULL COMMENT '折扣率',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=9 ;

--
-- 转存表中的数据 `shop_member_level`
--

INSERT INTO `shop_member_level` (`id`, `level_name`, `bottom_integral`, `top_integral`, `discount`) VALUES
(1, '注册会员', 0, 99, 100),
(3, '白银会员', 300, 599, 100),
(4, '黄金会员', 600, 999, 100),
(5, '白金会员', 1000, 1999, 100),
(6, '砖石会员', 2000, 2999, 100),
(7, '超级会员', 3500, 5999, 100),
(8, '会员', 100, 299, 100);

-- --------------------------------------------------------

--
-- 表的结构 `shop_type`
--

CREATE TABLE IF NOT EXISTS `shop_type` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `type_name` varchar(30) NOT NULL COMMENT '商品类型名称',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- 转存表中的数据 `shop_type`
--

INSERT INTO `shop_type` (`id`, `type_name`) VALUES
(2, '男衣'),
(3, '电子产品'),
(4, '食品'),
(5, '虚拟货物');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
