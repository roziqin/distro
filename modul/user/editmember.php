<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
    	Member
      </h1>
    </section>

    <!-- Main content -->
    <section class="content">

		<div class="container-fluid spark-screen">
	    	<div class="row">
	    		<div class="col-md-4 col-md-offset-0">
					<div class="box box-primary">
						<div class="box-header with-border">
							<h3 class="box-title">Edit Member</h3>
						</div>
						<div class="box-body">
						<?php

						$id = $_GET['id'];
						$sqlte1="SELECT * from member where member_id='$id'";
						$queryte1=mysql_query($sqlte1);
						$datatea=mysql_fetch_array($queryte1);

						?>
					    <form action="aksi/member.aksi.php" method="post">
				      	<input type="hidden" name="id" value="<?php echo $id ; ?>">
							<div class="form-group">
								<label>Nama</label>
							    <input type="text" name="nama" class="form-control" autofocus value="<?php echo $datatea['member_nama'] ; ?>">
							</div>
							<div class="form-group">
								<label>Alamat</label>
							    <input type="text" name="alamat" class="form-control" value="<?php echo $datatea['member_alamat'] ; ?>">
							</div>
							<div class="form-group">
								<label>Tanggal Lahir</label>
								<div class="input-group">
				                  <div class="input-group-addon">
				                    <i class="fa fa-calendar"></i>
				                  </div>
				                  <input type="text" name="tanggal" class="form-control" data-inputmask="'alias': 'yyyy/mm/dd'" data-mask value="<?php echo $datatea['member_tgl_lahir'] ; ?>">
				                </div>
							</div>
							<div class="form-group">
								<label>No. Hp</label>
							    <input type="text" name="nohp" class="form-control" value="<?php echo $datatea['member_hp'] ; ?>">
							</div>
							<div class="form-group">
								<label>Gender</label>
							    <select class="form-control" name="gender">
									<?php if($id == 0) { ?>
											<option value="0">Perempuan</option>
											<option value="1">Laki - Laki</option>
					                <?php } else { 
					                	if($datatea['member_gender'] == '0') {?>

											<option value="0" selected>Perempuan</option>
											<option value="1">Laki - Laki</option>
						                <?php } else { ?>

											<option value="0">Perempuan</option>
											<option value="1" selected>Laki - Laki</option>
						                <?php } ?>
					                <?php } ?>
								</select>
							</div>
							<div class="form-group">
								<?php if($id == 0) { ?>

							    <?php } else { ?>
							    <input type="submit" class="btn btn-primary" value="Edit" name="editmember">

						    	<?php } ?>
							</div>
						</form>
					    </div>
					</div>
				</div>
				<div class="col-md-8 col-md-offset-0">
					<div class="box box-primary">
						<div class="box-header with-border">
							<h3 class="box-title">List Member</h3>
						</div>
						<div class="box-body">
							<table id="example1" class="table table-bordered table-striped">
				                <thead>
				                <tr>
				                  <th>Nama</th>
				                  <th>Alamat</th>
							      <th>Tgl Lahir</th>
							      <th>No. Hp</th>
							      <th>Gender</th>
							      <th>Action</th>
				                </tr>
				                </thead>
				                <tbody>
			                	<?php
				                	$sqlte1="SELECT * from member ";
									$queryte1=mysql_query($sqlte1);
									while ($datatea=mysql_fetch_array($queryte1)) {
										$gender='';
										if ($datatea["member_gender"]==0) {
											# code...
											$gender='Perempuan';
										} else {
											$gender='Laki - Laki';
										}
									?>
										<tr>
											<td><?php echo $datatea["member_nama"]; ?></td>
											<td><?php echo $datatea["member_alamat"]; ?></td>
											<td><?php echo $datatea["member_tgl_lahir"]; ?></td>
											<td><?php echo $datatea["member_hp"]; ?></td>
											<td><?php echo $gender; ?></td>
											<td>
												<a href="home.php?menu=member&id=<?php echo $datatea["member_id"]; ?>" class="btn btn-primary">Edit</a>
												<a href="modul/user/deletemember.php?id=<?php echo $datatea["member_id"]; ?>" class="btn btn-danger">Delete</a>

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