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

				    	<?php if($_GET['ket'] == 'tambah') {?>
							<h3 class="box-title">Tambah Stok</h3>
						<?php } else { ?>
							<h3 class="box-title">Barang Rusak</h3>
						<?php } ?>
						</div>
						<div class="box-body">
						<?php

						$id = $_GET['id'];
						$sqlte1="SELECT * from barang, subcategory, category WHERE barang_subcategory=subcategory_id and subcategory_parent=category_id and  barang_id='$id'";
						$queryte1=mysql_query($sqlte1);
						$datatea=mysql_fetch_array($queryte1);

						?>
					    <form action="aksi/barang.aksi.php" method="post">
				      	<input type="hidden" name="id" value="<?php echo $id ; ?>">
							<div class="form-group">
								<label>Nama Barang</label>
							    <input type="text" name="nama" class="form-control" placeholder="Nama Barang" value='<?php echo $datatea["category_nama"]." ".$datatea["subcategory_nama"]." ".$datatea["barang_nama"]." size ".$datatea["barang_size"] ; ?>' disabled>
							</div>
							<div class="form-group">
								<label>Jumlah Stok</label>
							    <input type="text" name="stok" class="form-control" placeholder="Jumlah Stok" value="0">
							</div>
							<div class="form-group">
							<?php if($id == 0) { ?>
						    <?php } else { 
						    	if($_GET['ket'] == 'tambah') {?>
								    <input type="submit" class="btn btn-primary" value="Tambah Stok" name="tambah_stok">
							    <?php } else { ?>
									<div class="form-group">
										<label>Keterangan Rusak</label>
									    <input type="text" name="keterangan" class="form-control" placeholder="Keterangan Rusak">
									</div>
								    <input type="submit" class="btn btn-primary" value="Update" name="rusak">
						    	<?php } ?>
					    	<?php } ?>
							</div>
						</form>
					    </div>
					</div>
				</div>
	    		<div class="col-md-8 col-md-offset-0">
					<div class="box box-primary">
						<div class="box-header with-border">
							<h3 class="box-title">Stok Barang</h3>
						</div>
						<!-- /.box-header -->
			            <div class="box-body">
			              <table id="example1" class="table table-bordered table-striped">
			                <thead>
			                <tr>
			                  <th>Nama Barang</th>
			                  <th width="60px">Stok</th>
						      <th width="200px">Actions</th>
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
										<td><?php echo $datatea["barang_stok"]; ?></td>
										<td>
											<a href="home.php?menu=stok&ket=tambah&id=<?php echo $datatea["barang_id"]; ?>" class="btn btn-primary">Tambah Stok</a>
											<a href="home.php?menu=stok&ket=rusak&id=<?php echo $datatea["barang_id"]; ?>" class="btn btn-danger">Barang Rusak</a>
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