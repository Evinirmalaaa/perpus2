<?php
$servername = "localhost:3308";
$username 	= "root";
$password 	= "";
$database 	= "db_perpus";

// untuk tulisan bercetak tebal silakan sesuaikan dengan detail database Anda
// membuat koneksi
$conn = mysqli_connect($servername, $username, $password, $database);
// mengecek koneksi
if ($conn) {
	// echo "Koneksi berhasil";
}else{
	"Koneksi gagal: " . mysqli_connect_error();
}
?>