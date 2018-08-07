<?php
include "../include/koneksi.php";
include "../include/fungsi_rupiah.php";

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<link rel="stylesheet" href="../style-print.css">
  <!-- Bootstrap 3.3.6 -->
  <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
  <!-- DataTables -->
  <link rel="stylesheet" href="../plugins/datatables/dataTables.bootstrap.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../dist/css/AdminLTE.min.css">
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<script type="text/javascript">
  //window.setTimeout(function() {
   // window.close();
 // },1000)
</script>
</head>

<body onLoad="window.print()" style="
  font-family: 'Source Sans Pro', 'Helvetica Neue', Helvetica, Arial, sans-serif;">
  <div class="wrapper">

    <img src="../dist/img/logo_png.png" style=" width: 100px;
    margin: 0 auto 10px;
    display: block;">
<table  width="100%" border="0"  style='font-size: 16px;'>
  <tr>
    <th colspan="4" style="text-align: center;">Jl. Jenggolo No. 23 - Dampit Malang</th>
  </tr>
  <tr>
    <th colspan="4" style="text-align: center;">Tlp 0341 - 895977</th>
  </tr>
  <tr>
    <th colspan="4" style="text-align: center;">Laporan Gaji Pegawai</th>
  </tr>
  <tr>
    <td colspan="4"><hr></td>
  </tr>
</table>
    <?php

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
    <table id="laporan" class="table table-bordered table-striped">
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
  </div>
</body>
</html>