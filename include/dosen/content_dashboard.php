<div class="main">
	<!-- MAIN CONTENT -->
	<div class="main-content">
		<div class="container-fluid">
			<h3 class="page-title">Daftar Ujian</h3>
			<a class="btn-success btn ml-4 mt-4" href="<?php echo $web_url."dosen/" ?>buat-ujian">Buat Ujian</a><br></br>
			<div class="row">
				<?php
					$ujian = mysqli_query($conn, "SELECT *, YEAR(tgl_buat_ujian) AS tahun, MONTHNAME(tgl_buat_ujian) AS bulan, DAY(tgl_buat_ujian) AS tanggal, TIME(tgl_buat_ujian) AS jam FROM tb_ujian INNER JOIN tb_dosen ON tb_ujian.`id_dosen`=tb_dosen.`id_dosen` WHERE status_ujian != 'Dihapus' ORDER BY id_ujian DESC");
					foreach ($ujian as $nilai) {
						$id_ujian = $nilai['id_ujian'];
				?>
				<div class="col-md-4">
					<!-- PANEL HEADLINE -->
					<div class="panel panel-headline">
						<div class="panel-heading">
							<h3 class="panel-title"><?php echo $nilai['nama_ujian']; ?></h3>
							<p class="panel-subtitle"><?php echo $nilai['nama_dosen']; ?></p>
						</div>
						<div class="panel-body">
							<?php
								if($nilai['status_ujian']=="Aktif") {
							?>
							<span class="label label-success">Aktif</span>
							<?php
								} else {
							?>
							<span class="label label-danger">Tidak Aktif</span>
							<?php
								}

								$cek_soal = mysqli_query($conn, "SELECT * FROM tb_soal WHERE id_ujian = $id_ujian");
								if(mysqli_num_rows($cek_soal)==0){
							?>
							<span class="label label-danger">Belum Ada Soal</span>
							<?php
								}
							?><br /><br />
							<div class="btn-group" role="group" aria-label="Basic example">
							  <a title="Lihat Soal" href="dosen/<?php echo $nilai['id_ujian']?>" class="btn btn-primary"><i class="fa fa-eye"></i></a>
							  <a title="Edit Ujian" href="dosen/<?php echo $nilai['id_ujian']?>/edit" class="btn btn-success"><i class="fa fa-pencil"></i></a>
							  <a title="Hapus Ujian" href="#" data-toggle="modal" data-target="#nilaiModal<?php echo $nilai['id_ujian'] ?>" class="btn btn-danger"><i class="fa fa-trash"></i></a>
							  <a title="Lihat Nilai Mahasiswa" href="dosen/<?php echo $nilai['id_ujian']?>/lihat-nilai" class="btn btn-warning"><i class="fa fa-user"></i></a>
							</div>
						</div>
						<div class="panel-footer">
						<?php
							echo $nilai['tanggal']." ".$nilai['bulan']." ".$nilai['tahun']." - ".$nilai['jam']
						?>
						</div>
					</div>
					<!-- END PANEL HEADLINE -->


					<div class="modal fade" id="nilaiModal<?php echo $nilai['id_ujian'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
					  <div class="modal-dialog" role="document">
					    <div class="modal-content">
					      <div class="modal-header">
					        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
					          <span aria-hidden="true">×</span>
					        </button>
					        <h3 class="modal-title" id="exampleModalLabel">Yakin Hapus <?php echo $nilai['nama_ujian']?></h3>
					      </div>
					      <div class="modal-body">
					      	Ujian yang dihapus tidak bisa dikembalikan lagi
					      </div>
					      <div class="modal-footer">
					      	<a class="btn btn-success" href="dosen/<?php echo $nilai['id_ujian']?>/hapus">Submit</a>
					        <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
					      </div>
					    </div>
					  </div>
					</div>



				</div>
				<?php
					}
				?>
			</div>
		</div>
	</div>
	<!-- END MAIN CONTENT -->
</div>