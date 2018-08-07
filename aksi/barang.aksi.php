<?php
session_start();
include "../include/koneksi.php";
	$nama=$_POST['nama'];
	$stok=$_POST['stok'];
	$batasstok=$_POST['batasstok'];
	$diskon=$_POST['diskon'];


	$barcode=$_POST['barcode'];
	$subcategory=$_POST['subcategory'];
	$type=$_POST['type'];
	date_default_timezone_set('Asia/jakarta');
	$tgl=date('Y-m-j');
	$wkt=date('G:i:s');
	$wkt1=date('h:i:sa');
	$tgl2= $tgl." ".$wkt1;


	$variable=$_POST['variable'];
	if ($variable=="angka") {
		# code...
		$size=$_POST["angka"];
	} elseif ($variable=="huruf") {
		# code...
		$size=$_POST["huruf"];
	} else {
		# code...
		$size="";
	}
	




	$text_line = explode(".",$_POST['hargabeli']);
	$length=count($text_line);
	if ($length==1) {
		$hargabeli=$text_line[0];
		# code...
	}elseif ($length==2) {
		$hargabeli=$text_line[0]."".$text_line[1];
		# code...
	}elseif ($length==3) {
		# code...
		$hargabeli=$text_line[0]."".$text_line[1]."".$text_line[2];
	}elseif ($length==4) {
		# code...
		$hargabeli=$text_line[0]."".$text_line[1]."".$text_line[2]."".$text_line[3];
	}elseif ($length==5) {
		# code...
		$hargabeli=$text_line[0]."".$text_line[1]."".$text_line[2]."".$text_line[3]."".$text_line[4];
	}

	$text_line = explode(".",$_POST['hargajual']);
	$length=count($text_line);
	if ($length==1) {
		$hargajual=$text_line[0];
		# code...
	}elseif ($length==2) {
		$hargajual=$text_line[0]."".$text_line[1];
		# code...
	}elseif ($length==3) {
		# code...
		$hargajual=$text_line[0]."".$text_line[1]."".$text_line[2];
	}elseif ($length==4) {
		# code...
		$hargajual=$text_line[0]."".$text_line[1]."".$text_line[2]."".$text_line[3];
	}elseif ($length==5) {
		# code...
		$hargajual=$text_line[0]."".$text_line[1]."".$text_line[2]."".$text_line[3]."".$text_line[4];
	}

	

	if(isset($_POST['tambah'])){
		
		$ket=$_POST['keterangan'];
				
		$a="INSERT into barang(barang_barcode,barang_nama,barang_subcategory,barang_harga_beli,barang_harga_jual,barang_stok,barang_type,barang_variable,barang_size,barang_diskon,barang_batas_stok,barang_keterangan)values('$barcode','$nama','$subcategory','$hargabeli','$hargajual','$stok','$type','$variable','$size','$diskon','$batasstok','$ket')";
		$b=mysql_query($a);
		echo mysql_error();
		if($b){

	        echo ("<script>location.href='../home.php?menu=addbarang'</script>");
		}else{
		echo "<script type='text/javascript'>
			onload =function(){
			alert('Data gagal disimpan');
			}
			</script>";
		}

	} elseif (isset($_POST['edit'])) {
		# code...
		
		$id = $_POST['id'];
		$user = $_SESSION['login_user'];
		$ket=$_POST['keterangan'];

		$sqlte1="SELECT * from barang where barang_id='$id'";
		$queryte1=mysql_query($sqlte1);
		$datatea=mysql_fetch_array($queryte1);
		$beliawal = $datatea['barang_harga_beli'];
		$jualawal = $datatea['barang_harga_jual'];

		
		$a="UPDATE barang set barang_barcode='$barcode',barang_nama='$nama',barang_subcategory='$subcategory',barang_harga_beli='$hargabeli',barang_harga_jual='$hargajual', barang_type='$type', barang_stok='$stok', barang_variable='$variable', barang_size='$size', barang_diskon='$diskon', barang_batas_stok='$batasstok', barang_keterangan='$ket' where barang_id='$id'";
		$b=mysql_query($a);
		echo mysql_error();

		$sql = "INSERT into log_harga(barang_id,harga_beli_awal,harga_beli_baru,harga_jual_awal,harga_jual_baru,user,tanggal)values('$id','$beliawal','$hargabeli','$jualawal','$hargajual','$user','$tgl2')";
		$c=mysql_query($sql);
		if($c){

		}else{
		echo "<script type='text/javascript'>
			onload =function(){
			alert('Data gagal diubah!');
			}
			</script>";
		}
		echo mysql_error();
		if($b){
			echo ("<script>location.href='../home.php?menu=listbarang'</script>");
		}else{
		echo "<script type='text/javascript'>
			onload =function(){
			alert('Data gagal diubah!');
			}
			</script>";
		}

	} elseif (isset($_POST['editharga'])) {
		# code...
		$text_line = explode(".",$_POST['harga']);
		$length=count($text_line);
		if ($length==1) {
			$hargajual=$text_line[0];
			# code...
		}elseif ($length==2) {
			$hargajual=$text_line[0]."".$text_line[1];
			# code...
		}elseif ($length==3) {
			# code...
			$hargajual=$text_line[0]."".$text_line[1]."".$text_line[2];
		}elseif ($length==4) {
			# code...
			$hargajual=$text_line[0]."".$text_line[1]."".$text_line[2]."".$text_line[3];
		}elseif ($length==5) {
			# code...
			$hargajual=$text_line[0]."".$text_line[1]."".$text_line[2]."".$text_line[3]."".$text_line[4];
		}

		$id = $_POST['id'];
		$diskon = $_POST['diskon'];
		$user = $_SESSION['login_user'];


		$sqlte1="SELECT * from barang where barang_id='$id'";
		$queryte1=mysql_query($sqlte1);
		$datatea=mysql_fetch_array($queryte1);
		$beliawal = $datatea['barang_harga_beli'];
		$jualawal = $datatea['barang_harga_jual'];
		$jenis = $datatea['barang_jenis'];

		if ($jenis=="obat") {
			# code...
			$komisidokter = $hargajual*0.03;
			$komisibo = $hargajual*0.01;
			
			$a="UPDATE barang set barang_harga_jual='$hargajual', barang_komisi='$komisibo', barang_komisi_dokter='$komisidokter', barang_diskon='$diskon' where barang_id='$id'";

		} else {

			$a="UPDATE barang set barang_harga_jual='$hargajual',barang_diskon='$diskon' where barang_id='$id'";
		}
		
		$b=mysql_query($a);
		echo mysql_error();

		$sql = "INSERT into log_harga(barang_id,harga_beli_awal,harga_beli_baru,harga_jual_awal,harga_jual_baru,user,tanggal)values('$id','0','0','$jualawal','$hargajual','$user','$tgl2')";
		$c=mysql_query($sql);
		if($c){

		}else{
		echo "<script type='text/javascript'>
			onload =function(){
			alert('Data gagal diubah!');
			}
			</script>";
		}
		echo mysql_error();
		if($b){
			if ($jenis == 'obat') {
				# code...

		        echo ("<script>location.href='../home.php?menu=lihatobat'</script>");
			} else {
				# code...

		        echo ("<script>location.href='../home.php?menu=lihattreatment'</script>");
			}
			
		}else{
		echo "<script type='text/javascript'>
			onload =function(){
			alert('Data gagal diubah!');
			}
			</script>";
		}

	} elseif (isset($_POST['rusak'])) {
		# code...
		
		$id=$_POST['id'];
		$ket=$_POST['keterangan'];

		$sqlte1="SELECT * from barang where barang_id='$id'";
		$queryte1=mysql_query($sqlte1);
		$datatea=mysql_fetch_array($queryte1);
		$stok_barang = $datatea['barang_stok'] - $stok;
		$awal = $datatea['barang_stok'];
		$user = $_SESSION['login_user'];
		$a="INSERT into log_stok(user,barang,stok_awal,stok_jumlah,tanggal,alasan)values('$user','$id','$awal','$stok','$tgl','$ket')";
		mysql_query($a);

		$a="UPDATE barang set barang_stok='$stok_barang' where barang_id='$id'";
		$b=mysql_query($a);
		echo mysql_error();
		if($b){

	        echo ("<script>location.href='../home.php?menu=stok&id=0'</script>");
			
		}else{
		echo "<script type='text/javascript'>
			onload =function(){
			alert('Data gagal diubah!');
			}
			</script>";
		}
	} elseif (isset($_POST['tambah_stok'])) {
		# code...
		
		$id=$_POST['id'];

		$sqlte1="SELECT * from barang where barang_id='$id'";
		$queryte1=mysql_query($sqlte1);
		$datatea=mysql_fetch_array($queryte1);
		$stok_barang = $datatea['barang_stok'] + $stok;
		$awal = $datatea['barang_stok'];
		$user = $_SESSION['login_user'];
		$a="INSERT into log_stok(user,barang,stok_awal,stok_jumlah,tanggal,alasan)values('$user','$id','$awal','$stok','$tgl','Tambah Stok')";
		mysql_query($a);

		$a="UPDATE barang set barang_stok='$stok_barang' where barang_id='$id'";
		$b=mysql_query($a);
		echo mysql_error();
		if($b){

	        echo ("<script>location.href='../home.php?menu=stok&id=0'</script>");
			
		}else{
		echo "<script type='text/javascript'>
			onload =function(){
			alert('Data gagal diubah!');
			}
			</script>";
		}

	} elseif(isset($_POST['tambahcategory'])){
		$nama=$_POST['nama'];
		$id=$_POST['id'];


		$a="INSERT into category(category_nama)values('$nama')";
		$b=mysql_query($a);
		echo mysql_error();
		
		if($b){
		    echo ("<script>location.href='../home.php?menu=category&id=0'</script>");
		}else{
		echo "<script type='text/javascript'>
			onload =function(){
			alert('Data gagal disimpan');
			}
			</script>";
		}

	} elseif(isset($_POST['editcategory'])){
		$nama=$_POST['nama'];
		$id=$_POST['id'];

		$a="UPDATE category set category_nama='$nama' where category_id='$id'";
		$b=mysql_query($a);
		echo mysql_error();
		
		if($b){
		    echo ("<script>location.href='../home.php?menu=category&id=0'</script>");
		}else{
		echo "<script type='text/javascript'>
			onload =function(){
			alert('Data gagal disimpan');
			}
			</script>";
		}
	} elseif(isset($_POST['tambahsubcategory'])){
		$nama=$_POST['nama'];
		$id=$_POST['id'];
		$category=$_POST['category'];


		$a="INSERT into subcategory(subcategory_nama,subcategory_parent)values('$nama','$category')";
		$b=mysql_query($a);
		echo mysql_error();
		
		if($b){
		    echo ("<script>location.href='../home.php?menu=subcategory&id=0'</script>");
		}else{
		echo "<script type='text/javascript'>
			onload =function(){
			alert('Data gagal disimpan');
			}
			</script>";
		}

	} elseif(isset($_POST['editsubcategory'])){
		$nama=$_POST['nama'];
		$id=$_POST['id'];
		$category=$_POST['category'];


		$a="UPDATE subcategory set subcategory_nama='$nama', subcategory_parent='$category' where subcategory_id='$id'";
		$b=mysql_query($a);
		echo mysql_error();
		
		if($b){
		    echo ("<script>location.href='../home.php?menu=subcategory&id=0'</script>");
		}else{
		echo "<script type='text/javascript'>
			onload =function(){
			alert('Data gagal disimpan');
			}
			</script>";
		}

	}




