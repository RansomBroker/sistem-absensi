<?php
include "connection.php";
include "helper.php";

$status = $_POST['status'];
$id_mahasiswa = $_POST['idMahasiswa'];
$id_presensi = $_POST['idPresensi'];

$presensi = $connection->query("SELECT * FROM jadwal_presensi WHERE id = '$id_presensi'")->fetch_assoc();
$menit_total = floor((strtotime($presensi['jam_keluar']) - strtotime($presensi['jam_masuk'])) / 60);

if ($status == "Alpha") {
	$connection->query("UPDATE presensi_mahasiswa
		SET
			status = '$status',
			waktu_telat = '$menit_total',
			waktu_izin = '0',
			waktu_sakit = '0'
		WHERE id_jadwal_presensi = '$id_presensi' AND id_mahasiswa = '$id_mahasiswa'
		");
}
if ($status == "Hadir") {
	$connection->query("UPDATE presensi_mahasiswa
	SET
		status = '$status',
		waktu_telat = '0',
		waktu_izin = '0',
		waktu_sakit = '0'
	WHERE id_jadwal_presensi = '$id_presensi' AND id_mahasiswa = '$id_mahasiswa'
	");
}

if ($status == "Izin") {
	$connection->query("UPDATE presensi_mahasiswa
	SET
		status = '$status',
		waktu_telat = '0',
		waktu_izin = '$menit_total',
		waktu_sakit = '0'
	WHERE id_jadwal_presensi = '$id_presensi' AND id_mahasiswa = '$id_mahasiswa'
	");
}

if ($status == "Sakit") {
	$connection->query("UPDATE presensi_mahasiswa
	SET
		status = '$status',
		waktu_telat = '0',
		waktu_izin = '0',
		waktu_sakit = '$menit_total'
	WHERE id_jadwal_presensi = '$id_presensi' AND id_mahasiswa = '$id_mahasiswa'
	");
}

// ambil update waktu
$data = $connection->query("SELECT * FROM presensi_mahasiswa WHERE id_jadwal_presensi = '$id_presensi' AND id_mahasiswa = '$id_mahasiswa'")->fetch_assoc();

echo json(200, "OK", "Berhasil update", $data);