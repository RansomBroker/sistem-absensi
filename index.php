<?php
session_start();
include "function.php";

?>
<!DOCTYPE html>
<html lang="en">

<head>

    <?php include "head.php"?>

    <title>Dashboard</title>

    <?php include "css.php"?>
</head>

<body id="page-top">

<!-- Page Wrapper -->
<div id="wrapper">

    <?php include "sidebar.php";?>

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

        <!-- Main Content -->
        <div id="content">

            <?php include "navbar.php";?>

            <!-- Begin Page Content -->
            <div class="container-fluid">
                <div class="d-sm-flex align-items-center justify-content-between mb-4">
                    <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
                </div>
                <?php if($_SESSION['role'] == 1):?>
                    <div class="card card-body">
                        <div class="justify-content-center row ">
                            <div class="mx-4 card card-body col-lg-3">
                                <h5>Dosen</h5>
                                <a href="#">More Info</a>
                            </div>
                            <div class="mx-4 card card-body col-lg-3">
                                <h5>Mahasiswa</h5>
                                <a href="#">More Info</a>
                            </div>
                            <div class="mx-4 card card-body col-lg-3">
                                <h5>User</h5>
                                <a href="user.php">More Info</a>
                            </div>
                        </div>
                    </div>
                <?php endif;?>
                <?php if($_SESSION['role'] == 2):?>
                    <div class="card card-body">
                        <h5>HI ASRUL</h5>
                    </div>
                <?php endif;?>
                <?php if($_SESSION['role'] == 3):?>
                    <div class="card card-body">
                        <h5>HI Azdi</h5>
                    </div>
                <?php endif;?>    
            </div>


        </div>
        <!-- End of Content Wrapper -->
        <?php include "footer.php"?>
    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <?php include "logout_modal.php"?>
    
    <?php include "js.php"?>
    <script>
        $(document).ready(function () {
            let tabelMataKuliah = $("#table-mata-kuliah").DataTable();
        })
    </script>

</body>

</html>