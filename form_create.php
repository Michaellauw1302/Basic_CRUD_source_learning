<?php 
	session_start();

	//cek apakah session sudah pernah dibuat atau belum
	if ( !isset($_SESSION["login"])) {
		header("Location:login.php");
		exit;
	}
	require 'fungsi.php';
	//cek apakah tombol submit sudah di tekan atau belum
	if ( isset($_POST["submit"]) ) {
		//debuging
		// var_dump($_POST);  //die berfungsi agar script selanjutnya tidak dijalankan
		// var_dump($_FILES); die;

		//cek apakah data berhasil ditambahkan atau tidak	
		if ( tambah($_POST) > 0 ) {
			echo "<script>
					alert('data berhasil ditambahkan');
					document.location.href = 'index.php'
				  </script>";
		}else{
			echo "<script>
					alert('data gagal ditambahkan');
				</script>";
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

<h1>Tambah Jadwal Mata kuliah</h1>
<a href="index.php"><button>Kembali</button></a>
<form action="" method="post" enctype="multipart/form-data">
	<table width="20%">
		<tr>
			<td>Nama matkul</td>
			<td><input type="text" name="nama_matkul" id="nama_matkul"></td>
		</tr>
		<tr>
			<td>Nama Dosen</td>
			<td><input type="text" name="namadosen" id="namadosen"></td>
		</tr>
		<tr>
			<td>waktu</td>
			<td><input type="text" name="waktu" id="waktu"></td>
		</tr>
		<tr>
			<td>Hari</td>
			<td><input type="text" name="hari" id="hari"></td>	
		</tr>
		<tr>
			<td>Ruangan</td>
			<td><input type="text" name="ruangan" id="ruangan"></td>
		</tr>
		<tr>
			<td>Terlaksana</td>
			<td><input type="text" name="terlaksana" id="terlaksana"></td>
		</tr>
		<tr>
			<td>Tugas</td>
			<td><input type="file" name="tugas" id="tugas"></td>
		</tr>
			<tr>
				<td><button type="submit" name="submit">Tambah +</button></td>	
			</tr>
			

		
	
	</table>
	
</form>
</body>
</html>