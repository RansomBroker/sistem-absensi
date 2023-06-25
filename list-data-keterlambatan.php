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
                        <h1 class="h3 mb-0 text-gray-800">List Data Keterlambatan Absensi Mahasiswa</h1>
                    </div>
                    <?php if($_SESSION['role'] == 1 || $_SESSION['role'] == 2):?>
                    <div class="card card-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-hover table-bordered" id="table-list-keterlambatan">
                                <thead>
                                    <tr>
                                        <th>Nama</th>
                                        <th>NIM</th>
                                        <th>Tgl Lahir</th>
                                        <th>Alamat</th>
                                        <th>Photo</th>
                                        <th>Kelas</th>
                                        <th>Akumulasi Keterlambatan (menit)</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach (ambil_list_akumulasi_keterlambatan() as $data):?>
                                    <tr>
                                        <td><?= $data['nama_mahasiswa']?></td>
                                        <td><?= $data['nim']?></td>
                                        <td><?= $data['tgl_lahir']?></td>
                                        <td><?= $data['alamat']?></td>
                                        <td>
                                            <img class="img-profile rounded-circle"
                                                src="/img/profil/<?= $data['img'] ?>" alt="gambar_mhsw" width="64">
                                        </td>
                                        <td><?= $data['kelas']?></td>
                                        <td><?= $data['akumulasi']?></td>
                                        <?php if ($data['akumulasi'] >= 0 && $data['akumulasi'] < 600):?>
                                        <td>-</td>
                                        <?php endif;?>
                                        <?php if ($data['akumulasi'] >= 600 && $data['akumulasi'] < 960):?>
                                        <td><a href="cetak-sp-1.php?id=<?=$data['id']?>&sp=SURAT%20PERINGATAN%201%20%28Pertama%29"" class="
                                                btn btn-primary">SP1 /
                                                Klik untuk mengunduh surat</a></td>
                                        <?php endif;?>

                                        <?php if ($data['akumulasi'] >= 960 && $data['akumulasi'] < 1200):?>
                                        <td><a href="cetak-sp-2.php?id=<?=$data['id']?>&sp=SURAT%20PERINGATAN%202%20%28Kedua%29"
                                                class="btn btn-warning">SP2 /
                                                Klik untuk mengunduh surat</a></td>
                                        <?php endif;?>

                                        <?php if ($data['akumulasi'] >= 1200 && $data['akumulasi'] < 1450 ):?>
                                        <td>
                                            <a href="cetak-sp-3.php?id=<?=$data['id']?>&sp=SURAT%20PERINGATAN%203%20%28Ketiga%29"
                                                class="btn btn-danger">SP3 /
                                                Klik untuk mengunduh surat</a>
                                        </td>
                                        <?php endif;?>
                                        <?php if ($data['akumulasi'] >= 1450):?>
                                        <td>
                                            <a href="cetak-do.php?id=<?=$data['id']?>&sp=SURAT%20DROP%20OUT"
                                                class="btn btn-danger">DO/
                                                Klik untuk mengunduh surat</a>
                                        </td>
                                        <?php endif;?>
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
        $(document).ready(function() {
            $("#table-list-keterlambatan").DataTable();
        })
        </script>

</body>

</html>