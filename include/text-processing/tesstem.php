<?php
	include 'Stemming.php';

	$textproc = new Stemming();

	echo json_encode($textproc->stem('LSI lsi'));
?>