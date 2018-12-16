<?php
	$id_ujian = $sluguri;
	$semua_soal = mysqli_query($conn, "SELECT * FROM tb_soal WHERE tb_soal.`id_ujian` = $id_ujian ORDER BY nomor_soal");
	$nomor_soal = 0;
	$nama_ujians = mysqli_query($conn, "SELECT nama_ujian FROM tb_ujian WHERE id_ujian = $sluguri");
	foreach ($nama_ujians as $key) {
		$nama_ujian = $key['nama_ujian'];
	}
	foreach ($semua_soal as $soal) {
		$nomor_soal = $soal['nomor_soal'];
	}

	$nomor_soal=$nomor_soal+1;
	if(isset($_POST['submit'])){
		for($i=0;$i<100;$i++){
			if(isset($_POST['soal'.$i])){
				$soal = $_POST['soal'.$i];
				$semua_soal = mysqli_query($conn, "INSERT INTO tb_soal VALUES(null, $i, $id_ujian, '$soal', 'Aktif')");
			}
		}
		header('Location: ../../dosen');
	}
?>

<div class="main">
	<!-- MAIN CONTENT -->
	<div class="main-content">
		<div class="container-fluid">
			<nav aria-label="breadcrumb" role="navigation">
			  <ol class="breadcrumb" style="background:#fff">
			    <li class="breadcrumb-item"><a href="<?php echo $web_url?>dosen">Dashboard</a></li>
			    <li class="breadcrumb-item"><a href="<?php echo $web_url."dosen/".$id_ujian?>"><?php echo $nama_ujian;?></a></li>
			    <li class="breadcrumb-item active" aria-current="page">Tambah Soal</li>
			  </ol>
			</nav>
			<h3 class="page-title">Tambah Soal</h3>
			<form id="form" action="" method="POST">
				<div class="row">
					<div class="col-sm-1">
						<p class="h1">
							<?php echo $nomor_soal;?>
						</p>
					</div>
					<div class="col-sm-7">
						<label for="soal1">Soal</label>
						<textarea class="form-control" name="soal<?php echo $nomor_soal;?>" rows="3"></textarea>
					</div>  
				</div>

				<div class="form-group" style="position: fixed;z-index: 9999;right: 20px;bottom:20x">
					<a class="btn btn-primary" id="btn-tambah-soal" href="javascript:void(o)">
						Tambah Soal
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
					$("#form").append($("<div class=\"row\"><div class=\"col-sm-1\"><p class=\"h1\">"+count+"</p></div><div class=\"col-sm-7\"><label for=\"soal"+count+"\">Soal</label><textarea class=\"form-control\" name=\"soal"+count+"\" rows=\"3\"></textarea></div></div>"));

				});
			</script>
		</div>
	</div>
</div>