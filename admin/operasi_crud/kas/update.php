<?php
require_once '../../../setting/koneksi.php';
session_start();

$id_kas = $_POST['id_kas'];
$tanggal = $_POST['tanggal'];
$id_transaksi = $_POST['id_transaksi'];
$kode_akun = $_POST['kode_akun'];
$sumber = $_POST['sumber'];
$keterangan = $_POST['keterangan'];
$debet = isset($_POST['debet']) ? $_POST['debet'] : 0;
$kredit = isset($_POST['kredit'])  ? $_POST['kredit'] : 0;

$stmt = $mysqli->prepare("UPDATE tb_kas SET tanggal=?, id_transaksi=?, sumber=?, kode_akun=?, keterangan=?, debet=?, kredit=? WHERE id_kas=?");
$stmt->bind_param("sssssdds", $tanggal, $id_transaksi, $sumber, $kode_akun, $keterangan, $debet, $kredit, $id_kas);

if($stmt->execute()) {
    $_SESSION['success'] = 'Data kas Berhasil DiUbah!';
    echo "<script>window.location='../../index.php?hal=kas'</script>";
} else {
    $_SESSION['gagal'] = 'Data kas Gagal DiUbah!';
    echo "<script>window.location='javascript:history.go(-1)'</script>";
}

?>