<?php 
require_once "../../../setting/koneksi.php";
session_start();

$stmt = $mysqli->prepare("UPDATE tb_kegiatan SET id_unit = ?, nama_kegiatan = ? WHERE id_kegiatan = ?");
$stmt->bind_param("dsd", $_POST['id_unit'], $_POST['nama_kegiatan'], $_POST['id_kegiatan']);	

if($stmt->execute()) { 
    $_SESSION['success'] = "Data kegiatan unit Berhasil Diubah";
	echo "<script>window.location='../../index.php?hal=kegiatan';</script>";	
} else {
    $_SESSION['gagal'] = "Data kegiatan unit Gagal Diubah";    
	echo "<script>window.location='javascript:history.go(-1)';</script>";
}

?>