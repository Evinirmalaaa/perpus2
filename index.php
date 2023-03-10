<?php 
session_start();
include "config/connect.php";
if (empty($_SESSION['data_admin']['username'])) {
  $_SESSION['msg']="Anda Belum Login";
  $_SESSION['alert']="info";
  header("location:login.php");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Perpustakaan</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">
    <!-- Custom styles for this page -->
    <link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">

    <link href="vendor/select2/dist/css/select2.min.css" rel="stylesheet" type="text/css">
    <link href="vendor/select2/bs-datepicker/css/bootstrap-datepicker.min.css" rel="stylesheet" type="text/css">
    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    
</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">
        <?php 
        include 'layout/sidebar.php';
        ?>

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">
            <?php include 'layout/header.php'; ?>

                <!-- Begin Page Content -->
                <div class="container-fluid">
                    <?php 
                    if (isset($_SESSION['msg'])) {
                    ?>
                    <div class="alert alert-<?=$_SESSION['alert']?>" role="alert">
                        <?=$_SESSION['msg']?>
                    </div>
                    <?php
                        unset($_SESSION['msg']);
                    }

                    if (isset($_GET['content'])) {
                        include "content/$_GET[content].php";
                    }else{
                        include "content/home.php";
                    }?>

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <?php include 'layout/footer.php'; ?>

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Apakah anda ingin Logout?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Pilih "Logout" jika ingin keluar sesi.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="proses/auth/p_logout.php">Logout</a>
                </div>
            </div>
        </div>
    </div>

    
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    <script src="vendor/chart.js/Chart.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="js/demo/chart-area-demo.js"></script>
    <script src="js/demo/chart-pie-demo.js"></script>
    <!-- Page level plugins -->
    <script src="vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>

    <script src="vendor/select2/dist/js/select2.min.js"></script>
    <script src="vendor/bs-datepicker/js/bootstrap-datepicker.min.js"></script>
    <script src="vendor/bs-datepicker/locales/bootstrap-datepicker.id.min.js"></script>
    <!-- Page level custom scripts -->
    <script type="text/javascript">
        // Call the dataTables jQuery plugin
    $(document).ready(function() {
        $('.dataTable').DataTable();
        $('.select2').select2();
        $('.datepicker').datepicker({
            autoclose:true,
            todayBtn:true,
            format: 'dd/mm/yyyy',
            // startDate: '-3d',
            language:'id'
        });
        $(".chosen-select").chosen({disable_search_threshold: 10});
    });

    </script>
    <script type="application/javascript">
    $('input[type="file"]').change(function(e){
        var fileName = e.target.files[0].name;
        $('.custom-file-label').html(fileName);
    });
</script>
    

</body>

</html>