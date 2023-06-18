<?php
session_start();
include "function.php";
if(!isset($_SESSION['login'])){
    redirect('login.php');
}

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
                    <h1 class="h3 mb-0 text-gray-800">Data Mahasiswa</h1>
                </div>

                <div class="card card-body w-100 table-responsive">
                    <table class="table table-striped" id="table-enroll-mahasiswa">
                        <thead>
                            <tr>
                                <th>Nama</th>
                                <th>NIM</th>
                                <th>Kelas</th>
                                <th>Prodi</th>
                                <th>Jurusan</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach (ambil_mahasiswa_enroll($_GET['id']) as $data):?>
                                <tr>
                                    <td><?= $data['nama']?></td>
                                    <td><?= $data['nim']?></td>
                                    <td><?= $data['kelas']?></td>
                                    <td><?= $data['prodi']?></td>
                                    <td><?= $data['jurusan']?></td>
                                </tr>
                            <?php endforeach;?>
                        </tbody>
                    </table>
                </div>
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
        $("#table-enroll-mahasiswa").DataTable();
    </script>

</body>

</html>