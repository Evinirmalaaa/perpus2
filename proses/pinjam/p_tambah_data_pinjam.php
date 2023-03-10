<?php
session_start();
include '../../config/connect.php';
$id_admin = $_SESSION['data_admin']['id_admin'];


$sql = mysqli_query($conn,"
	INSERT INTO `tb_pinjam`
		(`kode_pinjam`,`kode_buku`, `nis`, `sampai`, `hp`, `keterangan`, `created_at`, `created_by`) 

	VALUES 
		('$_POST[kode_pinjam]','$_POST[kode_buku]','$_POST[nis]','$_POST[sampai]','$_POST[hp]','$_POST[keterangan]',NOW(),'$id_admin')
");
if ($sql) {
	$_SESSION['alert'] = "success";
    $_SESSION['msg'] = "Berhasil Meng-update Data Peminjaman";
	header("location:../../index.php?content=data_pinjam");
}else{
	echo "
	INSERT INTO `tb_pinjam`
		(`kode_pinjam`,`kode_buku`, `nis`, `sampai`, `hp`, `keterangan`, `created_at`, `created_by`) 

	VALUES 
		('$_POST[kode_pinjam]','$_POST[kode_buku]','$_POST[nis]','$_POST[sampai]','$_POST[hp]','$_POST[keterangan]',NOW(),'$id_admin')
	";
}


// $sql = mysqli_query($conn,"
// 	UPDATE `tb_jadwal` 
// 	SET `nama_pinjam`='$_POST[nama_pinjam]',`keterangan`='$_POST[keterangan]',`updated_at`=NOW(),`updated_by`='$id_akun' WHERE `id_jadwal` = '$_POST[id_jadwal]'
// ");
// if ($sql) {
// 	$_SESSION['alert'] = "success";
//     $_SESSION['msg'] = "Berhasil Meng-update Data pinjam";
// 	header("location:../../index.php?menu=pinjam&content=data_pinjam");
// }else{
// 	echo "
// 	UPDATE `tb_jadwal` 
// 	SET `nama_pinjam`='$_POST[nama_pinjam]',`keterangan`='$_POST[keterangan]',`updated_at`=NOW(),`updated_by`='$id_akun' WHERE `id_jadwal` = '$_POST[id_jadwal]'
// 	";
// }
?>