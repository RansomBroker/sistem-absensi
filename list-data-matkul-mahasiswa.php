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

                <div class="card card-body w-100 table-responsive">
                    <table class="table table-striped" id="table-enroll-mahasiswa">
                        <thead>
                            <tr>
                                <th>Nama</th>
                                <th>NIM</th>
                                <th>Kelas</th>
                                <th>Prodi</th>
                                <th>Jurusan</th>
                                <th>Aksi</th>
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
                                    <td>
                                        <button class="btn-remove btn btn-danger" data-id="<?=$data['id_mahasiswa']?>" data-id-matkul="<?= $_GET['id']?>">Hapus</button>
                                    </td>
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

        $(document).on("click", ".btn-remove", function () {
            let idMahasiswa = $(this).attr('data-id')
            let idMatkul = $(this).attr('data-id-matkul')
            Swal.fire({
                title: 'question',
                text: 'Yakin ingin menghapus ?',
                showCancelButton: true,
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = 'hapus-enroll-mahasiswa.php?id=' + idMahasiswa + '&mata_kuliah_id=' + idMatkul
                }
            })
        })
    </script>

</body>

</html>