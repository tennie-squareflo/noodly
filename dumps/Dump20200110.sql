-- MySQL dump 10.13  Distrib 5.7.28, for Linux (x86_64)
--
-- Host: 127.0.0.1    Database: noodlyad_db
-- ------------------------------------------------------
-- Server version	5.7.28-0ubuntu0.19.04.2

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `categories`
--

DROP TABLE IF EXISTS `categories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `categories` (
  `cid` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(216) DEFAULT NULL,
  `pid` int(11) DEFAULT NULL,
  `slug` varchar(216) DEFAULT NULL,
  `image` varchar(512) DEFAULT NULL,
  PRIMARY KEY (`cid`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `categories`
--

LOCK TABLES `categories` WRITE;
/*!40000 ALTER TABLE `categories` DISABLE KEYS */;
INSERT INTO `categories` VALUES (1,'Autos & Mechanical',2,NULL,NULL),(2,'Cleaning',2,NULL,NULL),(3,'Creative',2,NULL,NULL),(4,'Delivery',1,NULL,NULL),(5,'Handyman',1,NULL,NULL),(6,'Other',3,NULL,NULL),(7,'Test Section1',2,'test-section',''),(15,'TestTest',2,'testtest',''),(16,'MyTest',2,'mytest','5e15f817a3fa2_5dffbe9e45f86_header-2-image-1.jpg');
/*!40000 ALTER TABLE `categories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `environment`
--

DROP TABLE IF EXISTS `environment`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `environment` (
  `eid` int(11) NOT NULL AUTO_INCREMENT,
  `env_name` varchar(45) DEFAULT NULL,
  `env_value` varchar(512) DEFAULT NULL,
  `pid` varchar(45) DEFAULT '0',
  PRIMARY KEY (`eid`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `environment`
--

LOCK TABLES `environment` WRITE;
/*!40000 ALTER TABLE `environment` DISABLE KEYS */;
INSERT INTO `environment` VALUES (1,'email_expiration_time','4320','0'),(2,'email_background_image','5de70e4c9b6e2_header-2-image-2.jpg','0'),(3,'email_background_color','#000000','0'),(4,'email_foreground_color','#cccccc','0'),(5,'email_new_user_title','<strong>%publisher%</strong> account Created','0'),(6,'email_new_user_message','Please click on the button below to complete profile for your new <strong>%publisher%</strong> account.','0'),(7,'email_new_role_title','You are invited to <strong>%publisher%</strong>','0'),(8,'email_new_role_message','You are invited to <strong>%publisher%</strong>, please click on the button below to accept the invitation.','0'),(9,'email_invitation_title','Re-Invitation to <strong>%publisher%</strong>','0'),(10,'email_invitation_message','You are invited to %publisher%, please click on the button below to accept the invitation.','0');
/*!40000 ALTER TABLE `environment` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `match_user_role`
--

DROP TABLE IF EXISTS `match_user_role`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `match_user_role` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uuid` int(11) DEFAULT NULL,
  `pid` int(11) DEFAULT NULL,
  `role` varchar(45) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_UNIQUE` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=35 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `match_user_role`
--

LOCK TABLES `match_user_role` WRITE;
/*!40000 ALTER TABLE `match_user_role` DISABLE KEYS */;
INSERT INTO `match_user_role` VALUES (1,2,1,'admin',1),(4,3,1,'contributor',1),(6,4,3,'admin',1),(8,5,3,'admin',1),(10,7,1,'contributor',1),(12,7,3,'contributor',0),(21,14,3,'admin',0),(22,14,1,'contributor',0),(24,17,2,'admin',1576509191),(25,4,2,'contributor',1576753505),(33,19,2,'contributor',1),(34,20,2,'contributor',1576920852);
/*!40000 ALTER TABLE `match_user_role` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `paragraphs`
--

DROP TABLE IF EXISTS `paragraphs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `paragraphs` (
  `pid` int(11) NOT NULL AUTO_INCREMENT,
  `type` varchar(45) DEFAULT NULL,
  `content` varchar(2000) DEFAULT NULL,
  `prev_pid` int(11) DEFAULT NULL,
  `next_pid` int(11) DEFAULT NULL,
  `sid` int(11) DEFAULT NULL,
  PRIMARY KEY (`pid`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `paragraphs`
--

LOCK TABLES `paragraphs` WRITE;
/*!40000 ALTER TABLE `paragraphs` DISABLE KEYS */;
INSERT INTO `paragraphs` VALUES (1,'video','4',0,2,4),(2,'video','1',1,3,4),(3,'heading','3',2,4,4),(4,'heading','2',3,0,4),(9,'image','5e00115d13d3c_logo-2gf-WcV.png',NULL,NULL,4),(10,'image','5e160e291a97b_5dffbe9e45f86_header-2-image-1.jpg',0,11,8),(11,'text','fweaf awefg arwgarwg argagag ag argargarg',10,0,8),(12,'image','5e160e291a97b_5dffbe9e45f86_header-2-image-1.jpg',0,13,9),(13,'text','fweaf awefg arwgarwg argagag ag argargarg',12,0,9),(14,'image','5e160e291a97b_5dffbe9e45f86_header-2-image-1.jpg',0,15,10),(15,'text','fweaf awefg arwgarwg argagag ag argargarg',14,0,10),(16,'image','',0,17,11),(17,'text','fweaf awefg arwgarwg argagag ag argargarg',16,18,11),(18,'image','',17,0,11),(19,'image','',0,0,12),(20,'text','Aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum bore et dolore magna aliqua.\r\nAliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum bore et dolore magna aliqua.\r\nAliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum bore et dolore magna aliqua.\r\nAliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum bore et dolore magna aliqua.\r\nAliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum bore et dolore magna aliqua.Aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum bore et dolore magna aliqua.Aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum bore et dolore magna aliqua.Aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum bore et dolore magna aliqua.\r\nAliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum bore et dolore magna aliqua.',0,21,4),(21,'image','5e172c350b423_5dffbe9e45f86_header-2-image-1.jpg',20,22,4),(22,'text','Aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum bore et dolore magna aliqua.Aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum bore et dolore magna aliqua.Aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum bore et dolore magna aliqua.Aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum bore et dolore magna aliqua.Aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum bore et dolore magna aliqua.\r\nAliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum bore et dolore magna aliqua.Aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum bore et dolore magna aliqua.\r\nAliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum bore et dolore magna aliqua.\r\nAliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum bore et dolore magna aliqua.',21,23,4),(23,'image','5e172c4328f4f_5dffc41db54fb_logo-2gf-WcV.png',22,0,4);
/*!40000 ALTER TABLE `paragraphs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `publishers`
--

DROP TABLE IF EXISTS `publishers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `publishers` (
  `pid` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) DEFAULT NULL,
  `logo` varchar(512) DEFAULT NULL,
  `domain` varchar(45) DEFAULT NULL,
  `phonenumber` varchar(45) DEFAULT NULL,
  `email` varchar(45) DEFAULT NULL,
  `country` varchar(45) DEFAULT NULL,
  `state` varchar(45) DEFAULT NULL,
  `address1` varchar(45) DEFAULT NULL,
  `address2` varchar(45) DEFAULT NULL,
  `city` varchar(45) DEFAULT NULL,
  `zipcode` varchar(45) DEFAULT NULL,
  `adminlogo` varchar(512) DEFAULT NULL,
  `favicon` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`pid`),
  UNIQUE KEY `pid_UNIQUE` (`pid`),
  UNIQUE KEY `domain_UNIQUE` (`domain`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `publishers`
--

LOCK TABLES `publishers` WRITE;
/*!40000 ALTER TABLE `publishers` DISABLE KEYS */;
INSERT INTO `publishers` VALUES (0,'Noodly','logo-2.png','','','donotreply@noodly.io','',NULL,NULL,NULL,NULL,NULL,NULL,NULL),(1,'Test Keen','5ddff3dfe4f0f_yqrdaily.png','testkeen','123123123','someone@some.com','Tuvalu','Fongafale','Some address','Some address','Some city','416',NULL,'5e1764f6e0256_5dffbf9d3c04a_logo-2gf-WcV.png'),(2,'YQR Daily','yqrdaily.png','yqrdaily','123123123','someone@some.com','Tuvalu','Fongafale','Some address','Some address','Some city','416','5e1444341e83f_404.png',NULL),(3,'Test Keen2','logo-launcher-2.png','testkeen2','123123123','someone@some.com','Tuvalu','Fongafale','Some address','Some address','Some city','416','5e1445f6b55cf_coming-soon.png','5e1764f6e0256_5dffbf9d3c04a_logo-2gf-WcV.png'),(4,'favicontest','5e1764725d79a_5dffbf9d3c04a_logo-2gf-WcV.png','favicontest','123123123','someone@some.com','Andorra','La Massana','Some address','Some address','Some city','416','5e176475b3ac9_5dffbf9d3c04a_logo-2gf-WcV.png','5e1764f6e0256_5dffbf9d3c04a_logo-2gf-WcV.png'),(5,'favtest','5e1764f15f71e_5dffbe96c8ec1_logo-2gf-WcV.png','favtest','123123123','someone@some.com','Andorra','Ordino','Some address','Some address','Some city','416','5e1764f442b85_5dffbe96c8ec1_logo-2gf-WcV.png','5e1764f6e0256_5dffbf9d3c04a_logo-2gf-WcV.png');
/*!40000 ALTER TABLE `publishers` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `stories`
--

DROP TABLE IF EXISTS `stories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `stories` (
  `sid` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(512) DEFAULT NULL,
  `uuid` int(11) NOT NULL,
  `cid` int(11) NOT NULL,
  `thumb_image` varchar(512) DEFAULT NULL,
  `cover_image` varchar(512) DEFAULT NULL,
  `summary` varchar(1024) DEFAULT NULL,
  `first_pid` int(11) DEFAULT NULL,
  `visits` int(11) unsigned zerofill DEFAULT NULL,
  `status` varchar(45) DEFAULT NULL,
  `pid` int(11) NOT NULL,
  `created_at` varchar(45) DEFAULT NULL,
  `first_paragraph` varchar(2048) DEFAULT NULL,
  `url` varchar(128) DEFAULT NULL,
  PRIMARY KEY (`sid`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `stories`
--

LOCK TABLES `stories` WRITE;
/*!40000 ALTER TABLE `stories` DISABLE KEYS */;
INSERT INTO `stories` VALUES (1,'Lorem ipsum dolor sit amet, consectetur adipiscing elit. ',9,3,'5dfceca583cae_Screen Shot 2019-12-20 at 9.png','5dfcecac63df1_Screen Shot 2019-12-20 at 9.png','Curabitur nisi augue, varius vel felis non, sollicitudin malesuada enim.',0,00000000000,'SUBMITTED',2,'2019-12-20 15:46:54','In consectetur mi quis arcu tempus, viverra euismod magna efficitur. Pellentesque tincidunt metus ut mollis vulputate. Interdum et malesuada fames ac ante ipsum primis in faucibus. Ut in viverra elit. Sed aliquet sapien leo, et scelerisque mi tincidunt a. Aenean mi dolor, posuere sed vulputate id, imperdiet sit amet dui. Nulla in ex vitae nisl gravida vulputate. Nullam quis dolor porta, dictum quam eu, porttitor risus. Quisque ut massa luctus, laoreet felis in, cursus tellus. Quisque eget risus interdum lectus euismod porta aliquet eget urna. Ut non nisi dui. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Vivamus faucibus, massa vitae hendrerit consequat, ante massa dictum libero, ut feugiat nisl massa id nisi. Nunc justo lorem, tempor laoreet porttitor non, ornare non turpis. Maecenas congue velit eros, vel tincidunt tortor dignissim vitae. Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus.','lorem-ipsum-amaente'),(2,'abcd',9,2,'5dffbe96c8ec1_logo-2gf-WcV.png','5dffbe9e45f86_header-2-image-1.jpg','tt',0,00000000000,'SUBMITTED',2,'2019-12-22 14:08:07','f','abcd'),(3,'abcd',9,2,'5dffbe96c8ec1_logo-2gf-WcV.png','5dffbe96c8ec1_logo-2gf-WcV.png','tt',0,00000000000,'SUBMITTED',2,'2019-12-22 14:09:05','f','abcdef'),(4,'WidthTest',9,7,'5e172bec3ddf6_5dfce1e510569_shutterstock_1069579556.jpg','5e172bf8dcd93_5dfce1e510569_shutterstock_1069579556.jpg','asdf asdf wae qetqt q tqrtqr tqrtqrgrg eg ethq gqre qrtq rhqrh qre gqrqerg vqr grqeg erg ewget whtehet h',20,00000000000,'PUBLISHED',2,'2020-01-09 08:36:10','Aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum bore et dolore magna aliqua.\r\nAliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum bore et dolore magna aliqua.','widthtest'),(5,'gsdf gsdfg ser gser',9,7,'5e177ba04a425_5dffbf9d3c04a_logo-2gf-WcV.png','5e177ba04a425_5dffbf9d3c04a_logo-2gf-WcV.png','fasd fasdf ae',0,00000000000,'PUBLISHED',2,'2020-01-09 14:14:50','ger gwergweg ewg wer hgwehwe hwthw th','gsdf-gsdfg-ser-gser'),(6,'fwe wgqrg qrgqergrrrrrrrrrr',9,3,'5e177e3887b7e_5dffc1aa1b45d_logo-2gf-WcV.png','5e177e3887b7e_5dffc1aa1b45d_logo-2gf-WcV.png','gwer gwethwtehwth',0,00000000000,'PUBLISHED',2,'2020-01-09 14:26:21','','fwe-wgqrg-qrgqergrrrrrrrrrr');
/*!40000 ALTER TABLE `stories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `subscription`
--

DROP TABLE IF EXISTS `subscription`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `subscription` (
  `id` int(11) NOT NULL,
  `uuid` int(11) DEFAULT NULL,
  `type` varchar(45) DEFAULT NULL,
  `refid` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `subscription`
--

LOCK TABLES `subscription` WRITE;
/*!40000 ALTER TABLE `subscription` DISABLE KEYS */;
/*!40000 ALTER TABLE `subscription` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `uuid` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(45) DEFAULT NULL,
  `firstname` varchar(45) DEFAULT NULL,
  `lastname` varchar(45) DEFAULT NULL,
  `password` varchar(45) DEFAULT NULL,
  `role` varchar(45) DEFAULT NULL,
  `avatar` varchar(512) DEFAULT NULL,
  `phonenumber` varchar(45) DEFAULT NULL,
  `country` varchar(45) DEFAULT NULL,
  `state` varchar(45) DEFAULT NULL,
  `address1` varchar(45) DEFAULT NULL,
  `address2` varchar(45) DEFAULT NULL,
  `city` varchar(45) DEFAULT NULL,
  `zipcode` varchar(45) DEFAULT NULL,
  `status` int(11) DEFAULT '0',
  PRIMARY KEY (`uuid`),
  UNIQUE KEY `uuid_UNIQUE` (`uuid`),
  UNIQUE KEY `email_UNIQUE` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (2,'user1@some.com','User','1','202cb962ac59075b964b07152d234b70','',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0),(3,'user2@some.com','User','2','202cb962ac59075b964b07152d234b70','','','123123123','Andorra','Canillo','Some address','Some address','Some city','416',1),(4,'user3@some.com','User','3','202cb962ac59075b964b07152d234b70','','','','','','','','','',1576753505),(5,'user4@some.com','User','4','202cb962ac59075b964b07152d234b70','','','','','','','','','',1575537575),(6,'user5@some.com','User','5','202cb962ac59075b964b07152d234b70','','','123','Atlantic Ocean (South)','South Orkney Islands','123','','123','123',1),(7,'user6@some.com','User','6','202cb962ac59075b964b07152d234b70','','','1 123 123 1234','Canada','Ontario','Address1','','City1','Zip1',1),(8,'user7@some.com','User','7','202cb962ac59075b964b07152d234b70','','','','','','','','','',0),(9,'jaco@squareflo.com','Jaco','','d6a794234f2ee74061f3cf0a38a3cefb','super_admin','','123123123','Canada','Northwest Territories','Some address','Some address','Some city','416',1),(10,'temp@temp.com','Temp','',NULL,'super_admin','','','','','','','','',1575798815),(13,'someone@some.com','David',NULL,NULL,'super_admin',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0),(14,'som@some.com','Test',NULL,NULL,'',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0),(15,'testuser@user.com','TestUser',NULL,NULL,'super_admin',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1576503127),(16,'some123@some.com','someone1123',NULL,NULL,'',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1576509177),(17,'some1123@some.com','someone1123',NULL,NULL,'',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1576509191),(19,'everdev0923@gmail.com','David',NULL,NULL,'',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1576917871),(20,'some11123@some.com','temp',NULL,NULL,'',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1576920619);
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2020-01-10  5:46:51
