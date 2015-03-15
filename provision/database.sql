DROP TABLE IF EXISTS `Customers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Customers` (
  `CustomerID` int(11) NOT NULL AUTO_INCREMENT,
  `FirstName` varchar(50) NOT NULL,
  `LastName` varchar(50) NOT NULL,
  `Points` int(11) NOT NULL DEFAULT '0',
  `Email` varchar(150) DEFAULT NULL,
  PRIMARY KEY (`CustomerID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;
INSERT INTO `Customers` VALUES (1,'Mario','Vickers',10,'mario@example.com');
INSERT INTO `Customers` VALUES (2,'Andrea','Plante',1,'andrea.plante@example.com');
INSERT INTO `Customers` VALUES (3,'Kevin','Brown',0,NULL);
INSERT INTO `Customers` VALUES (4,'Tony','Volcy',9,'tvolcy@example.com');
INSERT INTO `Customers` VALUES (5,'Bradley','Toms',4,'tomsb@example.com');
INSERT INTO `Customers` VALUES (6,'Kenneth','Barber',2,'k.barber@example.com');
INSERT INTO `Customers` VALUES (7,'Vince','Sauve',9,'vincesauve@example.com');
INSERT INTO `Customers` VALUES (8,'Otto','Flamand',3,'otto.flamand1@example.com');
INSERT INTO `Customers` VALUES (9,'Ford','Doran',0,NULL);
INSERT INTO `Customers` VALUES (10,'Joan','Mccloskey',0,'123@example.com');
INSERT INTO `Customers` VALUES (11,'Aime','Yasinsky',0,'aime_y@example.com');
INSERT INTO `Customers` VALUES (12,'Joseph','Leamon',9001,'joseph3@example.com');
INSERT INTO `Customers` VALUES (13,'Luis','Tackaberry',1,'luist@example.com');
INSERT INTO `Customers` VALUES (14,'Doug','Stolk',11,'doug.stolk@example.com');
INSERT INTO `Customers` VALUES (15,'Patricia','Downey',0,'PATRICIA@example.com');
INSERT INTO `Customers` VALUES (16,'Wendy','Anglehart',0,'anglehart@example.com');
INSERT INTO `Customers` VALUES (17,'Francis','Hogue',0,'fh@example.com');
