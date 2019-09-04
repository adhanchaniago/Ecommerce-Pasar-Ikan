-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 01 Agu 2019 pada 15.04
-- Versi server: 10.1.37-MariaDB
-- Versi PHP: 7.3.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `tugas`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `barang_penjual`
--

CREATE TABLE `barang_penjual` (
  `id` int(11) NOT NULL,
  `id_penjual` int(11) NOT NULL,
  `nama_barang` varchar(128) NOT NULL,
  `stock_barang` varchar(255) NOT NULL,
  `harga_barang` int(20) NOT NULL,
  `image_barang` varchar(255) NOT NULL,
  `latitude` varchar(250) NOT NULL,
  `longtitude` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `barang_penjual`
--

INSERT INTO `barang_penjual` (`id`, `id_penjual`, `nama_barang`, `stock_barang`, `harga_barang`, `image_barang`, `latitude`, `longtitude`) VALUES
(19, 23, 'Ikan bandeng', '{\"satuan\":\"ons\",\"stok\":\"10\"}', 12000, 'bawal-putih1.jpg', '-6.1513728', '106.8130983'),
(20, 26, 'ikan baronang', '{\"satuan\":\"kilo\",\"stok\":\"20\"}', 50000, 'baronang20.jpg', '-6.1513728', '106.8130983'),
(21, 23, 'ikan bawal hitam', '{\"satuan\":\"ons\",\"stok\":\"15\"}', 45000, 'bawal-hitam2.JPG', '-6.1513728', '106.8130983'),
(22, 32, 'Ikan Kembung', '{\"satuan\":\"kilo\",\"stok\":\"13\"}', 52000, 'kembung3.jpg', '-6.1513728', '106.8130983'),
(23, 33, 'Ikan Nila', '{\"satuan\":\"kilo\",\"stok\":\"7\"}', 50000, 'kakap2.jpg', '-6.1513728', '106.8130983');

-- --------------------------------------------------------

--
-- Struktur dari tabel `cairkan`
--

CREATE TABLE `cairkan` (
  `id` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `nama_penerima` varchar(128) NOT NULL,
  `nomor_rekening` int(20) NOT NULL,
  `nama_bank` varchar(128) NOT NULL,
  `jumlah_dana` int(20) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `cairkan`
--

INSERT INTO `cairkan` (`id`, `id_user`, `nama_penerima`, `nomor_rekening`, `nama_bank`, `jumlah_dana`, `status`) VALUES
(4, 25, 'kintamanu', 98765432, 'Bank BCA', 132000, 0),
(5, 23, 'iwiwiwiw', 1231231231, 'bank bca', 88000, 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `pasar`
--

CREATE TABLE `pasar` (
  `id` int(11) NOT NULL,
  `nama_pasar` varchar(150) NOT NULL,
  `alamat_pasar` varchar(255) NOT NULL,
  `koordinat` varchar(200) NOT NULL,
  `latitude` varchar(128) NOT NULL,
  `longtitude` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `pasar`
--

INSERT INTO `pasar` (`id`, `nama_pasar`, `alamat_pasar`, `koordinat`, `latitude`, `longtitude`) VALUES
(1, 'Pasar Jaya Kedoya', 'Jalan Kedoya Pesing, 8 No.14, RT.14/RW.8, Kedoya Utara, Kb. Jeruk, Kota Jakarta Barat, Daerah Khusus Ibukota Jakarta 11520', 'https://goo.gl/maps/mYo3Mh2RAVB82CHD7', '-6.163806', '106.764770'),
(2, 'Pasar Jaya Grogol', 'Jl. DR. Mawardi Raya\r\nRT.7/RW.2, Grogol\r\nGrogol petamburan\r\nKota Jakarta Barat, Daerah Khusus Ibukota Jakarta 11450', 'https://goo.gl/maps/faqP6J1tVvH3Supj9', '-6.1628606', '106.7971647'),
(3, 'Pasar Jaya Tomang Barat', 'Jl. Tanjung Duren Raya\r\nRT.14/RW.5, Tj. Duren Sel.\r\nGrogol petamburan\r\nKota Jakarta Barat, Daerah Khusus Ibukota Jakarta 11470', 'https://goo.gl/maps/MiyovF9wscbmfB6w6', '-6.1778115', '106.782035'),
(4, 'Pasar Jaya Pos Pengumben', 'Jl. Raya Pos Pengumben, RT.7/RW.5, Sukabumi Sel., Kb. Jeruk, Kota Jakarta Barat, Daerah Khusus Ibukota Jakarta 11560', 'https://goo.gl/maps/3kwEqYD8z3hk4B976', '-6.2177283', '106.7622935'),
(5, 'Pasar Jaya Glodok', 'Jl. Medan Glodok Glodok Taman Sari Jakarta Barat DKI Jakarta, RT.2/RW.1, Glodok, Tamansari, Kota Jakarta Barat, Daerah Khusus Ibukota Jakarta 11120', 'https://goo.gl/maps/4PN8TUV25C47patX8', '-6.1426573', '106.813629'),
(6, 'Pasar Jaya Gang Kancil', 'Jl. Keamanan Kel.Keagungan Kec.Taman Sari. Kode-pos 11130', 'https://goo.gl/maps/Uctn5LuK8r3dnwvn8', '-6.1513728', '106.8130983'),
(7, 'Pasar Jaya Jembatan Besi', 'Jl. Jembatan Besi II Kel.Jembatan Besi Kec.Tambora. Kode-pos 11320', 'https://goo.gl/maps/VfNarbEXHz5KYpnU7', '-6.1503382', '106.796664'),
(8, 'Pasar Jaya Jembatan Lima', 'Jl. K.H. Moch. Mansyur 011/01 Kel.Jembatan Lima Kec.Tambora. Kode-pos 11250', 'https://goo.gl/maps/Ma8vp9W5SndFJPjJ6', '-6.1503248', '106.7928338'),
(9, 'Pasar Jaya Pagi', 'Jl. Mangga Dua Raya, RT.11/RW.5, Ancol, Pademangan, Kota Jkt Utara, Daerah Khusus Ibukota Jakarta 10730', 'https://goo.gl/maps/ZQgMToz4hGsU1DRz7', '-6.1360595', '106.8202612'),
(10, 'Pasar Jaya Pecah Kulit', 'Jl. Mangga Besar IX Kel.Pinangsia Kec.Taman Sari', 'https://goo.gl/maps/zxMgcC8XdR3frLmF6', '-6.1414708', '106.8219243'),
(11, 'Pasar Jaya Pejagalan', 'JL. Pejagalan, Pakojan, Tambora, RT.1/RW.5, Pekojan, Tambora, Kota Jakarta Barat, Daerah Khusus Ibukota Jakarta 11240', 'https://goo.gl/maps/mvrVB4UYrLaeXgrY9', '-6.1370485', '106.8050044'),
(12, 'Pasar Jaya Sawah Besar', 'Jalan Sawah Besar, RT.3/RW.2, Maphar, Tamansari, Kota Jakarta Barat, Daerah Khusus Ibukota Jakarta 11160', 'https://goo.gl/maps/xp82CmAp6VgRGEqm7', '-6.1591983', '106.8204309'),
(13, 'Pasar Jaya Bojong indah', 'Jl. Pakis Raya\r\nRT.9/RW.6, Rw. Buaya\r\nCengkareng\r\nKota Jakarta Barat\r\nDaerah Khusus Ibukota Jakarta 11740', 'https://goo.gl/maps/tYuCigTrraU1RCz68', '-6.1614801', '106.7403974'),
(14, 'Pasar Jaya Cengkareng', 'Jl. Bangun Nusa, 001/02 Kel.Cengkareng Timur Kec.Cengkareng. Kode-pos 11730', 'https://goo.gl/maps/1CXnDvdGntyQ54j4A', '-6.1515228', '106.7280556'),
(15, 'Pasar Jaya Perumahan Citra ', 'Jl. Perumahan Citra Garden I Ext. 008/015 Kel.Kalideres Kec.Kalideres. Kode-pos 11840', 'https://goo.gl/maps/pP6Kp8jafBjLZmQL8', '-6.1506723', '106.6968967'),
(16, 'Pasar Jaya Duta Mas', 'Jl. Komplek Perumahan Duta Mas, 002/09 Kel.Wijaya Kusuma Kec.Grogol Petamburan. Kode-pos 11460', 'https://goo.gl/maps/99oK2jyojYq4UnfK7', '-6.1501162', '106.7796619'),
(17, 'Pasar Jaya Ganefo', 'Jl. Utama Raya No.1, 009/01 Kel.Cengkareng Barat Kec.Cengkareng. Kode-pos 11730', 'https://goo.gl/maps/MBAxVJeyDYkis6zZ9', '-6.1494443', '106.7211308'),
(18, 'Pasar Jaya Jelambar Polri', 'Jl. Kavling Polri Kel.Wijaya Kusuma Kec.Grogol Petamburan. Kode-pos 11460', 'https://goo.gl/maps/LUFM6ZPA5FgcwwYR7', '-6.1605291', '106.778676'),
(19, 'Pasar Jaya Jembatan Dua', 'Jl. Tubagus Angke, 005/09 Kel.Angke Kec.Tambora. Kode-pos 11330', 'https://goo.gl/maps/WQXWXhwSoQmkedxB7', '-6.142756', '106.789641'),
(20, 'Pasar Jaya Kalideres', 'Jl. Benda Raya Kel.Kalideres Kec.Kalideres. Kode-pos 11840', 'https://goo.gl/maps/HHuNMCagUy6aCcvP7', '-6.1529103', '106.7037823'),
(21, 'Pasar Jaya Kampung Duri', 'Jl. Duri Raya, 001/03 Kel.Duri Selatan Kec.Tambora. Kode-pos 11270', 'https://goo.gl/maps/eDZJuM2QuWs2dBe29', '-6.1599785', '106.8016265'),
(22, 'Pasar Jaya Slipi', 'Jl. Anggrek Garuda Kel.Kemanggisan Kec.Pal Merah', 'https://goo.gl/maps/5truFPBWhUx6QjjH8', '-6.1902189', '106.7937476'),
(23, 'Pasar Jaya Timbul Barat', 'Jl. Tomang Tinggi Raya Kel.Tomang Kec.Grogol Petamburan. Kode-pos 11440', 'https://goo.gl/maps/GMtc72vch9Ww18rN7', '-6.1725003', '106.7947072');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pesanan`
--

CREATE TABLE `pesanan` (
  `id` int(11) NOT NULL,
  `id_pembeli` int(20) NOT NULL,
  `id_penjual` int(12) NOT NULL,
  `id_barang` int(20) NOT NULL,
  `jmlh_barang` int(10) NOT NULL,
  `id_satuan` int(3) NOT NULL,
  `request` varchar(255) NOT NULL,
  `alamat` varchar(255) NOT NULL,
  `biaya` int(10) NOT NULL,
  `image` varchar(255) NOT NULL,
  `resi` varchar(255) NOT NULL,
  `id_status` int(5) NOT NULL,
  `pesanan_dibuat` int(20) NOT NULL,
  `status_notif` int(1) NOT NULL,
  `id_pencairan` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `pesanan`
--

INSERT INTO `pesanan` (`id`, `id_pembeli`, `id_penjual`, `id_barang`, `jmlh_barang`, `id_satuan`, `request`, `alamat`, `biaya`, `image`, `resi`, `id_status`, `pesanan_dibuat`, `status_notif`, `id_pencairan`) VALUES
(17, 25, 23, 10, 3, 1, 'potong jadi 3 bagian', 'Jl. Sawo Raya, Jatipulo, Kec. Palmerah, Kota Jakarta Barat, Daerah Khusus Ibukota Jakarta 11430, Indonesia', 44000, 'abcd1.jpg', '', 2, 0, 0, 0),
(18, 25, 23, 1, 3, 1, 'potong jadi 3 bagian', 'Jl. Sawo Raya, Jatipulo, Kec. Palmerah, Kota Jakarta Barat, Daerah Khusus Ibukota Jakarta 11430, Indonesia', 44000, '', '', 4, 1561623609, 0, 0),
(20, 25, 23, 1, 3, 1, 'potong jadi 3 bagian', 'Jl. Sawo Raya, Jatipulo, Kec. Palmerah, Kota Jakarta Barat, Daerah Khusus Ibukota Jakarta 11430, Indonesia', 44000, '', 'Go-send/0021/2019', 6, 1561621199, 0, 1),
(21, 25, 23, 13, 3, 1, 'potong jadi 3 bagian', 'Jl. Sawo Raya, Jatipulo, Kec. Palmerah, Kota Jakarta Barat, Daerah Khusus Ibukota Jakarta 11430, Indonesia', 44000, '', 'Go-send/0021/2019', 2, 0, 0, 0),
(22, 25, 23, 10, 3, 1, 'potong jadi 3 bagian', 'Jl. Sawo Raya, Jatipulo, Kec. Palmerah, Kota Jakarta Barat, Daerah Khusus Ibukota Jakarta 11430, Indonesia', 44000, '', '', 7, 0, 0, 1),
(23, 25, 23, 1, 3, 1, 'potong jadi 3 bagian', 'Jl. Sawo Raya, Jatipulo, Kec. Palmerah, Kota Jakarta Barat, Daerah Khusus Ibukota Jakarta 11430, Indonesia', 44000, '', 'Go-send/0021/2019', 7, 1561624209, 0, 1),
(24, 25, 23, 1, 3, 1, 'potong jadi 3 bagian', 'Jl. Sawo Raya, Jatipulo, Kec. Palmerah, Kota Jakarta Barat, Daerah Khusus Ibukota Jakarta 11430, Indonesia', 44000, '', 'Go-send/0021/2019', 7, 1561624209, 0, 1),
(25, 25, 23, 1, 3, 1, 'potong jadi 3 bagian', 'Jl. Sawo Raya, Jatipulo, Kec. Palmerah, Kota Jakarta Barat, Daerah Khusus Ibukota Jakarta 11430, Indonesia', 44000, '', 'Go-send/0021/2019', 6, 1561624209, 0, 1),
(26, 25, 23, 1, 3, 1, 'potong jadi 3 bagian', 'Jl. Sawo Raya, Jatipulo, Kec. Palmerah, Kota Jakarta Barat, Daerah Khusus Ibukota Jakarta 11430, Indonesia', 44000, '', 'Go-send/0021/2019', 4, 1561624209, 0, 0),
(27, 25, 23, 1, 3, 1, 'potong jadi 3 bagian', 'Jl. Sawo Raya, Jatipulo, Kec. Palmerah, Kota Jakarta Barat, Daerah Khusus Ibukota Jakarta 11430, Indonesia', 44000, '', 'Go-send/0021/2019', 7, 1561624209, 0, 0),
(28, 25, 23, 1, 3, 1, 'potong jadi 3 bagian', 'Jl. Sawo Raya, Jatipulo, Kec. Palmerah, Kota Jakarta Barat, Daerah Khusus Ibukota Jakarta 11430, Indonesia', 44000, '', 'Go-send/0021/2019', 7, 1561623609, 0, 0),
(29, 25, 23, 13, 3, 1, 'potong jadi 3 bagian', 'Jl. Sawo Raya, Jatipulo, Kec. Palmerah, Kota Jakarta Barat, Daerah Khusus Ibukota Jakarta 11430, Indonesia', 44000, '', 'Go-send/0021/2019', 4, 0, 0, 0),
(30, 25, 33, 10, 8, 1, 'Di potong ukuran 3 jari', 'Jl. Semangka Raya, Jatipulo, Kec. Palmerah, Kota Jakarta Barat, Daerah Khusus Ibukota Jakarta 11430, Indonesia', 69952, 'images.jpeg', '', 3, 1564050205, 0, 0),
(31, 25, 33, 10, 8, 1, 'Di potong ukuran 3 jari', 'Jl. Semangka Raya, Jatipulo, Kec. Palmerah, Kota Jakarta Barat, Daerah Khusus Ibukota Jakarta 11430, Indonesia', 69952, '', '', 3, 1564050205, 0, 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `satuan`
--

CREATE TABLE `satuan` (
  `id` int(11) NOT NULL,
  `satuan_brt` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `satuan`
--

INSERT INTO `satuan` (`id`, `satuan_brt`) VALUES
(1, 'ons'),
(2, 'kilogram');

-- --------------------------------------------------------

--
-- Struktur dari tabel `status`
--

CREATE TABLE `status` (
  `id` int(11) NOT NULL,
  `status` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `status`
--

INSERT INTO `status` (`id`, `status`) VALUES
(1, 'Pesanan Baru'),
(2, 'Menunggu Diverifikasi'),
(3, 'Menunggu Respon Penjual'),
(4, 'Pesanan Diproses'),
(5, 'Pesanan Dikirim'),
(6, 'Telah Diterima'),
(7, 'Dibatalkan Penjual');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `name` varchar(128) NOT NULL,
  `address` varchar(255) NOT NULL,
  `no_telp` varchar(20) NOT NULL,
  `image` varchar(128) NOT NULL,
  `id_pasar` int(11) NOT NULL,
  `no_lapak` varchar(128) NOT NULL,
  `role_id` int(11) NOT NULL,
  `is_active` int(1) NOT NULL,
  `date_created` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `email`, `password`, `name`, `address`, `no_telp`, `image`, `id_pasar`, `no_lapak`, `role_id`, `is_active`, `date_created`) VALUES
(11, 'rifai@gmail.com', '$2y$10$jNio4Bbs/sMtqtVmCC4Cw.76O91Xj6bAoysz/w7QdeexNYyhvwfb6', 'Akbar Rifai', 'jalan kemang raya, jakarta selatan', '0891214124', 'default.jpg', 0, '', 1, 1, 1556534768),
(14, 'erik@gmail.com', '$2y$10$MwknGyYJepVR.H9w6JINCeu7iwX/dMISY630av.drN/vK1vEVg4AC', 'erik', '', '', 'default.jpg', 0, '', 2, 0, 1557241282),
(23, 'credoku@gmail.com', '$2y$10$ClP.KJ9IVfVynMZj7F0RvO0zxoP0ErMiP0yWmhy1QnFgK/hXxrTQO', 'credokutest', 'jalan jati pulo, palmerah', '089765432112', 'default.jpg', 6, 'LBD ABC 001', 3, 1, 1557480769),
(25, 'tester@gmail.com', '$2y$10$Tg.n5F.W71nAWzPxGA7NueZx36E35Y.lwAkoDHHfd4Twr3OFSaAzq', 'tester', 'jalan manggis, kelurahan manggis utara, jakarta barat', '089765432121', 'default.jpg', 0, '', 2, 1, 1557671525),
(26, 'wibowoanang03@gmail.com', '$2y$10$iuZ8ZxQVWvBC0XctmtFKpuDkLxXQuLJs7RReTbbM7ulsPecX1d3SS', 'rifai', 'jalan jati baru', '087785712773', 'default.jpg', 7, 'LBD 0012', 3, 1, 1558457660),
(27, 'siapa@siapa.com', '$2y$10$2WKRSNV2dL/9No.VOQryz.FZYD4YI7dcukvPZErjAb31UtiEbbLSu', 'abc', '', '', 'default.jpg', 0, '', 2, 1, 1559031935),
(32, 'fahmi@yahoo.com', '$2y$10$FyUClLDIrWywhSU/7QjBvOqEDQ1T2NHODOFSYJdGVUe/ziyzC0Xme', 'fahmi', '', '', 'default.jpg', 14, 'LBC 022', 3, 1, 1560588573),
(33, 'fuad@yahoo.com', '$2y$10$7WH0ktF2dOrMMA76MQBG8.9s1M1bsWIv4SjAsIEruvoQA0/2.5Fe2', 'fuad', '', '', 'default.jpg', 4, 'LBH 010', 3, 1, 1560588684),
(37, 'iwakkers.12@gmail.com', '$2y$10$uVzyju0JKjuTl4AIZOhS5uXFnfZjyq5n1R5Lgc.E8gD/aI9DoR7ua', 'cacahandika', '', '', 'default.jpg', 0, '', 2, 0, 1563937848);

-- --------------------------------------------------------

--
-- Struktur dari tabel `user_access_menu`
--

CREATE TABLE `user_access_menu` (
  `id` int(11) NOT NULL,
  `role_id` int(11) NOT NULL,
  `menu_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `user_access_menu`
--

INSERT INTO `user_access_menu` (`id`, `role_id`, `menu_id`) VALUES
(1, 1, 1),
(3, 2, 2),
(4, 1, 3),
(5, 3, 4);

-- --------------------------------------------------------

--
-- Struktur dari tabel `user_menu`
--

CREATE TABLE `user_menu` (
  `id` int(11) NOT NULL,
  `menu` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `user_menu`
--

INSERT INTO `user_menu` (`id`, `menu`) VALUES
(1, 'admin'),
(2, 'user'),
(3, 'menu'),
(4, 'penjual');

-- --------------------------------------------------------

--
-- Struktur dari tabel `user_role`
--

CREATE TABLE `user_role` (
  `id` int(11) NOT NULL,
  `role` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `user_role`
--

INSERT INTO `user_role` (`id`, `role`) VALUES
(1, 'administrator'),
(2, 'member');

-- --------------------------------------------------------

--
-- Struktur dari tabel `user_token`
--

CREATE TABLE `user_token` (
  `id` int(11) NOT NULL,
  `email` varchar(128) NOT NULL,
  `token` varchar(128) NOT NULL,
  `date_created` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `user_token`
--

INSERT INTO `user_token` (`id`, `email`, `token`, `date_created`) VALUES
(10, 'awsd@gmail.com', 'SmEeAAbIVkOhCknBHm1me2WVuaBcKZMUNH0ZmMz+ABE=', 1557481917),
(11, 'credoku@gmail.com', 'QTCuTFFFDhkP+pVgTKUbj2JYXebNAMOESyIvDomKf5I=', 1557548390),
(13, 'tester@gmail.com', '1+3N8P9F6lcvodA0tck8QWNkNSZbUWH5Fsmstwd3dX8=', 1557671525),
(14, 'rifaiandby@yahoo.com', 'RCeq0QPZmhlqYWFh1dAELTo59OMe0XflMMMXeEr2u8Y=', 1558105220),
(15, 'siapa@siapa.com', 'bIg5Cn+KLM3bK0mTi8PkXyId/EBTeDcj0v0nOGgvCxw=', 1559031935),
(16, 'abc@abc.com', 'qgX+KZ687LSJ4qXr1dCaxf+nYun0uqOXHJ9PZvzVzqE=', 1560588252),
(17, 'abc@gmail.com', 'R1N8LWT9gMoocZNaCahqmTbwW/zZC0bwt/eVadImOdI=', 1560588350),
(18, 'abc@gmail.com', 'Vv6QZWhx9PaDVqMv71uq0rUTANp7QYey3oSAqI04HOs=', 1560588483),
(19, 'abc@gmail.com', 'gN7i3WP9ay3sh4Q1UwXkOsm9VqOr+Eksa7l3hrOL7+s=', 1560588514),
(20, 'fahmi@yahoo.com', 'F1Xx0GeQs11eHjN6uz1rzxup1Aq4qnUye/Ko4yYkLQo=', 1560588573),
(21, 'fuad@yahoo.com', '5Zxt9pdm0vnJEt9llJIikEk7aPuAIgYRUjBj+YNKVK8=', 1560588684),
(22, 'rifaiandby@yahoo.com', 'cPYX7HBz/s3927vxj9sIhZP3Q6YtipKxXkmKN5jT/sc=', 1561735159),
(23, 'iwakkers.12@gmail.com', '1ZIqBkgxAVJes3kqiZnTvqprRGjpxO9lIfVXPPSkSEs=', 1563937848);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `barang_penjual`
--
ALTER TABLE `barang_penjual`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `cairkan`
--
ALTER TABLE `cairkan`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `pasar`
--
ALTER TABLE `pasar`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `pesanan`
--
ALTER TABLE `pesanan`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `satuan`
--
ALTER TABLE `satuan`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `status`
--
ALTER TABLE `status`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_pasar` (`id_pasar`);

--
-- Indeks untuk tabel `user_access_menu`
--
ALTER TABLE `user_access_menu`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `user_menu`
--
ALTER TABLE `user_menu`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `user_role`
--
ALTER TABLE `user_role`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `user_token`
--
ALTER TABLE `user_token`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `barang_penjual`
--
ALTER TABLE `barang_penjual`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT untuk tabel `cairkan`
--
ALTER TABLE `cairkan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `pasar`
--
ALTER TABLE `pasar`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT untuk tabel `pesanan`
--
ALTER TABLE `pesanan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT untuk tabel `satuan`
--
ALTER TABLE `satuan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `status`
--
ALTER TABLE `status`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT untuk tabel `user_access_menu`
--
ALTER TABLE `user_access_menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `user_menu`
--
ALTER TABLE `user_menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `user_role`
--
ALTER TABLE `user_role`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `user_token`
--
ALTER TABLE `user_token`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
