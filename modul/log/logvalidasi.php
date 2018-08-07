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
							<h3 class="box-title">User</h3>
							
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
						    	<input type="submit" class="btn btn-primary" value="Proses" name="logvalidasi">
						    </div>
		              	</form>

		              	<div class="clear"></div>
		              	<br>
			              <table id="example1" class="table table-bordered table-striped">
			                <thead>
			                <tr>
			                	<th>Tanggal</th>
			                	<th>Waktu</th>
			                  <th>Nama</th>
			                  <th>Uang Fisik</th>
			                  <th>Total Omset</th>
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

			                	$query = mysql_query("SELECT * FROM validasi where validasi_tanggal between '$tgl1' and '$tgl2' order by validasi_id DESC");
								while ($datatea=mysql_fetch_array($query)) {

								?>
									<tr>
										<td><?php echo $datatea['validasi_tanggal']; ?></td>
										<td><?php echo $datatea['validasi_waktu']; ?></td>
										<td><?php echo $datatea['validasi_user_nama']; ?></td>
										<td><?php echo $datatea['validasi_jumlah']; ?></td>
										<td><?php echo $datatea['validasi_omset']; ?></td>
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