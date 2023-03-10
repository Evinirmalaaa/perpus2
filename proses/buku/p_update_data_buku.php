<?php
session_start();
include '../../config/connect.php';
$id_admin = $_SESSION['data_admin']['id_admin'];

if (empty($_FILES['img']['name'])) {
	$sql = mysqli_query($conn,"
		UPDATE `tb_buku` SET `judul`='$_POST[judul]',`tahun`='$_POST[tahun]',`pengarang`='$_POST[pengarang]',`penerbit`='$_POST[penerbit]',`baris_rak`='$_POST[baris_rak]',`nomor_rak`='$_POST[nomor_rak]',`keterangan`='$_POST[keterangan]'
		WHERE `kode_buku`='$_POST[kode_buku]'
						");
	if ($sql) {
		$_SESSION['msg'] = "Berhasil Meng-update Data Buku";
		$_SESSION['alert'] = "success";
		header("location:../../index.php?content=data_buku");
							
	}else{
		echo "
			UPDATE `tb_buku` SET `judul`='$_POST[judul]',`tahun`='$_POST[tahun]',`pengarang`='$_POST[pengarang]',`penerbit`='$_POST[penerbit]',`baris_rak`='$_POST[baris_rak]',`nomor_rak`='$_POST[nomor_rak]',`keterangan`='$_POST[keterangan]'
		WHERE `kode_buku`='$_POST[kode_buku]'
		";
	}
}else{
	$oldimg=mysqli_fetch_array(mysqli_query($conn,"SELECT img FROM tb_buku WHERE kode_buku = '$_POST[kode_buku]'"))['img'];

$token = "";
$codeAlphabet= "023456789ABCDEFGHJKLMNVQRSTUVWXYZX";
$alp = strlen($codeAlphabet) - 1;
for ($i=0; $i < 4; $i++) {
    $token .= $codeAlphabet[mt_rand(0, $alp)];
}
$nn = $token;
			$nama = $_FILES['img']['name'];
			$x = explode('.', $nama);

			$ekstensi = strtolower(end($x));
			$ukuran	= $_FILES['img']['size'];
			$file_tmp = $_FILES['img']['tmp_name'];	
 			$new_name = $nn.".".$ekstensi;
				if($ukuran < 2044070){			
					$upload = move_uploaded_file($file_tmp, '../../uploads/img/buku/'.$new_name);
					if ($upload) {
						$sql = mysqli_query($conn,"
							UPDATE `tb_buku` SET `judul`='$_POST[judul]',`tahun`='$_POST[tahun]',`pengarang`='$_POST[pengarang]',`penerbit`='$_POST[penerbit]',`baris_rak`='$_POST[baris_rak]',`nomor_rak`='$_POST[nomor_rak]',`img`='$new_name',`keterangan`='$_POST[keterangan]'
							WHERE `kode_buku`='$_POST[kode_buku]'
						");
						if ($sql) {
							unlink('../../uploads/img/buku/'.$oldimg);
							$_SESSION['msg'] = "Berhasil Menyelesaikan";
							$_SESSION['alert'] = "success";
							header("location:../../index.php?content=data_buku");
							
						}else{
							echo "
							INSERT INTO `tb_buku`
								(`kode_buku`, `judul`, `tahun`, `pengarang`, `penerbit`, `baris_rak`, `nomor_rak`, `img`, `keterangan`, `created_at`, `crated_by`) 
							VALUES 
								('$_POST[kode_buku]','$_POST[judul]','$_POST[tahun]','$_POST[pengarang]','$_POST[penerbit]','$_POST[baris_rak]','$_POST[nomor_rak]','$new_name','$_POST[keterangan]',NOW(),'$id_admin')
							";
						}
						}else{
							$_SESSION['msg'] = "Gagal Upload Gambar";
							$_SESSION['alert'] = "warning";
							header("location:../../index.php?content=tambah_data_buku");
						}
					
				}else{
					$_SESSION['msg'] = "Ukuran gambar terlalu besar silahkan coba lagi";
					$_SESSION['alert'] = "warning";
					header("location:../../index.php?content=tambah_data_buku");
				}
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