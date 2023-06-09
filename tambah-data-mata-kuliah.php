<?php
session_start();
include "function.php";

if (isset($_POST['submit-mata-kuliah'])) {
    tambah_data_mata_kuliah($_POST);
}
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <?php include "head.php"?>

    <title>Tambah Mata Kuliah</title>

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

                <div class="card card-body row">
                    <form action="" method="POST" id="form">
                        <div class="form-group mb-3">
                            <label class="form-label">Nama Kuliah <sup class="text-danger">*</sup></label>
                            <input type="text" class="form-control" name="name" required>
                        </div>
                        <div class="form-group mb-3">
                            <label class="form-label">Dosen Pengampu <sup class="text-danger">*</sup></label>
                            <select name="dosen-pengampu" class="form-control" required>
                                <option value="" selected>--- Pilih Dosen Pengampu ---</option>
                                <?php foreach (ambil_data_dosen() as $dosen):?>
                                    <option value="<?= $dosen['id']?>"><?= $dosen['nama']?></option>
                                <?php endforeach;?>
                            </select>
                        </div>
                        <div class="form-group mb-3">
                            <label class="form-label">Kelas <sup class="text-danger">*</sup></label>
                            <input type="text" class="form-control" name="kelas" required>
                        </div>
                        <div class="form-group">
                            <label for="" class="form-label">Waktu Masuk <sup class="text-danger">*</sup></label>
                            <input name="waktu-masuk" class="time form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="" class="form-label">Waktu Keluar <sup class="text-danger">*</sup></label>
                            <input name="waktu-keluar" class="time form-control" required>
                        </div>
                        <input type="hidden" name="submit-mata-kuliah">
                        <button class="btn-submit btn btn-warning w-100">Tambah Mata Kuliah</button>
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
    <?php include "logout_modal.php"?>

    <?php include "js.php"?>
    <script>
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
    </script>
    <script>
        $(document).ready(function () {
            $('.time').timepicker({
                timeFormat: 'HH:mm:ss ',
                interval: 1,
                minTime: '6',
                maxTime: '11:59pm',
                defaultTime: '06:00',
                startTime: '00:00',
                dynamic: false,
                dropdown: true,
                scrollbar: true
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
        })
    </script>
</body>

</html>