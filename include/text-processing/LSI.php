<?php
	/**
	 * 
	 */
	class LSI {
		public function runlsi($kunci, $jawaban){
			$all_term = $this->getAllTerm($kunci, $jawaban);
			$term = $this->getTerm($all_term);
			$matriks = $this->getMatrix($term, $kunci, $jawaban);
			$similarity = $this->bobotMatrix($term, $matriks);

			return $similarity;
		}
		public function getAllTerm($input1, $input2){
			$i=0;
			foreach ($input1 as $data1) {
				$all_term[$i] = $data1;
				$i++;
			}
			foreach ($input2 as $data2) {
				$all_term[$i] = $data2;
				$i++;
			}

			return $all_term;
		}
		public function getTerm($input){
			$i = 0;
			$term[] = null;
			foreach ($input as $allTerm) {
				if(!in_array($allTerm, $term)){
					$term[$i] = $allTerm;
					$i++;
				}
			}
			return $term;
		}
		public function getMatrix($input, $kunci, $jawaban){
			$term = $input;
			$stemming_kunci_jawaban = $kunci;
			$stemming_jawaban_mhs = $jawaban;
			$matriks[][] = null;
			for ($i=0; $i < sizeof($term); $i++) {
				if(in_array($term[$i], $stemming_kunci_jawaban)){
					$counting = array_count_values($stemming_kunci_jawaban);
					$matriks[$i][0] = $counting[$term[$i]] ;
				} else {
					$matriks[$i][0] = 0;
				}
				if(in_array($term[$i], $stemming_jawaban_mhs)){
					$counting = array_count_values($stemming_jawaban_mhs);
					$matriks[$i][1] = $counting[$term[$i]];
				} else {
					$matriks[$i][1] = 0;
				}
			}
			return $matriks;
		}
		public function bobotMatrix($input1, $input2){
			$term = $input1;
			$matriks = $input2;
			$kunci_jwbn_counter = 0;
			$jwbn_mhs_counter = 0;
			for ($i=0; $i < sizeof($term); $i++) { 
				if($matriks[$i][0]!=0){
					$kunci_jwbn_counter = $matriks[$i][0]+$kunci_jwbn_counter;
					$jwbn_mhs_counter = $matriks[$i][1]+$jwbn_mhs_counter;
				}
			}
			$similarity = $jwbn_mhs_counter*100/$kunci_jwbn_counter;
			return $similarity;
		}
	}
?>