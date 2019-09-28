-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th4 27, 2018 lúc 10:24 AM
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
-- Cơ sở dữ liệu: `ky_nang_mem`
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `bai_viet`
--

CREATE TABLE `bai_viet` (
  `ma` varchar(50) NOT NULL,
  `thu_muc_cha` varchar(50) NOT NULL,
  `tieu_de` varchar(100) NOT NULL,
  `trich_dan` varchar(300) NOT NULL,
  `noi_dung` varchar(1000) NOT NULL,
  `ngay_tao` date DEFAULT NULL,
  `trang_thai` varchar(3) DEFAULT NULL,
  `anh_dai_dien` varchar(100) DEFAULT NULL,
  `tieu_bieu` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `slide_show`
--

CREATE TABLE `slide_show` (
  `thu_tu` int(11) NOT NULL,
  `anh` varchar(150) NOT NULL,
  `noi_dung` varchar(300) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `thu_muc`
--

CREATE TABLE `thu_muc` (
  `ma` varchar(50) NOT NULL,
  `name` varchar(100) NOT NULL,
  `ngay_tao` date NOT NULL,
  `trang_thai` varchar(3) NOT NULL,
  `mota` varchar(300) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `video`
--

CREATE TABLE `video` (
  `ma` varchar(50) NOT NULL,
  `vi_tri` varchar(100) DEFAULT NULL,
  `duong_dan` varchar(150) NOT NULL,
  `mo_ta` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
-- Chỉ mục cho bảng `bai_viet`
--
ALTER TABLE `bai_viet`
  ADD PRIMARY KEY (`ma`),
  ADD KEY `fk_` (`thu_muc_cha`);

--
-- Chỉ mục cho bảng `slide_show`
--
ALTER TABLE `slide_show`
  ADD PRIMARY KEY (`thu_tu`);

--
-- Chỉ mục cho bảng `thu_muc`
--
ALTER TABLE `thu_muc`
  ADD PRIMARY KEY (`ma`);

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `bai_viet`
--
ALTER TABLE `bai_viet`
  ADD CONSTRAINT `fk_` FOREIGN KEY (`thu_muc_cha`) REFERENCES `thu_muc` (`ma`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
