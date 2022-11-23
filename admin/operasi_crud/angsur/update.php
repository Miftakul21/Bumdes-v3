<?php
require_once "../../../setting/koneksi.php";

$id_anggota = $_GET['id_anggota'];
$id_angsur = $_POST['id_angsur'];
$jasa = (int) $_POST['jasa'];
$pokok = (int) $_POST['pokok'];
$potongan = (int) isset($_POST['potongan']) ? $_POST['potongan'] : 0;

// ambil data sebelumnya
$query = mysqli_query($mysqli, "SELECT * FROM tb_angsuran WHERE id_angsur < '$id_angsur' ORDER BY id_angsur DESC LIMIT 1");
$data = mysqli_fetch_array($query);

$pinjaman_non_jasa = (int) $data['sisa_pinjaman_non_jasa']; // pokok
$pinjaman_penelusuran = (int) $data['sisa_pinjaman_penelusuran']; // jasa + pokok

$sisa_pinjaman_non_jasa = $pinjaman_non_jasa - ($pokok + $potongan);
$sisa_pinjaman_penelusuran = $pinjaman_penelusuran - ($pokok + $jasa + $potongan);

// jika ada potongan total di nol kan
$temp1 = $sisa_pinjaman_non_jasa < 0 ? 0 : $sisa_pinjaman_non_jasa;
$temp2 = $sisa_pinjaman_penelusuran < 0 ? 0 : $sisa_pinjaman_penelusuran;

$ket = "";
if(($temp1) == 0 && ($temp2) == 0) {
    $ket = "Lunas";
} else {
    $ket = "Belum Lunas";
}

$stmt = $mysqli->prepare("UPDATE tb_angsuran SET 
                id_anggota = ?, tanggal = ?, pokok = ?, jasa = ?, potongan_pelunasan = ? sisa_pinjaman_penelusuran = ?,
                sisa_pinjaman_non_jasa = ?, keterangan = ? WHERE id_ansur = ?");
$stmt->bind_param('ssddddds', $id_anggota, $tanggal, $pokok, $jasa, $potongan, $temp2, $temp2, $ket, $id_angsur);

if($stmt->execute()) {
    echo "<script>alert('Data angsuran Berhasil Disimpan!')</script>";
    echo "<script>window.location='javascript:history.go(-1)'</script>";
} else {
    echo "<script>alert('Data angsuran Gagal Disimpan!')</script>";
    echo "<script>window.location='javascript:history.go(-1)'</script>";
}
?>
