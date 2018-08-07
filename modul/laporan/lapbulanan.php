<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
    	Laporan
      </h1>
    </section>

    <!-- Main content -->
    <section class="content">

		<div class="container-fluid spark-screen">
	    	<div class="row">
	    		<div class="col-md-12 col-md-offset-0">
					<div class="box box-primary">
						<div class="box-header with-border">
							<h3 class="box-title">Bulanan Omset & laba</h3>
							
						</div>
						<!-- /.box-header -->
			            <div class="box-body">
			            <form action="aksi/laporan.aksi.php" method="post">
			              	<div class="form-group col-md-2 col-md-offset-0">
			              		<label>Filter Tanggal : </label>
			              		
						        <select name="bulan-1" class="form-control">
					                <option value="00">Pilih Bulan</option>
			              			<option value="01">Januari</option>
			              			<option value="02">Februari</option>
			              			<option value="03">Maret</option>
			              			<option value="04">April</option>
			              			<option value="05">Mei</option>
			              			<option value="06">Juni</option>
			              			<option value="07">Juli</option>
			              			<option value="08">Agustus</option>
			              			<option value="09">September</option>
			              			<option value="10">Oktober</option>
			              			<option value="11">November</option>
			              			<option value="12">Desember</option>
				                </select>
			                </div>
			              	<div class="form-group col-md-2 col-md-offset-0">
			              	<label>&nbsp; </label>
				                <select name="tahun-1" class="form-control">
					                <option value="">Pilih Tahun</option>
					                <option value="2017">2017</option>
					                <option value="2018">2018</option>
					                <option value="2019">2019</option>
					                <option value="2020">2020</option>
					                <option value="2021">2021</option>
				                </select>
			              	</div>
			              	<div class="form-group col-md-1 col-md-offset-0" style="text-align: center;margin-top: 30px;">
			              	<label>sd.</label>
			              		
			              	</div>
			              	<div class="form-group col-md-2 col-md-offset-0">
			              		<label>&nbsp; </label>
			              		
						        <select name="bulan-2" class="form-control">
					                <option value="00">Pilih Bulan</option>
			              			<option value="01">Januari</option>
			              			<option value="02">Februari</option>
			              			<option value="03">Maret</option>
			              			<option value="04">April</option>
			              			<option value="05">Mei</option>
			              			<option value="06">Juni</option>
			              			<option value="07">Juli</option>
			              			<option value="08">Agustus</option>
			              			<option value="09">September</option>
			              			<option value="10">Oktober</option>
			              			<option value="11">November</option>
			              			<option value="12">Desember</option>
				                </select>
			                </div>
			              	<div class="form-group col-md-2 col-md-offset-0">
			              	<label>&nbsp; </label>
				                <select name="tahun-2" class="form-control">
					                <option value="">Pilih Tahun</option>
					                <option value="2017">2017</option>
					                <option value="2018">2018</option>
					                <option value="2019">2019</option>
					                <option value="2020">2020</option>
					                <option value="2021">2021</option>
				                </select>
			              	</div>
			              	<div class="form-group col-md-2 col-md-offset-0">
			              		<label> &nbsp;</label><br>
						    	<input type="submit" class="btn btn-primary" value="Proses" name="bulanan">
						    </div>
		              	</form>
		              	<div class="clear"></div>
		              	<br>
			              <table id="laporan" class="table table-bordered table-striped">
			                <thead>
			                <tr>
			                  <th>Bulan</th>
			                  <!--<th>Total</th>
			                  <th>Diskon</th>-->
			                  <th>Omset Bersih</th>
			                  <th>Laba</th>
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
			                	$query=mysql_query("SELECT transaksi_bulan, sum(transaksi_total) as total, sum(transaksi_diskon) as diskon from transaksi where transaksi_bulan between '$tgl1' and '$tgl2' group by transaksi_bulan order by transaksi_bulan ASC");
								while ($datatea=mysql_fetch_array($query)) {

									$t = $datatea["transaksi_bulan"];
								$query1=mysql_query("SELECT sum(transaksi_detail_harga_beli*transaksi_detail_jumlah) as beli from transaksi_detail, transaksi where transaksi_id=transaksi_detail_no_nota and transaksi_bulan='$t'");
								$data=mysql_fetch_array($query1);
								$bersih = $datatea["total"] - $datatea["diskon"];
								$bonus = $datatea["total"]*5/100;

								$query2=mysql_query("SELECT * FROM options LIMIT 1");
								$data2=mysql_fetch_array($query2);


								$laba = $bersih-$data["beli"]-$data2["options_gaji"]-$data2["options_promo"]-$data2["options_sewa"]-$data2["options_event"]-$data2["options_lain"]-$bonus;
								
								?>
									<tr>
										<td><?php echo $t; ?></td>
										<?php /*
										<td>Rp. <?php echo format_rupiah($datatea["total"]); ?></td>
										<td>Rp. <?php echo format_rupiah($datatea["diskon"]); ?></td>
										*/ ?>
										<td>Rp. <?php echo format_rupiah(($bersih)); ?></td>
										<td>Rp. <?php echo format_rupiah($laba); ?></td>
									</tr>
								<?php
								}
							}

			                ?>
			                </tbody>
			              </table>
			              <?php

			                if ($_GET['tanggal']=='') {
			                	# code...
			                } else {
			                	echo"<a href='pdf/pdf-bulanan.php?tanggal=".$_GET['tanggal']."' class='btn btn-primary' target='_blank'>Export laporan</a>";
			                }
	                	  ?>
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