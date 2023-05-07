<?php
session_start();
include "function.php";

if (isset($_POST['submit-mata-kuliah'])) {
    update_data_mata_kuliah($_POST);
}

$mata_kuliah = ambil_data_mata_kuliah_by_id($_GET['id']);
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <?php include "head.php"?>

    <title>Ubah Mata Kuliah</title>

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
                    <h1 class="h3 mb-0 text-gray-800">Ubah Mata Kuliah</h1>
                </div>

                <div class="card card-body row">
                    <form action="" method="POST" id="form">
                        <input type="hidden" name="id" value="<?= $mata_kuliah['id_mata_kuliah']?>">
                        <input type="hidden" name="submit-mata-kuliah">
                        <div class="form-group mb-3">
                            <label class="form-label">Nama Kuliah <sup class="text-danger">*</sup></label>
                            <input type="text" class="form-control" name="name" value="<?= $mata_kuliah['name'] ?>" required>
                        </div>
                        <div class="form-group mb-3">
                            <label class="form-label">Dosen Pengampu <sup class="text-danger">*</sup></label>
                            <select name="dosen-pengampu" class="form-control" required>
                                <?php foreach (ambil_data_dosen() as $dosen):?>
                                    <?php if ($dosen['id'] == $mata_kuliah['id']):?>
                                        <option selected value="<?= $dosen['id']?>"><?= $dosen['nama']?></option>
                                    <?php else:?>
                                        <option value="<?= $dosen['id']?>"><?= $dosen['nama']?></option>
                                    <?php endif;?>
                                <?php endforeach;?>
                            </select>
                        </div>
                        <div class="form-group mb-3">
                            <label class="form-label">Kode Enroll</label>
                            <input type="text" class="form-control" name="enroll-code" value="<?= $mata_kuliah['enroll_code']?>" readonly>
                        </div>
                        <button class="btn btn-warning w-100">Ubah Mata Kuliah</button>
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

</body>

</html>