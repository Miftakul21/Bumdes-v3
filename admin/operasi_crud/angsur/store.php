<?php 
require_once '../../../setting/koneksi.php';

/*
    Rumus untuk status keterangan
    jika sisa pinjaman akhir plus jasa dan sisa pinjaman akhir non jasa
    status peminjam = "LUNAS"
*/ 

$id_anggota = $_POST['id_anggota'];
/*
    jika angsuran rutin atau cepat lunas maka dapat potongan jasa dengan nominal terterntu
*/ 

$tanggal = $_POST['tanggal'];
$pokok = $_POST['pokok'];
$jasa = $_POST['jasa'];
$potongan_jasa = isset($_POST['potongan']) ? $_POST['potongan'] : 0; // ketika input edit angsuran


$query_pinjaman = mysqli_query($mysqli, "SELECT nominal_pinjaman, pokok, jasa, total_pokok_jasa, sisa_pinjaman_penelusuran, sisa_pinjaman_pokok_jasa FROM tb_angsuran_pinjam WHERE id_pinjaman = '$id_anggota'");
$data_query = mysqli_fetch_array($query_pinjaman);
$sisa_pinjaman_penelusuran = $data_query['sisa_pinjaman_penelusuran'];
$sisa_pinjaman_pokok_jasa = $data_query['sisa_pinjaman_pokok_jasa'];

// mencari total keselurahan dari angsuran non jasa
$total_angsuran = mysqli_query($mysqli, "SELECT SUM(pokok) AS pokok, SUM(jasa) AS jasa FROM tb_angsuran WHERE id_anggota = '$id_anggota'");
$data1= mysqli_fetch_array($total_angsuran);
$data_total_pokok = isset($data1['pokok']) ? $data1['pokok'] : 0;
$data_total_jasa = isset($data1['jasa']) ? $data1['jasa'] : 0;

// mencari total keseluruhan dari angsuran jasa
// sisa pinjaman akhir plus jasa (pokok + jasa)
$sisa_pinjaman_akhir_jasa = $sisa_pinjaman_pokok_jasa - ($data_total_pokok + $data_total_jasa + $potongan_jasa);
// sisa pinjaman akhir non jasa (pokok)
$sisa_pinjaman_akhir_non_jasa = $sisa_pinjaman_penelusuran - $data_total_pokok;

$cek_sisa_pinjaman_akhir_jasa = $sisa_pinjaman_akhir_jasa;
$cek_sisa_pinjaman_akhir_non_jasa = $sisa_pinjaman_akhir_non_jasa;

$keterangan = '';
if($cek_sisa_pinjaman_akhir_jasa = 0 && $cek_sisa_pinjaman_akhir_non_jasa = 0){
    $keterangan = 'Lunas';
} else {
    $keterangan = 'Belum Lunas';
} 

$query = mysqli_query($mysqli, "INSERT INTO tb_angsuran (id_anggota, tanggal, pokok, jasa, potongan_jasa, sisa_pinjaman_penelusuran, sisa_pinjaman_non_jasa, keterangan) VALUES ('$id_anggota', '$tanggal', '$pokok', '$jasa', '$potongan_jasa', '$sisa_pinjaman_akhir_jasa', '$sisa_pinjaman_akhir_non_jasa', '$keterangan')");






if($query) {
    echo "<script>alert('Data angsuran Berhasil Disimpan!')</script>";
    // echo "<script>window.location='../../hal=detail_pinjaman?id_anggota='".$id_anggota."</script>";
    echo "<script>window.location='javascript:history.go(-1)'</script>";
} else {
    echo "<script>alert('Data angsuran Gagal Disimpan!')</script>";
    echo "<script>window.location='javascript:history.go(-1)'</script>";
}


?>