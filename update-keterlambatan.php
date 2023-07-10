<?php
include "connection.php";
include "helper.php";

$id_mahasiswa = $_POST['idMahasiswa'];
$id_presensi = $_POST['idPresensi'];
$waktu_telat = $_POST['waktu'];
$connection->query("UPDATE presensi_mahasiswa
		SET
			waktu_telat = '$waktu_telat'
		WHERE id_jadwal_presensi = '$id_presensi' AND id_mahasiswa = '$id_mahasiswa'
		");

echo json(200, "OK", "Berhasil update");