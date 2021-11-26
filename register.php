<?php 
	require 'fungsi.php';

	//kondisi ketika tombol register sudah ditekan
	if ( isset($_POST["daftar"]) ) {
		
		//perkondisian jika nilai lebih dari 0 maka ada user baru yang berhasil daftar
		if ( register($_POST) > 0 ) {
			echo "
					<script>
						alert('selamat datang ke sistem');
					</script>
				 ";
		}else{
			echo mysqli_error($conn);
		}

	}

?>

<!DOCTYPE html>

<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title></title>
</head>
<body>	

	<h1>Register Admin</h1>

	<form action="" method="post">
		<ul>
			<li>
				<label for="username">Username : </label>
				<input type="text" name="username" id=username>
			</li>
			<br>
			<br>
			<li>
				<label for="password">Password :</label>
				<input type="password" name="password">
			</li>
			<br>
			<br>
			<li>
				<label for="password2">Konfirmasi Password :</label>
				<input type="password" name="password2">
			</li>
			<br>
			<button type="submit" name="daftar">Daftar</button>
		</ul>
	</form>


</body>
</html>