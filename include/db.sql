/*
SQLyog Ultimate v11.11 (64 bit)
MySQL - 5.5.5-10.1.30-MariaDB : Database - db_tes_online
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
/*Table structure for table `tb_dosen` */

DROP TABLE IF EXISTS `tb_dosen`;

CREATE TABLE `tb_dosen` (
  `id_dosen` int(10) NOT NULL AUTO_INCREMENT,
  `nama_dosen` varchar(255) DEFAULT NULL,
  `username_dosen` varchar(255) DEFAULT NULL,
  `password_dosen` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id_dosen`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

/*Data for the table `tb_dosen` */

insert  into `tb_dosen`(`id_dosen`,`nama_dosen`,`username_dosen`,`password_dosen`) values (1,'pak suwija','suwija','suwija');

/*Table structure for table `tb_jawaban_mhs` */

DROP TABLE IF EXISTS `tb_jawaban_mhs`;

CREATE TABLE `tb_jawaban_mhs` (
  `id_jawaban_mhs` int(10) NOT NULL AUTO_INCREMENT,
  `id_soal` int(11) DEFAULT NULL,
  `id_mhs` int(11) DEFAULT NULL,
  `jawaban_mhs` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id_jawaban_mhs`),
  KEY `id_soal` (`id_soal`),
  KEY `id_mhs` (`id_mhs`),
  CONSTRAINT `tb_jawaban_mhs_ibfk_1` FOREIGN KEY (`id_soal`) REFERENCES `tb_soal` (`id_soal`),
  CONSTRAINT `tb_jawaban_mhs_ibfk_2` FOREIGN KEY (`id_mhs`) REFERENCES `tb_mhs` (`id_mhs`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

/*Data for the table `tb_jawaban_mhs` */

insert  into `tb_jawaban_mhs`(`id_jawaban_mhs`,`id_soal`,`id_mhs`,`jawaban_mhs`) values (1,1,1,'suatu sistem komputer untuk mengarsipkan dan menganalisis data historis suatu organisasi seperti data penjualan, gaji, danlain dari operasi harian'),(2,2,1,'hmmm apa ya'),(3,1,2,'gak tau nok'),(4,2,2,'iii jahat :(');

/*Table structure for table `tb_mhs` */

DROP TABLE IF EXISTS `tb_mhs`;

CREATE TABLE `tb_mhs` (
  `id_mhs` int(10) NOT NULL AUTO_INCREMENT,
  `nama_mhs` varchar(255) DEFAULT NULL,
  `username_mhs` varchar(255) DEFAULT NULL,
  `password_mhs` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id_mhs`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

/*Data for the table `tb_mhs` */

insert  into `tb_mhs`(`id_mhs`,`nama_mhs`,`username_mhs`,`password_mhs`) values (1,'jona','jona','jona'),(2,'deva','deva','deva');

/*Table structure for table `tb_nilai_mhs` */

DROP TABLE IF EXISTS `tb_nilai_mhs`;

CREATE TABLE `tb_nilai_mhs` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `id_ujian` int(10) DEFAULT NULL,
  `id_mhs` int(10) DEFAULT NULL,
  `nilai_mhs` float DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_mhs` (`id_mhs`),
  KEY `id_ujian` (`id_ujian`),
  CONSTRAINT `tb_nilai_mhs_ibfk_1` FOREIGN KEY (`id_mhs`) REFERENCES `tb_mhs` (`id_mhs`),
  CONSTRAINT `tb_nilai_mhs_ibfk_2` FOREIGN KEY (`id_ujian`) REFERENCES `tb_ujian` (`id_ujian`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

/*Data for the table `tb_nilai_mhs` */

insert  into `tb_nilai_mhs`(`id`,`id_ujian`,`id_mhs`,`nilai_mhs`) values (1,1,1,61),(2,1,2,11);

/*Table structure for table `tb_soal` */

DROP TABLE IF EXISTS `tb_soal`;

CREATE TABLE `tb_soal` (
  `id_soal` int(10) NOT NULL AUTO_INCREMENT,
  `nomor_soal` int(2) DEFAULT NULL,
  `id_ujian` int(11) DEFAULT NULL,
  `soal` varchar(255) DEFAULT NULL,
  `kunci_jawaban` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id_soal`),
  KEY `id_ujian` (`id_ujian`),
  CONSTRAINT `tb_soal_ibfk_1` FOREIGN KEY (`id_ujian`) REFERENCES `tb_ujian` (`id_ujian`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

/*Data for the table `tb_soal` */

insert  into `tb_soal`(`id_soal`,`nomor_soal`,`id_ujian`,`soal`,`kunci_jawaban`) values (1,2,1,'Apa yang kamu ketahui tentang data warehouse?','suatu sistem komputer untuk mengarsipkan dan menganalisis data historis suatu organisasi seperti data penjualan, gaji, dan informasi lain dari operasi harian'),(2,1,1,'Apa yang kamu ketahui tentang saya?','apa maksud anda menanyakan hal itu?'),(3,3,1,'oskoskdo','osdkosdko'),(4,4,1,'2923893282','2939238923'),(5,5,1,'okoskdos','osdkoskd'),(6,6,1,'soosdkosdkosd','sdkosdkosd'),(7,7,1,'92389839238','2938923823'),(8,8,1,'oskdoskd','oksodksd'),(9,9,1,'292389238','29389238923');

/*Table structure for table `tb_ujian` */

DROP TABLE IF EXISTS `tb_ujian`;

CREATE TABLE `tb_ujian` (
  `id_ujian` int(10) NOT NULL AUTO_INCREMENT,
  `nama_ujian` varchar(255) DEFAULT NULL,
  `tgl_buat_ujian` datetime DEFAULT NULL,
  `tgl_selesai_ujian` datetime DEFAULT NULL,
  `id_dosen` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_ujian`),
  KEY `id_dosen` (`id_dosen`),
  CONSTRAINT `tb_ujian_ibfk_1` FOREIGN KEY (`id_dosen`) REFERENCES `tb_dosen` (`id_dosen`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

/*Data for the table `tb_ujian` */

insert  into `tb_ujian`(`id_ujian`,`nama_ujian`,`tgl_buat_ujian`,`tgl_selesai_ujian`,`id_dosen`) values (1,'UAS STKI','2018-10-04 21:40:22','2018-10-05 21:40:26',1),(2,'','2018-10-19 05:02:17','2018-10-15 21:40:26',1),(3,'oskdoskd','2018-10-19 20:08:34','2018-10-19 00:00:00',1),(4,'jojoj','2018-10-19 20:08:58','2018-10-20 00:00:00',1);

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
