<?php
require_once '../../../setting/koneksi.php';

$stmt = $mysqli->prepare("DELETE FROM tb_index where id_index=?");
$stmt->bind_param("s", $_GET['hapus']); 

if ($stmt->execute()) { 
	echo "<script>alert('Data index Berhasil Dihapus')</script>";
	echo "<script>window.location='../../index.php?hal=ind';</script>";	
} else {
	echo "<script>alert('Data index Gagal Dihapus')</script>";
	echo "<script>window.location='javascript:history.go(-1)';</script>";
}

?>
