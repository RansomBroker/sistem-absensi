<?php
session_start();
include "function.php";

?>
<!DOCTYPE html>
<html lang="en">

<head>

    <?php include "head.php"?>

    <title>Data Mahasiswa</title>

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
                <div class="card card-body my-3">
                        <h5 class="card-title">Data Mahasiswa</h5>
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover table-striped" id="table-user">
                                <thead>
                                    <tr>
                                        <th>Username</th>
                                        <th>NIM</th>
                                        <th>Nama</th>
                                        <th>Kelas</th>
                                        <th>Tempat Lahir</th>
                                        <th>Tanggal Lahir</th>
                                        <th>Angkatan</th>
                                        <th>Alamat</th>
                                        <th>Moto Hidup</th>
                                        <th>Kemampuan Pribadi</th>
                                        <th>Foto</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach (ambil_data_mahasiswa() as $users):?>
                                        <tr data-id-users="<?= $users['id']?>">
                                            <td><?= $users['username']?></td>
                                            <td><?= $users['nomor_induk']?></td>
                                            <td class="text-capitalize"><?= $users['nama']?></td>
                                            <td class="text-capitalize"><?= $users['kelas']?></td>
                                            <td class="text-capitalize"><?= $users['tempat_lahir']?></td>
                                            <td><?= $users['tgl_lahir']?></td>
                                            <td class="text-capitalize"><?= $users['angkatan']?></td>
                                            <td class="text-capitalize"><?= $users['alamat']?></td>
                                            <td><?= $users['moto_hidup']?></td>
                                            <td><?= $users['kemampuan_pribadi']?></td>
                                            <td><img width=64 src="img/profil/<?= $users['img']?>"></td>
                                            <td><a href="hapus-user.php?id=<?=$users['id']?>&role=3" class="ml-3 btn btn-danger">Hapus</a></td>
                                        </tr>
                                    <?php endforeach;?>
                                </tbody>
                            </table>
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

    <?php include "logout_modal.php"?>
    
    <?php include "js.php"?>
</body>

</html>