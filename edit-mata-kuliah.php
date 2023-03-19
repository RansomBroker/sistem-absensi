<?php
session_start();
include "function.php";

if (isset($_POST['edit-mata-kuliah'])) {
    edit_mata_kuliah($_POST);
}

$mata_kuliah = ambil_mata_kuliah_berdasarkan_id($_GET['id']);
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <?php include "head.php"?>

    <title>Edit Mata Kuliah</title>

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
                    <h1 class="h3 mb-0 text-gray-800">Tambah Mata Kuliah</h1>
                </div>

                <div class="card card-body">
                    <form action="" method="POST">
                        <input type="hidden" value="<?= $mata_kuliah['id']?>" name="id">
                        <div class="form-group">
                            <label class="form-label">Nama Mata Kuliah <sup class="text-danger">*</sup></label>
                            <input type="text" name="nama-mata-kuliah" class="form-control" value="<?= $mata_kuliah['nama']?>" required>
                        </div>
                        <button name="edit-mata-kuliah" class="btn btn-warning w-100">Edit Mata Kuliah</button>
                    </form>
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

</body>

</html>