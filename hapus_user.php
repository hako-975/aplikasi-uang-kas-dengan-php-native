<?php 
	require 'connection.php';
	$id_user = $_GET['id_user'];
	if (isset($id_user)) {
		if (deleteUser($id_user) > 0) {
			setAlert("User has been deleted", "Successfully deleted", "success");
		    header("Location: user.php");
	    }
	} else {
	   header("Location: user.php");
	}