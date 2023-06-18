<?php
session_start();
include "function.php";

$data_absen = $_SESSION['role'] == 2 ? ambil_data_absen_dosen($_SESSION['id']): ambil_data_absen($_SESSION['id']);

?>
<!DOCTYPE html>
<html lang="en">

<head>

    <?php include "head.php"?>

    <title>Kelola Absensi</title>

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
                    <h1 class="h3 mb-0 text-gray-800">Kelola Absensi</h1>
                </div>

                <div class="card card-body row">
                    <?php if ($_SESSION['role'] == 1 ):?>
                        <a href="tambah-data-absen.php" class="btn btn-warning col-lg-4 col-12">Tambah Absensi</a>
                    <?php endif;?>

                    <?php if (get_flash_name('berhasil_tambah_absen') != ""):?>
                        <div class="alert alert-success my-3">
                            <?= get_flash_message('berhasil_tambah_absen')?>
                        </div>
                    <?php endif;?>
                    <?php if (get_flash_name('gagal_tambah_absen') != ""):?>
                        <div class="alert alert-danger my-3">
                            <?= get_flash_message('gagal_tambah_absen')?>
                        </div>
                    <?php endif;?>

                    <div class="col-12 col-lg-12 mt-4">
                        <h5 class="fw-bold">List Absensi</h5>
                        <div class="table-responsive">
                            <?php if ($_SESSION['role'] == 1):?>
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
                                                <a href="list-presensi.php?id-presensi=<?= $data['presensi_id']?>"  class="btn btn-success">Lihat Presensi</a>
                                            </td>
                                        </tr>
                                    <?php endforeach;?>
                                    </tbody>
                                </table>
                            <?php endif;?>
                            <?php if ($_SESSION['role'] == 2):?>
                                <table class="table table-striped table-hover table-bordered" id="table-absensi">
                                    <thead>
                                    <tr>
                                        <th>Nama</th>
                                        <th>Matkul</th>
                                        <th>Waktu Absen</th>
                                        <th>Tanggal Absen</th>
                                        <th>Waktu Dispensasi</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php foreach ($data_absen as $data):?>
                                        <tr>
                                            <td><?= $data['nama_presensi'] ?></td>
                                            <td><?= $data['nama_matkul']?></td>
                                            <td><?= $data['jam_masuk'].'-'.$data['jam_keluar']?></td>
                                            <td><?= $data['tgl_absen']?></td>
                                            <td><?= $data['waktu_dispensasi']?></td>
                                            <td>
                                                <a href="list-presensi.php?id-presensi=<?= $data['presensi_id']?>"  class="btn btn-success">Lihat Presensi</a>
                                                <a href="ubah-data-absen.php?id=<?= $data['presensi_id']?>" class="btn-edit btn btn-warning">Edit</a>
                                                <button class="btn-remove btn btn-danger" data-id="<?=$data['presensi_id']?>">Hapus</button>
                                            </td>
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
            let tableDataAbsensi = $("#table-absensi").DataTable()
            $(".btn-remove").click(function () {
                let idMataKuliah = $(this).attr('data-id')
                Swal.fire({
                    title: 'question',
                    text: 'Yakin ingin menghapus ?',
                    showCancelButton: true,
                    reverseButtons: true
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = 'hapus-data-absen.php?id=' + idMataKuliah
                    }
                })
            })
        })
    </script>

</body>

</html>