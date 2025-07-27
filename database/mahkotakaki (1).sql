-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 27, 2025 at 02:28 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mahkotakaki`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--



-- --------------------------------------------------------

--
-- Table structure for table `chat`
--

CREATE TABLE `chat` (
  `id` int(11) NOT NULL,
  `sender` enum('customer','admin') NOT NULL,
  `sender_id` int(11) NOT NULL,
  `receiver_id` int(11) NOT NULL,
  `message` text NOT NULL,
  `waktu` timestamp NOT NULL DEFAULT current_timestamp(),
  `timestamp` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `chat`
--

INSERT INTO `chat` (`id`, `sender`, `sender_id`, `receiver_id`, `message`, `waktu`, `timestamp`) VALUES
(1, 'customer', 1, 1, 'kmkksdjfkllskke', '2025-07-11 06:40:47', '2025-07-11 13:40:47'),
(2, 'admin', 1, 1, 'ya mohon maaf', '2025-07-11 06:56:02', '2025-07-11 13:56:02'),
(3, 'admin', 1, 1, 'jknsjnskdjsd', '2025-07-11 06:56:09', '2025-07-11 13:56:09'),
(4, 'customer', 1, 1, 'hai', '2025-07-11 06:56:32', '2025-07-11 13:56:32'),
(5, 'customer', 1, 1, 'bagaimana ini', '2025-07-11 06:56:45', '2025-07-11 13:56:45'),
(6, 'customer', 1, 1, 'halo', '2025-07-11 07:14:28', '2025-07-11 14:14:28'),
(7, 'customer', 1, 1, 'halo', '2025-07-11 07:54:57', '2025-07-11 14:54:57'),
(8, 'customer', 1, 1, 'jsdjksd', '2025-07-11 07:55:18', '2025-07-11 14:55:18'),
(9, 'customer', 1, 1, 'halo', '2025-07-11 08:11:57', '2025-07-11 15:11:57'),
(10, 'admin', 1, 1, 'iya', '2025-07-11 08:12:23', '2025-07-11 15:12:23'),
(11, 'admin', 1, 1, 'njnkjskjkdkldjls', '2025-07-11 08:17:30', '2025-07-11 15:17:30'),
(12, 'customer', 1, 1, 'woiiiiiiiii', '2025-07-12 01:22:12', '2025-07-12 08:22:12'),
(13, 'customer', 11, 1, 'haiii', '2025-07-12 02:19:30', '2025-07-12 09:19:30');

-- --------------------------------------------------------

--
-- Table structure for table `detail_transaksi`
--

CREATE TABLE `detail_transaksi` (
  `id` int(11) NOT NULL,
  `transaksi_id` int(11) NOT NULL,
  `produk_id` int(11) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `subtotal` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `detail_transaksi`
--

INSERT INTO `detail_transaksi` (`id`, `transaksi_id`, `produk_id`, `jumlah`, `subtotal`) VALUES
(11, 26, 3, 1, 2300000),
(12, 27, 4, 1, 3000000),
(13, 28, 4, 2, 6000000),
(14, 29, 4, 1, 3000000),
(15, 30, 4, 1, 3000000),
(16, 31, 3, 1, 2300000),
(17, 33, 3, 1, 2300000),
(18, 34, 3, 1, 2300000),
(19, 35, 3, 1, 2300000),
(20, 36, 3, 2, 4600000),
(21, 37, 3, 4, 9200000),
(22, 38, 3, 1, 2300000),
(23, 39, 3, 1, 2300000),
(24, 39, 4, 1, 3000000),
(25, 40, 3, 1, 2300000);

-- --------------------------------------------------------

--
-- Table structure for table `kategori`
--

CREATE TABLE `kategori` (
  `id` int(11) NOT NULL,
  `nama_kategori` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `kategori`
--

INSERT INTO `kategori` (`id`, `nama_kategori`) VALUES
(1, 'Sneakers'),
(2, 'Runing'),
(3, 'Sandal'),
(4, 'Soccer'),
(5, 'Anak-anak');

-- --------------------------------------------------------

--
-- Table structure for table `pelanggan`
--

CREATE TABLE `pelanggan` (
  `id` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pelanggan`
--

INSERT INTO `pelanggan` (`id`, `nama`, `password`) VALUES
(1, 'fikri', '$2y$10$ZYVEa63dzHU/DX3.iXgqLu91djkyJNH0DtLesJyU7jVjDcQlG4hdW'),
(2, 'iqbal', '$2y$10$7c6BBkguVCSYYh4Tx0RFoeF9/GAdPuaGbAKGPP8qW/jNHjv3CZTKa'),
(3, 'roni', '$2y$10$8SMpIazkV4fajvqvmSyYQ.cdjNprAz/5tAcEtmHTu30s474Mf2nNq'),
(4, 'heni', '$2y$10$CtSCdnZrpRvK3PIR1W3njeI/aqAtoZRmdheVm8KvA8Nh0c8aLidla'),
(5, 'dssdas', '$2y$10$fL2UwpeVUrOpmsYqrvM0iOTFSZJZFqsruTwvPINK/uT.Fcu/gRcOa'),
(6, 'elsa', '$2y$10$UeDw0QK1f1PvtN6tKCscGeru8EQjzmIl3WQX/any1p2AA/bTABXZu'),
(7, 'adit', '$2y$10$F3/raYGk/9chHpO5i7FN2.1YPxfZ1of2OoXxSw0ll8nGivjR/uMsa'),
(8, 'fitri', '$2y$10$cZQEcB4pppuysOTlm27fNO7GV2ha0lbL9qxTsjM5/1ltM5ISY9v2m'),
(9, 'desi', '$2y$10$cl3ndi.BLmbLkOakA.qRSe3m8A2QDb0XnVIpJ3i4sa71C45CRvgOy'),
(10, 'jalal', '$2y$10$sEXHKfSkLQtTcEEHN7nzT.Izm8zKYkmzC0Lh2iX4jQbxLA8.SLPnS'),
(11, 'alif', '$2y$10$svfPZ3J/8rbUiEoTNZ.nouBemgjh5f3J24e8xc3FKhTwKZNr2FcVq');

-- --------------------------------------------------------

--
-- Table structure for table `pesan`
--

CREATE TABLE `pesan` (
  `id` int(11) NOT NULL,
  `pengirim_id` int(11) NOT NULL,
  `penerima_id` int(11) NOT NULL,
  `isi` text NOT NULL,
  `waktu` timestamp NOT NULL DEFAULT current_timestamp(),
  `dari_admin` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pesanan`
--

CREATE TABLE `pesanan` (
  `id` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `alamat` text NOT NULL,
  `metode` varchar(100) NOT NULL,
  `bukti` varchar(255) DEFAULT NULL,
  `tanggal` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pesanan`
--

INSERT INTO `pesanan` (`id`, `nama`, `alamat`, `metode`, `bukti`, `tanggal`) VALUES
(1, 'n,m', ' mn', 'Transfer Bank', '20250708085534_Screenshot 2025-06-25 224021.png', '2025-07-08 06:55:34'),
(2, 'adsddd', 'fdd', 'COD (Bayar di Tempat)', NULL, '2025-07-08 06:56:01'),
(3, 'fikri', 'condet', 'COD (Bayar di Tempat)', NULL, '2025-07-08 06:57:55'),
(4, 'randi', 'maluku', 'Transfer Bank', '20250708090144_Screenshot 2025-06-25 224021.png', '2025-07-08 07:01:44');

-- --------------------------------------------------------

--
-- Table structure for table `pesanan_detail`
--

CREATE TABLE `pesanan_detail` (
  `id` int(11) NOT NULL,
  `id_pesanan` int(11) NOT NULL,
  `id_produk` int(11) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `subtotal` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pesanan_detail`
--

INSERT INTO `pesanan_detail` (`id`, `id_pesanan`, `id_produk`, `jumlah`, `subtotal`) VALUES
(1, 1, 4, 2, 6000000),
(2, 2, 3, 1, 2300000),
(3, 3, 3, 1, 2300000),
(4, 4, 1, 1, 2000000);

-- --------------------------------------------------------

--
-- Table structure for table `produk`
--

CREATE TABLE `produk` (
  `id` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `deskripsi` text DEFAULT NULL,
  `harga` int(11) NOT NULL,
  `stok` int(11) NOT NULL,
  `gambar` varchar(255) DEFAULT NULL,
  `kategori_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `produk`
--

INSERT INTO `produk` (`id`, `nama`, `deskripsi`, `harga`, `stok`, `gambar`, `kategori_id`) VALUES
(1, 'Air Max Waffle', 'The Air Max Waffle merges two of Nike\'s most revolutionary sneakers to create an audacious design, rooted in heritage. It takes the signature midsole and Tuned Air cushioning from the Air Max Plus and pairs it with the lightweight upper and Waffle outsole from the famed, running-inspired Waffle Trainer. ', 2000000, 30, '61bba5d9679d8fce8a5bb36770c26267.jpg', 1),
(3, 'Women\'s Air Force 1 \'07', 'The legendary AF1 gets a luxe pony hair overhaul. The soft, hair-on leather adds depth and texture throughout the reimagined design, creating a new expression for the \'82 hoops-turned-streetwear icon. The padded, low-cut collar and Nike Air cushioning keep its comfort as classic as ever. Waxed laces and debossed branding elevate the finish. The Sail colourway features a Muslin midsole and outsole for a clean, neutral look that\'s easy to style—and hard to resist.', 2300000, 50, 'dbff474de31697741ad9a4b0692f88b6.jpg', 1),
(4, 'Nike Air Max Dn8', 'More Air, less bulk. The Dn8 takes our Dynamic Air system and condenses it into a sleek, low-profile package. Powered by eight pressurised Air tubes, it gives you a responsive sensation with every step. Enter an unreal experience of movement.', 3000000, 65, '45bec671b1a850eb308e3e182d552d6a.jpg', 1),
(5, 'Air Jordan 1 Low', 'Inspired by the original that debuted in 1985, the Air Jordan 1 Low offers a clean, classic look that\'s familiar yet always fresh. With an iconic design that pairs perfectly with any \'fit, these kicks ensure you\'ll always be on point.', 2000000, 50, 'cf36e65f785d5828ee4fd39dfb32c4d0.jpg', 1),
(6, 'WOMEN CALDERA PINCH', 'WS Caldera Pinch hadir untuk menemani kegiatanmu sehari-hari maupun saat berada di area base camp. Sandal jepit wanita dari EIGER Women ini dirancang dengan footbed anatomis dari bahan phylon yang ringan dan empuk. Sandal ini menawarkan kenyamanan serta fleksibilitas maksimal saat dipakai.', 230000, 45, '7f16da5a3b06fbdda98292cfcbb941ea.jpg', 3),
(7, 'Sepatu Bola F50 Firm ground', 'Temukan kecepatanmu untuk mengekspresikan diri sepenuhnya di lapangan. Rasakan sensasi sepatu bola adidas F50 yang dirancang untuk kecepatan. Puncak dari lini sepatu bola, sepatu bola ini mempertegas pengalaman sepatu bola cepat dengan outsole Sprintframe 360+ yang dilengkapi pelat ganda di bagian forefoot untuk akselerasi yang pas. Di bagian atas Fibertouch, sisipan Lightstrike Pro memberikan kenyamanan. Di bagian luar, tekstur Sprintweb 3D membuat dribel berkecepatan tinggi menjadi mudah.', 4000000, 23, '0e1401b008a691c9f7e68ce81f3c45e5.jpg', 4),
(8, 'Slides Mandi Adilette', 'Dari tepi kolam renang ke kamar mandi hingga sofa, slides ini didesain untuk gaya hidup untuk bekerja dan beristirahat dengan maksimal. Konstruksi slip-on membuat slides ini pas dan nyaman sehingga mudah dipakai dan dilepas sesukamu. Bantalan yang ringan membuat kakimu tetap nyaman sepanjang hari. Logo adidas dan desain 3-Stripes melengkapi style Adilette yang ikonis.', 250000, 54, 'db635b2acdf034a1b099c87a348a6202.jpg', 3),
(9, 'Sepatu Bola Predator Pro Fold Over Tongue Firm Ground', 'Sepatu bola dengan lidah model lipat yang suportif untuk menghasilkan tendangan akurat di lapangan firm ground.', 2400000, 20, '3d17efae7eec374c4a8c8a74ebf46158.jpg', 4),
(10, 'Sepatu Lari Adistar 4', 'Dirancang untuk lari yang lebih jauh dan stabil, sepatu lari adidas ini dibuat untuk membuat Anda latihan dengan kenyamanan. Sol REPETITOR mempertahankan rasa ringan sambil menawarkan bantalan maksimal dengan pengembalian energi dan stabilitas untuk lari jarak jauh. Sol yang tahan lama mampu bertahan terhadap latihan jarak jauh.\r\n\r\nSPESIFIKASI', 2500000, 32, 'c1d09b4703d20e9a617d180693b3efb3.jpg', 2),
(11, 'Deviate NITRO™ 3 Running Shoes Women', 'Experience unparalleled propulsion in your everyday training runs with the Deviate NITRO™ 3, featuring PWRPLATE technology and NITRO™ foam. This highly responsive trainer delivers a snappy ride, infusing speed into every stride.', 2500000, 23, 'Deviate-NITRO™-3-Running-Shoes-Women.avif', 2),
(12, 'PUMA x NEYMAR JR FUTURE 7 ULTIMATE FG/AG Football Boots', 'Playmakers, lock into the FUTURE just like Neymar Jr. The re-engineered upper combines PWRPRINT, PWRTAPE, extra stretchy knit, and soft dual mesh for a next-generation adaptive fit, so you can create without constraints throughout the 90 minutes. Dynamic Motion System provides traction and agility for quick cuts and changes of pace. When you wear the FUTURE, you are the FUTURE. Go create.', 1300000, 15, 'AG-Football-Boots.avif', 4),
(13, 'All-Day Active Alternative Closure Sneakers Babies', 'We know your little one is unstoppable, and the new All-Day Active is designed to keep up with them. These sneakers are enhanced with a hook-and-loop closure for easy on-and-off action, so nothing will stand between the youngest member of the family and playtime.', 314000, 12, 'All-Day-Active-Alternative-Closure-Sneakers-Babies.avif', 5),
(14, 'PUMA x PLAYMOBIL® R78 Sneakers Toddlers', 'Out of the toy box and into your closet – it’s PUMA x PLAYMOBIL®. Created in partnership with the iconic toy brand, this kids’ collab is all about playtime, self-expression, and creativity. Play your way in these classic fits and comfy kicks, like this version of our R78 sneakers, featuring fresh colours, sporty details, and friendly PLAYMOBIL® faces.', 549000, 33, 'PUMA-x-PLAYMOBIL®-R78-Sneakers-Toddlers.avif', 5);

-- --------------------------------------------------------

--
-- Table structure for table `transaksi`
--

CREATE TABLE `transaksi` (
  `id` int(11) NOT NULL,
  `nama_pembeli` varchar(100) DEFAULT NULL,
  `alamat` text DEFAULT NULL,
  `metode_pembayaran` varchar(50) DEFAULT NULL,
  `total` int(11) DEFAULT NULL,
  `tanggal` datetime DEFAULT current_timestamp(),
  `bukti_bayar` varchar(255) DEFAULT NULL,
  `pelanggan_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `transaksi`
--

INSERT INTO `transaksi` (`id`, `nama_pembeli`, `alamat`, `metode_pembayaran`, `total`, `tanggal`, `bukti_bayar`, `pelanggan_id`) VALUES
(26, 'fikri', 'vhgfhgfgfhgfg', 'E-Wallet (OVO/DANA/Gopay)', 2300000, '2025-07-08 01:08:30', '1751911710-Screenshot 2025-06-15 155557.png', NULL),
(27, 'fikri', 'vhgfhgfgfhgfg', 'E-Wallet (OVO/DANA/Gopay)', 3000000, '2025-07-08 01:13:43', '1751912023-Screenshot 2025-06-25 224021.png', NULL),
(28, 'ssasdw', 'wswsww', 'E-Wallet (OVO/DANA/Gopay)', 6000000, '2025-07-08 01:19:57', '1751912397-Screenshot 2025-06-25 224046.png', NULL),
(29, 'feri', 'hjkgghkhj', 'E-Wallet (OVO/DANA/Gopay)', 3000000, '2025-07-08 02:23:28', '1751916208-Screenshot 2025-06-25 224046.png', NULL),
(30, 'bdkjs', 'dsdf', 'E-Wallet (OVO/DANA/Gopay)', 3000000, '2025-07-08 11:32:37', '1751949157-Screenshot 2025-06-15 155557.png', NULL),
(31, 'xzxxzzxzx', 'zxzxxzx', 'Transfer Bank', 2300000, '2025-07-08 14:00:15', '1751958015-Screenshot 2025-06-25 224021.png', NULL),
(32, 'narto', 'saske', 'COD (Bayar di Tempat)', 2300000, '2025-07-08 14:12:04', NULL, 1),
(33, 'narto', 'saske', 'COD (Bayar di Tempat)', 2300000, '2025-07-08 14:17:10', NULL, 1),
(34, 'riski', 'villa', 'COD (Bayar di Tempat)', 2300000, '2025-07-08 14:20:45', NULL, 1),
(35, 'elsa', 'balaraja', 'COD (Bayar di Tempat)', 2300000, '2025-07-08 23:09:00', NULL, 6),
(36, 'fitri', 'hjkgghkhj', 'COD (Bayar di Tempat)', 4600000, '2025-07-10 20:35:10', NULL, 1),
(37, 'desi', 'konoha', 'COD (Bayar di Tempat)', 9200000, '2025-07-10 20:39:10', NULL, 9),
(38, 'fikri', 'balaraja', 'COD (Bayar di Tempat)', 2300000, '2025-07-11 21:06:50', NULL, 1),
(39, 'alif', 'tangerang', 'COD (Bayar di Tempat)', 5300000, '2025-07-12 09:20:59', NULL, 11),
(40, 'alif', 'yangerang', 'Transfer Bank', 2300000, '2025-07-12 09:21:50', '20250712042150_0e1401b008a691c9f7e68ce81f3c45e5.jpg', 11);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `chat`
--
ALTER TABLE `chat`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `detail_transaksi`
--
ALTER TABLE `detail_transaksi`
  ADD PRIMARY KEY (`id`),
  ADD KEY `transaksi_id` (`transaksi_id`),
  ADD KEY `produk_id` (`produk_id`);

--
-- Indexes for table `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pelanggan`
--
ALTER TABLE `pelanggan`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nama` (`nama`);

--
-- Indexes for table `pesan`
--
ALTER TABLE `pesan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pesanan`
--
ALTER TABLE `pesanan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pesanan_detail`
--
ALTER TABLE `pesanan_detail`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_pesanan` (`id_pesanan`),
  ADD KEY `id_produk` (`id_produk`);

--
-- Indexes for table `produk`
--
ALTER TABLE `produk`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `chat`
--
ALTER TABLE `chat`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `detail_transaksi`
--
ALTER TABLE `detail_transaksi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `kategori`
--
ALTER TABLE `kategori`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `pelanggan`
--
ALTER TABLE `pelanggan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `pesan`
--
ALTER TABLE `pesan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pesanan`
--
ALTER TABLE `pesanan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `pesanan_detail`
--
ALTER TABLE `pesanan_detail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `produk`
--
ALTER TABLE `produk`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `transaksi`
--
ALTER TABLE `transaksi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `detail_transaksi`
--
ALTER TABLE `detail_transaksi`
  ADD CONSTRAINT `detail_transaksi_ibfk_1` FOREIGN KEY (`transaksi_id`) REFERENCES `transaksi` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `detail_transaksi_ibfk_2` FOREIGN KEY (`produk_id`) REFERENCES `produk` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `pesanan_detail`
--
ALTER TABLE `pesanan_detail`
  ADD CONSTRAINT `pesanan_detail_ibfk_1` FOREIGN KEY (`id_pesanan`) REFERENCES `pesanan` (`id`),
  ADD CONSTRAINT `pesanan_detail_ibfk_2` FOREIGN KEY (`id_produk`) REFERENCES `produk` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
