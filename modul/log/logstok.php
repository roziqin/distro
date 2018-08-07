<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
    	Log
      </h1>
    </section>

    <!-- Main content -->
    <section class="content">

		<div class="container-fluid spark-screen">
	    	<div class="row">
	    		<div class="col-md-12 col-md-offset-0">
					<div class="box box-primary">
						<div class="box-header with-border">
							<h3 class="box-title">Stok Barang</h3>
							
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
						    	<input type="submit" class="btn btn-primary" value="Proses" name="logstok">
						    </div>
		              	</form>

		              	<div class="clear"></div>
		              	<br>
			              <table id="example1" class="table table-bordered table-striped">
			                <thead>
			                <tr>
			                	<th>Tanggal</th>
			                	<th>Barang</th>
			                  <th>Stok Awal</th>
			                  <th>Jumlah yg dimasukkan</th>
			                  <th>Stok Akhir</th>
			                  <th>Keterangan</th>
			                  <th>User</th>
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

			                	$query=mysql_query("SELECT * from users s, log_stok ls, barang b where b.barang_id=ls.barang and  s.id=ls.user and tanggal between '$tgl1' and '$tgl2'");
								while ($datatea=mysql_fetch_array($query)) {
									$class = "";
									$jml = 0;
									if ($datatea["alasan"]=="Tambah Stok") {
										# code...
										$jml = $datatea["stok_awal"] + $datatea["stok_jumlah"];
										$stok = $datatea["stok_jumlah"];
									} else {
										# code...
										$jml = $datatea["stok_awal"] - $datatea["stok_jumlah"];
										$stok = "-".$datatea["stok_jumlah"];
										$class = "attention";
									}
									
									
								?>
									<tr class="<?php echo $class ; ?>">
										<td><?php echo $datatea["tanggal"]; ?></td>
										<td><?php echo $datatea["barang_nama"]; ?></td>
										<td><?php echo $datatea["stok_awal"]; ?></td>
										<td><?php echo $stok; ?></td>
										<td><?php echo $jml; ?></td>
										<td><?php echo $datatea["alasan"]; ?></td>
										<td><?php echo $datatea["name"]; ?></td>
									</tr>
								<?php
								}
							}
			                ?>
			                </tbody>
			              </table>
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