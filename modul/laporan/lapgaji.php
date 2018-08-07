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
							<h3 class="box-title">Gaji Pegawai	</h3>
							
						</div>
						<!-- /.box-header -->
			            <div class="box-body">
			            <form action="aksi/laporan.aksi.php" method="post">
			              	<div class="form-group col-md-2 col-md-offset-0">
			              		<label>Filter Bulan : </label>
			              		<select name="bulan" class="form-control">
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
			              		<label>Filter Tahun : </label>
			              		<select name="tahun" class="form-control">
			              			<option value="0">Pilih Tahun</option>
			              			<option value="2018">2018</option>
			              			<option value="2019">2019</option>
			              			<option value="2020">2020</option>
			              			<option value="2021">2021</option>
			              			<option value="2022">2022</option>
			              			<option value="2023">2023</option>
			              			<option value="2024">2024</option>
			              			<option value="2025">2025</option>
			              		</select>
			              	</div>
			              	<div class="form-group col-md-2 col-md-offset-0">
			              		<label> &nbsp;</label><br>
						    	<input type="submit" class="btn btn-primary" value="Proses" name="gaji">
						    </div>
		              	</form>
		              	<?php 
		              	if ($_GET['tanggal']!='') {
		              		# code...
							$text_line = explode("-",$_GET['tanggal']);
							$bulan = $text_line[0];
							$tahun = $text_line[1];
							$tahun1 = $text_line[1];
							$bln1 = $bulan - 1;
							if ($bln1==0) {
								# code...
								$bln1=12;
								$tahun1 = $tahun1 - 1;
							}
							if ($bln1<10) {
								# code...
								$bln1 = '0'.$bln1;
							}
		              		$tgl1=$tahun1.'-'.$bln1."-26";
		              		$tgl2=$tahun.'-'.$bulan.'-25';
	              		?>
	              		<table id="example2" class="table table-bordered table-striped">
			                <thead>
			                <tr>
			                  <th>Posisi</th>
			                  <th>Nama Pegawai</th>
			                  <th>Gaji Pokok</th>
			                  <th>Komisi Tindakan</th>
			                  <th>Komisi Obat</th>
			                  <th>Total Gaji</th>
			                </tr>
			                </thead>
			                <tbody>
			                <?php
			                	$query=mysql_query("SELECT * FROM users where role='dokter'");
								while ($datatea=mysql_fetch_array($query)) {
									$id = $datatea['id'];
									$nama = $datatea['name'];
									$gaji = $datatea['gaji'];
									$role = $datatea['role'];
				                	$query1=mysql_query("SELECT sum(transaksi_detail_komisi_dokter) as obat from transaksi t, transaksi_detail td, barang b where transaksi_id=transaksi_detail_no_nota and transaksi_detail_barang_id=barang_id and transaksi_dokter='$id' and barang_jenis='obat' and transaksi_tanggal between '$tgl1' and '$tgl2' ");
									//while ($data=mysql_fetch_array($query1)) {
				                	$data=mysql_fetch_array($query1);


				                	$query2=mysql_query("SELECT sum(transaksi_detail_komisi_dokter) as treatment from transaksi t, transaksi_detail td, barang b where transaksi_id=transaksi_detail_no_nota and transaksi_detail_barang_id=barang_id and transaksi_dokter='$id' and barang_jenis='treatment' and transaksi_tanggal between '$tgl1' and '$tgl2' ");
									//while ($data=mysql_fetch_array($query1)) {
				                	$data2=mysql_fetch_array($query2);
									?>
										<tr>
											<td><?php echo $role; ?></td>
											<td><?php echo $nama; ?></td>
											<td>Rp. <?php echo format_rupiah($gaji); ?></td>
											<td>Rp. <?php echo format_rupiah($data2['treatment']); ?></td>
											<td>Rp. <?php echo format_rupiah($data['obat']); ?></td>
											<td>Rp. <?php echo format_rupiah($gaji+$data2['treatment']+$data['obat']); ?></td>
										</tr>
									<?php
									//}
								}
								$query=mysql_query("SELECT * FROM users where role='bo'");
								while ($datatea=mysql_fetch_array($query)) {
									$id = $datatea['id'];
									$nama = $datatea['name'];
									$gaji = $datatea['gaji'];
									$role = $datatea['role'];
				                	

				                	$query1=mysql_query("SELECT sum(transaksi_detail_komisi_bo) as obat from transaksi t, transaksi_detail td, barang b where transaksi_id=transaksi_detail_no_nota and transaksi_detail_barang_id=barang_id and transaksi_bo='$id' and barang_jenis='obat' and transaksi_tanggal between '$tgl1' and '$tgl2' ");
									//while ($data=mysql_fetch_array($query1)) {
				                	$data=mysql_fetch_array($query1);


				                	$query2=mysql_query("SELECT sum(transaksi_detail_komisi_bo) as treatment from transaksi t, transaksi_detail td, barang b where transaksi_id=transaksi_detail_no_nota and transaksi_detail_barang_id=barang_id and transaksi_bo='$id' and barang_jenis='treatment' and transaksi_tanggal between '$tgl1' and '$tgl2' ");
									//while ($data=mysql_fetch_array($query1)) {
				                	$data2=mysql_fetch_array($query2);

									?>
										<tr>
											<td><?php echo $role; ?></td>
											<td><?php echo $nama; ?></td>
											<td>Rp. <?php echo format_rupiah($gaji); ?></td>
											<td>Rp. <?php echo format_rupiah($data2['treatment']); ?></td>
											<td>Rp. <?php echo format_rupiah($data['obat']); ?></td>
											<td>Rp. <?php echo format_rupiah($gaji+$data2['treatment']+$data['obat']); ?></td>
										</tr>
									<?php
									//}
								}
								$query=mysql_query("SELECT * FROM users where role='admin'");
								while ($datatea=mysql_fetch_array($query)) {
									$id = $datatea['id'];
									$nama = $datatea['name'];
									$gaji = $datatea['gaji'];
									$role = $datatea['role'];
				                	
				                	$query1=mysql_query("SELECT sum(transaksi_detail_komisi_admin) as obat from transaksi t, transaksi_detail td, barang b where transaksi_id=transaksi_detail_no_nota and transaksi_detail_barang_id=barang_id and transaksi_admin='$id' and barang_jenis='obat' and transaksi_tanggal between '$tgl1' and '$tgl2' ");
									//while ($data=mysql_fetch_array($query1)) {
				                	$data=mysql_fetch_array($query1);


				                	$query2=mysql_query("SELECT sum(transaksi_detail_komisi_admin) as treatment from transaksi t, transaksi_detail td, barang b where transaksi_id=transaksi_detail_no_nota and transaksi_detail_barang_id=barang_id and transaksi_admin='$id' and barang_jenis='treatment' and transaksi_tanggal between '$tgl1' and '$tgl2' ");
									//while ($data=mysql_fetch_array($query1)) {
				                	$data2=mysql_fetch_array($query2);

									?>
										<tr>
											<td><?php echo $role; ?></td>
											<td><?php echo $nama; ?></td>
											<td>Rp. <?php echo format_rupiah($gaji); ?></td>
											<td>Rp. <?php echo format_rupiah($data2['treatment']); ?></td>
											<td>Rp. <?php echo format_rupiah($data['obat']); ?></td>
											<td>Rp. <?php echo format_rupiah($gaji+$data2['treatment']+$data['obat']); ?></td>
										</tr>
									<?php
									//}
								}

			                ?>
			                </tbody>
			            </table>
	              		<?php
	              		echo"<a href='print/printlapgaji.php?tanggal=".$_GET['tanggal']."' class='btn btn-primary' target='_blank'>Print laporan</a>";
		              	} else {
		              		# code...
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