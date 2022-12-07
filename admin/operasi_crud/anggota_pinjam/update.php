<?php 
require_once '../../../setting/koneksi.php';
session_start();
$id_anggota = $_POST['id'];
$id_pinjaman = $_POST['id'];

$kode = $_POST['kode'];
$nama = $_POST['nama'];
$dukuh = $_POST['dukuh'];
$alamat = $_POST['alamat'];
$rt = $_POST['rt'];
$rw = $_POST['rw'];
$nominal_pinjaman = $_POST['nominal_pinjaman'];
$jangka_pinjaman = $_POST['jangka_pinjaman'];

$query = mysqli_query($mysqli, "UPDATE tb_anggota_pinjam SET kode = '$kode', nama = '$nama', dukuh = '$dukuh', alamat = '$alamat', rt = '$rt', rw = '$rw' WHERE id = '$id_anggota'");

// Rumus pinjaman 
$pokok = $nominal_pinjaman / $jangka_pinjaman; //nanti ditanyakan apakah fix di bulan 10 aja tiap jangka pinjaman
$jasa = ($nominal_pinjaman * 2) / 100;
$total_pinjaman = $pokok + $jasa;
$sisa_pinjaman_penelusuran = $nominal_pinjaman;
$sisa_pinjaman_pokok_jasa = $total_pinjaman * $jangka_pinjaman;

$query2 = mysqli_query($mysqli, "UPDATE tb_angsuran_pinjam SET jangka_pinjaman = '$jangka_pinjaman', nominal_pinjaman = '$nominal_pinjaman', pokok = '$pokok', jasa = '$jasa', total_pokok_jasa = '$total_pinjaman', sisa_pinjaman_penelusuran = '$sisa_pinjaman_penelusuran', sisa_pinjaman_pokok_jasa = 'sisa_pinjaman_pokok_jasa' WHERE id_pinjaman = '$id_pinjaman'");

if($query) {
    $_SESSION['success'] = 'Data anggota Berhasil Diubah!';
    echo "<script>window.location='../../index.php?hal=pinjaman'</script>";
} else {
    $_SESSION['gagal'] = 'Data anggota Gagal Diubah!';
    echo "<script>window.location='javascript:history.go(-1)'</script>";
}

?>