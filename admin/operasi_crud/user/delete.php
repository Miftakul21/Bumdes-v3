<?php
require_once '../../../setting/koneksi.php';

if(isset($_GET['hapus'])){
	$stmt = $mysqli->prepare("DELETE FROM tb_user where id_user=?");
	$stmt->bind_param("s",$_GET['hapus']); 
	
	if ($stmt->execute()) { 
		echo "<script>alert('Data user Berhasil Dihapus')</script>";
		echo "<script>window.location='../../index.php?hal=user';</script>";	
	} else {
		echo "<script>alert('Data user Gagal Dihapus')</script>";
		echo "<script>window.location='javascript:history.go(-1)';</script>";
	}
}
?>