<?php
if($_GET['id']){
	$filename = "uploads/laporan".$_GET['id'].".pdf";
	header("Content-type: application/pdf");
	header("Content-Length: " . filesize($filename));
	readfile($filename);
}
?>