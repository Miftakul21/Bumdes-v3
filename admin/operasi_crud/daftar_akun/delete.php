<?php 
require_once '../../../setting/koneksi.php';

$stmt = $mysqli->prepare("DELETE FROM tb_akun where kode_akun=?");
	$stmt->bind_param("s",$_GET['hapus']); 

if ($stmt->execute()) { 
	echo "<script>alert('Data akun Berhasil Dihapus')</script>";
	echo "<script>window.location='../../index.php?hal=akun';</script>";	
} else {
	echo "<script>alert('Data akun Gagal Dihapus')</script>";
	echo "<script>window.location='javascript:history.go(-1)';</script>";
}
?>