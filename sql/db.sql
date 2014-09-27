/*
SQLyog Enterprise - MySQL GUI v6.14
MySQL - 5.6.17 : Database - expensereport
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

create database if not exists `expensereport`;

USE `expensereport`;

/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

/*Table structure for table `balancesheet` */

DROP TABLE IF EXISTS `balancesheet`;

CREATE TABLE `balancesheet` (
  `TxnId` int(10) NOT NULL,
  `UserId` int(2) NOT NULL,
  `TxnDate` date NOT NULL DEFAULT '0000-00-00',
  `Share` float(7,2) NOT NULL DEFAULT '0.00',
  `Expense` float(7,2) NOT NULL DEFAULT '0.00',
  `Balance` float(7,2) NOT NULL DEFAULT '0.00',
  PRIMARY KEY (`TxnId`,`UserId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf16 CHECKSUM=1 DELAY_KEY_WRITE=1 ROW_FORMAT=DYNAMIC;

/*Table structure for table `item_master` */

DROP TABLE IF EXISTS `item_master`;

CREATE TABLE `item_master` (
  `ItemId` int(5) NOT NULL AUTO_INCREMENT,
  `Name` varchar(100) NOT NULL,
  `flag_active` int(1) DEFAULT NULL,
  PRIMARY KEY (`ItemId`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8;

/*Table structure for table `item_purchase` */

DROP TABLE IF EXISTS `item_purchase`;

CREATE TABLE `item_purchase` (
  `TxnId` int(6) NOT NULL AUTO_INCREMENT,
  `ItemId` int(5) NOT NULL,
  `BoughtBy` int(2) NOT NULL,
  `BoughtDate` date NOT NULL DEFAULT '0000-00-00',
  `SharedBy` varchar(100) CHARACTER SET utf8 NOT NULL,
  `Cost` float(7,2) NOT NULL DEFAULT '0.00',
  PRIMARY KEY (`TxnId`)
) ENGINE=InnoDB AUTO_INCREMENT=180 DEFAULT CHARSET=utf16 CHECKSUM=1 DELAY_KEY_WRITE=1 ROW_FORMAT=DYNAMIC;

/*Table structure for table `user_master` */

DROP TABLE IF EXISTS `user_master`;

CREATE TABLE `user_master` (
  `UserId` int(2) NOT NULL AUTO_INCREMENT,
  `Name` varchar(100) NOT NULL,
  `flag_active` int(1) DEFAULT NULL,
  PRIMARY KEY (`UserId`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
