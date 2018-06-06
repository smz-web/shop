-- phpMyAdmin SQL Dump
-- version phpStudy 2014
-- http://www.phpmyadmin.net
--
-- 主机: localhost
-- 生成日期: 2018 �?06 �?06 �?13:33
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
  `foot_show` tinyint(3) unsigned NOT NULL COMMENT '1:底部显示 2:底部不显示',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=28 ;

--
-- 转存表中的数据 `shop_article`
--

INSERT INTO `shop_article` (`id`, `title`, `keywords`, `descript`, `author`, `thumb`, `email`, `link`, `content`, `status`, `sort`, `addtime`, `cate_id`, `foot_show`) VALUES
(12, '售后流程', '', '', '苏晓尘', '', '', '', '<p>售后流程售后流程售后流程售后流程<br/></p>', 1, 50, '', 13, 1),
(13, '购物流程', '', '', '苏晓尘', '', '', '', '<p>购物流程购物流程购物流程</p>', 1, 50, '', 13, 1),
(14, '订购方式', '', '', '苏晓尘', '', '', '', '<p>订购方式订购方式订购方式订购方式订购方式订购方式</p>', 1, 50, '', 13, 1),
(15, '配送支付智能查询', '', '', '苏晓尘', '', '', '', '<p>配送支付智能查询配送支付智能查询配送支付智能查询配送支付智能查询</p>', 1, 50, '', 14, 1),
(16, '货到付款区域', '', '', '苏晓尘', '', '', '', '货到付款区域货到付款区域货到付款区域货到付款区域<br/>', 1, 50, '', 14, 1),
(17, '支付方式说明', '', '', '苏晓尘', '', '', '', '支付方式说明支付方式说明支付方式说明支付方式说明<br/>', 1, 50, '', 14, 1),
(18, '会员说明', '', '', '苏晓尘', '', '', '', '<p>会员说明会员说明会员说明会员说明会员说明会员说明会员说明</p>', 1, 50, '', 17, 1),
(19, '会员等级', '', '', '苏晓尘', '', '', '', '<p>会员等级会员等级会员等级会员等级会员等级会员等级</p>', 1, 50, '', 17, 1),
(20, '退换货原则', '', '', '苏晓尘', '', '', '', '<p>退换货原则退换货原则退换货原则</p>', 1, 50, '', 15, 1),
(21, '售后服务保证', '', '', '苏晓尘', '', '', '', '售后服务保证售后服务保证售后服务保证售后服务保证<br/>', 1, 50, '', 15, 1),
(22, '产品质量保证', '', '', '苏晓尘', '', '', '', '产品质量保证产品质量保证产品质量保证<br/>', 1, 50, '', 15, 1),
(23, '网站故障报告', '', '', '苏晓尘', '', '', '', '<p>网站故障报告网站故障报告网站故障报告网站故障报告</p>', 1, 50, '', 16, 1),
(24, '选机咨询', '', '', '苏晓尘', '', '', '', '<p>选机咨询选机咨询选机咨询选机咨询选机咨询</p>', 1, 50, '', 16, 1),
(25, '投诉与建议', '', '', '苏晓尘', '', '', '', '<p>投诉与建议投诉与建议投诉与建议投诉与建议投诉与建议投诉与建议</p>', 1, 50, '', 16, 1),
(26, '隐私保护 ', '', '', '苏晓尘', '', '', '', '<p>隐私保护 <br/>隐私保护 <br/>隐私保护 <br/>隐私保护 <br/></p>', 1, 50, '', 1, 1),
(27, '免责条款 ', '', '', '苏晓尘', '', '', '', '免责条款 <br/>免责条款 <br/>免责条款 <br/>免责条款 <br/>免责条款 <br/><br/>', 1, 50, '', 1, 1);

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
  `cate_type` smallint(1) unsigned NOT NULL DEFAULT '5' COMMENT '1:系统分类 5:普通分类',
  `keywords` varchar(100) NOT NULL COMMENT '关键词',
  `descript` varchar(255) NOT NULL COMMENT '简介',
  `show_nav` smallint(1) unsigned NOT NULL DEFAULT '0' COMMENT '1:显示在导航 0:不显示在导航',
  `sort` smallint(5) unsigned NOT NULL DEFAULT '50' COMMENT '排序',
  `pid` mediumint(8) unsigned NOT NULL COMMENT '上级id',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=19 ;

--
-- 转存表中的数据 `shop_cate`
--

INSERT INTO `shop_cate` (`id`, `cate_name`, `cate_type`, `keywords`, `descript`, `show_nav`, `sort`, `pid`) VALUES
(1, '系统', 1, '系统分类关键词', '这是系统分类\r\n', 0, 1, 0),
(13, '新手上路', 5, '', '', 1, 1, 1),
(14, '配送与支付', 5, '', '', 1, 2, 1),
(15, '服务保证', 5, '', '', 1, 4, 1),
(16, '联系我们', 5, '', '', 1, 5, 1),
(17, '会员中心', 5, '', '', 1, 3, 1),
(18, '推荐好文', 5, '', '', 0, 50, 0);

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=26 ;

--
-- 转存表中的数据 `shop_category`
--

INSERT INTO `shop_category` (`id`, `cate_name`, `cate_img`, `keywords`, `desc`, `show_nav`, `sort`, `pid`) VALUES
(15, '家用电器', '', '', '', 1, 50, 0),
(16, '大家电', '', '', '', 1, 50, 15),
(17, '生活家电', '', '', '', 1, 50, 15),
(18, '智能设备', '', '', '', 1, 50, 0),
(19, '手机', '', '', '', 1, 50, 18),
(20, '洗衣机', '', '', '', 0, 50, 16),
(21, '空调', '', '', '', 0, 50, 16),
(22, '热水器', '', '', '', 0, 50, 16),
(23, '电风扇', '', '', '', 0, 50, 17),
(24, '扫地机器人', '', '', '', 0, 50, 17),
(25, '插座', '', '', '', 0, 50, 17);

-- --------------------------------------------------------

--
-- 表的结构 `shop_category_relation`
--

CREATE TABLE IF NOT EXISTS `shop_category_relation` (
  `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `relation_name` varchar(30) NOT NULL COMMENT '关联名称',
  `relation_link` varchar(60) NOT NULL COMMENT '关联地址',
  `relation_target` tinyint(3) unsigned NOT NULL DEFAULT '1' COMMENT '1:当前窗口 2:新窗口',
  `relation_img` varchar(60) NOT NULL COMMENT '关联图片',
  `relation_type` tinyint(3) unsigned NOT NULL DEFAULT '1' COMMENT '1:词推荐 2:图片推荐 3:广告',
  `relation_sort` tinyint(3) unsigned NOT NULL DEFAULT '50' COMMENT '排序',
  `category_id` mediumint(8) unsigned NOT NULL COMMENT '所属商品栏目',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=11 ;

--
-- 转存表中的数据 `shop_category_relation`
--

INSERT INTO `shop_category_relation` (`id`, `relation_name`, `relation_link`, `relation_target`, `relation_img`, `relation_type`, `relation_sort`, `category_id`) VALUES
(5, '品牌日', 'http://1', 1, '', 1, 1, 15),
(6, '家电城', 'http://1', 1, '', 1, 2, 15),
(7, '智能生活馆', 'http://1', 1, '20180603\\8f84a779e094eb4e8e1a1e3dab8a40b6.jpg', 1, 3, 15),
(8, '同庆和堂', 'http://zz.com', 1, '20180603\\93422151eaf17471c98f13c702d9c375.jpg', 2, 50, 15),
(9, '喜瑞', 'http://xitui.com', 1, '20180603\\b319f5a56c16e8106bc2802e0ed035b1.jpg', 2, 50, 15),
(10, '红色苹果七', 'http://mdzz.com', 1, '20180603\\c1c1b18b102ac00345279dfa2a4a0ac8.jpg', 3, 50, 15);

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=56 ;

--
-- 转存表中的数据 `shop_commodity`
--

INSERT INTO `shop_commodity` (`id`, `name`, `code`, `picture`, `big_picture`, `medium_picture`, `small_picture`, `market_price`, `ours_price`, `status`, `sort`, `type_id`, `category_id`, `brand_id`, `content`) VALUES
(55, '12', '1527298194', '', '', '', '', '12.00', '21.00', 1, 50, 3, 5, 14, '<p>12<br/></p>');

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=170 ;

--
-- 转存表中的数据 `shop_commodity_attr`
--

INSERT INTO `shop_commodity_attr` (`id`, `commodity_id`, `attr_id`, `attr_value`, `attr_price`) VALUES
(160, 55, 6, '3', NULL),
(161, 55, 7, '21', NULL),
(162, 55, 12, '100t', '0.00'),
(164, 55, 14, '炫酷', '111.00'),
(166, 55, 12, '200t', '100.00'),
(167, 55, 12, '300t', '200.00'),
(169, 55, 14, '可爱', '222.00');

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
(55, 100, '162,164'),
(55, 100, '162,169'),
(55, 100, '166,164'),
(55, 100, '166,169'),
(55, 100, '167,164'),
(55, 100, '167,169');

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=13 ;

--
-- 转存表中的数据 `shop_conf`
--

INSERT INTO `shop_conf` (`id`, `title`, `name`, `area`, `mold`, `value`, `values`, `sort`) VALUES
(2, '站点名称', 'title', 1, 'text', '淘淘购物网', '', 1),
(3, '站点状态', 'status', 1, 'radio', '关', '开,关', 20),
(4, '站点关键词', 'keywords', 1, 'text', '淘淘购物网', '', 50),
(5, '站点介绍', 'description', 1, 'textarea', '淘淘购物网淘淘购物网淘淘购物网淘淘购物网淘淘购物网', '', 50),
(9, 'ICP备案号', 'icp', 1, 'text', '闽xxxxxx号', '', 50),
(10, '商城logo', 'logo', 1, 'file', '20180530\\4a3c86fd0413fd08451461dd128bcc09.png', '', 50),
(11, '二维码一号', 'qr_code1', 1, 'file', '20180530\\1416f79a3907d224b5d4cdff5dda5204.png', '', 50),
(12, '二维码二号', 'qr_code2', 1, 'file', '20180530\\438cb605655d6281803dc9ef6fac467b.png', '', 50);

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
-- 表的结构 `shop_nav`
--

CREATE TABLE IF NOT EXISTS `shop_nav` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `nav_name` varchar(60) NOT NULL COMMENT '导航名称',
  `nav_link` varchar(80) NOT NULL COMMENT '链接地址',
  `nav_pos` tinyint(3) unsigned NOT NULL DEFAULT '1' COMMENT '位置',
  `status` tinyint(3) unsigned NOT NULL DEFAULT '1' COMMENT '状态',
  `sort` tinyint(3) unsigned NOT NULL DEFAULT '50' COMMENT '排序',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=18 ;

--
-- 转存表中的数据 `shop_nav`
--

INSERT INTO `shop_nav` (`id`, `nav_name`, `nav_link`, `nav_pos`, `status`, `sort`) VALUES
(2, '女装街', 'http://www.baidu.com', 2, 1, 30),
(3, '我的订单', '', 1, 1, 50),
(4, '品牌专区', '', 2, 1, 50),
(5, '我的浏览', '', 1, 1, 50),
(6, '我的收藏', '', 1, 1, 50),
(7, '客户服务', '', 1, 1, 50),
(8, '男人柜', '', 2, 1, 50),
(9, '品牌专区', '', 2, 1, 50),
(10, '聚划算', '', 2, 1, 50),
(11, '积分商城', 'http://baidu.com', 2, 1, 50),
(12, '情侣派对', '', 2, 1, 50),
(13, '隐私保护', '', 3, 1, 50),
(14, '联系我们', '', 3, 1, 50),
(15, '免责条款', 'http://www.baidu.com', 3, 1, 50),
(16, '公司简介', '', 3, 1, 50),
(17, '意见反馈', 'http://baidu.com', 3, 1, 50);

-- --------------------------------------------------------

--
-- 表的结构 `shop_recomment`
--

CREATE TABLE IF NOT EXISTS `shop_recomment` (
  `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `rec_name` varchar(30) NOT NULL COMMENT '推荐位名称',
  `rec_type` tinyint(3) unsigned NOT NULL DEFAULT '1' COMMENT '1:商品 2：分类',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=9 ;

--
-- 转存表中的数据 `shop_recomment`
--

INSERT INTO `shop_recomment` (`id`, `rec_name`, `rec_type`) VALUES
(2, '首页推荐商品', 1),
(3, '首页推荐分类', 2),
(4, '热卖商品', 1),
(5, '限时抢购', 1),
(6, '新品推荐', 1),
(7, '精品推荐', 1),
(8, '推荐分类', 2);

-- --------------------------------------------------------

--
-- 表的结构 `shop_recomment_middle`
--

CREATE TABLE IF NOT EXISTS `shop_recomment_middle` (
  `rec_id` smallint(5) unsigned NOT NULL COMMENT '推荐位id',
  `pid` mediumint(8) unsigned NOT NULL COMMENT '商品|分类',
  `type` tinyint(3) unsigned NOT NULL DEFAULT '1' COMMENT '1:商品 2:分类'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `shop_recomment_middle`
--

INSERT INTO `shop_recomment_middle` (`rec_id`, `pid`, `type`) VALUES
(3, 14, 1);

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
