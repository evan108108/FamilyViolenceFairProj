# Dump of table poll
# ------------------------------------------------------------

CREATE TABLE `poll` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `description` longtext,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



# Dump of table poll_choice
# ------------------------------------------------------------

CREATE TABLE `poll_choice` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `poll_id` int(11) unsigned NOT NULL,
  `label` varchar(255) NOT NULL DEFAULT '',
  `votes` int(11) unsigned NOT NULL DEFAULT '0',
  `weight` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `choice_poll` (`poll_id`),
  CONSTRAINT `choice_poll` FOREIGN KEY (`poll_id`) REFERENCES `poll` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



# Dump of table poll_vote
# ------------------------------------------------------------

CREATE TABLE `poll_vote` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `choice_id` int(11) unsigned NOT NULL,
  `poll_id` int(11) unsigned NOT NULL,
  `user_id` int(11) unsigned NOT NULL DEFAULT '0',
  `ip_address` varchar(16) NOT NULL DEFAULT '',
  `timestamp` int(11) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `vote_poll` (`poll_id`),
  KEY `vote_choice` (`choice_id`),
  KEY `vote_user` (`user_id`),
  CONSTRAINT `vote_user` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `vote_choice` FOREIGN KEY (`choice_id`) REFERENCES `poll_choice` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `vote_poll` FOREIGN KEY (`poll_id`) REFERENCES `poll` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;