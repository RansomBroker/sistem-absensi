<?php
session_start();
include "connection.php";
include "helper.php";

$id = $_GET['id'];
$mata_kuliah_id = $_GET['mata_kuliah_id'];

// hapus mahasiswa dari enroll kelas
$connection->query("DELETE FROM mahasiswa_enroll WHERE user_id = '$id' AND mata_kuliah_id = '$mata_kuliah_id' ");

// ambil id jadwal presensi
$jadwal_presensi = $connection->query("
    SELECT 
        jadwal_presensi.id as id_jadwal_presensi
    FROM
        jadwal_presensi
    WHERE 
        jadwal_presensi.mata_kuliah_id = '$mata_kuliah_id'
        
")->fetch_all(MYSQLI_ASSOC);

// hapus seluruh presensi mhs
foreach ($jadwal_presensi as $jadwal_presensi) {
    $id_jadwal_presensi = $jadwal_presensi['id_jadwal_presensi'];
    $connection->query("DELETE FROM presensi_mahasiswa WHERE id_mahasiswa = '$id' AND id_jadwal_presensi = '$id_jadwal_presensi' ");
}

set_flash_message('berhasil_tambah_mata_kuliah', "Berhasil Hapus Mahasiswa");

redirect('data-mata-kuliah.php?halaman=data-mata-kuliah');
