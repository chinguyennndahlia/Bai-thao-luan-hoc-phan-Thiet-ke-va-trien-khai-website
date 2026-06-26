-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th4 22, 2026 lúc 07:59 PM
-- Phiên bản máy phục vụ: 10.4.32-MariaDB
-- Phiên bản PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `banahills`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `bookings`
--

CREATE TABLE `bookings` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `service_id` int(11) DEFAULT NULL,
  `booking_date` date DEFAULT NULL,
  `status` varchar(50) DEFAULT 'Chờ xử lý'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `bookings`
--

INSERT INTO `bookings` (`id`, `user_id`, `service_id`, `booking_date`, `status`) VALUES
(1, 2, 1, '2026-04-30', 'Đã xác nhận'),
(2, 3, 2, '2026-05-01', 'Chờ xác nhận'),
(3, 5, 1, '2026-06-15', 'Chờ xác nhận'),
(4, 5, 2, '2026-04-30', 'Chờ xác nhận'),
(5, 5, 1, '2026-04-22', 'Đã xác nhận'),
(6, 5, 6, '2026-04-22', 'Đã xác nhận'),
(7, 5, 6, '2026-04-22', 'Chờ xác nhận'),
(8, 5, 6, '2026-04-22', 'Chờ xác nhận');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `locations`
--

CREATE TABLE `locations` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `image` varchar(255) DEFAULT 'default.jpg'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `locations`
--

INSERT INTO `locations` (`id`, `name`, `description`, `image`) VALUES
(1, 'Cầu Vàng', 'Biểu tượng nổi tiếng thế giới với đôi bàn tay khổng lồ.', 'cau_vang.jpg'),
(2, 'Làng Pháp', 'Không gian kiến trúc cổ kính phong cách Châu Âu.', 'lang_phap.jpg'),
(3, 'Hầm Rượu Debay', 'Hầm rượu cổ xuyên sâu trong lòng núi Bà Nà.', 'ham_ruou.jpg'),
(4, 'Chùa Linh Ứng', 'Nơi có bức tượng Đức Bổn Sư cao 27m trắng muốt, điểm tựa tâm linh giữa ngàn mây.', 'linh_ung.jpg'),
(5, 'Thác Tóc Tiên', 'Dòng thác huyền thoại đổ xuống từ độ cao của đỉnh núi Chúa, trắng xóa như mái tóc người tiên.', 'toc_tien.jpg'),
(6, 'Vườn Hoa Jardin DAmour', '9 khu vườn với 9 lối kiến trúc độc đáo, kể những câu chuyện tình lãng mạn qua ngàn sắc hoa.', 'vuon_hoa.jpg'),
(8, 'Công Viên Fantasy Park', 'Khu vui chơi trong nhà lớn nhất Việt Nam với hàng trăm trò chơi mạo hiểm và giải trí hấp dẫn.', 'fantasy.jpg'),
(9, 'Bảo Tàng Tượng Sáp Bà nà Hills', 'Khu trưng bày tượng sáp các nhân vật nổi tiếng thế giới đầu tiên tại Việt Nam.', 'bao_tang.jpg');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `services`
--

CREATE TABLE `services` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `price` decimal(10,2) DEFAULT NULL,
  `image` varchar(255) DEFAULT 'default.jpg'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `services`
--

INSERT INTO `services` (`id`, `name`, `description`, `price`, `image`) VALUES
(1, 'Vé Cáp Treo Khứ Hồi', 'Tham quan toàn cảnh Bà Nà Hills từ trên cao.', 900000.00, 'cap_treo.jpg'),
(2, 'Combo Buffet Trưa', 'Vé cáp treo kèm buffet tại nhà hàng Arapang.', 1250000.00, 'buffet_an_trua.jpg'),
(3, 'Vé Bảo Tàng Sáp', 'Gặp gỡ các nhân vật nổi tiếng thế giới.', 100000.00, 'bao_tang_sap.jpg'),
(5, 'Combo Mùa Đông', 'Vé cáp treo và Buffet tối thượng hạng tại nhà hàng Beer Plaza.', 1150000.00, 'combo_dong.jpg'),
(6, 'Vé Máng Trượt Hiệp Sĩ', 'Trải nghiệm cảm giác mạnh với đường trượt đôi duy nhất tại Việt Nam.', 0.00, 'mang_truot.jpg'),
(7, 'đi ngủ hộ', 'tôi cần đi ngủ nhưng mà tôi chưa xong bài web', 15000.00, 'sleep.jpg');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('admin','customer') DEFAULT 'customer'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `role`) VALUES
(1, 'admin', '123', 'admin'),
(2, 'khachhang01', '123', 'customer'),
(3, 'khachhang02', '123', 'customer'),
(5, 'Vân', '1008', 'customer'),
(6, 'HYD', '2603', 'customer');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `bookings`
--
ALTER TABLE `bookings`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `service_id` (`service_id`);

--
-- Chỉ mục cho bảng `locations`
--
ALTER TABLE `locations`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `services`
--
ALTER TABLE `services`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `bookings`
--
ALTER TABLE `bookings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT cho bảng `locations`
--
ALTER TABLE `locations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT cho bảng `services`
--
ALTER TABLE `services`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT cho bảng `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `bookings`
--
ALTER TABLE `bookings`
  ADD CONSTRAINT `bookings_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `bookings_ibfk_2` FOREIGN KEY (`service_id`) REFERENCES `services` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
