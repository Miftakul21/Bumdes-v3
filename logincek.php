<?php
session_start();
require_once 'setting/crud.php';
require_once 'setting/koneksi.php';

$username=$_POST['username'];
$password=$_POST['password']; 

// echo var_dump($username.' '.$password);
//Pengecekan ada data dalam login tidak
// $sqladmin="Select id_admin from tb_admin where username='$user' and password='$pass' and level_admin='Administrasi'";
// $sqladmin1="Select id_admin from tb_admin where username='$user' and password='$pass' and level_admin='Kepala'";
// $sqluser="Select id_unit, level_user from tb_user where username='$user' and password='$pass' and level_user='Transaksi'";
// $sqlleveluser="Select level_user from tb_user where username='$user' and password='$pass' and level_user='Transaksi'";
// $sqluser1="Select id_unit from tb_user where username='$user' and password='$pass' and level_user='Ketua'";


// cek jika password kurang dari 8
if(strlen($password) < 8) {
	echo "<script>alert('Password kurang dari 8 character!')</script>";
	echo "<script>window.location='index.php'</script>";
} else {
	$pass=md5($password); 
	$query = mysqli_query($mysqli, "SELECT * FROM tb_user WHERE username = '$username' AND password = '$pass'");
	$cek_login = mysqli_num_rows($query);

	// ambil data level user
	$data = mysqli_fetch_array($query);
	$level_user = $data['level_user'];

	if($cek_login > 0) {
		if($level_user = 'Admin' || $level_user = 'Bendahara') {
			/*
				1. Nanti Ditambahkan Sessionnya

				catatan halaman:
				- halaman ini nanti bisa memantau keuangan bumdes (kas dan pinjaman), dan memantau keuangan umkn
				- halaman ini dapat mengelola unit umkm dan menambahkan hak akses kepada sistem
			*/
			$_SESSION['user'] = $data;
			$_SESSION['user_nama'] = $data['nama'];
			$_SESSION['level_user'] = $data['level_user'];
			echo "<script>window.location = 'admin/index.php'</script>";
		} else if($level_user = 'Kepala Desa') {
			$_SESSION['user'] = $data;
			$_SESSION['user_nama'] = $data['nama'];
			$_SESSION['level_user'] = $data['level_user'];
			// echo '<script>window.location="user/index.php"</script>';
		} else if($level_user = 'Sekertaris') {
			/*
				halaman menu ini nanti hanya bisa menginputkan transaksi dari bumdes (kas dan pinjaman keuangan)
			*/
			$_SESSION['user'] = $data;
			$_SESSION['user_nama'] = $data['nama'];
			$_SESSION['level_user'] = $data['level_user'];
			// echo '<script>window.location="user/index.php"</script>';			
		} else if($level_user = 'Kepala') {
			/*
				halaman ini nanti cuman memntau keuangan desa 
			*/
			$_SESSION['user'] = $data;
			$_SESSION['user_nama'] = $data['nama'];
			$_SESSION['level_user'] = $data['level_user'];
			// echo '<script>window.location="admin/index.php?hal=beranda"</script>';
		} else if($level_user = 'Ketua') {
			/*
				Halaman ini dapat mengelola keuangan umkm
				buku besar, buku jurnal, arus kas, laba rugi, neraca, perubahan modal
			 */
		}

	} else {
		echo '<script>alert("Username dan Password tidak ditemukan!")</script>';
		echo "<script>window.location='index.php'</script>";
	}
}










/*
// Admin
if (CekExist($mysqli,$sqladmin)== true){
	$_SESSION['admin']=caridata($mysqli,$sqladmin);
	$_SESSION['admin_status']="Administrator";
    header('Location:admin/index.php');	
}
// Admin Kepala
else if (CekExist($mysqli,$sqladmin1)== true){
	$_SESSION['admin']=caridata($mysqli,$sqladmin1);
	$_SESSION['admin_status']="Admin Kepala";
	header('Location:admin/index.php?hal=beranda');
}
// User Transaksi
else if (CekExist($mysqli,$sqluser)== true){
	$_SESSION['id']=caridata($mysqli,$sqluser);
	$_SESSION['level_user']=caridata($mysqli,$sqlleveluser);
	$_SESSION['user_status']="User Transaksi";
	// echo "<script>window.location='user/index.php?hal=beranda';</script>";
    header('Location:user/index.php?hal=beranda');
}
// User Kepala
else if (CekExist($mysqli,$sqluser1)== true){
	$_SESSION['id']=caridata($mysqli,$sqluser1);
	$_SESSION['user_status']="User Kepala";
    header('Location:user/index.php?hal=beranda');
}else{
    echo "<script>alert('Username Dan Password Tidak Ditemukan!')</script>";
	echo "<script>window.location='index.php'</script>";
}
*/

?>