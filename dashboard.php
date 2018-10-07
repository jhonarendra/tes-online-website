<?php
	session_start();
	if(isset($_SESSION['nama_mhs'])||isset($_SESSION['nama_dosen'])){
?>

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
				if(isset($_SESSION['nama_mhs'])){
					include 'include/sidebar_mhs.php';
				} else {
					include 'include/sidebar_dosen.php';
				}
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
					<div class="card mb-3">
						<div class="card-header">
							<i class="fas fa-table"></i>Tambah Soal
						</div>
						<div class="card-body">
							<div class="table-responsive">
								<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
									<thead>
										<tr>
											<th>No</th>
											<th>Jenis Soal</th>
											<th>Tanggal</th>
											<th>Jumlah Soal</th>
											<th>Soal & Jawaban</th>
											<th>Aksi</th>
										</tr>
									</thead>
									<tbody>
										<tr>
											<td>1</td>
											<td>Quis 1</td>
											<td>2018-11-11</td>
											<td>20</td>
											<td>
												<button class='btn btn-success' type="submit">
												<i class="far fa-folder-open"></i> Open
												</button>
											</td>
											<td>
												<div class="btn-group" role="group" aria-label="Basic example">
													<button type="button" class="btn btn-info">
														<i class="fas fa-edit"></i> Edit
													</button>
													<button type="button" class="btn btn-warning">
														<i class="far fa-trash-alt"></i>Delete
													</button>
												</div>                      
											</td>
										</tr>
									</tbody>
								</table>
							</div>
						</div>
						<div class="card-footer small text-muted">Updated yesterday at 11:59 PM</div>
					</div>

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
<?php
	} else {
		header("Location: index.php");
	}
?>