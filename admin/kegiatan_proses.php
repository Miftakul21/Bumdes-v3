<?php
require_once '../setting/crud.php';
require_once '../setting/koneksi.php';
require_once '../setting/tanggal.php';
require_once '../setting/fungsi.php';

if(isset($_POST['tambah']))
{	
//Proses penambahan index
	$stmt = $mysqli->prepare("INSERT INTO tb_kegiatan 
		(id_unit,nama_kegiatan) 
		VALUES (?,?)");

	$stmt->bind_param("ss", 
		$_POST['id_unit'],
		$_POST['nama_kegiatan']);	

	if ($stmt->execute()) { 
		echo "<script>alert('Data Kegiatan Unit Berhasil Disimpan')</script>";
		echo "<script>window.location='index.php?hal=kegiatan';</script>";	
	} else {
		echo "<script>alert('Data Kegiatan Unit Gagal Disimpan')</script>";
		echo "<script>window.location='javascript:history.go(-1)';</script>";
	}

}else if(isset($_POST['ubah'])){

//Proses ubah data
	$stmt = $mysqli->prepare("UPDATE tb_kegiatan  SET 
		id_unit=?,
		nama_kegiatan=?
		where id_kegiatan=?");
	$stmt->bind_param("sss",
		$_POST['id_unit'],
		$_POST['nama_kegiatan'],
		$_POST['id_kegiatan']);	

	if ($stmt->execute()) { 
		echo "<script>alert('Data Kegiatan Unit Berhasil Diubah')</script>";
		echo "<script>window.location='index.php?hal=kegiatan';</script>";	
	} else {
		echo "<script>alert('Data Kegiatan Unit Gagal Diubah')</script>";
		echo "<script>window.location='javascript:history.go(-1)';</script>";
	}

}else if(isset($_GET['hapus'])){
	$stmt = $mysqli->prepare("DELETE FROM tb_kegiatan where id_kegiatan=?");
	$stmt->bind_param("s",$_GET['hapus']); 

	if ($stmt->execute()) { 
		echo "<script>alert('Data Kegiatan Unit Berhasil Dihapus')</script>";
		echo "<script>window.location='index.php?hal=kegiatan';</script>";	
	} else {
		echo "<script>alert('Data Kegiatan Unit Gagal Dihapus')</script>";
		echo "<script>window.location='javascript:history.go(-1)';</script>";
	}
}
?>