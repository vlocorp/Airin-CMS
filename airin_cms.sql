-- phpMyAdmin SQL Dump
-- version 3.3.9
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Waktu pembuatan: 28. Agustus 2012 jam 08:27
-- Versi Server: 5.5.8
-- Versi PHP: 5.3.5

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `airin_cms`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `category`
--

CREATE TABLE IF NOT EXISTS `category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(128) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data untuk tabel `category`
--

INSERT INTO `category` (`id`, `name`) VALUES
(1, 'Home'),
(2, 'About'),
(3, 'hab');

-- --------------------------------------------------------

--
-- Struktur dari tabel `group`
--

CREATE TABLE IF NOT EXISTS `group` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(128) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data untuk tabel `group`
--

INSERT INTO `group` (`id`, `name`) VALUES
(1, 'admin'),
(5, 'tes group');

-- --------------------------------------------------------

--
-- Struktur dari tabel `group_auth`
--

CREATE TABLE IF NOT EXISTS `group_auth` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `className` varchar(256) NOT NULL,
  `action` varchar(256) NOT NULL,
  `group_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`),
  KEY `FK_group_auth_group` (`group_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=13 ;

--
-- Dumping data untuk tabel `group_auth`
--

INSERT INTO `group_auth` (`id`, `className`, `action`, `group_id`) VALUES
(12, 'default', 'admin,delete', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `menu`
--

CREATE TABLE IF NOT EXISTS `menu` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(128) NOT NULL,
  `link` varchar(256) NOT NULL,
  `root` int(10) unsigned DEFAULT NULL,
  `lft` int(10) unsigned DEFAULT NULL,
  `rgt` int(10) unsigned DEFAULT NULL,
  `level` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data untuk tabel `menu`
--

INSERT INTO `menu` (`id`, `title`, `link`, `root`, `lft`, `rgt`, `level`) VALUES
(1, 'Home', 'site/index', 1, 1, 4, 1),
(2, 'Home 1.1', 'site/index', 1, 2, 3, 2);

-- --------------------------------------------------------

--
-- Struktur dari tabel `post`
--

CREATE TABLE IF NOT EXISTS `post` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `category_id` int(11) DEFAULT NULL,
  `sub_category_id` int(11) DEFAULT NULL,
  `title` varchar(256) NOT NULL,
  `content` text NOT NULL,
  `hide` smallint(6) DEFAULT NULL,
  `active` smallint(6) DEFAULT NULL,
  `sort` int(11) DEFAULT NULL,
  `hot` smallint(6) DEFAULT NULL,
  `image` varchar(256) DEFAULT NULL,
  `create_time` datetime DEFAULT NULL,
  `update_time` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_post_sub_category` (`sub_category_id`),
  KEY `FK_post_category` (`category_id`),
  KEY `FK_post_user` (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data untuk tabel `post`
--

INSERT INTO `post` (`id`, `user_id`, `category_id`, `sub_category_id`, `title`, `content`, `hide`, `active`, `sort`, `hot`, `image`, `create_time`, `update_time`) VALUES
(1, 1, 1, 1, 'Home test', 'ini hone test', NULL, 1, NULL, 0, '21307064332012082806215513fpj4izh.jpg', '2012-08-28 11:21:55', '2012-08-28 11:21:55'),
(2, 1, 1, NULL, 'asdas', 'asdasdas', NULL, 1, NULL, 0, '', '2012-08-28 11:29:54', '2012-08-28 11:29:54');

-- --------------------------------------------------------

--
-- Struktur dari tabel `sub_category`
--

CREATE TABLE IF NOT EXISTS `sub_category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(128) NOT NULL,
  `category_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_sub_category_category` (`category_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data untuk tabel `sub_category`
--

INSERT INTO `sub_category` (`id`, `name`, `category_id`) VALUES
(1, 'News', 1),
(2, 'into', 2);

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `group_id` int(11) DEFAULT NULL,
  `username` varchar(128) NOT NULL,
  `password` varchar(256) NOT NULL,
  `last_login_time` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_user_group` (`group_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`id`, `group_id`, `username`, `password`, `last_login_time`) VALUES
(1, 1, 'admin', '21232f297a57a5a743894a0e4a801fc3', '2012-08-27 08:42:58');

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `group_auth`
--
ALTER TABLE `group_auth`
  ADD CONSTRAINT `FK_group_auth_group` FOREIGN KEY (`group_id`) REFERENCES `group` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `post`
--
ALTER TABLE `post`
  ADD CONSTRAINT `FK_post_user` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_post_category` FOREIGN KEY (`category_id`) REFERENCES `category` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_post_sub_category` FOREIGN KEY (`sub_category_id`) REFERENCES `sub_category` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `sub_category`
--
ALTER TABLE `sub_category`
  ADD CONSTRAINT `FK_sub_category_category` FOREIGN KEY (`category_id`) REFERENCES `category` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `FK_user_group` FOREIGN KEY (`group_id`) REFERENCES `group` (`id`) ON DELETE CASCADE;
