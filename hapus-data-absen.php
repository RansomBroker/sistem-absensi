<?php
session_start();
include "connection.php";
include "helper.php";

$id = $_GET['id'];
$query = $connection->query("
    DELETE FROM jadwal_presensi WHERE id = '$id'
");

set_flash_message('berhasil_tambah_mata_kuliah', "Berhasil Hapus");
redirect('data-absen.php');
