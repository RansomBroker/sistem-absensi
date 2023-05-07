<?php
session_start();
include "function.php";

if (isset($_POST['user-submit'])) {
     update_data_user($_POST);
}
$data_user = ambil_data_user_by_id($_GET['id']);
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <?php include "head.php"?>

    <title>Ubah User</title>

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
                    <h1 class="h3 mb-0 text-gray-800">Ubah Data User</h1>
                </div>

                <div class="card card-body">
                    <form action="" method="POST" id="form">
                         <input type="hidden" name="id" value=<?= $_GET['id']?>>
                         <div class="row"> 
                              <div class="col-lg-12 col-12 mb-2">
                                   <label class="form-label">Username <sup class="text-danger">*</sup></label>
                                   <input type="text" class="form-control" name="username" value="<?= $data_user['username']?>" required>
                              </div>
                              <div class="col-lg-12 col-12 mb-2">
                                   <label class="form-label">Password <sup class="text-danger">*</sup></label>
                                   <input type="text" class="form-control" name="password" value="<?= $data_user['password']?>" required>
                              </div>
                              <div class="col-lg-12 col-12 mb-2">
                                   <label class="form-label">Status <sup class="text-danger">*</sup></label>
                                   <select name="role" class="custom-select my-1 mr-sm-2" id="inlineFormCustomSelectPref" required>
                                        <?php $roles = ['admin', 'dosen', 'mahasiswa']?>
                                        <?php for ($i=1; $i <= 3 ; $i++): ?>
                                             <?php if ($i == $data_user['role']):?>
                                                  <option value="<?= $i?>" selected><?= $roles[$i-1]?></option>
                                             <?php else:?>
                                                  <option value="<?= $i?>"><?= $roles[$i -1]?></option>
                                             <?php endif;?>
                                        <?php endfor;?>
                                   </select>
                              </div>
                             <input type="hidden" name="user-submit">
                              <button type="submit" name="user-submit" class="btn btn-warning mt-2 mx-2 w-100">Ubah</button>
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

    
    <?php include "logout_modal.php"?>

    <?php include "js.php"?>
    <script>
        $(document).ready(function () {
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