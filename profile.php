<?php
session_start();
include "function.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <?php include "head.php"?>

    <title>Profile</title>

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
                <div class="d-flex flex-column justify-content-center">
                    <div class="card card-body">
                         <h4 class="text-dark">Profile</h4>
                         <form class="my-3" action="" method="POST">
                              <div class="mb-3">
                                   <label class="form-label" for="nim">NIM <sup class="text-danger">*</sup></label>
                                   <input type="text" id="nim" name="nim" class="form-control">
                              </div>
                              <div class="mb-3">
                                   <label class="form-label" for="nama">Nama <sup class="text-danger">*</sup></label>
                                   <input type="text" id="nama" name="nama" class="form-control">
                              </div>
                              <div class="mb-3">
                                   <label class="form-label" for="kelas">Kelas<sup class="text-danger">*</sup></label>
                                   <input type="text" id="kelas" name="kelas" class="form-control">
                              </div>
                              <div class="mb-3">
                                   <label class="form-label" for="tempat-lahir">Tempat Lahir<sup class="text-danger">*</sup></label>
                                   <input type="text" id="tempat-lahir" name="tempat_lahir" class="form-control">
                              </div>
                              <div class="mb-3">
                                   <label class="form-label">Tanggal Lahir<sup class="text-danger">*</sup></label>
                                   <input type="date" class="form-control" name="tanggal_lahir" required>
                              </div>
                              <div class="mb-3">
                                   <label class="form-label" for="angkatan">Angkatan <sup class="text-danger">*</sup></label>
                                   <input type="text" id="angkatan" name="angkatan" class="form-control">
                              </div>
                              <div class="mb-3">
                                   <label class="form-label" for="alamat">Alamat <sup class="text-danger">*</sup></label>
                                   <input type="text" id="alamat" name="alamat" class="form-control">
                              </div>
                              
                              <div class="mb-3">
                                   <label for="">Moto Hidup <sup class="text-danger">*</sup></label>
                                   <div>
                                   <textarea name="moto_hidup"id="tiny"> &lt;p&gt;Moto Hidup!&lt;/p&gt;</textarea>
                                   </div>
                              </div>
                              <div class="mb-3">
                                   <label for="kemampuan_pribadi">Kemampuan Pribadi <sup class="text-danger">*</sup></label>
                                   <div>
                                   <textarea name="kemampuan_pribadi"id="kemampuan_pribadi"> &lt;p&gt;Kemampuan Pribadi!&lt;/p&gt;</textarea>
                                   </div>
                              </div>
                              <div class="mb-3">
                                   <label class="form-label" for="foto">Foto <sup class="text-danger">*</sup></label>
                                   <div class="custom-file form-control">
                                        <input type="file" class="custom-file-input" id="validatedInputGroupCustomFile" required>
                                        <label class="custom-file-label" for="validatedInputGroupCustomFile">Choose file...</label>
                                   </div>
                              </div>

                              <div class="d-flex justify-content-start mt-5">
                                    <button type="submit" name="profile" class="btn btn-primary mr-2">Simpan</button>
                                    <button type="reset"  class="btn btn-danger mx-2">Batal</button>
                                </div>
                         </form>
                    </div>  
                </div>
            </div>


        </div>
        <!-- End of Content Wrapper -->

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
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
<script src="https://cdn.jsdelivr.net/npm/@tinymce/tinymce-jquery@1/dist/tinymce-jquery.min.js"></script>
    <script>
      $('textarea#tiny').tinymce({
      height: 150,
      menubar: false,
      plugins: [
          'a11ychecker','advlist','advcode','advtable','autolink','checklist','export',
          'lists','link','image','charmap','preview','anchor','searchreplace','visualblocks',
          'powerpaste','fullscreen','formatpainter','insertdatetime','media','table','help','wordcount' ],
          toolbar: 'undo redo | a11ycheck casechange blocks | bold italic backcolor | alignleft aligncenter alignright alignjustify | bullist numlist checklist outdent indent | removeformat | code table help'
      });
     </script>
     <script>
      $('textarea#kemampuan-pribadi').tinymce({
      height: 150,
      menubar: false,
      plugins: [
          'a11ychecker','advlist','advcode','advtable','autolink','checklist','export',
          'lists','link','image','charmap','preview','anchor','searchreplace','visualblocks',
          'powerpaste','fullscreen','formatpainter','insertdatetime','media','table','help','wordcount' ],
          toolbar: 'undo redo | a11ycheck casechange blocks | bold italic backcolor | alignleft aligncenter alignright alignjustify | bullist numlist checklist outdent indent | removeformat | code table help'
      });
     </script>

</body>

</html>