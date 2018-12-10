<?php
	$id_ujian = $sluguri;
	$semua_soal = mysqli_query($conn, "SELECT * FROM tb_soal WHERE id_ujian = $id_ujian ORDER BY nomor_soal");
	$nomor_soal = 0;
	foreach ($semua_soal as $soal) {
		$nomor_soal=$soal['nomor_soal'];
	}
	$nomor_soal=$nomor_soal+1;
	if(isset($_POST['submit'])){
		for($i=0;$i<100;$i++){
			if(isset($_POST['soal'.$i])){
				$soal = $_POST['soal'.$i];
				$semua_soal = mysqli_query($conn, "INSERT INTO tb_soal VALUES(null, $i, $id_ujian, '$soal')");
			}
		}
		header('Location: ../../dosen');
	}
?>
<div class="card mb-3">
	<div class="card-header">
		<i class="fas fa-table"></i> Tambah Soal
	</div>
	<div class="card-body">
		<form id="form" action="" method="POST">
			<div class="row">
				<div class="col-sm-1">
					<p class="h1">
						<?php echo $nomor_soal;?>
					</p>
				</div>
				<div class="col-sm-5">
					<label for="soal1">Soal</label>
					<textarea class="form-control" name="soal<?php echo $nomor_soal;?>" rows="3"></textarea>
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
		<br />
		<script type="text/javascript">
			var count=<?php echo $nomor_soal;?>;
			$('#btn-tambah-soal').click(function(){
				count++;
				$("#form").append($("<div class=\"row\"><div class=\"col-sm-1\"><p class=\"h1\">"+count+"</p></div><div class=\"col-sm-5\"><label for=\"soal"+count+"\">Soal</label><textarea class=\"form-control\" name=\"soal"+count+"\" rows=\"3\"></textarea></div></div>"));

			});
		</script>
	</div>
</div>