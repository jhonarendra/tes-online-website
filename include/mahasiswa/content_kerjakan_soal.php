<?php
	include 'include/text-processing/Stemming.php';
	include 'include/text-processing/LSI.php';

	$id_mhs = $_SESSION['id_mhs'];
	$id_ujian = $sluguriaksi;
	$stems = new Stemming();
	$lsi = new LSI();


	if (isset($_POST['submit'])) {
		$jumlah_soal = 0;
		for ($i=0; $i<100 ; $i++) { 
			if(isset($_POST['jawaban_mhs'.$i])){
				$jawaban_mhs = $_POST['jawaban_mhs'.$i];

				$stemming_jawaban_mhs = $stems->stem($jawaban_mhs);

				$string_stemming_jawaban_mhs = null;

				foreach ($stemming_jawaban_mhs as $key) {
					$string_stemming_jawaban_mhs = $string_stemming_jawaban_mhs." ".$key;
				}

				$insert_soal = mysqli_query($conn, "INSERT INTO tb_jawaban_mhs VALUES(NULL, $i, $id_mhs, '$jawaban_mhs', '$string_stemming_jawaban_mhs')");

				$jumlah_soal++;
			}
		}
		$insert_nilai = mysqli_query($conn, "INSERT INTO tb_nilai_mhs VALUES(NULL, $id_ujian, $id_mhs, 0);");
		header('Location: ../../mahasiswa');
	}
?>
<div class="main">
	<!-- MAIN CONTENT -->
	<div class="main-content">
		<div class="container-fluid">
			<nav aria-label="breadcrumb" role="navigation">
			  <ol class="breadcrumb" style="background:#fff">
			    <li class="breadcrumb-item"><a href="<?php echo $web_url."mahasiswa"?>">Dashboard</a></li>
			    <li class="breadcrumb-item active" aria-current="page">Kerjakan Soal</li>
			  </ol>
			</nav>
			<h3 class="page-title">Kerjakan Ujian</h3>
			<form id="form" action="" method="POST">
			<?php
				$semua_soal = mysqli_query($conn, "SELECT * FROM tb_soal INNER JOIN tb_ujian ON tb_soal.`id_ujian`=tb_ujian.`id_ujian` WHERE tb_ujian.`id_ujian`=$id_ujian AND tb_soal.`status`!='Dihapus' ORDER BY nomor_soal");
				foreach ($semua_soal as $soal) {
			?>
				<p><?php echo $soal['nomor_soal'].". ".$soal['soal']?></p>
				<textarea id="textarea<?php echo $soal['id_soal']?>" class="form-control" type="text" name="jawaban_mhs<?php echo $soal['id_soal']?>" rows="5"></textarea>
				<p style="text-align: right;">Jumlah karakter: <span id="count<?php echo $soal['id_soal']?>">0</span></p>
				
				<br /><br />
			<?php
				}
			?>
				<input type="submit" name="submit" class="btn btn-success" />
			</form>
			<script type="text/javascript">
				// $(document).ready(function() {
				//     $("#textarea23").on('keyup', function() {
				//         var words = this.value.match(/\S+/g).length;
				//         if (words > 200) {
				//             // Split the string on first 200 words and rejoin on spaces
				//             var trimmed = $(this).val().split(/\s+/, 200).join(" ");
				//             // Add a space at the end to keep new typing making new words
				//             $(this).val(trimmed + " ");
				//         }
				//         else {
				//             $('#count23').text(words);
				//             // $('#word_left').text(200-words);
				//         }
				//     });
				//  }); 

				<?php
					foreach ($semua_soal as $soal) {
				?>
					$(document).ready(function() {
						$("#textarea<?php echo $soal['id_soal'] ?>").on('keyup', function() {
							$('#count<?php echo $soal['id_soal']?>').text($(this).val().length);
						});
					}); 
				<?php
					}
				?>
			</script>
		</div>
	</div>
</div>