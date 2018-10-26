<?php
	$id_ujian = $_GET['id_ujian'];
?>
<div class="card mb-3">
	<div class="card-header">
		<i class="fas fa-table"></i> Nilai Mahasiswa
	</div>
	<div class="card-body">
		<div class="table-responsive">
			<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
				<thead>
					<tr>
						<th>No</th>
						<th>Nama</th>
						<th>Nilai</th>
						<th>Predikat</th>
						<th>Aksi</th>
					</tr>
				</thead>
				<tbody>
					<?php
						$semua_nilai_mhs = mysqli_query($conn, "SELECT * FROM tb_nilai_mhs INNER JOIN tb_mhs ON tb_mhs.`id_mhs`=tb_nilai_mhs.`id_mhs` WHERE id_ujian=$id_ujian");
						$i=1;
						foreach ($semua_nilai_mhs as $nilai_mhs) {
					?>
					<tr>
						<td><?php echo $i?></td>
						<td><?php echo $nilai_mhs['nama_mhs']?></td>
						<td><?php echo $nilai_mhs['nilai_mhs']?></td>
						<td>
							<?php
								if($nilai_mhs['nilai_mhs']>79){
									echo "A";
								} else if($nilai_mhs['nilai_mhs']>65){
									echo "B";
								} else if ($nilai_mhs['nilai_mhs']>50) {
									echo "C";
								} else if ($nilai_mhs['nilai_mhs']>40) {
									echo "D";
								} else {
									echo "E";
								}
							?>	
						</td>
						<td>
							<a class="btn btn-primary" href="?page=nilai_mhs&aksi=lihat&id=<?php echo $nilai_mhs['id_mhs']?>">
								<i class="fas fa-eye"></i>
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