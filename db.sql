-- phpMyAdmin SQL Dump
-- version 4.7.3
-- https://www.phpmyadmin.net/
--
-- Anamakine: localhost:3306
-- Üretim Zamanı: 28 Kas 2017, 18:49:41
-- Sunucu sürümü: 5.6.38
-- PHP Sürümü: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Veritabanı: `gordum_db`
--

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `cats`
--

CREATE TABLE `cats` (
  `id` int(11) NOT NULL,
  `title` text NOT NULL,
  `text` text NOT NULL,
  `slug` text NOT NULL,
  `lang` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Tablo döküm verisi `cats`
--

INSERT INTO `cats` (`id`, `title`, `text`, `slug`, `lang`) VALUES
(1, 'Gundem', 'Gundem haberleri', 'gundem', 'tr'),
(2, 'Teknoloji', 'Teknoloji Haberleri', 'teknoloji', 'tr'),
(3, 'World', 'World news', 'world', 'en'),
(4, 'Technology', 'Technology news', 'technology', 'en'),
(5, 'Spor', 'Spor Haberleri', 'spor', 'tr');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `feeds`
--

CREATE TABLE `feeds` (
  `id` int(11) NOT NULL,
  `title` text COLLATE utf8_bin NOT NULL,
  `url` text COLLATE utf8_bin NOT NULL,
  `lang` text COLLATE utf8_bin NOT NULL,
  `category` text COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Tablo döküm verisi `feeds`
--

INSERT INTO `feeds` (`id`, `title`, `url`, `lang`, `category`) VALUES
(1, 'A Haber', 'http://www.ahaber.com.tr/rss/gundem.xml', 'tr', 'gundem'),
(2, 'CNN', 'http://rss.cnn.com/rss/edition_world.rss', 'en', 'world'),
(3, 'Milliyet', 'http://www.milliyet.com.tr/rss/rssNew/gundemRss.xml', 'tr', 'gundem'),
(4, 'CNN Turk', 'http://www.cnnturk.com/feed/rss/bilim-teknoloji/news', 'tr', 'teknoloji'),
(5, 'Reuters', 'http://feeds.reuters.com/reuters/technologyNews', 'en', 'technology'),
(6, 'Sozcu', 'http://www.sozcu.com.tr/feed', 'tr', 'gundem'),
(7, 'Fotoma&ccedil;', 'http://www.fotomac.com.tr/rss/Anasayfa.xml', 'tr', 'spor');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `posts`
--

CREATE TABLE `posts` (
  `id` int(11) NOT NULL,
  `hash` text COLLATE utf8_bin NOT NULL,
  `title` text COLLATE utf8_bin NOT NULL,
  `url` text COLLATE utf8_bin NOT NULL,
  `lang` text COLLATE utf8_bin NOT NULL,
  `category` text COLLATE utf8_bin NOT NULL,
  `published` datetime NOT NULL,
  `source` text COLLATE utf8_bin NOT NULL,
  `hit` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dökümü yapılmış tablolar için indeksler
--

--
-- Tablo için indeksler `cats`
--
ALTER TABLE `cats`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `feeds`
--
ALTER TABLE `feeds`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`);

--
-- Dökümü yapılmış tablolar için AUTO_INCREMENT değeri
--

--
-- Tablo için AUTO_INCREMENT değeri `cats`
--
ALTER TABLE `cats`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- Tablo için AUTO_INCREMENT değeri `feeds`
--
ALTER TABLE `feeds`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- Tablo için AUTO_INCREMENT değeri `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
