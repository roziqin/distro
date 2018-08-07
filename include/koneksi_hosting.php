<?php
	$nama_host="50.28.78.34";
	$user_db="januscoi_user";
	$pass="wl0tI&!n5J(7";
	$nama_db="januscoi_risol";

	$koneksi=mysql_connect($nama_host,$user_db,$pass);

	if ($koneksi) {
		mysql_select_db($nama_db);
		# code...
	}else{
		echo "error";
	}
?>