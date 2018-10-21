<?php
//   $id_mhs = $_GET['id'];
  $ujian = mysqli_query($conn, "SELECT tb_ujian.* , tb_dosen.`nama_dosen` FROM tb_ujian INNER JOIN tb_dosen ON tb_dosen.`id_dosen`=tb_ujian.`id_dosen`");
  $i=1; 
  foreach ($ujian as $nilai) {
    $nama_mhs=$nilai;
  }

?>
<div class="card mb-3">
	<div class="card-header">
		<i class="fas fa-table"></i>Dashboard
	</div>
	<div class="card-body">
		<p>This is dashboard</p>
		<table class="table">
        <thead>
            <tr>
				<th scope="col">No</th>
				<th scope="col">Nama Ujian</th>
				<th scope="col">Tanggal Mulai</th>
				<th scope="col">Tanggal Akhir</th>
				<th scope="col">Dosen</th>
				<th scope="col">Aksi</th>
            </tr>
        </thead>
		<?php
            foreach ($ujian as $nilai) {
          ?>		
        <tbody>
            <tr>
				<td><?php echo $i?></td>
				<td><?php echo $nilai['nama_ujian']?></td>
				<td><?php echo $nilai['tgl_buat_ujian']?></td>
				<td><?php echo $nilai['tgl_selesai_ujian']?></td>
				<td><?php echo $nilai['nama_dosen']?></td>
				<td>
					<div class="btn-group" role="group" aria-label="Basic example">
						<a class="btn btn-primary" href="javascript:void(o)">
							<i class="fas fa-pencil-alt"></i>
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
	<div class="card-footer small text-muted">Updated yesterday at 11:59 PM</div>
</div>