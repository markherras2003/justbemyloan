/*
SQLyog Ultimate v12.09 (64 bit)
MySQL - 5.7.11 : Database - loandb
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`loandb` /*!40100 DEFAULT CHARACTER SET latin1 */;

USE `loandb`;

/*Table structure for table `lend_admin` */

DROP TABLE IF EXISTS `lend_admin`;

CREATE TABLE `lend_admin` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(45) DEFAULT NULL,
  `password` varchar(45) DEFAULT NULL,
  `rdate` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

/*Data for the table `lend_admin` */

insert  into `lend_admin`(`id`,`username`,`password`,`rdate`) values (8,'admin','12e2e40bfa5f42ccb6f67b833cfbf4b4','2019-12-11 12:17:40');

/*Table structure for table `lend_advance_payments` */

DROP TABLE IF EXISTS `lend_advance_payments`;

CREATE TABLE `lend_advance_payments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `admin_id` int(11) DEFAULT NULL,
  `payment_ids` varchar(200) DEFAULT NULL,
  `total_payments` decimal(10,2) DEFAULT NULL,
  `borrower_id` int(11) DEFAULT NULL,
  `borrower_loan_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

/*Data for the table `lend_advance_payments` */

insert  into `lend_advance_payments`(`id`,`admin_id`,`payment_ids`,`total_payments`,`borrower_id`,`borrower_loan_id`) values (5,8,'279,280,281','129999.90',6,36),(6,8,'315,316,317','8124.99',7,38);

/*Table structure for table `lend_borrower` */

DROP TABLE IF EXISTS `lend_borrower`;

CREATE TABLE `lend_borrower` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `company` varchar(100) DEFAULT NULL,
  `address` varchar(100) DEFAULT NULL,
  `phone_cell` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `income` varchar(45) DEFAULT NULL,
  `civil_status` varchar(45) DEFAULT NULL,
  `sex` varchar(45) DEFAULT NULL,
  `age` varchar(45) DEFAULT NULL,
  `employment_status` varchar(45) DEFAULT NULL,
  `job_title` varchar(45) DEFAULT NULL,
  `fname` varchar(45) DEFAULT NULL,
  `lname` varchar(45) DEFAULT NULL,
  `mi` varchar(45) DEFAULT NULL,
  `rdate` datetime DEFAULT NULL,
  `birth_date` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

/*Data for the table `lend_borrower` */

insert  into `lend_borrower`(`id`,`company`,`address`,`phone_cell`,`email`,`income`,`civil_status`,`sex`,`age`,`employment_status`,`job_title`,`fname`,`lname`,`mi`,`rdate`,`birth_date`) values (7,'DOST Region IX','Uys Drive Street Lumiyap\r\nBarangay Divisoria','09175167588','larrymark2003@gmail.com','30268.00','Single',NULL,'24','Employed','SRS I','Eden','Galleno','Gregorio','2019-12-11 15:39:43','2019-12-24'),(6,'DOST Region IX','Uys Drive Street Lumiyap\r\nBarangay Divisoria','09175167588','larrymark2003@gmail.com','30268.00','Single',NULL,'29','Employed','SRS I','Larry','Somocor','Barcelona','2019-12-11 10:38:21','2019-12-11');

/*Table structure for table `lend_borrower_loan_settings` */

DROP TABLE IF EXISTS `lend_borrower_loan_settings`;

CREATE TABLE `lend_borrower_loan_settings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `loan_id` int(11) DEFAULT NULL,
  `borrower_loan_id` int(11) DEFAULT NULL,
  `lname` varchar(90) DEFAULT NULL,
  `interest` float DEFAULT NULL,
  `months` varchar(25) NOT NULL,
  `terms` varchar(45) DEFAULT NULL,
  `frequency` varchar(45) DEFAULT NULL,
  `late_fee` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=18 DEFAULT CHARSET=latin1;

/*Data for the table `lend_borrower_loan_settings` */

insert  into `lend_borrower_loan_settings`(`id`,`loan_id`,`borrower_loan_id`,`lname`,`interest`,`months`,`terms`,`frequency`,`late_fee`) values (17,8,38,'2.5% Interest',2.5,'12','24','2 Weeks',NULL),(16,8,37,'2.5% Interest',2.5,'6','12','2 Weeks',NULL),(14,8,35,'2.5% Interest',2.5,'12','24','2 Weeks',NULL),(15,9,36,'Monthly Loan',4.5,'24','24','Monthly',NULL);

/*Table structure for table `lend_borrower_loans` */

DROP TABLE IF EXISTS `lend_borrower_loans`;

CREATE TABLE `lend_borrower_loans` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `borrower_id` int(11) DEFAULT NULL,
  `loan_id` int(11) DEFAULT NULL,
  `status` varchar(45) DEFAULT 'ACTIVE',
  `loan_date` date DEFAULT NULL,
  `loan_amount` float DEFAULT NULL,
  `loan_months` varchar(100) NOT NULL,
  `loan_amount_interest` float DEFAULT NULL,
  `loan_amount_term` float DEFAULT NULL,
  `loan_amount_total` float DEFAULT NULL,
  `next_payment_id` int(11) DEFAULT NULL,
  `rdate` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=39 DEFAULT CHARSET=latin1;

/*Data for the table `lend_borrower_loans` */

insert  into `lend_borrower_loans`(`id`,`borrower_id`,`loan_id`,`status`,`loan_date`,`loan_amount`,`loan_months`,`loan_amount_interest`,`loan_amount_term`,`loan_amount_total`,`next_payment_id`,`rdate`) values (38,7,8,'ACTIVE','2019-12-11',50000,'12',625,2708.33,65000,315,'2019-12-11 15:40:09'),(37,6,8,'ACTIVE','2019-12-11',25000,'6',312.5,2395.83,28750,303,'2019-12-11 13:31:11'),(36,6,9,'ACTIVE','2019-12-11',500000,'24',22500,43333.3,1040000,279,'2019-12-11 12:07:20');

/*Table structure for table `lend_loan` */

DROP TABLE IF EXISTS `lend_loan`;

CREATE TABLE `lend_loan` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `lname` varchar(90) DEFAULT NULL,
  `interest` float DEFAULT NULL,
  `terms` varchar(45) DEFAULT NULL,
  `frequency` varchar(45) DEFAULT NULL,
  `late_fee` int(11) DEFAULT NULL,
  `rdate` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

/*Data for the table `lend_loan` */

insert  into `lend_loan`(`id`,`lname`,`interest`,`terms`,`frequency`,`late_fee`,`rdate`) values (8,'2.5% Interest',2.5,'12','2 Weeks',NULL,'2011-09-22 14:59:48'),(9,'Monthly Loan',4.5,NULL,'Monthly',NULL,'2019-12-11 12:06:12');

/*Table structure for table `lend_logs` */

DROP TABLE IF EXISTS `lend_logs`;

CREATE TABLE `lend_logs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `admin_id` int(11) DEFAULT NULL,
  `loan_id` int(11) DEFAULT NULL,
  `payment_id` int(11) DEFAULT NULL,
  `action` varchar(45) DEFAULT NULL,
  `rdate` datetime DEFAULT NULL,
  `ip_address` varchar(100) DEFAULT NULL,
  `description` text,
  `type` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

/*Data for the table `lend_logs` */

insert  into `lend_logs`(`id`,`admin_id`,`loan_id`,`payment_id`,`action`,`rdate`,`ip_address`,`description`,`type`) values (7,8,38,318,NULL,NULL,'0.0.0.0','<strong>Payment #</strong>(4), <strong>Original Date</strong>(2020-01-30), <strong>Move-in Date</strong>(2020-01-30)','move'),(5,8,36,5,NULL,NULL,'0.0.0.0','<strong>Payment #</strong>(1,2,3), <strong>Total Amount</strong>(129999.90)','advance_payment'),(6,8,38,6,NULL,NULL,'0.0.0.0','<strong>Payment #</strong>(1,2,3), <strong>Total Amount</strong>(8124.99)','advance_payment');

/*Table structure for table `lend_payments` */

DROP TABLE IF EXISTS `lend_payments`;

CREATE TABLE `lend_payments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `borrower_id` int(11) DEFAULT NULL,
  `borrower_loan_id` int(11) DEFAULT NULL,
  `payment_sched` date DEFAULT NULL,
  `payment_sched_prev` date DEFAULT NULL,
  `payment_number` int(11) DEFAULT NULL,
  `amount` float DEFAULT NULL,
  `status` varchar(45) DEFAULT 'UNPAID',
  `rdate` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=339 DEFAULT CHARSET=latin1;

/*Data for the table `lend_payments` */

insert  into `lend_payments`(`id`,`borrower_id`,`borrower_loan_id`,`payment_sched`,`payment_sched_prev`,`payment_number`,`amount`,`status`,`rdate`) values (302,6,36,'2021-11-30',NULL,24,43333.3,'UNPAID','2019-12-11 12:07:20'),(301,6,36,'2021-11-01',NULL,23,43333.3,'UNPAID','2019-12-11 12:07:20'),(300,6,36,'2021-10-01',NULL,22,43333.3,'UNPAID','2019-12-11 12:07:20'),(299,6,36,'2021-09-01',NULL,21,43333.3,'UNPAID','2019-12-11 12:07:20'),(298,6,36,'2021-08-02',NULL,20,43333.3,'UNPAID','2019-12-11 12:07:20'),(297,6,36,'2021-07-02',NULL,19,43333.3,'UNPAID','2019-12-11 12:07:20'),(296,6,36,'2021-06-03',NULL,18,43333.3,'UNPAID','2019-12-11 12:07:20'),(295,6,36,'2021-05-04',NULL,17,43333.3,'UNPAID','2019-12-11 12:07:20'),(294,6,36,'2021-04-05',NULL,16,43333.3,'UNPAID','2019-12-11 12:07:20'),(293,6,36,'2021-03-05',NULL,15,43333.3,'UNPAID','2019-12-11 12:07:20'),(292,6,36,'2021-02-03',NULL,14,43333.3,'UNPAID','2019-12-11 12:07:20'),(291,6,36,'2021-01-04',NULL,13,43333.3,'UNPAID','2019-12-11 12:07:20'),(290,6,36,'2020-12-04',NULL,12,43333.3,'UNPAID','2019-12-11 12:07:20'),(289,6,36,'2020-11-05',NULL,11,43333.3,'UNPAID','2019-12-11 12:07:20'),(288,6,36,'2020-10-06',NULL,10,43333.3,'UNPAID','2019-12-11 12:07:20'),(287,6,36,'2020-09-07',NULL,9,43333.3,'UNPAID','2019-12-11 12:07:20'),(286,6,36,'2020-08-07',NULL,8,43333.3,'UNPAID','2019-12-11 12:07:20'),(285,6,36,'2020-07-08',NULL,7,43333.3,'UNPAID','2019-12-11 12:07:20'),(284,6,36,'2020-06-08',NULL,6,43333.3,'UNPAID','2019-12-11 12:07:20'),(283,6,36,'2020-05-08',NULL,5,43333.3,'UNPAID','2019-12-11 12:07:20'),(282,6,36,'2020-04-09',NULL,4,43333.3,'UNPAID','2019-12-11 12:07:20'),(281,6,36,'2020-03-10',NULL,3,43333.3,'PAID','2019-12-11 12:07:20'),(280,6,36,'2020-02-10',NULL,2,43333.3,'PAID','2019-12-11 12:07:20'),(279,6,36,'2020-01-10',NULL,1,43333.3,'PAID','2019-12-11 12:07:20'),(303,6,37,'2019-12-15',NULL,1,2395.83,'UNPAID','2019-12-11 13:31:11'),(304,6,37,'2019-12-30',NULL,2,2395.83,'UNPAID','2019-12-11 13:31:11'),(305,6,37,'2020-01-15',NULL,3,2395.83,'UNPAID','2019-12-11 13:31:11'),(306,6,37,'2020-01-30',NULL,4,2395.83,'UNPAID','2019-12-11 13:31:11'),(307,6,37,'2020-02-15',NULL,5,2395.83,'UNPAID','2019-12-11 13:31:11'),(308,6,37,'2020-02-28',NULL,6,2395.83,'UNPAID','2019-12-11 13:31:11'),(309,6,37,'2020-03-15',NULL,7,2395.83,'UNPAID','2019-12-11 13:31:11'),(310,6,37,'2020-03-30',NULL,8,2395.83,'UNPAID','2019-12-11 13:31:11'),(311,6,37,'2020-04-15',NULL,9,2395.83,'UNPAID','2019-12-11 13:31:11'),(312,6,37,'2020-04-30',NULL,10,2395.83,'UNPAID','2019-12-11 13:31:11'),(313,6,37,'2020-05-15',NULL,11,2395.83,'UNPAID','2019-12-11 13:31:11'),(314,6,37,'2020-05-30',NULL,12,2395.83,'UNPAID','2019-12-11 13:31:11'),(315,7,38,'2019-12-15',NULL,1,2708.33,'PAID','2019-12-11 15:40:09'),(316,7,38,'2019-12-30',NULL,2,2708.33,'PAID','2019-12-11 15:40:09'),(317,7,38,'2020-01-15',NULL,3,2708.33,'PAID','2019-12-11 15:40:09'),(318,7,38,'2020-01-30','2020-01-30',4,2708.33,'UNPAID','2019-12-11 15:40:09'),(319,7,38,'2020-02-15',NULL,5,2708.33,'UNPAID','2019-12-11 15:40:09'),(320,7,38,'2020-02-28',NULL,6,2708.33,'UNPAID','2019-12-11 15:40:09'),(321,7,38,'2020-03-15',NULL,7,2708.33,'UNPAID','2019-12-11 15:40:09'),(322,7,38,'2020-03-30',NULL,8,2708.33,'UNPAID','2019-12-11 15:40:09'),(323,7,38,'2020-04-15',NULL,9,2708.33,'UNPAID','2019-12-11 15:40:09'),(324,7,38,'2020-04-30',NULL,10,2708.33,'UNPAID','2019-12-11 15:40:09'),(325,7,38,'2020-05-15',NULL,11,2708.33,'UNPAID','2019-12-11 15:40:09'),(326,7,38,'2020-05-30',NULL,12,2708.33,'UNPAID','2019-12-11 15:40:09'),(327,7,38,'2020-06-15',NULL,13,2708.33,'UNPAID','2019-12-11 15:40:09'),(328,7,38,'2020-06-30',NULL,14,2708.33,'UNPAID','2019-12-11 15:40:09'),(329,7,38,'2020-07-15',NULL,15,2708.33,'UNPAID','2019-12-11 15:40:09'),(330,7,38,'2020-07-30',NULL,16,2708.33,'UNPAID','2019-12-11 15:40:09'),(331,7,38,'2020-08-15',NULL,17,2708.33,'UNPAID','2019-12-11 15:40:09'),(332,7,38,'2020-08-30',NULL,18,2708.33,'UNPAID','2019-12-11 15:40:09'),(333,7,38,'2020-09-15',NULL,19,2708.33,'UNPAID','2019-12-11 15:40:09'),(334,7,38,'2020-09-30',NULL,20,2708.33,'UNPAID','2019-12-11 15:40:09'),(335,7,38,'2020-10-15',NULL,21,2708.33,'UNPAID','2019-12-11 15:40:09'),(336,7,38,'2020-10-30',NULL,22,2708.33,'UNPAID','2019-12-11 15:40:09'),(337,7,38,'2020-11-15',NULL,23,2708.33,'UNPAID','2019-12-11 15:40:09'),(338,7,38,'2020-11-30',NULL,24,2708.33,'UNPAID','2019-12-11 15:40:09');

/*Table structure for table `lend_transactions` */

DROP TABLE IF EXISTS `lend_transactions`;

CREATE TABLE `lend_transactions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `advance_payment_id` int(11) DEFAULT NULL,
  `borrower_id` int(11) DEFAULT NULL,
  `payment` int(11) DEFAULT NULL,
  `admin_id` varchar(45) DEFAULT NULL,
  `payment_id` int(11) DEFAULT NULL,
  `rdate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=58 DEFAULT CHARSET=latin1;

/*Data for the table `lend_transactions` */

insert  into `lend_transactions`(`id`,`advance_payment_id`,`borrower_id`,`payment`,`admin_id`,`payment_id`,`rdate`) values (57,6,7,2708,'8',317,'2019-12-11 15:43:47'),(56,6,7,2708,'8',316,'2019-12-11 15:43:47'),(55,6,7,2708,'8',315,'2019-12-11 15:43:47'),(54,5,6,43333,'8',281,'2019-12-11 12:07:33'),(53,5,6,43333,'8',280,'2019-12-11 12:07:33'),(52,5,6,43333,'8',279,'2019-12-11 12:07:33');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
