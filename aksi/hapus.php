<?php
include "../include/koneksi.php";
$id = $_GET['id'];
if ($_GET['menu']=='transaksi') {
	$sql="DELETE from transaksi_temp where transaksi_temp_id='$id'";
	if (!mysql_query($sql)) {
		echo "Data tidak terhapus";
		# code...
	}else{
		echo "<script>location.href='../transaksi.php?menu=home'</script>";
	
	}

}

?>