<?php
include "../../include/koneksi.php";
	$menu = $_GET["menu"];
	if ($menu == 'category') {
		# code...
		$sql="DELETE from category where category_id='$_GET[id]'";
		if (!mysql_query($sql)) {
			echo "Data tidak terhapus";
			# code...
		}
		header('location:../../home.php?menu=category&id=0');

	} elseif ($menu == 'subcategory') {
		# code...
		$sql="DELETE from subcategory where subcategory_id='$_GET[id]'";
		if (!mysql_query($sql)) {
			echo "Data tidak terhapus";
			# code...
		}
		header('location:../../home.php?menu=subcategory&id=0');
	}
	
?>