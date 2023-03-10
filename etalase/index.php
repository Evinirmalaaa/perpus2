<?php 
session_start();
include "../config/connect.php";

?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
    <!-- Custom fonts for this template-->
    <link href="../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <title>Hello, world!</title>
    <style type="text/css">
        body{
            background-image: url(../img/bg.png); 
            /*background-repeat: no-repeat;*/
            background-size:cover;
        }
    </style>
  </head>
  <body>
    <nav class="navbar navbar-expand-lg navbar-dark " style="background-color: #ff597b;">
      <a class="navbar-brand" href="#">
        <img src="../img/logo.png" width="30" height="30" class="d-inline-block align-top" alt="">
        Perpustakaan
      </a>

      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
          <li class="nav-item active">
            <a class="nav-link" href="index.php">Home <span class="sr-only">(current)</span></a>
          </li>
        </ul>
        <form class="form-inline my-2 my-lg-0">
          <input class="form-control mr-sm-2" type="search" placeholder="Cari" name="q" value="<?=isset($_GET['q'])?$_GET['q']:''?>" aria-label="Search">
          <button class="btn btn-success my-2 my-sm-0" type="submit">Search</button>
        </form>
      </div>
    </nav>
    <div class="container my-2">
      <?php 
      if (isset($_GET['q'])) {
      ?>
        <div class="alert alert-info" role="alert">
          Kunci Pencarian : <?=$_GET['q']?>
        </div>
      <?php
      }
      ?>
      <div class="row">

                <?php 

                if (isset($_GET['q'])) {
            $w= "WHERE judul LIKE '%$_GET[q]%' || pengarang LIKE '%$_GET[q]%' || penerbit LIKE '%$_GET[q]%' || tahun LIKE '%$_GET[q]%' || baris_rak LIKE '%$_GET[q]%' || nomor_rak LIKE '%$_GET[q]%'";
          }else{
            $w="";
          }

        $batas = 9;
        $halaman = isset($_GET['halaman'])?(int)$_GET['halaman'] : 1;
        $halaman_awal = ($halaman>1) ? ($halaman * $batas) - $batas : 0;  
 
        $previous = $halaman - 1;
        $next = $halaman + 1;
        
        $data = mysqli_query($conn,"
          SELECT *
            FROM `tb_buku` 
            ".$w." ORDER BY created_at DESC"
        );
        $jumlah_data = mysqli_num_rows($data);
        $total_halaman = ceil($jumlah_data / $batas);
 
        $data_buku = mysqli_query($conn,"

          SELECT *
          FROM `tb_buku` 
            ".$w." ORDER BY created_at DESC
          LIMIT $halaman_awal, $batas");
        $nomor = $halaman_awal+1;

       
          
          $no=1;
          while ($d= mysqli_fetch_array($data_buku)) {
        ?>
        <div class="col-md-4 p-1">
          <div class="card m-1">
            <img src="../uploads/img/buku/0S3Z.jpg" class="card-img-top w-100" lt="...">
            <div class="card-body text-center">
              <h4><?=strtoupper($d['judul'])?> (<?=$d['tahun']?>)</h4>
              <h5 class="card-text" title="Penerbit"><?=$d['penerbit']?></h5>
              <div class="row">
                <div class="col text-left">
                  <i class="fa fa-user" title="Pengarang"></i> <?=$d['pengarang']?>
                </div>
                <div class="col text-right">
                <i class="fa fa-table" title="Baris Rak"></i>:<?=$d['baris_rak']?> | <i class="fa fa-sort-numeric-up" title="Nomor Rak"></i>:<?=$d['nomor_rak']?>
                </div>
              </div>
              <p></p>
              <p class="card-text"><?=$d['keterangan']?>.</p>
            </div>
          </div>
        </div>
        <?php 
        }
        ?>
        

      </div>
          <nav>
      <ul class="pagination justify-content-center mt-3">
        <li class="page-item <?=$halaman=='1'?'disabled':''?>">
          <a class="page-link" <?php if($halaman > 1){ echo "href='?halaman=$previous'"; } ?>>Previous</a>
        </li>
        <?php 
        for($x=1;$x<=$total_halaman;$x++){
          if ($x<($halaman-2) || $x>($halaman+3)) {
            $non = "d-none";
          }else{
            $non = "";
          }
          ?> 
          <li class="page-item <?=$x==$halaman?'active':''?> <?=$non?>"><a class="page-link" href="?halaman=<?php echo $x ?>"><?php echo $x; ?></a></li>
          <?php
        }
        ?>        
        <li class="page-item <?=$halaman==$total_halaman?'disabled':''?>">
          <a  class="page-link" <?php if($halaman < $total_halaman) { echo "href='?halaman=$next'"; } ?>>Next</a>
        </li>
      </ul>
    </nav>
    </div>
    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: jQuery and Bootstrap Bundle (includes Popper) -->
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.min.js" integrity="sha384-+sLIOodYLS7CIrQpBjl+C7nPvqq+FbNUBDunl/OZv93DB7Ln/533i8e/mZXLi/P+" crossorigin="anonymous"></script>
    -->
  </body>
</html>
