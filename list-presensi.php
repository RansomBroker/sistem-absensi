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
                <?php if ($_SESSION['role'] == 2 || $_SESSION['role'] == 1):?>
                    <?php $data_presensi_mahasiswa = ambil_data_seluruh_presensi_mahasiswa($_GET['id-presensi']);?>
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Status Presensi <?= isset($data_presensi_mahasiswa[0]['nama_mata_kuliah']) ? $data_presensi_mahasiswa[0]['nama_mata_kuliah']: ""?></h1>
                    </div>
                    <div class="card card-body my-4">
                        <div>
                            <div class="table-responsive">
                                <table class="table table-striped table-hover table-bordered" id="table-list-presensi">
                                    <thead>
                                    <tr>
                                        <th>Nama Presensi</th>
                                        <th>Nama</th>
                                        <th>Jam Presensi</th>
                                        <th>Tgl Presensi</th>
                                        <th>Waktu Telat (menit)</th>
                                        <th>Koordinat</th>
                                        <th>Gambar</th>
                                        <th>Status</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php foreach ($data_presensi_mahasiswa as $presensi):?>
                                        <tr>
                                            <td><?= $presensi['judul_presensi']?></td>
                                            <td><?= $presensi['nama_mahasiswa']?></td>
                                            <td><?= $presensi['jam_presensi']?></td>
                                            <td><?= $presensi['tgl_presensi']?></td>
                                            <td><?= $presensi['waktu_telat']?></td>
                                            <td><?= $presensi['coordinate']?></td>
                                            <td>
                                                <img src="/img/absensi/<?= $presensi['img']?>" alt="gambar_absensi" width="64">
                                            </td>
                                            <td>
                                                <?php if ($presensi['status'] == "Hadir"):?>
                                                    <button class="btn btn-success"><?= $presensi['status']?></button>
                                                <?php endif;?>
                                                <?php if ($presensi['status'] == "Sakit"):?>
                                                    <button class="btn btn-primary"><?= $presensi['status']?></button>
                                                <?php endif;?>
                                                <?php if ($presensi['status'] == "Izin"):?>
                                                    <button class="btn btn-warning"><?= $presensi['status']?></button>
                                                <?php endif;?>
                                                <?php if ($presensi['status'] == "Alpha"):?>
                                                    <button class="btn btn-danger"><?= $presensi['status']?></button>
                                                <?php endif;?>
                                            </td>
                                        </tr>
                                    <?php endforeach;?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                <?php endif;?>
                <?php if($_SESSION['role'] == 3):?>
                    <?php $data_presensi_mahasiswa = ambil_data_presensi_mahasiswa($_GET['id-mahasiswa'],$_GET['id-presensi']);?>
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Status Presensi <?= $data_presensi_mahasiswa['nama_mata_kuliah']?></h1>
                    </div>
                    <div class="card card-body my-4">
                        <div>
                            <div class="table-responsive">
                                <table class="table table-striped table-hover table-bordered" id="table-list-presensi">
                                    <thead>
                                        <tr>
                                            <th>Nama Presensi</th>
                                            <th>Nama</th>
                                            <th>Jam Presensi</th>
                                            <th>Tgl Presensi</th>
                                            <th>Waktu Telat (menit)</th>
                                            <th>Koordinat</th>
                                            <th>Gambar</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td><?= $data_presensi_mahasiswa['judul_presensi']?></td>
                                            <td><?= $data_presensi_mahasiswa['nama_mahasiswa']?></td>
                                            <td><?= $data_presensi_mahasiswa['jam_presensi']?></td>
                                            <td><?= $data_presensi_mahasiswa['tgl_presensi']?></td>
                                            <td><?= $data_presensi_mahasiswa['waktu_telat']?></td>
                                            <td><?= $data_presensi_mahasiswa['coordinate']?></td>
                                            <td>
                                                <img src="/img/absensi/<?= $data_presensi_mahasiswa['img']?>" alt="gambar_absensi" width="64">
                                            </td>
                                            <td>
                                                <?php if ($data_presensi_mahasiswa['status'] == "Hadir"):?>
                                                    <button class="btn btn-success"><?= $data_presensi_mahasiswa['status'] ?></button>
                                                <?php endif;?>
                                                <?php if ($data_presensi_mahasiswa['status']  == "Sakit"):?>
                                                    <button class="btn btn-primary"><?= $data_presensi_mahasiswa['status'] ?></button>
                                                <?php endif;?>
                                                <?php if ($data_presensi_mahasiswa['status']  == "Izin"):?>
                                                    <button class="btn btn-warning"><?= $data_presensi_mahasiswa['status'] ?></button>
                                                <?php endif;?>
                                                <?php if ($data_presensi_mahasiswa['status']  == "Alpha"):?>
                                                    <button class="btn btn-danger"><?= $data_presensi_mahasiswa['status'] ?></button>
                                                <?php endif;?>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
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
            let tableListPresensi = $("#table-list-presensi").DataTable();
        })
    </script>

</body>

</html>