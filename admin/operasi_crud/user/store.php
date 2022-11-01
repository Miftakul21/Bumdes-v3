<?php 
require_once '../../../setting/koneksi.php';

$password=$_POST['password'];
$uppercase = preg_match('@[A-Z]@', $password);
$lowercase = preg_match('@[a-z]@', $password);
$number    = preg_match('@[0-9]@', $password);

if(!$uppercase || !$lowercase || !$number || strlen($password) < 8) {
	echo "<script>alert('Password minimal 8 Character dengan ada Huruf kecil, Besar, dan Nomor')</script>";
    echo "<script>window.location='javascript:history.go(-1)';</script>";
}else{
    $id_unit = $_POST['id_unit'];
    $nama_user = $_POST['nama_user'];
    $nama_lengkap_user = $_POST['nama_lengkap_user'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $level_user = $_POST['level_user'];

    $stmt = $mysqli->prepare("INSERT INTO tb_user (nama_user,nama_lengkap_user,username,password,id_unit,level_user) VALUES (?,?,?,?,?,?)");

    $stmt->bind_param("ssssss", 
        $_POST['nama_user'],
        $_POST['nama_lengkap_user'],
        $_POST['username'],
        $_POST['password'],
        $_POST['id_unit'],
        $_POST['level_user'],
    );

    if($stmt->execute()) { 
        $_SESSION['info'] = [
            'status' => 'success',
            'message' => 'Berhasil menambah data'
        ];
        echo "<script>alert('Data user Berhasil Ditambah')</script>";
        echo "<script>window.location='../../index.php?hal=user';</script>";	
        // header('Location:../../index.php?hal=user');
    } else {
        $_SESSION['info'] = [
            'status' => 'gagal',
            'message' => 'Gagal menambah data'
        ];
        echo "<script>alert('Data user Gagal Ditambah')</script>";
        // echo "<script>window.location='index.php?hal=user';</script>";	
        header('Location:index.php?hal=user');    
    }
}

?>