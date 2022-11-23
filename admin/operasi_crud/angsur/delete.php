<?php 
require_once "../../../setting/koneksi.php";

$id_angsuran = $_GET['id'];

$sql = "DELETE FROM tb_angsuran WHERE id_angsur = '$id_angsuran'";
$query = mysqli_query($mysqli, $sql);

if($query) {
    echo "<script>alert('Data angsuran Berhasil Dihapus!')</script>";
    echo "<script>window.location='javascript:history.go(-1)'</script>";
} else {
    echo "<script>alert('Data angsuran Gagal Dihapus!')</script>";
    echo "<script>window.location='javascript:history.go(-1)'</script>";    
}

?>