<?php
	class LSI {
		public function runLSI($query, $input){
			if($query == $input){
				$similarity[1] = 100;
			} else {
				$query = explode(" ", $query);
				$input = explode(" ", $input);
				$semua_term = $this->getTerm($query, $input);
				$matriksA = $this->matriksA($semua_term, $query, $input);
				$temp = $this->matAxmatAT($matriksA, $semua_term);

				$val = $this->getPersamaan($temp);
				if($val[1]==0){
					$similarity[1] = 100;
				} else {
					$lamda = $this->getEigenValue($temp);
					$eigenvector = $this->getEigenVector($temp, $lamda);
					$matriksS = $this->getMatriksS($lamda);
					$sInvers = $this->getMatriksSInvers($matriksS);
					$pVec = $this->getPanjangVector($eigenvector);
					$matriksV = $this->getMatriksV($eigenvector, $pVec);
					$matriksU = $this->getMatriksU($semua_term, $matriksA, $matriksV, $sInvers);
					$matriksQ = $this->getMatriksQ($semua_term, $matriksA, $matriksU, $sInvers);
					$similarity = $this->getSimilarity($matriksQ, $matriksV);
					$similarity[1] = $similarity[1]*100;
					$similarity[1] = substr($similarity[1], 0, 4);
				}
			}
			return $similarity[1];
		}
		public function getTerm($query, $input){
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
			return $term;
		}
		public function matriksA($term, $query, $input){
			for ($i=0; $i < sizeof($term); $i++) {
				if(in_array($term[$i], $query)){
					$counting = array_count_values($query);
					$matriksA[$i][0] = $counting[$term[$i]] ;
				} else {
					$matriksA[$i][0] = 0;
				}
				if(in_array($term[$i], $input)){
					$counting = array_count_values($input);
					$matriksA[$i][1] = $counting[$term[$i]];
				} else {
					$matriksA[$i][1] = 0;
				}
			}
			return $matriksA;
		}
		public function matAxmatAT($matriksA, $term){
			$temp[0] = 0;
			for ($i=0; $i < sizeof($term); $i++) { 
				$temp[0] = $temp[0] + $matriksA[$i][0]*$matriksA[$i][0];
			}
			$temp[1] = 0;
			for ($i=0; $i < sizeof($term); $i++) { 
				$temp[1] = $temp[1] + $matriksA[$i][0]*$matriksA[$i][1];
			}
			$temp[2] = 0;
			for ($i=0; $i < sizeof($term); $i++) { 
				$temp[2] = $temp[2] + $matriksA[$i][1]*$matriksA[$i][0];
			}
			$temp[3] = 0;
			for ($i=0; $i < sizeof($term); $i++) { 
				$temp[3] = $temp[3] + $matriksA[$i][1]*$matriksA[$i][1];
			}
			return $temp;
		}
		public function getPersamaan($temp){
			$val[0] = -$temp[0]-$temp[3];
			$val[1] = $temp[0]*$temp[3]-$temp[1]*$temp[2];
			return $val;
		}
		public function getEigenValue($temp){
			$ntengah = -$temp[0]-$temp[3];
			$blkg = $temp[0]*$temp[3]-$temp[1]*$temp[2];
			$lamda[0] = sqrt(pow($ntengah/2, 2)-$blkg)-$ntengah/2;
			$lamda[1] = sqrt(pow($ntengah/2, 2)-$blkg)+$ntengah/2;
			return $lamda;
		}
		public function getEigenVector($temp, $lamda){
			$eigenvec[0] = (1/($temp[0]-$lamda[0]))*$temp[1];
			$eigenvec[1] = (1/($temp[1]-$lamda[1]))*$temp[1];
			return $eigenvec;
		}
		public function getMatriksS($lamda){
			$matriksS[0] = sqrt(sqrt(pow($lamda[0], 2)));
			$matriksS[1] = sqrt(sqrt(pow($lamda[1], 2)));
			return $matriksS;
		}
		public function getMatriksSInvers($matriksS){
			$sInvers[0] = pow($matriksS[1], -1);
			$sInvers[1] = pow($matriksS[0], -1);
			return $sInvers;
		}
		public function getPanjangVector($eigenvec){
			$pVec[0] = sqrt(pow($eigenvec[0], 2)+1);
			$pVec[1] = sqrt(pow($eigenvec[1], 2)+1);
			return $pVec;
		}
		public function getMatriksV($eigenvec, $pVec){
			$matriksV[0][0] = $eigenvec[0]/$pVec[0];
			$matriksV[0][1] = 1/$pVec[0];
			$matriksV[1][0] = $eigenvec[1]/$pVec[1];
			$matriksV[1][1] = 1/$pVec[1];
			return $matriksV;
		}
		public function getMatriksU($term, $matriksA, $matriksV, $matriksSInvers){
			for ($i=0; $i < sizeof($term); $i++) {
				$matriksU[$i][0] = (($matriksA[$i][0]*$matriksV[0][0])+($matriksA[$i][1]*$matriksV[0][1]))*$matriksSInvers[0];
				$matriksU[$i][1] = (($matriksA[$i][0]*$matriksV[1][0])+($matriksA[$i][1]*$matriksV[1][1]))*$matriksSInvers[1];
			}
			return $matriksU;
		}
		public function getMatriksQ($term, $matriksA, $matriksU, $matriksSInvers){
			$q[0] = null;
			$q[1] = null;
			for ($i=0; $i < sizeof($term); $i++) { 
				// if($matriks[$i][0]!=0){
					$q[0] = $matriksA[$i][0]*$matriksU[$i][0]+$q[0];
					$q[1] = $matriksA[$i][1]*$matriksU[$i][1]+$q[1];
				// }
			}
			$q[0] = $q[0]*$matriksSInvers[0];
			$q[1] = $q[1]*$matriksSInvers[1];
			return $q;
		}
		public function getSimilarity($q, $matriksV){
			$sim[0] = ($q[0]*$matriksV[0][0]+$q[1]*$matriksV[1][0])/(sqrt(pow($q[0], 2)+pow($q[1], 2))*sqrt(pow($matriksV[0][0], 2)+pow($matriksV[1][0], 2)));
			$sim[1] = ($q[0]*$matriksV[0][1]+$q[1]*$matriksV[1][1])/(sqrt(pow($q[0], 2)+pow($q[1], 2))*sqrt(pow($matriksV[0][1], 2)+pow($matriksV[1][1], 2)));

			$sim[0] = sqrt(pow($sim[0], 2));
			$sim[1] = sqrt(pow($sim[1], 2));

			return $sim;
		}
	}
?>