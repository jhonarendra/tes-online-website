<!DOCTYPE html>
<html lang="en">
	<head>
		<?php include 'include/head.php'
		?>
	</head>
	<body id="page-top">
		<?php include 'include/navbar.php' ?>
		<div id="wrapper">
			<!-- Sidebar -->

			<?php
				include 'include/mahasiswa/sidebar_mhs.php';
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
							if($_GET['page']=='nilai'){
								include 'include/mahasiswa/content_lihat_nilai.php';							
							}
							
						} else {
							if(isset($_GET['kerjakan'])){
								$nama_ujian = $_GET['kerjakan'];
								// if($_GET['kerjakan']==){
									include 'include/mahasiswa/content_kerjakan_soal.php';
								// }
							}else{
								include 'include/mahasiswa/content_dashboard.php';
							}
						}

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
		<script type="text/javascript">
			alert("Halo <?php if(isset($_SESSION['nama_mhs'])){echo $_SESSION['nama_mhs'];} else {echo $_SESSION['nama_dosen'];}?>");
		</script>

	</body>

</html>