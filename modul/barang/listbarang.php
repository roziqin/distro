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
	    		<div class="col-md-12 col-md-offset-0">
					<div class="box box-primary">
						<div class="box-header with-border">
							<h3 class="box-title">List Barang</h3>
						</div>
						<!-- /.box-header -->
			            <div class="box-body">
			              <table id="example1" class="table table-bordered table-striped">
			                <thead>
			                <tr>
			                  <th>Nama Barang</th>
			                  <th>Harga Jual</th>
			                  <th>Diskon (%)</th>
			                  <th>Stok</th>
			                  <th>Barcode Barang</th>
						      <th>Actions</th>
			                </tr>
			                </thead>
			                <tbody>
			                <?php
			                	$sqlte1="SELECT * from barang, subcategory, category WHERE barang_subcategory=subcategory_id and subcategory_parent=category_id";
								$queryte1=mysql_query($sqlte1);
								while ($datatea=mysql_fetch_array($queryte1)) {
								?>
									<tr>
										<td><?php echo $datatea["category_nama"]." ".$datatea["subcategory_nama"]." ".$datatea["barang_nama"]." size ".$datatea["barang_size"]; ?></td>
										<td>Rp. <?php echo format_rupiah($datatea["barang_harga_jual"]); ?></td>
										<td><?php echo $datatea["barang_diskon"]; ?> %</td>
										<td><?php echo $datatea["barang_stok"]; ?></td>
										<td><?php echo $datatea["barang_barcode"]; ?></td>
										<td>
											<a href="home.php?menu=editbarang&id=<?php echo $datatea["barang_id"]; ?>" class="btn btn-primary">Edit</a>
											<a href="modul/user/deletebarang.php?id=<?php echo $datatea["barang_id"]; ?>" class="btn btn-danger">Delete</a>
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