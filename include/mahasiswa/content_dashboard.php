<?php
  $id_mhs = $_SESSION['id_mhs'];
  $ujian = mysqli_query($conn, "SELECT tb_ujian.* , tb_dosen.`nama_dosen` FROM tb_ujian INNER JOIN tb_dosen ON tb_dosen.`id_dosen`=tb_ujian.`id_dosen`");
  $i=1; 
  foreach ($ujian as $nilai) {
    $nama_mhs=$nilai;
  }

?>
<div class="card mb-3">
	<div class="card-header">
		<i class="fas fa-table"></i> Dashboard
	</div>
	<div class="card-body">
		<table class="table">
        <thead>
            <tr>
				<th scope="col">No</th>
				<th scope="col">Nama Ujian</th>
				<th scope="col">Tanggal Mulai</th>
				<th scope="col">Tanggal Akhir</th>
				<th scope="col">Dosen</th>
				<th scope="col">Status</th>
				<th scope="col">Aksi</th>
            </tr>
        </thead>
		<?php
            foreach ($ujian as $nilai) {
          ?>		
        <tbody>
            <tr>
				<td><?php echo $i?></td>
				<td><?php echo $nilai['nama_ujian']?></td>
				<td><?php echo $nilai['tgl_buat_ujian']?></td>
				<td><?php echo $nilai['tgl_selesai_ujian']?></td>
				<td><?php echo $nilai['nama_dosen']?></td>
				<td>
					<?php
						$id_ujian = $nilai['id_ujian'];
						$cek_jawab = mysqli_query($conn, "SELECT * FROM tb_jawaban_mhs INNER JOIN tb_soal ON tb_jawaban_mhs.`id_soal`=tb_soal.`id_soal` INNER JOIN tb_ujian ON tb_soal.`id_ujian`=tb_ujian.`id_ujian`WHERE tb_jawaban_mhs.`id_mhs`=$id_mhs AND tb_ujian.`id_ujian`=$id_ujian");
						$numrow = mysqli_num_rows($cek_jawab);
						if($numrow==0){
					?>
					<button class="btn btn-danger"><i class="fas fa-times"></i> Belum Dikerjakan</button>	
					<?php
						} else {
					?>
					<button class="btn btn-success"><i class="fas fa-check"></i> Sudah Dikerjakan</button>	
					<?php
						}
					?>
				</td>
				<td>
					<div class="btn-group" role="group" aria-label="Basic example">
						<?php
							if($numrow==0){
						?>
						<a class="btn btn-primary" href="?kerjakan=<?php echo $nilai['nama_ujian'] ?>">
							<i class="fas fa-pencil-alt"></i>
						</a>
						<?php
							} else {

							}
						?>	
						<a href="#" data-toggle="modal" data-target="#nilaiModal<?php echo $nilai['id_ujian'] ?>"class="btn btn-warning">
							<i class="fas fa-eye"></i>
						</a>						
					</div>				
				</td>
            </tr>
			<?php
				$i++;
			?>
			<!-- Logout Modal-->
			<div class="modal fade" id="nilaiModal<?php echo $nilai['id_ujian'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
			  <div class="modal-dialog" role="document">
			    <div class="modal-content">
			      <div class="modal-header">
			      	<?php
			      		$id_ujian_row = $nilai['id_ujian'];
			      		$nilai_mahasiswa=mysqli_query($conn, "SELECT * FROM tb_nilai_mhs WHERE id_mhs=$id_mhs AND id_ujian = $id_ujian_row");
			      		$numrow_nilai = mysqli_num_rows($nilai_mahasiswa);
			      		if ($numrow_nilai==0) {
			      			$modal_title = "Anda Belum Mengerjakan";
			      			$nilai_ujian_mhs = "Klik tombol kerjakan untuk menyelesaikan ujian!";
			      		} else {
			      			$modal_title = "Nilai Anda";
			      			foreach ($nilai_mahasiswa as $nilainya) {
			      				$nilai_ujian_mhs = $nilainya['nilai_mhs'];
			      			}
			      		}
			      	?>
			        <h5 class="modal-title" id="exampleModalLabel"><?php echo $modal_title ?></h5>
			        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
			          <span aria-hidden="true">×</span>
			        </button>
			      </div>
			      <div class="modal-body"><?php echo $nilai_ujian_mhs ?></div>
			      <div class="modal-footer">
			        <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
			        <!-- <a class="btn btn-primary" href="logout.php">Logout</a> -->
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
	<div class="card-footer small text-muted">Latent Semantic Index | Tes Online 2018</div>
</div>