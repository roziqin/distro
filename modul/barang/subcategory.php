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
							<h3 class="box-title">Tambah Sub Category</h3>
						</div>
						<div class="box-body">
						<?php

						$id = $_GET['id'];
						$sqlte1="SELECT * from subcategory where subcategory_id='$id'";
						$queryte1=mysql_query($sqlte1);
						$datatea=mysql_fetch_array($queryte1);

						?>
					    <form action="aksi/barang.aksi.php" method="post">
				      	<input type="hidden" name="id" value="<?php echo $id ; ?>">
							<div class="form-group">
								<label>Nama Sub Category</label>
							    <input type="text" name="nama" class="form-control" placeholder="Nama Sub Category" value="<?php echo $datatea['subcategory_nama'] ; ?>">
							</div>

						    <div class="form-group">
						    	<label>Parent</label>
						        <select name="category" class="form-control">
				                <?php 
				                	$selected = '';
									$sql="SELECT * from category";
									$query=mysql_query($sql);
									while($data=mysql_fetch_array($query)) {
									if ($data['category_id']==$datatea['subcategory_parent']) {
									 	# code...
					                	$selected = 'selected';
									 } else {
					                	$selected = '';
									 	
									 }
								?>
						        	    <option value="<?php echo $data['category_id']; ?>" <?php echo $selected; ?> ><?php echo $data['category_nama']; ?></option>
				                <?php } ?>
					            </select>
						    </div>
							<div class="form-group">
							<?php if($id == 0) { ?>
							    <input type="submit" class="btn btn-primary" value="Tambah" name="tambahsubcategory">
						    <?php } else { ?>
							    <input type="submit" class="btn btn-primary" value="Edit" name="editsubcategory">

					    	<?php } ?>
							</div>
						</form>
					    </div>
					</div>
				</div>
				<div class="col-md-8 col-md-offset-0">
					<div class="box box-primary">
						<div class="box-header with-border">
							<h3 class="box-title">List Sub Category</h3>
						</div>
						<div class="box-body">
							<table id="example1" class="table table-bordered table-striped">
				                <thead>
				                <tr>
				                  <th>Nama Sub Category</th>
				                  <th>Parent</th>
							      <th>Action</th>
				                </tr>
				                </thead>
				                <tbody>
			                	<?php
				                	$sqlte1="SELECT * from subcategory, category Where subcategory_parent=category_id";
									$queryte1=mysql_query($sqlte1);
									while ($datatea=mysql_fetch_array($queryte1)) {
									?>
										<tr>
											<td><?php echo $datatea["subcategory_nama"]; ?></td>
											<td><?php echo $datatea["category_nama"]; ?></td>
											<td>
												<a href="home.php?menu=subcategory&id=<?php echo $datatea["subcategory_id"]; ?>" class="btn btn-primary">Edit</a>
												<a href="modul/barang/deletecategory.php?menu=subcategory&id=<?php echo $datatea["subcategory_id"]; ?>" class="btn btn-danger">Delete</a>
											</td>
										</tr>
									<?php
									}

				                ?>
				                </tbody>
				            </table>
						</div>
					</div>
				</div>
	    	</div>
	    	<!-- /.row -->
    	</div>
    </section>
    <!-- /.content -->
  </div>