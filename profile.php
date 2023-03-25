<?php
session_start();
include "function.php";

if(!isset($_SESSION['login'])){
    redirect('login.php');
}

if (isset($_POST['profile'])) {
    if($_SESSION['role'] == 1) {
        update_admin_profile($_POST, $_FILES);
    }
    if($_SESSION['role'] == 2) {
        update_dosen_profile($_POST, $_FILES);
    }
    if($_SESSION['role'] == 3) {
        update_mahasiswa_profile($_POST,$_FILES);
    }
}


    
$data_user = ambil_data_user_by_id($_GET['id']);

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
                    <?php if(get_flash_name('add_success') != ""):?>
                         <div class="alert alert-success" role="alert">
                              <?= get_flash_message('add_success')?>
                         </div>	
                    <?php endif;?>
                    <?php if(get_flash_name('add_failed') != ""):?>
                         <div class="alert alert-danger" role="alert">
                              <?= get_flash_message('add_failed')?>
                         </div>	
                    <?php endif;?>
                         <h4 class="text-dark">Profile</h4>
                         <form class="my-3" enctype="multipart/form-data" method="POST">
                            <!-- Jika Role == admin  -->
                            <input type="hidden" name="id" value=<?= $data_user['id']?>>
                            <?php if($_SESSION['role'] == 1):?>
                                <div class="mb-3">
                                   <label class="form-label" for="nama">Nama <sup class="text-danger">*</sup></label>
                                   <input type="text" id="nama" name="nama" value="<?= $data_user['nama']?>" class="text-capitalize form-control">
                              </div>
                              <div class="mb-3">
                                   <label class="form-label" for="username">Username <sup class="text-danger">*</sup></label>
                                   <input type="text" id="username" name="username" value="<?= $data_user['username']?>" class="form-control">
                              </div>
                              <div class="mb-3">
                                   <label class="form-label d-block" for="foto">Foto <sup class="text-danger">*</sup></label>
                                   <img id="img-preview" class="my-2"  width="200" src="img/profil/<?= $data_user['img']?>">
                                   <div class="custom-file form-control">
                                        <input name="foto" type="file" class="custom-file-input" id="validatedInputGroupCustomFile" >
                                        <label class="custom-file-label"   for="validatedInputGroupCustomFile">Choose file...</label>
                                   </div>
                              </div>
                            <?php endif;?>
                            <!-- Jika Role == Dosen -->
                            <?php if($_SESSION['role'] == 2):?>
                                <div class="mb-3">
                                   <label class="form-label" for="nim">NIP <sup class="text-danger">*</sup></label>
                                   <input type="text" id="nim" name="nomor_induk" value='<?= $data_user == NULL ? '': $data_user['nomor_induk']?>' class="form-control">
                              </div>
                              <div class="mb-3">
                                   <label class="form-label" for="nama">Nama <sup class="text-danger">*</sup></label>
                                   <input type="text" id="nama" name="nama" value="<?= $data_user['nama']?>" class="text-capitalize form-control">
                              </div>
                              <div class="mb-3">
                                   <label class="form-label d-block" for="foto">Foto <sup class="text-danger">*</sup></label>
                                   <img id="img-preview" class="my-2"  width="200" src="img/profil/<?= $data_user['img']?>">
                                   <div class="custom-file form-control">
                                        <input name="foto" type="file" class="custom-file-input" id="validatedInputGroupCustomFile" required>
                                        <label class="custom-file-label"  for="validatedInputGroupCustomFile">Choose file...</label>
                                   </div>
                              </div>
                            <?php endif; ?>
                            <!-- Jika Role == Mahasiswa -->
                            <?php if($_SESSION['role'] == 3):?>
                                <div class="mb-3">
                                   <label class="form-label" for="nim">NIM <sup class="text-danger">*</sup></label>
                                   <input type="text" id="nim" name="nomor_induk" value='<?= $data_user == NULL ? '': $data_user['nomor_induk']?>' class="form-control">
                              </div>
                              <div class="mb-3">
                                   <label class="form-label" for="nama">Nama <sup class="text-danger">*</sup></label>
                                   <input type="text" id="nama" name="nama" value="<?= $data_user['nama']?>" class="text-capitalize form-control">
                              </div>
                              <div class="mb-3">
                                   <label class="form-label" for="kelas">Kelas<sup class="text-danger">*</sup></label>
                                   <input type="text" id="kelas" name="kelas"  value='<?= $data_user == NULL ? '': $data_user['kelas']?>' class="text-capitalize form-control">
                              </div>
                              <div class="mb-3">
                                   <label class="form-label" for="tempat-lahir">Tempat Lahir<sup class="text-danger">*</sup></label>
                                   <input type="text" id="tempat-lahir" name="tempat_lahir" value='<?= $data_user == NULL ? '': $data_user['tempat_lahir']?>' class="text-capitalize form-control">
                              </div>
                              <div class="mb-3">
                                   <label class="form-label">Tanggal Lahir<sup class="text-danger">*</sup></label>
                                   <input type="date" class="form-control" name="tgl_lahir" value='<?= $data_user == NULL ? '': $data_user['tgl_lahir']?>' required>
                              </div>
                              <div class="mb-3">
                                   <label class="form-label" for="angkatan">Angkatan <sup class="text-danger">*</sup></label>
                                   <input type="text" id="angkatan" name="angkatan" value='<?= $data_user == NULL ? '': $data_user['angkatan']?>' class="form-control">
                              </div>
                              <div class="mb-3">
                                   <label class="form-label" for="alamat">Alamat <sup class="text-danger">*</sup></label>
                                   <input type="text" id="alamat" name="alamat" value='<?= $data_user == NULL ? '': $data_user['alamat']?>' class="text-capitalize form-control">
                              </div>
                              
                              <div class="mb-3">
                                   <label for="">Moto Hidup <sup class="text-danger">*</sup></label>
                                   <div>
                                        <textarea name="moto_hidup"   id="tiny"> <?= $data_user == NULL ? '': $data_user['moto_hidup']?></textarea>
                                   </div>
                              </div>
                              <div class="mb-3">
                                   <label for="kemampuan_pribadi">Kemampuan Pribadi <sup class="text-danger">*</sup></label>
                                   <div>
                                        <textarea name="kemampuan_pribadi"  id="kemampuan-pribadi"> <?= $data_user == NULL ? '': $data_user['kemampuan_pribadi']?> </textarea>
                                   </div>
                              </div>
                              <div class="mb-3">
                                   <label class="form-label d-block" for="foto">Foto <sup class="text-danger">*</sup></label>
                                   <img id="img-preview" class="my-2"  width="200" src="img/profil/<?= $data_user['img']?>">
                                   <div class="custom-file form-control">
                                        <input name="foto" type="file" class="custom-file-input" id="validatedInputGroupCustomFile">
                                        <label class="custom-file-label"  for="validatedInputGroupCustomFile">Choose file...</label>
                                   </div>
                              </div>
                            <?php endif; ?>
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

    <?php include "logout_modal.php"?>

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

      $('textarea#kemampuan-pribadi').tinymce({
      height: 150,
      menubar: false,
      plugins: [
          'a11ychecker','advlist','advcode','advtable','autolink','checklist','export',
          'lists','link','image','charmap','preview','anchor','searchreplace','visualblocks',
          'powerpaste','fullscreen','formatpainter','insertdatetime','media','table','help','wordcount' ],
          toolbar: 'undo redo | a11ycheck casechange blocks | bold italic backcolor | alignleft aligncenter alignright alignjustify | bullist numlist checklist outdent indent | removeformat | code table help'
      });
      
      $("input[name=foto]").on("change", function(e) {
          
          let src = URL.createObjectURL(e.target.files[0]);
          $('#img-preview').attr('src', src)
          
      })
     </script>
     <script>
      
     </script>
</body>

</html>