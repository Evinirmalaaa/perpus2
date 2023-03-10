<?php
session_start();
include '../../config/connect.php';
// echo $_POST['username'];
// echo "<br>";
// echo $_POST['password'];


$username = @$_POST['username'];
$password = @$_POST['password'];


if($username == ""|| $password == ""){
  $_SESSION['msg']="Username Dan Kata Sandi masih kosong";
    $_SESSION['alert']="info";
  header("location:$_SERVER[HTTP_REFERER]");
}else {
  $sql = mysqli_query($conn,"
    SELECT a.* FROM `tb_admin` a
    WHERE a.username = '$username' and a.password ='$password'");
  $data= @mysqli_fetch_array($sql);
  $cek = @mysqli_num_rows($sql);


  if($cek>=1){
    $_SESSION['data_admin']=$data;
    $_SESSION['msg']="Anda Berhasil Masuk";
    $_SESSION['alert']="success";
    header("location:../../index.php");
  }else{
    // header("location:../../index.php?content=home&alert=warning&msg=Kombinasi kata sandi dan nama admin salah");
    // header("location:../../login.php?alertl=warning&msgl=Kombinasi kata sandi dan nama admin salah");

    $_SESSION['msg']="Username Dan Kata Sandi Salah";
    $_SESSION['alert']="info";
    header("location:$_SERVER[HTTP_REFERER]");

    // echo "SELECT a.* FROM `tb_users` a
    // WHERE a.username = '$username' and a.password ='$password'";
  }
}
?>