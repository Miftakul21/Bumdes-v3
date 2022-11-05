<?php 
require_once '../../../setting/koneksi.php';

$kode = $_POST['kode'];
$nama = $_POST['nama'];
$dukuh = $_POST['dukuh'];
$alamat = $_POST['alamat'];
$rt = $_POST['rt'];
$rw = $_POST['rw'];
$nominal_pinjaman = $_POST['nominal_pinjaman'];
$jangka_pinjaman = $_POST['jangka_pinjaman'];

// masukan data ke anggota pinjaman
$query=mysqli_query($mysqli, "INSERT INTO tb_anggota_pinjam (kode, nama, dukuh, alamat, rt, rw) VALUES ('$kode', '$nama', '$dukuh', '$alamat', '$rt', '$rw')");

// ambil id anggota untuk data pinjaman
$id_anggota_pinjaman=mysqli_insert_id($mysqli);

// Rumus pinjaman 
$pokok = $nominal_pinjaman / $jangka_pinjaman; //nanti ditanyakan apakah fix di bulan 10 aja tiap jangka pinjaman
$jasa = ($nominal_pinjaman * 2) / 100;
$total_pinjaman = $pokok + $jasa;
$sisa_pinjaman_penelusuran = $nominal_pinjaman;
$sisa_pinjaman_pokok_jasa = $total_pinjaman * $jangka_pinjaman;

// masukkan jumlah pinjaman tiap anggota pinjaman
$query2=mysqli_query($mysqli, "INSERT INTO tb_angsuran_pinjam (id_pinjaman, jangka_pinjaman, nominal_pinjaman, pokok, jasa, total_pokok_jasa, sisa_pinjaman_penelusuran, sisa_pinjaman_pokok_jasa) VALUES ('$id_anggota_pinjaman', '$jangka_pinjaman', '$nominal_pinjaman', '$pokok','$jasa', '$total_pinjaman', '$sisa_pinjaman_penelusuran', '$sisa_pinjaman_pokok_jasa')");

// echo var_dump($id_anggota_pinjaman.' '.$jangka_pinjaman.' '.$pokok.' '.$jasa.' '.$total_pinjaman.' '.$sisa_pinjaman_penelusuran.' '.$sisa_pinjaman_pokok_jasa);

if($query) {
    echo "<script>alert('Data pinjaman Berhasil Disimpan!')</script>";
    echo "<script>window.location='../../index.php?hal=pinjaman'</script>";
} else {
    echo "<script>alert('Data pinjaman Gagal Disimpan!')</script>";
    echo "<script>window.location='javascript:history.go(-1)'</script>";
}
?>