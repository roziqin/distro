<?php
session_start();
  include"../include/koneksi.php";
  include "../include/fungsi_rupiah.php";
   date_default_timezone_set('Asia/jakarta');
$tgl=date('Y-m-d');
$wkt=date('G:i:s');

$aid = $_SESSION['login_user'];
$aa = "select * from users where id='$aid'";
  $bb = mysql_query($aa) or die(mysql_error());
  $cc = mysql_fetch_array($bb);
  $id=$cc['name'];
  $iduser=$cc['id'];
      
  $dd = mysql_query("SELECT * FROM validasi where validasi_user_id='$iduser' and validasi_tanggal='$tgl' order by validasi_id DESC LIMIT 1");
  $datadd=mysql_fetch_array($dd);
  $fisik = $datadd['validasi_jumlah'];
  echo mysql_error();

  $query=mysql_query("SELECT count(transaksi_id) as jumlah, sum(transaksi_total) as total, sum(transaksi_diskon) as diskon from transaksi where transaksi_tanggal='$tgl' and transaksi_user = '$iduser' group by transaksi_tanggal ");
      $datatea=mysql_fetch_array($query);
      $diskon = $datatea['diskon'];
      $omset = $datatea['total'] - $diskon;
      $tot = $datatea['jumlah'];

      $query1=mysql_query("SELECT count(transaksi_id) as jumlah, sum(transaksi_total) as total, sum(transaksi_diskon) as diskon from transaksi where transaksi_tanggal='$tgl' and transaksi_user = '$iduser' and transaksi_status='1' group by transaksi_tanggal ");
      $datadebet=mysql_fetch_array($query1);
      $omsetdebet = $datadebet['total']-$datadebet['diskon'];

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<link rel="stylesheet" href="../style-print.css">
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<script type="text/javascript">
  window.setTimeout(function() {
    window.close();
  },1000)
</script>
</head>

<body onLoad="window.print()" style="
  font-family: 'Source Sans Pro', 'Helvetica Neue', Helvetica, Arial, sans-serif;">
    <div class="wrapper">

<table  width="100%" border="0">
  <tr>
    <td colspan=3 >Laporan Penjualan</td>
  </tr>
  <tr>
    <td colspan="3"><hr></td>
  </tr>
  <tr>
    <td width="80px">Tanggal</td>
    <td width="10">:</td>
    <td ><?php echo $tgl;?></td>
  </tr>
  <tr>
    <td width="80px">Waktu</td>
    <td width="10">:</td>
    <td ><?php echo $wkt;?></td>
  </tr>
  <tr>
    <td>Kasir</td>
    <td>:</td>
    <td><?php echo $id;?></td>
  </tr>
  <tr>
    <td colspan="4"><hr></td>
  </tr>
  <tr>
    <td>Total Omset</td>
    <td>:</td>
    <td style="text-align: right;"><?php echo format_rupiah($omset);?></td>
  </tr>
  <tr>
    <td>Uang Fisik</td>
    <td>:</td>
    <td style="text-align: right;"><?php echo format_rupiah($fisik);?></td>
  </tr>
  <tr>
    <td>Debet</td>
    <td>:</td>
    <td style="text-align: right;"><?php echo format_rupiah($omsetdebet);?></td>
  </tr>
  <tr>
    <td>Diskon</td>
    <td>:</td>
    <td style="text-align: right;"><?php echo format_rupiah($diskon);?></td>
  </tr>
</table>

</div>
</body>
</html>
