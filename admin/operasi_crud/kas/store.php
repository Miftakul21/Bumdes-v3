<?php 
require_once '../../../setting/fungsi.php';
require_once '../../../setting/koneksi.php';
session_start();
$id_user=$_SESSION['id'];

if(isset($_POST['tambah'])){	
	print_r($_POST);
	$_SESSION['tanggal']=$_POST['tanggal'];
	$_SESSION['keterangan']=$_POST['keterangan'];
	$_SESSION['sumber']= $_POST['sumber'];
												//      0                  1                 2			    3
	$_SESSION['kas'][date('ymd-h:i:s')]= array($_POST['id_akun'],$_POST['sumber'],$_POST['debet'],$_POST['kredit']);
	echo "<script>alert('Data berhasil ditambah')</script>";
	echo "<script>window.location='../../index.php?hal=tambah_kas&get'</script>";	

}else if(isset($_GET['hapus'])){
	//Proses hapus
	unset($_SESSION['kas'][$_GET['hapus']]);
	echo "<script>alert('Data Input transaksi Berhasil Dihapus')</script>";
	echo "<script>window.location='../../index.php?hal=tambah_kas&get'</script>";	

}else if(isset($_GET['hapusall'])){
	unset($_SESSION['kas']);
	echo "<script>alert('Data Input transaksi Berhasil Dihapus')</script>";
	echo "<script>window.location='../../index.php?hal=tambah_kas&get'</script>";	

}else if(isset($_POST['simpan'])){
	//Proses penambahan index
	if (isset($_SESSION['kas'])){
		foreach ($_SESSION['kas'] as $key => $value) {  
			$tanggal = $_POST['tanggal'];
			$id_transaksi = $_POST['id_transaksi'];
			$kode_akun = $value['0'];
			$keterangan = $_POST['keterangan'];
			$sumber = $value['1'];
			$debet = $value['2'];
			$kredit = $value['3'];
			mysqli_query($mysqli, "INSERT INTO tb_kas (tanggal, id_transaksi, kode_akun, sumber, keterangan, debet, kredit) VALUES ('$tanggal', '$id_transaksi', '$kode_akun', '$sumber', '$keterangan', '$debet', '$kredit')");
		}
	}	
	//Clear Data
	mysqli_query($mysqli,"DELETE FROM temp_transaksi where id_user='$id_user'");

	//Notif
	echo "<script>alert('Transaksi Berhasil Disimpan')</script>";
	echo "<script>window.location='../../index.php?hal=kas';</script>";	

}else if(isset($_GET['hapusdb'])){
	//Proses hapus
	$stmt = $mysqli->prepare("DELETE FROM tb_kas where id_kas=?");
	$stmt->bind_param("s",$_GET['hapusdb']); 

	if ($stmt->execute()) { 
		echo "<script>alert('Data Transaksi Berhasil Dihapus')</script>";
		echo "<script>window.location='../../index.php?hal=kas';</script>";	
	} else {
		echo "<script>alert('Data Transaksi Gagal Dihapus')</script>";
		echo "<script>window.location='javascript:history.go(-1)';</script>";
	}	


}

// else if(isset($_POST['ubah'])){
// //Proses ubah data
// 	$stmt = $mysqli->prepare("UPDATE tb_transaksi  SET 
// 		kode_akun=?,
// 		id_index=?,
// 		id_kegiatan=?,
// 		keterangan=?,
// 		debet=?,
// 		kredit=?
// 		where id_jurnal=?");
// 	$stmt->bind_param("sssssss",
// 		$_POST['kode_akun'],
// 		$_POST['id_index'],
// 		$_POST['id_kegiatan'],
// 		$_POST['keterangan'],
// 		$_POST['debet'],
// 		$_POST['kredit'],
// 		$_POST['id_jurnal']);	

// 	if ($stmt->execute()) { 
// 		echo "<script>alert('Data Transaksi Berhasil Diubah')</script>";
// 		echo "<script>window.location='index.php?hal=transaksi_data';</script>";	
// 	} else {
// 		echo "<script>alert('Data Transaksi Gagal Diubah')</script>";
// 		echo "<script>window.location='javascript:history.go(-1)';</script>";
// 	}

// }

// function simpan($mysqli,$id_user,$id_akun,$id_index,$debet,$kredit){
// 	$stmt = $mysqli->prepare("INSERT INTO temp_transaksi 
// 		(id_user,id_akun,id_index,debet,kredit) 
// 		VALUES (?,?,?,?,?)");

// 	$stmt->bind_param("sssss", 
// 		$id_user,
// 		$id_akun,
// 		$id_index,
// 		$debet,
// 		$kredit);	
// 	$stmt->execute();

// }

?>