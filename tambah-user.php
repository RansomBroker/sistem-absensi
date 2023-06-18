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

                <div class="row justify-content-center">
                    <div class="card card-body col-lg-6">
                        <form action="" method="POST" id="form">
                            <div class="row">
                                <div class="col-lg-12 col-12 mb-2">
                                    <label class="form-label">User <sup class="text-danger">*</sup></label>
                                    <input type="text" class="form-control desimal-input" name="username"required>
                                </div>
                                <div class="col-lg-12 col-12 mb-2">
                                    <label class="form-label">Nama <sup class="text-danger">*</sup></label>
                                    <input type="text" class="form-control desimal-input" name="nama"required>
                                </div>
                                <div class="col-lg-12 col-12 mb-2">
                                    <label class="form-label">Password <sup class="text-danger">*</sup></label>
                                    <input type="text" class="form-control desimal-input" name="password"required>
                                </div>
                                <div class="col-lg-12 col-12 mb-2">
                                    <label class="form-label">Status <sup class="text-danger">*</sup></label>
                                    <select id="role" name="role" class="custom-select my-1 mr-sm-2" id="inlineFormCustomSelectPref"required>
                                        <option selected value="">Pilih...</option>
                                        <option value="1">Admin</option>
                                        <option value="2">Dosen</option>
                                        <option value="3">Mahasiswa</option>
                                    </select>
                                </div>
                                <div class="w-100 d-none" id="mahasiswa">
                                    <div class="col-lg-12 col-12 mb-2 "  >
                                        <label class="form-label">NIM <sup class="text-danger">*</sup></label>
                                        <input class="form-control desimal-input" name="nim">
                                    </div>
                                    <div class="col-lg-12 col-12 mb-2 "   >
                                        <label class="form-label">Angkatan <sup class="text-danger">*</sup></label>
                                        <input class="form-control desimal-input" name="angkatan">
                                    </div>
                                    <div class="col-lg-12 col-12 mb-2 "   >
                                        <label class="form-label">Prodi <sup class="text-danger">*</sup></label>
                                        <input class="form-control desimal-input" name="prodi">
                                    </div>
                                    <div class="col-lg-12 col-12 mb-2 "   >
                                        <label class="form-label">Jurusan <sup class="text-danger">*</sup></label>
                                        <input class="form-control desimal-input" name="jurusan">
                                    </div>
                                    <div class="col-lg-12 col-12 mb-2 "   >
                                        <label class="form-label">Kelas <sup class="text-danger">*</sup></label>
                                        <input class="form-control desimal-input" name="kelas">
                                    </div>

                                </div>
                                <div class="col-lg-12 col-12 mb-2 d-none " id="dosen" >
                                    <label class="form-label">NIP <sup class="text-danger">*</sup></label>
                                    <input class="form-control desimal-input" name="nip" >
                                </div>
                                <input type="hidden" name="user-submit">
                                <button type="submit" name="user-submit" class="btn btn-warning mt-2 mx-2 w-100">Tambah</button>
                                <button type="reset"  class="btn btn-danger my-2 mx-2 w-100">Clear</button>
                            </div>
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
        $(document).ready(function (){
            //making serverName Dropdown box disabled by default.
            $('#mahasiswa').addClass('d-none');
            $('#dosen').addClass('d-none');

            $('#role').on("change",function ()
            {

                if($(this).val() == "1"){
                    $('#mahasiswa').val = "1";
                    $('#mahasiswa').addClass('d-none');
                    $('#dosen').val = "1";
                    $('#dosen').addClass('d-none');
                    $('[name=nim]').attr('required', false);
                    $('[name=angkatan]').attr('required', false);
                    $('[name=nip]').attr('required', false);
                    $('[name=kelas]').attr('required', false);
                    $('[name=prodi]').attr('required', false);
                    $('[name=jurusan]').attr('required', false);
                    $('[name=nim]').val('');
                    $('[name=angkatan]').val('');
                    $('[name=nip]').val('');
                    $('[name=kelas]').val('');
                    $('[name=prodi]').val('');
                    $('[name=jurusan]').val('');
                    return;
                }if($(this).val() === "2"){
                    $('#dosen').removeClass('d-none');
                    $('[name=nim]').attr('required', false);
                    $('[name=angkatan]').attr('required', false);
                    $('[name=kelas]').attr('required', false);
                    $('[name=prodi]').attr('required', false);
                    $('[name=jurusan]').attr('required', false);
                    $('[name=nim]').val("");
                    $('[name=angkatan]').val("");
                    $('[name=kelas]').val("");
                    $('[name=prodi]').val("");
                    $('[name=jurusan]').val("");
                    $('[name=nip]').attr('required', true);
                    $('#mahasiswa').addClass('d-none');
                    return;
                } if($(this).val() == "3"){
                    $('#dosen').addClass('d-none');
                    $('#mahasiswa').val = "3";
                    $('#mahasiswa').removeClass('d-none');
                    $('[name=nim]').attr('required', true);
                    $('[name=angkatan]').attr('required', true);
                    $('[name=prodi]').attr('required', true);
                    $('[name=kelas]').attr('required', true);
                    $('[name=jurusan]').attr('required', true);
                    $('[name=nip]').attr('required', false);
                    $('[name=nip]').val('');
                    return;
                }
            });
            $("#form").one('submit', function (e) {
                e.preventDefault();
                Swal.fire({
                    icon: 'question',
                    title: 'Konfirmasi',
                    text: 'Apakah data sudah benar ?',
                    showCancelButton: true,
                    reverseButtons: true
                }).then((result) => {
                    if (result.isConfirmed) {
                        $(this).submit();
                    }
                })

            })
        });
    </script>

</body>

</html>