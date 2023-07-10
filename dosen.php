<?php
session_start();
include "function.php";

?>
<!DOCTYPE html>
<html lang="en">

<head>

    <?php include "head.php"?>

    <title>Data Dosen</title>

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
                    <h1 class="h3 mb-0 text-gray-800">Data Dosen</h1>
                </div>
                <div class="card card-body my-3">
                        <h5 class="card-title">Data Dosen</h5>
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover table-striped" id="table-user">
                                <thead>
                                    <tr>
                                        <th>Username</th>
                                        <th>Nama</th>
                                        <th>NIP</th>
                                        <th>Foto</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach (ambil_data_dosen() as $users):?>
                                        <tr data-id-users="<?= $users['id']?>">
                                            <td><?= $users['username']?></td>
                                            <td class="text-capitalize"><?= $users['nama']?></td>
                                            <td class="text-capitalize"><?= $users['nomor_induk']?></td>
                                            <td><img width=64 src="img/profil/<?= $users['img']?>"></td>
                                            <td><a data-id="<?=$users['id']?>"  class="btn-remove ml-3 btn btn-danger">Hapus</a></td>
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
    <script>
        $(document).ready(function () {
            $(document).on("click", ".btn-remove", function(() {
                let idUser = $(this).attr('data-id')
                Swal.fire({
                    title: 'question',
                    text: 'Yakin ingin menghapus ?',
                    showCancelButton: true,
                    reverseButtons: true
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = 'hapus-user.php?id='+ idUser +'&role=2'
                    }
                })

            }))
        })
    </script>
</body>

</html>