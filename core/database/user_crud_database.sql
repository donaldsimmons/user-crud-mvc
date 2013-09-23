CREATE DATABASE user_crud;

DROP IF TABLE EXISTS users;

CREATE TABLE users (
	user_id int(11) NOT NULL AUTO_INCREMENT,
	user_name VARCHAR(20) NOT NULL,
	user_pass CHAR(32) NOT NULL DEFAULT '',
	user_full_name VARCHAR(40) NOT NULL,
	user_salt CHAR(8) DEFAULT NULL,
	user_height CHAR(3) DEFAULT NULL,
	user_weight CHAR(3) DEFAULT NULL,
	user_target_weight CHAR(3) DEFAULT NULL,
	PRIMARY KEY (user_id),
)Engine=InnoDB DEFAULT CHARSET=latin1; 