<?php
session_start();
include "function.php";

$data_absen = ambil_data_absen();
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
                                <a href="dosen.php">More Info</a>
                            </div>
                            <div class="mx-4 card card-body col-lg-3">
                                <h5>Mahasiswa</h5>
                                <a href="mahasiswa.php">More Info</a>
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
                        <h5 class="card-title">HI <?=$_SESSION['nama']?></h5>
                    </div>
                <?php endif;?>
                <?php if($_SESSION['role'] == 3):?>
                    <div class="card card-body">
                        <h5 class="card-title">HI <?=$_SESSION['nama']?></h5>
                    </div>

                    <div class="card card-body mt-4">
                        <h5 class="card-title">List Absen</h5>
                        <div class="table-responsive">
                            <table class="table table-striped table-hover table-bordered" id="table-absensi">
                                <thead>
                                <tr>
                                    <th>Nama</th>
                                    <th>Dosen Pengampu</th>
                                    <th>Waktu Absen</th>
                                    <th>Tanggal Absen</th>
                                    <th>Waktu Dispensasi</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php foreach ($data_absen as $data):?>
                                    <tr>
                                        <td><?= $data['nama_matkul'] ?></td>
                                        <td><?= $data['dosen_pengampu']?></td>
                                        <td><?= $data['jam_masuk'].'-'.$data['jam_keluar']?></td>
                                        <td><?= $data['tgl_absen']?></td>
                                        <td><?= $data['waktu_dispensasi']?></td>
                                        <td>
                                            <button  class="btn-absen btn btn-warning">Isi Kehadiran</button>
                                        </td>
                                    </tr>
                                <?php endforeach;?>
                                </tbody>
                            </table>
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
            let tableDataAbsensi = $("#table-absensi").DataTable()
            
            $('.btn-absen').on('click', function () {
                Swal.fire({
                    title: "Isi Kehadiran",
                    html: `<div class="camera">
                              <video id="video">Video stream not available.</video>
                              <button id="startbutton">Take photo</button>
                            </div>`,
                    didOpen: () => {
                    }
                })
            })
        })
    </script>

</body>

</html>