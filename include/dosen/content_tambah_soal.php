<?php
	$id_ujian=1;
	if(isset($_POST['submit'])){
		for($i=0;$i<100;$i++){
			if(isset($_POST['soal'.$i])){
				$soal = $_POST['soal'.$i];
				$jawaban = $_POST['jawaban'.$i];
				$semua_soal = mysqli_query($conn, "INSERT INTO tb_soal VALUES(null, $id_ujian, '$soal', '$jawaban')");
			} else {
				header('Location: dosen?page=soal');
			}
		}
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
					<p class="h1">1.</p>
				</div>
				<div class="col-sm-5">
					<label for="soal1">Soal</label>
					<textarea class="form-control" name="soal1" rows="3"></textarea>
				</div>
				<div class="col-sm-6">
					<label for="jawaban1">Jawaban</label>
					<textarea class="form-control" name="jawaban1" rows="3"></textarea>
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
			var count=1;
			$('#btn-tambah-soal').click(function(){
				count++;
				$("#form").append($("<div class=\"row\"><div class=\"col-sm-1\"><p class=\"h1\">"+count+".</p></div><div class=\"col-sm-5\"><label for=\"soal"+count+"\">Soal</label><textarea class=\"form-control\" name=\"soal"+count+"\" rows=\"3\"></textarea></div><div class=\"col-sm-6\"><label for=\"jawaban"+count+"\">Jawaban</label><textarea class=\"form-control\" name=\"jawaban"+count+"\" rows=\"3\"></textarea></div></div>"));

			});
		</script>
	</div>
</div>