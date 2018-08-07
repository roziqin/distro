<?php
include "../../include/koneksi.php";
$sql="DELETE from users where id='$_GET[id]'";
	if (!mysql_query($sql)) {
		echo "Data tidak terhapus";
		# code...
	}
		header("location:../../home.php?menu=user&id=0");
	
?>