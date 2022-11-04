<?php
require_once '../../../setting/koneksi.php';

	$password=$_POST['password'];
	$uppercase = preg_match('@[A-Z]@', $password);
	$lowercase = preg_match('@[a-z]@', $password);
	$number    = preg_match('@[0-9]@', $password);
	if(!$uppercase || !$lowercase || !$number || strlen($password) < 8) {
		echo "<script>alert('Password minimal 8 Character dengan ada huruf kecil, besar dan Nomor')</script>";
		echo "<script>window.location='javascript:history.go(-1)';</script>";
	}else{
		$stmt = $mysqli->prepare("UPDATE tb_user  SET 
			nama_user=?,
			username=?,
			password=?,
			id_unit=?,
			level_user=?
			where id_user=?");
		$stmt->bind_param("ssssss",
			$_POST['nama_user'],
			$_POST['username'],
			$_POST['password'],
			$_POST['id_unit'],
			$_POST['level_user'],
			$_POST['id_user']);	

		if($stmt->execute()) { 
            // $_SESSION['info'] = [
            //     'status' => 'success',
            //     'message' => 'Berhasil update data'
            // ];
			echo "<script>alert('Data User berhasil disimpan')</script>";
			echo "<script>window.location='../../index.php?hal=user';</script>";	
            // header('Location:../../index.php?hal=user');
        } else {
            // $_SESSION['info'] = [
            //     'status' => 'gagal',
            //     'message' => 'Gagal upadte data'
            // ];
            echo "<script>alert('Data User Gagal disimpan')</script>";
			echo "<script>window.location='javascript:history.go(-1)';</script>";
        }
	}

?>