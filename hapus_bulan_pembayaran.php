<?php 
	require 'connection.php';
	$id_bulan_pembayaran = $_GET['id_bulan_pembayaran'];
	if (isset($id_bulan_pembayaran)) {
		if (deleteBulanPembayaran($id_bulan_pembayaran) > 0) {
			setAlert("Bulan Pembayaran has been deleted", "Successfully deleted", "success");
		    header("Location: uang_kas.php");
	    }
	} else {
	   header("Location: uang_kas.php");
	}