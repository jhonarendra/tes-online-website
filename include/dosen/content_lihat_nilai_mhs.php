<?php
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
            <th>Kunci Jawaban</th>
            <th>Jawaban Mahasiswa</th>
            <th>Nilai Similarity</th>
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
            <td><?php echo $nilai['kunci_jawaban']?></td>
            <td><?php echo $nilai['jawaban_mhs']?></td>
            <td>
              <?php
                similar_text($nilai['kunci_jawaban'], $nilai['jawaban_mhs'], $percentage);
                echo $percentage;
              ?>
            </td>
            <td>
              <a class="btn btn-primary" href="javascript:void(o)">
                <i class="fas fa-pencil-alt"></i>
              </a>
            </td>
          </tr>
          <?php
            }
          ?>
        </tbody>
      </table>
    </div>
  </div>
</div>