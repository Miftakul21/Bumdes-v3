<?php 
require_once '../../../setting/koneksi.php';
session_start();

$id_kas = $_GET['id_kas'];
$query = mysqli_query($mysqli, "DELETE FROM tb_kas WHERE id_kas = '$id_kas'");

if($query) {
    // echo "<script>alert('Data kas Berhasil Dihapus')</script>";
    $_SESSION['success']="Data kas Berhasil Dihapus!";
    echo "<script>window.location='../../index.php?hal=kas';</script>";
} else {
    $_SESSION['gagal']="Data kas Gagal Dihapus!";
    echo "<script>window.location='../../index.php?hal=kas';</script>";    
}

?>
