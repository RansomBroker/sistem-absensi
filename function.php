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