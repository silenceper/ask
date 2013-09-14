-- MySQL dump 10.13  Distrib 5.5.28, for Win32 (x86)
--
-- Host: localhost    Database: ask
-- ------------------------------------------------------
-- Server version	5.5.28-log

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
-- Table structure for table `ask_admin`
--

DROP TABLE IF EXISTS `ask_admin`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ask_admin` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `username` char(15) NOT NULL,
  `email` char(40) NOT NULL,
  `password` char(32) NOT NULL,
  `login_time` int(10) NOT NULL,
  `join_time` int(10) NOT NULL,
  `status` tinyint(1) NOT NULL COMMENT '0：禁止  1：正常',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ask_admin`
--

LOCK TABLES `ask_admin` WRITE;
/*!40000 ALTER TABLE `ask_admin` DISABLE KEYS */;
INSERT INTO `ask_admin` VALUES (1,'wenzhenlin','wenzhenlin@wenzhenlin.com','0a26c80a46114477110f8e3fee4b714e',1372918686,111111111,1);
/*!40000 ALTER TABLE `ask_admin` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ask_answer`
--

DROP TABLE IF EXISTS `ask_answer`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ask_answer` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键',
  `question_id` int(11) unsigned NOT NULL COMMENT '问题id',
  `answer_content` text NOT NULL COMMENT '回答内容',
  `add_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '回答时间',
  `against_count` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '不赞同的数量',
  `agree_count` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '赞同的数量',
  `uid` int(10) unsigned NOT NULL COMMENT '用户id',
  `comment_count` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '评论总数',
  `has_attach` tinyint(1) NOT NULL DEFAULT '0' COMMENT '是否存在附件',
  `ip` char(15) NOT NULL DEFAULT '' COMMENT 'ip地址',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ask_answer`
--

LOCK TABLES `ask_answer` WRITE;
/*!40000 ALTER TABLE `ask_answer` DISABLE KEYS */;
INSERT INTO `ask_answer` VALUES (1,1,'每天吃圣女果，西红柿，西瓜，最好喝柠檬水，还有葡萄。',1372822861,0,0,1,0,0,'127.0.0.1'),(2,4,'最低配置全新的不带显示器、机箱、显卡2500元够了，硬盘希捷或WD 500G 16M 500元以内，主板800元内算不错了，DDR3 8G内存500元左右 CPU500元~700元自己选吧。二手的估计1500左右带主机显卡不带显示器。',1372823203,0,0,1,0,0,'127.0.0.1'),(4,6,'一般CPU最大忍受温度是80摄氏度，也有些90度都不烧的可以拿来煮鸡蛋。长期在这么高温度运行容易减短寿命，建议平时不要超过70摄氏度，实际上不超频就算满载也一般很少过70度',1372824477,0,0,3,0,0,'127.0.0.1'),(5,10,'脑很卡都是资源不够快或不够用造成。通常不是因为被流氓程序占用卡就是被病毒影响变卡。\r\n正是CPU使用很高才卡，你查看线程看是哪个文件使用CPU最多，通常问题就出在这里!查一下这个占用CPU资源最高的文件不是正常文件。如果能判断出这不是正常系统必需的文件，则可以中断这一线程，之后再对这文件进行删除/拆卸等处理。',1372827427,0,0,2,1,0,'127.0.0.1'),(6,15,'他爱O型血.不知道是这种血甜还是什么原因啊',1372828027,0,0,1,0,0,'127.0.0.1'),(7,7,'有用，花露水中含有微量驱蚊水，可以达到驱蚊作用。但花露水蒸发快，擦一次只有一两个小时有效期。',1372828437,0,0,1,0,0,'127.0.0.1'),(8,8,'荷藿薏仁粥 \r\n\r\n　　荷藿薏仁粥是用鲜荷叶100克、藿香30克（干品，鲜藿香则用嫩茎叶50克），加水800毫升，煮沸后，小火再熬20分钟，滤去渣，取药液约500毫升；用此药液与薏苡仁100克煮成稀粥。早晚各吃1次。 \r\n\r\n　　荷叶既芳香化湿，又清热解暑，是夏日的解暑佳品。配藿香能增强芳香化湿的功效，其性味辛温，又能疏散外寒。薏苡仁健脾利湿，使暑湿从小便而去。现代研究，薏苡仁还有增强免疫功能，提高适应能力的作用。所以本方对从高温环境进入空调房间，因适应力差而出现类似感冒风寒的症状者，有很好的防治效果。',1372828474,0,0,1,1,0,'127.0.0.1'),(9,9,'你的问题比较麻烦，有很多可能性。<br/>\r\n1.灰尘问题，清理机箱内部硬件\r\n2.硬件接触不良，自己检查一下\r\n3.软件或者是驱动方面有冲突（可能性比较大），你看看事件查看器有没有错误的提示，再打开设备管理器---查看，勾选显示隐藏的设备，看看有没有挂有黄色叹号的设备。\r\n4.杀毒和流氓软件什么的，不过你说音乐变成杂音，可能是你的声卡驱动有问题，完全卸载旧驱动，再更新，要找最稳定的，你可以用用驱动精灵什么的。\r\n如果你嫌麻烦那就只好还原系统或是重装，如果还不能解决，八成是你的硬件出了问题。',1372828509,0,0,1,0,0,'127.0.0.1'),(10,11,'1 000 000 张纸币，如果按 10×10×10000 的方式把这些纸币垒在一起，将会得到一个 1.55 米长、0.77 米宽、1 米高的长方体。不过，运钞车对此表示压力不大。即使算上纸币与纸币之间的空隙，运钞车里装个几亿元绝对没有问题。\r\n\r\n重量方面，1张百元的钞票重约1.15克,1万元新钞就是115克,1亿元人民币重近1150000克,约1.15吨。不是一个人能搬得走的了。',1372828552,0,0,1,0,0,'127.0.0.1'),(11,6,'你用的是什么处理器？如果是奔四的话会承受比较高的温度！酷睿温度如果到40~50度就太高了。AMD的差不多在30到50之间',1372828610,0,0,2,0,0,'127.0.0.1'),(12,7,'花露水含有的一种叫“伊默宁”的成分，可使蚊虫丧失对人叮咬的意识。但让咬了之后就别抹了，抹了会加重伤口。',1372828717,0,0,2,0,0,'127.0.0.1'),(13,8,'多喝水防止皮肤干燥．．有空多出外转转．因为在里面开在空调的空气不好',1372828782,0,0,2,0,0,'127.0.0.1'),(14,9,'我以前碰到过，我的是台式电脑，我的是声卡问题，你的不知道了',1372828807,0,0,2,0,0,'127.0.0.1'),(15,14,'建议用360手机助手    第一次要安装加载驱动      完了后调试下USB \r\n这样还不能连接的话就重启下电脑在连接就行了',1372828842,0,0,2,0,0,'127.0.0.1'),(16,12,'2G内存还是可以的，而且内存是可以升级的。G480红色仅仅是外观方面改动，其他没有区别，G480配置和速度都不错。只要价格合适，买就没问题',1372828926,0,0,2,0,0,'127.0.0.1'),(17,15,'应该没有吧！未必然它还晓得它所吸的是那种血型咯，它有得选择哇',1372829135,0,0,3,0,0,'127.0.0.1'),(18,15,' 蚊子侦测和定位目标主要是靠二氧化碳、热量、挥发性化学物质等因素，目前还没有可靠的证据可以证明不同血型对蚊子的吸引力有差异。',1372829679,0,0,1,1,0,'127.0.0.1'),(19,1,'维生素C是抑制黑斑的有效制剂，堪称美白之王，因此修复晒后的皮肤就必须多食用一些含维生素C的蔬果。另外要想拥有对紫外线防御能力强的肌肤，还须充分摄取防止肌肤老化的维生素E、增加皮肤抵抗力的维生素A及增加皮肤弹性的钙，这些都能从食物或营养补助食品中获得。\r\n西瓜，樱桃，橙子，柠檬，番茄都可以啊！',1372829814,0,0,3,0,0,'127.0.0.1'),(20,15,'B型~',1372829923,0,0,4,0,0,'127.0.0.1'),(21,2,'请双击屏幕右下小喇叭图标，查看是否有显示麦克风选项。如果没有麦克风选项，请点击“选项”-“属性”-在“显示音量控制”下拉选中“麦克风”，点确认。取消麦克风选项下的静音栏的勾。应该可以解决问题。',1372830683,0,0,7,2,0,'127.0.0.1'),(22,2,'先到设备管理器上检查下声卡有没出错，不行的话检查下你话筒是不是插在主机前的插口上，改插到后面试试，有的电脑前面的线没接上的话不行的',1372830741,0,0,5,0,0,'127.0.0.1'),(23,4,'4000差不多',1372897212,0,0,8,0,0,'127.0.0.1');
/*!40000 ALTER TABLE `ask_answer` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ask_answer_comments`
--

DROP TABLE IF EXISTS `ask_answer_comments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ask_answer_comments` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `answer_id` int(11) unsigned NOT NULL,
  `uid` int(11) unsigned NOT NULL,
  `message` text NOT NULL,
  `time` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ask_answer_comments`
--

LOCK TABLES `ask_answer_comments` WRITE;
/*!40000 ALTER TABLE `ask_answer_comments` DISABLE KEYS */;
INSERT INTO `ask_answer_comments` VALUES (1,5,4,' 谢谢！',1372827455),(2,8,3,' 试试',1372828975),(3,18,1,' 来自果壳：http://www.guokr.com/article/57597/',1372829699),(4,21,1,'好像可以',1372830784),(5,21,7,'@test1  可以就行',1372830795);
/*!40000 ALTER TABLE `ask_answer_comments` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ask_answer_vote`
--

DROP TABLE IF EXISTS `ask_answer_vote`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ask_answer_vote` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `answer_id` int(11) unsigned NOT NULL,
  `answer_uid` int(11) unsigned NOT NULL,
  `vote_uid` int(11) unsigned NOT NULL,
  `add_time` int(10) unsigned NOT NULL,
  `vote_value` tinyint(4) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ask_answer_vote`
--

LOCK TABLES `ask_answer_vote` WRITE;
/*!40000 ALTER TABLE `ask_answer_vote` DISABLE KEYS */;
/*!40000 ALTER TABLE `ask_answer_vote` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ask_question`
--

DROP TABLE IF EXISTS `ask_question`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ask_question` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '主键',
  `question_content` varchar(255) NOT NULL COMMENT '问题标题',
  `question_detail` text COMMENT '问题具体描述',
  `add_time` int(10) unsigned NOT NULL COMMENT '发布时间',
  `update_time` int(10) unsigned NOT NULL COMMENT '最后更新时间',
  `published_uid` int(10) unsigned NOT NULL COMMENT '发布者id',
  `answer_count` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '回答人数',
  `view_count` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '查看人数',
  `focus_count` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '关注总人数',
  `comment_count` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '评论总人数',
  `best_answer` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '最佳回复id',
  `has_attach` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '是否存在附件',
  `lock` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '问题是否锁定?1:锁定，0未锁定',
  `ip` char(15) NOT NULL COMMENT 'ip地址',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8 COMMENT='提问信息表';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ask_question`
--

LOCK TABLES `ask_question` WRITE;
/*!40000 ALTER TABLE `ask_question` DISABLE KEYS */;
INSERT INTO `ask_question` VALUES (1,'夏天整天对着电脑吃什么水果好？','',1372822834,1372822834,1,2,8,1,0,19,0,0,'127.0.0.1'),(2,'台式电脑麦克风没有声音','就是台式电脑麦克风（视频用的摄像头）没有声音，只能听到对方的声音，自己说话，对方听不到，怎么回事啊？就帮助，希望解释的详细一点哦',1372822973,1372822973,1,2,13,1,0,21,0,0,'127.0.0.1'),(3,'我的机箱能否装下大霜塔散热器','我的机箱是游戏悍将核武器u3特供版 \r\n\r\n机箱尺寸\r\n460×201×451mm',1372823057,1372823057,1,0,4,0,0,0,0,0,'127.0.0.1'),(4,'现在买一台台式电脑大概要多少钱?','玩CF这样的游戏要不要显卡',1372823177,1372830321,2,2,27,0,0,0,0,0,'127.0.0.1'),(5,'Windows系统怎样配置PHP环境','请问在XP系统怎样配置一个PHP环境呢？希望能得到各前辈指导，最好图文配合，谢谢！！\r\n不要傻瓜式的,要学安装，谢谢！',1372823844,1372823844,1,0,8,1,0,0,0,0,'127.0.0.1'),(6,'冷却风扇：中央处理器多少才正常','',1372823987,1372823987,1,2,16,0,0,4,0,0,'127.0.0.1'),(7,'花露水防蚊虫到底有没有用？','',1372827131,1372827131,3,2,7,0,0,0,0,0,'127.0.0.1'),(8,'吃什么东西可以预防空调病？','',1372827239,1372827239,3,2,11,0,0,8,0,0,'127.0.0.1'),(9,'电脑死机是怎么回事？','',1372827362,1372827362,4,2,6,0,0,0,0,0,'127.0.0.1'),(10,'为什么我的电脑很卡？？？','最近我的电脑不知为什么很卡，杀毒软件一直都在用，都没事，但是今天一开机，开始玩，就很卡了，有时看任务管理器，那个CPU达到67十%，然后过了一两秒，就马上降下来，一直不会升这么高，关了在开也是一样，到底是怎么回事啊？？？？？？？？？？？？？？？？？？？？',1372827392,1372827392,4,1,8,0,0,5,0,0,'127.0.0.1'),(11,'1亿元人民币堆在一起会占多大空间？','',1372827516,1372827516,4,1,3,0,0,0,0,0,'127.0.0.1'),(12,'联想笔记本G480红色的怎么样','1.我是学生   平时玩玩游戏 上上网  G480的怎么样？不想买黑色灰色的 想要红色蓝色的\r\n 2. Y480  Y400有红色吗？\r\n3.还有他们是什么系统的   现在都用什么系统比较方便普遍？\r\n4.或者提供其他意见\r\n5.希望配置高一点的~ 价格6000左右~\r\n6.电子盲没办法。。。\r\n7.感谢好心人提供回复',1372827685,1372827685,5,1,7,0,0,0,0,0,'127.0.0.1'),(13,'华为g510 和联想a800哪个比较好，纠结中','华为g510 和联想a800哪个比较好，纠结中',1372827713,1372827713,5,0,10,0,0,0,0,0,'127.0.0.1'),(14,'htc 328w怎么用电脑连上手机助手','',1372827798,1372830332,6,1,19,0,0,0,0,1,'127.0.0.1'),(15,'蚊子到底有没有偏爱的血型?','蚊子到底有没有偏爱的血型?',1372827913,1372827913,7,4,37,1,0,18,0,0,'127.0.0.1'),(16,'我刚刚发起了一个问题！','',1372906203,1372906203,1,0,3,0,0,0,0,0,'127.0.0.1'),(17,'我要提问','asdf',1372907575,1372907575,9,0,4,0,0,0,0,0,'127.0.0.1');
/*!40000 ALTER TABLE `ask_question` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ask_question_comments`
--

DROP TABLE IF EXISTS `ask_question_comments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ask_question_comments` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `question_id` int(11) unsigned NOT NULL,
  `uid` int(11) unsigned NOT NULL,
  `message` text NOT NULL,
  `time` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ask_question_comments`
--

LOCK TABLES `ask_question_comments` WRITE;
/*!40000 ALTER TABLE `ask_question_comments` DISABLE KEYS */;
/*!40000 ALTER TABLE `ask_question_comments` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ask_question_focus`
--

DROP TABLE IF EXISTS `ask_question_focus`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ask_question_focus` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `question_id` int(11) unsigned NOT NULL,
  `uid` int(11) unsigned NOT NULL,
  `add_time` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ask_question_focus`
--

LOCK TABLES `ask_question_focus` WRITE;
/*!40000 ALTER TABLE `ask_question_focus` DISABLE KEYS */;
INSERT INTO `ask_question_focus` VALUES (1,1,1,1372829352),(2,2,1,1372829361),(3,5,1,1372829367),(4,15,7,1372830237);
/*!40000 ALTER TABLE `ask_question_focus` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ask_topic`
--

DROP TABLE IF EXISTS `ask_topic`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ask_topic` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `topic_title` varchar(64) NOT NULL DEFAULT '',
  `add_time` int(10) unsigned NOT NULL DEFAULT '0',
  `discuss_count` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ask_topic`
--

LOCK TABLES `ask_topic` WRITE;
/*!40000 ALTER TABLE `ask_topic` DISABLE KEYS */;
INSERT INTO `ask_topic` VALUES (1,'电脑',1372822834,9),(2,'水果',1372822834,1),(3,'夏天',1372822834,1),(4,'麦克风',1372822973,2),(5,'散热器',1372823057,1),(6,'游戏',1372823177,1),(7,'php',1372823844,1),(8,'风扇',1372823987,1),(9,'花露水',1372827131,1),(10,'空调',1372827239,1),(11,'死机',1372827362,1),(12,'卡',1372827392,1),(13,'人民币',1372827516,1),(14,'联想',1372827685,2),(15,'华为',1372827713,1),(16,'htc',1372827798,1),(17,'血型',1372827913,1),(18,'蚊子',1372827913,1),(19,'问题',1372906203,1),(20,'wenti',1372907575,1);
/*!40000 ALTER TABLE `ask_topic` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ask_topic_question`
--

DROP TABLE IF EXISTS `ask_topic_question`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ask_topic_question` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `topic_id` int(11) unsigned NOT NULL,
  `question_id` int(11) unsigned NOT NULL,
  `add_time` int(10) unsigned NOT NULL,
  `uid` int(11) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ask_topic_question`
--

LOCK TABLES `ask_topic_question` WRITE;
/*!40000 ALTER TABLE `ask_topic_question` DISABLE KEYS */;
INSERT INTO `ask_topic_question` VALUES (1,1,1,1372822834,1),(2,2,1,1372822834,1),(3,3,1,1372822834,1),(4,4,2,1372822973,1),(5,1,2,1372822973,1),(6,1,3,1372823057,1),(7,5,3,1372823057,1),(8,1,4,1372823177,2),(9,6,4,1372823177,2),(10,7,5,1372823844,1),(11,8,6,1372823987,1),(12,1,6,1372823987,1),(13,9,7,1372827131,3),(14,10,8,1372827239,3),(15,11,9,1372827362,4),(16,1,9,1372827362,4),(17,12,10,1372827392,4),(18,1,10,1372827392,4),(19,13,11,1372827516,4),(20,14,12,1372827685,5),(21,1,12,1372827685,5),(22,15,13,1372827713,5),(23,14,13,1372827713,5),(24,16,14,1372827798,6),(25,17,15,1372827913,7),(26,18,15,1372827913,7),(27,19,16,1372906203,1),(28,20,17,1372907575,9);
/*!40000 ALTER TABLE `ask_topic_question` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ask_user_follow`
--

DROP TABLE IF EXISTS `ask_user_follow`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ask_user_follow` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fans_uid` int(11) NOT NULL COMMENT '关注人id',
  `friend_uid` int(11) NOT NULL COMMENT '被关注人id',
  `add_time` int(11) NOT NULL COMMENT '添加时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ask_user_follow`
--

LOCK TABLES `ask_user_follow` WRITE;
/*!40000 ALTER TABLE `ask_user_follow` DISABLE KEYS */;
/*!40000 ALTER TABLE `ask_user_follow` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ask_users`
--

DROP TABLE IF EXISTS `ask_users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ask_users` (
  `uid` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `email` varchar(255) NOT NULL,
  `mobile` varchar(100) NOT NULL DEFAULT '',
  `password` varchar(50) NOT NULL,
  `avatar_file` varchar(100) NOT NULL DEFAULT '/public/images/default_50.gif',
  `salt` varchar(50) NOT NULL DEFAULT '',
  `sex` char(6) NOT NULL DEFAULT '',
  `birthday` int(10) unsigned NOT NULL DEFAULT '0',
  `reg_time` int(10) unsigned NOT NULL,
  `reg_ip` char(15) NOT NULL,
  `last_login` int(10) unsigned NOT NULL,
  `last_ip` char(15) NOT NULL,
  `fans_count` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`uid`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ask_users`
--

LOCK TABLES `ask_users` WRITE;
/*!40000 ALTER TABLE `ask_users` DISABLE KEYS */;
INSERT INTO `ask_users` VALUES (1,'test1','test1@test1.com','1231234','e72f423baf41c9a51f9b97bc0606b466','/public/upload/avatar/1/1_50.jpg','itiq','female',403200,1372822762,'127.0.0.1',1372920052,'127.0.0.1',0),(2,'test2','test2@test2.com','','0c47b5199aedf65541a0c29e8843ec59','/public/upload/avatar/2/2_50.jpg','eoze','',0,1372823097,'127.0.0.1',1372828586,'127.0.0.1',0),(3,'test3','test3@test3.com','','7578058185e5f40626e5745b064a80be','/public/upload/avatar/3/3_50.jpg','ucki','male',0,1372824014,'127.0.0.1',1372828948,'127.0.0.1',0),(4,'test4','test4@test4.com','','c161c37550280cbc17e121eed7c94bb3','/public/upload/avatar/4/4_50.jpg','xabp','male',0,1372827303,'127.0.0.1',1372829896,'127.0.0.1',0),(5,'test5','test5@test5.com','','157006f95bb520ff4d3ddaa87a785333','/public/upload/avatar/5/5_50.jpg','rcbe','male',0,1372827539,'127.0.0.1',1372830725,'127.0.0.1',0),(6,'test6','test6@test6.com','','df388b647c5ae19084f73bf04dae347c','/public/upload/avatar/6/6_50.jpg','jnpd','male',0,1372827745,'127.0.0.1',1372827745,'127.0.0.1',0),(7,'test7','test7@test7.com','','cedf0719b8e2baeafa07c57e9c12c64b','/public/upload/avatar/7/7_50.jpg','oads','male',0,1372827847,'127.0.0.1',1372830226,'127.0.0.1',0),(8,'test8','test8@test8.com','1231234132','7ef854625f9a40443c571645b9d9ada7','/public/upload/avatar/8/8_50.jpg','oqqo','male',1373990400,1372897105,'127.0.0.1',1372897153,'127.0.0.1',0),(9,'xy','xy@xy.com','','df69964ce45360d0c00c5ee998e7c7e3','/public/images/default_50.gif','oiqf','',0,1372907546,'127.0.0.1',1372907546,'127.0.0.1',0);
/*!40000 ALTER TABLE `ask_users` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2013-07-14 23:27:36
