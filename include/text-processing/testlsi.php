<!DOCTYPE html>
<html>
<head>
	<title>Tes Algo LSI</title>
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
</head>
<body>
	<form action="" method="POST">
		<input type="text" name="jawaban_mhs" placeholder="Jawaban Mahasiswa" />
		<input type="text" name="kunci_jawaban" placeholder="Kunci Jawabannya" />
		<input type="submit" name="submit" value="CEK SIMILIRATY!!!">
	</form>
</body>
</html>

<?php

	if(isset($_POST['submit'])){
		$jawaban_mhs = $_POST['jawaban_mhs'];
		$kunci_jawaban = $_POST['kunci_jawaban'];

	} else {
		$kunci_jawaban = "suatu sistem komputer untuk mengarsipkan dan menganalisis data historis suatu organisasi seperti data penjualan, gaji, dan informasi lain dari operasi harian";
		$jawaban_mhs = "data warehouse adalah metode pengarsipan data informasi seperti transaksi dan penjualan";
		echo "Data Dummy<br />";
	}
	// $kunci_jawaban = "Extended Boolean, Fuzzy, Generalized Vector Space Model, LSI, Neural Network, Bayesian, Inference Network, Belief Network";
	// $jawaban_mhs = "Bayesian Network, Belief Network, Fuzzy, Extended, Boolean, Neural Network";
	echo "Jawaban mahasiawa:<br />".$jawaban_mhs."<br /><br />";
	echo "Kunci Jawaban:<br />".$kunci_jawaban."<br /><br />";
	
	$stem = new Stemming();
	$lsi = new LSI();
	$stemming_kunci_jawaban = $stem->stem($kunci_jawaban);
	$stemming_jawaban_mhs = $stem->stem($jawaban_mhs);

	echo "Stemming kunci jawaban".json_encode($stemming_kunci_jawaban)."<br />";
	echo "Stemming jawaban mhs".json_encode($stemming_jawaban_mhs)."<br /><br />";

	// $all_term = $lsi->getAllTerm($stemming_kunci_jawaban, $stemming_jawaban_mhs);
	// echo json_encode($all_term);



	$i=0;
	foreach ($stemming_kunci_jawaban as $data1) {
		$all_term[$i] = $data1;
		$i++;
	}
	foreach ($stemming_jawaban_mhs as $data2) {
		$all_term[$i] = $data2;
		$i++;
	}

	echo "All Term".json_encode($all_term)."<br /><br />";

	$c = 0;
	$term[] = null;
	foreach ($all_term as $all) {
		if(!in_array($all, $term)){
			$term[$c] = $all;
			$c++;
		}
	}

	echo "<br /><br />Token (yg duplikat jadi 1)<br />".json_encode($term).sizeof($term)."<br /><br /><br />";


	for ($i=0; $i < sizeof($term); $i++) {
		// echo $term[$i];

			if(in_array($term[$i], $stemming_kunci_jawaban)){
				$counting = array_count_values($stemming_kunci_jawaban);
				// echo $counting[$term[$i]];
				$matriks[$i][0] = $counting[$term[$i]] ;
			} else {
				// echo "0";
				$matriks[$i][0] = 0;
			}
		// echo " ";
			if(in_array($term[$i], $stemming_jawaban_mhs)){
				$counting = array_count_values($stemming_jawaban_mhs);
				// echo $counting[$term[$i]];
				$matriks[$i][1] = $counting[$term[$i]];
			} else {
				// echo "0";
				$matriks[$i][1] = 0;
			}
		// echo "<br />";
	}

	echo "<br /><br /><br /><br />Matriks: A<br />";
	$kunci_jwbn_counter = 0;
	$jwbn_mhs_counter = 0;
	for ($i=0; $i < sizeof($term); $i++) { 
		echo $matriks[$i][0]." ";
		echo $matriks[$i][1];

		if($matriks[$i][0]!=0){
			$kunci_jwbn_counter = $matriks[$i][0]+$kunci_jwbn_counter;
			$jwbn_mhs_counter = $matriks[$i][1]+$jwbn_mhs_counter;
		}
		echo "<br />";
	}
	// echo "kunci jawaban".$kunci_jwbn_counter."<br /> jawaban mhs".$jwbn_mhs_counter."<br /><br />";
	// $smilirity = $jwbn_mhs_counter*100/$kunci_jwbn_counter;
	// echo "similarity: ".$smilirity."<br />";
	// echo "similarity(bawaan php): ".similar_text($kunci_jawaban, $jawaban_mhs);




	echo "<br /><br />Matriks A Transpos:<br />";
	for ($i=0; $i < 2; $i++) { 
		for ($j=0; $j < sizeof($term); $j++) { 
			echo $matriks[$j][$i]." ";
		}
		echo "<br />";
	}
	echo "<br /><br />Hasil Perkalian Matriks A dengan Matriks A Transpos:<br />";
	$matriks2x2[][] = null;
	$temp1 = 0;
	for ($i=0; $i < sizeof($term); $i++) { 
		$temp1 = $temp1 + $matriks[$i][0]*$matriks[$i][0];
	}
	echo $temp1." ";
	$temp2 = 0;
	for ($i=0; $i < sizeof($term); $i++) { 

		$temp2 = $temp2 + $matriks[$i][0]*$matriks[$i][1];
	}
	echo $temp2. "<br />";
	$temp3 = 0;
	for ($i=0; $i < sizeof($term); $i++) { 

		$temp3 = $temp3 + $matriks[$i][1]*$matriks[$i][0];
	}
	echo $temp3." ";
	$temp4 = 0;
	for ($i=0; $i < sizeof($term); $i++) { 

		$temp4 = $temp4 + $matriks[$i][1]*$matriks[$i][1];
	}
	echo $temp4. "<br />";

	echo "<br /><br /><br /><br />Mencari Eugenvalue:<br />";
	echo "x^2 + (";

	$ntengah = -$temp1-$temp4;
	$blkg = $temp1*$temp4-$temp2*$temp3;

	if ($blkg == 0) {
		$similikiti = 100;
		echo "<br /><br />......udah mastriks A nya sama semua pasti jawabannya bener semua";
	} else if($temp2 == 0){
		$similikiti = 0;
		echo "<br /><br />......matriks kunci sama jawabannya gak ada yg sama jadi pasti salah semua";
	} else {
		echo $ntengah;
		echo "x) + (";
		echo $blkg;
		echo ")<br /><br /><br />";


		$lamda1 = sqrt(pow($ntengah/2, 2)-$blkg)-$ntengah/2;
		$lamda2 = sqrt(pow($ntengah/2, 2)-$blkg)+$ntengah/2;
		echo "x1 = ".$lamda1."<br />";
		echo "x2 = ".$lamda2."<br />";

		echo "<br /><br />Menghitung Eigenvector:<br />Vektor 1<br />";
		echo "| ";
		$eigenvec1 = (1/($temp1-$lamda1))*$temp2;
		echo $eigenvec1;
		echo "<br />| 1 <br /><br />Vektor 2<br />";

		echo "| ";
		$eigenvec2 = (1/($temp1-$lamda2))*$temp2;
		echo (1/($temp1-$lamda2))*$temp2;
		echo "<br />| 1 <br /><br /><br /><br />Menghitung Matriks S (eigenvalue diakarin)<br />";

		$s[0] = sqrt(sqrt(pow($lamda1, 2)));
		$s[1] = sqrt(sqrt(pow($lamda2, 2)));


		echo $s[0]." 0 <br /> 0 ".$s[1];

		echo "<br /><br />Matriks S Invers (pangkat -1):<br />";

		//############################################################# Kebalik ya $s 1 sama $0
		$sInvers1 = pow($s[1], -1);
		$sInvers2 = pow($s[0], -1);

		echo $sInvers1." 0 <br /> 0 ".$sInvers2;

		echo "<br /><br />Membuat Matriks V (panjang vector = akar dari jumlah eigenvec kuadrat)<br />Normalisasi:<br />";

		$pVec1 = sqrt(pow($eigenvec1, 2)+1);
		$pVec2 = sqrt(pow($eigenvec2, 2)+1);
		echo "|V1| = ".$pVec1."<br />";
		echo "|V2| = ".$pVec2."<br /><br />";


		//############################################################# $eigenvec1/$pVec1 harusnya
		echo "(Matriks V Transpos) eigenvector dibagi panjang vector<br />";
		$V11 = $eigenvec1/$lamda1;
		$V12 = 1/$lamda1;
		$V21 = $eigenvec2/$lamda2;
		$V22 = 1/$lamda2;
		echo "|".$V11.", ".$V12."|<br />";
		echo "|".$V21.", ".$V22."|<br /><br />";

		echo "Matriks V<br />";

		echo "|".$V11.", ".$V21."|<br />";
		echo "|".$V12.", ".$V22."|<br /><br />";

		echo "Menghitung Matriks U = A.V.(S invers)<br />";
		for ($i=0; $i < sizeof($term); $i++) { 

			echo " | ".$matriks[$i][0]." ";
			echo $matriks[$i][1]." | ";
			echo "<br />";

		}
		echo "kali<br />";

		echo " | ".$V11.", ".$V21." |<br />";
		echo " | ".$V12.", ".$V22." |<br />kali<br />";
		echo " | ".$sInvers1." 0 |<br />| 0 ".$sInvers2." | <br /><br />sama dengan<br />";

		for ($i=0; $i < sizeof($term); $i++) {
			$U[$i][0] = (($matriks[$i][0]*$V11)+($matriks[$i][1]*$V12))*$sInvers1;
			$U[$i][1] = (($matriks[$i][0]*$V21)+($matriks[$i][1]*$V22))*$sInvers2;

			echo " | ".$U[$i][0].", ".$U[$i][1]." | <br />";
		}

		echo "<br /><br /><br />Membuat Vector Query<br />";
		echo "Karena mencocokkan jawaban dengan kunci jawaban, jadi kunci jawaban dijadikan query.<br /> | ";
		for ($i=0; $i < sizeof($term); $i++) { 
			if($matriks[$i][0]!=0){
				echo $matriks[$i][0]." ";
			}
		}
		echo " | dikali matriks U (yg diatas ni), dikali matriks S invers, jadinya:<br /><br />";
		$q[0] = null;
		$q[1] = null;
		for ($i=0; $i < sizeof($term); $i++) { 
			if($matriks[$i][0]!=0){
				$q[0] = $matriks[$i][0]*$U[$i][0]+$q[0];
				$q[1] = $matriks[$i][1]*$U[$i][1]+$q[1];
			}
		}
		$q[0] = $q[0]*$sInvers1;
		$q[1] = $q[1]*$sInvers2;

		echo " | ".$q[0]." ".$q[1]." | <br /><br />";

		echo "Kemudian, cari similarity sim(q,d). Nilai d merupakan nilai matriks V seperti:<br />";
		echo "|".$V11.", ".$V12."|<br />";
		echo "|".$V21.", ".$V22."|<br /><br />Hasilnya:<br />";

		$sim1 = ($q[0]*$V11+$q[1]*$V21)/(sqrt(pow($q[0], 2)+pow($q[1], 2))*sqrt(pow($V11, 2)+pow($V21, 2)));
		$sim2 = ($q[0]*$V12+$q[1]*$V22)/(sqrt(pow($q[0], 2)+pow($q[1], 2))*sqrt(pow($V12, 2)+pow($V22, 2)));

		$sim1 = sqrt(pow($sim1, 2));
		$sim2 = sqrt(pow($sim2, 2));
		echo "sim(q, d1) = ".$sim1."<br />";
		echo "sim(q, d2) = ".$sim2."<br />";

		$similikiti = $sim2*100;

		// echo "<br /><br /><br />Dianggap kunci jawaban memiliki similarity 100% dengan query<br />Jadi diberlakukan persamaan: jawaban/kunci * 100%";
		// $similikiti = $sim2/$sim1*100;
		// if ($similikiti>=100) {
		// 	$similikiti = 100;
		// }
	}

	echo "<h1>Similarity: ".substr($similikiti, 0, 4)."%</h1>";



	/**
	 * 
	 */
	class LSI{
		
		public function getAllTerm($input1, $input2){

			$all_term = array();
			$all_term = $input1;

			foreach ($input2 as $data2=>$word) {
				$phrase = $input2[$data2];
				if (!isset($all_term[$phrase])){
					$all_term[$phrase] = 1;
				} else {
					$all_term[$phrase]++;
				}
			}
			// foreach ($input as $key=>$word) {
			// 	$phrase = strtolower($input[$key]);
			// 	$a = $this->stopwords();
			// 	foreach ($a as $banned){
			// 		unset($results[$banned]);
			// 	}
			// 	$phrase = $this->porterkamus($phrase);
			// 	if (!isset($results[$phrase])){
			// 		$results[$phrase] = 1;
			// 	} else {
			// 		$results[$phrase]++;
			// 	}
			// }
			return $all_term;
		}

		public function setMatrix($input){

		}
	}











	/**
	 * 
	 */
	class Stemming
	{
		public function tokenisasi($input){
			//fungsi ini untuk menghilangkan tanda baca pada kalimat, dan memisahkan kata kata
			$input = preg_replace( "/(,|\"|\.|\?|:|!|;|-| - )/", " ", $input ); // menghilangkan tanda baca
			$input = preg_replace( "/\n/", " ", $input ); // menghilangkan enter
			$input = preg_replace( "/\s\s+/", " ", $input ); // menghilangkan spasi
			$input = explode(" ",$input);

			return $input;
		}
		public function stopwords(){
			$a = explode(" ","yang di dan itu dengan untuk tidak ini dari dalam akan pada juga saya ke karena tersebut bisa ada mereka lebih kata tahun sudah atau saat oleh menjadi orang ia telah adalah seperti sebagai bahwa dapat para harus namun kita dua satu masih hari hanya mengatakan kepada kami setelah melakukan lalu belum lain dia kalau terjadi banyak menurut  anda hingga tak baru beberapa ketika saja jalan sekitar secara dilakukan sementara tapi sangat hal sehingga  seorang bagi besar lagi selama antara waktu sebuah jika sampai jadi terhadap tiga serta pun salah merupakan atas sejak  membuat baik memiliki  kembali selain tetapi pertama kedua memang pernah apa mulai sama tentang bukan agar semua sedang kali kemudian hasil sejumlah juta persen sendiri katanya demikian masalah  mungkin umum setiap bulan bagian bila lainnya terus luar cukup termasuk sebelumnya bahkan wib tempat perlu menggunakan memberikan rabu sedangkan kamis langsung apakah pihak melalui diri mencapai  minggu aku  berada tinggi ingin sebelum tengah kini the tahu bersama depan selasa begitu  merasa  berbagai mengenai  maka jumlah masuk   katanya  mengalami sering ujar kondisi akibat hubungan empat paling mendapatkan selalu lima  meminta melihat sekarang mengaku mau kerja acara menyatakan masa proses tanpa selatan sempat  adanya hidup datang senin rasa maupun seluruh mantan lama jenis segera misalnya  mendapat bawah jangan meski terlihat akhirnya jumat  punya yakni terakhir kecil panjang badan juni of  jelas jauh tentu semakin tinggal kurang  mampu posisi  asal sekali  sesuai sebesar berat  dirinya memberi pagi  sabtu  ternyata mencari sumber ruang menunjukkan biasanya nama  sebanyak utara berlangsung barat kemungkinan yaitu  berdasarkan  sebenarnya cara utama pekan terlalu  membawa kebutuhan suatu menerima  penting  tanggal bagaimana terutama tingkat awal sedikit nanti pasti  muncul dekat lanjut ketiga biasa dulu kesempatan  ribu  akhir  membantu terkait  sebab menyebabkan khusus  bentuk ditemukan  diduga mana ya kegiatan sebagian tampil hampir bertemu usai berarti keluar pula digunakan justru  padahal menyebutkan  gedung  apalagi program  milik teman menjalani keputusan sumber a  upaya mengetahui mempunyai berjalan menjelaskan  b mengambil benar lewat belakang ikut barang meningkatkan kejadian kehidupan keterangan penggunaan masing-masing menghadapi");
			return $a;
		}
		public function katadasar(){
			$katadasar = file_get_contents('katadasar.txt');
			$katadasar = $this->tokenisasi($katadasar);
			return $katadasar;
		}
		public function stem($input)
		{
			$input = $this->tokenisasi($input);
			// $results = array();
			$i=0;
			$results[] = null;
			$stop = null;
			foreach ($input as $key=>$word) {
				$phrase = strtolower($input[$key]);
				$a = $this->stopwords();
				foreach ($a as $banned){
					if($banned == $phrase){
						$stop = $banned;
					}
				}
				if ($stop == $phrase){

				} else {
					$phrase = $this->porterkamus($phrase);
					$results[$i] = $phrase;
					$i++;
				}
				// if (!isset($results[$phrase])){
				// 	$results[$phrase] = 1;
				// } else {
				// 	$results[$phrase]++;
				// }
			}
			return $results;
		}

		public function porterkamus($kata){
			if($this->cari($kata)!=1){
				$kata = $this->hapuspartikel($kata);
			}
			if($this->cari($kata)!=1){
				$kata = $this->hapuspp($kata);
			}

			$kata1 = $kata;

			if($this->cari($kata)!=1){
				$kata = $this->hapusawalan1($kata);
			}

			if($kata1==$kata){
				if($this->cari($kata)!=1){
					$kata = $this->hapusawalan2($kata);
				}
				if($this->cari($kata)!=1){
					$kata = $this->hapusakhiran($kata);
				}
			} else {
				$kata2 = $kata;
				if($this->cari($kata)!=1){
					$kata = $this->hapusakhiran($kata);
				}
				if($this->cari($kata)!=1){
					if($kata2 = $kata){
						$kata = $this->hapusawalan2($kata);
					}
				}
			}
			return $kata;			
		}
		public function cari($kata){
			// $dbServer = "localhost";
			// $dbUser = "root";
			// $dbPass = "";
			// $dbName = "tesonline";
			// $dbKon = mysqli_connect($dbServer, $dbUser, $dbPass, $dbName);
			// $hasil = mysqli_num_rows(mysqli_query($dbKon, "SELECT * FROM tb_katadasar WHERE katadasar='$kata'")); //membuat variabel $hasil untuk menampilkan hasil mengambil kata dasar dari database
			

			$katadasar = $this->katadasar();
			if(in_array($kata, $katadasar)){
				$hasil = 1;
			} else {
				$hasil = 0;
			}
			return $hasil; //memberikan jawaban kata ada di database atau tidak
		}


		//langkah 1 - hapus partikel
		public function hapuspartikel($kata){
			if((substr($kata, -3) == 'kah' )||( substr($kata, -3) == 'lah' )||( substr($kata, -3) == 'pun' )){
				$kata = substr($kata, 0, -3);   
			}
			return $kata;
		}

		//langkah 2 - hapus possesive pronoun
		public function hapuspp($kata){
			if($this->cari($kata)!=1){
				if(strlen($kata) > 4){
					if((substr($kata, -2)== 'ku')||(substr($kata, -2)== 'mu')){
						$kata = substr($kata, 0, -2);
					} else if((substr($kata, -3)== 'nya')){
						$kata = substr($kata,0, -3);
					}
				}
			}
			return $kata;
		}

		//langkah 3 hapus first order prefiks (awalan pertama)
		public function hapusawalan1($kata){
			if(substr($kata,0,4)=="meng"){
				if(substr($kata,4,1)=="e"||substr($kata,4,1)=="u"){
					$kata = substr($kata,4);
				}else{
					$kata = substr($kata,4);
				}
			}else if(substr($kata,0,4)=="meny"){
				$kata = "s".substr($kata,4);
			}else if(substr($kata,0,3)=="men"){
				$kata = substr($kata,3);
			}else if(substr($kata,0,3)=="mem"){
				if(substr($kata,3,1)=="a"){
					$kata = "m".substr($kata,3);
				} else if(substr($kata,3,2)=="in"){
					$kata = "m".substr($kata,3);
				} else if(substr($kata,3,1)=="i"){
					$kata = "p".substr($kata,3);
				} else{
					$kata = substr($kata,3);
				}
			} else if(substr($kata,0,2)=="me"){
				$kata = substr($kata,2);
			} else if(substr($kata,0,4)=="peng"){
				if(substr($kata,4,1)=="e"){
					$kata = "k".substr($kata,4);
				}else{
					$kata = substr($kata,4);
				}
			} else if(substr($kata,0,4)=="peny"){
				$kata = "s".substr($kata,4);
			}else if(substr($kata,0,3)=="pen"){
				if(substr($kata,3,1)=="a" || substr($kata,3,1)=="i" || substr($kata,3,1)=="e" || substr($kata,3,1)=="u" || substr($kata,3,1)=="o"){
					$kata = "t".substr($kata,3);
				}else{
					$kata = substr($kata,3);
				}
			}else if(substr($kata,0,3)=="pem"){
				if(substr($kata,3,1)=="a" || substr($kata,3,1)=="i" || substr($kata,3,1)=="e" || substr($kata,3,1)=="u" || substr($kata,3,1)=="o"){
					$kata = "p".substr($kata,3);
				}else{
					$kata = substr($kata,3);
				}
			}else if(substr($kata,0,2)=="di"){
				$kata = substr($kata,2);
			}else if(substr($kata,0,3)=="ter"){
				$kata = substr($kata,3);
			}else if(substr($kata,0,2)=="ke"){
				$kata = substr($kata,2);
			}
			return $kata;
		}


		//langkah 4 hapus second order prefiks (awalan kedua)
		public function hapusawalan2($kata){
			$kataasli = $kata;
			if(substr($kata,0,3)=="ber"){
				$kata = substr($kata,3);
				if($this->cari($kata)!=1){
					$kata = $kataasli;
					$kata = substr($kata,2);
				}
			}else if(substr($kata,0,3)=="bel"){
				$kata = substr($kata,3);
			}else if(substr($kata,0,2)=="be"){
				$kata = substr($kata,2);
			}else if(substr($kata,0,3)=="per" && strlen($kata) > 5){
				$kata = substr($kata,3);
			}else if(substr($kata,0,2)=="pe"  && strlen($kata) > 5){
				$kata = substr($kata,2);
			}else if(substr($kata,0,3)=="pel"  && strlen($kata) > 5){
				$kata = substr($kata,3);
			}else if(substr($kata,0,2)=="se"  && strlen($kata) > 5){
				$kata = substr($kata,2);
			}
			return $kata;
		}


		////langkah 5 hapus suffiks
		public function hapusakhiran($kata){
			if (substr($kata, -3)== "kan" ){
				$kata = substr($kata, 0, -3);
			} else if(substr($kata, -1)== "i" ){
				$kata = substr($kata, 0, -1);
			} else if(substr($kata, -2)== "an"){
				$kata = substr($kata, 0, -2);
			}
			return $kata;
		}
	}
?>