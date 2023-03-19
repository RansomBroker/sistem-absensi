<?php 
	session_start();
	include "function.php";

	if(isset($_POST['login'])) {
		login($_POST);
	}

	if(isset($_SESSION['login'])){
		redirect('index.php');
	}
?>
<!DOCTYPE html>
<html>
<head>
    <?php include "head.php"?>

	<title>Login</title>

    <?php include "css.php"?>
</head>
<body class="bg-warning bg-opacity-75 flex-column d-flex justify-content-center align-items-center vh-100">
	<div class="flex-row justify-content-center">
		<div class="d-flex justify-content-center align-items-center">
			<img src="img/logi-poltek.jpg" width="180" class="  rounded-circle mb-2" alt="logo">
		</div>
		<h4 class="text-center text-dark">Validasi Kehadiran Mahasiswa</h4>
	</div>
	<div class="mx-lg-3 mx-1 py-lg-3  col-lg-6 card rounded login  ">
		<div class="card-body py-0 px-1">
			<h4 class="text-center">Login</h4>
			<form class="" method="POST" action="">
				<div class="d-flex  justify-content-center ">
					<div class=" row">
						<div class=" col-lg-12 mb-3 px-0 " >
							<label class="form-label" for="username">Username</label>
							<input type="text" id="username" name="username" class="form-control">

						</div>
						<div class="col-lg-12 mb-3 px-0" >
							<label class="form-label" for="password">Password</label>
							<input class="form-control" type="password" id="password" name="password">
						</div>
						<button name="login" class="btn btn-primary col-lg-12 mb-2" type="submit">Login</button>
						<a href="register.php" class=" mb-1"><u> Reset Password?</u></a>
					</div>
				</div>
			</form>
		</div>
	</div>
	<?php include "js.php"?>
</body>
</html>