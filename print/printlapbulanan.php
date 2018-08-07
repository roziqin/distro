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
    <th colspan="4" style="text-align: center;">Laporan Bulanan</th>
  </tr>
  <tr>
    <td colspan="4"><hr></td>
  </tr>
</table>
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
        $text_line = explode(":",$_GET['tanggal']);
        $tgl1=$text_line[0];
        $tgl2=$text_line[1];
                $query=mysql_query("SELECT transaksi_bulan, sum(transaksi_total) as total, sum(transaksi_diskon) as diskon from transaksi where transaksi_bulan between '$tgl1' and '$tgl2' group by transaksi_bulan order by transaksi_bulan ASC");
        while ($datatea=mysql_fetch_array($query)) {

          $t = $datatea["transaksi_bulan"];
        $query1=mysql_query("SELECT sum(transaksi_detail_harga_beli*transaksi_detail_jumlah) as beli from transaksi_detail, transaksi where transaksi_id=transaksi_detail_no_nota and transaksi_bulan='$t'");
        $data=mysql_fetch_array($query1);
        $bersih = $datatea["total"] - $datatea["diskon"];
        
        ?>
          <tr>
            <td><?php echo $t; ?></td>
            <?php /*
            <td>Rp. <?php echo format_rupiah($datatea["total"]); ?></td>
            <td>Rp. <?php echo format_rupiah($datatea["diskon"]); ?></td>
            */ ?>
            <td>Rp. <?php echo format_rupiah($bersih); ?></td>
            <td>Rp. <?php echo format_rupiah(($bersih-$data["beli"])); ?></td>
          </tr>
        <?php
        }
      

      ?>
      </tbody>
    </table>
  </div>
</body>
</html>