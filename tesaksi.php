<?php
if(isset($_POST['tambah'])){
	$j = 1;
	$n=$_POST['variable-'.$j];
	echo $n;
	$j++;
	$nama=$_POST['variable-'.$j];
	echo $nama;
}


?>