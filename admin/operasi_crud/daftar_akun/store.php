<?php
require_once '../../../setting/koneksi.php';
session_start();

$stmt = $mysqli->prepare("INSERT INTO tb_akun 
	(kode_akun,nama_akun) 
	VALUES (?,?)");

$stmt->bind_param("ss", 
	$_POST['kode_akun'],
	$_POST['nama_akun']);	

if ($stmt->execute()) { 
	$_SESSION['success'] = "Data akun Berhasil Disimpan";
	echo "<script>window.location='../../index.php?hal=akun';</script>";	
} else {
	$_SESSION['gagal'] = "Data akun Gagal Disimpan";
	echo "<script>window.location='javascript:history.go(-1)';</script>";
}

?>