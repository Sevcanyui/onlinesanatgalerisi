-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Anamakine: 127.0.0.1
-- Üretim Zamanı: 09 Oca 2026, 00:57:57
-- Sunucu sürümü: 10.4.32-MariaDB
-- PHP Sürümü: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Veritabanı: `art_gallery`
--

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `artworks`
--

CREATE TABLE `artworks` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `artist` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `tags` varchar(255) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `status` enum('pending','approved') DEFAULT 'pending',
  `user_id` int(11) DEFAULT NULL,
  `artist_link` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Tablo döküm verisi `artworks`
--

INSERT INTO `artworks` (`id`, `title`, `artist`, `description`, `tags`, `image`, `created_at`, `status`, `user_id`, `artist_link`) VALUES
(19, 'my emotions', 'SVA', 'ı draw this while when ı feel my emotions poking me the most. and the funny part ı drew with paint ><', '#dijitalart', '1767910297_21.11.2024 (01.43).png', '2026-01-08 22:11:37', 'approved', 7, 'https://www.instagram.com/yuinicsp?igsh=NjM1OWtnNmh4Z29i');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `notifications`
--

CREATE TABLE `notifications` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `message` varchar(255) NOT NULL,
  `is_read` tinyint(1) DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Tablo döküm verisi `notifications`
--

INSERT INTO `notifications` (`id`, `user_id`, `message`, `is_read`, `created_at`) VALUES
(1, 2, 'Yüklediğiniz eser onaylandı ve yayına alındı 🎉', 0, '2026-01-05 21:37:44'),
(2, 3, 'Yüklediğiniz eser onaylandı ve yayına alındı 🎉', 0, '2026-01-05 21:41:13'),
(3, 3, 'Yüklediğiniz eser onaylandı ve yayına alındı 🎉', 0, '2026-01-08 15:06:10'),
(4, 3, 'Yüklediğiniz eser onaylandı ve yayına alındı 🎉', 0, '2026-01-08 18:16:25'),
(5, 3, 'Yüklediğiniz eser onaylandı ve yayına alındı 🎉', 0, '2026-01-08 18:17:25'),
(6, 4, 'Yüklediğiniz eser onaylandı ve yayına alındı 🎉', 0, '2026-01-08 19:22:22'),
(7, 2, 'Yüklediğiniz eser onaylandı ve yayına alındı 🎉', 0, '2026-01-08 19:47:34'),
(8, 7, 'Yüklediğiniz eser onaylandı ve yayına alındı 🎉', 0, '2026-01-08 22:11:55');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('admin','user') DEFAULT 'user'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Tablo döküm verisi `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `role`) VALUES
(1, 'admin', 'admin@example.com', '$2y$10$e/OdmnfRsOqW8GU/NI3I9uXBFHk/DF9eunVqqgKx0FXw/YIWQ7UJC', 'admin'),
(7, 'yuino', 'yui@example.com', '$2y$10$5BYrKjlY5Fn3SChhKzIO9.lg79ruKIMkyHmC4mRfFWaPXFFSZz2ti', 'user');

--
-- Dökümü yapılmış tablolar için indeksler
--

--
-- Tablo için indeksler `artworks`
--
ALTER TABLE `artworks`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Dökümü yapılmış tablolar için AUTO_INCREMENT değeri
--

--
-- Tablo için AUTO_INCREMENT değeri `artworks`
--
ALTER TABLE `artworks`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- Tablo için AUTO_INCREMENT değeri `notifications`
--
ALTER TABLE `notifications`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Tablo için AUTO_INCREMENT değeri `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
