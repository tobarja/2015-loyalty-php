DROP TABLE IF EXISTS `redeemlog`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `redeemlog` (
  `entryID` int(11) NOT NULL AUTO_INCREMENT,
  `time` timestamp default current_timestamp,
  `user` varchar(50) NOT NULL,
  `point` int(3) not null,
  PRIMARY KEY (`entryID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;
