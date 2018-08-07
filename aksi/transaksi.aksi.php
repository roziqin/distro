<?php
session_start();
include "../include/koneksi.php";
date_default_timezone_set('Asia/jakarta');
$tgl=date('Y-m-j');
$bulan=date('Y-m');
$wkt=date('G:i:s');

	if(isset($_POST['proses'])){
		$_SESSION['kembalian'] = 0;
		$jumlah=$_POST['jumlah'];
		$ket = $_POST['ket'];
		if ($ket=='variable') {
			# code...
			$id = $_POST['id_barang'];
		} else {
			# code...
			$id = $_POST['id'];
		}
		
		$d=$_POST['diskon'];
		$sql="SELECT * from barang where barang_id = '$id' ";
		$result=mysql_query($sql);
		$data=mysql_fetch_array($result);
		$id = $data['barang_id'];
		$jual = $data['barang_harga_jual'];

		if ($d==0||$d=='') {
			# code...
			$diskon = $jumlah*($jual*$data['barang_diskon']/100);
		}else {
			if ($_POST["ket_diskon"]=="tunai") {
				# code...
				$diskon = $jumlah*$d;
			} else {
				# code...
				$diskon = $jumlah*($jual*$d/100);
			}
			
		}
		$keterangan = $_POST["keterangan"];
		$beli = $data['barang_harga_beli'];
		$harga = $jual*$jumlah;
		$user = $_SESSION['login_user'];
		$koadmin=0;
		$kobo=0;
		$kodokter=0;
	
		$sqlquery1=mysql_query("SELECT sum(transaksi_temp_jumlah) as jumlah from transaksi_temp where transaksi_temp_barang_id=$id");
		$sqldata1=mysql_fetch_array($sqlquery1);

		$selisih = $data['barang_stok'] - $jumlah - $sqldata1['jumlah'];

		if ($selisih<0 && $jenis!='treatment') {
			# code...

		    echo ("<script>location.href='../transaksi.php?menu=stokkurang'</script>");
		} else {
			# code...
			$a="INSERT into transaksi_temp(transaksi_temp_no_nota,transaksi_temp_barang_id,transaksi_temp_harga_beli,transaksi_temp_harga_jual,transaksi_temp_jumlah,transaksi_temp_subtotal,transaksi_temp_user_id,transaksi_temp_diskon,transaksi_temp_keterangan)values('0','$id','$beli','$jual','$jumlah','$harga','$user','$diskon','$keterangan')";
			$b=mysql_query($a);
			echo mysql_error();
			if($b){
			    echo ("<script>location.href='../transaksi.php?menu=home'</script>");
			}else{
			echo "<script type='text/javascript'>
				onload =function(){
				alert('Data gagal disimpan');
				}
				</script>";
			}
		}
		
		
	} elseif (isset($_POST['member'])) {
		# code...
		$_SESSION['kembalian'] = 0;
		$_SESSION['print'] = 'tidak';

		$member = $_POST['member_id'];
		if ($member==0) {
			# code...

		    	echo ("<script>location.href='../transaksi.php?menu=home'</script>");
		} else {
			# code...

			$user = $_SESSION['login_user'];
			$a="INSERT into member_temp(member_id,user_id)values('$member','$user')";
			$b=mysql_query($a);
		    	echo ("<script>location.href='../transaksi.php?menu=home'</script>");
			
		}
		
		
		
	} elseif (isset($_POST['editjumlah'])){
		$jumlah=$_POST['jumlah']; 
		$id = $_POST['id'];


		$sql="SELECT * from transaksi_temp where transaksi_temp_id = '$id' ";
		$result=mysql_query($sql);
		$data=mysql_fetch_array($result);
		$jual = $data['transaksi_temp_harga_jual'];
		$total = $jumlah*$jual;

		$a="UPDATE transaksi_temp set transaksi_temp_jumlah='$jumlah', transaksi_temp_subtotal='$total' where transaksi_temp_id='$id'";
		$b=mysql_query($a);
		if($b){
		    echo ("<script>location.href='../transaksi.php?menu=home'</script>");
		}else{
		echo "<script type='text/javascript'>
			onload =function(){
			alert('Data gagal disimpan');
			}
			</script>";
		}
	} elseif (isset($_POST['bayarsekarang'])){

		
		$user = $_SESSION['login_user'];
		$text_line = explode(".",$_POST['bayar']);
		$length=count($text_line);
		if ($length==1) {
			$bayar=$text_line[0];
			# code...
		}elseif ($length==2) {
			$bayar=$text_line[0]."".$text_line[1];
			# code...
		}elseif ($length==3) {
			# code...
			$bayar=$text_line[0]."".$text_line[1]."".$text_line[2];
		}elseif ($length==4) {
			# code...
			$bayar=$text_line[0]."".$text_line[1]."".$text_line[2]."".$text_line[3];
		}elseif ($length==5) {
			# code...
			$bayar=$text_line[0]."".$text_line[1]."".$text_line[2]."".$text_line[3]."".$text_line[4];
		}

		$diskon=$_POST['diskon'];
		$subtotal=$_POST['subtotal'];
		$status=$_POST['status'];
		$statusjual=$_POST['status_jual'];
		$kembalian = $bayar - ($subtotal - $diskon);
		$kettransaksi = $_POST['keterangan'];

		if ($kembalian < 0) {
			# code...
		    echo ("<script>location.href='../transaksi.php?menu=kurang'</script>");
		} else {
			# code...
			$sqlte1="SELECT * from member_temp where user_id='$user'";
			$queryte1=mysql_query($sqlte1);
	    	$data=mysql_fetch_array($queryte1);
	    	$member = $data['member_id'];


			$sql = "INSERT INTO transaksi (transaksi_tanggal,transaksi_bulan,transaksi_waktu,transaksi_member,transaksi_total,transaksi_bayar,transaksi_diskon,transaksi_user,transaksi_status,transaksi_status_jual,transaksi_keterangan) VALUES ('$tgl','$bulan','$wkt','$member','$subtotal','$bayar','$diskon','$user','$status','$statusjual','$kettransaksi')" ;
			mysql_query($sql);
			echo mysql_error();
			
	        $qn= "SELECT MAX( transaksi_id ) AS nota FROM transaksi where transaksi_user='$user'";
	        $rn=mysql_query($qn);
	        $dn=mysql_fetch_array($rn);
	        $no_not = $dn['nota'];
	        $_SESSION['no-nota'] = $no_not;

	        $sql="SELECT * from transaksi_temp where transaksi_temp_user_id='$user'";
	        $query=mysql_query($sql);
	        while ($data1=mysql_fetch_array($query)) {

	        	$barang = $data1['transaksi_temp_barang_id'];
	        	$beli = $data1['transaksi_temp_harga_beli'];
	        	$jual = $data1['transaksi_temp_harga_jual'];
	        	$jumlah = $data1['transaksi_temp_jumlah'];
	        	$subtotal = $data1['transaksi_temp_subtotal'];	        	$user = $data1['transaksi_temp_user_id'];
	        	$diskon = $data1['transaksi_temp_diskon'];
	        	$keterangan = $data1['transaksi_temp_keterangan'];

	        	$sql="SELECT * from barang where barang_id = '$barang' ";
				$result=mysql_query($sql);
				$data=mysql_fetch_array($result);
				

	        	$a="INSERT into transaksi_detail(transaksi_detail_no_nota,transaksi_detail_barang_id,transaksi_detail_harga_beli,transaksi_detail_harga_jual,transaksi_detail_jumlah,transaksi_detail_subtotal,transaksi_detail_user_id,transaksi_detail_diskon,transaksi_detail_keterangan)values('$no_not','$barang','$beli','$jual','$jumlah','$subtotal','$user','$diskon','$keterangan')";
				$b=mysql_query($a);
				echo mysql_error();

				//Select Stok Barang
				$sqlkem11="SELECT barang_stok from barang where barang_id='$barang'";
		        $querykem11=mysql_query($sqlkem11);
		        $datakem11=mysql_fetch_array($querykem11);
		        	# code...
	        	$jml_stok = $datakem11['barang_stok'] - $jumlah;
	        	
		        mysql_query("UPDATE barang SET barang_stok='$jml_stok' WHERE barang_id='$barang'");


				
	        }
	        $_SESSION['kembalian'] = $kembalian;
	        $_SESSION['print'] = 'ya';

			mysql_query("DELETE from transaksi_temp where transaksi_temp_user_id='$user'");
			mysql_query("DELETE from member_temp where user_id='$user'");

			echo ("<script>location.href='../transaksi.php?menu=home&kem=$kembalian'</script>");

	        /*
			$a="INSERT into transaksi_temp(transaksi_temp_no_nota,transaksi_temp_barang_id,transaksi_temp_harga_beli,transaksi_temp_harga_jual,transaksi_temp_jumlah,transaksi_temp_subtotal,transaksi_temp_keterangan,transaksi_temp_user_id)values('0','$id','$beli','$jual','$jumlah','$harga','','$user')";
			$b=mysql_query($a);
			echo mysql_error();
			if($b){
				header('location:../transaksi.php?menu=home');
			}else{
			echo "<script type='text/javascript'>
				onload =function(){
				alert('Data gagal disimpan');
				}
				</script>";
			}
			*/
		}
		
		
	} elseif (isset($_POST['ceknota'])) {
		# code...

		$nota = $_POST['nota'];
		
    	echo ("<script>location.href='../transaksi.php?menu=nota&id=$nota'</script>");
		
	} else {

	}



