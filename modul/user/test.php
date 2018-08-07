<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
    	Pegawai
      </h1>
    </section>

    <!-- Main content -->
    <section class="content">

		<div class="container-fluid spark-screen">
	    	<div class="row">
	    		<div class="col-md-4 col-md-offset-0">
					<div class="box box-primary">
						<div class="box-header with-border">
							<h3 class="box-title">Tambah Pegawai</h3>
						</div>
						<div class="box-body">
						<?php

						$id = $_GET['id'];
						$sqlte1="SELECT * from users where id='$id'";
						$queryte1=mysql_query($sqlte1);
						$datatea=mysql_fetch_array($queryte1);

						?>
					    <form action="aksi/user.aksi.php" method="post">
				      	<input type="hidden" name="id" value="<?php echo $id ; ?>">
							<div class="form-group">
								<label>Nama Lengkap</label>
							    <input type="text" name="nama" class="form-control" placeholder="Nama Lengkap" value="<?php echo $datatea['name'] ; ?>">
							</div>
							<div class="form-group">
								<label>Username</label>
							    <input type="text" name="username" class="form-control" placeholder="Username" value="<?php echo $datatea['username'] ; ?>">
							</div>
							<div class="form-group">
								<label>Password</label>
							    <input type="password" name="password" class="form-control" placeholder="Password">
							</div>
						    <div class="form-group">
						    	<label>Posisi</label>
						        <select name="jenis" class="form-control">
					        	<?php if($id == 0) { ?>
					                <option value="admin">Admin</option>
					                <option value="bo">B.O</option>
				                <?php } else { 
				                	if($datatea['role'] == 'admin') {?>

						                <option value="admin" selected >Admin</option>
						                <option value="bo">B.O</option>
					                <?php } else { ?>
						                <option value="admin" >Admin</option>
						                <option value="bo" selected >B.O</option>
					                <?php } ?>
				                <?php } ?>
					            </select>
						    </div>
							<div class="form-group">
								<label>Gaji Pokok</label>
							    <input type="text" name="gaji" class="form-control" placeholder="Gaji Pokok" id="price" value="<?php echo $datatea['gaji'] ; ?>">
							</div>
							<div class="form-group">
							<?php if($id == 0) { ?>
							    <input type="submit" class="btn btn-primary" value="Tambah" name="tambah">
						    <?php } else { ?>
							    <input type="submit" class="btn btn-primary" value="Edit" name="edit">

					    	<?php } ?>
							</div>
						</form>
					    </div>
					</div>
				</div>
				<div class="col-md-8 col-md-offset-0">
					<div class="box box-primary">
						<div class="box-header with-border">
							<h3 class="box-title">List Pegawai</h3>
						</div>
						<div class="box-body">
							<table id="example1" class="table table-bordered table-striped">
				                <thead>
				                <tr>
				                  <th>Nama Lengkap</th>
				                  <th>Username</th>
							      <th>Posisi</th>
							      <th>Action</th>
				                </tr>
				                </thead>
				                <tbody>
			                	<?php
				                	$sqlte1="SELECT * from users ";
									$queryte1=mysql_query($sqlte1);
									while ($datatea=mysql_fetch_array($queryte1)) {
									?>
										<tr>
											<td><?php echo $datatea["name"]; ?></td>
											<td><?php echo $datatea["username"]; ?></td>
											<td><?php echo $datatea["role"]; ?></td>
											<td>
												<a href="home.php?menu=user&id=<?php echo $datatea["id"]; ?>" class="btn btn-primary">Edit</a>
												<a href="modul/user/deleteuser.php?id=<?php echo $datatea["id"]; ?>" class="btn btn-danger">Delete</a>
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