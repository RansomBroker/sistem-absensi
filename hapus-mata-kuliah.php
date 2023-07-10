<?php
session_start();
include "connection.php";
include "helper.php";

$id = $_GET['id'];
$connection->query("DELETE FROM mata_kuliah WHERE id = '$id' ");

set_flash_message('berhasil_tambah_mata_kuliah', "Berhasil Hapus Mata Kuliah");

redirect('data-mata-kuliah.php?halaman=data-mata-kuliah');
