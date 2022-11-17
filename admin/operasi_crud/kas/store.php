<?php 
require_once '../../../setting/fungsi.php';
require_once '../../../setting/koneksi.php';
session_start();

if(isset($_POST['tambah'])){	
	$_SESSION['tanggal']=$_POST['tanggal'];
	$_SESSION['keterangan']=$_POST['keterangan'];
	$_SESSION['sumber']= $_POST['sumber'];
	$id_index = $_POST['sumber'];
	$query_kas = mysqli_query($mysqli, "SELECT keterangan FROM tb_index WHERE id_index = '$id_index'");
	$data = mysqli_fetch_array($query_kas);
	$ket_index = $data['keterangan'];

	$debet = isset($_POST['debet']) ? $_POST['debet']: 0;
	$kredit = isset($_POST['kredit']) ? $_POST['kredit']: 0;
	
	// 1. kode_akun,  2. id_sumber arus kas 3. debet 4. kredit 5. keterangan
	$_SESSION['kas'][date('ymd-h:i:s')]= array($_POST['id_akun'],$ket_index,$debet,$kredit,$_POST['keterangan']);
	// echo "<script>alert('Data berhasil ditambah')</script>";
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
			$ket_sumber = $value['1'];
			$query = mysqli_query($mysqli, "SELECT id_index FROM tb_index WHERE keterangan LIKE  '%$ket_sumber%' LIMIT 1");
			$data = mysqli_fetch_array($query);
			
			$tanggal = $_POST['tanggal'];
			$id_transaksi = $_POST['id_transaksi'];
			$kode_akun = $value['0'];
			$sumber = $data['id_index']; // sumber jenis arus kas
			$keterangan = $value['4'];
			$debet = $value['2'];
			$kredit = $value['3'];

			$stmt = $mysqli->prepare("INSERT INTO tb_kas (tanggal, id_transaksi, kode_akun, sumber, keterangan, debet, kredit) VALUE (?,?,?,?,?,?,?)");
			$stmt->bind_param('sssssdd', $tanggal, $id_transaksi, $kode_akun, $sumber, $keterangan, $debet, $kredit);

			$stmt->execute();
		}
	}	
	// //Clear Data
	unset($_SESSION['kas']);

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

function simpan($mysqli, $tanggal, $id_transaksi, $kode_akun, $sumber, $keterangan, $debet, $kredit){
	$stmt = $mysqli->prepare("INSERT INTO tb_kas 
			(tanggal, id_transaksi, kode_akun, sumber, keterangan debet,kredit) 
			VALUES (?,?,?,?,?)");

	$stmt->bind_param("sssssdd", $tanggal, $id_transaksi, $kode_akun, $sumber, $keterangan, $debet, $kredit);	
	$stmt->execute();
}
?>