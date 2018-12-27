<?php
	if(isset($_POST['submit'])){
		$nama = $_POST['nama'];
		$jawaban1 = $_POST['soal1'];
		$jawaban2 = $_POST['soal2'];
		$jawaban3 = $_POST['soal3'];
		$jawaban4 = $_POST['soal4'];

		$file = fopen("isijawaban.txt", "a");

		fwrite($file, $nama.PHP_EOL);
		fwrite($file, "1. ".$jawaban1.PHP_EOL);
		fwrite($file, "2. ".$jawaban2.PHP_EOL);
		fwrite($file, "3. ".$jawaban3.PHP_EOL);
		fwrite($file, "4. ".$jawaban4.PHP_EOL);
		fwrite($file, PHP_EOL);
	}
?>
<fieldset>
	<legend>Ujian</legend>
	<form action="" method="POST">
		<label for="soal1">1. Jelaskan bagaimana cara membuat website menurut anda!</label><br />
		<textarea name="soal1" id="soal1" style="width: 100%" rows="10"></textarea><br /><br />
		<label for="soal2">2. Sebutkan 3 sosial media yang sering anda gunakan! Jelaskan mengapa anda menggunakannya!</label><br />
		<textarea name="soal2" id="soal2" style="width: 100%" rows="10"></textarea><br /><br />
		<label for="soal3">3. Jelaskan 3 aplikasi yang digunakan untuk edit foto! Jelaskan kelebihan dan kekurangannya!</label><br />
		<textarea name="soal3" id="soal3" style="width: 100%" rows="10"></textarea><br /><br />
		<label for="soal4">4. Jelaskan yang anda ketahui tentang Microsoft Word, Excel dan Power Point!</label><br />
		<textarea name="soal4" id="soal4" style="width: 100%" rows="10"></textarea><br /><br />
		
		<input type="text" name="nama" placeholder="Masukkan nama kalo mau" />
		<input type="submit" name="submit" value="kirim" />
	</form>
</fieldset>