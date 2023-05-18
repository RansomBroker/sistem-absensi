<?php 
	include "function.php";

	if(isset($_POST['reset'])) {
		resetpw($_POST);
	}
?>
<!DOCTYPE html>
<html>
<head>
    <?php include "head.php"?>

	<title>Reset Password</title>

    <?php include "css.php"?>
</head>
<body class="bg-warning bg-opacity-75 flex-column d-flex justify-content-center align-items-center vh-100">
	<div class="flex-row justify-content-center">
		<div class="d-flex justify-content-center align-items-center">
			<img src="img/logi-poltek.jpg" width="180" class="  rounded-circle mb-2" alt="logo">
		</div>
		<h4 class="text-center text-dark">Validasi Kehadiran Mahasiswa</h4>
	</div>
	<div class="mx-lg-3 mx-1 my-2 py-lg-3  col-lg-3 card rounded login  ">
		<div class="card-body py-0 px-3">
			<h4 class="text-center">Reset Password</h4>
			
			<form class="" method="POST" action="">
				<div class="d-flex  justify-content-center ">
					<div class=" row">
						<div class=" col-lg-12 mb-3 px-0 " >
							<label class="form-label" for="username">Username</label>
							<input type="text" id="username" name="username" class="form-control" required>

						</div>
						<div class="w-100 d-none" id="cek">
							<div class="col-lg-12 mb-3 px-0" >
								<label class="form-label" for="password">Password</label>
								<input class="form-control" type="password" id="password" name="password">
							</div>
							<button name="reset" class="btn btn-primary col-lg-12 mb-2" type="submit">Ubah Password</button>
						</div>
					</div>
				</div>
			</form>
		</div>
	</div>
	<?php include "js.php"?>
	<script>
		$(document).ready(function(){

		$("#username").keyup(function(){

			var username = $(this).val();

			if( username != ''){

			$.ajax({
				url: 'ambil-data-user.php',
				type: 'POST',
				data: {username: username},
				success: function(response){
					if (response != "null") {
						$('#cek').removeClass('d-none');
						$('[name=password]').attr('required', true);

					}if(response === "null" ){
						$('#cek').addClass('d-none');
						$('[name=password]').attr('required', false);
					}
				}
			});
			}

		});

 });
</script>
</body>
</html>