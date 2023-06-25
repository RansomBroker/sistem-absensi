<?php
include "connection.php";
date_default_timezone_set('asia/jakarta');

function ambil_id_matkul() {
    global $connection;
    return $connection->query("
    SELECT
	    mata_kuliah.id AS id_matkul
    FROM
	    mata_kuliah")->fetch_all(MYSQLI_ASSOC);
}

function ambil_data_matkul($id_kelas) {
    global $connection;
    return $connection->query("
    SELECT
        mahasiswa_enroll.mata_kuliah_id AS id_matkul, 
        mahasiswa_enroll.user_id AS id_user
    FROM
	    mahasiswa_enroll
    WHERE
	mahasiswa_enroll.mata_kuliah_id = '$id_kelas' ")->fetch_all(MYSQLI_ASSOC);
}

function ambil_presensi_selesai() {
    global $connection;
    $timestamp = date("Y-m-d H:m:s");
    return $connection->query("
        SELECT
            jadwal_presensi.id AS id_presensi, 
            jadwal_presensi.jam_masuk AS jam_masuk, 
            jadwal_presensi.jam_keluar AS jam_keluar, 
            jadwal_presensi.waktu_dispensasi AS waktu_dispensasi,
            jadwal_presensi.tgl_absen AS tgl_absen
        FROM
            jadwal_presensi
        WHERE
            '$timestamp' > jadwal_presensi.timestamp_akhir_presensi
             
    ")->fetch_all(MYSQLI_ASSOC);
}

function ambiL_data_absensi($id_user, $id_absensi) {
    global $connection;
    return $connection->query("
        SELECT
	        presensi_mahasiswa.id_jadwal_presensi AS id_presensi, 
	        presensi_mahasiswa.id_mahasiswa AS id_user
        FROM
	        presensi_mahasiswa
        WHERE
	        presensi_mahasiswa.id_jadwal_presensi = '$id_absensi' AND
	        presensi_mahasiswa.id_mahasiswa = '$id_user'
    ")->fetch_assoc();
}

// ambil seluruh matkul
$data_matkul = ambil_id_matkul();
$data_presensi_selesai = ambil_presensi_selesai();
// check mahasiswa yg enroll matkul
foreach ($data_matkul as $matkul) {
    $data_mahasiswa = ambil_data_matkul($matkul['id_matkul']);
    if (count($data_mahasiswa) > 0) {
        // check absensi yg sudah kadaluarsa
        // dengan cara check apakah jam absen lebih besar dari jam saat ini
        foreach ($data_presensi_selesai as $presensi_selesai) {
            foreach ($data_mahasiswa as $mahasiswa) {
                // jika null maka mahasiswa tsb belum melakukan absensi, oleh sebab itu mahasiswa itu terhitung alpa
                if (ambiL_data_absensi($mahasiswa['id_user'], $presensi_selesai['id_presensi']) == NULL) {
                    $jam_masuk = strtotime($presensi_selesai['jam_masuk']);
                    $jam_keluar_store = $presensi_selesai['jam_keluar'];
                    $jam_keluar = strtotime($presensi_selesai['jam_keluar']);
                    $dispensasi = $presensi_selesai['waktu_dispensasi'];
                    $total_waktu_alpa = (($jam_keluar - $jam_masuk) / 60);
                    $tgl_presensi = $presensi_selesai['tgl_absen'];
                    $id_presensi = $presensi_selesai['id_presensi'];
                    $id_mahasiswa = $mahasiswa['id_user'];
                    $connection->query("
                        INSERT INTO presensi_mahasiswa
                        (id_jadwal_presensi, id_mahasiswa, jam_presensi, tgl_presensi, waktu_telat, status, img, geo_coordinate)
                        VALUES
                        ('$id_presensi', '$id_mahasiswa', '$jam_keluar_store', '$tgl_presensi', '$total_waktu_alpa', 'Alpha', 'Alpha.png', '-2.985172696700692, 104.7323622296573')
                    ");
                }
            }
        }
    }
}