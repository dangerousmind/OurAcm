SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;


CREATE TABLE IF NOT EXISTS `talk` (
  `tid` int(11) NOT NULL AUTO_INCREMENT COMMENT 'TalkID',
  `ptid` int(11) NOT NULL COMMENT '首层TalkID',
  `ojaccount` varchar(32) NOT NULL COMMENT 'OJ账号',
  `title` varchar(200) NOT NULL COMMENT '标题',
  `content` text COMMENT '内容',
  `createtime` datetime NOT NULL COMMENT '提交时间',
  `problemid` int(11) DEFAULT NULL COMMENT 'OJ题目ID',
  `lft` int(11) NOT NULL COMMENT '预排序遍历树-左值',
  `rgt` int(11) NOT NULL COMMENT '预排序遍历树-右值',
  `ip` varchar(40) DEFAULT NULL COMMENT '客户IP地址',
  PRIMARY KEY (`tid`),
  KEY `ptid` (`ptid`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='Talk模块表' AUTO_INCREMENT=1 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;