<?php
session_start();
include "function.php";

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
                    <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
                </div>
                <?php if($_SESSION['role'] == 1):?>
                    <div class="card card-body">
                        <div class="justify-content-center row ">
                            <div class="mx-4 card card-body col-lg-3">
                                <h5>Dosen</h5>
                                <a href="dosen.php">More Info</a>
                            </div>
                            <div class="mx-4 card card-body col-lg-3">
                                <h5>Mahasiswa</h5>
                                <a href="mahasiswa.php">More Info</a>
                            </div>
                            <div class="mx-4 card card-body col-lg-3">
                                <h5>User</h5>
                                <a href="user.php">More Info</a>
                            </div>
                        </div>
                    </div>
                <?php endif;?>
                <?php if($_SESSION['role'] == 2):?>
                    <div class="card card-body">
                        <h5 class="card-title">HI <?=$_SESSION['nama']?></h5>
                    </div>
                <?php endif;?>
                <?php if($_SESSION['role'] == 3):?>
                    <?php $akumulasi_telat = ambil_akumulasi_mahasiswa($_SESSION['id']);?>
                    <div class="card card-body">
                        <h5 class="card-title">HI <?=$_SESSION['nama']?></h5>
                        <div class="card card-body">
                            <div class=" row justify-content-start">
                                <div class="col-lg-4 col-12 border-right">
                                    <h5 class=card-title>Akumulasi Menit Alpha</h5>
                                    <?php if ($akumulasi_telat['akumulasi'] < 480):?>
                                        <h4 class="text-primary font-weight-bold"><?= $akumulasi_telat['akumulasi']?> (menit)</h4>
                                    <?php endif;?>

                                    <?php if ($akumulasi_telat['akumulasi'] >= 480 && $akumulasi_telat['akumulasi'] <= 960):?>
                                        <h4 class="text-warning font-weight-bold"><?= $akumulasi_telat['akumulasi']?> (menit)</h4>
                                    <?php endif;?>

                                    <?php if ($akumulasi_telat['akumulasi'] > 960):?>
                                        <h4 class="text-danger font-weight-bold"><?= $akumulasi_telat['akumulasi']?> (menit)</h4>
                                    <?php endif;?>
                                </div>
                                <div class="col-lg-4 col-12">
                                    <h5 class=card-title>Status</h5>
                                    <?php if ($akumulasi_telat['akumulasi'] < 480):?>
                                        <h4 class="btn btn-primary">SP1</h4>
                                    <?php endif;?>

                                    <?php if ($akumulasi_telat['akumulasi'] >= 480 && $akumulasi_telat['akumulasi'] <= 960):?>
                                        <h4 class="btn btn-warning">SP2</h4>
                                    <?php endif;?>

                                    <?php if ($akumulasi_telat['akumulasi'] > 960):?>
                                        <h4 class="btn btn-danger">SP3</h4>
                                    <?php endif;?>
                                </div>
                            </div>
                        </div>
                    </div>

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

                    <div class="card card-body mt-4">
                        <h5 class="card-title">List Absen</h5>
                        <div class="table-responsive">
                            <table class="table table-striped table-hover table-bordered" id="table-absensi">
                                <thead>
                                <tr>
                                    <th>Nama</th>
                                    <th>Matkul</th>
                                    <th>Waktu Absen</th>
                                    <th>Tanggal Absen</th>
                                    <th>Waktu Dispensasi</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php foreach (ambil_jadwal_presensi_mahasiswa($_SESSION['id']) as $data):?>
                                    <?php if (in_array($data['id_presensi'], $kehadiran)):?>
                                        <tr>
                                            <td><?= $data['judul_presensi'] ?></td>
                                            <td><?= $data['mata_kuliah']?></td>
                                            <td><?= $data['jam_masuk'].'-'.$data['jam_keluar']?></td>
                                            <td><?= $data['tgl_absen']?></td>
                                            <td><?= $data['waktu_dispensasi']?></td>
                                            <td>
                                                <a href="list-presensi.php?id-presensi=<?= $data['id_presensi']?>&id-mahasiswa=<?= $_SESSION['id']?>"  class="btn btn-success">Lihat Detail</a>
                                            </td>
                                        </tr>
                                    <?php else:?>
                                        <tr>
                                            <td><?= $data['judul_presensi'] ?></td>
                                            <td><?= $data['mata_kuliah']?></td>
                                            <td><?= $data['jam_masuk'].'-'.$data['jam_keluar']?></td>
                                            <td><?= $data['tgl_absen']?></td>
                                            <td><?= $data['waktu_dispensasi']?></td>
                                            <td>
                                                <button  class="btn-absen btn btn-warning" data-id="<?= $data['id_presensi']?>" data-id-mahasiswa="<?= $_SESSION['id']?>">Isi Kehadiran</button>
                                            </td>
                                        </tr>
                                    <?php endif;?>
                                <?php endforeach;?>
                                </tbody>
                            </table>
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
                            <canvas id="canvas" class="d-none"> </canvas>
                            <input type="hidden" name="coordinate">
                           `,
                    didOpen: () => {
                        let video = $("#video").get(0);
                        navigator.mediaDevices.getUserMedia({video:true, audio: false}).then(function (stream) {
                            video.srcObject = stream;
                            console.log(stream);
                            video.play();
                            stream.active;
                        })
                        navigator.geolocation.getCurrentPosition(function (position) {
                            $('[name=coordinate]').val(position.coords.latitude + "," + position.coords.longitude)
                        });
                    },
                    preConfirm: function () {
                        return new Promise(function (resolve) {
                            let status = $("[name=status]:checked").val()
                            let canvas = $("#canvas").get(0);
                            let context = canvas.getContext("2d")

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

                            canvas.width = 512;
                            canvas.height = 512;
                            context.drawImage(video, 0, 0, 512,512)

                            swal.resetValidationMessage();
                            resolve({
                                'imageData': canvas.toDataURL("image/png"),
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