<?php
  include 'include/text-processing/LSI.php';
  $ceklsi = new LSI();
  $id_mhs = $slugurimhs;
  $id_ujian = $sluguri;
  $ujian = mysqli_query($conn, "SELECT * FROM tb_ujian WHERE id_ujian = $id_ujian");
  foreach ($ujian as $key) {
    $nama_ujian = $key['nama_ujian'];
  }
  $nilai_mhs = mysqli_query($conn, "SELECT * FROM tb_jawaban_mhs INNER JOIN tb_mhs ON tb_mhs.`id_mhs`=tb_jawaban_mhs.`id_mhs` INNER JOIN tb_soal ON tb_soal.`id_soal`=tb_jawaban_mhs.`id_soal` WHERE tb_jawaban_mhs.`id_mhs` = $id_mhs AND id_ujian=$id_ujian ORDER BY nomor_soal");
  foreach ($nilai_mhs as $nilai) {
    $nama_mhs=$nilai['nama_mhs'];
  }

?>
<div class="main">
  <!-- MAIN CONTENT -->
  <div class="main-content">
    <div class="container-fluid">
      <nav aria-label="breadcrumb" role="navigation">
        <ol class="breadcrumb" style="background:#fff">
          <li class="breadcrumb-item"><a href="<?php echo $web_url?>dosen">Dashboard</a></li>
          <li class="breadcrumb-item"><a href="<?php echo $web_url."dosen/".$id_ujian?>"><?php echo $nama_ujian;?></a></li>
          <li class="breadcrumb-item active"><a href="<?php echo $web_url."dosen/".$id_ujian."/lihat-nilai"?>">Nilai Mahasiswa</a></li>
          <li class="breadcrumb-item active" aria-current="page"><?php echo $nama_mhs ?></li>
        </ol>
      </nav>
      <h3 class="page-title">Nilai Mahasiswa</h3>
      <div class="panel">
        <div class="panel-body">
          <table class="table " id="dataTable" width="100%" cellspacing="0">
            <thead>
              <tr>
                <th>No</th>
                <th>Soal</th>
                <th>Jawaban Mahasiswa</th>
                <th>Aksi</th>
              </tr>
            </thead>
            <tbody>
              <?php
                foreach ($nilai_mhs as $nilai) {
                  $id_soal = $nilai['id_soal'];
              ?>
              <tr>
                <td><?php echo $nilai['nomor_soal']?></td>
                <td><?php echo $nilai['soal']?></td>
                <td><?php echo $nilai['jawaban_mhs']?></td>
                <td>
                  <a title="Lihat Similarity Jawaban" href="#" data-toggle="modal" data-target="#nilaiModal<?php echo $nilai['nomor_soal'] ?>"class="btn btn-warning">
                    <i class="fa fa-eye"></i>
                  </a>
                  <a title="Lihat Perhitungan" href="<?php echo $web_url."dosen/"."$id_ujian"."/lihat-nilai/".$id_mhs."/perhitungan/".$id_soal;?>" class="btn btn-primary">
                    <i class="fa fa-calculator"></i>
                  </a>
                </td>
              </tr>
              <div class="modal fade" id="nilaiModal<?php echo $nilai['nomor_soal'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                      </button>
                      <h3 class="modal-title" id="exampleModalLabel">Kecocokan dengan mahasiswa lain</h3>
                    </div>
                    <div class="modal-body">
                      <div class="row">
                        <div class="col-md-8">
                          <b>Nama Mahasiswa</b>
                        </div>
                        <div class="col-md-2">
                          <b>LSI</b>
                        </div>
                        <div class="col-md-2">
                          <b>Jaccard</b>
                        </div>
                      </div>
                      <?php
                        $query_lsi = $nilai['stem_jawaban_mhs'];
                        $mahasiswa_mengerjakan = mysqli_query($conn, "SELECT * FROM tb_jawaban_mhs INNER JOIN tb_mhs ON tb_jawaban_mhs.`id_mhs` = tb_mhs.`id_mhs` WHERE tb_jawaban_mhs.`id_mhs`!=$id_mhs AND tb_jawaban_mhs.`id_soal` = $id_soal");
                        $jml_mahasiswa_mengerjakan = mysqli_num_rows($mahasiswa_mengerjakan);
                        if ($jml_mahasiswa_mengerjakan==0) {
                          echo "Belum ada mahasiswa lain yang mengerjakan tugas ini";
                        } else {
                          foreach ($mahasiswa_mengerjakan as $mhs_lain) {
                            // echo $mhs_lain['nama_mhs']." ".$mhs_lain['stem_jawaban_mhs'];
                            $input_lsi = $mhs_lain['stem_jawaban_mhs'];

                            /*
                            * JACCARD
                            */
                            $query = explode(" ", $query_lsi);
                            $input = explode(" ", $input_lsi);

                            $query = array_slice($query, 1, sizeof($query));
                            $input = array_slice($input, 1, sizeof($input));

                            $semua_term = $ceklsi->getTerm($query, $input);

                            $union = count($semua_term);
                            $matriksA = $ceklsi->matriksA($semua_term, $query, $input);
                            $irisan = 0;
                            for ($i=0; $i < sizeof($semua_term); $i++) {
                              if($matriksA[$i][0]!=0 && $matriksA[$i][1]!=0){
                                $irisan++;
                              }
                            }
                            $sim = $irisan/$union;
                            $sim_percent = $sim*100;
                          ?>
                            <div class="row">
                              <div class="col-md-8">
                                <?php echo $mhs_lain['nama_mhs']?>
                              </div>
                              <div class="col-md-2">
                                <?php echo $ceklsi->runLSI($query_lsi, $input_lsi)."%";?>
                              </div>
                              <div class="col-md-2">
                                <?php echo substr($sim_percent, 0, 4)."%";?>
                              </div>
                            </div>
                          <?php
                          }
                        }
                      ?>
                    </div>
                    <div class="modal-footer">
                      <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    </div>
                  </div>
                </div>
              </div>
              <?php
                }
              ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>