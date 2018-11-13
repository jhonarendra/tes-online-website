<?php
	include 'LSI.php';


	$query = " metode information retrieval basis vektor gvsm ls neural network metode ls ls metode ir basis vektor ukur similarity mirip dokumen teks buat matriks term data kali matriks vektor transpos dapat matriks hitung eigenvalue eigenvector dapat eigenvalue eigenvector jadi matriks normalisasi rumus kalian matriks eigen matriks kali matriks vector query dapat nilai similarity";
	$input = " ls metode information retrieval basis vektor ls latent mantic indexing sama eigen mirip antar dokumen vector kali vector query banding dokumen";

	$query = explode(" ", $query);
	$input = explode(" ", $input);

	echo "Query<br />".json_encode($query)."<br /><br />";
	echo "Input<br />".json_encode($input)."<br /><br />";

	$lsi = new LSI();
	$semua_term = $lsi->getTerm($query, $input);
	echo "Semua term<br />".json_encode($semua_term)."<br /><br />";

	$matriksA = $lsi->matriksA($semua_term, $query, $input);
	echo "Matriks A<br />";
?>
	<table border="1">
		<tr>
			<td></td>
			<td>Query</td>
			<td>Input</td>
		</tr>
<?php
	for ($i=0; $i < sizeof($semua_term); $i++) {
?>
		<tr>
			<td><?php echo $semua_term[$i];?></td>
<?php
		foreach ($matriksA[$i] as $key) {
?>
			<td><?php echo $key;?></td>
<?php
		}
?>
		</tr>			
<?php
	}
?>
	</table>
<?php
	echo "<br /><br />";

	echo "Matriks A dikali matriks A Transpos<br />";
	$temp = $lsi->matAxmatAT($matriksA, $semua_term);
?>
	<table border="1">
		<tr>
			<td><?php echo $temp[0]?></td>
			<td><?php echo $temp[1]?></td>
		</tr>
		<tr>
			<td><?php echo $temp[2]?></td>
			<td><?php echo $temp[3]?></td>
		</tr>
	</table>
<?php
	echo "<br /><br />";

	echo "Didapatkan persamaan seperti ini:<br />";
	$val = $lsi->getPersamaan($temp);
	echo "x^2 + (".$val[0]."x) + (".$val[1].")";

	echo "<br /><br />Eigen value:<br />";

	$lamda = $lsi->getEigenValue($temp);
	echo "x1 = ".$lamda[0]."<br />";
	echo "x2 = ".$lamda[1]."<br />";

	echo "<br />Eigenvector:<br />";
	$eigenvector = $lsi->getEigenVector($temp, $lamda);
	echo "v1: ".$eigenvector[0]."<br />";
	echo "v2: ".$eigenvector[1]."<br />";

	echo "<br />Matriks S:<br />";
	$matriksS = $lsi->getMatriksS($lamda);
?>
	<table border="1">
		<tr>
			<td><?php echo $matriksS[0];?></td>
			<td>0</td>
		</tr>
		<tr>
			<td>0</td>
			<td><?php echo $matriksS[1];?></td>
		</tr>
	</table>
<?php
	echo "<br />Matriks S Invers:<br />";
	$sInvers = $lsi->getMatriksSInvers($matriksS);
?>
	<table border="1">
		<tr>
			<td><?php echo $sInvers[0];?></td>
			<td>0</td>
		</tr>
		<tr>
			<td>0</td>
			<td><?php echo $sInvers[1];?></td>
		</tr>
	</table>
<?php
	echo "<br />Panjang Vector:<br />";
	$pVec = $lsi->getPanjangVector($eigenvector);
	echo "|v1| = ".$pVec[0]."<br />";
	echo "|v2| = ".$pVec[1]."<br />";

	echo "<br />Matriks V Transpos<br />";
	$matriksV = $lsi->getMatriksV($eigenvector, $pVec);
?>
	<table border="1">
		<tr>
			<td><?php echo $matriksV[0][0];?></td>
			<td><?php echo $matriksV[0][1];?></td>
		</tr>
		<tr>
			<td><?php echo $matriksV[1][0];?></td>
			<td><?php echo $matriksV[1][1];?></td>
		</tr>
	</table>
<?php
	echo "<br />Matriks V<br />";
?>
	<table border="1">
		<tr>
			<td><?php echo $matriksV[0][0];?></td>
			<td><?php echo $matriksV[1][0];?></td>
		</tr>
		<tr>
			<td><?php echo $matriksV[0][1];?></td>
			<td><?php echo $matriksV[1][1];?></td>
		</tr>
	</table>
<?php

	echo "<br />Matriks U<br />";
	$matriksU = $lsi->getMatriksU($semua_term, $matriksA, $matriksV, $sInvers);
?>
	<table border="1">	
<?php
	for ($i=0; $i < sizeof($semua_term); $i++) {
?>
	<tr>
		<td><?php echo $matriksU[$i][0]; ?></td>
		<td><?php echo $matriksU[$i][1]; ?></td>
	</tr>
<?php
	}
?>
	</table>
<?php
	echo "<br />Query<br />";
?>
	<table border="1">
		<tr>
<?php
	for ($i=0; $i < sizeof($semua_term); $i++) {
?>
			<td><?php echo $matriksA[$i][0] ?></td>
<?php
	}
?>
		</tr>
	</table>
<?php
	echo "<br />Matriks Query<br />";
	$matriksQ = $lsi->getMatriksQ($semua_term, $matriksA, $matriksU, $sInvers);
?>
	<table border="1">
		<tr>
			<td><?php echo $matriksQ[0] ?></td>
			<td><?php echo $matriksQ[1] ?></td>
		</tr>
	</table>
<?php

	echo "<br />Similarity<br />";
	$similarity = $lsi->getSimilarity($matriksQ, $matriksV);
	echo "sim(q,d1) = ".$similarity[0]."<br />";
	echo "sim(q,d2) = ".$similarity[1];












?>