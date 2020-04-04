CREATE DATABASE IF NOT EXISTS `bec_chat`;
USE `bec_chat`;

CREATE TABLE IF NOT EXISTS `server1`
(
    `id`      int(11) NOT NULL AUTO_INCREMENT,
    `time`    time         DEFAULT NULL,
    `type`    int(11)      DEFAULT NULL,
    `player`  varchar(128) DEFAULT NULL,
    `message` text,
    `date`    datetime     DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (`id`),
    UNIQUE KEY `Index 2` (`time`, `player`, `type`)
) ENGINE = InnoDB
  AUTO_INCREMENT = 0
  DEFAULT CHARSET = latin1;