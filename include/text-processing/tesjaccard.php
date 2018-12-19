<fieldset>
	<legend>Input</legend>
	<form action="" method="POST">
		<textarea name="query" style="width: 100%" rows="10">query</textarea>
		<textarea name="input" style="width: 100%" rows="10">input</textarea><br />
		<input type="submit" value="Cek Similarity">
	</form>
</fieldset>
<?php
	include 'LSI.php';
	include 'Stemming.php';

	if (!isset($_POST['query'])) {
		$query = "Metode dalam information retrieval yang berbasis vektor ada GVSM, LSI dan Neural Network. Saya akan menjelaskan metode LSI. LSI adalah metode IR berbasis vektor yang dapat mengukur similarity atau kemiripan dari suatu dokumen teks. Pertama, dibuatkan matriks A yang merupakan semua term dari semua data. Setelah itu dikalikan dengan matriks vektor A Transpos. Didapat sebuah matriks untuk dihitung eigenvalue dan eigenvector. Setelah didapat eigenvalue dan eigenvector, dijadikan matriks dan dinormalisasi menggunakan rumus. Terakhir, hasil perkalian matriks eigen dengan matriks A, dikali dengan matriks vector query sehingga didapat nilai similarity.";
		$input = "LSI adalah metode information retrieval berbasis vektor. LSI atau latent semantic indexing menggunakan persamaan eigen untuk mencari kemiripan antar dokumen. Nanti vector akan dikalikan dengan vector query untuk dibandingkan dengan dokumen lain. GVSM";
	} else {
		$query = $_POST['query'];
		$input = $_POST['input'];
	}

	echo "Query<br />".$query."<br /><br />";
	echo "Input<br />".$input."<br /><br />";

	$lsi = new LSI();
	$textproc = new Stemming();

	$query = $textproc->stem($query);
	$input = $textproc->stem($input);

	$queries = '';
	foreach ($query as $key) {
		$queries = $queries." ".$key;
	}
	$inputs = '';
	foreach ($input as $key) {
		$inputs = $inputs." ".$key;
	}

	$semua_term = $lsi->getTerm($query, $input);
	$union = count($semua_term);

	$similarity_langsung = $lsi->runLSI($queries, $inputs);
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
		$irisan = 0;
		for ($i=0; $i < sizeof($semua_term); $i++) {
	?>
			<tr>
				<td><?php echo $semua_term[$i];?></td>
				<td><?php echo $matriksA[$i][0];?></td>
				<td><?php echo $matriksA[$i][1];?></td>
			</tr>			
	<?php
			if($matriksA[$i][0]!=0 && $matriksA[$i][1]!=0){
				$irisan++;
			}
		}
	?>
		</table>
	<?php
		echo "<br /><br />";



		echo "Query irisan Input = ".$irisan."<br />Query union Input = ".$union;
		echo "<br /><br />";

		echo "Similarity = ".$irisan."/".$union;
		$sim = $irisan/$union;
		$sim_percent = $sim*100;
		echo " = ".$sim." = ".$sim_percent."%";



?>