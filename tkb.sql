-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th6 14, 2018 lúc 01:50 PM
-- Phiên bản máy phục vụ: 10.1.26-MariaDB
-- Phiên bản PHP: 7.1.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `tkb`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `account`
--

CREATE TABLE `account` (
  `ma` varchar(50) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `permission` varchar(50) NOT NULL,
  `trang_thai` varchar(3) NOT NULL,
  `ngay_tao` date DEFAULT NULL,
  `mota` varchar(150) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `chuong_trinh_dao_tao`
--

CREATE TABLE `chuong_trinh_dao_tao` (
  `id` varchar(10) NOT NULL,
  `name` varchar(50) NOT NULL,
  `noi_dung` varchar(150) NOT NULL,
  `loai_hinh_dao_tao` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Đang đổ dữ liệu cho bảng `chuong_trinh_dao_tao`
--

INSERT INTO `chuong_trinh_dao_tao` (`id`, `name`, `noi_dung`, `loai_hinh_dao_tao`) VALUES
('D01', 'Lap trinh ung dung', 'Chuong trinh dao tao lap trinh ung dung', 'Dai han'),
('D02', 'Thiet ke do hoa-truyen thong da phuong tien', 'Chuong trinh dao tao ve do hoa, cac linh vuc truyen thong da phuong tien', 'Dai han'),
('D03', 'Phim hoat hinh 3D va quang cao', 'Chuong trinh dao tao dung phim hoat hinh va clip quang cao', 'Dai han'),
('D04', 'Quay,dung phim va bien tap video', 'Chuong trinh dao tao ve quay, dung phim va bien tap video', 'Dai han'),
('D05', 'Thiet ke va dien hoa noi that', 'Chuong trinh dao tao ve noi that', 'Dai han'),
('D06', 'Thiet ke do hoa chuyen nghiep', 'Chuong trinh dao tao ve thiet ke do hoa chuyen nghiep', 'Dai han');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `giao_vien`
--

CREATE TABLE `giao_vien` (
  `id` varchar(10) NOT NULL,
  `name` varchar(50) NOT NULL,
  `gioi_tinh` varchar(3) NOT NULL,
  `dia_chi` varchar(150) DEFAULT NULL,
  `dien_thoai` varchar(15) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `ghi_chu` varchar(150) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Đang đổ dữ liệu cho bảng `giao_vien`
--

INSERT INTO `giao_vien` (`id`, `name`, `gioi_tinh`, `dia_chi`, `dien_thoai`, `email`, `ghi_chu`) VALUES
('GV01', 'Nguyen Van A', 'Nam', NULL, NULL, NULL, NULL),
('GV02', 'Nguyen Van B', 'Nam', NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `giao_vien_co_lop`
--

CREATE TABLE `giao_vien_co_lop` (
  `ngay_bat_dau` date NOT NULL,
  `ngay_ket_thuc` date NOT NULL,
  `ma_giao_vien` varchar(10) NOT NULL,
  `thu` int(11) NOT NULL,
  `khung_gio` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `giao_vien_mon`
--

CREATE TABLE `giao_vien_mon` (
  `ma_giao_vien` varchar(10) NOT NULL,
  `ma_mon` varchar(10) NOT NULL,
  `muc_uu_tien` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Đang đổ dữ liệu cho bảng `giao_vien_mon`
--

INSERT INTO `giao_vien_mon` (`ma_giao_vien`, `ma_mon`, `muc_uu_tien`) VALUES
('GV01', 'MN', 1),
('GV01', 'WP', 1),
('GV02', 'JP', 1),
('GV02', 'WP', 2);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `giao_vien_nhom`
--

CREATE TABLE `giao_vien_nhom` (
  `ma_giao_vien` varchar(10) NOT NULL,
  `ma_nhom` varchar(10) NOT NULL,
  `mo_ta` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `giao_vien_nhom_theo_mon`
--

CREATE TABLE `giao_vien_nhom_theo_mon` (
  `ma_giao_vien` varchar(10) NOT NULL,
  `ma_nhom_theo_mon` varchar(10) NOT NULL,
  `muc_do_uu_tien` int(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `khoa_hoc`
--

CREATE TABLE `khoa_hoc` (
  `id` varchar(10) NOT NULL,
  `name` varchar(50) NOT NULL,
  `so_mon` int(11) NOT NULL,
  `thoi_gian` int(11) DEFAULT NULL,
  `loai_hinh_dao_tao` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Đang đổ dữ liệu cho bảng `khoa_hoc`
--

INSERT INTO `khoa_hoc` (`id`, `name`, `so_mon`, `thoi_gian`, `loai_hinh_dao_tao`) VALUES
('D_DH', 'Thiet ke do hoa chuyên nghi?p', 3, 320, 'Dai han'),
('D_LTUD', 'Khoa hoc lap trinh ung dung', 3, 642, 'Dai han');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `khoa_hoc_mon`
--

CREATE TABLE `khoa_hoc_mon` (
  `khoa_hoc` varchar(10) NOT NULL,
  `mon` varchar(10) NOT NULL,
  `vi_tri_mon` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Đang đổ dữ liệu cho bảng `khoa_hoc_mon`
--

INSERT INTO `khoa_hoc_mon` (`khoa_hoc`, `mon`, `vi_tri_mon`) VALUES
('D_LTUD', 'JP', 3),
('D_LTUD', 'MN', 2),
('D_LTUD', 'WP', 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `khung_gio`
--

CREATE TABLE `khung_gio` (
  `id` varchar(3) NOT NULL,
  `mota` varchar(50) NOT NULL,
  `thoi_luong` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Đang đổ dữ liệu cho bảng `khung_gio`
--

INSERT INTO `khung_gio` (`id`, `mota`, `thoi_luong`) VALUES
('1', 'Khung gio A (7h45 - 9h45)', 2),
('2', 'Khung gio B (10h00 - 12h00)', 2),
('3', 'Khung gio C (13h30 - 15h30)', 2),
('4', 'Khung gio D (15h15 - 17h15)', 2),
('5', 'Khung gio E (18h00 - 21h00)', 3);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `kip_hoc`
--

CREATE TABLE `kip_hoc` (
  `id` int(11) NOT NULL,
  `mo_ta` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Đang đổ dữ liệu cho bảng `kip_hoc`
--

INSERT INTO `kip_hoc` (`id`, `mo_ta`) VALUES
(1, 'Thu 2, 4, 6 (Khung gio A)'),
(2, 'Thu 3, 6, 7 (Khung gio A)'),
(3, 'Thu 2, 6 (Khung gio E)'),
(4, 'Thu 3, 5 (Khung gio E)'),
(5, 'Thu 4, 7 (Khung gio E)');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `kip_hoc_thu_khung_gio`
--

CREATE TABLE `kip_hoc_thu_khung_gio` (
  `id` int(11) NOT NULL,
  `khung_gio` varchar(3) NOT NULL,
  `thu` varchar(11) NOT NULL,
  `so_gio_tren_tuan` int(11) NOT NULL,
  `thu_int` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Đang đổ dữ liệu cho bảng `kip_hoc_thu_khung_gio`
--

INSERT INTO `kip_hoc_thu_khung_gio` (`id`, `khung_gio`, `thu`, `so_gio_tren_tuan`, `thu_int`) VALUES
(1, '1', 'Monday', 6, 2),
(1, '1', 'Wednesday', 6, 4),
(1, '1', 'Friday', 6, 6),
(2, '1', 'Tuesday', 6, 3),
(2, '1', 'Thursday', 6, 5),
(2, '1', 'Saturday', 6, 7),
(3, '5', 'Monday', 6, 2),
(3, '5', 'Friday', 6, 6),
(4, '5', 'Tuesday', 6, 3),
(4, '5', 'Thursday', 6, 5),
(5, '5', 'Wednesday', 6, 4),
(5, '5', 'Saturday', 6, 7);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `lop`
--

CREATE TABLE `lop` (
  `id` varchar(10) NOT NULL,
  `name` varchar(50) NOT NULL,
  `so_hoc_sinh` int(11) NOT NULL,
  `khoa_hoc` varchar(10) NOT NULL,
  `kip_hoc` varchar(3) NOT NULL,
  `ngay_bat_dau` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Đang đổ dữ liệu cho bảng `lop`
--

INSERT INTO `lop` (`id`, `name`, `so_hoc_sinh`, `khoa_hoc`, `kip_hoc`, `ngay_bat_dau`) VALUES
('LT1216A', 'Lop lap trinh ung dung khung gio A', 50, 'D_LTUD', '1', '2016-12-15'),
('LT1216E', 'Lop lap trinh ung dung 12/2016 khung gio E', 30, 'D_LTUD', '4', '2016-12-15');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `mon`
--

CREATE TABLE `mon` (
  `id` varchar(10) NOT NULL,
  `name` varchar(50) NOT NULL,
  `thoi_luong` int(11) NOT NULL,
  `noi_dung` varchar(150) DEFAULT NULL,
  `ghi_chu` varchar(150) DEFAULT NULL,
  `thuoc_tinh` varchar(10) DEFAULT NULL,
  `khoa_hoc` varchar(10) DEFAULT NULL,
  `ctdt` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Đang đổ dữ liệu cho bảng `mon`
--

INSERT INTO `mon` (`id`, `name`, `thoi_luong`, `noi_dung`, `ghi_chu`, `thuoc_tinh`, `khoa_hoc`, `ctdt`) VALUES
('JP', 'Khoa hoc lap trinh cong nghe JAVA', 270, NULL, NULL, NULL, NULL, NULL),
('MN', 'Khoa hoc lap trinh cong nghe .NET', 268, NULL, NULL, NULL, NULL, NULL),
('WP', 'Lap trinh WEB ma nguon mo', 327, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `nhom_giao_vien`
--

CREATE TABLE `nhom_giao_vien` (
  `id` varchar(10) NOT NULL,
  `name` varchar(50) NOT NULL,
  `mo_ta` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Đang đổ dữ liệu cho bảng `nhom_giao_vien`
--

INSERT INTO `nhom_giao_vien` (`id`, `name`, `mo_ta`) VALUES
('N01', 'Giao vien day lap trinh', NULL),
('N02', 'Giao vien day do hoa', NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `nhom_giao_vien_theo_mon`
--

CREATE TABLE `nhom_giao_vien_theo_mon` (
  `id` varchar(10) NOT NULL,
  `name` varchar(50) NOT NULL,
  `mon` varchar(10) NOT NULL,
  `mo_ta` varchar(150) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `phan_lop_phong_mon_giao_vien`
--

CREATE TABLE `phan_lop_phong_mon_giao_vien` (
  `lop` varchar(10) NOT NULL,
  `mon` varchar(10) NOT NULL,
  `giao_vien` varchar(10) NOT NULL,
  `phong` varchar(10) NOT NULL,
  `ngay_bat_dau` date NOT NULL,
  `ngay_ket_thuc` date NOT NULL,
  `kip_hoc` int(10) DEFAULT NULL,
  `ngay_hoc` varchar(600) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Đang đổ dữ liệu cho bảng `phan_lop_phong_mon_giao_vien`
--

INSERT INTO `phan_lop_phong_mon_giao_vien` (`lop`, `mon`, `giao_vien`, `phong`, `ngay_bat_dau`, `ngay_ket_thuc`, `kip_hoc`, `ngay_hoc`) VALUES
('LT1216A', 'WP', 'GV02', 'L2', '0000-00-00', '0000-00-00', 1, NULL),
('LT1216E', 'WP', 'GV01', 'L1', '2016-12-15', '2017-06-15', 4, NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `phong`
--

CREATE TABLE `phong` (
  `id` varchar(10) NOT NULL,
  `name` varchar(50) NOT NULL,
  `kieu_phong` varchar(20) NOT NULL,
  `so_ghe` int(11) NOT NULL,
  `ghi_chu` varchar(150) DEFAULT NULL,
  `muc_uu_tien` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Đang đổ dữ liệu cho bảng `phong`
--

INSERT INTO `phong` (`id`, `name`, `kieu_phong`, `so_ghe`, `ghi_chu`, `muc_uu_tien`) VALUES
('L1', 'Lab 1', 'Da nang', 50, 'Phòng m?i', 1),
('L2', 'Lab 2', 'Da nang', 50, 'Phòng m?i', 1),
('L3', 'Lab 3', 'Da nang', 50, 'Phòng m?i', 2),
('L4', 'Lab 4', 'Da nang', 50, 'Phòng m?i', 2),
('L5', 'Lab 5', 'Da nang', 50, 'Phòng m?i', 3),
('S', 'Seminar', 'Da nang', 30, 'Phòng m?i', 3);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `phong_co_lop`
--

CREATE TABLE `phong_co_lop` (
  `ngay_bat_dau` date NOT NULL,
  `ngay_ket_thuc` date NOT NULL,
  `phong` varchar(10) NOT NULL,
  `thu` int(11) NOT NULL,
  `khung_gio` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Đang đổ dữ liệu cho bảng `phong_co_lop`
--

INSERT INTO `phong_co_lop` (`ngay_bat_dau`, `ngay_ket_thuc`, `phong`, `thu`, `khung_gio`) VALUES
('2018-05-01', '2018-05-18', 'L4', 3, '4');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `thuoc_tinh_mon`
--

CREATE TABLE `thuoc_tinh_mon` (
  `id` varchar(10) NOT NULL,
  `thuoc_tinh` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `account`
--
ALTER TABLE `account`
  ADD PRIMARY KEY (`ma`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Chỉ mục cho bảng `chuong_trinh_dao_tao`
--
ALTER TABLE `chuong_trinh_dao_tao`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `giao_vien`
--
ALTER TABLE `giao_vien`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `giao_vien_co_lop`
--
ALTER TABLE `giao_vien_co_lop`
  ADD KEY `fk_gv` (`ma_giao_vien`),
  ADD KEY `fk_kg` (`khung_gio`);

--
-- Chỉ mục cho bảng `giao_vien_mon`
--
ALTER TABLE `giao_vien_mon`
  ADD PRIMARY KEY (`ma_giao_vien`,`ma_mon`),
  ADD KEY `fk_mon` (`ma_mon`);

--
-- Chỉ mục cho bảng `giao_vien_nhom`
--
ALTER TABLE `giao_vien_nhom`
  ADD KEY `ma_giao_vien` (`ma_giao_vien`),
  ADD KEY `ma_nhom` (`ma_nhom`);

--
-- Chỉ mục cho bảng `giao_vien_nhom_theo_mon`
--
ALTER TABLE `giao_vien_nhom_theo_mon`
  ADD KEY `ma_giao_vien` (`ma_giao_vien`),
  ADD KEY `ma_nhom_theo_mon` (`ma_nhom_theo_mon`);

--
-- Chỉ mục cho bảng `khoa_hoc`
--
ALTER TABLE `khoa_hoc`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `khoa_hoc_mon`
--
ALTER TABLE `khoa_hoc_mon`
  ADD PRIMARY KEY (`khoa_hoc`,`mon`),
  ADD KEY `mon` (`mon`);

--
-- Chỉ mục cho bảng `khung_gio`
--
ALTER TABLE `khung_gio`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `kip_hoc`
--
ALTER TABLE `kip_hoc`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `kip_hoc_thu_khung_gio`
--
ALTER TABLE `kip_hoc_thu_khung_gio`
  ADD KEY `id` (`id`);

--
-- Chỉ mục cho bảng `lop`
--
ALTER TABLE `lop`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_lop_khoahoc` (`khoa_hoc`);

--
-- Chỉ mục cho bảng `mon`
--
ALTER TABLE `mon`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_thuoc_tinh` (`thuoc_tinh`),
  ADD KEY `fk_khoa_hoc` (`khoa_hoc`),
  ADD KEY `fk_mon_2` (`ctdt`);

--
-- Chỉ mục cho bảng `nhom_giao_vien`
--
ALTER TABLE `nhom_giao_vien`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `nhom_giao_vien_theo_mon`
--
ALTER TABLE `nhom_giao_vien_theo_mon`
  ADD PRIMARY KEY (`id`),
  ADD KEY `mon` (`mon`);

--
-- Chỉ mục cho bảng `phan_lop_phong_mon_giao_vien`
--
ALTER TABLE `phan_lop_phong_mon_giao_vien`
  ADD PRIMARY KEY (`lop`,`mon`),
  ADD KEY `mon` (`mon`),
  ADD KEY `giao_vien` (`giao_vien`),
  ADD KEY `phong` (`phong`),
  ADD KEY `fk_kip` (`kip_hoc`);

--
-- Chỉ mục cho bảng `phong`
--
ALTER TABLE `phong`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `phong_co_lop`
--
ALTER TABLE `phong_co_lop`
  ADD KEY `phong` (`phong`),
  ADD KEY `khung_gio` (`khung_gio`);

--
-- Chỉ mục cho bảng `thuoc_tinh_mon`
--
ALTER TABLE `thuoc_tinh_mon`
  ADD PRIMARY KEY (`id`);

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `giao_vien_co_lop`
--
ALTER TABLE `giao_vien_co_lop`
  ADD CONSTRAINT `fk_gv` FOREIGN KEY (`ma_giao_vien`) REFERENCES `giao_vien` (`id`),
  ADD CONSTRAINT `fk_kg` FOREIGN KEY (`khung_gio`) REFERENCES `khung_gio` (`id`);

--
-- Các ràng buộc cho bảng `giao_vien_mon`
--
ALTER TABLE `giao_vien_mon`
  ADD CONSTRAINT `fk_giao_vien` FOREIGN KEY (`ma_giao_vien`) REFERENCES `giao_vien` (`id`),
  ADD CONSTRAINT `fk_mon` FOREIGN KEY (`ma_mon`) REFERENCES `mon` (`id`);

--
-- Các ràng buộc cho bảng `giao_vien_nhom`
--
ALTER TABLE `giao_vien_nhom`
  ADD CONSTRAINT `giao_vien_nhom_ibfk_1` FOREIGN KEY (`ma_giao_vien`) REFERENCES `giao_vien` (`id`),
  ADD CONSTRAINT `giao_vien_nhom_ibfk_2` FOREIGN KEY (`ma_nhom`) REFERENCES `nhom_giao_vien` (`id`);

--
-- Các ràng buộc cho bảng `giao_vien_nhom_theo_mon`
--
ALTER TABLE `giao_vien_nhom_theo_mon`
  ADD CONSTRAINT `giao_vien_nhom_theo_mon_ibfk_1` FOREIGN KEY (`ma_giao_vien`) REFERENCES `giao_vien` (`id`),
  ADD CONSTRAINT `giao_vien_nhom_theo_mon_ibfk_2` FOREIGN KEY (`ma_nhom_theo_mon`) REFERENCES `nhom_giao_vien_theo_mon` (`id`);

--
-- Các ràng buộc cho bảng `khoa_hoc_mon`
--
ALTER TABLE `khoa_hoc_mon`
  ADD CONSTRAINT `khoa_hoc_mon_ibfk_1` FOREIGN KEY (`khoa_hoc`) REFERENCES `khoa_hoc` (`id`),
  ADD CONSTRAINT `khoa_hoc_mon_ibfk_2` FOREIGN KEY (`mon`) REFERENCES `mon` (`id`);

--
-- Các ràng buộc cho bảng `kip_hoc_thu_khung_gio`
--
ALTER TABLE `kip_hoc_thu_khung_gio`
  ADD CONSTRAINT `kip_hoc_thu_khung_gio_ibfk_1` FOREIGN KEY (`id`) REFERENCES `kip_hoc` (`id`);

--
-- Các ràng buộc cho bảng `lop`
--
ALTER TABLE `lop`
  ADD CONSTRAINT `fk_lop_khoahoc` FOREIGN KEY (`khoa_hoc`) REFERENCES `khoa_hoc` (`id`);

--
-- Các ràng buộc cho bảng `mon`
--
ALTER TABLE `mon`
  ADD CONSTRAINT `fk_khoa_hoc` FOREIGN KEY (`khoa_hoc`) REFERENCES `khoa_hoc` (`id`),
  ADD CONSTRAINT `fk_mon_2` FOREIGN KEY (`ctdt`) REFERENCES `chuong_trinh_dao_tao` (`id`),
  ADD CONSTRAINT `fk_thuoc_tinh` FOREIGN KEY (`thuoc_tinh`) REFERENCES `thuoc_tinh_mon` (`id`);

--
-- Các ràng buộc cho bảng `nhom_giao_vien_theo_mon`
--
ALTER TABLE `nhom_giao_vien_theo_mon`
  ADD CONSTRAINT `nhom_giao_vien_theo_mon_ibfk_1` FOREIGN KEY (`mon`) REFERENCES `mon` (`id`);

--
-- Các ràng buộc cho bảng `phan_lop_phong_mon_giao_vien`
--
ALTER TABLE `phan_lop_phong_mon_giao_vien`
  ADD CONSTRAINT `fk_kip` FOREIGN KEY (`kip_hoc`) REFERENCES `kip_hoc` (`id`),
  ADD CONSTRAINT `phan_lop_phong_mon_giao_vien_ibfk_1` FOREIGN KEY (`lop`) REFERENCES `lop` (`id`),
  ADD CONSTRAINT `phan_lop_phong_mon_giao_vien_ibfk_2` FOREIGN KEY (`mon`) REFERENCES `mon` (`id`),
  ADD CONSTRAINT `phan_lop_phong_mon_giao_vien_ibfk_3` FOREIGN KEY (`giao_vien`) REFERENCES `giao_vien` (`id`),
  ADD CONSTRAINT `phan_lop_phong_mon_giao_vien_ibfk_4` FOREIGN KEY (`phong`) REFERENCES `phong` (`id`);

--
-- Các ràng buộc cho bảng `phong_co_lop`
--
ALTER TABLE `phong_co_lop`
  ADD CONSTRAINT `phong_co_lop_ibfk_1` FOREIGN KEY (`phong`) REFERENCES `phong` (`id`),
  ADD CONSTRAINT `phong_co_lop_ibfk_2` FOREIGN KEY (`khung_gio`) REFERENCES `khung_gio` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
