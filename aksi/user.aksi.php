<?php
include "../include/koneksi.php";
	

	if(isset($_POST['tambah'])){
		$nama=$_POST['nama'];
	$username=$_POST['username'];
	$email=$_POST['username']."@gmail.com";
	$password=md5($_POST['password']);
	$jenis=$_POST['jenis'];
	$id=$_POST['id'];

	$text_line = explode(".",$_POST['gaji']);
	$length=count($text_line);
	if ($length==1) {
		$gaji=$text_line[0];
		# code...
	}elseif ($length==2) {
		$gaji=$text_line[0]."".$text_line[1];
		# code...
	}elseif ($length==3) {
		# code...
		$gaji=$text_line[0]."".$text_line[1]."".$text_line[2];
	}elseif ($length==4) {
		# code...
		$gaji=$text_line[0]."".$text_line[1]."".$text_line[2]."".$text_line[3];
	}elseif ($length==5) {
		# code...
		$gaji=$text_line[0]."".$text_line[1]."".$text_line[2]."".$text_line[3]."".$text_line[4];
	}

		$a="INSERT into users(name,username,email,password,role,gaji)values('$nama','$username','$email','$password','$jenis','$gaji')";
		$b=mysql_query($a);
		echo mysql_error();
		if($b){
		    echo ("<script>location.href='../home.php?menu=user&id=0'</script>");
		}else{
		echo "<script type='text/javascript'>
			onload =function(){
			alert('Data gagal disimpan');
			}
			</script>";
		}
	} elseif (isset($_POST['edit'])) {
		# code...
		$nama=$_POST['nama'];
	$username=$_POST['username'];
	$password=md5($_POST['password']);
	$jenis=$_POST['jenis'];
	$id=$_POST['id'];

	$text_line = explode(".",$_POST['gaji']);
	$length=count($text_line);
	if ($length==1) {
		$gaji=$text_line[0];
		# code...
	}elseif ($length==2) {
		$gaji=$text_line[0]."".$text_line[1];
		# code...
	}elseif ($length==3) {
		# code...
		$gaji=$text_line[0]."".$text_line[1]."".$text_line[2];
	}elseif ($length==4) {
		# code...
		$gaji=$text_line[0]."".$text_line[1]."".$text_line[2]."".$text_line[3];
	}elseif ($length==5) {
		# code...
		$gaji=$text_line[0]."".$text_line[1]."".$text_line[2]."".$text_line[3]."".$text_line[4];
	}
		$id=$_POST['id'];
		$a="UPDATE users set name='$nama',username='$username',role='$jenis', gaji='$gaji' where id='$id'";
		$b=mysql_query($a);
		echo mysql_error();
		if ($password == '') {
			# code...
		} elseif ($password == NULL) {
			# code...
		} else {
			# code...
			mysql_query("UPDATE users set password='$password' where id='$id'");
		}
		
		if($b){
		   echo ("<script>location.href='../home.php?menu=user&id=0'</script>");
			
		}else{
			echo "<script type='text/javascript'>
			onload =function(){
			alert('Data gagal disimpan');
			}
			</script>";
		}
	}




