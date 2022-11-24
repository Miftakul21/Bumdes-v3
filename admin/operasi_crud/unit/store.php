<?php 
require_once '../../../setting/koneksi.php';
session_start();

$stmt = $mysqli->prepare("INSERT INTO tb_unit 
		(nama_unit) 
		VALUES (?)");

	$stmt->bind_param("s", 
		$_POST['nama_unit']);	

if ($stmt->execute()) { 
	$_SESSION['success'] = "Data unit Berhasil Disimpan";
	echo "<script>window.location='../../index.php?hal=unit';</script>";	
} else {
	$_SESSION['gagal'] = "Data unit Gagal Disimpan";
	echo "<script>window.location='javascript:history.go(-1)';</script>";
}



?>