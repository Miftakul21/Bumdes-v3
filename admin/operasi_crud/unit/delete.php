<?php 
require_once '../../../setting/koneksi.php';

$stmt = $mysqli->prepare("DELETE FROM tb_unit where id_unit=?");
$stmt->bind_param("s",$_GET['hapus']); 

if ($stmt->execute()) { 
	echo "<script>alert('Data unit Berhasil Dihapus')</script>";
	echo "<script>window.location='../../index.php?hal=unit';</script>";	
} else {
	echo "<script>alert('Data unit Gagal Dihapus')</script>";
	echo "<script>window.location='javascript:history.go(-1)';</script>";
}

?>