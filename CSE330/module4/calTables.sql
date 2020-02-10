CREATE TABLE `Event` (
 `title` varchar(20) NOT NULL,
 `event_id` int(11) NOT NULL AUTO_INCREMENT,
 `date` date NOT NULL,
 `time` time NOT NULL,
 `username` varchar(50) NOT NULL,
 PRIMARY KEY (`event_id`),
 KEY `username` (`username`),
 CONSTRAINT `username` FOREIGN KEY (`username`) REFERENCES `users` (`username`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=57 DEFAULT CHARSET=latin1



CREATE TABLE `users` (
 `username` varchar(50) NOT NULL,
 `crypted_password` varchar(255) NOT NULL,
 PRIMARY KEY (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1