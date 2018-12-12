<?php
	$id_dosen = $_SESSION['id_dosen'];
	$id_ujian = $sluguri;
	$data_ujian = mysqli_query($conn, "SELECT * FROM tb_ujian WHERE id_ujian = $id_ujian");
	foreach ($data_ujian as $ujian) {
		$nama_ujian = $ujian['nama_ujian'];
	}
	
	if(isset($_POST['submit'])){
		$nama_ujian = $_POST['nama_ujian'];
		$status_ujian = $_POST['status_ujian'];
		$buat_ujian = mysqli_query($conn, "UPDATE tb_ujian SET nama_ujian = '$nama_ujian', status_ujian = '$status_ujian' WHERE id_ujian = $id_ujian");
		header('Location: ../../dosen');
	}
?>
<div class="main">
	<!-- MAIN CONTENT -->
	<div class="main-content">
		<div class="container-fluid">
			<nav aria-label="breadcrumb" role="navigation">
			  <ol class="breadcrumb" style="background:#fff">
			    <li class="breadcrumb-item"><a href="<?php echo $web_url?>dosen">Dashboard</a></li>
			    <li class="breadcrumb-item"><a href="<?php echo $web_url."dosen/".$id_ujian?>"><?php echo $nama_ujian;?></a></li>
			    <li class="breadcrumb-item active" aria-current="page">Edit Ujian</li>
			  </ol>
			</nav>
			<h3 class="page-title">Edit Ujian</h3>
			<div class="panel" style="padding-top: 20px">
				<div class="panel-body">
					<form id="form" action="" method="POST">
						<div class="row">
							<div class="col-md-6">
								<input type="text" name="nama_ujian" class="form-control" value="<?php echo $nama_ujian ?>">
							</div>
							<div class="col-md-6">
								<select name="status_ujian" class="form-control">
									<option value="Aktif">Aktif</option>
									<option value="Selesai">Selesai</option>
								</select>
							</div>
						</div><br />
						<input type="submit" name="submit" value="Edit Ujian" class="btn btn-primary">
					</form>
				</div>
			</div>
		</div>
	</div>
</div>