<?php
  $id_mhs = $_SESSION['id_mhs'];
  $nilai_mhs = mysqli_query($conn, "SELECT tb_nilai_mhs.* , tb_mhs.`nama_mhs` , tb_ujian.`nama_ujian`  ,tb_ujian.`tgl_buat_ujian` FROM tb_nilai_mhs INNER JOIN tb_mhs ON tb_mhs.`id_mhs` = tb_nilai_mhs.`id_mhs` INNER JOIN tb_ujian ON tb_ujian.`id_ujian` = tb_nilai_mhs.`id_ujian` WHERE tb_nilai_mhs.id_mhs=$id_mhs");
  $i=1; 
  ?>

<div class="card mb-3">
	<div class="card-header">
		<i class="fas fa-table"></i>Dashboard
	</div>
	<div class="card-body">
    <table class="table">
        <thead>
            <tr>
                <th scope="col">No.</th>
                <th scope="col">Nama Ujian</th>
                <th scope="col">Tanggal Ujian</th>                
                <th scope="col">Nilai</th>
                <th scope="col">Lihat</th>
            </tr>
        </thead>
        <tbody>
        <?php
            foreach ($nilai_mhs as $nilai) {
          ?>        
            <tr>
                <td><?php echo $i?></td>
                <td><?php echo $nilai['nama_ujian']?></td>
                <td><?php echo $nilai['tgl_buat_ujian']?></td>                
                <td><?php echo $nilai['nilai_mhs']?></td>
                <td>
                <div class="btn-group" role="group" aria-label="Basic example">
                    <a class="btn btn-primary" href="javascript:void(o)">
                        <i class="fas fa-file-alt"></i>
                        Lihat
                    </a>						
                </div>	
                </td>
            </tr>
            <?php
            $i++;
            }
          ?>            
        </tbody>
    </table>
	</div>
	<div class="card-footer small text-muted">Latent Semantic Index | Tes Online 2018</div>
</div>