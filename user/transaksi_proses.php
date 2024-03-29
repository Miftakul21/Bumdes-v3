<?php
require_once '../setting/crud.php';
require_once '../setting/koneksi.php';
require_once '../setting/tanggal.php';
require_once '../setting/fungsi.php';
session_start();

$id_user=$_SESSION['id'];

if(isset($_POST['tambah'])){	
	$_SESSION['tanggal']=$_POST['tanggal'];
	$_SESSION['keterangan']=$_POST['keterangan'];
	$_SESSION['kegiatan']=$_POST['id_kegiatan'];

	// buat menampilkan nama keterangan RALAT!!!!
	$id_index = $_POST['id_index']; // sumber arus

	$debet = isset($_POST['debet']) != ''  ? $_POST['debet'] : 0;
	$kredit = isset($_POST['kredit']) != '' ? $_POST['kredit'] : 0;

	// RALAT !!!
	// [0] id_akun  [1] id_sumber arus [2] debet [3] kredit [4] keterangan 
	$_SESSION['transaksi'][date('ymd-h:i:s')]= array($_POST['id_akun'],$id_index,$debet,$kredit,$_POST['keterangan']);	

	echo "<script>window.location='index.php?hal=transaksi_input&get';</script>";	

}else if(isset($_GET['hapus'])){
	//Proses hapus
	unset($_SESSION['transaksi'][$_GET['hapus']]);
	echo "<script>alert('Data Input transaksi Berhasil Dihapus')</script>";
	echo "<script>window.location='index.php?hal=transaksi_input&get';</script>";	

}else if(isset($_GET['hapusall'])){
	unset($_SESSION['transaksi']);
	echo "<script>alert('Data Input transaksi Berhasil Dihapus')</script>";
	echo "<script>window.location='index.php?hal=transaksi_input&get';</script>";	

}else if(isset($_POST['simpan'])){
	//Proses penambahan index
	if (isset($_SESSION['transaksi'])){
		foreach ($_SESSION['transaksi'] as $key => $value) {
			$stmt = $mysqli->prepare("INSERT INTO tb_transaksi 
				(id_transaksi,tanggal,id_kegiatan,kode_akun,id_index,keterangan_transaksi,debet,kredit) 
				VALUES (?,?,?,?,?,?,?,?)");

			$stmt->bind_param("ssssssdd", 
				$_POST['id_transaksi'],
				$_POST['tanggal'],
				$_POST['id_kegiatan'],
				$value['0'],
				$value['1'],
				$value['4'],
				$value['2'],
				$value['3']);	

			$stmt->execute();
		}
	}	
	
	//Notif
	// echo "<script>alert('Transaksi Berhasil Disimpan')</script>";
	$_SESSION['success'] = "Data Transaksi berhasil Disimpan";
	echo "<script>window.location='index.php?hal=transaksi_data';</script>";	

}else if(isset($_GET['hapusdb'])){
	//Proses hapus
	$stmt = $mysqli->prepare("DELETE FROM tb_transaksi where id_jurnal=?");
	$stmt->bind_param("s",$_GET['hapusdb']); 

	if ($stmt->execute()) { 
		echo "<script>alert('Data Transaksi Berhasil Dihapus')</script>";
		echo "<script>window.location='index.php?hal=transaksi_data';</script>";	
	} else {
		echo "<script>alert('Data Transaksi Gagal Dihapus')</script>";
		echo "<script>window.location='javascript:history.go(-1)';</script>";
	}	

}else if(isset($_POST['ubah'])){
	//Proses ubah data
	$stmt = $mysqli->prepare("UPDATE tb_transaksi  SET 
		kode_akun=?,
		id_index=?,
		id_kegiatan=?,
		keterangan=?,
		debet=?,
		kredit=?
		where id_jurnal=?");
	$stmt->bind_param("sssssss",
		$_POST['kode_akun'],
		$_POST['id_index'],
		$_POST['id_kegiatan'],
		$_POST['keterangan'],
		$_POST['debet'],
		$_POST['kredit'],
		$_POST['id_jurnal']);	

	if ($stmt->execute()) { 
		// echo "<script>alert('Data Transaksi Berhasil Diubah')</script>";
		$_SESSION['success'] = 'Data Transaksi Berhasil DiUbah!';
		echo "<script>window.location='index.php?hal=transaksi_data';</script>";	
	} else {
		// echo "<script>alert('Data Transaksi Gagal Diubah')</script>";
		$_SESSION['gagal'] = 'Data Transaksi Gagal DiUbah!';
		echo "<script>window.location='javascript:history.go(-1)';</script>";
	}

}

function simpan($mysqli,$id_user,$id_akun,$id_index,$debet,$kredit){
	$stmt = $mysqli->prepare("INSERT INTO temp_transaksi 
		(id_user,id_akun,id_index,debet,kredit) 
		VALUES (?,?,?,?,?)");

	$stmt->bind_param("sssss", 
		$id_user,
		$id_akun,
		$id_index,
		$debet,
		$kredit);	
	$stmt->execute();
}


?>