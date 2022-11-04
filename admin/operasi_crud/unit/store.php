<?php 
require_once '../../../setting/koneksi.php';

$stmt = $mysqli->prepare("INSERT INTO tb_unit 
		(nama_unit) 
		VALUES (?)");

	$stmt->bind_param("s", 
		$_POST['nama_unit']);	

if ($stmt->execute()) { 
	echo "<script>alert('Data unit Berhasil Disimpan')</script>";
	echo "<script>window.location='../../index.php?hal=unit';</script>";	
} else {
	echo "<script>alert('Data unit Gagal Disimpan')</script>";
	echo "<script>window.location='javascript:history.go(-1)';</script>";
}



?>