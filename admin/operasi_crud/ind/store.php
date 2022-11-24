<?php 
require_once '../../../setting/koneksi.php';
session_start();

$stmt = $mysqli->prepare("INSERT INTO tb_index 
		(id_index,keterangan) 
		VALUES (?,?)");

$stmt->bind_param("ss", 
	$_POST['id_index'],
	$_POST['keterangan']);	

if ($stmt->execute()) { 
	$_SESSION['success'] = "Data sumber dana Berhasil Disimpan";
	echo "<script>window.location='../../index.php?hal=ind';</script>";	
} else {
	$_SESSION['gagal'] = "Data sumber dana Gagal Disimpan";
	echo "<script>window.location='javascript:history.go(-1)';</script>";
}

?>