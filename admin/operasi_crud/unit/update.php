<?php 
require_once '../../../setting/koneksi.php';

$stmt = $mysqli->prepare("UPDATE tb_unit  SET 
		nama_unit=?
		where id_unit=?");
$stmt->bind_param("ss",
		$_POST['nama_unit'],
		$_POST['kode']);	

if ($stmt->execute()) { 
	echo "<script>alert('Data unit Berhasil Diubah')</script>";
	echo "<script>window.location='../../index.php?hal=unit';</script>";	
} else {
	echo "<script>alert('Data unit Gagal Diubah')</script>";
	echo "<script>window.location='javascript:history.go(-1)';</script>";
}
?>