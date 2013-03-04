/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50527
Source Host           : localhost:3306
Source Database       : pepsi

Target Server Type    : MYSQL
Target Server Version : 50527
File Encoding         : 65001

Date: 2013-02-25 01:10:24
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `hashtag`
-- ----------------------------
DROP TABLE IF EXISTS `hashtag`;
CREATE TABLE `hashtag` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tweet_id` int(11) NOT NULL,
  `start_index` int(3) NOT NULL,
  `end_index` int(3) NOT NULL,
  `text` varchar(250) COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `tweet_id_hashtag` (`tweet_id`),
  CONSTRAINT `tweet_id_hashtag` FOREIGN KEY (`tweet_id`) REFERENCES `tweet` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=325 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- ----------------------------
-- Records of hashtag
-- ----------------------------

-- ----------------------------
-- Table structure for `media`
-- ----------------------------
DROP TABLE IF EXISTS `media`;
CREATE TABLE `media` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tweet_id` int(11) NOT NULL,
  `display_url` varchar(250) COLLATE utf8_spanish_ci NOT NULL,
  `expanded_url` varchar(250) COLLATE utf8_spanish_ci NOT NULL,
  `media_url` varchar(250) COLLATE utf8_spanish_ci NOT NULL,
  `url` varchar(250) COLLATE utf8_spanish_ci NOT NULL,
  `tw_media_id` int(20) NOT NULL,
  `tw_media_id_str` varchar(20) COLLATE utf8_spanish_ci NOT NULL,
  `start_index` int(3) NOT NULL,
  `end_index` int(3) NOT NULL,
  `type` varchar(20) COLLATE utf8_spanish_ci NOT NULL,
  `large_size_h` int(4) NOT NULL,
  `large_size_w` int(4) NOT NULL,
  `thumb_size_h` int(4) NOT NULL,
  `thumb_size_w` int(4) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `tweet_id_media` (`tweet_id`),
  CONSTRAINT `tweet_id_media` FOREIGN KEY (`tweet_id`) REFERENCES `tweet` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- ----------------------------
-- Records of media
-- ----------------------------

-- ----------------------------
-- Table structure for `tweet`
-- ----------------------------
DROP TABLE IF EXISTS `tweet`;
CREATE TABLE `tweet` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `created_at` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `tw_id` int(20) NOT NULL,
  `tw_id_str` varchar(20) COLLATE utf8_spanish_ci NOT NULL,
  `retweeted_count` int(11) NOT NULL,
  `source` varchar(250) COLLATE utf8_spanish_ci NOT NULL,
  `text` varchar(250) COLLATE utf8_spanish_ci NOT NULL,
  `user_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `user_id` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=272 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- ----------------------------
-- Records of tweet
-- ----------------------------

-- ----------------------------
-- Table structure for `tweet_reply`
-- ----------------------------
DROP TABLE IF EXISTS `tweet_reply`;
CREATE TABLE `tweet_reply` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tweet_id` int(11) NOT NULL,
  `screen_name` varchar(250) COLLATE utf8_spanish_ci NOT NULL,
  `name` varchar(250) COLLATE utf8_spanish_ci NOT NULL,
  `tw_status_id` int(20) NOT NULL,
  `tw_status_id_str` varchar(20) COLLATE utf8_spanish_ci NOT NULL,
  `tw_user_id` int(20) NOT NULL,
  `tw_user_id_str` varchar(20) COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `tweet_id` (`tweet_id`),
  CONSTRAINT `tweet_id` FOREIGN KEY (`tweet_id`) REFERENCES `tweet` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- ----------------------------
-- Records of tweet_reply
-- ----------------------------

-- ----------------------------
-- Table structure for `url`
-- ----------------------------
DROP TABLE IF EXISTS `url`;
CREATE TABLE `url` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tweet_id` int(11) NOT NULL,
  `display_url` varchar(250) COLLATE utf8_spanish_ci NOT NULL,
  `expanded_url` varchar(250) COLLATE utf8_spanish_ci NOT NULL,
  `url` varchar(250) COLLATE utf8_spanish_ci NOT NULL,
  `start_index` int(3) NOT NULL,
  `end_index` int(3) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `tweet_id_url` (`tweet_id`),
  CONSTRAINT `tweet_id_url` FOREIGN KEY (`tweet_id`) REFERENCES `tweet` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- ----------------------------
-- Records of url
-- ----------------------------

-- ----------------------------
-- Table structure for `user`
-- ----------------------------
DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `created_at` varchar(30) COLLATE utf8_spanish_ci NOT NULL,
  `description` varchar(250) COLLATE utf8_spanish_ci DEFAULT NULL,
  `favorites_count` int(11) DEFAULT NULL,
  `followers_count` int(7) DEFAULT NULL,
  `friends_count` int(7) DEFAULT NULL,
  `tw_user_id` int(20) NOT NULL,
  `tw_user_id_str` int(20) NOT NULL,
  `listed_count` int(5) NOT NULL,
  `name` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `screen_name` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `profile_image_url` varchar(250) COLLATE utf8_spanish_ci DEFAULT NULL,
  `protected` int(1) NOT NULL,
  `status_count` int(11) NOT NULL,
  `verified` int(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=279 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- ----------------------------
-- Records of user
-- ----------------------------

-- ----------------------------
-- Table structure for `user_mention`
-- ----------------------------
DROP TABLE IF EXISTS `user_mention`;
CREATE TABLE `user_mention` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tweet_id` int(11) NOT NULL,
  `tw_user_id` int(20) NOT NULL,
  `tw_user_id_str` varchar(20) COLLATE utf8_spanish_ci NOT NULL,
  `start_index` int(3) NOT NULL,
  `end_index` int(3) NOT NULL,
  `name` varchar(250) COLLATE utf8_spanish_ci NOT NULL,
  `screen_name` varchar(250) COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `tweet_id_user_mention` (`tweet_id`),
  CONSTRAINT `tweet_id_user_mention` FOREIGN KEY (`tweet_id`) REFERENCES `tweet` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=142 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- ----------------------------
-- Records of user_mention
-- ----------------------------
