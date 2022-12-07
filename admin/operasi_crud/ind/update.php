<?php 
require_once '../../../setting/koneksi.php';

$stmt = $mysqli->prepare("UPDATE tb_index  SET 
	keterangan=?
	where id_index=?");
$stmt->bind_param("ss",
	$_POST['keterangan'],
	$_POST['id_index']);	

if ($stmt->execute()) { 
	$_SESSION['success'] = 'Data sumber Dana Berhasil DiUbah';
	echo "<script>window.location='../../index.php?hal=ind';</script>";	
} else {
	$_SESSION['success'] = 'Data sumber Dana Gagal DiUbah';
	echo "<script>window.location='javascript:history.go(-1)';</script>";
}
?>