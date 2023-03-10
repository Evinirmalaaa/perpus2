<?php
session_start();
// session_unset();
// session_destroy();
unset($_SESSION['data_admin']); 
$_SESSION['msg']="Anda Berhasil Keluar";
    $_SESSION['alert']="success";
header("location:../../login.php");
?>