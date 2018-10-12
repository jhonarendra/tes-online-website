<?php
	session_start();
	include 'include/koneksi.php';
	$path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
	$segment = explode('/', $path);
	$slug = $segment[2];

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
	} else {
		include 'login.php';
	}
?>