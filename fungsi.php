<?php 
//koneksi ke database
$conn = mysqli_connect("localhost","root","","data_kuliah");

//mengambil data dari database
function query($query){
	global $conn;
	$result = mysqli_query($conn, $query);
	//menyiapkan wadah array untuk menampung data
	// $rows = [] --> merupakan array kosong yang nantinya digunakan untuk menampung data dari variabel $row
	//$row merupakan isi data dari database  yang akan ditampung dalam variabel $rows
	$rows = [];
	while ( $row = mysqli_fetch_assoc($result) ) {
		//mengisi wadah dengan data yang diambil
		$rows[] = $row;
	}
		//mengembalikan kotak yang telah diisi dengan data;
		return $rows;		
}

function tambah($data){
		//ambil data dari form 
		//tidak menggunakan post, karna post $_POST akan ditangkap oleh variabel data
		global $conn;
		$nama_matkul = htmlspecialchars($data["nama_matkul"]);
		$nm_dosen = htmlspecialchars($data["namadosen"]) ;
		$waktu = htmlspecialchars( $data["waktu"]) ;
		$hari = htmlspecialchars($data["hari"])  ;
		$ruangan = htmlspecialchars($data["ruangan"])  ;
		$terlaksana = htmlspecialchars($data["terlaksana"])  ;
		
		//upload gambar	
		$tugas = upload();
		if ( $tugas == false) {
			return false;
		}



		//syntax querry
		$query = "INSERT INTO jadwal_kuliah VALUES
				 ('','$nama_matkul','$nm_dosen','$waktu','$hari', '$ruangan','$terlaksana','$tugas')";
		mysqli_query ($conn, $query);
		return mysqli_affected_rows($conn);
}

function upload(){
	$namaFile = $_FILES['tugas']['name'];
	$ukuranFile = $_FILES['tugas']['size'];
	$tipeFIle = $_FILES['tugas']['type'];
	$error = $_FILES['tugas']['error'];
	$tmpName = $_FILES['tugas']['tmp_name'];

	//cek apakah tidak ada gambar yang di upload
		// === 4 adalah tidak ada file yang di upload
		// === 0 ada file yang diupload
	if ( $error === 4 ) {
		echo "
				<script>
					alert('pilih gambar terlebih dahulu');
				</script>
		";
		return false;
	}

	//cek apakah yang diupload file atau gambar
	$ekstensiFileValid = ['jpg', 'jpeg','png','pdf'];
	//mengambil ekstensi file
	$ekstensiFile = explode('.', $namaFile); //berfungsi untuk memecah string menjadi array
	$ekstensiFile = strtolower(end($ekstensiFile));

	//memeriksa ekstensi gambar sesuai dengan gambar yang valid
	if ( !in_array($ekstensiFile, $ekstensiFileValid) ) {
		echo "
				<script>
					alert('file tidak sesuai');
				</script>
		";
	}

	//cek jika ukuran file melebihi / atau pembatasan size dari file
	if ($ukuranFile > 1000000 ) {
		echo "
				<script>
					alert('ukuran file melebihi batas');
				</script>
		";
		return false;
	}

	//generate nama file baru
	$namaFileBaru = uniqid();
	$namaFileBaru .= '.';
	$namaFileBaru .= $ekstensiFile;
	// var_dump($namaFileBaru); die;

	//action jika file memenuhi kriteria
	move_uploaded_file($tmpName, 'data/'.$namaFileBaru);
	return $namaFileBaru; 
}

function ubah($data){
		global $conn;
		$id = $data["id_matkul"];
		$nama_matkul = htmlspecialchars($data["nama_matkul"]);
		$nm_dosen = htmlspecialchars($data["namadosen"]) ;
		$waktu = htmlspecialchars( $data["waktu"]) ;
		$hari = htmlspecialchars($data["hari"])  ;
		$ruangan = htmlspecialchars($data["ruangan"])  ;
		$terlaksana = htmlspecialchars($data["terlaksana"])  ;
		
		$tugasLama = htmlspecialchars($data["tugasLama"]);
		

		//periksa apakah user memilih file baru atu tidak
		// === 4 adalah tidak ada file yang di upload
		// === 0 ada file yang diupload
		if ($_FILES['tugas']['error'] === 4) {
			$tugas = $tugasLama;
		}else{
			//jika ada gambar
			$tugas = upload();
		}

		//syntax querry
		$query = "UPDATE jadwal_kuliah SET
					nama_matkul = '$nama_matkul',
					nm_dosen = '$nm_dosen',
					waktu = '$waktu',
					hari = '$hari',
					ruangan = '$ruangan',
					terlaksana = '$terlaksana',
					tugas = '$tugas';
					WHERE id_matkul = $id;
					";

		mysqli_query ($conn, $query);
		return mysqli_affected_rows($conn);	
}

function hapus($id_matkul){
	global $conn;
	mysqli_query($conn, "DELETE FROM jadwal_kuliah WHERE id_matkul = $id_matkul");
	return mysqli_affected_rows($conn);
}

function cari($search){
	$query = "SELECT * FROM jadwal_kuliah 
				WHERE
					nama_matkul LIKE '%$search%' OR
					nm_dosen LIKE '%$search%' OR
					hari LIKE '%$search%' OR
					ruangan LIKE '%$search%' OR
					terlaksana LIKE '%$search%'
				";
	//mengembalikan variabel query dari fungsi query karna fungsi query mengembalikan array assosiatif
	return query($query);
}

function register($data){
	global $conn;
	//stripcslashes() --> fungsi agar user tidak memasukan karakter pada username
	$username = strtolower(stripcslashes($data["username"]));
	$password = mysqli_real_escape_string($conn, $data["password"]);
	$password2 = mysqli_real_escape_string($conn, $data["password2"]);

	//|| --------------------------------------------------------- ||
	//cek apakah username sudah ada dalam database atau belum / atau sudah pernah digunakan atau belum
	$cekUsername = mysqli_query($conn, "SELECT username FROM user WHERE username = '$username' ");

	//perkonisian jika username sudah pernah digunakan dan ada dalam database
	if ( mysqli_fetch_assoc($cekUsername) ) {
		echo "
				<script>
					alert('username sudah digunakan');
				</script>
			 ";
		//jika username pernah digunakan , maka return false agar user tidak masuk kedalam sistem
		return false;
	}	


	//|| --------------------------------------------------------- ||

	//cek konfirmasi password --> apakah password 1 sesuai dengan password 2
	if ( $password !== $password2 ) {
		echo "
					<script>
						alert('konfirmasi password tidak sesuai');
					</script>
				 ";

		return false;
	}



	//mengembalikan nilai 1, -- > 1 = berarti benar
	// return 1; --> debuging

	//enskripsi password
	//(parameter1 , parameter2) parameter1 = password yang akan di enskripsi
	//------------------------- parameter2 = algoritma yang digunakan untuke mengacak password
	$password = password_hash($password, PASSWORD_DEFAULT);

	//menambahkan user baru ke database
	mysqli_query($conn, "INSERT INTO user VALUES ('','$username', '$password') ");

	//mengecek menggunakan mysqli_affected_row yang menghasilkan 1 jika benar dan -1 jika gagal
	return mysqli_affected_rows($conn);

}

?>