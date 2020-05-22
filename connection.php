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
	$id_user = htmlspecialchars($_SESSION['id_user']);
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