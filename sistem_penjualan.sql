-- phpMyAdmin SQL Dump
-- version 5.2.2deb1+noble1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jun 22, 2025 at 02:29 AM
-- Server version: 10.11.11-MariaDB-0ubuntu0.24.04.2
-- PHP Version: 8.4.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sistem_penjualan`
--

-- --------------------------------------------------------

--
-- Table structure for table `barang`
--

CREATE TABLE `barang` (
  `id_barang` varchar(10) NOT NULL,
  `nama_barang` varchar(100) NOT NULL,
  `kategori` varchar(50) DEFAULT NULL,
  `harga_beli` decimal(15,2) NOT NULL,
  `harga_jual` decimal(15,2) NOT NULL,
  `stok` int(11) NOT NULL,
  `tanggal_kadaluarsa` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `barang`
--

INSERT INTO `barang` (`id_barang`, `nama_barang`, `kategori`, `harga_beli`, `harga_jual`, `stok`, `tanggal_kadaluarsa`) VALUES
('B009', 'Minuman Bersoda', 'Minuman', 5000.00, 7000.00, 12, '2025-10-18'),
('B010', 'Kopi', 'Minuman', 5000.00, 8000.00, 18, '2025-12-05'),
('B011', 'Sabun Mandi', 'Perlengkapan Mandi', 5000.00, 7000.00, 30, '2025-09-15'),
('B012', 'Shampoo', 'Perlengkapan Mandi', 12000.00, 15000.00, 15, '2025-10-20'),
('B013', 'Pasta Gigi', 'Perlengkapan Mandi', 8000.00, 10000.00, 20, '2025-11-10'),
('B014', 'Beras 5kg', 'Sembako', 55000.00, 60000.00, 10, '2025-06-30'),
('B015', 'Telur 1kg', 'Sembako', 22000.00, 25000.00, 8, '2025-05-05'),
('B020', 'Obat Nyamuk', 'Kesehatan', 8000.00, 10000.00, 10, '2026-03-31'),
('B021', 'Teh Celup', 'Minuman', 12000.00, 15000.00, 20, '2026-06-30'),
('B023', 'Wafer Coklat', 'Makanan Ringan', 6000.00, 9000.00, 18, '2025-11-30'),
('B024', 'Biskuit Gandum', 'Makanan Ringan', 7000.00, 10000.00, 10, '2025-10-15'),
('B025', 'Ketumbar', 'Bumbu Dapur', 8000.00, 10000.00, 10, '2026-06-30'),
('B031', 'Susu Kale', 'Minuman', 8000.00, 11000.00, 25, '2025-08-15'),
('B080', 'Jagung', 'Sayuran', 398374.00, 283784.00, 1233, '2025-05-15');

-- --------------------------------------------------------

--
-- Table structure for table `detail_pembelian`
--

CREATE TABLE `detail_pembelian` (
  `id_detail_pembelian` varchar(10) NOT NULL,
  `id_pembelian` varchar(10) DEFAULT NULL,
  `id_barang` varchar(10) DEFAULT NULL,
  `harga_satuan` decimal(15,2) NOT NULL,
  `jumlah` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `detail_pembelian`
--

INSERT INTO `detail_pembelian` (`id_detail_pembelian`, `id_pembelian`, `id_barang`, `harga_satuan`, `jumlah`) VALUES
('DP014', 'PB011', 'B011', 5000.00, 30),
('DP015', 'PB011', 'B012', 12000.00, 15),
('DP018', 'PB013', 'B015', 22000.00, 8),
('DP023', 'PB015', 'B020', 8000.00, 10),
('DP028', 'PB018', 'B025', 8000.00, 10);

-- --------------------------------------------------------

--
-- Table structure for table `detail_transaksi`
--

CREATE TABLE `detail_transaksi` (
  `id_trx` varchar(10) NOT NULL,
  `id_transaksi` varchar(10) DEFAULT NULL,
  `id_barang` varchar(10) DEFAULT NULL,
  `jumlah` int(11) NOT NULL,
  `sub_total` decimal(15,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `detail_transaksi`
--

INSERT INTO `detail_transaksi` (`id_trx`, `id_transaksi`, `id_barang`, `jumlah`, `sub_total`) VALUES
('DT008', 'T008', 'B009', 1, 7000.00),
('DT011', 'T011', 'B014', 1, 60000.00),
('DT016', 'T016', 'B020', 2, 20000.00),
('DT017', 'T017', 'B021', 1, 15000.00),
('DT021', 'T021', 'B025', 1, 10000.00),
('DT030', 'T011', 'B011', 12345, 14000.00);

-- --------------------------------------------------------

--
-- Table structure for table `laporan_keuangan`
--

CREATE TABLE `laporan_keuangan` (
  `id_laporan` varchar(10) NOT NULL,
  `periode` varchar(20) NOT NULL,
  `total_pemasukan` decimal(15,2) NOT NULL,
  `total_pengeluaran` decimal(15,2) NOT NULL,
  `keuntungan` decimal(15,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `laporan_keuangan`
--

INSERT INTO `laporan_keuangan` (`id_laporan`, `periode`, `total_pemasukan`, `total_pengeluaran`, `keuntungan`) VALUES
('L001', '2024-12', 4250000.00, 1510000.00, 2740000.00),
('L002', '2025-01', 5120000.00, 1850000.00, 3270000.00),
('L003', '2025-06', 4980000.00, 1720000.00, 3260000.00);

-- --------------------------------------------------------

--
-- Table structure for table `pelanggan`
--

CREATE TABLE `pelanggan` (
  `id_pelanggan` varchar(10) NOT NULL,
  `nama_pelanggan` varchar(100) NOT NULL,
  `riwayat_pembelian` varchar(10) DEFAULT NULL,
  `no_telepon` varchar(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pelanggan`
--

INSERT INTO `pelanggan` (`id_pelanggan`, `nama_pelanggan`, `riwayat_pembelian`, `no_telepon`) VALUES
('P004', 'Arini', 'T004', '081587572743'),
('P005', 'Diki', 'T005', '083476568321'),
('P008', 'Nahda', 'T008', '081154643224'),
('P009', 'Dinda', 'T009', '088132230881'),
('P010', 'Fatur', 'T010', '081157975754'),
('P011', 'Rina', 'T011', '0812345678'),
('P012', 'Budi', 'T012', '0823456789'),
('P014', 'Agus', 'T014', '0845678901'),
('P015', 'Dewi', 'T015', '0856789012'),
('P016', 'Eko', 'T016', '0867890123'),
('P017', 'Fani', 'T017', '0878901234'),
('P018', 'Gita', 'T018', '0889012345'),
('P019', 'Hadi', 'T019', '0890123456'),
('P020', 'Ina', 'T020', '0801234567'),
('P021', 'Jeje', 'T021', '081112223344'),
('P022', 'Kinan', 'T022', '082223334455'),
('P023', 'Lina', 'T023', '083334445566'),
('P024', 'Mufli', 'T024', '084445556677'),
('P025', 'Nia', 'T025', '085556667788'),
('P026', 'Oki', 'T026', '086667778899'),
('P027', 'Putri', 'T027', '087778889900'),
('P028', 'Rudi', 'T019', '088889990011'),
('P029', 'Sari', 'T020', '089990001122'),
('P060', 'Sari', 'T019', '2356476688');

-- --------------------------------------------------------

--
-- Table structure for table `pemasok`
--

CREATE TABLE `pemasok` (
  `id_pemasok` varchar(10) NOT NULL,
  `nama_pemasok` varchar(100) NOT NULL,
  `no_telepon` varchar(15) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `alamat` text DEFAULT NULL,
  `kode_pos` varchar(10) DEFAULT NULL,
  `kota` varchar(50) DEFAULT 'Makassar'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pemasok`
--

INSERT INTO `pemasok` (`id_pemasok`, `nama_pemasok`, `no_telepon`, `email`, `alamat`, `kode_pos`, `kota`) VALUES
('S001', 'PT Sumber Berkah', '083654321871', 'sumberberkah@mail.com', 'Jl. Mappala No. 10', '90222', 'Makassar'),
('S002', 'CV Maju Jaya', '085281654321', 'majujaya@mail.com', 'Jl. Andi Tonro No. 15', '90125', 'Makassar'),
('S003', 'UD Sejahtera', '080356123456', 'udsejahtera@mail.com', 'Jl. Landak Baru No. 7', '90114', 'Makassar'),
('S004', 'CV Bumi Nusantara', '087215671234', 'buminusantara@mail.com', 'Jl. Bungaya No. 5', '90223', 'Makassar'),
('S031', 'CV Makmur Abad', '081234567890', 'makmurabad@gmail.com', 'Jl. Rappocini Raya No.12', '9888', 'BANDUNG');

-- --------------------------------------------------------

--
-- Table structure for table `pembelian_stok`
--

CREATE TABLE `pembelian_stok` (
  `id_pembelian` varchar(10) NOT NULL,
  `id_pemasok` varchar(10) DEFAULT NULL,
  `tanggal_pembelian` date NOT NULL,
  `total_biaya` decimal(15,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pembelian_stok`
--

INSERT INTO `pembelian_stok` (`id_pembelian`, `id_pemasok`, `tanggal_pembelian`, `total_biaya`) VALUES
('PB001', 'S001', '2025-01-12', 375000.00),
('PB002', 'S002', '2025-01-12', 260000.00),
('PB003', 'S003', '2025-01-13', 200000.00),
('PB004', 'S004', '2025-01-13', 60000.00),
('PB011', 'S003', '2025-01-18', 480000.00),
('PB013', 'S002', '2025-01-20', 210000.00),
('PB015', 'S004', '2025-01-22', 275000.00),
('PB018', 'S001', '2025-01-24', 310000.00),
('PB101', 'S002', '2025-06-12', 111111.00);

-- --------------------------------------------------------

--
-- Table structure for table `transaksi`
--

CREATE TABLE `transaksi` (
  `id_transaksi` varchar(10) NOT NULL,
  `id_pelanggan` varchar(10) DEFAULT NULL,
  `tanggal_transaksi` date NOT NULL,
  `total_harga` decimal(15,2) NOT NULL,
  `metode_pembayaran` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `transaksi`
--

INSERT INTO `transaksi` (`id_transaksi`, `id_pelanggan`, `tanggal_transaksi`, `total_harga`, `metode_pembayaran`) VALUES
('T004', 'P004', '2025-02-03', 16000.00, 'TUNAI'),
('T005', 'P005', '2025-02-04', 13000.00, 'TUNAI'),
('T008', 'P008', '2025-02-05', 7000.00, 'QRIS'),
('T009', 'P009', '2025-02-05', 22500.00, 'TUNAI'),
('T010', 'P010', '2025-02-06', 22000.00, 'QRIS'),
('T011', 'P011', '2025-02-06', 60000.00, 'QRIS'),
('T012', 'P012', '2025-02-06', 9000.00, 'TUNAI'),
('T014', 'P014', '2025-02-07', 6000.00, 'TUNAI'),
('T015', 'P015', '2025-02-07', 12000.00, 'QRIS'),
('T016', 'P016', '2025-02-07', 20000.00, 'TUNAI'),
('T017', 'P017', '2025-02-08', 15000.00, 'QRIS'),
('T018', 'P018', '2025-02-08', 15000.00, 'TUNAI'),
('T019', 'P019', '2025-02-08', 9000.00, 'TUNAI'),
('T020', 'P020', '2025-02-08', 20000.00, 'TUNAI'),
('T021', 'P021', '2025-02-09', 10000.00, 'QRIS'),
('T022', 'P022', '2025-02-09', 21000.00, 'TUNAI'),
('T023', 'P023', '2025-02-10', 12000.00, 'QRIS'),
('T024', 'P024', '2025-02-11', 14000.00, 'TUNAI'),
('T025', 'P025', '2025-02-12', 7000.00, 'TUNAI'),
('T026', 'P026', '2025-02-12', 18000.00, 'TUNAI'),
('T027', 'P027', '2025-02-13', 14000.00, 'QRIS'),
('T028', 'P028', '2025-02-13', 15000.00, 'TUNAI'),
('T029', 'P029', '2025-02-14', 10000.00, 'QRIS'),
('T100', 'P011', '2012-12-02', 23283273.00, 'QRIS');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`) VALUES
(1, 'admin', '482c811da5d5b4bc6d497ffa98491e38');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `barang`
--
ALTER TABLE `barang`
  ADD PRIMARY KEY (`id_barang`),
  ADD KEY `idx_tanggal_kadaluarsa` (`tanggal_kadaluarsa`);

--
-- Indexes for table `detail_pembelian`
--
ALTER TABLE `detail_pembelian`
  ADD PRIMARY KEY (`id_detail_pembelian`),
  ADD KEY `id_pembelian` (`id_pembelian`),
  ADD KEY `id_barang` (`id_barang`);

--
-- Indexes for table `detail_transaksi`
--
ALTER TABLE `detail_transaksi`
  ADD PRIMARY KEY (`id_trx`),
  ADD KEY `id_transaksi` (`id_transaksi`),
  ADD KEY `id_barang` (`id_barang`);

--
-- Indexes for table `laporan_keuangan`
--
ALTER TABLE `laporan_keuangan`
  ADD PRIMARY KEY (`id_laporan`);

--
-- Indexes for table `pelanggan`
--
ALTER TABLE `pelanggan`
  ADD PRIMARY KEY (`id_pelanggan`),
  ADD KEY `fk_riwayat` (`riwayat_pembelian`);

--
-- Indexes for table `pemasok`
--
ALTER TABLE `pemasok`
  ADD PRIMARY KEY (`id_pemasok`);

--
-- Indexes for table `pembelian_stok`
--
ALTER TABLE `pembelian_stok`
  ADD PRIMARY KEY (`id_pembelian`),
  ADD KEY `id_pemasok` (`id_pemasok`);

--
-- Indexes for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD PRIMARY KEY (`id_transaksi`),
  ADD KEY `id_pelanggan` (`id_pelanggan`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `detail_pembelian`
--
ALTER TABLE `detail_pembelian`
  ADD CONSTRAINT `fk_detail_pembelian_barang` FOREIGN KEY (`id_barang`) REFERENCES `barang` (`id_barang`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_detail_pembelian_pembelian` FOREIGN KEY (`id_pembelian`) REFERENCES `pembelian_stok` (`id_pembelian`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `detail_transaksi`
--
ALTER TABLE `detail_transaksi`
  ADD CONSTRAINT `fk_detail_transaksi_barang` FOREIGN KEY (`id_barang`) REFERENCES `barang` (`id_barang`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_detail_transaksi_transaksi` FOREIGN KEY (`id_transaksi`) REFERENCES `transaksi` (`id_transaksi`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `pelanggan`
--
ALTER TABLE `pelanggan`
  ADD CONSTRAINT `fk_riwayat` FOREIGN KEY (`riwayat_pembelian`) REFERENCES `transaksi` (`id_transaksi`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `pembelian_stok`
--
ALTER TABLE `pembelian_stok`
  ADD CONSTRAINT `fk_pembelian_pemasok` FOREIGN KEY (`id_pemasok`) REFERENCES `pemasok` (`id_pemasok`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD CONSTRAINT `fk_transaksi_pelanggan` FOREIGN KEY (`id_pelanggan`) REFERENCES `pelanggan` (`id_pelanggan`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
