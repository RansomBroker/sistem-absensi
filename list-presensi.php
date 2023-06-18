<?php
session_start();
include "function.php";
// ambil data user yg enroll kelas
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
                    <?php $data_presensi_mahasiswa = ambil_data_seluruh_presensi_mahasiswa($_GET['id-presensi']);?>
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Status Presensi
                            <?= isset($data_presensi_mahasiswa[0]['nama_mata_kuliah']) ? $data_presensi_mahasiswa[0]['nama_mata_kuliah']: ""?>
                        </h1>
                    </div>
                    <div class="card card-body my-4">
                        <div>
                            <div class="table-responsive">
                                <table class="table table-striped table-hover table-bordered" id="table-list-presensi">
                                    <thead>
                                        <tr>
                                            <th>Nama Presensi</th>
                                            <th>Nama</th>
                                            <th>Kelas</th>
                                            <th>Jam Presensi</th>
                                            <th>Tgl Presensi</th>
                                            <th>Waktu Telat (menit)</th>
                                            <th>Koordinat</th>
                                            <th>Gambar</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $i = 0;?>
                                        <?php foreach ($data_presensi_mahasiswa as $presensi):?>
                                        <tr>
                                            <td><?= $presensi['judul_presensi']?></td>
                                            <td><?= $presensi['nama_mahasiswa']?></td>
                                            <td><?= $presensi['kelas']?></td>
                                            <td><?= $presensi['jam_presensi']?></td>
                                            <td><?= $presensi['tgl_presensi']?></td>
                                            <td class="waktu-telat"><?= $presensi['waktu_telat']?></td>
                                            <td><button class="map-popup btn btn-warning"
                                                    data-coordinate="<?= $presensi['coordinate']?>">Lihat Map</button>
                                            </td>
                                            <td>
                                                <img src="/img/absensi/<?= $presensi['img']?>" alt="gambar_absensi"
                                                    width="64">
                                            </td>
                                            <td>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio"
                                                        name="select-kehadiran-<?= $i?>"
                                                        value="Hadir||<?=$presensi['id_mahasiswa']?>||<?=$presensi['id_presensi']?>"
                                                        <?= ($presensi['status'] == "Hadir") ? 'checked' : ''?> />
                                                    <label class="form-check-label">Hadir</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio"
                                                        name="select-kehadiran-<?= $i?>"
                                                        value="Sakit||<?=$presensi['id_mahasiswa']?>||<?=$presensi['id_presensi']?>"
                                                        <?= ($presensi['status'] == "Sakit") ? 'checked' : ''?> />
                                                    <label class="form-check-label">Sakit</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio"
                                                        name="select-kehadiran-<?= $i?>"
                                                        value="Izin||<?=$presensi['id_mahasiswa']?>||<?=$presensi['id_presensi']?>"
                                                        <?= ($presensi['status'] == "Izin") ? 'checked' : ''?> />
                                                    <label class="form-check-label">Izin</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio"
                                                        name="select-kehadiran-<?= $i?>"
                                                        value="Alpha||<?=$presensi['id_mahasiswa']?>||<?=$presensi['id_presensi']?>"
                                                        <?= ($presensi['status'] == "Alpha") ? 'checked' : ''?> />
                                                    <label class="form-check-label">Alpha</label>
                                                </div>
                                            </td>
                                        </tr>
                                        <?php $i++;?>
                                        <?php endforeach;?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <?php endif;?>
                    <?php if($_SESSION['role'] == 3):?>
                    <?php $data_presensi_mahasiswa = ambil_data_presensi_mahasiswa($_GET['id-mahasiswa'],$_GET['id-presensi']);?>
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Status Presensi
                            <?= $data_presensi_mahasiswa['nama_mata_kuliah']?></h1>
                    </div>
                    <div class="card card-body my-4">
                        <div>
                            <div class="table-responsive">
                                <table class="table table-striped table-hover table-bordered" id="table-list-presensi">
                                    <thead>
                                        <tr>
                                            <th>Nama Presensi</th>
                                            <th>Nama</th>
                                            <th>Kelas</th>
                                            <th>Jam Presensi</th>
                                            <th>Tgl Presensi</th>
                                            <th>Waktu Telat (menit)</th>
                                            <th>Koordinat</th>
                                            <th>Gambar</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td><?= $data_presensi_mahasiswa['judul_presensi']?></td>
                                            <td><?= $data_presensi_mahasiswa['nama_mahasiswa']?></td>
                                            <td><?= $data_presensi_mahasiswa['kelas']?></td>
                                            <td><?= $data_presensi_mahasiswa['jam_presensi']?></td>
                                            <td><?= $data_presensi_mahasiswa['tgl_presensi']?></td>
                                            <td><?= $data_presensi_mahasiswa['waktu_telat']?></td>
                                            <td><button class="map-popup btn btn-warning"
                                                    data-coordinate="<?= $presensi['coordinate']?>">Lihat Map</button>
                                            </td>
                                            <td>
                                                <img src="/img/absensi/<?= $data_presensi_mahasiswa['img']?>"
                                                    alt="gambar_absensi" width="64">
                                            </td>
                                            <td>
                                                <?php if ($data_presensi_mahasiswa['status'] == "Hadir"):?>
                                                <button
                                                    class="btn btn-success"><?= $data_presensi_mahasiswa['status'] ?></button>
                                                <?php endif;?>
                                                <?php if ($data_presensi_mahasiswa['status']  == "Sakit"):?>
                                                <button
                                                    class="btn btn-primary"><?= $data_presensi_mahasiswa['status'] ?></button>
                                                <?php endif;?>
                                                <?php if ($data_presensi_mahasiswa['status']  == "Izin"):?>
                                                <button
                                                    class="btn btn-warning"><?= $data_presensi_mahasiswa['status'] ?></button>
                                                <?php endif;?>
                                                <?php if ($data_presensi_mahasiswa['status']  == "Alpha"):?>
                                                <button
                                                    class="btn btn-danger"><?= $data_presensi_mahasiswa['status'] ?></button>
                                                <?php endif;?>
                                            </td>
                                        </tr>
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
        $(document).ready(function() {
            let tableListPresensi = $("#table-list-presensi").DataTable();

            $(".form-check-input").click(function() {
                let selectVal = $(this).val().split('||');
                let status = selectVal[0];
                let idMahasiswa = selectVal[1];
                let idPresensi = selectVal[2];

                $.ajax({
                    url: 'update-kehadiran.php',
                    method: 'POST',
                    data: {
                        status: status,
                        idMahasiswa: idMahasiswa,
                        idPresensi: idPresensi
                    }
                    // success: function(response) {
                    //     let data = JSON.parse(response);
                    //     $(".waktu-telat").text(data.body.waktu_telat)
                    // }
                })
            });

            $(".map-popup").click(function() {
                Swal.fire({
                    title: "Peta Koordinat Absensi Mahasiswa",
                    html: `<div id="map" style="height: 250px"></div>`,
                    didOpen: () => {
                        let coordinate = $(this).attr('data-coordinate').split(',');
                        console.log(coordinate);
                        let map = L.map('map').setView(coordinate, 10);

                        L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
                            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
                        }).addTo(map);

                        L.marker(coordinate).addTo(map)
                    }
                })
            })
        })
        </script>

</body>

</html>