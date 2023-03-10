<?php
session_start();
include '../../config/connect.php';
$id_admin = $_SESSION['data_admin']['id_admin'];
$sql = mysqli_query($conn,"
	DELETE FROM `tb_pinjam` WHERE `kode_pinjam` = '$_GET[kode_pinjam]'
");
if ($sql) {
	unlink('../../uploads/img/pinjam/'.$oldimg);
	$_SESSION['alert'] = "success";
    $_SESSION['msg'] = "Berhasil Menghapus Data Pinjam";
	header("location:../../index.php?content=data_pinjam");
}else{
	echo "
	DELETE FROM `tb_pinjam` WHERE `kode_pinjam` = '$_GET[kode_pinjam]'
	";
}
?>