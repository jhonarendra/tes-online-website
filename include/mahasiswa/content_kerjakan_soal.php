<?php
$id_mhs = $_SESSION['id_mhs'];
echo $id_mhs;
echo $nama_ujian;
?>
<div class="card mb-3">
	<div class="card-header">
		<i class="fas fa-table"></i>Dashboard
	</div>
	<div class="card-body">
	<form id="form" action="" method="POST">
			<div class="row">
				<div class="col-sm-1">
					<p class="h1">
						1
					</p>
				</div>
				<div class="col-sm-5">
					<label for="soal1">Soal</label>
					<textarea class="form-control" name="soal<?php echo $nomor_soal;?>" rows="3"></textarea>
				</div>
				<div class="col-sm-6">
					<label for="jawaban1">Jawaban</label>
					<textarea class="form-control" name="jawaban<?php echo $nomor_soal;?>" rows="3"></textarea>
				</div>   
			</div>

			<div class="form-group" style="position: fixed;z-index: 9999;right: 20px;bottom:20x">
				<a class="btn btn-primary" id="btn-tambah-soal" href="javascript:void(o)">
					<i class="fas fa-plus"></i> Tambah Soal
				</a>  
				<button class="btn btn-success" type="submit" name="submit" id="btn-tambah-soal">
					Submit
				</button>           
			</div>
		</form>
	</div>
	<div class="card-footer small text-muted">Updated yesterday at 11:59 PM</div>
</div>