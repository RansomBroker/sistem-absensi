<?php
session_start();
include "function.php";

if (isset($_POST['submit-logo-auth'])) {
    update_logo_auth($_FILES);
}

if (isset($_POST['submit-logo-sidebar'])) {
    update_logo_sidebar($_FILES);
}

if (isset($_POST['submit-logo-surat'])) {
    update_logo_surat($_FILES);
}

?>
<!DOCTYPE html>
<html lang="en">

<head>

    <?php include "head.php"?>

    <title>Setting</title>

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
                    <h1 class="h3 mb-0 text-gray-800">Setting</h1>
                </div>

                <div class="row">
                    <div class="col-lg-4 card card-body">
                        <h5 class="card-title">Ubah logo login</h5>
                        <form action="" method="POST" id="form-auth" enctype="multipart/form-data">
                            <div class="mb-3">
                                <label class="form-label d-block" for="foto">Logo login</label>
                                <img id="img-preview-auth" class="my-2"  width="200" src="img/<?= ambil_logo_auth()['img']?>">
                                <div class="custom-file form-control">
                                    <input name="logo-auth" type="file" class="custom-file-input" id="validatedInputGroupCustomFile" >
                                    <label class="custom-file-label"   for="validatedInputGroupCustomFile">Choose file...</label>
                                </div>
                            </div>
                            <input type="hidden" name="submit-logo-auth">
                            <button type="submit" class="w-100 btn btn-primary mr-2">Simpan</button>
                        </form>
                    </div>
                    <div class="col-lg-4 card card-body">
                        <h5 class="card-title">Ubah logo sidebar</h5>
                        <form action="" method="POST" id="form-sidebar" enctype="multipart/form-data">
                            <div class="mb-3">
                                <label class="form-label d-block" for="foto">Logo sidebar</label>
                                <img id="img-preview-sidebar" class="my-2"  width="200" src="img/<?= ambil_logo_sidebar()['img']?>">
                                <div class="custom-file form-control">
                                    <input name="logo-sidebar" type="file" class="custom-file-input" id="validatedInputGroupCustomFile" >
                                    <label class="custom-file-label"   for="validatedInputGroupCustomFile">Choose file...</label>
                                </div>
                            </div>
                            <input type="hidden" name="submit-logo-sidebar">
                            <button type="submit" class="w-100 btn btn-primary mr-2">Simpan</button>
                        </form>
                    </div>
                    <div class="col-lg-4 card card-body">
                        <h5 class="card-title">Ubah logo surat</h5>
                        <form action="" method="POST" id="form-surat" enctype="multipart/form-data">
                            <div class="mb-3">
                                <label class="form-label d-block" for="foto">Logo surat</label>
                                <img id="img-preview-surat" class="my-2"  width="200" src="img/<?= ambil_logo_surat()['img']?>">
                                <div class="custom-file form-control">
                                    <input name="logo-surat" type="file" class="custom-file-input" id="validatedInputGroupCustomFile" >
                                    <label class="custom-file-label"   for="validatedInputGroupCustomFile">Choose file...</label>
                                </div>
                            </div>
                            <input type="hidden" name="submit-logo-surat">
                            <button type="submit" class="w-100 btn btn-primary mr-2">Simpan</button>
                        </form>
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
            $("input[name=logo-auth]").on("change", function(e) {

                let src = URL.createObjectURL(e.target.files[0]);
                $('#img-preview-auth').attr('src', src)

            })

            $("input[name=logo-sidebar]").on("change", function(e) {

                let src = URL.createObjectURL(e.target.files[0]);
                $('#img-preview-sidebar').attr('src', src)

            })

            $("input[name=logo-surat]").on("change", function(e) {

                let src = URL.createObjectURL(e.target.files[0]);
                $('#img-preview-surat').attr('src', src)

            })
        })
    </script>

</body>

</html>