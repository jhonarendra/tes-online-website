<?php
	$id_ujian = $sluguri;
	$id_mhs = $slugurimhs;
	$id_soal = $slug7;
	$ujian = mysqli_query($conn, "SELECT * FROM tb_ujian WHERE id_ujian = $id_ujian");
	foreach ($ujian as $key) {
	  $nama_ujian = $key['nama_ujian'];
	}
	$nilai_mhs = mysqli_query($conn, "SELECT * FROM tb_jawaban_mhs INNER JOIN tb_mhs ON tb_mhs.`id_mhs`=tb_jawaban_mhs.`id_mhs` INNER JOIN tb_soal ON tb_soal.`id_soal`=tb_jawaban_mhs.`id_soal` WHERE tb_jawaban_mhs.`id_mhs` = $id_mhs AND id_ujian=$id_ujian ORDER BY nomor_soal");
	foreach ($nilai_mhs as $nilai) {
	  $nama_mhs=$nilai['nama_mhs'];
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
          <li class="breadcrumb-item active"><a href="<?php echo $web_url."dosen/".$id_ujian."/lihat-nilai"?>">Nilai Mahasiswa</a></li>
          <li class="breadcrumb-item active" aria-current="page">
          	<a href="<?php echo $web_url."dosen/".$id_ujian."/lihat-nilai/".$id_mhs?>"><?php echo $nama_mhs ?></a>
      	  </li>
          <li class="breadcrumb-item active" aria-current="page">Similarity</li>
        </ol>
      </nav>
      <h3 class="page-title">Perhitungan Similarity</h3>
      <div class="panel">
        <div class="panel-body">
        	<h4>Jawaban <?php echo $nama_mhs ?></h4>
        	<?php echo $nilai['jawaban_mhs'] ?>
        </div>
      </div>
      <div class="panel">
        <div class="panel-body">
        	<?php
        		$jawaban_mhs_lain = mysqli_query($conn, "SELECT * FROM tb_jawaban_mhs INNER JOIN tb_mhs ON tb_jawaban_mhs.`id_mhs` = tb_mhs.`id_mhs` WHERE id_soal = $id_soal");
        		foreach ($jawaban_mhs_lain as $key2) {
        			$mhs_lain = $key2['nama_mhs'];
        			$jawaban_lain = $key2['jawaban_mhs'];
        		}
        	?>
        	<h4>Jawaban <?php echo $mhs_lain ?></h4>
        	<?php echo $jawaban_lain ?>
        </div>
      </div>
      <div class="row">
	      <div class="panel panel-headline col-md-6">
			<div class="panel-heading">
				<h3 class="panel-title">LSI</h3>
				<p class="panel-subtitle">Latent Semantic Indexing</p>
			</div>
			<div class="panel-body">
				halo
			</div>
		  </div>
	      <div class="panel panel-headline col-md-6">
	  		<div class="panel-heading">
	  			<h3 class="panel-title">Jaccard</h3>
	  			<p class="panel-subtitle">Jaccard</p>
	  		</div>
	  		<div class="panel-body">
	  			halohalo
	  		</div>
	  	  </div>
      </div>
    </div>
  </div>
</div>