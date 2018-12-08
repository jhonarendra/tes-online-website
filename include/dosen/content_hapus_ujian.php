<?php
	$id_ujian = $_GET['id_ujian'];
	$delete_ujian = mysqli_query($conn, "UPDATE tb_ujian SET status_ujian = 'Dihapus' WHERE id_ujian = $id_ujian");
	header("Location: dosen?page=ujian")
?>