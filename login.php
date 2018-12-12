<?php
	if(isset($_POST['username'])){
		$username = $_POST['username'];
		$password = $_POST['password'];

		$login_mhs = mysqli_query($conn, "SELECT * FROM tb_mhs WHERE username_mhs='$username' AND PASSWORD_mhs='$password'");
		$numrow_mhs = mysqli_num_rows($login_mhs);

		$login_dosen = mysqli_query($conn, "SELECT * FROM tb_dosen WHERE username_dosen='$username' AND PASSWORD_dosen='$password'");
		$numrow_dosen = mysqli_num_rows($login_dosen);

		echo $numrow_dosen;

		if($numrow_mhs == 1 || $numrow_dosen == 1){
			if($numrow_mhs == 1){
				foreach ($login_mhs as $user_mhs) {
					$_SESSION['nama_mhs'] = $user_mhs['nama_mhs'];
					$_SESSION['id_mhs'] = $user_mhs['id_mhs'];
				}
				header("Location: mahasiswa");
				exit();
			} else {
				echo "string";
				foreach ($login_dosen as $user_dosen) {
					$_SESSION['nama_dosen'] = $user_dosen['nama_dosen'];
					$_SESSION['id_dosen'] = $user_dosen['id_dosen'];
				}
				header("Location: dosen");
				exit();
			}
		} else {
			echo "salah";
		}
	} else {
		if(isset($_SESSION['nama_mhs'])||isset($_SESSION['nama_dosen'])){
			if(isset($_SESSION['nama_mhs'])){
				echo $_SESSION['nama_mhs'];
				echo "<a href=\"mahasiswa\">Halaman Mahasiswa</a>";
			} else {
				echo $_SESSION['nama_dosen'];
				echo "<a href=\"dosen\">Halaman Dosen</a>";
			}
		} else {
?>
<!doctype html>
<html lang="en" class="fullscreen-bg">

<head>
	<title>Login | Tes Online LSI</title>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
	<!-- VENDOR CSS -->
	<link rel="stylesheet" href="<?php echo $web_url."template"?>/css/bootstrap.min.css">
	<link rel="stylesheet" href="<?php echo $web_url."template"?>/vendor/font-awesome/css/font-awesome.min.css">
	<link rel="stylesheet" href="<?php echo $web_url."template"?>/vendor/linearicons/style.css">
	<!-- MAIN CSS -->
	<link rel="stylesheet" href="<?php echo $web_url."template"?>/css/main.css">
	<!-- FOR DEMO PURPOSES ONLY. You should remove this in your project -->
	<link rel="stylesheet" href="<?php echo $web_url."template"?>/css/demo.css">
	<!-- GOOGLE FONTS -->
	<link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700" rel="stylesheet">
	<!-- ICONS -->
	<link rel="apple-touch-icon" sizes="76x76" href="<?php echo $web_url."template"?>/img/icon.png">
	<link rel="icon" type="image/png" sizes="96x96" href="<?php echo $web_url."template"?>/img/icon.png">
</head>
<body>
	<!-- WRAPPER -->
	<div id="wrapper">
		<div class="vertical-align-wrap">
			<div class="vertical-align-middle">
				<div class="auth-box ">
					<div class="left">
						<div class="content">
							<div class="header">
								<div class="logo text-center"><img src="<?php echo $web_url."template"?>/img/icon2.png" alt="LSI Logo" style="width:100px;height:100px"></div>
								<p class="lead">Login to your account</p>
							</div>
							<form class="form-auth-small" action="" method="POST">
								<div class="form-group">
									<label for="signin-email" class="control-label sr-only">Username</label>
									<input type="text" name="username" class="form-control" id="signin-email" placeholder="Username">
								</div>
								<div class="form-group">
									<label for="signin-password" class="control-label sr-only">Password</label>
									<input type="password" class="form-control" id="signin-password" name="password" placeholder="Password">
								</div>
								<button type="submit" class="btn btn-primary btn-lg btn-block">LOGIN</button>
							</form>
						</div>
					</div>
					<div class="right">
						<div class="overlay"></div>
						<div class="content text">
							<h1 class="heading">Tes Online LSI</h1>
							<p>Tes online isian dengan fitur cek similarity dengan metode LSI</p>
						</div>
					</div>
					<div class="clearfix"></div>
				</div>
			</div>
		</div>
	</div>
	<!-- END WRAPPER -->
</body>

</html>

<?php

		}
	}
?>