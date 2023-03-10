<?php
session_start();
include '../../config/connect.php';
$id_admin = $_SESSION['data_admin']['id_admin'];
$oldimg=mysqli_fetch_array(mysqli_query($conn,"SELECT foto FROM tb_buku WHERE kode_buku = '$_GET[kode_buku]'"))['foto'];
$sql = mysqli_query($conn,"
	DELETE FROM `tb_siswa` WHERE `id_siswa` = '$_GET[id_siswa]'
");
if ($sql) {
	unlink('../../uploads/img/siswa/'.$oldimg);
	$_SESSION['alert'] = "success";
    $_SESSION['msg'] = "Berhasil Menghapus Data Siswa";
	header("location:../../index.php?content=data_siswa");
}else{
	echo "
	DELETE FROM `tb_siswa` WHERE `id_siswa` = '$_GET[id_siswa]'
	";
}
?>