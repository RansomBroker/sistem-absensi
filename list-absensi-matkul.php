<?php
session_start();
include "function.php";

$list_absensi = ambiL_seluruh_data_absensi($_GET['id']);

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
                <?php if ($_SESSION['role'] == 2 || $_SESSION['role'] == 1):?>
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800"><?= isset($list_absensi[0]['nama_matkul']) ? $list_absensi[0]['nama_matkul']: ""?></h1>
                    </div>
                    <div class="card card-body my-4">
                        <div>
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
                                    <?php foreach ($list_absensi as $data):?>
                                        <tr>
                                            <td><?= $data['nama_presensi'] ?></td>
                                            <td><?= $data['nama_matkul']?></td>
                                            <td><?= $data['jam_masuk'].'-'.$data['jam_keluar']?></td>
                                            <td><?= $data['tgl_absen']?></td>
                                            <td><?= $data['waktu_dispensasi']?></td>
                                            <td>
                                                <a href="list-presensi.php?id-presensi=<?= $data['presensi_id']?>"  class="btn btn-success">Lihat Presensi</a>
                                                <a href="ubah-data-absen.php?id=<?= $data['presensi_id']?>" class="btn-edit btn btn-warning">Edit</a>
                                                <a href="hapus-data-absen.php?id=<?=$data['presensi_id']?>" class="btn btn-danger">Hapus</a>
                                            </td>
                                        </tr>
                                    <?php endforeach;?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                <?php endif;?>
                <?php if ($_SESSION['role'] == 3):?>
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800"><?= isset($list_absensi[0]['nama_matkul']) ? $list_absensi[0]['nama_matkul']: ""?></h1>
                    </div>
                    <div class="card card-body my-4">
                        <div>
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
                                    <?php foreach ($list_absensi as $data):?>
                                        <?php if (in_array($data['presensi_id'], $kehadiran)):?>
                                            <tr>
                                                <td><?= $data['nama_presensi'] ?></td>
                                                <td><?= $data['nama_matkul']?></td>
                                                <td><?= $data['jam_masuk'].'-'.$data['jam_keluar']?></td>
                                                <td><?= $data['tgl_absen']?></td>
                                                <td><?= $data['waktu_dispensasi']?></td>
                                                <td>
                                                    <a href="list-presensi.php?id-presensi=<?= $data['presensi_id']?>&id-mahasiswa=<?= $_SESSION['id']?>"  class="btn btn-success">Lihat Detail</a>
                                                </td>
                                            </tr>
                                        <?php else:?>
                                            <tr>
                                                <td><?= $data['nama_presensi'] ?></td>
                                                <td><?= $data['nama_matkul']?></td>
                                                <td><?= $data['jam_masuk'].'-'.$data['jam_keluar']?></td>
                                                <td><?= $data['tgl_absen']?></td>
                                                <td><?= $data['waktu_dispensasi']?></td>
                                                <td>
                                                    <button  class="btn-absen btn btn-warning" data-id="<?= $data['presensi_id']?>" data-id-mahasiswa="<?= $_SESSION['id']?>">Isi Kehadiran</button>
                                                </td>
                                            </tr>
                                        <?php endif;?>
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
            let tableListPresensi = $("#table-list-presensi").DataTable();
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
        })
    </script>

</body>

</html>