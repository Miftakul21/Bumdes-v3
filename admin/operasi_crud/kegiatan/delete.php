<?php 
require_once "../../../setting/koneksi.php";
session_start();
$stmt = $mysqli->prepare("DELETE FROM tb_kegiatan WHERE id_kegiatan = ?");
$stmt->bind_param("s", $_GET['hapus']);	

if($stmt->execute()) { 
    $_SESSION['success'] = "Data kegiatan unit Berhasil Dihapus";
	echo "<script>window.location='../../index.php?hal=kegiatan';</script>";	
} else {
    $_SESSION['gagal'] = "Data kegiatan unit Gagal Dihapus";    
	echo "<script>window.location='javascript:history.go(-1)';</script>";
}


?>