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
    <?php
    $text_line = explode(":",$_GET['tanggal']);
    $tgl1=$text_line[0];
    $tgl2=$text_line[1];
    ?>
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
    <th colspan="4" style="text-align: center;">Laporan Penjualan</th>
  </tr>
  <tr>
    <td colspan="4"><hr></td>
  </tr>
</table>
    <table id="laporan" class="table table-bordered table-striped">
      <thead>
      <tr>
        <th>Nama Obat/Treatment</th>
        <th>Jumlah yg Terjual</th>
      </tr>
      </thead>
      <tbody>
      <?php

      $query=mysql_query("SELECT transaksi_tanggal, barang_nama,sum(transaksi_detail_jumlah) as jumlah from transaksi, transaksi_detail, barang where transaksi_id=transaksi_detail_no_nota and transaksi_detail_barang_id=barang_id and transaksi_tanggal between '$tgl1' and '$tgl2' group by transaksi_detail_barang_id order by barang_id ASC");
      while ($datatea=mysql_fetch_array($query)) {

      ?>
        <tr>
          <td><?php echo $datatea["barang_nama"]; ?></td>
          <td><?php echo $datatea["jumlah"]; ?></td>
        </tr>
      <?php
      }
    

      ?>
      </tbody>
    </table>
  </div>
</body>
</html>