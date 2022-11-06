<?php 
/*
    Rumus untuk status keterangan
    jika sisa pinjaman akhir plus jasa dan sisa pinjaman akhir non jasa
    status peminjam = "LUNAS"
*/ 

$id_anggota = $_POST['id_anggota'];
/*
    jika angsuran rutin atau cepat lunas maka dapat potongan jasa dengan nominal terterntu
*/ 

$tanggal = isset($_POST['tanggal']) ? $_POST['tanggal'] : '';
$potongan_jasa = isset($_POST['potongan']) ? $_POST['potongan'] : 0; // ketika input edit angsuran

$sisa_pinjaman_pokok_jasa = isset($_POST['sisa_pinjaman_pokok_jasa']) ? $_POST['sisa_pinajman_pokok_jasa'] : 0;
$sis_pinjaman_penelusuran = isset($_POST['sisa_pinjaman_penelusuran']) ? $_POST['sisa_pinjaman_penelusuran'] : 0;

// mencari total keselurahan dari angsuran non jasa
$total_angsuran = mysqli_query($koneksi, "SELECT SUM(pokok) AS pokok, SUM(jasa) AS jasa FROM tb_angsuran WHERE id_anggota = '$id_anggota'");
$data1= mysqli_fetch_array($total_angsuran_non_jasa);
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

$query = mysqli_query($mysqli, "INSERT INTO tb_angsuran (id_anggota, tanggal, pokok, jasa, potongan_jasa, sisa_pinjaman, sisa_pinjaman_non_jasa, keterangan) VALUES ('$id_anggota', '$tanggal', '$tanggal', '$jasa', '$potongan', '$sisa_pinjaman_akhir_jasa', '$sisa_pinjaman_akhir_non_jasa', '$keterangan')");

if($query) {
    echo "<script>alert('Data angsuran Berhasil Disimpan!')</script>";
    echo "<script>window.location='../../hal=detail_pinjaman?id_anggota='".$id_anggota."</script>";
} else {
    echo "<script>alert('Data angsuran Gagal Disimpan!')</script>";
    echo "<script>window.location='javascript:history.go(-1)'</script>";
}


?>