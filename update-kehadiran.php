<?php
include "connection.php";

$status = $_POST['status'];
$id_mahasiswa = $_POST['idMahasiswa'];
$id_presensi = $_POST['idPresensi'];

$connection->query("UPDATE presensi_mahasiswa
		SET
			status = '$status'
		WHERE id_jadwal_presensi = '$id_presensi' AND id_mahasiswa = '$id_mahasiswa'
		");
