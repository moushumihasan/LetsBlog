

CREATE DATABASE IF NOT EXISTS `lets_blog`;

USE `lets_blog`;

DROP TABLE `users`;
CREATE TABLE `users` (
	`user_id` INT(11) PRIMARY KEY AUTO_INCREMENT,
	`username` VARCHAR(128),
	`first_name` VARCHAR(128),
	`surname` VARCHAR(128),
	`email` VARCHAR(255),
	`gender` INT(1),
	`dob` DATE,
	`password` VARCHAR(255),
	`status` INT(1) DEFAULT 1,
	`added_datetime` DATETIME
);

DROP TABLE `blog`;
CREATE TABLE `blog` (
	`blog_id` INT(11) PRIMARY KEY AUTO_INCREMENT,
	`user_id` INT(11),
	`blog_text` TEXT,
	`status` INT(1),
	`added_datetime` DATETIME ,
	FOREIGN KEY(`user_id`) REFERENCES `users`(`user_id`)
);

CREATE TABLE `blog_like` (
	`blog_id` INT(11),
	`user_id` INT(11),
	`added_datetime` DATETIME ,
	FOREIGN KEY(`user_id`) REFERENCES `users`(`user_id`),
	FOREIGN KEY(`blog_id`) REFERENCES `blog`(`blog_id`),
	PRIMARY KEY(`blog_id`, `user_id`)
);


CREATE TABLE `blog_comment` (
	`blog_comment_id` INT(11) PRIMARY KEY AUTO_INCREMENT,
	`blog_id` INT(11),
	`user_id` INT(11),
	`comment` TEXT,
	`added_datetime` DATETIME ,
	FOREIGN KEY(`user_id`) REFERENCES `users`(`user_id`),
	FOREIGN KEY(`blog_id`) REFERENCES `blog`(`blog_id`)
);


CREATE TABLE `blog_comment_like` (
	`blog_comment_id` INT(11),
	`user_id` INT(11),
	`added_datetime` DATETIME ,
	FOREIGN KEY(`user_id`) REFERENCES `users`(`user_id`),
	FOREIGN KEY(`blog_comment_id`) REFERENCES `blog_comment`(`blog_comment_id`),
	PRIMARY KEY(`blog_comment_id`, `user_id`)
);
