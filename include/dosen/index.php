<!DOCTYPE html>
<html lang="en">
	<head>
		<?php include 'include/head.php';
		?>
	</head>
	<body id="page-top">
		<?php include 'include/navbar.php' ?>
		<div id="wrapper">
			<!-- Sidebar -->
			<?php
				include 'include/dosen/sidebar_dosen.php';
			?>

			<div id="content-wrapper">

				<div class="container-fluid">

				<!-- Breadcrumbs-->
					<ol class="breadcrumb">
						<li class="breadcrumb-item">
							<a href="#">Dashboard</a>
						</li>
						<li class="breadcrumb-item active">Overview</li>
					</ol>

					<!-- DataTables Example -->
					<?php
						if(isset($_GET['page'])){
							if($_GET['page']=='ujian'){
								if (isset($_GET['id_ujian'])) {
									if (isset($_GET['aksi'])) {
										if($_GET['aksi']=='tambah_soal'){
											include 'include/dosen/content_tambah_soal.php';
										}
									} else {
										include 'include/dosen/content_lihat_ujian.php';
									}
								} else if(isset($_GET['aksi'])){
									if($_GET['aksi']=='buat_ujian'){
										include 'include/dosen/content_buat_ujian.php';
									}
								} else {
									include 'include/dosen/content_ujian.php';	
								}

							} else if($_GET['page']=='nilai_mhs'){
								include 'include/dosen/content_nilai_mhs.php';
							}
						} else {
							include 'include/dosen/content_dashboard.php';
						}
						// if(isset($_GET['page'])){
						// 	if($_GET['page']=='soal'){
						// 		if(isset($_GET['aksi'])){
						// 			if($_GET['aksi']=='tambah') {
						// 				include 'include/dosen/content_tambah_soal.php';
						// 			}
						// 		} else {
						// 			include 'include/dosen/content_soal.php';
						// 		}								
						// 	} else if($_GET['page']=='nilai_mhs') {
						// 		if(isset($_GET['aksi'])){
						// 			if($_GET['aksi']=='lihat') {
						// 				include 'include/dosen/content_lihat_nilai_mhs.php';
						// 			}
						// 		} else {
						// 			include 'include/dosen/content_nilai_mhs.php';
						// 		}
						// 	} else if($_GET['page']=='ujian') {
						// 		if(isset($_GET['aksi'])){
						// 			// if($_GET['aksi']=='lihat') {
						// 			// 	include 'include/dosen/content_lihat_nilai_mhs.php';
						// 			// }
						// 		} else {
						// 			include 'include/dosen/content_ujian.php';
						// 		}
						// 	}
						// } else {
						// 	include 'include/dosen/content_dashboard.php';
						// }
					?>

				</div>
				<!-- /.container-fluid -->

				<!-- Sticky Footer -->
				<footer class="sticky-footer">
					<div class="container my-auto">
						<div class="copyright text-center my-auto">
							<span>Copyright © Your Website 2018</span>
						</div>
					</div>
				</footer>

			</div>
			<!-- /.content-wrapper -->
		</div>
		<!-- /#wrapper -->

		<!-- Scroll to Top Button-->
		<a class="scroll-to-top rounded" href="#page-top">
			<i class="fas fa-angle-up"></i>
		</a>

		<?php include 'include/footer.php'?>
		<!-- <script type="text/javascript">
			alert("Halo <?php if(isset($_SESSION['nama_mhs'])){echo $_SESSION['nama_mhs'];} else {echo $_SESSION['nama_dosen'];}?>");
		</script> -->

	</body>

</html>