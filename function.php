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

function upload_foto_profil($file, $name)
{
    $nama_file = $file[$name]['name'];
    $ukuran_file = $file[$name]['size'];
    $error_file = $file[$name]['error'];
    $tmp_name = $file[$name]['tmp_name'];

    // jika upload error
    if ($error_file == 4) {
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
    if ($ukuran_file > 1000000) {
        set_flash_message('add_failed', 'Ukuran file tidak boleh lebih besar dari 1 MB');
        return false;
    }

    // upload gambar ke folder img/profil
    move_uploaded_file($tmp_name, 'img/profil/'.$nama_file);
    return $nama_file;
}

function tambah_absensi($form) {
    global  $connection;
    $nama_mata_kuliah = htmlspecialchars(stripcslashes($form['judul-presensi']));
    $id_mata_kuliah = $form['id-mata-kuliah'];
    $user_id = $form['user-id'];
    $waktu_masuk = $form['waktu-masuk'];
    $waktu_keluar = $form['waktu-keluar'];
    $tanggal_absensi = $form['tanggal-absensi'];
    $waktu_dispensasi = $form['waktu-dispensasi'];

    $connection->query("
        INSERT INTO 
            jadwal_presensi (user_id, nama, jam_masuk, jam_keluar, tgl_absen, waktu_dispensasi, mata_kuliah_id)
        VALUES ('$user_id','$nama_mata_kuliah', '$waktu_masuk', '$waktu_keluar', '$tanggal_absensi', '$waktu_dispensasi', '$id_mata_kuliah')    
    ");

    if ($connection->affected_rows > 0) {
        set_flash_message('berhasil_tambah_absen', 'Berhasil menambahkan data absen');
    } else {
        set_flash_message('gagal_tambah_absen', 'Gagal menambahkan data absen');
    }

    return redirect('data-absen.php?halaman=data-absen');

}

function ambil_data_absen_dosen($id) {
    global $connection;
    return $connection->query("SELECT * FROM jadwal_presensi WHERE user_id = '$id'")->fetch_all(MYSQLI_ASSOC);
}

function ambil_data_absen() {
    global $connection;
    return $connection->query("
    SELECT
        *, 
        users.nama AS dosen_pengampu, 
        jadwal_presensi.nama AS nama_matkul
    FROM
	    jadwal_presensi
	INNER JOIN
        users
	ON 
		jadwal_presensi.user_id = users.id
    ")->fetch_all(MYSQLI_ASSOC);
}

function tambah_data_mata_kuliah($form) {
    global $connection;
    $nama_mata_kuliah = htmlspecialchars(stripcslashes($form['name']));
    $id_user = $form['dosen-pengampu'];
    $kode_kelas = random_strings(6);

    $connection->query("
        INSERT INTO 
            mata_kuliah (user_id, name, enroll_code)
        VALUES ('$id_user', '$nama_mata_kuliah', '$kode_kelas') 
    ");

    if ($connection->affected_rows > 0) {
        set_flash_message('berhasil_tambah_mata_kuliah', 'Berhasil menambahkan data Mata Kuliah');
    } else {
        set_flash_message('gagal_tambah_mata-kuliah', 'Gagal menambahkan data Mata Kuliah');
    }

    return redirect('data-mata-kuliah.php?halaman=data-mata-kuliah');
}

function update_data_mata_kuliah($form)
{
    global $connection;
    $id = $form['id'];
    $nama_mata_kuliah = htmlspecialchars(stripcslashes($form['name']));
    $id_user = $form['dosen-pengampu'];
    $kode_kelas = $form['enroll-code'];

    $connection->query("
        UPDATE mata_kuliah
        SET
            name = '$nama_mata_kuliah',
            user_id = '$id_user',
            enroll_code = '$kode_kelas'
        WHERE
            id = '$id'
    ");

    set_flash_message('berhasil_tambah_mata_kuliah', 'Berhasil menambahkan data Mata Kuliah');

    return redirect('data-mata-kuliah.php?halaman=data-mata-kuliah');
}

function ambil_data_mata_kuliah() {
    global $connection;
    return $connection->query("
    SELECT
	    *,
	    users.nama AS dosen_pengampu,
	    mata_kuliah.id AS id_mata_kuliah
    FROM
	    mata_kuliah
	INNER JOIN
	users
	ON 
		mata_kuliah.user_id = users.id")->fetch_all(MYSQLI_ASSOC);
}

function ambil_data_mata_kuliah_dosen($id)
{
    global $connection;
    return $connection->query("
    SELECT
        *, 
        users.nama AS dosen_pengampu,
	    mata_kuliah.id AS id_mata_kuliah
    FROM
	    mata_kuliah
	INNER JOIN
	    users
	ON 
		mata_kuliah.user_id = users.id
    WHERE
	mata_kuliah.user_id = '$id' 
    ")->fetch_all(MYSQLI_ASSOC);
}
function ambil_data_mata_kuliah_by_id($id)
{
    global $connection;
    return $connection->query("
    SELECT
        *, 
        users.nama AS dosen_pengampu,
	    mata_kuliah.id AS id_mata_kuliah
    FROM
	    mata_kuliah
	INNER JOIN
	    users
	ON 
		mata_kuliah.user_id = users.id
    WHERE
	mata_kuliah.id = '$id' 
    ")->fetch_assoc();
}

function ambil_data_mata_kuliah_mahasiswa($id) {
    global $connection;
    return $connection->query("
    SELECT
        *, 
        mahasiswa_enroll.user_id AS id_mahasiswa_enroll, 
        mata_kuliah.user_id AS id_dosen_pengampu
    FROM
	    mahasiswa_enroll
	INNER JOIN
	    mata_kuliah
	ON 
		mahasiswa_enroll.mata_kuliah_id = mata_kuliah.id
	INNER JOIN
	users
	ON 
		mata_kuliah.user_id = users.id
    WHERE
	mahasiswa_enroll.user_id = '$id'
    ")->fetch_all(MYSQLI_ASSOC);
}

function random_strings($length_of_string)
{

    // String of all alphanumeric character
    $str_result = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';

    // Shuffle the $str_result and returns substring
    // of specified length
    return substr(str_shuffle($str_result),
        0, $length_of_string);
}