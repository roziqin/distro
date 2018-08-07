<?php
session_start();
  	$sid_lama = session_id();
	
	session_regenerate_id();

	$sid_baru = session_id();

include "../include/koneksi.php";
	
if($_SERVER["REQUEST_METHOD"] == "POST")
{
	
	date_default_timezone_set('Asia/jakarta');
	$tgl=date('Y-m-j');
	$wkt=date('H:i:s');
	$tgl2= $tgl." ".$wkt;
	$tgl1=date('Y-m-j', strtotime('-1 day', strtotime($tgl)));
	// username and password sent from Form
	$myusername=$_POST['username'];
	$mypassword=md5($_POST['password']);

	$sql="select * from users where username = '$myusername' and password = '$mypassword' ";
	$result=mysql_query($sql);
	$data=mysql_fetch_array($result);
	$a = $data['id'];
	$ddd = $data['role'];
	$count=mysql_num_rows($result);
	

	// If result matched $myusername and $mypassword, table row must be 1 row
	if($count==1)
	{
	
	$_SESSION['login_user']=$a;
	$_SESSION['name']= $data['name'];
	$_SESSION['login'] = 1;
	$_SESSION['namauser']     = $data['username'];
	$_SESSION['passuser']     = $data['password'];
	$_SESSION['role']		  = $data['role'];


	
	$a="INSERT into log_user(user,login)values('$a','$tgl2')";
	mysql_query($a);
		
    echo ("<script>location.href='../home.php?menu=home&nonota='</script>");
			
	}
	else 
	{
		echo "<script type='text/javascript'>
			onload =function(){
			alert('Username & Password tidak sesuai!');
			}
			location.href='../index.php'
			</script>";
	}
}

?>