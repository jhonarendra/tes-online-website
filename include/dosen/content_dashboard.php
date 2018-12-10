<a class="btn-success btn ml-4 mt-4" href="<?php echo $web_url."dosen/" ?>buat-ujian">Buat Ujian</a>
<div class="main">
	<!-- MAIN CONTENT -->
	<div class="main-content">
		<div class="container-fluid">
			<h3 class="page-title">Daftar Ujian</h3>
			<div class="row">
				<?php
					$ujian = mysqli_query($conn, "SELECT * FROM tb_ujian INNER JOIN tb_dosen ON tb_ujian.`id_dosen`=tb_dosen.`id_dosen` WHERE status_ujian != 'Dihapus' ");
					foreach ($ujian as $nilai) {
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
							<span class="label label-success">Aktif</span><br /><br />
							<?php
								} else {
							?>
							<span class="label label-danger">Tidak Aktif</span><br /><br />
							<?php
								}
							?>
							<div class="btn-group" role="group" aria-label="Basic example">
							  <button type="button" class="btn btn-secondary"><i class="fa fa-eye"></i></button>
							  <button type="button" class="btn btn-secondary"><i class="fa fa-pencil"></i></button>
							  <button type="button" class="btn btn-secondary"><i class="fa fa-trash"></i></button>
							  <button type="button" class="btn btn-secondary"><i class="fa fa-user"></i></button>
							</div>
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