<?php
session_start();
include '../../config/connect.php';
$id_admin = $_SESSION['data_admin']['id_admin'];


$token = "";
$codeAlphabet= "023456789ABCDEFGHJKLMNVQRSTUVWXYZX";
$alp = strlen($codeAlphabet) - 1;
for ($i=0; $i < 6; $i++) {
    $token .= $codeAlphabet[mt_rand(0, $alp)];
}
$nn = $token;
			$nama = $_FILES['img']['name'];
			$x = explode('.', $nama);

			$ekstensi = strtolower(end($x));
			$ukuran	= $_FILES['img']['size'];
			$file_tmp = $_FILES['img']['tmp_name'];	
 			$new_name = $nn.".".$ekstensi;
				if($ukuran < 4044070){			
					$upload = move_uploaded_file($file_tmp, '../../uploads/img/siswa/'.$new_name);
					if ($upload) {
						$sql = mysqli_query($conn,"
							INSERT INTO `tb_siswa`
								(`nis`, `nama`, `jk`, `alamat`, `kelas`, `foto`, `created_at`, `created_by`) 
							VALUES 
								('$_POST[nis]','$_POST[nama]','$_POST[jk]','$_POST[alamat]','$_POST[kelas]','$new_name',NOW(),'$id_admin')
						");
						if ($sql) {
							$_SESSION['msg'] = "Berhasil Menambah Data Siswa";
							$_SESSION['alert'] = "success";
							header("location:../../index.php?content=data_siswa");
							
						}else{
							echo "
							INSERT INTO `tb_siswa`
								(`nis`, `nama`, `jk`, `alamat`, `kelas`, `foto`, `created_at`, `created_by`) 
							VALUES 
								('$_POST[nis]','$_POST[nama]','$_POST[jk]','$_POST[alamat]','$_POST[kelas]','$new_name',NOW(),'$id_admin')
							";
						}
						}else{
							$_SESSION['msg'] = "Gagal Upload Gambar";
							$_SESSION['alert'] = "warning";
							header("location:../../index.php?content=data_siswa");
						}
					
				}else{
					$_SESSION['msg'] = "Ukuran gambar terlalu besar silahkan coba lagi";
					$_SESSION['alert'] = "warning";
					header("location:../../index.php?content=data_siswa");
				}
		





















// $sql = mysqli_query($conn,"
// 	UPDATE `tb_jadwal` 
// 	SET `nama_area`='$_POST[nama_area]',`keterangan`='$_POST[keterangan]',`updated_at`=NOW(),`updated_by`='$id_akun' WHERE `id_jadwal` = '$_POST[id_jadwal]'
// ");
// if ($sql) {
// 	$_SESSION['alert'] = "success";
//     $_SESSION['msg'] = "Berhasil Meng-update Data area";
// 	header("location:../../index.php?menu=area&content=data_area");
// }else{
// 	echo "
// 	UPDATE `tb_jadwal` 
// 	SET `nama_area`='$_POST[nama_area]',`keterangan`='$_POST[keterangan]',`updated_at`=NOW(),`updated_by`='$id_akun' WHERE `id_jadwal` = '$_POST[id_jadwal]'
// 	";
// }
?>