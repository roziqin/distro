<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
    	Barang
      </h1>
    </section>

    <!-- Main content -->
    <section class="content">

		<div class="container-fluid spark-screen">
	    	<div class="row">
	    		<div class="col-md-4 col-md-offset-0">
					<div class="box box-primary">
						<div class="box-header with-border">
							<h3 class="box-title">Edit Harga</h3>
						</div>
						<div class="box-body">
						<?php

						$id = $_GET['id'];
						$sqlte1="SELECT * from barang where barang_id='$id'";
						$queryte1=mysql_query($sqlte1);
						$datatea=mysql_fetch_array($queryte1);

						?>
					    <form action="aksi/barang.aksi.php" method="post">
				      	<input type="hidden" name="id" value="<?php echo $id ; ?>">
							<div class="form-group">
								<label>Nama Treatment</label>
							    <input type="text" name="nama" disabled class="form-control" value="<?php echo $datatea['barang_nama'] ; ?>">
							</div>
							<div class="form-group">
								<label>Harga</label>
							    <input type="text" name="harga" class="form-control" id="price" value="<?php echo $datatea['barang_harga_jual'] ; ?>">
							</div>
							<div class="form-group">
								<label>diskon (%)</label>
							    <input type="text" name="diskon" class="form-control" value="<?php echo $datatea['barang_diskon'] ; ?>">
							</div>
							<div class="form-group">
							<?php if($id == 0) { ?>
							    
						    <?php } else { ?>
							    <input type="submit" class="btn btn-primary" value="Edit" name="editharga">

					    	<?php } ?>
							</div>
						</form>
					    </div>
					</div>
				</div>
	    		<div class="col-md-8 col-md-offset-0">
					<div class="box box-primary">
						<div class="box-header with-border">
							<h3 class="box-title">List Treatment</h3>
						</div>
						<!-- /.box-header -->
			            <div class="box-body">
			              <table id="example1" class="table table-bordered table-striped">
			                <thead>
			                <tr>
			                  <th>Nama treatment</th>
			                  <th>Harga Jual</th>
			                  <th>Diskon (%)</th>
						      <th>Actions</th>
			                </tr>
			                </thead>
			                <tbody>
			                <?php
			                	$sqlte1="SELECT * from barang where barang_jenis='treatment' ";
								$queryte1=mysql_query($sqlte1);
								while ($datatea=mysql_fetch_array($queryte1)) {
								?>
									<tr>
										<td><?php echo $datatea["barang_nama"]; ?></td>
										<td>Rp. <?php echo format_rupiah($datatea["barang_harga_jual"]); ?></td>
										<td><?php echo $datatea["barang_diskon"]; ?> %</td>
										<td>
											<a href="home.php?menu=lihattreatment&id=<?php echo $datatea["barang_id"]; ?>" class="btn btn-primary">Edit</a>
										</td>
									</tr>
								<?php
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