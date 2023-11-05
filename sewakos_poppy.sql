-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               10.4.16-MariaDB - mariadb.org binary distribution
-- Server OS:                    Win64
-- HeidiSQL Version:             12.1.0.6537
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Dumping database structure for sewakos_poppy
CREATE DATABASE IF NOT EXISTS `sewakos_poppy` /*!40100 DEFAULT CHARACTER SET utf8mb4 */;
USE `sewakos_poppy`;

-- Dumping structure for function sewakos_poppy.CalculateTotalRentalsForMonth
DELIMITER //
CREATE FUNCTION `CalculateTotalRentalsForMonth`(month_number INT) RETURNS int(11)
BEGIN
    DECLARE total_rentals INT;

    SET total_rentals = (
        SELECT COUNT(*) 
        FROM sewa_kamar 
        WHERE MONTH(tanggal_awal) = month_number
    );

    RETURN total_rentals;
END//
DELIMITER ;

-- Dumping structure for procedure sewakos_poppy.GetAnggrekRoomCustomers
DELIMITER //
CREATE PROCEDURE `GetAnggrekRoomCustomers`()
BEGIN
 SELECT penyewa.nama_penyewa, sewa_kamar.no_kamar, jenis_kamar.nama_jenis AS tipe_kamar, sewa_kamar.tanggal_awal, sewa_kamar.tanggal_akhir, sewa_kamar.status_sewa
 FROM sewa_kamar
 JOIN penyewa ON penyewa.id_penyewa = sewa_kamar.id_penyewa
 JOIN kamar ON kamar.no_kamar = sewa_kamar.no_kamar
 JOIN jenis_kamar ON kamar.id_jeniskamar = jenis_kamar.id_jeniskamar
    WHERE jenis_kamar.nama_jenis = 'anggrek';
END//
DELIMITER ;

-- Dumping structure for table sewakos_poppy.jenis_kamar
CREATE TABLE IF NOT EXISTS `jenis_kamar` (
  `id_jeniskamar` int(11) NOT NULL,
  `nama_jenis` varchar(50) DEFAULT NULL,
  `fasilitas` longtext DEFAULT NULL,
  PRIMARY KEY (`id_jeniskamar`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Dumping data for table sewakos_poppy.jenis_kamar: ~3 rows (approximately)
INSERT INTO `jenis_kamar` (`id_jeniskamar`, `nama_jenis`, `fasilitas`) VALUES
	(1, 'mawar', 'KIPAS, KM DALAM, LEMARI, KASUR'),
	(2, 'melati', 'NON KIPAS, KM LUAR, KOSONGAN'),
	(3, 'anggrek', 'AC, KM DALAM, LEMARI, KASUR, DAPUR');

-- Dumping structure for table sewakos_poppy.kamar
CREATE TABLE IF NOT EXISTS `kamar` (
  `no_kamar` int(11) NOT NULL,
  `lantai_kamar` int(11) DEFAULT NULL,
  `id_jeniskamar` int(11) DEFAULT NULL,
  `status_kamar` enum('Y','N') DEFAULT NULL,
  PRIMARY KEY (`no_kamar`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Dumping data for table sewakos_poppy.kamar: ~10 rows (approximately)
INSERT INTO `kamar` (`no_kamar`, `lantai_kamar`, `id_jeniskamar`, `status_kamar`) VALUES
	(1, 1, 1, 'Y'),
	(2, 1, 1, 'Y'),
	(3, 1, 1, 'Y'),
	(4, 2, 2, 'N'),
	(5, 2, 2, 'Y'),
	(6, 2, 2, 'Y'),
	(7, 2, 2, 'N'),
	(8, 3, 3, 'Y'),
	(9, 3, 3, 'N'),
	(10, 3, 3, 'Y');

-- Dumping structure for table sewakos_poppy.level
CREATE TABLE IF NOT EXISTS `level` (
  `id_level` int(11) NOT NULL,
  `nama_level` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id_level`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Dumping data for table sewakos_poppy.level: ~2 rows (approximately)
INSERT INTO `level` (`id_level`, `nama_level`) VALUES
	(1, 'administrator'),
	(2, 'penyewa');

-- Dumping structure for table sewakos_poppy.penyewa
CREATE TABLE IF NOT EXISTS `penyewa` (
  `id_penyewa` int(11) NOT NULL,
  `nama_penyewa` varchar(50) DEFAULT NULL,
  `no_identitas` varchar(20) DEFAULT NULL,
  `alamat_rumah` longtext DEFAULT NULL,
  `no_telepon` varchar(13) DEFAULT NULL,
  `no_kontak_darurat` varchar(13) DEFAULT NULL,
  `id_user` int(11) DEFAULT NULL,
  `status_penyewa` enum('Y','N') DEFAULT NULL,
  PRIMARY KEY (`id_penyewa`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Dumping data for table sewakos_poppy.penyewa: ~7 rows (approximately)
INSERT INTO `penyewa` (`id_penyewa`, `nama_penyewa`, `no_identitas`, `alamat_rumah`, `no_telepon`, `no_kontak_darurat`, `id_user`, `status_penyewa`) VALUES
	(1, 'wida ningsih', '3178909584738343', 'Majalengka', '089504050607', '089504050608', 2, 'Y'),
	(2, 'tika millasari', '3283434384343843', 'Bandung', '089504050609', '089504050610', 3, 'Y'),
	(3, 'debby varera', '3167556565656565', 'Palembang', '089504050611', '089504050612', 4, 'Y'),
	(4, 'riki', '3176407343434343', 'Bandung', '089504050613', '089504050614', 5, 'Y'),
	(5, 'ahmat aris', '3176407343434643', 'Bekasi', '089504050615', '089504050616', 6, 'Y'),
	(6, 'muhammad_arief', '3176407343434545', 'Bandung', '089504050617', '089504050618', 7, 'Y'),
	(7, 'endis', '317640734343476', 'Majalengka', '089504050620', '089504050621', 8, 'Y');

-- Dumping structure for table sewakos_poppy.riwayat_pembayaran
CREATE TABLE IF NOT EXISTS `riwayat_pembayaran` (
  `id_pembayaran` int(11) NOT NULL,
  `tanggal_pembayaran` date DEFAULT NULL,
  `jumlah_pembayaran` int(11) DEFAULT NULL,
  `periode_bulan` int(11) DEFAULT NULL,
  `id_penyewa` int(11) DEFAULT NULL,
  `id_sewa` int(11) DEFAULT NULL,
  `id_tagihan` int(11) DEFAULT NULL,
  `status_pembayaran` enum('Y','N') DEFAULT NULL,
  PRIMARY KEY (`id_pembayaran`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Dumping data for table sewakos_poppy.riwayat_pembayaran: ~0 rows (approximately)

-- Dumping structure for table sewakos_poppy.sewa_kamar
CREATE TABLE IF NOT EXISTS `sewa_kamar` (
  `id_sewa` int(11) NOT NULL,
  `tanggal_awal` date DEFAULT NULL,
  `tanggal_akhir` date DEFAULT NULL,
  `no_kamar` int(11) DEFAULT NULL,
  `id_penyewa` int(11) DEFAULT NULL,
  `status_sewa` enum('Y','N') DEFAULT NULL,
  PRIMARY KEY (`id_sewa`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Dumping data for table sewakos_poppy.sewa_kamar: ~3 rows (approximately)
INSERT INTO `sewa_kamar` (`id_sewa`, `tanggal_awal`, `tanggal_akhir`, `no_kamar`, `id_penyewa`, `status_sewa`) VALUES
	(1, '2023-07-30', '2023-12-31', 5, 1, 'Y'),
	(2, '2023-10-01', '2023-12-31', 2, 4, 'Y'),
	(3, '2023-10-01', '2023-10-30', 6, 2, 'Y');

-- Dumping structure for table sewakos_poppy.tagihan
CREATE TABLE IF NOT EXISTS `tagihan` (
  `id_tagihan` int(11) NOT NULL AUTO_INCREMENT,
  `id_sewa` int(11) DEFAULT NULL,
  `id_penyewa` int(11) DEFAULT NULL,
  `periode_bulan` int(2) DEFAULT NULL,
  `tagihan` int(11) DEFAULT NULL,
  `status_tagihan` enum('Y','N') DEFAULT NULL,
  PRIMARY KEY (`id_tagihan`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8mb4;

-- Dumping data for table sewakos_poppy.tagihan: ~10 rows (approximately)
INSERT INTO `tagihan` (`id_tagihan`, `id_sewa`, `id_penyewa`, `periode_bulan`, `tagihan`, `status_tagihan`) VALUES
	(12, 1, 1, 7, 700000, 'N'),
	(13, 1, 1, 8, 700000, 'N'),
	(14, 1, 1, 9, 700000, 'N'),
	(15, 1, 1, 10, 700000, 'N'),
	(16, 1, 1, 11, 700000, 'N'),
	(17, 1, 1, 12, 700000, 'N'),
	(18, 2, 4, 10, 1000000, 'N'),
	(19, 2, 4, 11, 1000000, 'N'),
	(20, 2, 4, 12, 1000000, 'N'),
	(21, 3, 2, 10, 750000, 'N');

-- Dumping structure for table sewakos_poppy.tarif_kamar
CREATE TABLE IF NOT EXISTS `tarif_kamar` (
  `id_tarif` int(11) NOT NULL,
  `tarif` int(11) DEFAULT NULL,
  `no_kamar` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_tarif`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Dumping data for table sewakos_poppy.tarif_kamar: ~10 rows (approximately)
INSERT INTO `tarif_kamar` (`id_tarif`, `tarif`, `no_kamar`) VALUES
	(1, 1000000, 1),
	(2, 1000000, 2),
	(3, 1000000, 3),
	(4, 600000, 4),
	(5, 700000, 5),
	(6, 750000, 6),
	(7, 700000, 7),
	(8, 1000000, 8),
	(9, 1050000, 9),
	(10, 2000000, 10);

-- Dumping structure for table sewakos_poppy.user
CREATE TABLE IF NOT EXISTS `user` (
  `id_user` int(11) NOT NULL,
  `username` varchar(50) DEFAULT NULL,
  `password` longtext DEFAULT NULL,
  `id_level` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_user`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Dumping data for table sewakos_poppy.user: ~8 rows (approximately)
INSERT INTO `user` (`id_user`, `username`, `password`, `id_level`) VALUES
	(1, 'admin_poppy', '123', 1),
	(2, 'wida_ningsih', '456', 2),
	(3, 'tika_millasari', '789', 2),
	(4, 'debby_varera', '101112', 2),
	(5, 'riki', '131415', 2),
	(6, 'aris_ahmat', '161718', 2),
	(7, 'muhammad_arief', '192021', 2),
	(8, 'endis', '222324', 2);

-- Dumping structure for view sewakos_poppy.view_sewa_penyewa
-- Creating temporary table to overcome VIEW dependency errors
CREATE TABLE `view_sewa_penyewa` (
	`nama_penyewa` VARCHAR(50) NULL COLLATE 'utf8mb4_general_ci',
	`no_kamar` INT(11) NULL,
	`tanggal_awal` DATE NULL,
	`tanggal_akhir` DATE NULL,
	`status_sewa` ENUM('Y','N') NULL COLLATE 'utf8mb4_general_ci'
) ENGINE=MyISAM;

-- Dumping structure for view sewakos_poppy.view_sewa_penyewa
-- Removing temporary table and create final VIEW structure
DROP TABLE IF EXISTS `view_sewa_penyewa`;
CREATE ALGORITHM=UNDEFINED SQL SECURITY DEFINER VIEW `view_sewa_penyewa` AS SELECT penyewa.nama_penyewa, sewa_kamar.no_kamar, sewa_kamar.tanggal_awal,
sewa_kamar.tanggal_akhir, sewa_kamar.status_sewa
FROM sewa_kamar
JOIN penyewa ON penyewa.id_penyewa = sewa_kamar.id_penyewa ;

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
