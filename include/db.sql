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

insert  into `tb_dosen`(`id_dosen`,`nama_dosen`,`username_dosen`,`password_dosen`) values (1,'Prof. Putu Gede, S.T., M.T','putugede','putugede');

/*Table structure for table `tb_jawaban_mhs` */

DROP TABLE IF EXISTS `tb_jawaban_mhs`;

CREATE TABLE `tb_jawaban_mhs` (
  `id_jawaban_mhs` int(10) NOT NULL AUTO_INCREMENT,
  `id_soal` int(10) DEFAULT NULL,
  `id_mhs` int(10) DEFAULT NULL,
  `jawaban_mhs` text,
  `stem_jawaban_mhs` text,
  PRIMARY KEY (`id_jawaban_mhs`),
  KEY `id_soal` (`id_soal`),
  KEY `id_mhs` (`id_mhs`),
  CONSTRAINT `tb_jawaban_mhs_ibfk_1` FOREIGN KEY (`id_soal`) REFERENCES `tb_soal` (`id_soal`),
  CONSTRAINT `tb_jawaban_mhs_ibfk_2` FOREIGN KEY (`id_mhs`) REFERENCES `tb_mhs` (`id_mhs`)
) ENGINE=InnoDB AUTO_INCREMENT=105 DEFAULT CHARSET=latin1;

/*Data for the table `tb_jawaban_mhs` */

insert  into `tb_jawaban_mhs`(`id_jawaban_mhs`,`id_soal`,`id_mhs`,`jawaban_mhs`,`stem_jawaban_mhs`) values (12,13,1,'Metode dalam information retrieval yang berbasis vektor ada GVSM, LSI dan Neural Network. Saya akan menjelaskan metode LSI. LSI adalah metode IR berbasis vektor yang dapat mengukur similarity atau kemiripan dari suatu dokumen teks. Pertama, dibuatkan matriks A yang merupakan semua term dari semua data. Setelah itu dikalikan dengan matriks vektor A Transpos. Didapat sebuah matriks untuk dihitung eigenvalue dan eigenvector. Setelah didapat eigenvalue dan eigenvector, dijadikan matriks dan dinormalisasi menggunakan rumus. Terakhir, hasil perkalian matriks eigen dengan matriks A, dikali dengan matriks vector query sehingga didapat nilai similarity.',' metode information retrieval basis vektor gvsm ls neural network metode ls ls metode ir basis vektor ukur similarity mirip dokumen teks buat matriks term data kali matriks vektor transpos dapat matriks hitung eigenvalue eigenvector dapat eigenvalue eigenvector jadi matriks normalisasi rumus kalian matriks eigen matriks kali matriks vector query dapat nilai similarity'),(13,14,1,'Dalam evaluation IR, dikenal Precision dan Recall. Precision adalah persentase dokumen yang diretrieve dan relevan. Sedangkan Recall adalah persentase dokumen yang relevan dan diretrieve.',' evaluation ir kenal precision recall precision persentase dokumen retrieve relevan recall persentase dokumen relevan retrieve'),(14,13,2,'LSI adalah metode information retrieval berbasis vektor. LSI atau latent semantic indexing menggunakan persamaan eigen untuk mencari kemiripan antar dokumen. Nanti vector akan dikalikan dengan vector query untuk dibandingkan dengan dokumen lain.',' ls metode information retrieval basis vektor ls latent mantic indexing sama eigen mirip antar dokumen vector kali vector query banding dokumen'),(15,14,2,'Precision adalah dokumen yang diterima dan itu relevan, sedangkan recall berarti dokumen yang relevan dan itu diterima.',' precision dokumen terima relevan recall dokumen relevan terima'),(16,13,3,'Metode Neural Network\r\nNeural network atau jaringan syaraf tiruan merupakan metode yang mengambil konsep dari jaringan syaraf pada manusia',' metode neural network neural network jaring syaraf tiru metode konsep jaring syaraf manusia'),(17,14,3,'Precision itu dokumen yang diterima dan relevan sedangkan recall itu dokumen yang relevan dan diterima',' precision dokumen terima relevan recall dokumen relevan terima'),(18,13,4,'Metode dalam information retrieval yang berbasis vektor ada GVSM, LSI dan Neural Network. Saya akan menjelaskan metode LSI. LSI adalah metode IR berbasis vektor yang dapat mengukur similarity atau kemiripan dari suatu dokumen teks. Pertama, dibuatkan matriks A yang merupakan semua term dari semua data. Setelah itu dikalikan dengan matriks vektor A Transpos. Didapat sebuah matriks untuk dihitung eigenvalue dan eigenvector. Setelah didapat eigenvalue dan eigenvector, dijadikan matriks dan dinormalisasi menggunakan rumus. Terakhir, hasil perkalian matriks eigen dengan matriks A, dikali dengan matriks vector query sehingga didapat nilai similarity.',' metode information retrieval basis vektor gvsm ls neural network metode ls ls metode ir basis vektor ukur similarity mirip dokumen teks buat matriks term data kali matriks vektor transpos dapat matriks hitung eigenvalue eigenvector dapat eigenvalue eigenvector jadi matriks normalisasi rumus kalian matriks eigen matriks kali matriks vector query dapat nilai similarity'),(19,14,4,'Dalam evaluation IR, dikenal Precision dan Recall. Precision adalah persentase dokumen yang diretrieve dan relevan. Sedangkan Recall adalah persentase dokumen yang relevan dan diretrieve.',' evaluation ir kenal precision recall precision persentase dokumen retrieve relevan recall persentase dokumen relevan retrieve'),(90,21,1,'Stemming adalah cara untuk menghilangkan imbuhan dari kata',' stemming hilang imbuh'),(91,22,1,'Stopwords adalah cara untuk menghilangkan kata-kata yang tidak penting',' stopwords hilang'),(92,21,2,'metode mendapatkan kata dasar',' metode dasar'),(93,22,2,'metode menghilangkan kata yang tidak penting',' metode hilang'),(94,21,3,'Stemming adalah cara untuk menghilangkan imbuhan dari kata asli',' stemming hilang imbuh asli'),(95,22,3,'Stopwords adalah cara untuk menghilangkan kata-kata yang tidak penting dan tidak berguna',' stopwords hilang guna'),(96,16,4,'lallaa\r\n','lala alal\r\n'),(97,23,1,'Text pre-processing adalah metode untuk mendapatkan kata yang bersih dari suatu korpus dokumen untuk dilakukan pemrosesan pada dokumen seperti mencari similarity, peringkasan atau klasifikasi teks. Tahapan dalam text pre-processing yaitu: tokenisasi, adalah proses pemisahan dari dokumen menjadi kata. Banyak cara untuk mendapatkan kata dari dokumen, salah satu cara yang paling mudah yaitu memisahkannya berdasarkan spasi. Selanjutnya ada penghilangan stopword yang merupakan proses menghapus kata-kata yang tidak penting seperti kata dan, yang, di karena frekuensi kata tersebut kemungkinan lebih tinggi dari kata penting yang lain. Lalu ada proses stemming yang merupakan proses penghilangan imbuhan dari suatu kata. Banyak algoritma dalam stemming seperti contoh Porter.',' text pre processing tode rsih korpus dokumen roses dokumen similarity ingkas klasifikas teks tahap text pre processing tokenisas pisah dokumen dokumen mudah pisah spas lanjut hilang stopword hapus frekuens stemming hilang imbuh algoritma stemming contoh porter'),(98,24,1,'Stemming adalah penghapusan imbuhan dari suatu kata yang didapat. Stemming berguna untuk mendapatkan kata dasar sehingga dalam text processing akan memudahkan dalam mencari inti dokumen. Misalnya, terdapat kata membaca dan dibaca. Jika tidak di stemming, jumlah kata membaca adalah 1 sedangkan dibaca juga satu, Sementara setelah di stemming, akan terdapat 2 buah kata baca. Algoritma stemming yang saya ketahui adalah Porter. Pada Porter, konsep yang digunakan adalah rule base, tanpa kamus. Pertama, akan dihapus imbuhan kah, lah dan nya. Kedua, dihapus imbuhan ku, mu, nya. Ketiga, dihapus imbuhan meng, peny, pe, be, dan lainnya. Terakhir, dihapus akhiran seperti an, i, kan',' stemming hapus imbuh dapat stemming rguna dasar text processing udah int dokumen dapat baca baca stemming baca 1 baca stemming dapat 2 buah baca algoritma stemming tahu porter porter konsep rule base kamus hapus imbuh   nya hapus imbuh ku mu nya hapus imbuh  s pe  hapus akhir   '),(103,23,2,'Teks pre-processing merupakan cara untuk memperoleh kata. Kata yang dimaksud adalah kata yang bersih dari suatu korpus dokumen. Tahapan dalam text pre-processing yaitu: tokenisasi, adalah proses pemisahan dari dokumen menjadi kata. Banyak cara untuk mendapatkan kata dari dokumen, salah satu cara yang paling mudah yaitu memisahkannya berdasarkan spasi. Selanjutnya ada penghilangan stopword yang merupakan proses menghapus kata-kata yang tidak penting seperti kata dan, yang, di karena frekuensi kata tersebut kemungkinan lebih tinggi dari kata penting yang lain. Lalu ada proses stemming yang merupakan proses penghilangan imbuhan dari suatu kata. Banyak algoritma dalam stemming seperti contoh Porter.',' teks pre processing oleh maksud bersih korpus dokumen tahap text pre processing tokenisas pisah dokumen dokumen mudah pisah spasi lanjut hilang stopword hapus frekuensi stemming hilang imbuh algoritma stemming contoh porter'),(104,24,2,'Stemming adalah metode pencarian kata dasar dengan melakukan penghapusan imbuhan dari suatu kata yang didapat. Misalnya, terdapat kata membaca dan dibaca. Jika tidak di stemming, jumlah kata membaca adalah 1 sedangkan dibaca juga satu, Sementara setelah di stemming, akan terdapat 2 buah kata baca. Algoritma stemming yang saya ketahui adalah Porter. Pada Porter, konsep yang digunakan adalah rule base, tanpa kamus. Pertama, akan dihapus imbuhan kah, lah dan nya. Kedua, dihapus imbuhan ku, mu, nya. Ketiga, dihapus imbuhan meng, peny, pe, be, dan lainnya. Terakhir, dihapus akhiran seperti an, i, kan',' stemming metode cari dasar hapus imbuh dapat dapat baca baca stemming baca 1 baca stemming dapat 2 buah baca algoritma stemming tahu porter porter konsep rule base kamus hapus imbuh kah lah nya hapus imbuh ku mu nya hapus imbuh  s pe  hapus akhir  i kan');

/*Table structure for table `tb_mhs` */

DROP TABLE IF EXISTS `tb_mhs`;

CREATE TABLE `tb_mhs` (
  `id_mhs` int(10) NOT NULL AUTO_INCREMENT,
  `nama_mhs` varchar(255) DEFAULT NULL,
  `username_mhs` varchar(255) DEFAULT NULL,
  `password_mhs` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id_mhs`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

/*Data for the table `tb_mhs` */

insert  into `tb_mhs`(`id_mhs`,`nama_mhs`,`username_mhs`,`password_mhs`) values (1,'Putu Jhonarendra','jhonarendra','jonajona'),(2,'Deva Jayantha','devajayantha','devadeva'),(3,'Veggy Priyanka','veggy','veggy'),(4,'Edy Maulana Vikri','edymv','edymv'),(5,'Dewa Gede','dewagede','dewagede'),(6,'Johnson','johnson','johnson'),(7,'Reza Putra','rezaputra','rezaputra'),(8,'Komang','komang','komang'),(9,'Putra','putra','putra'),(10,'Made Dwi','madedwi','madedwi'),(11,'Gede Eka','gedeeka','gedeeka');

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
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=latin1;

/*Data for the table `tb_nilai_mhs` */

insert  into `tb_nilai_mhs`(`id`,`id_ujian`,`id_mhs`,`nilai_mhs`) values (4,1,1,90),(5,1,2,90),(6,1,3,90),(7,1,4,0),(24,10,1,0),(25,10,2,0),(26,10,3,0),(27,12,1,0),(30,12,2,0);

/*Table structure for table `tb_soal` */

DROP TABLE IF EXISTS `tb_soal`;

CREATE TABLE `tb_soal` (
  `id_soal` int(10) NOT NULL AUTO_INCREMENT,
  `nomor_soal` int(2) DEFAULT NULL,
  `id_ujian` int(11) DEFAULT NULL,
  `soal` varchar(255) DEFAULT NULL,
  `status` enum('Aktif','Dihapus') DEFAULT NULL,
  PRIMARY KEY (`id_soal`),
  KEY `id_ujian` (`id_ujian`),
  CONSTRAINT `tb_soal_ibfk_1` FOREIGN KEY (`id_ujian`) REFERENCES `tb_ujian` (`id_ujian`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=latin1;

/*Data for the table `tb_soal` */

insert  into `tb_soal`(`id_soal`,`nomor_soal`,`id_ujian`,`soal`,`status`) values (13,1,1,'Jelaskan salah satu metode dalam Information Retrieval yang berbasis Vector!','Aktif'),(14,2,1,'Jelaskan perbedaan Precision dan Recall pada Evaluation IR!','Aktif'),(16,4,1,'Mengapa saya disini?','Dihapus'),(21,1,10,'Apa itu stemming?','Aktif'),(22,2,10,'Apa itu Stopwords?','Aktif'),(23,1,12,'Jelaskan yang anda ketahui tentang text pre-processing dan jelaskan tahap-tahapnya!','Aktif'),(24,2,12,'Jelaskan apa itu stemming dan sertakan algoritmanya!','Aktif');

/*Table structure for table `tb_ujian` */

DROP TABLE IF EXISTS `tb_ujian`;

CREATE TABLE `tb_ujian` (
  `id_ujian` int(10) NOT NULL AUTO_INCREMENT,
  `nama_ujian` varchar(255) DEFAULT NULL,
  `tgl_buat_ujian` datetime DEFAULT NULL,
  `tgl_selesai_ujian` datetime DEFAULT NULL,
  `id_dosen` int(11) DEFAULT NULL,
  `status_ujian` enum('Aktif','Selesai','Dihapus') DEFAULT NULL,
  PRIMARY KEY (`id_ujian`),
  KEY `id_dosen` (`id_dosen`),
  CONSTRAINT `tb_ujian_ibfk_1` FOREIGN KEY (`id_dosen`) REFERENCES `tb_dosen` (`id_dosen`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

/*Data for the table `tb_ujian` */

insert  into `tb_ujian`(`id_ujian`,`nama_ujian`,`tgl_buat_ujian`,`tgl_selesai_ujian`,`id_dosen`,`status_ujian`) values (1,'UAS STKI Lanjutan','2018-10-04 21:40:22','2018-10-05 21:40:26',1,'Aktif'),(9,'UTS STKI','2018-09-04 21:40:22','2018-09-04 21:40:22',1,'Dihapus'),(10,'Remidi STKI','2018-12-10 20:34:59','2018-12-11 00:00:00',1,'Selesai'),(11,'tes','2018-12-11 00:00:00','2018-12-11 00:00:00',1,'Dihapus'),(12,'Kuis STKI','2018-12-17 07:17:11','2018-12-17 00:00:00',1,'Aktif');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
