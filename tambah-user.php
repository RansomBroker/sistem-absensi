<?php
session_start();
include "function.php";

if (isset($_POST['user-submit'])) {
     tambah_user($_POST);
}

?>
<!DOCTYPE html>
<html lang="en">

<head>

    <?php include "head.php"?>

    <title>Tambah User</title>

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
                    <h1 class="h3 mb-0 text-gray-800">Tambah User</h1>
                </div>

                <div class="card card-body">
                    <form action="" method="POST">
                         <div class="row"> 
                              <div class="col-lg-12 col-12 mb-2">
                                   <label class="form-label">User <sup class="text-danger">*</sup></label>
                                   <input type="text" class="form-control desimal-input" name="username">
                              </div>
                              <div class="col-lg-12 col-12 mb-2">
                                   <label class="form-label">Password <sup class="text-danger">*</sup></label>
                                   <input type="text" class="form-control desimal-input" name="password">
                              </div>
                              <div class="col-lg-12 col-12 mb-2">
                                   <label class="form-label">Status <sup class="text-danger">*</sup></label>
                                   <select name="role" class="custom-select my-1 mr-sm-2" id="inlineFormCustomSelectPref">
                                        <option selected>Pilih...</option>
                                        <option value="1">Admin</option>
                                        <option value="2">Dosen</option>
                                        <option value="3">Mahasiswa</option>
                                   </select>
                              </div>
                              <button type="submit" name="user-submit" class="btn btn-warning mt-2 mx-2 w-100">Tambah</button>
                              <button type="reset"  class="btn btn-danger my-2 mx-2 w-100">Clear</button>
                         </div>
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
    <script>
        $(document).ready(function () {
            let tabelMataKuliah = $("#table-mata-kuliah").DataTable();
        })
    </script>

</body>

</html>