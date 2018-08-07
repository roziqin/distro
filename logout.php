<?php
session_start();
	include "include/koneksi.php";
	$id = $_SESSION['login_user'];
	date_default_timezone_set('Asia/jakarta');
	$tgl=date('Y-m-j');
	$wkt=date('H:i:s');
	$tgl1= $tgl." ".$wkt;
	/*
	date_default_timezone_set('Asia/jakarta');
	$tgl=date('Y-m-j');
	$wkt=date('G:i:s');
	
	$aa = "select * from history_user where id_history IN (select MAX(id_history) from history_user)";
	$bb = mysql_query($aa) or die(mysql_error());
	$cc = mysql_fetch_array($bb);
	$history_id=$cc['id_history'];
	mysql_query("update history_user set tanggal_logout='$tgl', waktu_logout='$wkt' where id_history='$history_id'");
	echo mysql_error() ;
	
$aid = $_SESSION['login_user'];
echo $aid;
	$a = "SELECT * from no_nota_temp_1 where no_nota_temp_1_user_id='$aid'";
	$b = mysql_query($a) or die(mysql_error());
	$c = mysql_fetch_array($b);
	$nota=$c['no_nota_temp_1_no_nota'];

$deletesql="DELETE from transaksi_jual_detail_temp WHERE transaksi_jual_detail_temp_no_nota='$nota'";
 mysql_query($deletesql);

mysql_query("DELETE FROM no_nota_temp_1 WHERE no_nota_temp_1_user_id='$aid'");
//mysql_query("DELETE FROM no_nota_temp_1");

*/
$qn= "SELECT MAX( id ) AS id FROM log_user where user='$id'";
$rn=mysql_query($qn);
$dn=mysql_fetch_array($rn);
$user = $dn['id'];

mysql_query("UPDATE log_user SET logout='$tgl1' WHERE id='$user'");

mysql_query("DELETE from transaksi_temp where transaksi_temp_user_id='$id'");
mysql_query("DELETE from member_temp where user_id='$id'");
	
$_SESSION['login_user']=NULL;	
$_SESSION['login'] = 0;	
  session_destroy();
header("location:index.php");
	
?>