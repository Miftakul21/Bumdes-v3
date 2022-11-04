<?php 
require_once '../../../setting/koneksi.php';

$id_user = $_POST['id_user'];
$nama = $_POST['nama'];
$username = $_POST['username'];
$password = md5($_POST['password']);
$pjg_password = $_POST['password'];
$level_user = $_POST['level_user'];
$id_unit = $_POST['id_unit'];

// echo var_dump($nama.' '.$username.' '.$level_user.' '.$pjg_password.' '.$id_unit.' '.$id_user);

if(strlen($pjg_password) >= 8) {
	// $stmt = $mysqli->prepare("UPDATE tb_user SET nama = ?, username = ?,id_unit = ?,level_user = ? WHERE id_user = ?");
	// $stmt->bind_param("sssssd", $nama, $username, $password, $id_unit, $level_user, $id_user);
	$query = mysqli_query($mysqli, "UPDATE tb_user SET nama = '$nama', username = '$username', password = '$password', id_unit = '$id_unit', level_user = '$level_user' WHERE id_user = '$id_user'");

	// Nanti ditamabahkan alert pesan;
	if($query) {
		echo "<script>alert('Berhasil mengubah akun user!')</script>";
		// nanti halaman redirect di modifikasi;
		echo "<script>window.location = '../../index.php?hal=user'</script>";
	} else {
		echo "<script>alert('Gagal mengubah akun user!')</script>";
		// nanti halaman redirect di modifikasi;
		echo "<script>window.location='javascript:history.go(-1)';</script>";
	}
    
} else {
		echo "<script>alert('Password kurang dari 8 character!')</script>";
		echo "<script>window.location='javascript:history.go(-1)';</script>";
}

?>