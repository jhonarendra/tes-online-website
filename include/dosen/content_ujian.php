<div class="card mb-3">
	<div class="card-header">
		<i class="fas fa-table"></i> Ujian
	</div>
	<div class="card-body">
		<a class="btn-success btn" href="?page=ujian&aksi=buat_ujian">Buat Ujian</a><br /><br />
		<div class="table-responsive">
			<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
				<thead>
					<tr>
						<th>ID</th>
						<th>Nama Ujian</th>
						<th>Dosen</th>
						<th>Tanggal Ujian</th>
						<th>Tanggal Selesai</th>
						<th>Aksi</th>
					</tr>
				</thead>
				<tbody>
					<?php
						$semua_ujian = mysqli_query($conn, "SELECT * FROM tb_ujian INNER JOIN tb_dosen ON tb_ujian.`id_dosen`=tb_dosen.`id_dosen`");
						foreach ($semua_ujian as $ujian) {
					?>
					<tr>
						<td><?php echo $ujian['id_ujian']?></td>
						<td><?php echo $ujian['nama_ujian']?></td>
						<td><?php echo $ujian['nama_dosen']?></td>
						<td><?php echo $ujian['tgl_buat_ujian']?></td>
						<td><?php echo $ujian['tgl_selesai_ujian']?></td>
						<td>
							<a class="btn btn-danger" href="javascript:void(o)">
								<i class="fas fa-trash"></i>
							</a>
							<a class="btn btn-primary" href="?page=ujian&id_ujian=<?php echo $ujian['id_ujian'] ?>">
								<i class="fas fa-eye"></i>
							</a>
						</td>
					</tr>
					<?php
						}
					?>
				</tbody>
			</table>
		</div>
	</div>
</div>