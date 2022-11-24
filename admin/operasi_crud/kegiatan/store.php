<?php 
require_once "../../../setting/koneksi.php";
session_start();

$stmt = $mysqli->prepare("INSERT INTO tb_kegiatan (id_unit,nama_kegiatan) VALUES (?,?)");
$stmt->bind_param("ss", $_POST['id_unit'], $_POST['nama_kegiatan']);	

if($stmt->execute()) { 
    $_SESSION['success'] = "Data kegiatan unit Berhasil Disimpan";
	echo "<script>window.location='../../index.php?hal=kegiatan';</script>";	
} else {
    $_SESSION['gagal'] = "Data kegiatan unit Gagal Disimpan";    
	echo "<script>window.location='javascript:history.go(-1)';</script>";
}
?>