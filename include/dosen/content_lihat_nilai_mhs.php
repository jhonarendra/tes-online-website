<?php
  include 'include/text-processing/LSI.php';
  $ceklsi = new LSI();
  $id_mhs = $_GET['id'];
  $nilai_mhs = mysqli_query($conn, "SELECT * FROM tb_jawaban_mhs INNER JOIN tb_mhs ON tb_mhs.`id_mhs`=tb_jawaban_mhs.`id_mhs` INNER JOIN tb_soal ON tb_soal.`id_soal`=tb_jawaban_mhs.`id_soal` WHERE tb_jawaban_mhs.`id_mhs` = $id_mhs ORDER BY nomor_soal");
  foreach ($nilai_mhs as $nilai) {
    $nama_mhs=$nilai['nama_mhs'];
  }

?>

<div class="card mb-3">
  <div class="card-header">
    <i class="fas fa-table"></i> Nilai <?php echo $nama_mhs?>
  </div>
  <div class="card-body">
    <div class="table-responsive">
      <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
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
          ?>
          <tr>
            <td><?php echo $nilai['nomor_soal']?></td>
            <td><?php echo $nilai['soal']?></td>
            <td><?php echo $nilai['jawaban_mhs']?></td>
            <td>
              <a href="#" data-toggle="modal" data-target="#nilaiModal<?php echo $nilai['nomor_soal'] ?>"class="btn btn-warning">
              <i class="fas fa-eye"></i>
            </a>  
            </td>
          </tr>
          <div class="modal fade" id="nilaiModal<?php echo $nilai['nomor_soal'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  
                  <h5 class="modal-title" id="exampleModalLabel">Kecocokan dengan mahasiswa lain</h5>
                  <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                  </button>
                </div>
                <div class="modal-body">
                  <?php
                    $id_soal = $nilai['id_soal'];
                    $query_lsi = $nilai['stem_jawaban_mhs'];
                    $mahasiswa_mengerjakan = mysqli_query($conn, "SELECT * FROM tb_jawaban_mhs INNER JOIN tb_mhs ON tb_jawaban_mhs.`id_mhs` = tb_mhs.`id_mhs` WHERE tb_jawaban_mhs.`id_mhs`!=$id_mhs AND tb_jawaban_mhs.`id_soal` = $id_soal");
                    $jml_mahasiswa_mengerjakan = mysqli_num_rows($mahasiswa_mengerjakan);
                    if ($jml_mahasiswa_mengerjakan==0) {
                      echo "Belum ada mahasiswa lain yang mengerjakan tugas ini";
                    } else {
                      foreach ($mahasiswa_mengerjakan as $mhs_lain) {
                        // echo $mhs_lain['nama_mhs']." ".$mhs_lain['stem_jawaban_mhs'];
                        $input_lsi = $mhs_lain['stem_jawaban_mhs'];
                        echo $mhs_lain['nama_mhs']." ".$ceklsi->runLSI($query_lsi, $input_lsi)."%<br />";
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