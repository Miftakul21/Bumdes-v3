<?php 
require_once '../../../setting/koneksi.php';

$stmt = $mysqli->prepare("UPDATE tb_akun  SET 
        nama_akun=?
		where kode_akun=?");
$stmt->bind_param("ss",
	$_POST['nama_akun'],
	$_POST['kode_akun']);	

if ($stmt->execute()) { 
	echo "<script>alert('Data akun Berhasil Diubah')</script>";
	echo "<script>window.location='../../index.php?hal=akun';</script>";	
} else {
	echo "<script>alert('Data akun Gagal Diubah')</script>";
	echo "<script>window.location='javascript:history.go(-1)';</script>";
}
?>