<?php
session_start();
include "../include/koneksi.php";

		$user = $_SESSION['login_user'];
		mysql_query("DELETE from transaksi_temp where transaksi_temp_user_id='$user'");
			mysql_query("DELETE from member_temp where user_id='$user'");

			echo ("<script>location.href='../transaksi.php?menu=home&nonota='</script>");
?>