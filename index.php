<?php
	session_start();
	include 'include/koneksi.php';
	$path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

	$web_url = 'http://jhonarendra/LatentSematicIndex-TesOnline/';
	$segment = explode('/', $path);
	$slug = $segment[2];
	if (isset($segment[3])) {
		$sluguri = $segment[3];
	}
	if (isset($segment[4])){
		$sluguriaksi = $segment[4];
	}
	if (isset($segment[5])) {
		$slugurimhs = $segment[5];
	}
	if (isset($segment[6])) {
		$slugurimhsaksi = $segment[6];
	}

	if($slug=='mahasiswa'){
		if(isset($_SESSION['nama_mhs'])){
			include 'include/mahasiswa/index.php';
		} else {
			echo "Anda tidak memiliki akses ke halaman ini!";
		}
	} else if($slug=='dosen'){
		if(isset($_SESSION['nama_dosen'])){
			include 'include/dosen/index.php';
		} else {
			echo "Anda tidak memiliki akses ke halaman ini!";
		}
	} else if(empty($slug)||$slug=='home') {
		include 'login.php';
	} else {
		echo "404 Not Found";
	}
?>