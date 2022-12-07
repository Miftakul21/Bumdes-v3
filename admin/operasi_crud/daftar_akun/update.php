<?php 
require_once '../../../setting/koneksi.php';
session_start();

$stmt = $mysqli->prepare("UPDATE tb_akun  SET 
        nama_akun=?
		where kode_akun=?");
$stmt->bind_param("ss",
	$_POST['nama_akun'],
	$_POST['kode_akun']);	

if ($stmt->execute()) { 
	$_SESSION['success'] = 'Data akun Berhasil Diubah';
	echo "<script>window.location='../../index.php?hal=akun';</script>";	
} else {
	$_SESSION['gagal'] = 'Data akun Gagal Diubah';
	echo "<script>window.location='javascript:history.go(-1)';</script>";
}
?>