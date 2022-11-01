<?php
require_once '../setting/crud.php';
require_once '../setting/koneksi.php';
require_once '../setting/tanggal.php';
require_once '../setting/fungsi.php';

if(isset($_POST['tambah']))
{	
	$stmt = $mysqli->prepare("INSERT INTO tb_index 
		(id_index,keterangan) 
		VALUES (?,?)");

	$stmt->bind_param("ss", 
		$_POST['id_index'],
		$_POST['keterangan']);	

	if ($stmt->execute()) { 
		// echo "<script>alert('Data index Berhasil Disimpan')</script>";
		// echo "<script>window.location='index.php?hal=ind';</script>";	
		$_SESSION['info'] = [
			'status' => 'success',
			'message' => 'Berhasil menambah data'
		];
		header('Location:index.php?hal=ind');
	} else {
		echo "<script>alert('Data index Gagal Disimpan, Duplikat Kode Index')</script>";
		echo "<script>window.location='javascript:history.go(-1)';</script>";
	}

}else if(isset($_POST['ubah'])){

//Proses ubah data
	$stmt = $mysqli->prepare("UPDATE tb_index  SET 
		keterangan=?
		where id_index=?");
	$stmt->bind_param("ss",
		$_POST['keterangan'],
		$_POST['id_index']);	

	if ($stmt->execute()) { 
		echo "<script>alert('Data index Berhasil Diubah')</script>";
		echo "<script>window.location='index.php?hal=ind';</script>";	
	} else {
		echo "<script>alert('Data index Gagal Diubah')</script>";
		echo "<script>window.location='javascript:history.go(-1)';</script>";
	}

}else if(isset($_GET['hapus'])){

	//Proses hapus
	$stmt = $mysqli->prepare("DELETE FROM tb_index where id_index=?");
	$stmt->bind_param("s", $_GET['hapus']); 

	if ($stmt->execute()) { 
		echo "<script>alert('Data index Berhasil Dihapus')</script>";
		echo "<script>window.location='index.php?hal=ind';</script>";	
	} else {
		echo "<script>alert('Data index Gagal Dihapus')</script>";
		echo "<script>window.location='javascript:history.go(-1)';</script>";
	}

}
?>