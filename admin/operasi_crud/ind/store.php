<?php 
require_once '../../../setting/koneksi.php';

$stmt = $mysqli->prepare("INSERT INTO tb_index 
		(id_index,keterangan) 
		VALUES (?,?)");

$stmt->bind_param("ss", 
	$_POST['id_index'],
	$_POST['keterangan']);	

if ($stmt->execute()) { 
	$_SESSION['info'] = [
		'status' => 'success',
		'message' => 'Berhasil menambah data'
	];
    echo "<script>alert('Data index Berhasil Disimpan')</script>";
	echo "<script>window.location='../../index.php?hal=ind';</script>";	
} else {
	echo "<script>alert('Data index Gagal Disimpan, Duplikat Kode Index')</script>";
	echo "<script>window.location='javascript:history.go(-1)';</script>";
}

?>