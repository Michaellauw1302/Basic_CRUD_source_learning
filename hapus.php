<?php 

require 'fungsi.php';
	session_start();

	//cek apakah session sudah pernah dibuat atau belum
	if ( !isset($_SESSION["login"])) ) {
		header("Location:login.php");
		exit;
	}

$id_matkul = $_GET["id_matkul"];

if ( hapus($id_matkul) > 0 ) {
	echo "<script>
	        alert('data berhasil dihapus');
		   </script>";
		header('Location:index.php');
}else{
		echo "<script>
	        alert('data gagal dihapus');
		   </script>";
		header('Location:index.php');
}


?>