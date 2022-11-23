<?php 
require_once '../../../setting/koneksi.php';

$id_anggota = $_POST['id_anggota'];

$tanggal =  $_POST['tanggal'];
$pokok = (int) $_POST['pokok'];
$jasa = (int) $_POST['jasa'];
$potongan_pelunasan = (int) isset($_POST['potongan']) ? (int) $_POST['potongan'] : 0; // ketika input edit angsuran

function redirect($param1) {
    if($param1) {
        echo "<script>alert('Data angsuran Berhasil Disimpan!')</script>";
        echo "<script>window.location='javascript:history.go(-1)'</script>";
    } else {
        echo "<script>alert('Data angsuran Gagal Disimpan!')</script>";
        echo "<script>window.location='javascript:history.go(-1)'</script>";
    }

    return $param1;
}


$angsuran_tiap_anggota = mysqli_query($mysqli, "SELECT * FROM tb_angsuran WHERE id_anggota = '$id_anggota'");
$cek_angsuran = mysqli_num_rows($angsuran_tiap_anggota);

// 1. Jika angsuran dari tabel angsuran sisa pinjaman kosong, ambil data sisa pinjaman penelusuran dan sisa pinjaman pokok + jasa
if($cek_angsuran < 1 ) {
    // Data Pinjaman Anggota
    $sql = "SELECT * FROM tb_angsuran_pinjam WHERE id_pinjaman = '$id_anggota'";
    $query_pinjaman = mysqli_query($mysqli, $sql);
    $data1 = mysqli_fetch_array($query_pinjaman);

    $pinjaman_penelusuran = (int) $data1['sisa_pinjaman_penelusuran']; // total pinjaman belum pokok dan jasa atau nominal
    $pinjaman_akhir_jasa = (int) $data1['sisa_pinjaman_pokok_jasa']; // total pinjaman pokok + jasa 
    $sisa_pinjaman_penelusuran = $pinjaman_penelusuran - ($pokok + $potongan_pelunasan);
    $sisa_pinjaman_pokok_jasa = $pinjaman_akhir_jasa - ($pokok + $jasa + $potongan_pelunasan);

    $ket = "";
    if(($sisa_pinjaman_penelusuran) == 0 && ($sisa_pinjaman_pokok_jasa) == 0) {
        $ket = "Lunas";
    } else {
        $ket = "Belum Lunas";
    }

    $query = mysqli_query($mysqli, "INSERT INTO tb_angsuran (id_anggota, tanggal, pokok, jasa, potongan_pelunasan, sisa_pinjaman_penelusuran, 
    sisa_pinjaman_non_jasa, keterangan) VALUES ('$id_anggota', '$tanggal', '$pokok', '$jasa', '$potongan_pelunasan', '$sisa_pinjaman_pokok_jasa',
    '$sisa_pinjaman_penelusuran', '$ket')");

    redirect($query);

} else { //  2. Jika ada data sisa pinjaman ambil dari situ untuk mengurangi sisa pinjaman penelusuran dan sisa pinjaman pokok + jasa
    $sql = "SELECT * FROM tb_angsuran WHERE id_anggota = '$id_anggota' GROUP BY id_angsur DESC LIMIT 1";
    $query_pinjaman2 = mysqli_query($mysqli, $sql);
    $data2 = mysqli_fetch_array($query_pinjaman2);

    $pinjaman_penelusuran = (int) $data2['sisa_pinjaman_penelusuran'];
    $pinjaman_non_jasa = (int) $data2['sisa_pinjaman_non_jasa'];

    // pengurangan pokok + potongan (jika ada)
    $sisa_pinjaman_non_jasa = $pinjaman_non_jasa - ($pokok + $potongan_pelunasan);
    // pengurangan jasa + pokok + potongan (jika ada)
    $sisa_pinjaman_penelusuran = $pinjaman_penelusuran - ($pokok + $jasa + $potongan_pelunasan);  

    // jika ada potongan total di nol kan
    $temp1 = $sisa_pinjaman_non_jasa < 0 ? 0 : $sisa_pinjaman_non_jasa;
    $temp2 = $sisa_pinjaman_penelusuran < 0 ? 0 : $sisa_pinjaman_penelusuran;

    $ket = "";
    if(($temp1) == 0 && ($temp2) == 0) {
        $ket = "Lunas";
    } else {
        $ket = "Belum Lunas";
    }

    $query = mysqli_query($mysqli, "INSERT INTO tb_angsuran (id_anggota, tanggal, pokok, jasa, potongan_pelunasan, sisa_pinjaman_penelusuran, 
    sisa_pinjaman_non_jasa, keterangan) VALUES ('$id_anggota', '$tanggal', '$pokok', '$jasa', '$potongan_pelunasan', '$temp2', '$temp1',
    '$ket')");
    redirect($query);
}
?>

