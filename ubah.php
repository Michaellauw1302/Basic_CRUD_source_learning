<?php 
	session_start();
	//cek apakah session sudah pernah dibuat atau belum
	//cek session
	if ( !isset($_SESSION["login"]))  {
		header("Location:login.php");
		exit;
	}


	require 'fungsi.php';
	//mengambil id dari URL
	$id = $_GET["id_matkul"];
	
	//mengambil data berdasarka id yang diambil dari URL
	$data = query("SELECT * FROM jadwal_kuliah WHERE id_matkul = $id")[0];


	//cek apakah tombol submit sudah di tekan atau belum
	if ( isset($_POST["submit"]) ) {

		//cek apakah data berhasil diubah atau tidak
		if ( ubah($_POST) > 0 ) {
			echo "<script>
					alert('data berhasil diubah');
					document.location.href = 'index.php'
				  </script>";
		}else{
			echo "<script>
					alert('data gagal diubah');
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

<h1>Ubah Jadwal Mata kuliah</h1>
<a href="index.php"><button>Kembali</button></a>
<form action="" method="post" enctype="multipart/form-data">
	<table width="20%">

		<input type="hidden" name="id_matkul" value="<?= $data["id_matkul"]; ?>">
		<input type="hidden" name="tugasLama" value="<?= $data["tugas"]; ?>">
		<tr>
			<td>Nama matkul</td>
			<td><input type="text" name="nama_matkul" id="nama_matkul" value="<?= $data["nama_matkul"]; ?>"></td>
		</tr>
		<tr>
			<td>Nama Dosen</td>
			<td><input type="text" name="namadosen" id="namadosen"  value="<?= $data["nm_dosen"]; ?>"></td>
		</tr>
		<tr>
			<td>waktu</td>
			<td><input type="text" name="waktu" id="waktu" value="<?= $data["waktu"]; ?>"></td>
		</tr>
		<tr>
			<td>Hari</td>
			<td><input type="text" name="hari" id="hari" value="<?= $data["hari"]; ?>"></td>	
		</tr>
		<tr>
			<td>Ruangan</td>
			<td><input type="text" name="ruangan" id="ruangan" value="<?= $data["ruangan"]; ?>"></td>
		</tr>
		<tr>
			<td>Terlaksana</td>
			<td><input type="text" name="terlaksana" id="terlaksana" value="<?= $data["terlaksana"]; ?>"></td>
		</tr>
		<tr>
			<td><img style="width: 100px;" src="data/<?= $data['tugas']; ?>"></td>
			<td><input type="file" name="tugas" id="tugas"></td>
		</tr> 
			<tr>
				<td><button type="submit" name="submit">Ubah</button></td>	
			</tr>
			

		
	
	</table>
	
</form>
</body>
</html>