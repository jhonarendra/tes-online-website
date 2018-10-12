<div class="card mb-3">
	<div class="card-header">
		<i class="fas fa-table"></i> Soal Pada id_ujian 1
	</div>
	<div class="card-body">
		<a class="btn-success btn" href="?page=soal&aksi=tambah">Tambah Soal</a><br /><br />
		<div class="table-responsive">
			<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
				<thead>
					<tr>
						<th>No</th>
						<th>Soal</th>
						<th>Kunci Jawaban</th>
						<th>Aksi</th>
					</tr>
				</thead>
				<tbody>
					<?php
						$id_ujian = 1;
						$semua_soal = mysqli_query($conn, "SELECT * FROM tb_soal WHERE id_ujian = $id_ujian");
						$i=1;
						foreach ($semua_soal as $soal) {
					?>
					<tr>
						<td><?php echo $i?></td>
						<td><?php echo $soal['soal']?></td>
						<td><?php echo $soal['kunci_jawaban']?></td>
						<td>
							<a class="btn btn-danger" href="javascript:void(o)">
								<i class="fas fa-trash"></i>
							</a>
							<a class="btn btn-primary" href="javascript:void(o)">
								<i class="fas fa-pencil-alt"></i>
							</a>
						</td>
					</tr>
					<?php
							$i++;
						}
					?>
				</tbody>
			</table>
		</div>
	</div>
</div>