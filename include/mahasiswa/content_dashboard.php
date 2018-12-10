<?php
  $id_mhs = $_SESSION['id_mhs'];
  $ujian = mysqli_query($conn, "SELECT tb_ujian.* , tb_dosen.`nama_dosen` FROM tb_ujian INNER JOIN tb_dosen ON tb_dosen.`id_dosen`=tb_ujian.`id_dosen` WHERE status_ujian!='Dihapus'");
  $i=1; 
  foreach ($ujian as $nilai) {
    $nama_mhs=$nilai;
  }

?>
<div class="main">
	<!-- MAIN CONTENT -->
	<div class="main-content">
		<div class="container-fluid">
			<h3 class="page-title">Daftar Ujian</h3>
			<div class="row">
				<?php
					foreach ($ujian as $nilai) {
				?>
				<div class="col-md-3">
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
							<span class="label label-success">Aktif</span><br /><br />
							<?php
								} else {
							?>
							<span class="label label-danger">Tidak Aktif</span><br /><br />
							<?php
								}
								$id_ujian = $nilai['id_ujian'];
								$cek_kerjakan = mysqli_query($conn, "SELECT * FROM tb_nilai_mhs WHERE id_mhs = $id_mhs AND id_ujian = $id_ujian");

								if(mysqli_num_rows($cek_kerjakan)==0){
									$nilai_mhs = 'Belum dikoreksi';
							?>
								<a class="btn btn-danger" href="mahasiswa/kerjakan/<?php echo $id_ujian?>"><i class="fa fa-check-circle"></i> Belum dikerjakan</a>
							<?php
								} else {
									foreach ($cek_kerjakan as $key) {
										$nilai_mhs = $key['nilai_mhs'];
									}
							?>
								<a class="btn btn-success" href="#"><i class="fa fa-check-circle"></i> Sudah dikerjakan</a>
							<?php
								}
							?>
							<p style="text-align: right;">
								<?php
									echo "<br />Nilai: ".$nilai_mhs;
								?>
							</p>
						</div>
					</div>
					<!-- END PANEL HEADLINE -->
				</div>
				<?php
					}
				?>
			</div>
		</div>
	</div>
	<!-- END MAIN CONTENT -->
</div>