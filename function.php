<?php
include "connection.php";
include "helper.php";

function login($form){
    global $connection;


    $username = $form['username'];
	$password = $form['password'];
	$check_username_query = "SELECT * FROM users WHERE username = '$username'";
	$check_username_result = mysqli_query($connection, $check_username_query);
	$username_in_db = mysqli_fetch_assoc($check_username_result);
    
	if ($username== $username_in_db['username']){
		if (password_verify($password, $username_in_db['password'])){
            $_SESSION['login']=true;
            $_SESSION['id']=$username_in_db ['id'];
            $_SESSION['username']=$username_in_db ['username'];
            $_SESSION['role']=$role_in_db['role']; 
			return redirect('index.php');
		} else{
            set_flash_massage('login_failed','Username atau password tidak ditemukan');
        }
	}

}

function tambah_absensi($form) {
    global  $connection;
    $nama_mata_kuliah = htmlspecialchars(stripcslashes($form['nama-mata-kuliah']));
    $waktu_masuk = $form['waktu-masuk'];
    $waktu_keluar = $form['waktu-keluar'];
    $tanggal_absensi = $form['tanggal-absensi'];
    $waktu_dispensasi = $form['waktu-dispensasi'];

    $connection->query("
        INSERT INTO 
            jadwal_presensi (nama, jam_masuk, jam_keluar, tgl_absen, waktu_dispensasi)
        VALUES ('$nama_mata_kuliah', '$waktu_masuk', '$waktu_keluar', '$tanggal_absensi', '$waktu_dispensasi')    
    ");

    if ($connection->affected_rows > 0) {
        set_flash_message('berhasil_tambah_absen', 'Berhasil menambahkan data absen');
    } else {
        set_flash_message('gagal_tambah_absen', 'Gagal menambahkan data absen');
    }

    return redirect('data-absen.php?halaman=data-absen');

}