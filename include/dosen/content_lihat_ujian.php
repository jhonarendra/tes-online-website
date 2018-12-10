<?php
	$id_ujian = $sluguri;
	$data_ujian = mysqli_query($conn, "SELECT * FROM tb_ujian INNER JOIN tb_dosen ON tb_ujian.`id_dosen`=tb_dosen.`id_dosen` WHERE id_ujian = $id_ujian");
	foreach ($data_ujian as $ujian) {
		$nama_ujian = $ujian['nama_ujian'];
		$nama_dosen = $ujian['nama_dosen'];
	}
?>
<div class="card mb-3">
	<div class="card-header">
		<i class="fas fa-table"></i> <?php echo $nama_ujian." - ".$nama_dosen;?>
	</div>
	
	<div class="card-body">
		<a class="btn-success btn" href="tambah-soal">Tambah Soal</a><br /><br />
		<div class="table-responsive">
			<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
				<thead>
					<tr>
						<th>No</th>
						<th>Soal</th>
					</tr>
				</thead>
				<tbody>
					<?php
						$semua_soal = mysqli_query($conn, "SELECT * FROM tb_soal WHERE id_ujian = $id_ujian ORDER BY nomor_soal");
						foreach ($semua_soal as $soal) {
					?>
					<tr>
						<td><?php echo $soal['nomor_soal']?></td>
						<td><?php echo $soal['soal']?></td>
					</tr>
					<?php
						}
					?>
				</tbody>
			</table>
		</div>
	</div>
</div>