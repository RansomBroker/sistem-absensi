<?php
session_start();
include "function.php";
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
                    <a href="tambah-mata-kuliah.php" class="btn btn-warning col-lg-4 col-12">Tambah mata Kuliah</a>

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
                            <table class="table table-striped table-hover table-bordered" id="table-mata-kuliah">
                                <thead>
                                    <tr>
                                        <th>Aksi</th>
                                        <th>Nama Mata Kuliah</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach (ambil_data_mata_kuliah() as $mata_kuliah):?>
                                        <tr>
                                            <td>
                                                <a href="edit-mata-kuliah.php?id=<?=$mata_kuliah['id']?>" class="btn btn-success">Edit</a>
                                                <a href="hapus-mata-kuliah.php?id=<?=$mata_kuliah['id']?>" class="btn btn-danger">Hapus</a>
                                            </td>
                                            <td><?= $mata_kuliah['nama']?></td>
                                        </tr>
                                    <?php endforeach;?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>


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
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="login.php">Logout</a>
                </div>
            </div>
        </div>
    </div>

    <?php include "js.php"?>
    <script>
        $(document).ready(function () {
            let tabelMataKuliah = $("#table-mata-kuliah").DataTable();
        })
    </script>

</body>

</html>