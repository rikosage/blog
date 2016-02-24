-- MySQL dump 10.13  Distrib 5.5.47, for debian-linux-gnu (i686)
--
-- Host: localhost    Database: blog
-- ------------------------------------------------------
-- Server version	5.5.47-0ubuntu0.14.04.1

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
-- Table structure for table `article-to-tag`
--

DROP TABLE IF EXISTS `article-to-tag`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `article-to-tag` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `article_id` int(11) NOT NULL,
  `tag_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `article_id_2` (`article_id`,`tag_id`),
  UNIQUE KEY `article_id_3` (`article_id`,`tag_id`),
  KEY `article_id` (`article_id`,`tag_id`)
) ENGINE=InnoDB AUTO_INCREMENT=40 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `article-to-tag`
--

LOCK TABLES `article-to-tag` WRITE;
/*!40000 ALTER TABLE `article-to-tag` DISABLE KEYS */;
INSERT INTO `article-to-tag` VALUES (1,14,1),(2,14,2),(3,15,1),(17,32,1),(18,32,3),(22,33,1),(24,33,6),(19,35,1),(20,35,2),(25,42,8),(26,42,10),(27,42,12),(28,42,13),(29,43,12),(30,43,13),(31,43,14),(32,43,15),(33,44,15),(34,44,16),(35,44,17),(36,44,18),(37,45,19),(38,45,20),(39,45,21);
/*!40000 ALTER TABLE `article-to-tag` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `articles`
--

DROP TABLE IF EXISTS `articles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `articles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `category_id` int(11) NOT NULL,
  `sub_category_id` int(11) NOT NULL,
  `title` text CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `short_content` text CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `full_content` text CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `date` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `sub_id` (`sub_category_id`),
  KEY `category_id` (`category_id`)
) ENGINE=InnoDB AUTO_INCREMENT=46 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `articles`
--

LOCK TABLES `articles` WRITE;
/*!40000 ALTER TABLE `articles` DISABLE KEYS */;
INSERT INTO `articles` VALUES (42,6,11,'Мануал по PHP','\r\n\r\nPHP, расшифровывающийся как \"PHP: Hypertext Preprocessor\" - «PHP: Препроцессор Гипертекста», является распространенным интерпретируемым языком общего назначения с открытым исходным кодом. PHP создавался специально для ведения web-разработок и код на нем может внедряться непосредственно в HTML-код. Синтаксис языка берет начало из C, Java и Perl, и является легким для изучения. Основной целью PHP является ','\r\n\r\nPHP, расшифровывающийся как \"PHP: Hypertext Preprocessor\" - «PHP: Препроцессор Гипертекста», является распространенным интерпретируемым языком общего назначения с открытым исходным кодом. PHP создавался специально для ведения web-разработок и код на нем может внедряться непосредственно в HTML-код. Синтаксис языка берет начало из C, Java и Perl, и является легким для изучения. Основной целью PHP является предоставление web-разработчикам возможности быстрого создания динамически генерируемых web-страниц, однако область применения PHP не ограничивается только этим.\r\n\r\nЭто руководство состоит, главным образом, из справочника функций, а также содержит справочник языка, комментарии к наиболее важным из отличительных особенностей PHP, и другие дополнительные сведения.\r\n\r\nЭто руководство доступно в нескольких форматах по адресу » http://www.php.net/download-docs.php. Более подробную информацию о том, как ведется работа над руководством, вы сможете получить обратившись к приложению Об этом руководстве. Если вам интересна история PHP, обратитесь к соответствующему приложению. ','2016-02-24 06:59:32'),(43,6,30,'Регулярные выражения','                    Каждый веб-программист сталкивался с задачей, когда в произвольном тексте нужно найти какие-то данные по какому-то закону, проверить данные, которые поступили от пользователя, подвергнуть найденные данные сложной модификации. Можно изобретать велосипед, а можно использовать средства, которые используют программисты всего мира. Иной раз кажется, что профи пользуются ','                    Каждый веб-программист сталкивался с задачей, когда в произвольном тексте нужно найти какие-то данные по какому-то закону, проверить данные, которые поступили от пользователя, подвергнуть найденные данные сложной модификации. Можно изобретать велосипед, а можно использовать средства, которые используют программисты всего мира. Иной раз кажется, что профи пользуются какими-то инструментами, приемами, которые доступны только им. Разочарую читателя, что профи используют те же средства и инструменты, что и вы, только разница состоит в том, что они ими умеют пользоваться и умеют выбирать, какой инструмент стоит использовать в конкретном случае.\r\n\r\nДанный материал призван помочь программистам решать насущные задачи при помощи регулярных выражений. Я постараюсь описать самые основы использования этого инструмента, чтобы вы не смотрели на комбинацию подобную этой: /^(?:http:\\/\\/)?[-0-9a-z._]*.\\w{2,4}[:0-9]*$/ как баран на новые ворота.\r\n\r\nОбщая задача механизма регулярных выражений - находить или не находить совпадения строки или ее части с шаблоном. Проанализируем первое предложение этого абзаца на предмет непонятных или пугающих слов:\r\n\r\n\"Механизм регулярных выражений\" и \"шаблон\" - вот два слова, которые меня повергли в уныние, когда я понял, что без использования регулярных выражений мне не обойтись. Имеем какой-то механизм, который что-то ищет и находит либо ищет и не находит, с этим \"что-то\" связаны такие понятия как строка и шаблон. Вот с них и будем разбираться и ими же и закончим, потому что после того, как мы разберемся, что делает этот механизм со строками и шаблонами, нам не надо будет лезть в учебники по математике и искать, что означают слова \"регулярные выражения\".                 ','2016-02-24 07:04:29'),(44,7,16,'Про Ubuntu','Как только вы завершите установку, ваша система сразу же готова к работе. Вам не нужно устанавливать необходимые каждому компьютеру программы (архиваторы, плееры, браузеры, др.). У Вас есть полный комплект бизнес-приложений, интернет-приложений, приложений для работы с графикой и игр, а так же программы для настройки внешнего вида. Один диск предоставит вам хорошее рабочее окружен','Как только вы завершите установку, ваша система сразу же готова к работе. Вам не нужно устанавливать необходимые каждому компьютеру программы (архиваторы, плееры, браузеры, др.). У Вас есть полный комплект бизнес-приложений, интернет-приложений, приложений для работы с графикой и игр, а так же программы для настройки внешнего вида. Один диск предоставит вам хорошее рабочее окружение «из коробки» со множеством приложений для домашних и бизнес пользователей, установленных по умолчанию. Есть тысячи других программ, доступных с помощью всего нескольких кликов (или пару строчек в терминале), чтобы предоставить основные приложения просто и эффективно. \r\n\r\nUbuntu имеет несколько способов установки на компьютер. Существует две редакции установочного диска.\r\n\r\nПервая представляет собой LiveCD с графическим установщиком на множестве языков. Установка с помощью этого установщиком является очень простой, благодаря родному языку и понятным диалоговым окнам.\r\n\r\nВторая редакция диска представляет собой Alternate установщик. Так выглядела установка в первых релизах Ubuntu. На данный момент эта редакция диска используется в тех случаях, когда невозможна установка с LiveCD. В Alternate версии установщик не графический, а текстовый. В нём до сих пор есть несколько мест, где вы должны знать что вы делаете, но значения по умолчанию подойдут для большинства пользователей.\r\n\r\nРазработчики Ubuntu сделали комплект установочных дисков, состоящий всего лишь из одного CD, всё остальное доступно по сети в случае необходимости.\r\n\r\nНа компьютере средней конфигурации базовая установка Ubuntu производится менее чем за полчаса.\r\n\r\nПри выходе нового релиза Ubuntu не обязательно переустанавливать всю систему, а достаточно обновить ее с текущей версии на следующую через интернет, когда вы захотите.\r\n\r\nВажно! Перед установкой желательно все же ознакомиться с примерами установки.\r\nКоманда разработчиков Ubuntu выпускает новую версию Ubuntu каждые шесть месяцев. Она содержит последнюю стабильную версию ядра, X, Unity и других основных приложений и поддерживается обновлениями безопасности в течение 9 месяцев. Первым публичным релизом Ubuntu был Ubuntu 4.10 Preview (кодовое название «the Warty Warthog» или просто «Warty»). На данный момент для скачивания с сайта Ubuntu доступен релиз Ubuntu 14.04 Trusty Tahr (LTS). Приставка LTS (Long Term Support) обозначает длительную поддержку релиза в течение 5-ти лет для серверной и десктопной версии. ','2016-02-24 07:09:01'),(45,8,23,'Nvidia GeForce GTX 980','GeForce GTX 980 – это самая технически продвинутая видеокарта в мире, созданная на основе новой, невероятно производительной и энергоэффективной архитектуры NVIDIA® Maxwell™. Благодаря удвоенной производительности по сравнению с видеокартами предыдущего поколения* и новым впечатляющим игровым технологиям, этот инновационный GPU обеспечивает высококлассный игровой процесс в виртуальной ','GeForce GTX 980 – это самая технически продвинутая видеокарта в мире, созданная на основе новой, невероятно производительной и энергоэффективной архитектуры NVIDIA® Maxwell™. Благодаря удвоенной производительности по сравнению с видеокартами предыдущего поколения* и новым впечатляющим игровым технологиям, этот инновационный GPU обеспечивает высококлассный игровой процесс в виртуальной реальности на HD дисплеях и дисплеях ультравысокого разрешения 4K. Ti - две самые значимые буквы в мире игровых GPU. В комбинации с флагманским игровым GPU видеокарта GeForce GTX 980 Ti обеспечивает новый, невероятный уровень производительности и игровых возможностей. Получившая ускорение благодаря революционной архитектуре NVIDIA Maxwell™, GTX 980 Ti обеспечивает невероятный игровой процесс в разрешении 4К и виртуальной реальности.','2016-02-24 07:10:48');
/*!40000 ALTER TABLE `articles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `category`
--

DROP TABLE IF EXISTS `category`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` text CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `category`
--

LOCK TABLES `category` WRITE;
/*!40000 ALTER TABLE `category` DISABLE KEYS */;
INSERT INTO `category` VALUES (6,'Программирование'),(7,'Системное администрирование'),(8,'Железо'),(9,'IT-фишки');
/*!40000 ALTER TABLE `category` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `comments`
--

DROP TABLE IF EXISTS `comments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `comments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `article_id` int(11) NOT NULL,
  `nickname` text CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `content` text CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`id`),
  KEY `article_id` (`article_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `comments`
--

LOCK TABLES `comments` WRITE;
/*!40000 ALTER TABLE `comments` DISABLE KEYS */;
/*!40000 ALTER TABLE `comments` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `emails`
--

DROP TABLE IF EXISTS `emails`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `emails` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` text NOT NULL,
  `username` text CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `emails`
--

LOCK TABLES `emails` WRITE;
/*!40000 ALTER TABLE `emails` DISABLE KEYS */;
/*!40000 ALTER TABLE `emails` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sub_category`
--

DROP TABLE IF EXISTS `sub_category`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sub_category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `category_id` int(11) NOT NULL,
  `name` text CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`id`),
  KEY `category_id` (`category_id`)
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sub_category`
--

LOCK TABLES `sub_category` WRITE;
/*!40000 ALTER TABLE `sub_category` DISABLE KEYS */;
INSERT INTO `sub_category` VALUES (11,6,'PHP'),(12,6,'Javascript'),(13,6,'Yii2 Framework'),(14,6,'CSS'),(15,6,'Язык C'),(16,7,'Ubuntu'),(17,7,'KDE'),(18,7,'Kubuntu'),(19,7,'Debian'),(20,7,'OS X'),(21,7,'Windows'),(22,8,'Процессоры'),(23,8,'Видеокарты'),(24,8,'Оперативная память'),(25,8,'Жесткие диски'),(26,8,'Мониторы'),(28,9,'Лайфхаки'),(29,9,'Шутки'),(30,6,'Общие сведения');
/*!40000 ALTER TABLE `sub_category` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tags`
--

DROP TABLE IF EXISTS `tags`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tags` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` text CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tags`
--

LOCK TABLES `tags` WRITE;
/*!40000 ALTER TABLE `tags` DISABLE KEYS */;
INSERT INTO `tags` VALUES (8,'PHP'),(9,'Javascript'),(10,'Web'),(11,'Framework'),(12,'Программирование'),(13,'Код'),(14,'Регулярные выражения'),(15,'Это надо знать'),(16,'Ubuntu'),(17,'Linux'),(18,'Операционная система'),(19,'Nvidia'),(20,'Видеокарта'),(21,'Windows');
/*!40000 ALTER TABLE `tags` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2016-02-24 18:57:36
