<?php
	/**
	 * 
	 */
	class LSI2 {
		public function lsi($query, $input){
			$query = explode(" ", $query);
			$input = explode(" ", $input);

			$i=0;
			foreach ($query as $data1) {
				$all_term[$i] = $data1;
				$i++;
			}
			foreach ($input as $data2) {
				$all_term[$i] = $data2;
				$i++;
			}

			$c = 0;
			$term[] = null;
			foreach ($all_term as $all) {
				if(!in_array($all, $term)){
					$term[$c] = $all;
					$c++;
				}
			}

			for ($i=0; $i < sizeof($term); $i++) {
				// echo $term[$i];

					if(in_array($term[$i], $query)){
						$counting = array_count_values($query);
						// echo $counting[$term[$i]];
						$matriks[$i][0] = $counting[$term[$i]] ;
					} else {
						// echo "0";
						$matriks[$i][0] = 0;
					}
				// echo " ";
					if(in_array($term[$i], $input)){
						$counting = array_count_values($input);
						// echo $counting[$term[$i]];
						$matriks[$i][1] = $counting[$term[$i]];
					} else {
						// echo "0";
						$matriks[$i][1] = 0;
					}
				// echo "<br />";
			}

			$query_counter = 0;
			$input_counter = 0;
			for ($i=0; $i < sizeof($term); $i++) { 
				// echo $matriks[$i][0]." ";
				// echo $matriks[$i][1];

				if($matriks[$i][0]!=0){
					$query_counter = $matriks[$i][0]+$query_counter;
					$input_counter = $matriks[$i][1]+$input_counter;
				}
				// echo "<br />";
			}

			$matriks2x2[][] = null;
			$temp1 = 0;
			for ($i=0; $i < sizeof($term); $i++) { 
				$temp1 = $temp1 + $matriks[$i][0]*$matriks[$i][0];
			}
			// echo $temp1." ";
			$temp2 = 0;
			for ($i=0; $i < sizeof($term); $i++) { 

				$temp2 = $temp2 + $matriks[$i][0]*$matriks[$i][1];
			}
			// echo $temp2. "<br />";
			$temp3 = 0;
			for ($i=0; $i < sizeof($term); $i++) { 

				$temp3 = $temp3 + $matriks[$i][1]*$matriks[$i][0];
			}
			// echo $temp3." ";
			$temp4 = 0;
			for ($i=0; $i < sizeof($term); $i++) { 

				$temp4 = $temp4 + $matriks[$i][1]*$matriks[$i][1];
			}
			// echo $temp4. "<br />";
			
			$ntengah = -$temp1-$temp4;
			$blkg = $temp1*$temp4-$temp2*$temp3;


			if ($blkg == 0) {
				$similikiti = 100;
				// echo "<br /><br />......udah mastriks A nya sama semua pasti jawabannya bener semua";
			} else if($temp2 == 0){
				$similikiti = 0;
				// echo "<br /><br />......matriks kunci sama jawabannya gak ada yg sama jadi pasti salah semua";
			} else {
				// echo $ntengah;
				// echo "x) + (";
				// echo $blkg;
				// echo ")<br /><br /><br />";


				$lamda1 = sqrt(pow($ntengah/2, 2)-$blkg)-$ntengah/2;
				$lamda2 = sqrt(pow($ntengah/2, 2)-$blkg)+$ntengah/2;
				// echo "x1 = ".$lamda1."<br />";
				// echo "x2 = ".$lamda2."<br />";

				// echo "<br /><br />Menghitung Eigenvector:<br />Vektor 1<br />";
				// echo "| ";
				$eigenvec1 = (1/($temp1-$lamda1))*$temp2;
				// echo $eigenvec1;
				// echo "<br />| 1 <br /><br />Vektor 2<br />";

				// echo "| ";
				$eigenvec2 = (1/($temp1-$lamda2))*$temp2;
				// echo (1/($temp1-$lamda2))*$temp2;
				// echo "<br />| 1 <br /><br /><br /><br />Menghitung Matriks S (eigenvalue diakarin)<br />";

				$s[0] = sqrt(sqrt(pow($lamda1, 2)));
				$s[1] = sqrt(sqrt(pow($lamda2, 2)));


				// echo $s[0]." 0 <br /> 0 ".$s[1];

				// echo "<br /><br />Matriks S Invers (pangkat -1):<br />";

				//############################################################# Kebalik ya $s 1 sama $0
				$sInvers1 = pow($s[1], -1);
				$sInvers2 = pow($s[0], -1);

				// echo $sInvers1." 0 <br /> 0 ".$sInvers2;

				// echo "<br /><br />Membuat Matriks V (panjang vector = akar dari jumlah eigenvec kuadrat)<br />Normalisasi:<br />";

				$pVec1 = sqrt(pow($eigenvec1, 2)+1);
				$pVec2 = sqrt(pow($eigenvec2, 2)+1);
				// echo "|V1| = ".$pVec1."<br />";
				// echo "|V2| = ".$pVec2."<br /><br />";


				//############################################################# $eigenvec1/$pVec1 harusnya
				// echo "(Matriks V Transpos) eigenvector dibagi panjang vector<br />";
				$V11 = $eigenvec1/$pVec1;
				$V12 = 1/$pVec1;
				$V21 = $eigenvec2/$pVec2;
				$V22 = 1/$pVec2;
				// echo "|".$V11.", ".$V12."|<br />";
				// echo "|".$V21.", ".$V22."|<br /><br />";

				// echo "Matriks V<br />";

				// echo "|".$V11.", ".$V21."|<br />";
				// echo "|".$V12.", ".$V22."|<br /><br />";

				// echo "Menghitung Matriks U = A.V.(S invers)<br />";
				// for ($i=0; $i < sizeof($term); $i++) { 

				// 	echo " | ".$matriks[$i][0]." ";
				// 	echo $matriks[$i][1]." | ";
				// 	echo "<br />";

				// }
				// echo "kali<br />";

				// echo " | ".$V11.", ".$V21." |<br />";
				// echo " | ".$V12.", ".$V22." |<br />kali<br />";
				// echo " | ".$sInvers1." 0 |<br />| 0 ".$sInvers2." | <br /><br />sama dengan<br />";

				for ($i=0; $i < sizeof($term); $i++) {
					$U[$i][0] = (($matriks[$i][0]*$V11)+($matriks[$i][1]*$V12))*$sInvers1;
					$U[$i][1] = (($matriks[$i][0]*$V21)+($matriks[$i][1]*$V22))*$sInvers2;

					// echo " | ".$U[$i][0].", ".$U[$i][1]." | <br />";
				}

				// echo "<br /><br /><br />Membuat Vector Query<br />";
				// echo "Karena mencocokkan jawaban dengan kunci jawaban, jadi kunci jawaban dijadikan query.<br /> | ";
				for ($i=0; $i < sizeof($term); $i++) { 
					if($matriks[$i][0]!=0){
						// echo $matriks[$i][0]." ";
					}
				}
				// echo " | dikali matriks U (yg diatas ni), dikali matriks S invers, jadinya:<br /><br />";
				$q[0] = null;
				$q[1] = null;
				for ($i=0; $i < sizeof($term); $i++) { 
					// if($matriks[$i][0]!=0){
						$q[0] = $matriks[$i][0]*$U[$i][0]+$q[0];
						$q[1] = $matriks[$i][1]*$U[$i][1]+$q[1];
					// }
				}
				$q[0] = $q[0]*$sInvers1;
				$q[1] = $q[1]*$sInvers2;

				// echo " | ".$q[0]." ".$q[1]." | <br /><br />";

				// echo "Kemudian, cari similarity sim(q,d). Nilai d merupakan nilai matriks V seperti:<br />";
				// echo "|".$V11.", ".$V12."|<br />";
				// echo "|".$V21.", ".$V22."|<br /><br />Hasilnya:<br />";

				$sim1 = ($q[0]*$V11+$q[1]*$V21)/(sqrt(pow($q[0], 2)+pow($q[1], 2))*sqrt(pow($V11, 2)+pow($V21, 2)));
				$sim2 = ($q[0]*$V12+$q[1]*$V22)/(sqrt(pow($q[0], 2)+pow($q[1], 2))*sqrt(pow($V12, 2)+pow($V22, 2)));

				$sim1 = sqrt(pow($sim1, 2));
				$sim2 = sqrt(pow($sim2, 2));
				// echo "sim(q, d1) = ".$sim1."<br />";
				// echo "sim(q, d2) = ".$sim2."<br />";

				$similikiti = $sim2*100;

				// echo "<br /><br /><br />Dianggap kunci jawaban memiliki similarity 100% dengan query<br />Jadi diberlakukan persamaan: jawaban/kunci * 100%";
				// $similikiti = $sim2/$sim1*100;
				// if ($similikiti>=100) {
				// 	$similikiti = 100;
				// }
			}

			// echo "<h1>Similarity: ".substr($similikiti, 0, 4)."%</h1>";
			return substr($similikiti, 0, 4);
		}
	}
?>