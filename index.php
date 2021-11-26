<!-- 
	ASCENDING (ASC)  = Dariyang kecil ke besar
	DESCENDING (DESC) = dari yang besar ke yang kecil

 -->

<?php 
session_start();
//cek apakah ada session atau tidak, session dibuat jika user berhasil login, jika session tidak pernah dibuat maka==========================>> kembalikan kehalaman login
if ( !isset($_SESSION["login"]) ) {		   	
	//maka , kembalikan ke halaman login   	
	header("Location:login.php");
	exit;
}

//menghubungkan halaman index dengen fungsi
require('fungsi.php');

//pagination
//konfirgurasi pagination
$jumlahDataPerhalaman = 3;
$jumlahData = count(query("SELECT * FROM jadwal_kuliah"));
	//round --> berfungsi untuk membulatkan nilai ke nilai yang terdekat
	//floor --> berfungsi untuk membulatkan nilai ke bawah
	//ceil --> berfungsi untuk membulatkn nilai ke atas
$jumlahHalaman =  ceil($jumlahData / $jumlahDataPerhalaman);

//cek apakah ada $_GET['halaman'] pada URL
$halamanAktif = ( isset($_GET["halaman"]) ) ? $_GET["halaman"] : 1;

// data dihitung mulai dari index ke-0 
//halaman aktif = 2, berarti dimulai dari index ke 3
//halaman aktif = 3, berarti dimulai dari index ke 4
 
$awalData = ($jumlahDataPerhalaman * $halamanAktif) - $jumlahDataPerhalaman;

$data = query("SELECT * FROM jadwal_kuliah LIMIT $awalData, $jumlahDataPerhalaman");

//jika tombol cari diclick, akan menimpa $data
if ( isset($_POST["cari"]) ) {
	$data = cari($_POST["search"]);
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
<h1>Jadwal Mata kuliah</h1>
<a href="logout_session.php">Logout</a>
<a href="form_create.php"><button>Tambah Data +</button></a>
<br>
<br>
<br>

<form action="" method="post">
	<label>Cari data</label>
	<input type="text" name="search" size="40" autofocus placeholder="Search" autocomplete="off">
	<button type="submit" name="cari"> Search </button>
</form>
<br>
<br>
<?php if ( $halamanAktif > 1 ) : ?>
	<a href="?halaman=<?= $halamanAktif - 1 ?>">&laquo</a>
<?php endif; ?>
<!-- navigasi halaman -->
<?php for( $i = 1; $i < $jumlahHalaman; $i++ ) : ?>
	<!--konfirmasi ada di halaman ke berapa dengan membuat bold pada angka pada halaman-->
	<?php if ( $i == $halamanAktif): ?>
		<a href="?halaman=<?= $i ?>" style="font-weight: bold;"><?= $i ?></a>
	<?php else: ?>
	 	<a href="?halaman=<?= $i ?>"><?= $i ?></a>
	 <?php endif; ?>
<?php endfor; ?>
<?php if ( $halamanAktif < $jumlahHalaman ) : ?>
	<a href="?halaman=<?= $halamanAktif + 1 ?>">&raquo</a>
<?php endif; ?>
<br>
<br>
<table border="1" cellpadding="10" cellspacing="0">
	
	<tr>
		<th>No</th>
		<th>Nama Mata Kuliah</th>
		<th>Nama Dosen</th>
		<th>Waktu</th>
		<th>Hari</th>
		<th>Ruangan</th>
		<th>Terlaksana</th>
		<th>Tugas</th>
		<th>Manipulasi Data</th>
		
	</tr>
	<?php $i = 1; ?>
	<?php foreach($data as $jadwal): ?>
	<tr>
			
			<td><?= $i; ?></td>
			<td><?= $jadwal["nama_matkul"]; ?> </td>
			<td><?= $jadwal["nm_dosen"]; ?></td>
			<td><?= $jadwal["waktu"]; ?></td>
			<td><?= $jadwal["hari"]; ?></td>
			<td><?= $jadwal["ruangan"]; ?></td>
			<td><?= $jadwal["terlaksana"]; ?></td>
			<td><img style="width: 100px;" src="data/<?= $jadwal["tugas"] ?>"></td>
			<td>
				<a href="ubah.php?id_matkul=<?= $jadwal["id_matkul"]; ?>">EDIT</a>
				|	|
				<a href="hapus.php?id_matkul=<?= $jadwal["id_matkul"];?>"
					onclick="return confirm('yakin');">hapus</a>
			</td>
		
	</tr>
	<?php $i++; ?>
	<?php endforeach; ?>
</table>
</body>
</html>