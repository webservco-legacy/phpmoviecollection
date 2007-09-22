-- MySQL dump 9.07
--
-- Host: localhost    Database: dvddb
---------------------------------------------------------
-- Server version	4.0.12-standard-log

--
-- Table structure for table 'config'
--

DROP TABLE IF EXISTS config;
CREATE TABLE config (
  item varchar(255) default NULL,
  value varchar(255) default NULL,
  comments varchar(255) default NULL,
  visible tinyint(1) default '1'
) TYPE=MyISAM;

--
-- Dumping data for table 'config'
--

/*!40000 ALTER TABLE config DISABLE KEYS */;
LOCK TABLES config WRITE;
INSERT INTO config VALUES ('sitename','An unconfigured DVDdb','',1),('webmaster','your@email.address.here','',1),('home','http://your.site.com/dvddb','No trailing slash on the URL',1),('approvalemail','approvalmail@yourdomain.com','Address to which new user requests are sent',1),('siteemail','fromemail@yourdomain.com','Address from which site emails are sent',1),('lowdate','1960','Lowest date for date dropdowns',1),('defregion','1','Default region for new DVDs',1),('showall','0','Enable show all link on movie list page',1),('numperpage','20','Number of results per page',1),('version','0.6','Database version - Do not change this',0),('graphwidth','600','Width of stats graphs, in pixels',1),('dateformat','%W %D %M, %Y','Format used to display date fields. See <A HREF=\"http://www.mysql.com/doc/en/Date_and_time_functions.html#IDX1333\">the mysql docs</A> for more options.',1),('defmedia','1','Default media type. See <A HREF=\"tableedit.php\">table edit</A> for values',1),('yearwindow','20','Number of years back to display on stats page. Will be rounded down to the nearest decade',1),('theme','indusiv','Layout theme. See <A HREF=\"themes.php\">themes</A> to change this setting',0),('commentchars','255','Number of characters of comment to display on list DVD page',1),('movcolumns','2047','Columns to display on list movies page.',0),('mysqlversion','4.0','Mysql version',0),('allowadminedit','0','Allow admin to edit all movies in the system, regardless of owner.',1),('movienav','3','Show movie navigation at top/bottom or both. Bitmask value. 1=top, 2=bottom, 3=both',1);
UNLOCK TABLES;
/*!40000 ALTER TABLE config ENABLE KEYS */;

--
-- Table structure for table 'country'
--

DROP TABLE IF EXISTS country;
CREATE TABLE country (
  code char(2) NOT NULL default '',
  name varchar(255) NOT NULL default '',
  KEY code (code)
) TYPE=MyISAM;

--
-- Dumping data for table 'country'
--

/*!40000 ALTER TABLE country DISABLE KEYS */;
LOCK TABLES country WRITE;
INSERT INTO country VALUES ('CA','Canada'),('US','USA');
UNLOCK TABLES;
/*!40000 ALTER TABLE country ENABLE KEYS */;

--
-- Table structure for table 'genre'
--

DROP TABLE IF EXISTS genre;
CREATE TABLE genre (
  id int(11) NOT NULL auto_increment,
  name varchar(64) NOT NULL default '',
  PRIMARY KEY  (id)
) TYPE=MyISAM;

--
-- Dumping data for table 'genre'
--

/*!40000 ALTER TABLE genre DISABLE KEYS */;
LOCK TABLES genre WRITE;
INSERT INTO genre VALUES (1,'Science Fiction'),(2,'Drama'),(3,'Horror'),(4,'Action'),(5,'Comedy'),(6,'Non Fiction'),(7,'Western'),(8,'Film Noir'),(9,'Musical'),(22,'Thriller'),(11,'Adventure'),(12,'Animation'),(13,'Anime'),(14,'Fantasy'),(15,'Mystery'),(16,'Romance'),(17,'War'),(21,'Music Videos');
UNLOCK TABLES;
/*!40000 ALTER TABLE genre ENABLE KEYS */;

--
-- Table structure for table 'loan'
--

DROP TABLE IF EXISTS loan;
CREATE TABLE loan (
  id int(11) NOT NULL auto_increment,
  movieid int(11) NOT NULL default '0',
  userid int(11) NOT NULL default '0',
  loanee varchar(255) default NULL,
  loaneeemail varchar(255) default NULL,
  loandate date NOT NULL default '0000-00-00',
  PRIMARY KEY  (id),
  KEY dvdid (movieid),
  KEY userid (userid),
  KEY movieid (movieid)
) TYPE=MyISAM;

--
-- Table structure for table 'media'
--

DROP TABLE IF EXISTS media;
CREATE TABLE media (
  id int(11) NOT NULL auto_increment,
  name varchar(32) default NULL,
  PRIMARY KEY  (id)
) TYPE=MyISAM;

--
-- Dumping data for table 'media'
--

/*!40000 ALTER TABLE media DISABLE KEYS */;
LOCK TABLES media WRITE;
INSERT INTO media VALUES (1,'DVD'),(2,'VHS');
UNLOCK TABLES;
/*!40000 ALTER TABLE media ENABLE KEYS */;

--
-- Table structure for table 'movie'
--

DROP TABLE IF EXISTS movie;
CREATE TABLE movie (
  id int(11) NOT NULL auto_increment,
  userid int(11) NOT NULL default '0',
  title varchar(255) NOT NULL default '',
  reldate year(4) NOT NULL default '0000',
  comments text,
  rating int(11) NOT NULL default '0',
  genreid varchar(255) NOT NULL default '',
  region int(11) default NULL,
  insertdate datetime NOT NULL default '0000-00-00 00:00:00',
  runtime int(11) default NULL,
  mediaid int(11) NOT NULL default '0',
  director varchar(255) default NULL,
  sound varchar(255) default NULL,
  video varchar(255) default NULL,
  extra varchar(255) default NULL,
  PRIMARY KEY  (id),
  KEY userid (userid),
  KEY genreid (genreid),
  KEY region (region),
  KEY insertdate (insertdate),
  FULLTEXT KEY title (title)
) TYPE=MyISAM;

--
-- Table structure for table 'region'
--

DROP TABLE IF EXISTS region;
CREATE TABLE region (
  code char(2) NOT NULL default '',
  name varchar(255) NOT NULL default '',
  KEY code (code)
) TYPE=MyISAM;

--
-- Dumping data for table 'region'
--

/*!40000 ALTER TABLE region DISABLE KEYS */;
LOCK TABLES region WRITE;
INSERT INTO region VALUES ('BC','British Columbia'),('WA','Washington');
UNLOCK TABLES;
/*!40000 ALTER TABLE region ENABLE KEYS */;

--
-- Table structure for table 'user'
--

DROP TABLE IF EXISTS user;
CREATE TABLE user (
  id int(11) NOT NULL auto_increment,
  email varchar(255) NOT NULL default '',
  password varchar(32) NOT NULL default '',
  fname varchar(255) NOT NULL default '',
  lname varchar(255) NOT NULL default '',
  city varchar(255) NOT NULL default '',
  regioncode char(2) NOT NULL default '',
  countrycode char(2) NOT NULL default '',
  enabled tinyint(1) NOT NULL default '0',
  admin tinyint(1) NOT NULL default '0',
  lastvisit datetime NOT NULL default '0000-00-00 00:00:00',
  lastcheck datetime NOT NULL default '0000-00-00 00:00:00',
  PRIMARY KEY  (id)
) TYPE=MyISAM;

--
-- Table structure for table 'userprefs'
--

DROP TABLE IF EXISTS userprefs;
CREATE TABLE userprefs (
  userid int(11) NOT NULL default '0',
  item varchar(255) NOT NULL default '',
  value varchar(255) NOT NULL default '',
  KEY userid (userid)
) TYPE=MyISAM;
