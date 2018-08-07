<?php
	date_default_timezone_set('Asia/jakarta');
	$tgl=date('j - m - Y');
if ($_GET['menu']=='home') {
	$sql="SELECT * from member_temp";
	$result=mysql_query($sql);
	$count=mysql_num_rows($result);

	if($count==0)
	{
	?>
        <div class="box box-success">
            <div class="box-header with-border">
                <h3 class="box-title">Member</h3>
				<a href="?menu=addmember" class="btn btn-warning pull-right">Member baru</a>
            </div>
            <div class="box-body">
                <form action="aksi/transaksi.aksi.php" method="post">
	              	<div class="form-group">
		                <select class="form-control select2" name="member_id" style="width: 100%;">
		                	<?php
		                	$sqlte1="SELECT * from member ";
							$queryte1=mysql_query($sqlte1);
							while ($datatea=mysql_fetch_array($queryte1)) {
							?>
								<option value="<?php echo $datatea["member_id"]; ?>"><?php echo $datatea["member_id"]; ?> - <?php echo $datatea["member_nama"]; ?> - <?php echo $datatea["member_alamat"]; ?> - <?php echo $datatea["member_tgl_lahir"]; ?></option>
							<?php
							}
							?>
		                </select>
	                </div>
					<div class="clear"></div>
					<br>

					<div class="form-group">
					    <input type="submit" class="btn btn-primary pull-right" value="Input" name="member">
					</div>
				</form>
            </div>
        </div>
    <?php
	} else {
    ?>
        <div class="box box-success">
            <div class="box-body">
                <div role="tabpanel">
                    <!-- Nav tabs -->
                    <ul class="nav nav-tabs" role="tablist">
                    	<?php
                    		$idcat = '';
                    		$no = 1;
                    		$i = 0;
	                    	$sql="SELECT * from category ORDER BY category_id ";
							$query=mysql_query($sql);
							while ($data=mysql_fetch_array($query)) {
								$idcat[$i] = $data['category_id'];
								if ($no==1) {
									# code...
									$active = "active";
								} else {
									$active = "";
								}
								echo '<li role="presentation" class="'.$active.'"><a href="#tab'.$no.'" aria-controls="tab'.$no.'" role="tab" data-toggle="tab">'.$data['category_nama'].'</a></li>';
								$no++;
								$i++;
							echo mysql_error();
							}
							echo mysql_error();
                    	?>
                    </ul>

                    <!-- Tab panes -->
                    <div class="tab-content">
                    	<?php
                    		$no = 1;
                    		for ($i=0; $i < count($idcat); $i++) { 
                    			if ($i==0) {
									# code...
									$active = "active";
								} else {
									$active = "";
								}
	                    		?>
	                    			<div role="tabpanel" class="tab-pane <?php echo $active; ?>" id="tab<?php echo $no; ?>">
			                            
			                            <div role="tabpanel">
						                    <!-- Nav tabs -->
						                    <ul class="nav nav-tabs sub-tabs" role="tablist">
						                    	<?php
						                    		$idcati = '';
						                    		$noi = 1;
						                    		$ii = 0;
							                    	$sqli="SELECT * from subcategory where subcategory_parent='$idcat[$i]' ORDER BY subcategory_id ";
													$queryi=mysql_query($sqli);
													while ($datai=mysql_fetch_array($queryi)) {
														$idcati[$ii] = $datai['subcategory_id'];
														if ($noi==1) {
															# code...
															$activei = "active";
														} else {
															$activei = "";
														}
														echo '<li role="presentation" class="'.$activei.'"><a href="#subtab'.$datai['subcategory_id'].'" aria-controls="tab'.$datai['subcategory_id'].'" role="tab" data-toggle="tab">'.$datai['subcategory_nama'].'</a></li>';
														$noi++;
														$ii++;
													echo mysql_error();
													}
													echo mysql_error();
						                    	?>
						                    </ul>

						                    <!-- Tab panes -->
						                    <div class="tab-content">
						                    	<?php
						                    		$noi = 1;
						                    		for ($ii=0; $ii < count($idcati); $ii++) { 
						                    			//echo $idcati[$ii];
						                    			if ($ii==0) {
															# code...
															$activei = "active";
														} else {
															$activei = "";
														}
							                    		?>
							                    			<div role="tabpanel" class="tab-pane <?php echo $activei; ?>" id="subtab<?php echo $idcati[$ii]; ?>">
									                            <br>
									                            <table id="example<?php echo $idcati[$ii]; ?>" class="table table-bordered table-striped">
									                                <thead>
									                                <tr>
									                                  <th width="100px">Barcode</th>
									                                  <th>Nama Barang</th>
									                                  <th width="100px">Harga Jual</th>
									                                  <th width="80px">Actions</th>
									                                </tr>
									                                </thead>
									                                <tbody>
									                                <?php
													                	$sqlte1="SELECT * from barang where barang_subcategory='$idcati[$ii]' GROUP by barang_nama ";
																		$queryte1=mysql_query($sqlte1);
																		while ($datatea=mysql_fetch_array($queryte1)) {
																		
																			?>
																				<tr>
																					<td><?php echo $datatea["barang_barcode"]; ?></td>
																					<td><?php echo $datatea["barang_nama"]; ?></td>
																					<td>Rp. <?php echo format_rupiah($datatea["barang_harga_jual"]); ?></td>
																					<td>
																						<a href="transaksi.php?menu=jumlah&nama=<?php echo $datatea["barang_nama"]; ?>&ket=<?php echo $datatea["barang_type"]; ?>&id=<?php echo $datatea["barang_id"]; ?>" class="btn btn-primary">Pilih</a>
																					</td>
																				</tr>
																			<?php
																		
																			
																		}

													                ?>
									                                </tbody>
									                            </table>
									                        </div>
							                    		<?php
							                    		$noi++;
						                    		}
						                    	?>
						                    </div>
						                </div>
			                        </div>
	                    		<?php
	                    		$no++;
                    		}
                    	?>
                    </div>
                </div>
            </div>
        </div>
	<?php
	}
	if ($_SESSION['print']=='ya') {
		# code...
	?>

        <script type="text/javascript">
         windowList = new Array('print/print-nota.php');
        i = 0;
        windowName = "window";
        windowInterval = window.setInterval(function(){
          window.open(windowList[i],windowName+i,'toolbar=0,scrollbars=1,location=0,statusbar=0,menubar=0,resizable=0,titlebar=no');
          i++;
          if(i==windowList.length){
            window.clearInterval(windowInterval);
          }
        },1000);
        </script>
	<?php
	} 
	

}
elseif ($_GET['menu']=='jumlah') {
	$_SESSION['print'] = 'tidak';
?>
	<div class="box box-success">
        <div class="box-header with-border">
            <h3 class="box-title">Masukkan Jumlah Barang</h3>
        </div>
        <div class="box-body">
    		<div class="col-md-8 col-md-offset-0" style="padding: 0px;">
		        <form action="aksi/transaksi.aksi.php" method="post">
			      	<input type="hidden" name="id" value="<?php echo $_GET['id'] ; ?>">
			      	<input type="hidden" name="ket" value="<?php echo $_GET['ket'] ; ?>">
			      	<?php

			      		if ($_GET['ket']=='variable') {
			      			echo'
			      				<div class="form-group">
									<label>Size</label>
				      				<select name="id_barang" class="form-control" id="category">
						                
			                ';
						    $sqlte1="SELECT * from barang where barang_nama='$_GET[nama]' ";
							$queryte1=mysql_query($sqlte1);
							while ($datatea=mysql_fetch_array($queryte1)) {

									echo '<option value="'.$datatea['barang_id'].'">'.$datatea['barang_size'].'</option>';
							}
						    echo '
						            </select>
					            </div>
			      			';
			      			# code...
			      		} else {
			      			# code...
			      		}
			      		
			      	?>
					<div class="form-group">
						<label>Jumlah</label>
					    <input type="text" name="jumlah" class="form-control" autofocus>
					</div>
					<div class="form-group">
			    		<div class="col-md-12 col-md-offset-0" style="padding: 0px;">
							<label>Diskon (%)</label>
						</div>
			    		<div class="col-md-6 col-md-offset-0" style="padding-left: 0px;">
		      				<select name="ket_diskon" class="form-control" id="category">
		      					<option value="tunai">Tunai</option>
		      					<option value="percent">Percent</option>
		      				</select>
			    		</div>
			    		<div class="col-md-6 col-md-offset-0" style="padding-right: 0px;">
						    <input type="text" name="diskon" class="form-control" >
						</div>
					</div>
					<div class="clear"></div>
					<br>
					<div class="form-group">
						<label>Keterangan</label>
					    <input type="text" name="keterangan" class="form-control">
					</div>
					<div class="form-group">
						<br>
					    <input type="submit" class="btn btn-primary" value="Proses" name="proses">
					    <a href="?menu=home" class="btn btn-danger pull-right">Kembali</a>
					</div>
				</form>

			</div>
    		<div class="col-md-4 col-md-offset-0" style="padding: 0px 0px 0px 20px;">
	    		<?php if ($_GET['ket']=='variable') { ?>
	    			<table width="100%" border="1">
	    				<tr>
	    					<th style="padding: 5px;">Size</th>
	    					<th style="padding: 5px;">Stok</th>
	    				</tr>
	    				<?php
	    				$sqlte1="SELECT * from barang where barang_nama='$_GET[nama]' ";
						$queryte1=mysql_query($sqlte1);
						while ($datatea=mysql_fetch_array($queryte1)) {

								echo '<tr><td  style="padding: 5px;">'.$datatea['barang_size'].'</td><td style="padding: 5px;">'.$datatea['barang_stok'].'</td></tr>';
						}

	    				?>
	    			</table>
    			<?php } else {?>
	    			<table width="100%" border="1">
	    				<tr>
	    					<th style="padding: 5px;">Stok</th>
	    				</tr>
	    				<?php
	    				$sqlte1="SELECT * from barang where barang_nama='$_GET[nama]' ";
						$queryte1=mysql_query($sqlte1);
						while ($datatea=mysql_fetch_array($queryte1)) {

								echo '<tr><td style="padding: 5px;">'.$datatea['barang_stok'].'</td></tr>';
						}

	    				?>
	    			</table>
    			<?php }?>
    		</div>
        </div>
    </div>
<?php
}
elseif ($_GET['menu']=='editjumlah') {
?>
	<div class="box box-success">
        <div class="box-header with-border">
            <h3 class="box-title">Masukkan Jumlah Barang</h3>
        </div>
        <div class="box-body">
        <form action="aksi/transaksi.aksi.php" method="post">
	      	<input type="hidden" name="id" value="<?php echo $_GET['id'] ; ?>">
			<div class="form-group">
				<label>Jumlah</label>
			    <input type="text" name="jumlah" class="form-control" autofocus>
			</div>
			<div class="form-group">
				
			    <input type="submit" class="btn btn-primary" value="Edit" name="editjumlah">
			</div>
		</form>
        </div>
    </div>
<?php

}elseif ($_GET['menu']=='kurang') {

?>
	<div class="box box-success">
        <div class="box-header with-border">
            <h3 class="box-title">Peringatan</h3>
        </div>
        <div class="box-body">
        	<h1 style="text-align:center;">Pembayaran Kurang</h1>
        </div>
    </div>
<?php

}elseif ($_GET['menu']=='stokkurang') {

?>
	<div class="box box-success">
        <div class="box-header with-border">
            <h3 class="box-title">Peringatan</h3>
        </div>
        <div class="box-body">
        	<h1 style="text-align:center;">Stok Kurang</h1>
			<div class="form-group">
				
			    <input type="submit" class="btn btn-primary" onclick='back()' value="Kembali">
			</div>
        </div>
    </div>
<?php
} elseif ($_GET['menu']=='addmember') {
?>
	<div class="box box-success">
        <div class="box-header with-border">
            <h3 class="box-title">Data Member</h3>
        </div>
        <div class="box-body">
        <form action="aksi/member.aksi.php" method="post">
        	<?php 

	        $qn= "SELECT MAX( member_id ) AS id FROM member";
	        $rn=mysql_query($qn);
	        $dn=mysql_fetch_array($rn);
        	?>
			<div class="form-group">

				<label>No Member :</label>
			    <input type="text" name="id" class="form-control" value="<?php echo $dn['id']+1;?>" disabled >
			    <input type="hidden" name="idmember" class="form-control" value="<?php echo $dn['id']+1;?>" >
			</div>
			<div class="form-group">
				<label>Nama</label>
			    <input type="text" name="nama" class="form-control" autofocus>
			</div>
			<div class="form-group">
				<label>Alamat</label>
			    <input type="text" name="alamat" class="form-control">
			</div>
			<div class="form-group">
				<label>Tanggal Lahir</label>
				<div class="input-group">
                  <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                  </div>
                  <input type="text" name="tanggal" class="form-control" data-inputmask="'alias': 'dd/mm/yyyy'" data-mask>
                </div>
			</div>
			<div class="form-group">
				<label>No. Hp</label>
			    <input type="text" name="nohp" class="form-control">
			</div>
			<div class="form-group">
				<label>Gender</label>
			    <select class="form-control" name="gender">
					<option value="0">Perempuan</option>
					<option value="1">Laki - Laki</option>
				</select>
			</div>
			<div class="form-group">
				
			    <input type="submit" class="btn btn-primary" value="Tambah" name="addmember">
			</div>
		</form>
        </div>
    </div>
<?php
}
elseif ($_GET['menu']=='ceknota') {
?>
	<div class="box box-success">
        <div class="box-header with-border">
            <h3 class="box-title">Cek Nota Transaksi</h3>
        </div>
        <div class="box-body">
	        <form action="aksi/transaksi.aksi.php" method="post">

				<div class="form-group">
					<label>Masukkan No. Nota</label>
				    <input type="text" name="nota" class="form-control">
				</div>
				<div class="form-group">
				    <input type="submit" class="btn btn-primary" value="Cek Nota" name="ceknota">
				</div>
	        </form>
        </div>
    </div>

<?php
}
elseif ($_GET['menu']=='nota') {
	$nonota = $_GET['id'];
	$_SESSION['no-nota'] = $nonota;
	$sqlte="SELECT * from transaksi, member where transaksi_member=member_id and transaksi_id='$nonota' ";
	$queryte=mysql_query($sqlte);
	$data=mysql_fetch_array($queryte);


	$diskon = $data['transaksi_diskon'];
	$total = $data['transaksi_total'] - $diskon;

	$sqladmin="SELECT * from users where id='$data[transaksi_admin]' ";
	$queryadmin=mysql_query($sqladmin);
	$dataadmin=mysql_fetch_array($queryadmin);
	$admin=$dataadmin['name'];

	$sqlbo="SELECT * from users where id='$data[transaksi_bo]' ";
	$querybo=mysql_query($sqlbo);
	$databo=mysql_fetch_array($querybo);
	$bo=$databo['name'];

	$sqldokter="SELECT * from users where id='$data[transaksi_dokter]' ";
	$querydokter=mysql_query($sqldokter);
	$datadokter=mysql_fetch_array($querydokter);
	$dokter=$datadokter['name'];

?>
	<div class="box box-success">
        <div class="box-header with-border">
            <h3 class="box-title">Cek Nota Transaksi : <?php echo $nonota; ?></h3>
        </div>
        <div class="box-body">
        	<div class="col-md-6 col-md-offset-0">

		            <h4>Nama : <?php echo $data['member_nama'];?></h4>

            </div>
            <div class="col-md-6 col-md-offset-0">

		            <h4>Alamat : <?php echo $data['member_alamat'];?></h4>

            </div>
            
            <table id="listbarang" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>Nama</th>
                  <th>Harga</th>
                  <th width="50px" style="padding-right: 8px; ">Jumlah</th>
                  <th>Total</th>
                </tr>
                </thead>
                <tbody>
                <?php
                	$nonota = $_GET['id'];
                	$sqlte1="SELECT * from transaksi_detail, barang, subcategory, category where transaksi_detail_barang_id=barang_id and barang_subcategory=subcategory_id and subcategory_parent=category_id and transaksi_detail_no_nota='$nonota' ORDER BY transaksi_detail_id ASC";
					$queryte1=mysql_query($sqlte1);
					while ($datatea=mysql_fetch_array($queryte1)) {
						$jumlah = $datatea["transaksi_detail_jumlah"];
						$harga = $datatea["barang_harga_jual"];
					?>
						<tr>
							<td><?php echo $datatea["category_nama"]." ".$datatea["subcategory_nama"]." ".$datatea["barang_nama"]." size ".$datatea["barang_size"]; ?></td>
							<td>Rp. <?php echo format_rupiah($harga); ?></td>
							<td><?php echo $jumlah; ?></td>
							<td>Rp. <?php echo format_rupiah($jumlah*$harga); ?></td>
							
						</tr>
					<?php
						if ($datatea["transaksi_detail_diskon"]!=0) {
						?>
							<tr style="font-weight: 700;">
								<td>Diskon</td>
								<td></td>
								<td></td>
								<td>Rp. <?php echo format_rupiah($datatea["transaksi_detail_diskon"]); ?></td>
								<td></td>
							</tr>


						<?php
						}
					}
					/*
					$user = $_SESSION['login_user'];
					$sql="SELECT SUM(transaksi_temp_subtotal) AS subtotal, SUM(transaksi_temp_diskon) AS diskon FROM transaksi_temp where transaksi_temp_user_id='$user' ";
					$result=mysql_query($sql);
					$data=mysql_fetch_array($result);
					$diskon = $data['diskon'];
					$total = $data['subtotal'] - $diskon;
					$total1 = $data['subtotal'];*/
                ?>
                </tbody>
            </table>
            <hr>

            <h4>Total : </h4>
            <h2 class="text-red">Rp. <?php echo format_rupiah($total); ?></h2>

            <hr>
            
			<div class="form-group">
			    <a href="?menu=home" class="btn btn-success btn-lg" target="_blank">Kembali</a>
			    <a href="print/print-nota.php" class="btn btn-primary pull-right btn-lg" target="_blank">Print Ulang</a>
			</div>
            
        </div>
    </div>

<?php
}

?>