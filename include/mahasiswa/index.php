<!doctype html>
<html lang="en" class="fullscreen-bg">

<head>
	<title>Mahasiswa | Tes Online LSI</title>
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
	
	<script src="<?php echo $web_url.'template'?>/vendor/jquery/jquery.min.js"></script>
	<link rel="stylesheet" href="<?php echo $web_url.'template';?>/css/demo.css">
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
			<?php include 'include/mahasiswa/sidebar_mhs.php'?>
			<!-- END LEFT SIDEBAR -->
			<!-- MAIN -->
			<?php
				if(isset($sluguri)){
					if ($sluguri=="kerjakan") {
						include 'include/mahasiswa/content_kerjakan_soal.php';
					}
				} else {
					include 'include/mahasiswa/content_dashboard.php';
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
		<script src="<?php echo $web_url.'template'?>/vendor/bootstrap/js/bootstrap.min.js"></script>
		<script src="<?php echo $web_url.'template'?>/vendor/jquery-slimscroll/jquery.slimscroll.min.js"></script>
		<script src="<?php echo $web_url.'template'?>/vendor/jquery.easy-pie-chart/jquery.easypiechart.min.js"></script>
		<script src="<?php echo $web_url.'template'?>/vendor/chartist/js/chartist.min.js"></script>
		<script src="<?php echo $web_url.'template'?>/scripts/klorofil-common.js"></script>
		
	</body>

	</html>