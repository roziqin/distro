<?php
include "../include/koneksi.php";
	
if (isset($_POST['edit'])) {
		# code...

	$id=$_POST['id'];
	$telepon=$_POST['telepon'];
	$alamat=$_POST['alamat'];

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

	$text_line = explode(".",$_POST['promo']);
	$length=count($text_line);
	if ($length==1) {
		$promo=$text_line[0];
		# code...
	}elseif ($length==2) {
		$promo=$text_line[0]."".$text_line[1];
		# code...
	}elseif ($length==3) {
		# code...
		$promo=$text_line[0]."".$text_line[1]."".$text_line[2];
	}elseif ($length==4) {
		# code...
		$promo=$text_line[0]."".$text_line[1]."".$text_line[2]."".$text_line[3];
	}elseif ($length==5) {
		# code...
		$promo=$text_line[0]."".$text_line[1]."".$text_line[2]."".$text_line[3]."".$text_line[4];
	}

	$text_line = explode(".",$_POST['sewa']);
	$length=count($text_line);
	if ($length==1) {
		$sewa=$text_line[0];
		# code...
	}elseif ($length==2) {
		$sewa=$text_line[0]."".$text_line[1];
		# code...
	}elseif ($length==3) {
		# code...
		$sewa=$text_line[0]."".$text_line[1]."".$text_line[2];
	}elseif ($length==4) {
		# code...
		$sewa=$text_line[0]."".$text_line[1]."".$text_line[2]."".$text_line[3];
	}elseif ($length==5) {
		# code...
		$sewa=$text_line[0]."".$text_line[1]."".$text_line[2]."".$text_line[3]."".$text_line[4];
	}

	$text_line = explode(".",$_POST['event']);
	$length=count($text_line);
	if ($length==1) {
		$event=$text_line[0];
		# code...
	}elseif ($length==2) {
		$event=$text_line[0]."".$text_line[1];
		# code...
	}elseif ($length==3) {
		# code...
		$event=$text_line[0]."".$text_line[1]."".$text_line[2];
	}elseif ($length==4) {
		# code...
		$event=$text_line[0]."".$text_line[1]."".$text_line[2]."".$text_line[3];
	}elseif ($length==5) {
		# code...
		$event=$text_line[0]."".$text_line[1]."".$text_line[2]."".$text_line[3]."".$text_line[4];
	}

	$text_line = explode(".",$_POST['bonus']);
	$length=count($text_line);
	if ($length==1) {
		$bonus=$text_line[0];
		# code...
	}elseif ($length==2) {
		$bonus=$text_line[0]."".$text_line[1];
		# code...
	}elseif ($length==3) {
		# code...
		$bonus=$text_line[0]."".$text_line[1]."".$text_line[2];
	}elseif ($length==4) {
		# code...
		$bonus=$text_line[0]."".$text_line[1]."".$text_line[2]."".$text_line[3];
	}elseif ($length==5) {
		# code...
		$bonus=$text_line[0]."".$text_line[1]."".$text_line[2]."".$text_line[3]."".$text_line[4];
	}

	$text_line = explode(".",$_POST['lain']);
	$length=count($text_line);
	if ($length==1) {
		$lain=$text_line[0];
		# code...
	}elseif ($length==2) {
		$lain=$text_line[0]."".$text_line[1];
		# code...
	}elseif ($length==3) {
		# code...
		$lain=$text_line[0]."".$text_line[1]."".$text_line[2];
	}elseif ($length==4) {
		# code...
		$lain=$text_line[0]."".$text_line[1]."".$text_line[2]."".$text_line[3];
	}elseif ($length==5) {
		# code...
		$lain=$text_line[0]."".$text_line[1]."".$text_line[2]."".$text_line[3]."".$text_line[4];
	}

	$gambar=$_FILES['gambar']['name'];
	if(strlen($gambar)>0){
		if(is_uploaded_file($_FILES['gambar']['tmp_name'])){
			move_uploaded_file($_FILES['gambar']['tmp_name'],"../".$gambar);
		}
	}

	$a="UPDATE options set options_gaji='$gaji',options_promo='$promo',options_sewa='$sewa',options_bonus='$bonus',options_lain='$lain', options_event='$event',options_telepon='$telepon',options_alamat='$alamat',options_logo='$gambar' where options_id='$id'";
	$b=mysql_query($a);
	
	echo mysql_error();
	if($b){
	   echo ("<script>location.href='../home.php?menu=setting&id=0'</script>");
		
	}else{
		echo "<script type='text/javascript'>
		onload =function(){
		alert('Data gagal disimpan');
		}
		</script>";
	}
}




