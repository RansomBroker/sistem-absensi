<?php
include "connection.php";
include "helper.php";

function tambah_mata_kuliah($form) {
    global $connection;
    $nama_mata_kuliah = htmlspecialchars(strtolower(stripcslashes($form['nama-mata-kuliah'])));
    $connection->query("INSERT INTO mata_kuliah (nama) VALUES ('$nama_mata_kuliah')");

    if ($connection->affected_rows > 0 ) {
        set_flash_message('berhasil_tambah_mata_kuliah', "Berhasil Menambahkan Mata Kuliah");
        return redirect('mata-kuliah.php');
    } else {
        set_flash_message('failed_tambah_mata_kuliah', "Gagal Menambahkan Mata Kuliah");
        return redirect('mata-kuliah.php');
    }

}

function edit_mata_kuliah($form) {
    global $connection;
    $id = htmlspecialchars(strtolower(stripcslashes($form['id'])));
    $nama_mata_kuliah = htmlspecialchars(strtolower(stripcslashes($form['nama-mata-kuliah'])));

    $connection->query("
        UPDATE 
            mata_kuliah 
        SET
            nama = '$nama_mata_kuliah'
        WHERE id = '$id'
    ");

    if ($connection->affected_rows > 0 ) {
        set_flash_message('berhasil_tambah_mata_kuliah', "Berhasil Edit Mata Kuliah");
        return redirect('mata-kuliah.php');
    } else {
        set_flash_message('failed_tambah_mata_kuliah', "Gagal Edit Mata Kuliah");
        return redirect('mata-kuliah.php');
    }

}

function ambil_data_mata_kuliah() {
    global $connection;

    return $connection->query("SELECT * FROM mata_kuliah")->fetch_all(MYSQLI_ASSOC);
}

function ambil_mata_kuliah_berdasarkan_id($id) {
    global $connection;

    return $connection->query("SELECT * FROM mata_kuliah WHERE id = '$id'")->fetch_assoc();
}