<?php
session_start();
include '../../config/connect.php';
$id_admin = $_SESSION['data_admin']['id_admin'];
$oldimg=mysqli_fetch_array(mysqli_query($conn,"SELECT img FROM tb_buku WHERE kode_buku = '$_GET[kode_buku]'"))['img'];
$sql = mysqli_query($conn,"
	DELETE FROM `tb_buku` WHERE `kode_buku` = '$_GET[kode_buku]'
");
if ($sql) {
	unlink('../../uploads/img/buku/'.$oldimg);
	$_SESSION['alert'] = "success";
    $_SESSION['msg'] = "Berhasil Menghapus Data buku";
	header("location:../../index.php?content=data_buku");
}else{
	echo "
	DELETE FROM `tb_buku` WHERE `kode_buku` = '$_GET[kode_buku]'
	";
}
?>