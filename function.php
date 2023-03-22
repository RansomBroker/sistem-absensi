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
            $_SESSION['role']=$username_in_db['role']; 
			return redirect('index.php');
		} else{
            set_flash_message('login_failed','Username atau password tidak ditemukan');
        }
	}

}

function tambah_user($form){
	global $connection;

	$username = htmlspecialchars(strtolower(stripcslashes($form['username'])));
 	$password = mysqli_escape_string($connection, $form['password']);
	$role = $form['role'];
	$has_password = password_hash($password, PASSWORD_DEFAULT);

	$mysql = $connection->query("INSERT INTO users (username, password, nama,role) VALUES ('$username', '$has_password','$username','$role')");

	if ($connection->affected_rows > 0) {
		set_flash_message('add_success', 'Berhasil melakukan pendaftaran');
		redirect('user.php');
	} else {
		set_flash_message('add_failed', 'Gagal melakukan pendaftaran');
	}
}

function ambil_data_user() {
	global $connection;
 
	$users = $connection->query("SELECT * FROM users")->fetch_all(MYSQLI_ASSOC);
 
	return $users;
}

function update_data_user($form){
	global $connection;

	$id=$form['id'];
	$username = htmlspecialchars(strtolower(stripcslashes($form['username'])));
 	$password = mysqli_escape_string($connection, $form['password']);
	$role = $form['role'];
	$has_password = password_hash($password, PASSWORD_DEFAULT);

	if ($password == "") {
		$connection->query("UPDATE users
		SET
			username='$username',
			role='$role'
		WHERE id = '$id'
		");
	} else {
		$connection->query("UPDATE users
		SET
			username='$username',
			password='$has_password',
			role='$role'
		WHERE id = '$id'
		");
	}
	
	if ($connection->affected_rows > 0) {
		set_flash_message('add_success', 'Berhasil Ubah Data User');
		redirect('user.php');
	} else {
		set_flash_message('add_failed', 'Berhasil Ubah Data User');
	}

}

function ambil_data_user_by_id($id) {
	global $connection;
 
	$users = $connection->query("SELECT * FROM users WHERE id = '$id'")->fetch_assoc();

	return $users;
}

function update_admin_profile($form){
	global $connection;

	$id=$form['id'];
	$nama= htmlspecialchars(strtolower(stripcslashes($form['nama'])));
	$username= htmlspecialchars(strtolower(stripcslashes($form['username'])));

	$connection->query("UPDATE users
		SET
			nama='$nama',
			username='$username'
		WHERE id = '$id'
	");
}

function update_dosen_profile($form){
	global $connection;

	$id=$form['id'];
	$nomor_induk= htmlspecialchars(strtolower(stripcslashes($form['nomor_induk'])));
	$nama= htmlspecialchars(strtolower(stripcslashes($form['nama'])));
	$connection->query("UPDATE users
		SET
			nomor_induk='$nomor_induk',
			nama='$nama'
		WHERE id = '$id'
	");
}

function  update_mahasiswa_profile($form){
	global $connection;

	$id=$form['id'];
	$nomor_induk= htmlspecialchars(strtolower(stripcslashes($form['nomor_induk'])));
	$nama= htmlspecialchars(strtolower(stripcslashes($form['nama'])));
	$kelas= htmlspecialchars(strtolower(stripcslashes($form['kelas'])));
	$tempat_lahir= htmlspecialchars(strtolower(stripcslashes($form['tempat_lahir'])));
	$tgl_lahir = htmlspecialchars(strtolower(stripcslashes($form['tgl_lahir'])));
	$angkatan= htmlspecialchars(strtolower(stripcslashes($form['angkatan'])));
	$alamat = htmlspecialchars(strtolower(stripcslashes($form['alamat'])));
	$moto_hidup = htmlspecialchars(strtolower(stripcslashes($form['moto_hidup'])));
	$kemampuan_pribadi = htmlspecialchars(strtolower(stripcslashes($form['kemampuan_pribadi'])));

	$connection->query("UPDATE users
		SET
			nomor_induk='$nomor_induk',
			nama='$nama',
			kelas='$kelas',
			tempat_lahir='$tempat_lahir',
			tgl_lahir='$tgl_lahir',
			angkatan='$angkatan',
			alamat='$alamat',
			moto_hidup='$moto_hidup',
			kemampuan_pribadi='$kemampuan_pribadi'
		WHERE id = '$id'
	");
	
}