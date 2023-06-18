<?php
include "connection.php";
include "helper.php";

$status = $_POST['status'];
$id_mahasiswa = $_POST['idMahasiswa'];
$id_presensi = $_POST['idPresensi'];


if ($status == "Alpha") {
	$presensi = $connection->query("SELECT * FROM jadwal_presensi WHERE id = '$id_presensi'")->fetch_assoc();
	$menit_keterlambatan = floor((strtotime($presensi['jam_keluar']) - strtotime($presensi['jam_masuk'])) / 60) - $presensi['waktu_dispensasi'];
	$connection->query("UPDATE presensi_mahasiswa
		SET
			status = '$status',
			waktu_telat = '$menit_keterlambatan'
		WHERE id_jadwal_presensi = '$id_presensi' AND id_mahasiswa = '$id_mahasiswa'
		");
} else {

	$connection->query("UPDATE presensi_mahasiswa
	SET
		status = '$status',
		waktu_telat = '0'
	WHERE id_jadwal_presensi = '$id_presensi' AND id_mahasiswa = '$id_mahasiswa'
	");

}
// ambil update waktu
$data = $connection->query("SELECT * FROM presensi_mahasiswa WHERE id_jadwal_presensi = '$id_presensi' AND id_mahasiswa = '$id_mahasiswa'")->fetch_assoc();

echo json(200, "OK", "Berhasil update", $data);