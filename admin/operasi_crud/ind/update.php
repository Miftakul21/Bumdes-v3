<?php 
require_once '../../../setting/koneksi.php';

$stmt = $mysqli->prepare("UPDATE tb_index  SET 
	keterangan=?
	where id_index=?");
$stmt->bind_param("ss",
	$_POST['keterangan'],
	$_POST['id_index']);	

if ($stmt->execute()) { 
    echo "<script>alert('Data index Berhasil Diubah')</script>";
	echo "<script>window.location='../../index.php?hal=ind';</script>";	
} else {
	echo "<script>alert('Data index Gagal Diubah')</script>";
	echo "<script>window.location='javascript:history.go(-1)';</script>";
}
?>