<?php 
require_once '../../../setting/koneksi.php';
session_start();

$stmt = $mysqli->prepare("UPDATE tb_unit  SET 
		nama_unit=?
		where id_unit=?");
$stmt->bind_param("ss",
		$_POST['nama_unit'],
		$_POST['kode']);	

if ($stmt->execute()) { 
	$_SESSION['success'] = 'Data unit Berhasil Diubah';
	echo "<script>window.location='../../index.php?hal=unit';</script>";	
} else {
	$_SESSION['gagal'] = 'Data unit Gagal Diubah';
	echo "<script>window.location='javascript:history.go(-1)';</script>";
}
?>