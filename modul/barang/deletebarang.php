<?php
include "../../include/koneksi.php";


$sql="DELETE from barang where barang_id='$_GET[id]'";
if (!mysql_query($sql)) {
	echo "Data tidak terhapus";
	# code...
} else {
	header('location:../../home.php?menu=listbarang');
}
?>