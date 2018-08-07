<?php
include "../../include/koneksi.php";
$sql="DELETE from member where member_id='$_GET[id]'";
	if (!mysql_query($sql)) {
		echo "Data tidak terhapus";
		# code...
	}
		header("location:../../home.php?menu=member&id=0");
	
?>