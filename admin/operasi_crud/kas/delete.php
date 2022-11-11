<?php 
require_once '../../../setting/koneksi.php';

$id_kas = $_GET['id_kas'];
$query = mysqli_query($mysqli, "DELETE FROM tb_kas WHERE id_kas = '$id_kas'");

if($query) {
    echo "<script>alert('Data kas Berhasil Dihapus')</script>";
    echo "<script>window.location='../../index.php?hal=kas';</script>";
}

?>
