<?php
session_start();
require_once 'setting/crud.php';
require_once 'setting/koneksi.php';

$user=$_POST['username'];
$pass=$_POST['password']; 

//Pengecekan ada data dalam login tidak
$sqladmin="Select id_admin from tb_admin where username='$user' and password='$pass' and level_admin='Administrasi'";
$sqladmin1="Select id_admin from tb_admin where username='$user' and password='$pass' and level_admin='Kepala'";
$sqluser="Select id_unit from tb_user where username='$user' and password='$pass' and level_user='Transaksi'";
$sqluser1="Select id_unit from tb_user where username='$user' and password='$pass' and level_user='Ketua'";

// Admin
if (CekExist($mysqli,$sqladmin)== true){
	$_SESSION['admin']=caridata($mysqli,$sqladmin);
	$_SESSION['admin_status']="Admin Transaksi";
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
	// echo "<script>window.location='index.php';</script>"    
    echo "<script>alert('Username Dan Password Tidak Ditemukan!')</script>";
    header('Location:index.php');
}


?>