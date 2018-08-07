
<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
    	Setting
      </h1>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">

		<div class="box-body">
			<?php

			$sqlte1="SELECT * from options LIMIT 1";
			$queryte1=mysql_query($sqlte1);
			$datatea=mysql_fetch_array($queryte1);			


			?>
		    <form action="aksi/setting.aksi.php" method="post" enctype="multipart/form-data">
		      	<input type="hidden" name="id" value="<?php echo $datatea['options_id'] ; ?>">
			    <div class="form-group">
					<label>Alamat Toko</label>
			      <input type="text" name="alamat" class="form-control" placeholder="Alamat Toko" value="<?php echo $datatea['options_alamat'] ; ?>">
			    </div>
			    <div class="form-group">
					<label>Telepon Toko</label>
			      <input type="text" name="telepon" class="form-control" placeholder="Telepon Toko" value="<?php echo $datatea['options_telepon'] ; ?>">
			    </div>
			    <div class="form-group">
					<label>Logo Toko</label>
					<input name="gambar" type="file" id="gambar" />
			    </div>
			    <div class="form-group">
					<label>Saving Gaji</label>
			      	<input type="text" name="gaji" class="form-control" placeholder="Saving Gaji" id="price" value="<?php echo $datatea['options_gaji'] ; ?>">
			    </div>
			    <div class="form-group">
					<label>Saving Promo</label>
			      	<input type="text" name="promo" class="form-control" placeholder="Saving Promo" id="price1" value="<?php echo $datatea['options_promo'] ; ?>">
			    </div>
			    <div class="form-group">
					<label>Saving Sewa</label>
			      <input type="text" name="sewa" class="form-control" placeholder="Saving Sewa" id="price2" value="<?php echo $datatea['options_sewa'] ; ?>">
			    </div>
			    <div class="form-group">
					<label>Saving Event</label>
			      <input type="text" name="event" class="form-control" placeholder="Saving Event" id="price3" value="<?php echo $datatea['options_event'] ; ?>">
			    </div>
			    <!--
			    <div class="form-group">
					<label>Bonus</label>
			      <input type="text" name="bonus" class="form-control" placeholder="Bonus" id="price4" value="<?php echo $datatea['options_bonus'] ; ?>">
			    </div>
				-->
			      <input type="hidden" name="bonus" class="form-control" placeholder="Bonus" id="price4" value="0">
			    <div class="form-group">
					<label>Lain-lain</label>
			      <input type="text" name="lain" class="form-control" placeholder="Lain-lain" id="price5" value="<?php echo $datatea['options_lain'] ; ?>">
			    </div>
			    <div class="form-group">
			      <input type="submit" class="btn btn-primary" value="Save" name="edit">
			    </div>
		    </form>
		</div>
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>
