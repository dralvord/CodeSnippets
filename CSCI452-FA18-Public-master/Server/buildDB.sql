-- ====================== Dillon VS1 - setup database ======================
DROP DATABASE IF EXISTS SNIPPETS;
CREATE DATABASE SNIPPETS;
USE SNIPPETS;

-- ====================== Somwang UA1 - add Users table ======================
CREATE TABLE IF NOT EXISTS `USERS` (
  `US_ID` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `US_USERNAME` varchar(50) NOT NULL,
  `US_PASSWORD` varchar(150) NOT NULL,
  `US_QUE1` varchar(150) NOT NULL,
  `US_QUE1ANS` varchar(150) NOT NULL,
  `US_QUE2` varchar(150) NOT NULL,
  `US_QUE2ANS` varchar(150) NOT NULL,
  PRIMARY KEY (`US_ID`),
  UNIQUE (`US_USERNAME`)
);  

CREATE TABLE `LANGUAGES` (
  `LN_ID` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `LN_NAME` varchar(50) NOT NULL,
  PRIMARY KEY(`LN_ID`),
  UNIQUE KEY `LN_ID` (`LN_ID`)
);

CREATE TABLE `SNIPPETS` (
  `SNP_ID` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `US_ID` bigint(20) unsigned NOT NULL,
  `LN_ID` bigint(20) unsigned NOT NULL,
  `SNP_DESCRIPTION` varchar(500) NOT NULL,
  `SNP_CODE` text NOT NULL,
  PRIMARY KEY (`SNP_ID`),
  UNIQUE KEY `SNP_ID` (`SNP_ID`),
  FOREIGN KEY (US_ID) REFERENCES USERS(US_ID) 
    ON UPDATE CASCADE ON DELETE CASCADE,
  FOREIGN KEY (LN_ID) REFERENCES LANGUAGES(LN_ID)
    ON UPDATE CASCADE ON DELETE CASCADE
);
INSERT INTO LANGUAGES (LN_ID, LN_NAME) VALUES ('','');
INSERT INTO LANGUAGES (LN_ID, LN_NAME) VALUES ('','Java');
INSERT INTO LANGUAGES (LN_ID, LN_NAME) VALUES ('','Python');
INSERT INTO LANGUAGES (LN_ID, LN_NAME) VALUES ('','C++');
INSERT INTO LANGUAGES (LN_ID, LN_NAME) VALUES ('','PHP');
INSERT INTO LANGUAGES (LN_ID, LN_NAME) VALUES ('','JavaScript');
INSERT INTO LANGUAGES (LN_ID, LN_NAME) VALUES ('','SQL');
INSERT INTO LANGUAGES (LN_ID, LN_NAME) VALUES ('','C#');
INSERT INTO LANGUAGES (LN_ID, LN_NAME) VALUES ('','HTML');
INSERT INTO LANGUAGES (LN_ID, LN_NAME) VALUES ('','JQuery');
INSERT INTO LANGUAGES (LN_ID, LN_NAME) VALUES ('','CSS');
INSERT INTO LANGUAGES (LN_ID, LN_NAME) VALUES ('','AJAX');