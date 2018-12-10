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
<div class="card mb-3">
	<div class="card-header">
		<i class="fas fa-table"></i> Buat Ujian
	</div>
	<div class="card-body">
		<form id="form" action="" method="POST">
			Nama ujian:
			<input type="text" name="nama_ujian" class="form-control"><br />
			Selesai ujian:
			<input type="date" name="ujian_selesai" class="form-control"><br />
			<input type="submit" name="submit" value="Buat Ujian" class="btn btn-primary">
		</form>
	</div>
</div>