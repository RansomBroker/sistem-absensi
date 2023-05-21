<?php
session_start();
include "function.php";
if(!isset($_SESSION['login'])){
    redirect('login.php');
}

$kehadiran = [];
foreach (ambil_kehadiran_mahasiswa($_SESSION['id']) as $data) {
    $kehadiran[] = $data['id_mata_kuliah'];
}

?>
<!DOCTYPE html>
<html lang="en">

<head>

    <?php include "head.php"?>

    <title>Dashboard</title>

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
                    <h1 class="h3 mb-0 text-gray-800">List Kelas</h1>
                </div>
                <?php if($_SESSION['role'] == 3):?>
                    <div class="card card-body my-4">
                        <h5 class="card-title">List kelas</h5>
                        <button data-id="<?= $_SESSION['id']?>" class="btn-enroll btn btn-warning mb-3">Enroll Kelas</button>
                        <div>
                            <div class="table-responsive">
                                <table class="table table-striped table-hover table-bordered" id="table-mata-kuliah">
                                    <thead>
                                    <tr>
                                        <th>Nama Mata Kuliah</th>
                                        <th>Dosen Pengampu</th>
                                        <th>Aksi</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php foreach (ambil_data_mata_kuliah_mahasiswa($_SESSION['id']) as $data):?>
                                        <tr>
                                            <td><?= $data['name']?></td>
                                            <td><?= $data['nama']?></td>
                                            <td><a href="list-absensi-matkul.php?id=<?= $data['id_mata_kuliah']?>" class="btn btn-warning">Lihat List Absensi</a></td>
                                        </tr>
                                    <?php endforeach;?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                <?php endif;?>
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
            let tableDataAbsensi = $("#table-absensi").DataTable()
            let tableMataKuliah = $("#table-mata-kuliah").DataTable()
            $('.btn-absen').on('click', function () {
                let idAbsensi = $(this).attr('data-id');
                let idMahasiswa = $(this).attr('data-id-mahasiswa');
                Swal.fire({
                    title: "Isi Kehadiran",
                    allowOutsideClick: false,
                    showCancelButton: true,
                    html: `
                            <p>Status Kehadiran</p>
                            <div class="form-check form-check-inline">
                              <input class="form-check-input" type="radio" name="status" value="Hadir">
                              <label class="form-check-label">Hadir</label>
                            </div>
                            <div class="form-check form-check-inline">
                              <input class="form-check-input" type="radio" name="status" value="Sakit">
                              <label class="form-check-label">Sakit</label>
                            </div>
                            <div class="form-check form-check-inline">
                              <input class="form-check-input" type="radio" name="status" value="Izin">
                              <label class="form-check-label">Izin</label>
                            </div>
                            <div class="form-check form-check-inline">
                              <input class="form-check-input" type="radio" name="status" value="Alpha">
                              <label class="form-check-label">Alpha</label>
                            </div>
                            <video id="video" class="w-100">Video stream not available.</video>
                            <img id="photo" alt="This photo will apear here" class="w-100" src="">
                            <canvas id="canvas" class="d-none"> </canvas>
                            <input type="hidden" name="coordinate">
                            <button class="take-photo btn btn-warning mt-2">Ambil Photo</button>
                           `,
                    didOpen: () => {
                        let video = $("#video").get(0);
                        $("#photo").hide()

                        // akses kamera
                        navigator.mediaDevices.getUserMedia({video:true, audio: false}).then(function (stream) {
                            $("#video").show();
                            video.srcObject = stream;
                            video.play();
                            stream.active;
                        }).catch((error) => {
                            $("#video").hide();
                            $(".take-photo").hide();
                            swal.showValidationMessage("*Silahkan izinkan akses kamera pada browser")
                        })

                        // akses lokasi
                        navigator.geolocation.getCurrentPosition(
                            function (position) {
                                $('[name=coordinate]').val(position.coords.latitude + "," + position.coords.longitude)
                            },
                            function () {
                                swal.showValidationMessage("*Silahkan izinkan akses lokasi pada browser")
                            }
                        );

                        //ambil photo
                        $(document).on('click', '.take-photo', function () {
                            let canvas = $("#canvas").get(0);
                            const context = canvas.getContext('2d');
                            canvas.width = 512;
                            canvas.height = 512;
                            context.drawImage(video, 0, 0, 512, 512);

                            const data = canvas.toDataURL('image/png');
                            $("#photo").attr('src', data);
                            $("#photo").show();
                            $("#video").hide();
                            $(this).removeClass("btn-warning")
                            $(this).removeClass("take-photo")
                            $(this).addClass("btn-danger")
                            $(this).addClass("retake-photo")
                            $(this).text("Ambil Ulang Photo")
                        })

                        // retake photo
                        $(document).on('click', '.retake-photo', function () {
                            $("#photo").hide();
                            $("#video").show();
                            $(this).removeClass("btn-danger")
                            $(this).removeClass("retake-photo")
                            $(this).addClass("take-photo")
                            $(this).addClass("btn-warning")
                            $(this).text("Ambil photo")
                        })
                    },
                    preConfirm: function () {
                        return new Promise(function (resolve) {
                            let status = $("[name=status]:checked").val()

                            if (status === undefined) {
                                swal.showValidationMessage("Pilih Status Kehadiran")
                                swal.enableButtons();
                                return 0;
                            }

                            if ($('[name=coordinate]').val().length === 0 ) {
                                swal.showValidationMessage("Silahkan enable location pada browser")
                                swal.enableButtons();
                                return 0;
                            }

                            if ($("#photo").attr('src').length === 0) {
                                swal.showValidationMessage("Silahkan ambil photo terlebih dahulu")
                                swal.enableButtons();
                                return 0;
                            }

                            console.log()
                            swal.resetValidationMessage();
                            resolve({
                                'imageData': $("#photo").attr('src'),
                                'status': status,
                                'coordinate': $('[name=coordinate]').val()
                            })
                        })
                    }
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: 'tambah-absensi.php',
                            method: 'POST',
                            data: {
                                'status': result.value.status,
                                'imageData': result.value.imageData,
                                'coordinate': result.value.coordinate,
                                'idAbsensi': idAbsensi,
                                'idMahasiswa': idMahasiswa
                            },
                            success: function(data) {
                                let response = JSON.parse(data);
                                if (response[0].code === 0) {
                                    Swal.fire('error', response[0].message, 'error')
                                    return 0;
                                }
                                window.location.reload();
                            }
                        })
                    }
                })
            })

            $(".btn-enroll").on('click', function() {
                let id = $(this).attr('data-id')
                Swal.fire({
                    title: "Enroll Kelas",
                    html: `<div class="form-group">
                                <label class="form-label">Kode Kelas</label>
                                <input type="text" class="form-control" name="enroll-code">
                           </div>`,
                    showCancelButton: true,
                    reverseButtons: true,
                    preConfirm: function () {
                        return new Promise(function (resolve) {
                            if($('[name=enroll-code]').val() === '') {
                                swal.showValidationMessage("Masukan Kode Kelas")
                                swal.enableButtons();
                                return 0;
                            }

                            if ($('[name=enroll-code]').val() != '') {
                                swal.resetValidationMessage();
                                resolve({
                                    "enrollCode" : $("[name=enroll-code]").val(),
                                });
                            }
                        })
                    }
                }).then((result) => {
                    let enrollCode = result.value.enrollCode;
                    $.ajax({
                        url: "enroll-kelas.php?enroll-code="+enrollCode + "&id=" + id,
                        method: "GET",
                        success: function(data) {
                            let response = JSON.parse(data);
                            if (response[0].code === 0) {
                                Swal.fire('error', response[0].message, 'error')
                                return 0;
                            }
                            window.location.reload();
                        }
                    })
                })
            })
        })
    </script>

</body>

</html>