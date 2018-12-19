<?php
	$id_ujian = $sluguri;
	$data_ujian = mysqli_query($conn, "SELECT * FROM tb_ujian INNER JOIN tb_dosen ON tb_ujian.`id_dosen`=tb_dosen.`id_dosen` WHERE id_ujian = $id_ujian");
	foreach ($data_ujian as $ujian) {
		$nama_ujian = $ujian['nama_ujian'];
		$nama_dosen = $ujian['nama_dosen'];
	}

	if (isset($_POST['editsoal'])) {
		$soal = $_POST['soal'];
		$nomor_soal = $_POST['nomor_soal'];
		$id_soal_edit = $_POST['id_soal_edit'];
		$update_soal = mysqli_query($conn, "UPDATE tb_soal SET soal='$soal', nomor_soal=$nomor_soal WHERE id_soal=$id_soal_edit");
	}
	if (isset($_POST['hapussoal'])) {
		$id_soal_hapus = $_POST['id_soal_hapus'];
		$update_soal = mysqli_query($conn, "UPDATE tb_soal SET STATUS='Dihapus' WHERE id_soal = $id_soal_hapus");
	}
?>

<div class="main">
	<!-- MAIN CONTENT -->
	<div class="main-content">
		<div class="container-fluid">
			<nav aria-label="breadcrumb" role="navigation">
			  <ol class="breadcrumb" style="background:#fff">
			    <li class="breadcrumb-item"><a href="<?php echo $web_url?>dosen">Dashboard</a></li>
			    <li class="breadcrumb-item active" aria-current="page"><?php echo $nama_ujian;?></li>
			  </ol>
			</nav>
			<h3 class="page-title"><?php echo $nama_ujian;?></h3>
			<a class="btn-success btn" href="<?php echo $web_url."dosen/"."$id_ujian"?>/tambah-soal">Tambah Soal</a><br /><br />
			<div class="panel">
				<div class="panel-body">
					<table class="table">
						<thead>
							<tr>
								<th>No</th>
								<th>Soal</th>
								<th>Soal</th>
							</tr>
						</thead>
						<tbody>
							<?php
								$semua_soal = mysqli_query($conn, "SELECT * FROM tb_soal WHERE id_ujian = $id_ujian AND status!='Dihapus' ORDER BY nomor_soal");
								foreach ($semua_soal as $soal) {
							?>
							<tr>
								<td><?php echo $soal['nomor_soal']?></td>
								<td><?php echo $soal['soal']?></td>
								<td>
									<a title="Edit Soal" href="#" data-toggle="modal" data-target="#editSoalModal<?php echo $soal['id_soal'] ?>" class="btn btn-success"><i class="fa fa-pencil"></i></a>
									<a title="Hapus Ujian" href="#" data-toggle="modal" data-target="#nilaiModal<?php echo $soal['id_soal'] ?>" class="btn btn-danger"><i class="fa fa-trash"></i></a>
								</td>
							</tr>
							<div class="modal fade" id="nilaiModal<?php echo $soal['id_soal'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
							  <div class="modal-dialog" role="document">
							    <div class="modal-content">
							      <div class="modal-header">
							        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
							          <span aria-hidden="true">×</span>
							        </button>
							        <h3 class="modal-title" id="exampleModalLabel">Yakin Hapus Soal Nomor <?php echo $soal['nomor_soal']?>?</h3>
							      </div>
							      <div class="modal-body">
							      	Jika soal dihapus tidak dapat dikembalikan lagi
							      </div>
							      <div class="modal-footer">
							      	<form action="" method="POST">
							      		<input type="hidden" name="id_soal_hapus" value="<?php echo $soal['id_soal']?>">
							      		<input type="submit" name="hapussoal" class="btn btn-success">
							      	</form>
							        <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
							      </div>
							    </div>
							  </div>
							</div>
							<div class="modal fade" id="editSoalModal<?php echo $soal['id_soal'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
							  <div class="modal-dialog" role="document">
							    <div class="modal-content">
							      <div class="modal-header">
							        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
							          <span aria-hidden="true">×</span>
							        </button>
							        <h3 class="modal-title" id="exampleModalLabel">Edit Soal Nomor <?php echo $soal['nomor_soal']?></h3>
							      </div>
							      <div class="modal-body">
							      	<form action="" method="POST">
							      		Nomor:
							      		<input class="form-control" type="text" name="nomor_soal" value="<?php echo $soal['nomor_soal']?>">
							      		Soal:
							      		<input class="form-control" type="text" name="soal" value="<?php echo $soal['soal']?>">
							      		<input type="hidden" name="id_soal_edit" value="<?php echo $soal['id_soal']?>">
							      		<input type="submit" name="editsoal" class="form-control btn btn-success">
							      	</form>
							      </div>
							      <div class="modal-footer">
							        <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
							      </div>
							    </div>
							  </div>
							</div>
							<?php
								}
							?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
	<!-- END MAIN CONTENT -->
</div>