<?php
session_start();
include "function.php";

if (isset($_POST['ubah-absensi'])) {
     update_data_absen($_POST);
}
$data_absen = ambil_data_absen_by_id($_GET['id']);
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <?php include "head.php"?>

    <title>Ubah Absen</title>

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
                <div class="card card-body row">
                    <h5 class="card-title"> Ubah Absensi</h5>
                    <form action="" method="POST">
                        <input type="hidden" name="id" value=<?= $_GET['id']?>>
                        <input type="hidden" name="user-id" value="<?= $_SESSION['id']?>">
                        <div class="form-group">
                            <label for="" class="form-label">Nama Mata Kuliah <sup class="text-danger">*</sup></label>
                            <select name="id-mata-kuliah" class="form-control" required>
                                <?php foreach (ambil_data_mata_kuliah_dosen($_SESSION['id']) as $data):?>
                                    <option value="<?= $data['id_mata_kuliah']?>"><?= $data['name']?></option>
                                <?php endforeach;?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="" class="form-label">Judul Presensi <sup class="text-danger">*</sup></label>
                            <input name="judul-presensi"value="<?= $data_absen['nama']?>" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="" class="form-label">Waktu Masuk <sup class="text-danger">*</sup></label>
                            <input name="waktu-masuk"value="<?= $data_absen['jam_masuk']?>" class="time form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="" class="form-label">Waktu Keluar <sup class="text-danger">*</sup></label>
                            <input name="waktu-keluar" value="<?= $data_absen['jam_keluar']?>" class="time form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="" class="form-label">Tanggal Absensi<sup class="text-danger">*</sup></label>
                            <input type="date" name="tanggal-absensi" value="<?= $data_absen['tgl_absen']?>"  class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="" class="form-label">Waktu Dispensasi <sup class="text-danger">*</sup></label>
                            <input type="number" name="waktu-dispensasi" value="<?= $data_absen['waktu_dispensasi']?>" class="form-control" required>
                        </div>
                        <button class="btn btn-warning w-100" name="ubah-absensi" >Ubah Absensi</button>
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
                        <span aria-hidden="true"></span>
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
        })
    </script>

</body>

</html>