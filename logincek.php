<?php
session_start();
require_once 'setting/crud.php';
require_once 'setting/koneksi.php';

$username=$_POST['username'];
$password=$_POST['password']; 

// cek jika password kurang dari 8
if(strlen($password) < 8) {
	echo "<script>alert('Password kurang dari 8 character!')</script>";
	echo "<script>window.location='index.php'</script>";
} else {
	$pass=md5($password); 
	$query = mysqli_query($mysqli, "SELECT * FROM tb_user WHERE username = '$username' AND password = '$pass'");
	$data = mysqli_fetch_array($query);
	$level = $data['level_user'];
	$cek_login = mysqli_num_rows($query);


	if($cek_login > 0) {
		switch($level){
			case 'Admin': // untuk mengelola apa saja
				$_SESSION['nama'] = $data['nama'];
				$_SESSION['level_user'] = $data['level_user'];
				echo "<script>window.location='admin/index.php'</script>";
				break;
			case 'Kepala Desa':
				$_SESSION['id'] = $data['id_unit'];
				$_SESSION['nama'] = $data['nama'];
				$_SESSION['level_user'] = $data['level_user'];
				echo "<script>window.location='admin/index.php'</script>";
				break;
			case 'Bendahara': // untuk mengelola apa saja
				$_SESSION['nama'] = $data['nama'];
				$_SESSION['level_user'] = $data['level_user'];
				echo "<script>window.location='admin/index.php'</script>";
				break;
			case 'Sekertaris': // untuk mengelola apa saja
				$_SESSION['nama'] = $data['nama'];
				$_SESSION['level_user'] = $data['level_user'];
				echo "<script>window.location='admin/index.php'</script>";
				break;
			case 'Ketua': // untuk mengelola unit umkm
				$_SESSION['id'] = $data['id_unit'];
				$_SESSION['nama'] = $data['nama'];
				$_SESSION['level_user'] = $data['level_user'];
				echo "<script>window.location='user/index.php'</script>";
				break;
		}
	} else {
		echo '<script>alert("Username dan Password tidak ditemukan!")</script>';
		echo "<script>window.location='index.php'</script>";
	}
}
?>