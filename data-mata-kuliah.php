<?php
session_start();
include "function.php";

$data_mata_kuliah = ambil_data_mata_kuliah() ;
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <?php include "head.php"?>

    <title>Kelola Mata Kuliah</title>

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
                    <h1 class="h3 mb-0 text-gray-800">Kelola Mata Kuliah</h1>
                </div>

                <div class="card card-body row">
                    <?php if ($_SESSION['role'] == 1):?>
                        <a href="tambah-data-mata-kuliah.php" class="btn btn-warning col-lg-4 col-12">Tambah Mata Kuliah</a>
                    <?php endif;?>

                    <?php if (get_flash_name('berhasil_tambah_mata_kuliah') != ""):?>
                        <div class="alert alert-success my-3">
                            <?= get_flash_message('berhasil_tambah_mata_kuliah')?>
                        </div>
                    <?php endif;?>
                    <?php if (get_flash_name('gagal_tambah_mata_kuliah') != ""):?>
                        <div class="alert alert-danger my-3">
                            <?= get_flash_message('gagal_tambah_mata_kuliah')?>
                        </div>
                    <?php endif;?>

                    <div class="col-12 col-lg-12 mt-4">
                        <h5 class="fw-bold">List Mata Kuliah</h5>
                        <div class="table-responsive">
                            <?php if ($_SESSION['role'] == 1):?>
                                <table class="table table-striped table-hover table-bordered" id="table-mata-kuliah">
                                    <thead>
                                    <tr>
                                        <th>Nama Mata Kuliah</th>
                                        <th>Dosen Pengampu</th>
                                        <th>Kode Enroll</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($data_mata_kuliah as $mata_kuliah):?>
                                            <tr>
                                                <td><?= $mata_kuliah['name']?></td>
                                                <td><?= $mata_kuliah['dosen_pengampu']?></td>
                                                <td><?= $mata_kuliah['enroll_code']?></td>
                                                <td>
                                                    <a href="ubah-mata-kuliah.php?id=<?=$mata_kuliah['id_mata_kuliah']?>" class="btn btn-warning">Edit</a>
                                                    <a href="hapus-mata-kuliah.php?id=<?=$mata_kuliah['id_mata_kuliah']?>" class="btn btn-danger">Hapus</a>
                                                </td>
                                            </tr>
                                        <?php endforeach;?>
                                    </tbody>
                                </table>
                            <?php endif;?>
                            <?php if ($_SESSION['role'] == 2):?>
                                <table class="table table-striped table-hover table-bordered" id="table-mata-kuliah">
                                    <thead>
                                    <tr>
                                        <th>Nama Mata Kuliah</th>
                                        <th>Kode Enroll</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($data_mata_kuliah as $mata_kuliah):?>
                                            <tr>
                                                <td><?= $mata_kuliah['name']?></td>
                                                <td><?= $mata_kuliah['enroll_code']?></td>
                                            </tr>
                                        <?php endforeach;?>
                                    </tbody>
                                </table>
                            <?php endif;?>
                        </div>
                    </div>
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

    <!-- Logout Modal-->
    <?php include "logout_modal.php"?>

    <?php include "js.php"?>
    <script>
        $(document).ready(function () {
            let tableDataMataKuliah = $("#table-mata-kuliah").DataTable()
        })
    </script>

</body>

</html>