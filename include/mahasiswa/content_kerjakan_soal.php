<?php
	include 'include/text-processing/Stemming.php';
	include 'include/text-processing/LSI.php';

	$id_mhs = $_SESSION['id_mhs'];
	$nama_ujian = $_GET['kerjakan'];

	$stems = new Stemming();
	$lsi = new LSI();


	if (isset($_POST['submit'])) {
		$sum_nilai = 0;
		$id_ujian = $_POST['id_ujian'];
		$jumlah_soal = 0;
		for ($i=0; $i<100 ; $i++) { 
			if(isset($_POST['jawaban_mhs'.$i])){
				$jawaban_mhs = $_POST['jawaban_mhs'.$i];
				$kunci_jawaban = $_POST['kunci_jawaban'.$i];

				// similar_text($jawaban, $kunci_jawaban, $nilai_similarity);

				$stemming_kunci_jawaban = $stems->stem($kunci_jawaban);
				$stemming_jawaban_mhs = $stems->stem($jawaban_mhs);

				$similarity = $lsi->runlsi($stemming_kunci_jawaban, $stemming_jawaban_mhs);


				$sum_nilai = $similarity+$sum_nilai;

				$insert_soal = mysqli_query($conn, "INSERT INTO tb_jawaban_mhs VALUES(NULL, $i, $id_mhs, '$jawaban_mhs', $similarity)");


				// echo $similarity."<br />";
				$jumlah_soal++;
			}
			header('Location: mahasiswa');
		}
		$tot_nilai = $sum_nilai/$jumlah_soal;
		// echo $tot_nilai;
		$insert_nilai = mysqli_query($conn, "INSERT INTO tb_nilai_mhs VALUES (NULL, $id_ujian, $id_mhs, $tot_nilai)");
	}
?>
<div class="card mb-3">
	<div class="card-header">
		<i class="fas fa-list-ul"></i> Daftar Soal
	</div>
	<div class="card-body">
		<form id="form" action="" method="POST">
		<?php
			$semua_soal = mysqli_query($conn, "SELECT * FROM tb_soal INNER JOIN tb_ujian ON tb_soal.`id_ujian`=tb_ujian.`id_ujian` WHERE nama_ujian='$nama_ujian' ORDER BY nomor_soal");
			foreach ($semua_soal as $soal) {
		?>
			<p><?php echo $soal['nomor_soal'].". ".$soal['soal']?></p>
			<textarea class="form-control" type="text" name="jawaban_mhs<?php echo $soal['id_soal']?>" rows="5"></textarea>
			<!-- /<input type="text" name="jawaban_mhs<?php echo $soal['id_soal']?>"> -->
			<input type="hidden" name="kunci_jawaban<?php echo $soal['id_soal']?>" value="<?php echo $soal['kunci_jawaban']?>">
			<br /><br />
		<?php
			}
		?>
			<input type="hidden" name="id_ujian" value="<?php echo $soal['id_ujian'] ?>">
			<button type="submit" name="submit" value="kirim" class="btn btn-outline-primary"><i class="fab fa-telegram-plane"></i> Submit</button>
			<!-- <input type="submit" name="submit" value="kirim"> -->
		</form>
	</div>
	<div class="card-footer small text-muted">Latent Semantic Index | Tes Online 2018</div>
</div>