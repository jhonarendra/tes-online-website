<?php
	// INI ISI LANDING PAGE

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
				}
				header("Location: mahasiswa");
				exit();
			} else {
				echo "string";
				foreach ($login_dosen as $user_dosen) {
					$_SESSION['nama_dosen'] = $user_dosen['nama_dosen'];
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
	<form method='POST' action=''>
		<div class='form-horizontal'>
			<div class='fnama form-group'>
				<label for="fnama" class='col-sm-2 control-label'>Nama</label>
				<div class='col-sm-10'>
					<input type="text" name="username" class='form-control' id="fnama" required="isi" />
				</div>
			</div>
			<div class='fnim form-group'>
				<label for="fnama" class='col-sm-2 control-label'>Password</label>
				<div class='col-sm-10'>
					<input type="password" name="password" class='form-control' id="nim" required="isi" />
				</div>
			</div>
			<div class='center-block'>
				<input type='submit' id='kirim' class="btn btn-primary" />

				<a class="btn btn-success" href="register.php">Register</a>
			</div>
		</div>
	</form>
<?php
		}
	}
?>