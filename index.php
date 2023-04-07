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

                    <div class="card card-body my-4">
                        <h5 class="card-title">List kelas</h5>
                        <button data-id="<?= $_SESSION['id']?>" class="btn-enroll btn btn-warning mb-3">Enroll Kelas</button>
                        <div>
                            <div class="table-responsive">
                                <table class="table table-striped table-hover table-bordered" id="table-mata-kuliah">
                                    <thead>
                                        <tr>
                                            <th>Nama Mata Kuliah</th>
                                            <th>Dosen Pengampu</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach (ambil_data_mata_kuliah_mahasiswa($_SESSION['id']) as $data):?>
                                            <tr>
                                                <td><?= $data['name']?></td>
                                                <td><?= $data['nama']?></td>
                                            </tr>
                                        <?php endforeach;?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
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
            let tableMataKuliah = $("#table-mata-kuliah").DataTable()
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

            $(".btn-enroll").on('click', function() {
                let id = $(this).attr('data-id')
                Swal.fire({
                    title: "Enroll Kelas",
                    html: `<div class="form-group">
                                <label class="form-label">Kode Kelas</label>
                                <input type="text" class="form-control" name="enroll-code">
                           </div>`,
                    showCancelButton: true,
                    reverseButtons: true,
                    preConfirm: function () {
                        return new Promise(function (resolve) {
                            if($('[name=enroll-code]').val() === '') {
                                swal.showValidationMessage("Masukan Kode Kelas")
                                swal.enableButtons();
                                return 0;
                            }

                            if ($('[name=enroll-code]').val() != '') {
                                swal.resetValidationMessage();
                                resolve({
                                    "enrollCode" : $("[name=enroll-code]").val(),
                                });
                            }
                        })
                    }
                }).then((result) => {
                    let enrollCode = result.value.enrollCode;
                    $.ajax({
                        url: "enroll-kelas.php?enroll-code="+enrollCode + "&id=" + id,
                        method: "GET",
                        success: function(data) {
                            let response = JSON.parse(data);
                            if (response[0].code === 0) {
                                Swal.fire('error', response[0].message, 'error')
                                return 0;
                            }
                            window.location.reload();
                        }
                    })
                })
            })
        })
    </script>

</body>

</html>