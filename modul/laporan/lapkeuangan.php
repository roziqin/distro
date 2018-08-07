<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
    	Laporan
      </h1>
    </section>

    <!-- Main content -->
    <section class="content">

		<div class="container-fluid spark-screen">
	    	<div class="row">
	    		<div class="col-md-12 col-md-offset-0">
					<div class="box box-primary">
						<div class="box-header with-border">
							<h3 class="box-title">Keuangan / Omset</h3>
							
						</div>
						<!-- /.box-header -->
			            <div class="box-body">
			            <form action="aksi/laporan.aksi.php" method="post">
			              	<div class="form-group col-md-4 col-md-offset-0">
			              		<label>Filter Tanggal : </label>
			              		<div class="input-group">
				                  <div class="input-group-addon">
				                    <i class="fa fa-calendar"></i>
				                  </div>
				                  <input type="text" class="form-control pull-right" id="reservation" name="tanggal" value="<?php echo $_GET['tanggal'];?>">
				                </div>
			              	</div>
			              	<div class="form-group col-md-2 col-md-offset-0">
			              		<label> &nbsp;</label><br>
						    	<input type="submit" class="btn btn-primary" value="Proses" name="keuangan">
						    </div>
		              	</form>

		              	<div class="clear"></div>
		              	<br>
			              <table id="laporan" class="table table-bordered table-striped">
			                <thead>
			                <tr>
			                  <th>Tanggal</th>
			                  <th>Jumlah Transaksi</th>
			                  <th>Omset</th>
			                  <th>Diskon</th>
			                  <th>Debet</th>
			                  <th>Offline</th>
			                  <th>Online</th>
			                  <th>Reseller</th>
			                </tr>
			                </thead>
			                <tbody>
			                <?php

			                if ($_GET['tanggal']=='') {
			                	# code...
			                } else {
			                	$text_line = explode(":",$_GET['tanggal']);
								$tgl1=$text_line[0];
								$tgl2=$text_line[1];

			                	$query=mysql_query("SELECT transaksi_tanggal,count(transaksi_id) as jumlah, sum(transaksi_total) as total, sum(transaksi_diskon) as diskon from transaksi where transaksi_tanggal between '$tgl1' and '$tgl2' group by transaksi_tanggal order by transaksi_tanggal ASC");
								while ($datatea=mysql_fetch_array($query)) {

									$tgl = $datatea["transaksi_tanggal"];
									$query1=mysql_query("SELECT count(transaksi_id) as jumlah, sum(transaksi_total) as total, sum(transaksi_diskon) as diskon from transaksi where transaksi_tanggal='$tgl' and transaksi_status='1' group by transaksi_tanggal ");
									$datadebet=mysql_fetch_array($query1);
									$omsetdebet = $datadebet['total']-$datadebet['diskon'];

									$query2=mysql_query("SELECT count(transaksi_id) as jumlah, sum(transaksi_total) as total, sum(transaksi_diskon) as diskon from transaksi where transaksi_tanggal='$tgl' and transaksi_status_jual='offline' group by transaksi_tanggal ");
									$dataoffline=mysql_fetch_array($query2);
									$omsetoffline = $dataoffline['total']-$dataoffline['diskon'];

									$query3=mysql_query("SELECT count(transaksi_id) as jumlah, sum(transaksi_total) as total, sum(transaksi_diskon) as diskon from transaksi where transaksi_tanggal='$tgl' and transaksi_status_jual='online' group by transaksi_tanggal ");
									$dataonline=mysql_fetch_array($query3);
									$omsetonline = $dataonline['total']-$dataonline['diskon'];

									$query4=mysql_query("SELECT count(transaksi_id) as jumlah, sum(transaksi_total) as total, sum(transaksi_diskon) as diskon from transaksi where transaksi_tanggal='$tgl' and transaksi_status_jual='reseller' group by transaksi_tanggal ");
									$datareseller=mysql_fetch_array($query4);
									$omsetreseller = $datareseller['total']-$datareseller['diskon'];
								?>
									<tr>
										<td><?php echo $datatea["transaksi_tanggal"]; ?></td>
										<td><?php echo $datatea["jumlah"]; ?></td>
										<td>Rp. <?php echo format_rupiah($datatea["total"]-$datatea["diskon"]); ?></td>
										<td>Rp. <?php echo format_rupiah($datatea["diskon"]); ?></td>
										<td>Rp. <?php echo format_rupiah($omsetdebet); ?></td>
										<td>Rp. <?php echo format_rupiah($omsetoffline); ?></td>
										<td>Rp. <?php echo format_rupiah($omsetonline); ?></td>
										<td>Rp. <?php echo format_rupiah($omsetreseller); ?></td>
									</tr>
								<?php
								}
							}

			                ?>
			                </tbody>
			              </table>
			              <?php

			                if ($_GET['tanggal']=='') {
			                	# code...
			                } else {
			                	echo"<a href='pdf/pdf-harian.php?tanggal=".$_GET['tanggal']."' class='btn btn-primary' target='_blank'>Export laporan</a>";
			                }
	                	  ?>
			            </div>
			            <!-- /.box-body -->
					</div>
				</div>
	    	</div>
	    	<!-- /.row -->
    	</div>
    </section>
    <!-- /.content -->
  </div>