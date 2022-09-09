/*
 Navicat Premium Data Transfer

 Source Server         : MySQL8
 Source Server Type    : MySQL
 Source Server Version : 80028
 Source Host           : localhost:3307
 Source Schema         : caojiehuoguo

 Target Server Type    : MySQL
 Target Server Version : 80028
 File Encoding         : 65001

 Date: 29/05/2022 17:18:11
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for t_goods
-- ----------------------------
DROP TABLE IF EXISTS `t_goods`;
CREATE TABLE `t_goods`  (
  `id` int(0) NOT NULL AUTO_INCREMENT COMMENT 'id',
  `goods_name` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin NULL DEFAULT NULL COMMENT '产品名称',
  `goods_url` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin NULL DEFAULT NULL COMMENT '产品图片',
  `goods_price` decimal(10, 2) NULL DEFAULT NULL COMMENT '产品单价',
  `cate_id` int(0) NULL DEFAULT NULL COMMENT '产品所属类别',
  `is_enabled` int(0) NULL DEFAULT NULL COMMENT '是否可用',
  `goods_intro` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin NULL DEFAULT NULL COMMENT '产品介绍',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 23 CHARACTER SET = utf8 COLLATE = utf8_bin ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of t_goods
-- ----------------------------
INSERT INTO `t_goods` VALUES (1, '蒜泥龙虾（3斤）', 'https://yxrepository.oss-cn-hangzhou.aliyuncs.com/img/canzhong/596848.jpg', 108.00, 1, 1, NULL);
INSERT INTO `t_goods` VALUES (2, '十三香龙虾（3斤）', 'https://yxrepository.oss-cn-hangzhou.aliyuncs.com/img/canzhong/587597.jpg\r\n', 108.00, 1, 1, '三斤一份');
INSERT INTO `t_goods` VALUES (3, '羊肉串', 'https://yxrepository.oss-cn-hangzhou.aliyuncs.com/img/canzhong/545918.jpg', 4.00, 2, 1, NULL);
INSERT INTO `t_goods` VALUES (4, '牛肉串', 'https://yxrepository.oss-cn-hangzhou.aliyuncs.com/img/canzhong/545909.jpg\r\n', 4.00, 2, 1, NULL);
INSERT INTO `t_goods` VALUES (5, '五花肉', 'https://yxrepository.oss-cn-hangzhou.aliyuncs.com/img/ironman/489845.jpg\r\n', 4.00, 2, 1, NULL);
INSERT INTO `t_goods` VALUES (6, '培根金针菇卷', 'https://yxrepository.oss-cn-hangzhou.aliyuncs.com/img/ironman/674308.jpg', 5.00, 3, 1, NULL);
INSERT INTO `t_goods` VALUES (7, '掌中宝', 'https://yxrepository.oss-cn-hangzhou.aliyuncs.com/img/ironman/689264.jpg\r\n', 4.00, 3, 1, NULL);
INSERT INTO `t_goods` VALUES (8, '王中王', 'https://yxrepository.oss-cn-hangzhou.aliyuncs.com/img/ironman/877075.jpg', 3.00, 3, 1, NULL);
INSERT INTO `t_goods` VALUES (9, '烤肉肠', 'https://yxrepository.oss-cn-hangzhou.aliyuncs.com/img/ironman/944959.jpg', 5.00, 3, 1, NULL);
INSERT INTO `t_goods` VALUES (10, '牛蹄筋', 'https://yxrepository.oss-cn-hangzhou.aliyuncs.com/img/spideman/247850.png', 4.00, 3, 1, NULL);
INSERT INTO `t_goods` VALUES (11, '板筋', 'https://yxrepository.oss-cn-hangzhou.aliyuncs.com/img/spideman/374464.jpg', 3.00, 3, 1, NULL);
INSERT INTO `t_goods` VALUES (12, '羊腰子', 'https://yxrepository.oss-cn-hangzhou.aliyuncs.com/img/spideman/626164.jpg', 10.00, 3, 1, NULL);
INSERT INTO `t_goods` VALUES (13, '鱼豆腐', 'https://yxrepository.oss-cn-hangzhou.aliyuncs.com/img/spideman/977081.jpg', 3.00, 3, 1, NULL);
INSERT INTO `t_goods` VALUES (14, '大里脊', 'https://yxrepository.oss-cn-hangzhou.aliyuncs.com/img/spideman/985969.jpg', 3.00, 4, 1, NULL);
INSERT INTO `t_goods` VALUES (15, '烤大鱿鱼', 'https://yxrepository.oss-cn-hangzhou.aliyuncs.com/img/500832.jpg', 10.00, 4, 1, NULL);
INSERT INTO `t_goods` VALUES (16, '鱿鱼须', 'https://yxrepository.oss-cn-hangzhou.aliyuncs.com/img/659840.jpg', 4.00, 4, 1, NULL);
INSERT INTO `t_goods` VALUES (17, '烤大鸡腿', 'https://yxrepository.oss-cn-hangzhou.aliyuncs.com/img/795309.jpg', 15.00, 4, 1, NULL);
INSERT INTO `t_goods` VALUES (18, '烤鸡翅', 'https://yxrepository.oss-cn-hangzhou.aliyuncs.com/img/SpiderMan.jpg', 10.00, 4, 1, NULL);
INSERT INTO `t_goods` VALUES (19, '花菜', 'https://yxrepository.oss-cn-hangzhou.aliyuncs.com/img/cate/%E5%88%86%E7%B1%BB/1.png', 2.00, 5, 1, NULL);
INSERT INTO `t_goods` VALUES (20, '牛肉小串', '\r\nhttps://yxrepository.oss-cn-hangzhou.aliyuncs.com/img/cate/%E5%88%86%E7%B1%BB/2.png', 15.00, 7, 1, NULL);
INSERT INTO `t_goods` VALUES (21, '烤馒头', 'https://yxrepository.oss-cn-hangzhou.aliyuncs.com/img/cate/%E5%88%86%E7%B1%BB/3.png', 2.50, 6, 1, NULL);
INSERT INTO `t_goods` VALUES (22, '可乐', '\r\nhttps://yxrepository.oss-cn-hangzhou.aliyuncs.com/img/cate/%E5%88%86%E7%B1%BB/4.png', 4.00, 8, 1, NULL);

-- ----------------------------
-- Table structure for t_order
-- ----------------------------
DROP TABLE IF EXISTS `t_order`;
CREATE TABLE `t_order`  (
  `id` int(0) NOT NULL AUTO_INCREMENT COMMENT 'id',
  `status` int(0) NULL DEFAULT NULL COMMENT '0:未付款，1:已付款，2:已取消，3:已退款',
  `goods_ids` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin NULL DEFAULT NULL COMMENT 'goodsId的集合，如（1,2,3,4）',
  `is_enabled` int(0) NULL DEFAULT NULL COMMENT '是否可用',
  `shop_id` int(0) NULL DEFAULT NULL COMMENT '店铺id',
  `table_id` int(0) NULL DEFAULT NULL COMMENT '桌子id',
  `create_time` date NULL DEFAULT NULL COMMENT '下单时间',
  `total_price` decimal(10, 2) NULL DEFAULT NULL COMMENT '总价格·',
  `total_count` int(0) NULL DEFAULT NULL COMMENT '下单产品总数量',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 19 CHARACTER SET = utf8 COLLATE = utf8_bin ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of t_order
-- ----------------------------
INSERT INTO `t_order` VALUES (1, 2, '1,2', 1, 1, 5, '2022-05-26', 216.00, 2);
INSERT INTO `t_order` VALUES (2, 1, '1,2,3', 1, 1, 1, '2022-05-26', 220.00, 3);
INSERT INTO `t_order` VALUES (3, 2, '1,2,3,4', 1, 1, 2, '2022-05-26', 224.00, 4);
INSERT INTO `t_order` VALUES (4, 3, '1,2,3,4,5', 1, 1, 3, '2022-05-26', 228.00, 5);
INSERT INTO `t_order` VALUES (9, 1, '1', 1, 1, 1, NULL, 432.00, 1);
INSERT INTO `t_order` VALUES (10, 1, '1', 1, 1, 6, NULL, 108.00, 1);
INSERT INTO `t_order` VALUES (15, 1, '1,2,3,4', 1, 1, 7, NULL, 224.00, 4);
INSERT INTO `t_order` VALUES (16, 2, '20,21,22', 1, 1, 1, NULL, 21.50, 3);
INSERT INTO `t_order` VALUES (17, 0, '14,15,16', 1, 1, 5, NULL, 17.00, 3);
INSERT INTO `t_order` VALUES (18, 0, '6,13,15,16', 1, 1, 7, NULL, 27.00, 4);

-- ----------------------------
-- Table structure for t_order_goods
-- ----------------------------
DROP TABLE IF EXISTS `t_order_goods`;
CREATE TABLE `t_order_goods`  (
  `id` int(0) NOT NULL AUTO_INCREMENT COMMENT 'id',
  `order_id` int(0) NULL DEFAULT NULL COMMENT '订单id',
  `goods_id` int(0) NULL DEFAULT NULL COMMENT '产品id',
  `goods_count` int(0) NULL DEFAULT NULL COMMENT '产品下单数量',
  `is_enabled` int(0) NULL DEFAULT NULL COMMENT '是否可用',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 92 CHARACTER SET = utf8 COLLATE = utf8_bin ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of t_order_goods
-- ----------------------------
INSERT INTO `t_order_goods` VALUES (1, 1, 1, 1, 1);
INSERT INTO `t_order_goods` VALUES (2, 1, 2, 1, 1);
INSERT INTO `t_order_goods` VALUES (3, 2, 1, 1, 1);
INSERT INTO `t_order_goods` VALUES (4, 2, 2, 1, 1);
INSERT INTO `t_order_goods` VALUES (5, 2, 3, 1, 1);
INSERT INTO `t_order_goods` VALUES (6, 3, 1, 1, 1);
INSERT INTO `t_order_goods` VALUES (7, 3, 2, 1, 1);
INSERT INTO `t_order_goods` VALUES (8, 3, 3, 1, 1);
INSERT INTO `t_order_goods` VALUES (9, 3, 4, 1, 1);
INSERT INTO `t_order_goods` VALUES (10, 4, 1, 1, 1);
INSERT INTO `t_order_goods` VALUES (11, 4, 2, 1, 1);
INSERT INTO `t_order_goods` VALUES (12, 4, 3, 1, 1);
INSERT INTO `t_order_goods` VALUES (13, 4, 4, 1, 1);
INSERT INTO `t_order_goods` VALUES (14, 4, 5, 1, 1);
INSERT INTO `t_order_goods` VALUES (54, 9, 1, 4, 1);
INSERT INTO `t_order_goods` VALUES (55, 10, 1, 1, 1);
INSERT INTO `t_order_goods` VALUES (78, 15, 1, 1, 1);
INSERT INTO `t_order_goods` VALUES (79, 15, 2, 1, 1);
INSERT INTO `t_order_goods` VALUES (80, 15, 3, 1, 1);
INSERT INTO `t_order_goods` VALUES (81, 15, 4, 1, 1);
INSERT INTO `t_order_goods` VALUES (82, 16, 20, 1, 1);
INSERT INTO `t_order_goods` VALUES (83, 16, 21, 1, 1);
INSERT INTO `t_order_goods` VALUES (84, 16, 22, 1, 1);
INSERT INTO `t_order_goods` VALUES (85, 17, 14, 1, 1);
INSERT INTO `t_order_goods` VALUES (86, 17, 15, 1, 1);
INSERT INTO `t_order_goods` VALUES (87, 17, 16, 1, 1);
INSERT INTO `t_order_goods` VALUES (88, 18, 6, 2, 1);
INSERT INTO `t_order_goods` VALUES (89, 18, 13, 1, 1);
INSERT INTO `t_order_goods` VALUES (90, 18, 15, 1, 1);
INSERT INTO `t_order_goods` VALUES (91, 18, 16, 1, 1);

-- ----------------------------
-- Table structure for t_shop
-- ----------------------------
DROP TABLE IF EXISTS `t_shop`;
CREATE TABLE `t_shop`  (
  `id` int(0) NOT NULL AUTO_INCREMENT COMMENT 'id',
  `shop_name` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin NULL DEFAULT NULL COMMENT '店铺名称',
  `shop_url` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin NULL DEFAULT NULL COMMENT '店铺图片',
  `shop_address` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin NULL DEFAULT NULL COMMENT '店铺地址',
  `shop_intro` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin NULL DEFAULT NULL COMMENT '店铺介绍',
  `shop_phone` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin NULL DEFAULT NULL COMMENT '店铺电话',
  `shop_contact` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin NULL DEFAULT NULL COMMENT '店铺联系',
  `is_enabled` int(0) NULL DEFAULT NULL COMMENT '是否可用',
  `cate_ids` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin NULL DEFAULT NULL COMMENT 'cateId的集合,如（1,2,3,4）',
  `table_ids` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin NULL DEFAULT NULL COMMENT 'tableId的集合',
  `shop_distribution` decimal(11, 2) NULL DEFAULT NULL COMMENT '配送费',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = utf8 COLLATE = utf8_bin ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of t_shop
-- ----------------------------
INSERT INTO `t_shop` VALUES (1, '曹姐烧烤火锅', 'https://yxrepository.oss-cn-hangzhou.aliyuncs.com/img/canzhong/629544.jpg', '（杭州市临安区）', '本店主营火锅烧烤', '13750807966', 'ladydanga', 1, NULL, '1,2,3,4,5,6,7,8', 0.00);

-- ----------------------------
-- Table structure for t_shop_cate
-- ----------------------------
DROP TABLE IF EXISTS `t_shop_cate`;
CREATE TABLE `t_shop_cate`  (
  `id` int(0) NOT NULL AUTO_INCREMENT COMMENT 'id',
  `shop_id` int(0) NULL DEFAULT NULL COMMENT '店铺id',
  `cate_name` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin NULL DEFAULT NULL COMMENT '类属名称',
  `goods_ids` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin NULL DEFAULT NULL COMMENT 'goodsId的集合,如（1,2,3,4）',
  `is_enabled` int(0) NULL DEFAULT NULL COMMENT '是否可用',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 9 CHARACTER SET = utf8 COLLATE = utf8_bin ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of t_shop_cate
-- ----------------------------
INSERT INTO `t_shop_cate` VALUES (1, 1, '龙虾', NULL, 1);
INSERT INTO `t_shop_cate` VALUES (2, 1, '必点肉串', NULL, 1);
INSERT INTO `t_shop_cate` VALUES (3, 1, '肉类', NULL, 1);
INSERT INTO `t_shop_cate` VALUES (4, 1, '鸡鸭鱼肉', NULL, 1);
INSERT INTO `t_shop_cate` VALUES (5, 1, '素菜', NULL, 1);
INSERT INTO `t_shop_cate` VALUES (6, 1, '豆制品/年糕馒头', NULL, 1);
INSERT INTO `t_shop_cate` VALUES (7, 1, '小串', NULL, 1);
INSERT INTO `t_shop_cate` VALUES (8, 1, '酒水饮料', NULL, 1);

-- ----------------------------
-- Table structure for t_table
-- ----------------------------
DROP TABLE IF EXISTS `t_table`;
CREATE TABLE `t_table`  (
  ` id` int(0) NOT NULL AUTO_INCREMENT COMMENT 'id',
  `status` int(0) NULL DEFAULT NULL COMMENT '0:空闲，1:使用中',
  `order_id` int(0) NULL DEFAULT NULL COMMENT '0:无订单，!0:订单id',
  `table_name` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin NULL DEFAULT NULL COMMENT '桌子名称',
  `is_enabled` int(0) NULL DEFAULT NULL COMMENT '是否可用',
  `shop_id` int(0) NULL DEFAULT NULL COMMENT '店铺id',
  PRIMARY KEY (` id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 9 CHARACTER SET = utf8 COLLATE = utf8_bin ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of t_table
-- ----------------------------
INSERT INTO `t_table` VALUES (1, 0, 0, '1号桌', 1, 1);
INSERT INTO `t_table` VALUES (2, 0, 0, '2号桌', 1, 1);
INSERT INTO `t_table` VALUES (3, 0, 0, '3号桌', 1, 1);
INSERT INTO `t_table` VALUES (4, 0, 0, '4号桌', 1, 1);
INSERT INTO `t_table` VALUES (5, 1, 17, '5号桌', 1, 1);
INSERT INTO `t_table` VALUES (6, 0, 0, '6号桌', 1, 1);
INSERT INTO `t_table` VALUES (7, 1, 18, '7号桌', 1, 1);
INSERT INTO `t_table` VALUES (8, 0, 0, '8号桌', 1, 1);

SET FOREIGN_KEY_CHECKS = 1;
