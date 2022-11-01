<?php
require_once '../setting/crud.php';
require_once '../setting/koneksi.php';
require_once '../setting/tanggal.php';
require_once '../setting/fungsi.php';

if(isset($_POST['tambah']))
{	
//Proses penambahan index
	$password=$_POST['password'];
	$uppercase = preg_match('@[A-Z]@', $password);
	$lowercase = preg_match('@[a-z]@', $password);
	$number    = preg_match('@[0-9]@', $password);
	if(!$uppercase || !$lowercase || !$number || strlen($password) < 8) {

		echo $uppercase;
		echo $lowercase;
		echo $number;


		echo "<script>alert('Password Minimal 8 Character dengan ada huruf kecil, besar dan Nomor')</script>";
		echo "<script>window.location='javascript:history.go(-1)';</script>";

	}else{
		$stmt = $mysqli->prepare("INSERT INTO tb_admin 
			(nama_admin,nama_lengkap_admin,username,password,level_admin) 
			VALUES (?,?,?,?,?)");

		$stmt->bind_param("sssss", 
			$_POST['nama_admin'],
			$_POST['nama_lengkap_admin'],
			$_POST['username'],
			$_POST['password'],
			$_POST['level_admin']);	

		if ($stmt->execute()) { 
			echo "<script>alert('Data admin Berhasil Disimpan')</script>";
			echo "<script>window.location='index.php?hal=admin';</script>";	
		} else {
			echo "<script>alert('Data admin Gagal Disimpan')</script>";
			echo "<script>window.location='javascript:history.go(-1)';</script>";
		}
	}

}else if(isset($_POST['ubah'])){

//Proses ubah data
	$password=$_POST['password'];
	$uppercase = preg_match('@[A-Z]@', $password);
	$lowercase = preg_match('@[a-z]@', $password);
	$number    = preg_match('@[0-9]@', $password);
	if(!$uppercase || !$lowercase || !$number || strlen($password) < 8) {
		echo "<script>alert('Password minimal 8 Character dengan ada huruf kecil, besar dan Nomor')</script>";
		echo "<script>window.location='javascript:history.go(-1)';</script>";

	}else{
		$stmt = $mysqli->prepare("UPDATE tb_admin  SET 
			nama_admin=?,
			nama_lengkap_admin=?,
			username=?,
			password=?,
			level_admin=?
			where id_admin=?");
		$stmt->bind_param("ssssss",
			$_POST['nama_admin'],
			$_POST['nama_lengkap_admin'],
			$_POST['username'],
			$_POST['password'],
			$_POST['level_admin'],
			$_POST['id_admin']);	

		if ($stmt->execute()) { 
			echo "<script>alert('Data admin Berhasil Diubah')</script>";
			echo "<script>window.location='index.php?hal=admin';</script>";	
		} else {
			echo "<script>alert('Data admin Gagal Diubah')</script>";
			echo "<script>window.location='javascript:history.go(-1)';</script>";
		}
	}

}else if(isset($_GET['hapus'])){

	//Proses hapus
	$stmt = $mysqli->prepare("DELETE FROM tb_admin where id_admin=?");
	$stmt->bind_param("s",$_GET['hapus']); 

	if ($stmt->execute()) { 
		echo "<script>alert('Data admin Berhasil Dihapus')</script>";
		echo "<script>window.location='index.php?hal=admin';</script>";	
	} else {
		echo "<script>alert('Data admin Gagal Dihapus')</script>";
		echo "<script>window.location='javascript:history.go(-1)';</script>";
	}

}
?>