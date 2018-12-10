<?php
	$id_ujian = $sluguri;
	if (isset($_POST['submit'])) {
		$id_mhs = $_POST['id_mhs'];
		$nilai_mhs = $_POST['nilai_mhs'];
		$input_nilai = mysqli_query($conn, "UPDATE tb_nilai_mhs SET nilai_mhs=$nilai_mhs WHERE id_ujian=$id_ujian AND id_mhs=$id_mhs");
	}
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
						<td>
							<?php
								if($nilai_mhs['nilai_mhs']==0){
									echo "Belum dikoreksi";
								} else {
									echo $nilai_mhs['nilai_mhs'];
								}
							?>
								
						</td>
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
							<a class="btn btn-primary" href="<?php echo $web_url."dosen/".$nilai_mhs['id_ujian']."/lihat-nilai/".$nilai_mhs['id_mhs'] ?>">
								<i class="fas fa-eye"></i>
							</a>
							<a href="#" data-toggle="modal" data-target="#inputNilai<?php echo $nilai_mhs['id_mhs'] ?>"class="btn btn-success">
							<i class="fas fa-pencil-alt"></i>
						</td>
					</tr>
					<div class="modal fade" id="inputNilai<?php echo $nilai_mhs['id_mhs'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
					  <div class="modal-dialog" role="document">
					    <div class="modal-content">
					      <div class="modal-header">
					        <h5 class="modal-title" id="exampleModalLabel">Input Nilai <?php echo $nilai_mhs['nama_mhs']?></h5>
					        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
					          <span aria-hidden="true">×</span>
					        </button>
					      </div>
					      <form action="" method="POST">
						      <div class="modal-body">
						      	<input type="text" name="nilai_mhs" class="form-control" />
						      	<input type="hidden" name="id_mhs" value="<?php echo $nilai_mhs['id_mhs'] ?>">
						      </div>
						      <div class="modal-footer">
						      	<button class="btn btn-success" type="submit" name="submit">Submit</button>
						        <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
						      </div>
						  </form>
					    </div>
					  </div>
					</div>
					<?php
							$i++;
						}
					?>
				</tbody>
			</table>
		</div>
	</div>
</div>