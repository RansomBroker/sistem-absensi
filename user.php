<?php
session_start();
include "function.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <?php include "head.php"?>

    <title>User</title>

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
                    <h1 class="h3 mb-0 text-gray-800">User</h1>
                </div>
                <?php if(get_flash_name('add_success') != ""):?>
                    <div class="alert alert-success" role="alert">
                         <?= get_flash_message('add_success')?>
                    </div>	
                <?php endif;?>
                <div class="card card-body">
                    <a href="tambah-user.php" class="btn btn-warning col-lg-4 col-12 mb-4">Tambah User</a> 
                </div>

                 <div class="card card-body my-3">
                        <h5 class="card-title">Data User</h5>
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover table-striped" id="table-user">
                                <thead>
                                    <tr>
                                        <th>Action</th>
                                        <th>Username</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach (ambil_data_user() as $users):?>
                                        <tr data-id-users="<?= $users['id']?>">
                                            <td><a href="ubah-user.php?id=<?=$users['id']?>" class="btn btn-primary">Ubah</a><a href="hapus-user.php?id=<?=$users['id']?>" class="ml-3 btn btn-danger">Hapus</a></td>
                                            <td><?= $users['username']?></td>
                                            <td><?php 
                                                    if($users['role']==1){
                                                        echo "Admin";
                                                    }if($users['role']==2){
                                                        echo "Dosen";
                                                    }if($users['role']==3){
                                                        echo "Mahasiswa";
                                                    }
                                                ?>
                                            </td>
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
            let tabeluser = $("#table-user").DataTable();
        })
    </script>

</body>

</html>