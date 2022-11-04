<?php 
require_once '../../../setting/koneksi.php';

$username = $_POST['username'];
$password = md5($_POST['password']);

// Akun User (Admin, Bendahara, Dan Anggota UMKM)
$query_akun = mysqli_query($mysqli, "SELECT * FROM tb_user WHERE username = '$username' AND password = '$password'");
$cek_akun = mysqli_num_rows($query_akun);

// Ngecek Ketika Akun Ada
if($cek_akun > 0) {	
	// Nanti ditamabahkan alert pesan;
	echo "<script>alert('Username dan Password sudah ada!')</script>";
	echo "<script>window.location='javascript:history.go(-1)';</script>";
} else {
// Jika Tidak Ada Maka Dapat Ditamabahkan
	$nama = $_POST['nama'];
	$username = $_POST['username'];
	$pjg_password = $_POST['password'];
	$enkrip_password = md5($_POST['password']);
	$level_user = $_POST['level_user'];
	$id_unit = $_POST['id_unit'];

	if(strlen($pjg_password) == 8) {
		$stmt = $mysqli->prepare("INSERT INTO tb_user (nama,username,password,id_unit,level_user) VALUES (?,?,?,?,?)");
		$stmt->bind_param("sssss", $nama, $username, $enkrip_password, $id_unit, $level_user);

		// Nanti ditamabahkan alert pesan;
		if($stmt->execute()) {
			echo "<script>alert('Berhasil menambahkan akun user!')</script>";
			// nanti halaman redirect di modifikasi;
			echo "<script>window.location = '../../index.php?hal=user'</script>";
		} else {
			echo "<script>alert('Gagal menambahkan akun user!')</script>";
			// nanti halaman redirect di modifikasi;
			echo "<script>window.location='javascript:history.go(-1)';</script>";
		}
	} else {
			echo "<script>alert('Password kurang dari 8 character!')</script>";
			echo "<script>window.location='javascript:history.go(-1)';</script>";
	}
}
?>