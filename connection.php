<?php 
	include 'include/js.php';
	
	session_start();

	$host		= "localhost";
	$username	= "root";
	$password	= "";
	$database	= "uang_kas";

	$conn 		= mysqli_connect($host, $username, $password, $database);
	if ($conn) {
		// echo "berhasil terkoneksi!";
	} else {
		echo "gagal terkoneksi!";
	}

// ======================================== FUNCTION ========================================
function setAlert($title='', $text='', $type='', $buttons='') {
	$_SESSION["alert"]["title"]		= $title;
	$_SESSION["alert"]["text"] 		= $text;
	$_SESSION["alert"]["type"] 		= $type;
	$_SESSION["alert"]["buttons"]	= $buttons; 
}

if (isset($_SESSION['alert'])) {
	$title 		= $_SESSION["alert"]["title"];
	$text 		= $_SESSION["alert"]["text"];
	$type 		= $_SESSION["alert"]["type"];
	$buttons	= $_SESSION["alert"]["buttons"];

	echo"
		<div id='msg' data-title='".$title."' data-type='".$type."' data-text='".$text."' data-buttons='".$buttons."'></div>
		<script>
			let title 		= $('#msg').data('title');
			let type 		= $('#msg').data('type');
			let text 		= $('#msg').data('text');
			let buttons		= $('#msg').data('buttons');

			if(text != '' && type != '' && title != '') {
				Swal.fire({
					title: title,
					text: text,
					icon: type,
				});
			}
		</script>
	";
	unset($_SESSION["alert"]);
}

function checkLogin() {
	if (!isset($_SESSION['id_user'])) {
		setAlert("Access Denied!", "Login First!", "error");
		header('Location: login.php');
	} 
}

function checkLoginAtLogin() {
	if (isset($_SESSION['id_user'])) {
		setAlert("You has been logged!", "Welcome!", "success");
		header('Location: index.php');
	}
}

function logout() {
	setAlert("You has been logout!", "Success Logout!", "success");
	header("Location: login.php");
}

if (isset($_SESSION['id_user'])) {
	function dataUser() {
		global $conn;
		$id_user = $_SESSION['id_user'];
		return mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM user INNER JOIN jabatan ON user.id_jabatan = jabatan.id_jabatan WHERE id_user = '$id_user'"));
	}
}

function editUser($data) {
	global $conn;
	$id_user = htmlspecialchars($data['id_user']);
	$nama_lengkap = htmlspecialchars(addslashes($data['nama_lengkap']));
  	$username = htmlspecialchars($data['username']);
  	$id_jabatan = htmlspecialchars($data['id_jabatan']);
  	$query = mysqli_query($conn, "UPDATE user SET nama_lengkap = '$nama_lengkap', username = '$username', id_jabatan = '$id_jabatan' WHERE id_user = '$id_user'");
  	return mysqli_affected_rows($conn);
}


function editJabatan($data) {
	global $conn;
	$id_jabatan = htmlspecialchars($data['id_jabatan']);
  	$nama_jabatan = htmlspecialchars($data['nama_jabatan']);
  	$query = mysqli_query($conn, "UPDATE jabatan SET nama_jabatan = '$nama_jabatan' WHERE id_jabatan = '$id_jabatan'");
  	return mysqli_affected_rows($conn);
}

function checkJabatan() {
	$id_jabatan = $_SESSION['id_jabatan'];
	if ($id_jabatan !== '1') {
		setAlert("Access Denied!", "You cannot delete data except administrator!", "error");
     	header("Location: index.php");
	} else {
		return true;
	}
}

function deleteJabatan($id) {
	global $conn;
	if (checkJabatan() == true) {
		$query = mysqli_query($conn, "DELETE FROM jabatan WHERE id_jabatan = '$id'");
	  	return mysqli_affected_rows($conn);
	}
}

function addJabatan($data) {
	global $conn;
	$nama_jabatan = htmlspecialchars($data['nama_jabatan']);
	$query = mysqli_query($conn, "INSERT INTO jabatan VALUES ('', '$nama_jabatan')");
  	return mysqli_affected_rows($conn);
}

function addUser($data) {
	global $conn;
	// check username already used or not
	$username = htmlspecialchars($data['username']);
	$query = mysqli_query($conn, "SELECT * FROM user WHERE username = '$username'");
	if (mysqli_fetch_assoc($query)) {
		setAlert("Failed to add user!", "Username has been used!", "error");
     	return header("Location: user.php");
	} else {
		$password = htmlspecialchars($data['password']);
		$password_verify = htmlspecialchars($data['password_verify']);
		if ($password !== $password_verify) {
			setAlert("Failed to add user!", "password not same password verify!", "error");
	     	return header("Location: user.php");
		} else {
			$password = password_hash($password, PASSWORD_DEFAULT);
			$nama_lengkap = htmlspecialchars($data['nama_lengkap']);
			$id_jabatan = htmlspecialchars($data['id_jabatan']);
			$query = mysqli_query($conn, "INSERT INTO user VALUES ('', '$nama_lengkap', '$username', '$password', '$id_jabatan')");
		  	return mysqli_affected_rows($conn);
		}
	}
}

function deleteUser($id) {
	global $conn;
	if (checkJabatan() == true) {
		$query = mysqli_query($conn, "DELETE FROM user WHERE id_user = '$id'");
	  	return mysqli_affected_rows($conn);
	}
}

function addSiswa($data) {
	global $conn;
	$nama_siswa = htmlspecialchars($data['nama_siswa']);
	$jenis_kelamin = htmlspecialchars($data['jenis_kelamin']);
	$no_telepon = htmlspecialchars($data['no_telepon']);
	$email = htmlspecialchars($data['email']);
	$query = mysqli_query($conn, "INSERT INTO siswa VALUES ('', '$nama_siswa', '$jenis_kelamin', '$no_telepon', '$email')");
  	return mysqli_affected_rows($conn);
}

function deleteSiswa($id) {
	global $conn;
	if (checkJabatan() == true) {
		$query = mysqli_query($conn, "DELETE FROM siswa WHERE id_siswa = '$id'");
	  	return mysqli_affected_rows($conn);
	}
}

function editSiswa($data) {
	global $conn;
	$id_siswa = htmlspecialchars($data['id_siswa']);
	$nama_siswa = htmlspecialchars($data['nama_siswa']);
	$jenis_kelamin = htmlspecialchars($data['jenis_kelamin']);
	$no_telepon = htmlspecialchars($data['no_telepon']);
	$email = htmlspecialchars($data['email']);
	$query = mysqli_query($conn, "UPDATE siswa SET nama_siswa = '$nama_siswa', jenis_kelamin = '$jenis_kelamin', no_telepon = '$no_telepon', email = '$email' WHERE id_siswa = '$id_siswa'");
  	return mysqli_affected_rows($conn);
}