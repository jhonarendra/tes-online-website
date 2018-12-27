<?php
  include 'include/text-processing/LSI.php';
  $ceklsi = new LSI();

	$id_ujian = $sluguri;
	$id_mhs = $slugurimhs;
	$id_soal = $slug7;
	$ujian = mysqli_query($conn, "SELECT * FROM tb_ujian WHERE id_ujian = $id_ujian");
	foreach ($ujian as $key) {
	  $nama_ujian = $key['nama_ujian'];
	}
	$nilai_mhs = mysqli_query($conn, "SELECT * FROM tb_jawaban_mhs INNER JOIN tb_mhs ON tb_mhs.`id_mhs`=tb_jawaban_mhs.`id_mhs` INNER JOIN tb_soal ON tb_soal.`id_soal`=tb_jawaban_mhs.`id_soal` WHERE tb_jawaban_mhs.`id_mhs` = $id_mhs AND id_ujian=$id_ujian AND tb_jawaban_mhs.`id_soal`=$id_soal ORDER BY nomor_soal");
	foreach ($nilai_mhs as $nilai) {
	  $nama_mhs=$nilai['nama_mhs'];
	}
?>
<style type="text/css">
  table td{
    padding: 5px 10px;
  }
</style>
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
      
      <div class="alert alert-success" role="alert">
        <h4 class="alert-heading">Jawaban <?php echo $nama_mhs ?></h4>
        <p><?php echo $nilai['jawaban_mhs'] ?></p>
      </div>
      <?php
        $jawaban_mhs_lain = mysqli_query($conn, "SELECT * FROM tb_jawaban_mhs INNER JOIN tb_mhs ON tb_jawaban_mhs.`id_mhs` = tb_mhs.`id_mhs` WHERE id_soal = $id_soal AND tb_mhs.`id_mhs` != $id_mhs");
        foreach ($jawaban_mhs_lain as $jawabannya) {
      ?>
      <h4 class="page-title" style="margin-bottom: 10px">Similarity Jawaban <?php echo $jawabannya['nama_mhs']?></h4>
      <div class="panel">
        <div class="panel-body">
          <div class="row">
            <div class="col-md-12" style="margin-bottom: 20px">
              <h4>Jawaban</h4>
              <?php echo $jawabannya['jawaban_mhs']?>
            </div>
            <div class="col-md-6">
              <b>LSI</b><br />
              <?php
                $query = $nilai['stem_jawaban_mhs'];
                $input = $jawabannya['stem_jawaban_mhs'];
                $query = explode(" ", $query);
                $input = explode(" ", $input);
                $query = array_slice($query, 1, sizeof($query));
                $input = array_slice($input, 1, sizeof($input));
                echo "Query<br />";
                foreach ($query as $key) {
                  echo $key.", ";
                }
                echo "<br /><br />";
                echo "Input<br />";
                foreach ($input as $key) {
                  echo $key.", ";
                }
                echo "<br /><br />";
                $semua_term = $ceklsi->getTerm($query, $input);
                echo "Semua Term<br />";
                foreach ($semua_term as $key) {
                  echo $key.", ";
                }
                echo "<br /><br />";
                $matriksA = $ceklsi->matriksA($semua_term, $query, $input);
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
                $temp = $ceklsi->matAxmatAT($matriksA, $semua_term);

                if($temp[1] == 0){
                  echo "<div class='alert alert-danger alert-dismissible' role='alert'>
                    <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
                    <i class='fa fa-times-circle'></i> Karena ada 0 pada Matriks, pasti tidak ada kesamaan antara query dan input. Jika ada 0 juga tidak bisa menghitung Eigen Value karena error division by zero
                  </div>";
                }
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
                $val = $ceklsi->getPersamaan($temp);
                echo "x^2 + (".$val[0]."x) + (".$val[1].")<br />";

                if($val[1]==0){
                  echo "<div class='alert alert-danger alert-dismissible' role='alert'>
                    <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
                    <i class='fa fa-times-circle'></i> Kedua term antara query dan input sama, dipastikan jawabannya sama. Untuk menghindari 0 pada eigenvalue, langsung diberikan nilai 100%
                  </div>";
                }

                echo "<br /><br />Eigen value:<br />";

                $lamda = $ceklsi->getEigenValue($temp);
                echo "x1 = ".$lamda[0]."<br />";
                echo "x2 = ".$lamda[1]."<br />";

                echo "<br />Eigenvector:<br />";
                $eigenvector = $ceklsi->getEigenVector($temp, $lamda);
                echo "v1: ".$eigenvector[0]."<br />";
                echo "v2: ".$eigenvector[1]."<br />";

                echo "<br />Matriks S:<br />";
                $matriksS = $ceklsi->getMatriksS($lamda);
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
                $sInvers = $ceklsi->getMatriksSInvers($matriksS);
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
                $pVec = $ceklsi->getPanjangVector($eigenvector);
                echo "|v1| = ".$pVec[0]."<br />";
                echo "|v2| = ".$pVec[1]."<br />";

                echo "<br />Matriks V Transpos<br />";
                $matriksV = $ceklsi->getMatriksV($eigenvector, $pVec);
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
                $matriksU = $ceklsi->getMatriksU($semua_term, $matriksA, $matriksV, $sInvers);
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
                $matriksQ = $ceklsi->getMatriksQ($semua_term, $matriksA, $matriksU, $sInvers);
              ?>
                <table border="1">
                  <tr>
                    <td><?php echo $matriksQ[0] ?></td>
                    <td><?php echo $matriksQ[1] ?></td>
                  </tr>
                </table>
              <?php

                echo "<br />Similarity<br />";
                $similarity = $ceklsi->getSimilarity($matriksQ, $matriksV);
                echo "sim(q,d1) = ".$similarity[0]."<br />";
                echo "sim(q,d2) = ".$similarity[1];
              ?>
            </div>





            <div class="col-md-6">
              <b>Jaccard</b><br />
              <?php
                $query = $nilai['stem_jawaban_mhs'];
                $input = $jawabannya['stem_jawaban_mhs'];
                $query = explode(" ", $query);
                $input = explode(" ", $input);
                $query = array_slice($query, 1, sizeof($query));
                $input = array_slice($input, 1, sizeof($input));
                echo "Query<br />";
                foreach ($query as $key) {
                  echo $key.", ";
                }
                echo "<br /><br />";
                echo "Input<br />";
                foreach ($input as $key) {
                  echo $key.", ";
                }
                echo "<br /><br />";
                $semua_term = $ceklsi->getTerm($query, $input);
                echo "Semua Term<br />";
                foreach ($semua_term as $key) {
                  echo $key.", ";
                }
                echo "<br /><br />";
                $matriksA = $ceklsi->matriksA($semua_term, $query, $input);
              echo "Term<br />";
                ?>
                  <table border="1">
                    <tr>
                      <td></td>
                      <td>Query</td>
                      <td>Input</td>
                      <td>Irisan</td>
                    </tr>
                <?php
                  $irisan = 0;
                  for ($i=0; $i < sizeof($semua_term); $i++) {
                ?>
                    <tr>
                      <td><?php echo $semua_term[$i];?></td>
                      <td><?php echo $matriksA[$i][0];?></td>
                      <td><?php echo $matriksA[$i][1];?></td>
                <?php
                    if($matriksA[$i][0]!=0 && $matriksA[$i][1]!=0){
                ?>
                      <td>1</td>
                <?php
                      $irisan++;
                    } else {
                ?>
                      <td>0</td>
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

                  $union = count($semua_term);

                  echo "Query irisan Input = ".$irisan."<br />Query union Input = ".$union;
                  echo "<br /><br />";

                  echo "Similarity = ".$irisan."/".$union;
                  $sim = $irisan/$union;
                  $sim_percent = $sim*100;
                  echo " = ".$sim." = ".$sim_percent."%";



              ?>
            </div>
          </div>
        </div>
      </div>
      <?php          
        }
      ?>
    </div>
  </div>
</div>