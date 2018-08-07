<?php
include "../include/koneksi.php";
	
	date_default_timezone_set('Asia/jakarta');
	$tgl=date('Y-m-j');
	$wkt=date('G:i:s');
	$wkt1=date('h:i:sa');
	$tgl2= $tgl." ".$wkt1;

	if(isset($_POST['proses'])){
	$name=$_POST['name'];
	$id=$_POST['id'];
	$omset=$_POST['omset'];

	$text_line = explode(".",$_POST['jumlah']);
	$length=count($text_line);
	if ($length==1) {
		$jumlah=$text_line[0];
		# code...
	}elseif ($length==2) {
		$jumlah=$text_line[0]."".$text_line[1];
		# code...
	}elseif ($length==3) {
		# code...
		$jumlah=$text_line[0]."".$text_line[1]."".$text_line[2];
	}elseif ($length==4) {
		# code...
		$jumlah=$text_line[0]."".$text_line[1]."".$text_line[2]."".$text_line[3];
	}elseif ($length==5) {
		# code...
		$jumlah=$text_line[0]."".$text_line[1]."".$text_line[2]."".$text_line[3]."".$text_line[4];
	}

		$a="INSERT into validasi (validasi_tanggal,validasi_waktu,validasi_user_id,validasi_user_nama,validasi_jumlah,validasi_omset)values('$tgl','$wkt','$id','$name','$jumlah','$omset')";
		$b=mysql_query($a);
		echo mysql_error();
		if($b){
		    echo ("<script>location.href='../home.php?menu=omset&ket=1'</script>");
		}else{
		echo "<script type='text/javascript'>
			onload =function(){
			alert('Data gagal disimpan');
			}
			</script>";
		}
	}