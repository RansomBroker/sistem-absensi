/*
 Navicat Premium Data Transfer

 Source Server         : lnpp-8-mysql
 Source Server Type    : MySQL
 Source Server Version : 50722
 Source Host           : 17.17.17.5:3306
 Source Schema         : db_absensi

 Target Server Type    : MySQL
 Target Server Version : 50722
 File Encoding         : 65001

 Date: 27/03/2023 07:20:26
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for jadwal_presensi
-- ----------------------------
DROP TABLE IF EXISTS `jadwal_presensi`;
CREATE TABLE `jadwal_presensi` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `nama` varchar(255) NOT NULL,
  `jam_masuk` time NOT NULL,
  `jam_keluar` time NOT NULL,
  `tgl_absen` date NOT NULL,
  `waktu_dispensasi` int(255) NOT NULL,
  KEY `id` (`id`),
  KEY `jam_masuk` (`jam_masuk`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of jadwal_presensi
-- ----------------------------
BEGIN;
COMMIT;

-- ----------------------------
-- Table structure for presensi_mahasiswa
-- ----------------------------
DROP TABLE IF EXISTS `presensi_mahasiswa`;
CREATE TABLE `presensi_mahasiswa` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `id_jadwal_presensi` bigint(20) NOT NULL,
  `id_mahasiswa` bigint(20) NOT NULL,
  `jam_presensi` time NOT NULL,
  `tgl_presensi` time NOT NULL,
  `waktu_telat` int(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  `img` varchar(255) NOT NULL,
  `geo_coordinate` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_mahasiswa_foreign` (`id_mahasiswa`),
  KEY `id_jadwal_presensi_foreign` (`id_jadwal_presensi`),
  CONSTRAINT `id_mahasiswa_foreign` FOREIGN KEY (`id_mahasiswa`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of presensi_mahasiswa
-- ----------------------------
BEGIN;
COMMIT;

-- ----------------------------
-- Table structure for users
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `nomor_induk` varchar(255) DEFAULT NULL COMMENT 'mahasiswa dan dosen',
  `nama` varchar(255) NOT NULL COMMENT 'mahasiswa dan dosen',
  `tgl_lahir` date DEFAULT NULL COMMENT 'mahasiswa dan dosen',
  `alamat` varchar(255) DEFAULT NULL COMMENT 'mahasiswa dan dosen',
  `role` smallint(3) NOT NULL,
  `img` varchar(255) DEFAULT NULL,
  `kelas` varchar(255) DEFAULT NULL COMMENT 'mahasiswa',
  `tempat_lahir` varchar(255) DEFAULT NULL COMMENT 'mahasiswa',
  `angkata` int(255) DEFAULT NULL COMMENT 'mahasiswa',
  `moto_hidup` varchar(255) DEFAULT NULL COMMENT 'mahasiswa',
  `kemampuan_pribadi` varchar(255) DEFAULT NULL COMMENT 'mahasiswa',
  `password` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of users
-- ----------------------------
BEGIN;
INSERT INTO `users` VALUES (1, NULL, 'admin', NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, '$2y$10$QHwST/QZ1JzlyqLY5dER6e/ZQCsMO24jmsjWpITodeHPekiEYA5ka', 'admin');
COMMIT;

SET FOREIGN_KEY_CHECKS = 1;
