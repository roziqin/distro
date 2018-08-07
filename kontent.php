<?php
if ($_GET['menu']=='home') {
	date_default_timezone_set('Asia/jakarta');
	$tgl=date('j - m - Y');
	$tgl1=date('Y-m-d');
	?>
	<!-- Content Wrapper. Contains page content -->
	  <div class="content-wrapper">
	    <!-- Content Header (Page header) -->
	    <section class="content-header">
	      <h1>
	        Dashboard
		    <small><?php echo $tgl ; ?></small>
	      </h1>
	    </section>

	    <!-- Main content -->
	    <section class="content">
	      <div class="row">
			<?php 
			$iduser = $_SESSION['login_user'];
			$query=mysql_query("SELECT count(transaksi_id) as jumlah, sum(transaksi_total) as total, sum(transaksi_diskon) as diskon from transaksi where transaksi_tanggal='$tgl1' group by transaksi_tanggal ");
			$datatea=mysql_fetch_array($query);

        	if($_SESSION['role']=='pemilik') {
			?>
			<div class="col-lg-3 col-xs-6">
	          <!-- small box -->
	          <div class="small-box bg-aqua">
	            <div class="inner">
	              <h3><?php echo $datatea['jumlah'] ; ?></h3>

	              <p>Transaksi</p>
	            </div>
	            <div class="icon">
	              
	            </div>
	            <div class="small-box-footer">&nbsp;</div>
	          </div>
	        </div>
	        <!-- ./col -->
	        <div class="col-lg-3 col-xs-6">
	          <!-- small box -->
	          <div class="small-box bg-green">
	            <div class="inner">
	              <h3>Rp. <?php echo format_rupiah($datatea['total'] - $datatea['diskon']) ; ?></h3>

	              <p>Omset</p>
	            </div>
	            <div class="icon">
	              
	            </div>
	            <div class="small-box-footer">&nbsp;</div>
	          </div>
	        </div>
	        <!-- ./col -->
	        <?php } ?>
	        
	        <div class="col-md-12 col-md-offset-0">
				<div class="box box-primary">
					<div class="box-header with-border">
						<h3 class="box-title">Stok Barang</h3>
					</div>
					<!-- /.box-header -->
		            <div class="box-body">
		              	<table id="example1" class="table table-bordered table-striped ">
			                <thead>
			                <tr>
			                  <th>Nama Barang</th>
			                  <th width="60px">Stok</th>
						      <th width="220px">Actions</th>
			                </tr>
			                </thead>
			                <tbody>
			                <?php
			                	$sqlte1="SELECT * from barang, subcategory, category where barang_stok<barang_batas_stok and barang_subcategory=subcategory_id and subcategory_parent=category_id ";
								$queryte1=mysql_query($sqlte1);
								while ($datatea=mysql_fetch_array($queryte1)) {
								?>
									<tr class="attention">
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
	    </section>
	    <!-- /.content -->
	  </div>



	<?php

}elseif ($_GET['menu']=='category') {

	include "modul/barang/category.php";

}elseif ($_GET['menu']=='subcategory') {

	include "modul/barang/subcategory.php";

}elseif ($_GET['menu']=='addbarang') {

	include "modul/barang/addbarang.php";

}elseif ($_GET['menu']=='listbarang') {

	include "modul/barang/listbarang.php";

}elseif ($_GET['menu']=='editbarang') {

	include "modul/barang/editbarang.php";

}elseif ($_GET['menu']=='lihatobat') {

	include "modul/barang/lihatobat.php";

}elseif ($_GET['menu']=='lihattreatment') {

	include "modul/barang/lihattreatment.php";

}elseif ($_GET['menu']=='user') {

	include "modul/user/user.php";

}elseif ($_GET['menu']=='stok') {

	include "modul/barang/stok.php";

}elseif ($_GET['menu']=='lappenjualan') {

	include "modul/laporan/lappenjualan.php";

}elseif ($_GET['menu']=='lapkeuangan') {

	include "modul/laporan/lapkeuangan.php";

}elseif ($_GET['menu']=='laplabarugi') {

	include "modul/laporan/laplabarugi.php";

}elseif ($_GET['menu']=='lapgaji') {

	include "modul/laporan/lapgaji.php";

}elseif ($_GET['menu']=='lapbulanan') {

	include "modul/laporan/lapbulanan.php";

}elseif ($_GET['menu']=='logharga') {

	include "modul/log/logharga.php";

}elseif ($_GET['menu']=='logstok') {

	include "modul/log/logstok.php";

}elseif ($_GET['menu']=='loguser') {

	include "modul/log/loguser.php";

}elseif ($_GET['menu']=='logvalidasi') {

	include "modul/log/logvalidasi.php";

}elseif ($_GET['menu']=='member') {

	include "modul/user/editmember.php";

}elseif ($_GET['menu']=='setting') {

	include "modul/setting.php";

}  elseif ($_GET['menu']=='omset') {

	date_default_timezone_set('Asia/jakarta');
	$tgl1=date('Y-m-d');

	$name=$_SESSION['name'];
	$id=$_SESSION['login_user'];
	$query=mysql_query("SELECT count(transaksi_id) as jumlah, sum(transaksi_total) as total, sum(transaksi_diskon) as diskon from transaksi where transaksi_tanggal='$tgl1' and transaksi_user = '$id' group by transaksi_tanggal ");
			$datatea=mysql_fetch_array($query);
			$omset = $datatea['total'];

?>	
<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
    	Omset
      </h1>
    </section>

    <!-- Main content -->
    <section class="content">

		<div class="container-fluid spark-screen">
	    	<div class="row">
	    		<div class="col-md-4 col-md-offset-0">
					<div class="box box-primary">
						<div class="box-header with-border">
							<h3 class="box-title">Imput Uang Fisik</h3>
						</div>
						<div class="box-body">
					    <form action="aksi/omset.aksi.php" method="post">
				      	<input type="hidden" name="name" value="<?php echo $name ; ?>">
				      	<input type="hidden" name="id" value="<?php echo $id ; ?>">
				      	<input type="hidden" name="omset" value="<?php echo $omset ; ?>">

							<div class="form-group">
								<label>Jumlah Uang Fisik</label>
							    <input type="text" name="jumlah" class="form-control" id="price">
							</div>
							<div class="form-group">
							    <input type="submit" class="btn btn-primary" value="Proses" name="proses">
							</div>
						</form>
					    </div>
					</div>
				</div>
	    	</div>
	    	<!-- /.row -->
    	</div>
    </section>
    <!-- /.content -->
  </div>
<?php
if ($_GET['ket']=='1') {
		# code...
	?>

        <script type="text/javascript">
         windowList = new Array('print/print-omset.php');
        i = 0;
        windowName = "window";
        windowInterval = window.setInterval(function(){
          window.open(windowList[i],windowName+i,'toolbar=0,scrollbars=1,location=0,statusbar=0,menubar=0,resizable=0,titlebar=no');
          i++;
          if(i==windowList.length){
            window.clearInterval(windowInterval);
          }
        },1000);
        </script>
	<?php
	} 
}



?>