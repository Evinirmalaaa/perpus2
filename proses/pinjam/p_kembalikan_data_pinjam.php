<?php
session_start();
include '../../config/connect.php';
$id_admin = $_SESSION['data_admin']['id_admin'];
$sql = mysqli_query($conn,"
	UPDATE `tb_pinjam` 
	SET `status`='1' WHERE `kode_pinjam` = '$_GET[kode_pinjam]'
");
if ($sql) {
	$_SESSION['alert'] = "success";
    $_SESSION['msg'] = "Berhasil Mengembalikan Data Peminjaman";
	header("location:../../index.php?content=data_pinjam");
}else{
	echo "
	UPDATE `tb_jadwal` 
	SET `status`='1' WHERE `kode_pinjam` = '$_GET[kode_pinjam]'
	";
}
?>