-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: localhost
-- Thời gian đã tạo: Th6 11, 2023 lúc 10:58 AM
-- Phiên bản máy phục vụ: 8.0.31
-- Phiên bản PHP: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `qlma`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `chitietgh`
--

CREATE TABLE `chitietgh` (
  `magh` int NOT NULL,
  `mamon` int NOT NULL,
  `soluong` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `chitietgh`
--

INSERT INTO `chitietgh` (`magh`, `mamon`, `soluong`) VALUES
(1, 16, 3),
(1, 18, 1),
(2, 4, 2),
(2, 13, 1),
(2, 14, 1),
(2, 18, 1),
(3, 1, 1),
(3, 2, 3),
(3, 4, 2),
(3, 6, 3),
(3, 7, 1),
(3, 11, 2),
(3, 13, 1),
(3, 18, 2);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `giaohang`
--

CREATE TABLE `giaohang` (
  `magh` int NOT NULL,
  `ngaylap` datetime NOT NULL,
  `diachi` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `sdt` varchar(10) COLLATE utf8mb4_general_ci NOT NULL,
  `tinhtrang` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `giaohang`
--

INSERT INTO `giaohang` (`magh`, `ngaylap`, `diachi`, `sdt`, `tinhtrang`) VALUES
(1, '2023-05-03 09:37:25', 'TP.HCM', '0123456789', 0),
(2, '2023-05-16 18:16:17', 'Phú Yên', '0336670451', 1),
(3, '2023-05-17 20:16:44', 'Tiền Giang', '0924224752', 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `giohang`
--

CREATE TABLE `giohang` (
  `magh` int NOT NULL,
  `taikhoan` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `thanhtoan` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `giohang`
--

INSERT INTO `giohang` (`magh`, `taikhoan`, `thanhtoan`) VALUES
(1, 'thao', 1),
(2, 'thao', 1),
(3, 'thao', 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `loaimon`
--

CREATE TABLE `loaimon` (
  `maloai` int NOT NULL,
  `tenloai` varchar(255) COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `loaimon`
--

INSERT INTO `loaimon` (`maloai`, `tenloai`) VALUES
(1, 'Món chính'),
(2, 'Món phụ'),
(3, 'Tráng miệng'),
(4, 'Đồ uống');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `monan`
--

CREATE TABLE `monan` (
  `mamon` int NOT NULL,
  `maloai` int NOT NULL,
  `tenmon` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `hinh` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `donvi` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `dongia` int NOT NULL,
  `mota` varchar(255) COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `monan`
--

INSERT INTO `monan` (`mamon`, `maloai`, `tenmon`, `hinh`, `donvi`, `dongia`, `mota`) VALUES
(1, 1, 'Lẩu hải sản chua cay', 'Hinh1.jpg', 'Một nồi', 200000, 'Lẩu gồm có bún, mực, tôm, rau, cá viên'),
(2, 1, 'Ốc móng tay xào mỳ', 'Hinh2.jpg', 'Một dĩa', 100000, 'Ốc xào với mỳ và rau muống ăn kèm với nước tương'),
(3, 2, 'Tôm sốt thái', 'Hinh3.jpg', 'Một dĩa', 150000, 'Tôm sống sốt với nước sốt chua cay'),
(4, 1, 'Cua rang me', 'Hinh4.jpg', 'Một dĩa', 175000, 'Cua rang với nước sốt me chua ngọt'),
(5, 2, 'Bò nướng cuộn kim châm', 'Hinh5.jpg', 'Một dĩa', 125000, 'Bò nướng ăn kèm với nước chấm muối ớt xanh'),
(6, 1, 'Cơm chiên thập cẩm', 'Hinh6.jpg', 'Một dĩa', 90000, 'Cơm chiên gồm có lạp xưởng, đậu que, cà rốt và trứng ăn kèm với nước tương'),
(7, 1, 'Mỳ xào bò', 'Hinh7.jpg', 'Một dĩa', 80000, 'Mỳ xào cùng với thịt và rau ăn kèm với nước tương'),
(8, 2, 'Cá trứng chiên giòn', 'Hinh8.jpg', 'Một dĩa', 95000, 'Cá trứng chiên giòn ăn kèm với mắm me'),
(9, 1, 'Mực hỏa diệm sơn', 'Hinh9.jpg', 'Một nồi', 135000, 'Mực hấp trong trái dừa và có phô mai kéo sợi ở trên mặt'),
(10, 3, 'Rau câu dừa', 'Hinh10.jpg', 'Một hủ', 10000, 'Rau câu dừa có những sợi dừa nhỏ được bào mỏng bên trong rau câu'),
(11, 3, 'Kem vani', 'Hinh11.jpg', 'Một hủ', 20000, 'Kem vani thơm ngon có quặng bánh ở dưới'),
(12, 3, 'Trái cây', 'Hinh12.jpg', 'Một dĩa', 65000, 'Dĩa trái cây gồm có nho, dưa hấu, xoài, thơm'),
(13, 4, 'Nước ngọt Coca Cola', 'Hinh16.jpg', 'Một lon', 14000, 'Nước có đường'),
(14, 1, 'Lẩu gà ớt hiểm', 'Hinh14.jpg', 'Một nồi', 195000, 'Lẩu gồm có bún, thịt gà, rau, ớt hiểm'),
(15, 2, 'Cá diêu hồng chưng tương', 'Hinh15.jpg', 'Một dĩa', 93000, 'Cá điêu hồng chưng tương ăn kèm với nước tương'),
(16, 4, 'Strongbow', 'Hinh.jpg', 'Một chai', 17000, 'Cồn ít'),
(17, 4, 'Bia Tiger', 'Hinh13.jpg', 'Một lon', 17000, 'Bia là một loại thức uống có cồn được sản xuất bằng quá trình lên men đường lơ lửng trong môi trường lỏng và nó không được chưng cất sau khi lên men.'),
(18, 4, 'Trà sữa', 'Hinh17.jpg', 'Một ly', 30000, 'Trà sữa là 1 loại thức uống kết hợp từ 2 nguyên liệu chính là trà và sữa. Mỗi loại trà sữa có sự khác nhau giữa nguồn gốc, nguyên liệu, tỷ lệ, cách pha, cũng như có bổ sung các thành phần phụ khác.');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `nguoidung`
--

CREATE TABLE `nguoidung` (
  `taikhoan` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `matkhau` varchar(255) COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `nguoidung`
--

INSERT INTO `nguoidung` (`taikhoan`, `matkhau`) VALUES
('admin', '$2y$10$O/6la3WAIuIA6mnbOmq7QOsjUfC30mTN71Sjw/E1fndFWWUidtj/y'),
('nam', '$2y$10$mWSIhJTf4j8AAPQUma53X.LzCzCCGAqN4634zK.u7lTwDBShSCxd2'),
('tan', '$2y$10$lV53lEG0vTrRYfdP0l./PuSl4EoCEmhyR.ZL6wZj2BkQZIj1/w3eS'),
('thao', '$2y$10$eawiILFnvH7/jbMMzYu3PesDnIC.OVkbDlAAjt2qREasB1aRn6/N6'),
('vinh', '$2y$10$0G2QAlzc005RbmL1HzGH1uU9HXRuE.oMIsY90kqhy81PV5P3t2uAi');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `chitietgh`
--
ALTER TABLE `chitietgh`
  ADD PRIMARY KEY (`magh`,`mamon`),
  ADD KEY `mamon` (`mamon`);

--
-- Chỉ mục cho bảng `giaohang`
--
ALTER TABLE `giaohang`
  ADD PRIMARY KEY (`magh`,`ngaylap`);

--
-- Chỉ mục cho bảng `giohang`
--
ALTER TABLE `giohang`
  ADD PRIMARY KEY (`magh`),
  ADD KEY `giohang_ibfk_1` (`taikhoan`);

--
-- Chỉ mục cho bảng `loaimon`
--
ALTER TABLE `loaimon`
  ADD PRIMARY KEY (`maloai`);

--
-- Chỉ mục cho bảng `monan`
--
ALTER TABLE `monan`
  ADD PRIMARY KEY (`mamon`),
  ADD KEY `maloai` (`maloai`);

--
-- Chỉ mục cho bảng `nguoidung`
--
ALTER TABLE `nguoidung`
  ADD PRIMARY KEY (`taikhoan`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `giohang`
--
ALTER TABLE `giohang`
  MODIFY `magh` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT cho bảng `loaimon`
--
ALTER TABLE `loaimon`
  MODIFY `maloai` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT cho bảng `monan`
--
ALTER TABLE `monan`
  MODIFY `mamon` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `chitietgh`
--
ALTER TABLE `chitietgh`
  ADD CONSTRAINT `chitietgh_ibfk_1` FOREIGN KEY (`magh`) REFERENCES `giohang` (`magh`) ON DELETE CASCADE ON UPDATE RESTRICT,
  ADD CONSTRAINT `chitietgh_ibfk_2` FOREIGN KEY (`mamon`) REFERENCES `monan` (`mamon`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Các ràng buộc cho bảng `giaohang`
--
ALTER TABLE `giaohang`
  ADD CONSTRAINT `giaohang_ibfk_1` FOREIGN KEY (`magh`) REFERENCES `giohang` (`magh`) ON DELETE CASCADE ON UPDATE RESTRICT;

--
-- Các ràng buộc cho bảng `giohang`
--
ALTER TABLE `giohang`
  ADD CONSTRAINT `giohang_ibfk_1` FOREIGN KEY (`taikhoan`) REFERENCES `nguoidung` (`taikhoan`) ON DELETE CASCADE ON UPDATE RESTRICT;

--
-- Các ràng buộc cho bảng `monan`
--
ALTER TABLE `monan`
  ADD CONSTRAINT `monan_ibfk_1` FOREIGN KEY (`maloai`) REFERENCES `loaimon` (`maloai`) ON DELETE RESTRICT ON UPDATE RESTRICT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
