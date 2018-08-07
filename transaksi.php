<?php include "headertransaksi.php"; ?>  
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper transaksi">
<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    Transaksi
    <small><?php echo $tgl ; ?></small>
  </h1>
</section>

<!-- Main content -->
<section class="content">
  <div class="row">
	<div class="col-md-7 col-md-offset-0">
		<?php include "kontenttransaksi.php" ; ?>
	</div>
    <div class="col-md-5 col-md-offset-0">
        <div class="box box-success">
        	<?php
        	$sql="SELECT * from member_temp";
			$result=mysql_query($sql);
			$data1=mysql_fetch_array($result);
			$id = $data1['member_id'];
			$count=mysql_num_rows($result);

			if($count!=0)
			{

			$sql="SELECT * from member where member_id = '$id' ";
			$result=mysql_query($sql);
			$data=mysql_fetch_array($result);
			?>
            <div class="box-header with-border">
                <h3 class="box-title">Member</h3>
                <a href="aksi/transaksi.baru.php" class="btn btn-danger pull-right">Transaksi Baru</a>
            </div>

			<div class="col-md-6 col-md-offset-0">

		            <h4>Nama : <?php echo $data['member_nama'];?></h4>

            </div>
            <div class="col-md-6 col-md-offset-0">

		            <h4>Alamat : <?php echo $data['member_alamat'];?></h4>

            </div>
            <div class="clear"></div>
            <hr>
            <?php
        	}
            ?>
            <div class="box-header with-border">
                <h3 class="box-title">List Transaksi</h3>
            </div>
            <div class="box-body">
                <table id="listbarang" class="table table-bordered table-striped">
                    <thead>
                    <tr>
                      <th>Nama</th>
                      <th>Harga</th>
                      <th width="50px" style="padding-right: 8px; ">Jumlah</th>
                      <th>Total</th>
                      <th width="60px"></th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    	$user = $_SESSION['login_user'];
	                	$sqlte1="SELECT * from transaksi_temp, barang, subcategory, category where transaksi_temp_barang_id=barang_id and barang_subcategory=subcategory_id and subcategory_parent=category_id and transaksi_temp_user_id='$user' ORDER BY transaksi_temp_id ASC";
						$queryte1=mysql_query($sqlte1);
						while ($datatea=mysql_fetch_array($queryte1)) {
							$jumlah = $datatea["transaksi_temp_jumlah"];
							$harga = $datatea["barang_harga_jual"];
							if ($datatea["transaksi_temp_keterangan"]=='') {
								# code...
								$ket="";
							} else {
								# code...
								$ket=" - ".$datatea["transaksi_temp_keterangan"];
							}
							
						?>
							<tr>
								<td><?php echo $datatea["category_nama"]." ".$datatea["subcategory_nama"]." ".$datatea["barang_nama"]." size ".$datatea["barang_size"]."".$ket; ?></td>
								<td>Rp. <?php echo format_rupiah($harga); ?></td>
								<td><?php echo $jumlah; ?></td>
								<td>Rp. <?php echo format_rupiah($jumlah*$harga); ?></td>
								<td>
									<a href="transaksi.php?menu=editjumlah&id=<?php echo $datatea["transaksi_temp_id"]; ?>" class="btn btn-warning"><i class='fa fa-edit'></i></a>
									<a href="aksi/hapus.php?menu=transaksi&id=<?php echo $datatea["transaksi_temp_id"]; ?>" class="btn btn-danger"><i class='fa fa-trash'></i></a>
								</td>
							</tr>
						<?php
							if ($datatea["transaksi_temp_diskon"]!=0) {
							?>
								<tr style="font-weight: 700;">
									<td>Diskon</td>
									<td></td>
									<td></td>
									<td>Rp. <?php echo format_rupiah($datatea["transaksi_temp_diskon"]); ?></td>
									<td></td>
								</tr>


							<?php
							}
						}

						$user = $_SESSION['login_user'];
						$sql="SELECT SUM(transaksi_temp_subtotal) AS subtotal, SUM(transaksi_temp_diskon) AS diskon FROM transaksi_temp where transaksi_temp_user_id='$user' ";
						$result=mysql_query($sql);
						$data=mysql_fetch_array($result);
						$diskon = $data['diskon'];
						$total = $data['subtotal'] - $diskon;
						$total1 = $data['subtotal'];
	                ?>
                    </tbody>
                </table>
                <hr>

                <h4>Total : </h4>
                <h2 class="text-red">Rp. <?php echo format_rupiah($total); ?></h2>

                <hr>
                
                <h4>Kembalian : </h4>
                <h2 class="text-red">Rp. <?php echo format_rupiah($_SESSION['kembalian']); ?></h2>
                

                <br>
                <form action="aksi/transaksi.aksi.php" method="post">
				    <input type="hidden" name="subtotal" class="form-control" value="<?php echo $total1; ?>">
				    <input type="hidden" name="diskon" class="form-control" value="<?php echo $diskon; ?>">
					<div class="form-group">
				    	<select class="form-control" name="status">
							<option value="0">Cash</option>
							<option value="1">Debet</option>
						</select>
				    </div>
					<div class="form-group">
				    	<select class="form-control" name="status_jual">
							<option value="offline">Offline</option>
							<option value="online">Online</option>
							<option value="reseller">Reseller</option>
						</select>
				    </div>
					<div class="form-group">
						<label>Keterangan</label>
					    <textarea name="keterangan" class="form-control" ></textarea>
					</div>
					<div class="form-group">
						<label>Pembayaran</label>
					    <input type="text" name="bayar" class="form-control" id="price">
					</div>
					<div class="form-group">
					    <input type="submit" class="btn btn-success pull-right btn-lg" value="Bayar" name="bayarsekarang">
					</div>
				</form>
            </div>
        </div>
    </div>
  </div>
  <!-- /.row -->
</section>
<!-- /.content -->
</div>  
<?php include "footertransaksi.php" ?>
