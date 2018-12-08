<?php
	$id_dosen = $_SESSION['id_dosen'];
	$id_ujian = $_GET['id_ujian'];
	$data_ujian = mysqli_query($conn, "SELECT * FROM tb_ujian WHERE id_ujian = $id_ujian");
	foreach ($data_ujian as $ujian) {
		$nama_ujian = $ujian['nama_ujian'];
	}
	
	if(isset($_POST['submit'])){
		$nama_ujian = $_POST['nama_ujian'];
		$buat_ujian = mysqli_query($conn, "UPDATE tb_ujian SET nama_ujian = '$nama_ujian' WHERE id_ujian = $id_ujian");
		header('Location: dosen?page=ujian');
	}
?>
<div class="card mb-3">
	<div class="card-header">
		<i class="fas fa-table"></i> Edit Ujian
	</div>
	<div class="card-body">
		<form id="form" action="" method="POST">
			Nama ujian:
			<input type="text" name="nama_ujian" class="form-control" value="<?php echo $nama_ujian ?>"><br />
			<input type="submit" name="submit" value="Buat Ujian" class="btn btn-primary">
		</form>
	</div>
</div>