<?php
	$id_dosen = $_SESSION['id_dosen'];
	if(isset($_POST['submit'])){
		date_default_timezone_set("Asia/Manila");
		$datetime = date("Y-m-d H:i:s");
		$nama_ujian = $_POST['nama_ujian'];
		$ujian_selesai = $_POST['ujian_selesai'];

		$buat_ujian = mysqli_query($conn, "INSERT INTO tb_ujian VALUES(NULL, '$nama_ujian', '$datetime', '$ujian_selesai', $id_dosen, 'Aktif')");
		header('Location: ../dosen');
	}
?>
<div class="main">
	<!-- MAIN CONTENT -->
	<div class="main-content">
		<div class="container-fluid">
			<h3 class="page-title">Daftar Ujian</h3>
			<div class="panel">
				<div class="panel-body">
					<form id="form" action="" method="POST">
						<div class="row">
							<div class="col-md-6">
								Nama ujian:
								<input type="text" name="nama_ujian" class="form-control"><br />
							</div>
							<div class="col-md-6">
								Selesai ujian:
								<input type="date" name="ujian_selesai" class="form-control"><br />
							</div>
						</div>
						
						
						<input type="submit" name="submit" value="Buat Ujian" class="btn btn-primary">
					</form>
				</div>
			</div>
		</div>
	</div>
</div>