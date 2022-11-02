<?php
require_once '../../../setting/koneksi.php';

$stmt = $mysqli->prepare("INSERT INTO tb_akun 
	(kode_akun,nama_akun) 
	VALUES (?,?)");

$stmt->bind_param("ss", 
	$_POST['kode_akun'],
	$_POST['nama_akun']);	

if ($stmt->execute()) { 
	echo "<script>alert('Data akun Berhasil Disimpan')</script>";
	echo "<script>window.location='../../index.php?hal=akun';</script>";	
} else {
	echo "<script>alert('Data akun Gagal Disimpan, Kode Akun sudah ada')</script>";
	echo "<script>window.location='javascript:history.go(-1)';</script>";
}

?>