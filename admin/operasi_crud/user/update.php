<?php 
require_once '../../../setting/koneksi.php';
session_start();

$id_user = $_POST['id_user'];
$nama = $_POST['nama'];
$username = $_POST['username'];
$pjg_password = $_POST['password'];
$level_user = $_POST['level_user'];
$id_unit = $_POST['id_unit'];

if(strlen($pjg_password) >= 8) {
	$password = md5($_POST['password']);
	$query = mysqli_query($mysqli, "UPDATE tb_user SET nama = '$nama', username = '$username', password = '$password', id_unit = '$id_unit', 
						level_user = '$level_user' WHERE id_user = '$id_user'");
	if($query) {
		$_SESSION['success'] = 'Data user Berhasil Diubah';
		echo "<script>window.location = '../../index.php?hal=user'</script>";
	} else {
		$_SESSION['success'] = 'Data user Gagal Diubah';
		echo "<script>window.location='javascript:history.go(-1)';</script>";
	}
    
} else {
		echo "<script>alert('Password kurang dari 8 character!')</script>";
		echo "<script>window.location='javascript:history.go(-1)';</script>";
}
?>