<?php 
	require 'fungsi.php';
	//menjalankan fungsi session
	session_start();
	//cek cookie
	//ada atau tidak isi cookie
	// if ( isset($_COOKIE['login']) ) {
	// 	cek apakah isi dari cookie true atau tidak
	// 	if ( $_COOKIE['login'] === 'true' ) {
	// 		$_SESSION['login'] = true;
	// 	}
	// }

	//cek apakah ada atau tidak cookie yang dibuat
	if ( isset($_COOKIE['id']) && isset($_COOKIE['key']) ) {
		$id = $_COOKIE['id'];
		$key = $_COOKIE['key'];

		//ambil username berdasarkan id
		$require = mysqli_query($conn, "SELECT username FROM user WHERE id_user = $id");

		//cek cookie dan username sama atau tidak
		if ( $key === hash('sha256', $row['username']) ) {
			$_SESSION['login'] = true;
		}
	}

	//cek jika sudah melakkan login , maka kembalikan ke halaman index
	if ( isset($_SESSION["login"]) ) {
		header("Location:index.php");
		exit;
	}

	
	//cek apakah tombol submit sudah ditekan atau belum
	if ( isset($_POST["login"]) ) {
		//menangkap atau mengambil username dan password daru form yang telah diisikan oleh user
		$username = $_POST["username"];
		$password = $_POST["password"];

		//cek apakah username yang diinputkan sesuai dan ada pada username pada database, jika ada maka lanjutkan ke pengecekan password
		
		$result = mysqli_query($conn, "SELECT * FROM user WHERE username = '$username'");

		//mysqli_num_rows() --> digunakan untuk menghitung jumlah barus yang dikembalikan dari fungsi select diatas, kalau daanya ada maka nilainya 1, dan kalau tidak ada nilainya 0

		if ( mysqli_num_rows($result) === 1 ) {
			//jika username ada maka lanjutkan dengan cek password 

			$row = mysqli_fetch_assoc($result);

			//password verify --> untuk mengecek apaah (string = hash)
			//perkondisian jika password yang diinput sama dengan password yang terdapat dala database. Dengan cara membandingkan password yang diisi oleh user dengan password yang ada pad database

			if (password_verify($password, $row["password"])) {
				//set session sebelum user masuk kehalaman index
				$_SESSION["login"] = true;

				//cek rememberme using cookie
				if ( isset($_POST["remember"]) ) {
					//membuat cookie
					setcookie('id', $row['id_user'], time()+60);
					setcookie('key', hash('sha256', $row['username']));
				}

				header("Location: index.php");
				exit;
			}
		}
		//jika username atau password tidak ada

		$error = true;
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
<!-- variabel error digunakan untuk memberikan pesan kesalahan -->
<?php if ( isset($error) ) : ?>
	<p>username / password salah</p>
<?php endif; ?>

<h1>Halaman Login</h1>
<form action="" method="post">
	<label for="username">Username</label>
	<input type="text" name="username" id="username">
	<br>
	<br>
	<label for="password">Password</label>
	<input type="password" name="password" id="password">

	<label for="remamber">remember ME</label>
	<input type="checkbox" name="remember">
	<br>
	<button type="submit" name="login" >Login</button>
</form>

</body>
</html>