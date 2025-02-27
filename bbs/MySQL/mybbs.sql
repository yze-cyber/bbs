SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

create database IF NOT EXISTS mybbs ;
use mybbs;
DROP TABLE IF EXISTS `article`;
CREATE TABLE `article`  (
  `id` int(6) NOT NULL AUTO_INCREMENT,
  `user_id` int(6) NOT NULL,
  `title` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `body` longtext CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `level` int(1) NOT NULL,
  `time` datetime(0) NOT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `user_id`(`user_id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

DROP TABLE IF EXISTS `users`;
CREATE TABLE `users`  (
  `id` int(6) UNSIGNED NOT NULL AUTO_INCREMENT,
  `username` varchar(30) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `password` varchar(30) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `level` tinyint(1) NOT NULL,
  `img` varchar(2555) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `email` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `username`(`username`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 5 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

INSERT INTO `users` VALUES (1, 'admin', '123456', 'admin', 1, NULL, '123@163.com');
INSERT INTO `users` VALUES (2, 'newfu', '123456', NULL, 0, NULL, '123@163.com');
INSERT INTO `users` VALUES (3, 'admin123123', '123456', NULL, 0, NULL, '123@qq.com');
INSERT INTO `users` VALUES (4, 'newfu123123', '123456', NULL, 0, NULL, '123@qq.com');
INSERT INTO `users` VALUES (5, 'guest','genshinstart',NULL,0,NULL,'yuanshenqidong@mhy.com');
SET FOREIGN_KEY_CHECKS = 1;
