<?php 
require_once '../../../setting/koneksi.php';

$id_anggota = $_GET['hapus'];
$id_pinjaman = $id_anggota;

$query = mysqli_query($mysqli, "DELETE FROM tb_anggota_pinjam WHERE id = '$id_anggota'");
$query2 = mysqli_query($mysqli, "DELETE FROM tb_angsuran_pinjam WHERE id_pinjaman = '$id_pinjaman'");

if($query && $query2) {
    echo "<script>alert('Data anggota Berhasil Dihapus!')</script>";
    echo "<script>window.location=../../index.php?hal=pinjaman</script>";
} else {
    echo "<script>alert('Data anggota Gagal Dihapus!')</script>";
    echo "<script>window.location=javascript:history.go(-1)</script>";
}


?>