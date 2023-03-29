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
	
	if ($username_in_db != null) {
		if ($username== $username_in_db['username']){
			if (password_verify($password, $username_in_db['password'])){
			  $_SESSION['login']=true;
			  $_SESSION['id']=$username_in_db ['id'];
			  $_SESSION['username']=$username_in_db ['username'];
			  $_SESSION['role']=$username_in_db['role']; 
			  $_SESSION['foto']=$username_in_db['img'];
			  $_SESSION['nama'] = $username_in_db['nama'];
				return redirect('index.php');
			} else{
			  set_flash_message('login_failed','Username atau password salah ');
		   }
		}else{
			set_flash_message('login_failed','Username atau password tidak ditemukan');
		}
	} else {
		set_flash_message('login_failed','Isi Username dan Password ');

	}

}

function tambah_user($form){
	global $connection;

	$username = htmlspecialchars(strtolower(stripcslashes($form['username'])));
 	$password = mysqli_escape_string($connection, $form['password']);
	$nama=$form['nama'];
	$role = $form['role'];
	$nim=$form['nim'];
	$angkatan=$form['angkatan'];
	$nip=$form['nip'];
	$has_password = password_hash($password, PASSWORD_DEFAULT);

	if (strlen($nim) > 0 ) {
		$mysql = $connection->query("INSERT INTO users (username, password, nama,role,nomor_induk,angkatan) VALUES ('$username', '$has_password','$nama','$role','$nim','$angkatan')");
	}

	if(strlen($nip) > 0 ) {
		$mysql = $connection->query("INSERT INTO users (username, password, nama,role,nomor_induk) VALUES ('$username', '$has_password','$nama','$role','$nip')");
	}

	if (strlen($nip) == 0 && strlen($nim) == 0) {
		$mysql = $connection->query("INSERT INTO users (username, password, nama,role) VALUES ('$username', '$has_password','$nama','$role')");
	}
	
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

function ambil_data_mahasiswa() {
	global $connection;
 
	$users = $connection->query("SELECT * FROM users WHERE role='3'")->fetch_all(MYSQLI_ASSOC);
 
	return $users;
}

function ambil_data_dosen() {
	global $connection;
 
	$users = $connection->query("SELECT * FROM users WHERE role='2'")->fetch_all(MYSQLI_ASSOC);
 
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

function update_admin_profile($form, $file){
	global $connection;

	$id=$form['id'];
	$nama= htmlspecialchars(strtolower(stripcslashes($form['nama'])));
	$username= htmlspecialchars(strtolower(stripcslashes($form['username'])));


	if (!($file['foto']['name'] == "")) {
		$nama_file_foto = upload_foto_profil($file, 'foto');
		if(!$nama_file_foto) {
			return redirect('profile.php?id='.$id);
		}

		$connection->query("UPDATE users
			SET
				nama='$nama',
				username='$username',
				img = '$nama_file_foto'
			WHERE id = '$id'
		");
		$_SESSION['foto']=$nama_file_foto;
		$_SESSION['nama'] = $nama;
	
	}else {
		$connection->query("UPDATE users
		SET
			nama='$nama',
			username='$username'
		WHERE id = '$id'
		");
		$_SESSION['nama'] = $nama;

	}
	
	set_flash_message('add_success', 'Berhasil Update Data Profil');
}

function update_dosen_profile($form,$file){
	global $connection;

	$id=$form['id'];
	$nomor_induk= htmlspecialchars(strtolower(stripcslashes($form['nomor_induk'])));
	$nama= htmlspecialchars(strtolower(stripcslashes($form['nama'])));

	// upload gambar
	if (!($file['foto']['name'] == "")) {
		$nama_file_foto = upload_foto_profil($file, 'foto');
		if(!$nama_file_foto) {
			return redirect('profile.php?id='.$id);
		}

		$connection->query("UPDATE users
			SET
				nomor_induk='$nomor_induk',
				nama='$nama',
				img = '$nama_file_foto'
			WHERE id = '$id'
		");
		$_SESSION['foto']=$nama_file_foto;
		$_SESSION['nama'] = $nama;
	
	}else {
		$connection->query("UPDATE users
		SET
			nomor_induk='$nomor_induk',
			nama='$nama'
		WHERE id = '$id'
	");
	$_SESSION['nama'] = $nama;

	}

	
	set_flash_message('add_success', 'Berhasil Update Data Profil');

}

function  update_mahasiswa_profile($form,$file){
	global $connection;
	
	$id=$form['id'];
	$nomor_induk= htmlspecialchars(strtolower(stripcslashes($form['nomor_induk'])));
	$nama= htmlspecialchars(strtolower(stripcslashes($form['nama'])));
	$kelas= htmlspecialchars(strtolower(stripcslashes($form['kelas'])));
	$tempat_lahir= htmlspecialchars(strtolower(stripcslashes($form['tempat_lahir'])));
	$tgl_lahir = htmlspecialchars(strtolower(stripcslashes($form['tgl_lahir'])));
	$angkatan= htmlspecialchars(strtolower(stripcslashes($form['angkatan'])));
	$alamat = htmlspecialchars(strtolower(stripcslashes($form['alamat'])));
	$moto_hidup =$form['moto_hidup'];
	$kemampuan_pribadi = $form['kemampuan_pribadi'];
	// upload gambar
	if (!($file['foto']['name'] == "")) {
		$nama_file_foto = upload_foto_profil($file, 'foto');
		if(!$nama_file_foto) {
			return redirect('profile.php?id='.$id);
		}

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
				kemampuan_pribadi='$kemampuan_pribadi',
				img = '$nama_file_foto'
			WHERE id = '$id'
		");

		$_SESSION['foto']=$nama_file_foto;
		$_SESSION['nama'] = $nama;
	}else {
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
		$_SESSION['nama'] = $nama;
	}

	
	set_flash_message('add_success', 'Berhasil Update Data Profil');

}

function upload_foto_profil($file, $name) {
	$nama_file = $file[$name]['name'];
	$ukuran_file = $file[$name]['size'];
	$error_file = $file[$name]['error'];
	$tmp_name = $file[$name]['tmp_name'];

	// jika upload error
	if ($error_file == 4 ) {
		set_flash_message('add_failed', 'Error upload foto profil');
		return false; 
	}

	// jika ekstensi tidak sesuai
	$ekstensi_valid = ['jpg', 'png', 'jpeg'];
	$ekstensi_gambar = strtolower(end(explode('.', $nama_file)));
	
	if (!in_array($ekstensi_gambar, $ekstensi_valid)) {
		set_flash_message('add_failed', 'Ekstensi foto tidak valid');
		return false; 
	}

	// jika file lebih besar dari 1mb
	if ($ukuran_file >  1000000) {
		set_flash_message('add_failed', 'Ukuran file tidak boleh lebih besar dari 1 MB');
		return false;
	}

	// upload gambar ke folder img/profil
	move_uploaded_file($tmp_name, 'img/profil/'.$nama_file);
	return $nama_file;
}