-- Adminer 4.7.7 MySQL dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

SET NAMES utf8mb4;

DROP TABLE IF EXISTS `categories`;
CREATE TABLE `categories` (
  `id` int(4) NOT NULL,
  `name` varchar(25) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `categories` (`id`, `name`, `user_id`) VALUES
(0,	'Example Category',	5);

DROP TABLE IF EXISTS `comments`;
CREATE TABLE `comments` (
  `comment_id` int(4) NOT NULL,
  `name` varchar(25) NOT NULL,
  `email` varchar(50) NOT NULL,
  `body` text NOT NULL,
  `post_id` int(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `comments` (`comment_id`, `name`, `email`, `body`, `post_id`) VALUES
(0,	'Stranger',	'weird@mail.com',	'This post look amazing',	0);

DROP TABLE IF EXISTS `posts`;
CREATE TABLE `posts` (
  `id` int(4) NOT NULL AUTO_INCREMENT,
  `title` varchar(50) NOT NULL,
  `slug` varchar(50) NOT NULL,
  `body` text NOT NULL,
  `post_image` text NOT NULL,
  `category_id` int(4) NOT NULL,
  `user_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `posts` (`id`, `title`, `slug`, `body`, `post_image`, `category_id`, `user_id`, `created_at`) VALUES
(1,	'tes',	'tes',	'<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi iaculis suscipit dapibus. In posuere, nunc non tristique suscipit, ligula lectus volutpat odio, dignissim interdum odio leo vitae sapien. Fusce convallis ipsum et neque suscipit posuere. Nunc vitae justo vel arcu iaculis semper. Vestibulum et ligula lacus. Nullam pellentesque quam non enim scelerisque, ut maximus felis consectetur. Etiam est nibh, lobortis ut ullamcorper pharetra, interdum non quam. Ut eget nisl leo. Quisque sed mauris sed turpis aliquet convallis vel ac est.</p>\r\n<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi iaculis suscipit dapibus. In posuere, nunc non tristique suscipit, ligula lectus volutpat odio, dignissim interdum odio leo vitae sapien. Fusce convallis ipsum et neque suscipit posuere. Nunc vitae justo vel arcu iaculis semper. Vestibulum et ligula lacus. Nullam pellentesque quam non enim scelerisque, ut maximus felis consectetur. Etiam est nibh, lobortis ut ullamcorper pharetra, interdum non quam. Ut eget nisl leo. Quisque sed mauris sed turpis aliquet convallis vel ac est.</p>\r\n',	'noimage.png',	0,	5,	'2021-03-19 09:18:10');

DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `username` varchar(25) NOT NULL,
  `password` varchar(50) NOT NULL,
  `zipcode` varchar(8) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `users` (`id`, `name`, `email`, `username`, `password`, `zipcode`) VALUES
(5,	'reza',	'reza@mail.com',	'reza',	'bb98b1d0b523d5e783f931550d7702b6',	'reza');

-- 2021-03-19 09:19:28