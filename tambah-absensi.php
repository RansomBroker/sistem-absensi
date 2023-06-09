<?php
include "connection.php";
include "helper.php";
date_default_timezone_set('asia/jakarta');

$status = $_POST['status'];
$image_data = $_POST['imageData'];
$id_absensi = $_POST['idAbsensi'];
$id_mahasiswa = $_POST['idMahasiswa'];
$coordinate = $_POST['coordinate'];


// abmil data absensi dari db
$data_absen = $connection->query("SELECT * FROM jadwal_presensi WHERE id = '$id_absensi'")->fetch_assoc();
$data_tgl_absen = $data_absen['tgl_absen'];
$data_jam_masuk = date('y-m-d H:i:s', strtotime( $data_tgl_absen.' '.$data_absen['jam_masuk']));
$data_jam_keluar = date('y-m-d H:i:s', strtotime( $data_tgl_absen.' '.$data_absen['jam_keluar']));

// waktu absen saat ini
$absensi = date("y-m-d H:i:s");
$tgl_presensi = date("y-m-d");
$jam_presensi = date("H:i:s");

// hitung waktu keterlambatan
$waktu_telat = floor((  strtotime($absensi) - strtotime($data_jam_masuk)) / 60) ;

if ($waktu_telat < $data_absen['waktu_dispensasi']) {
    $waktu_telat = 0;
} else {
    $waktu_telat -= $data_absen['waktu_dispensasi'];
}

// handle gambar
list($type, $data) = explode(';', $image_data);
list(,$data) = explode(',', $image_data);
$image = base64_decode($data);
$image_name = time();
$image_name_db = $image_name.'.png';
file_put_contents('img/absensi/'.$image_name.'.png', $image);

if ($status == "Sakit") {
    $jam_masuk = strtotime($data_absen['jam_masuk']) + $data_absen['waktu_dispensasi'];
    $jam_keluar = strtotime($data_absen['jam_keluar']);
    $waktu_sakit = floor(($jam_keluar - $jam_masuk)) / 60 ;
    $waktu_telat = 0;

    $connection->query("
        INSERT INTO presensi_mahasiswa
        (id_jadwal_presensi, id_mahasiswa, jam_presensi, tgl_presensi, waktu_telat, status, img, geo_coordinate, waktu_sakit)
        VALUES
        ('$id_absensi', '$id_mahasiswa', '$jam_presensi', '$tgl_presensi', '$waktu_telat', '$status', '$image_name_db', '$coordinate', '$waktu_sakit')
    ");
}

if ($status == "Izin") {
    $jam_masuk = strtotime($data_absen['jam_masuk']) + $data_absen['waktu_dispensasi'];
    $jam_keluar = strtotime($data_absen['jam_keluar']);
    $waktu_izin = floor(($jam_keluar - $jam_masuk)) / 60 ;
    $waktu_telat = 0;

    $connection->query("
        INSERT INTO presensi_mahasiswa
        (id_jadwal_presensi, id_mahasiswa, jam_presensi, tgl_presensi, waktu_telat, status, img, geo_coordinate, waktu_izin)
        VALUES
        ('$id_absensi', '$id_mahasiswa', '$jam_presensi', '$tgl_presensi', '$waktu_telat', '$status', '$image_name_db', '$coordinate', '$waktu_izin')
    ");
}

if($status == "Alpha") {
    $jam_masuk = strtotime($data_absen['jam_masuk']) + $data_absen['waktu_dispensasi'];
    $jam_keluar = strtotime($data_absen['jam_keluar']);
    $waktu_telat = floor(($jam_keluar - $jam_masuk)) / 60 ;

    $connection->query("
    INSERT INTO presensi_mahasiswa
    (id_jadwal_presensi, id_mahasiswa, jam_presensi, tgl_presensi, waktu_telat, status, img, geo_coordinate)
    VALUES
    ('$id_absensi', '$id_mahasiswa', '$jam_presensi', '$tgl_presensi', '$waktu_telat', '$status', '$image_name_db', '$coordinate')
    ");
}

if ($status == "Hadir") {
    $connection->query("
    INSERT INTO presensi_mahasiswa
    (id_jadwal_presensi, id_mahasiswa, jam_presensi, tgl_presensi, waktu_telat, status, img, geo_coordinate)
    VALUES
    ('$id_absensi', '$id_mahasiswa', '$jam_presensi', '$tgl_presensi', '$waktu_telat', '$status', '$image_name_db', '$coordinate')
    ");
}

if ($connection->affected_rows > 0) {
    $response[] = [
        'message' => 'Berhasil Mengisi Absen',
        'status' => 'success',
        'code' => 1
    ];

    echo json_encode($response);
} else {
    $response[] = [
        'message' => 'Gagal Mengisi Absen',
        'status' => 'failed',
        'code' => 0
    ];

    echo json_encode($response);
}