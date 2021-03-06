<!doctype html>
<html lang="en" class="fullscreen-bg">

<head>
	<title>Dosen | Tes Online LSI </title>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
	<!-- VENDOR CSS -->
	<link rel="stylesheet" href="<?php echo $web_url.'template';?>/css/bootstrap.min.css">
	<link rel="stylesheet" href="<?php echo $web_url.'template';?>/vendor/font-awesome/css/font-awesome.min.css">
	<link rel="stylesheet" href="<?php echo $web_url.'template';?>/vendor/linearicons/style.css">
	<!-- MAIN CSS -->
	<link rel="stylesheet" href="<?php echo $web_url.'template';?>/css/main.css">
	<!-- FOR DEMO PURPOSES ONLY. You should remove this in your project -->
	<link rel="stylesheet" href="<?php echo $web_url.'template';?>/css/demo.css">

	<script src="<?php echo $web_url.'template'?>/vendor/jquery/jquery.min.js"></script>
		<script src="<?php echo $web_url.'template'?>/vendor/bootstrap/js/bootstrap.min.js"></script>
	<!-- GOOGLE FONTS -->
	<link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700" rel="stylesheet">
	<!-- ICONS -->
	<link rel="apple-touch-icon" sizes="76x76" href="<?php echo $web_url.'template';?>/img/icon.png">
	<link rel="icon" type="image/png" sizes="96x96" href="<?php echo $web_url.'template';?>/img/icon.png">
</head>
<body>
	<!-- WRAPPER -->
	<div id="wrapper">
		<!-- NAVBAR -->
		<?php include 'include/navbar.php'; ?>
		<!-- END NAVBAR -->
		<!-- LEFT SIDEBAR -->
		<?php include 'include/dosen/sidebar_dosen.php'?>
		<!-- END LEFT SIDEBAR -->
		<!-- MAIN -->
		<?php
			if (isset($sluguri)) { // http://localhost/dosen/{nama_ujian}
				if($sluguri=="buat-ujian"){ // http://localhost/dosen/buat-ujian
					include 'include/dosen/content_buat_ujian.php';
				} else { // http://localhost/dosen/{id_ujian}
					if (isset($sluguriaksi)) { // http://localhost/dosen/{id_ujian}/edit
						switch ($sluguriaksi) {
							case 'edit':
								include 'include/dosen/content_edit_ujian.php';
								break;
							case 'hapus':
								include 'include/dosen/content_hapus_ujian.php';
								break;
							case 'lihat-nilai': // http://localhost/dosen/{id_ujian}/lihat-nilai/{id_mhs}
								if (isset($slugurimhs)) {
									if(isset($slugurimhsaksi) && $slugurimhsaksi=="perhitungan" && isset($slug7)){
										include 'include/dosen/content_perhitungan.php';
									} else {
										include 'include/dosen/content_lihat_nilai_mhs.php';
									}
								} else {
									include 'include/dosen/content_nilai_mhs.php';
								}
								break;
							case 'tambah-soal':
								include 'include/dosen/content_tambah_soal.php';
								break;
							
							default:
								# code...
								break;
						}
					} else { // http://localhost/dosen/{nama_ujian}
						include 'include/dosen/content_lihat_ujian.php';
					}
				}
			} else { // http://localhost/dosen
				include 'include/dosen/content_dashboard.php';
			}
		?>

		
<!-- END MAIN -->
			<div class="clearfix"></div>
			<footer style="visibility: hidden;">
				<div class="container-fluid">
					<p class="copyright">&copy; 2017 <a href="https://www.themeineed.com" target="_blank">Theme I Need</a>. All Rights Reserved.</p>
				</div>
			</footer>
		</div>
		<!-- END WRAPPER -->
		<!-- Javascript -->
		<script src="<?php echo $web_url.'template'?>/vendor/jquery-slimscroll/jquery.slimscroll.min.js"></script>
		<script src="<?php echo $web_url.'template'?>/vendor/jquery.easy-pie-chart/jquery.easypiechart.min.js"></script>
		<script src="<?php echo $web_url.'template'?>/vendor/chartist/js/chartist.min.js"></script>
		<script src="<?php echo $web_url.'template'?>/scripts/klorofil-common.js"></script>
		
	</body>

	</html>
</html>