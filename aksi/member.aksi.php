<?php
include "../include/koneksi.php";
	

	if(isset($_POST['addmember'])){

		$id=$_POST['idmember'];
		$nama=$_POST['nama'];
		$alamat=$_POST['alamat'];
		$tanggal=$_POST['tanggal'];
		$nohp=$_POST['nohp'];
		$gender=$_POST['gender'];
		

		$a="INSERT into member(member_id,member_nama,member_alamat,member_tgl_lahir,member_hp,member_gender)values('$id','$nama','$alamat','$tanggal','$nohp','$gender')";
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
	} elseif (isset($_POST['editmember'])) {
		# code...
		$id=$_POST['id'];
		$nama=$_POST['nama'];
		$alamat=$_POST['alamat'];
		$tanggal=$_POST['tanggal'];
		$nohp=$_POST['nohp'];
		$gender=$_POST['gender'];

		$a="UPDATE member set member_nama='$nama',member_alamat='$alamat',member_tgl_lahir='$tanggal', member_hp='$nohp', member_gender='$gender' where member_id='$id'";
		$b=mysql_query($a);
		
		if($b){
		    echo ("<script>location.href='../home.php?menu=member&id=0'</script>");
			
		}else{
			echo "<script type='text/javascript'>
			onload =function(){
			alert('Data gagal disimpan');
			}
			</script>";
		}
	}




