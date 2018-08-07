<?php
$html='';
session_start();
include"../include/koneksi.php";
include "../include/fungsi_rupiah.php";
   date_default_timezone_set('Asia/jakarta');
$tgl=date('Y-m-j');
$wkt=date('G:i:s');

$aid = $_SESSION['login_user'];
$aa = "select * from users where id='$aid'";
  $bb = mysql_query($aa) or die(mysql_error());
  $cc = mysql_fetch_array($bb);
  $id=$cc['name'];
  $iduser=$cc['id'];
  

$sql4 = "SELECT * from options LIMIT 1";
  $query4 = mysql_query($sql4) or die(mysql_error());
  $data4 = mysql_fetch_array($query4);
  $logo=$data4['options_logo'];
  $logo=$data4['options_logo'];
  $logo=$data4['options_logo'];
    

      $t = $_SESSION['no-nota'];
    $sql="SELECT * from transaksi, member where transaksi_member=member_id and transaksi_id='$t' ";
    $query=mysql_query($sql);
    while ($data=mysql_fetch_array($query)) {
      $pelanggan=$data['member_nama'];
      $idmember=$data['member_id'];
      $type=$data['transaksi_status'];
      $iduser=$data['transaksi_user'];
      if ($type==0) {
        # code...
        $type='Cash';
      } else {
        $type='Debet';
      }
      $tanggal = $data['transaksi_tanggal'];
    }

  $sql1 = mysql_query("SELECT * from users where id='$iduser'");
  $data1 = mysql_fetch_array($sql1);
  $us=$data1['name'];

$html.='
  <div class="wrapper">

<table  width="100%" border="0"  style="font-size: 16px;"">
  <tr>
    <th colspan="4">Laporan Bulanan</th>
  </tr>
  <tr>
    <th colspan="4">'.$tgl.' - '.$wkt.'</th>
  </tr>
  <tr>
    <td colspan="4"><hr></td>
  </tr>
</table>
<table id="laporan" width="100%" border="1" style="border-spacing: 0;" class="table table-bordered table-striped">
<thead>
<tr>
  <td>Bulan</td>
  <td>Omset Bersih</td>
  <td>Laba</td>
</tr>
</thead>
<tbody>';




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


  $laba = $bersih-$data["beli"]-$data2["options_gaji"]-$data2["options_promo"]-$data2["options_sewa"]-$data2["options_event"]-$bonus-$data2["options_lain"];
  $html.='
    <tr>
      <td>'.$t.'</td>
      <td>'.format_rupiah(($bersih-$data["beli"])).'</td>
      <td>'.format_rupiah($laba).'</td>
    </tr>';

  }

$html .'=</tbody>
</table>
  </div>
    ';

require_once 'dompdf/lib/html5lib/Parser.php';
require_once 'dompdf/lib/php-font-lib/src/FontLib/Autoloader.php';
require_once 'dompdf/lib/php-svg-lib/src/autoload.php';
require_once 'dompdf/src/Autoloader.php';
Dompdf\Autoloader::register();


// reference the Dompdf namespace
use Dompdf\Dompdf;

// instantiate and use the dompdf class
$dompdf = new Dompdf();
$dompdf->loadHtml($html);

// (Optional) Setup the paper size and orientation
$dompdf->setPaper('A4', 'landscape');

// Render the HTML as PDF
$dompdf->render();

// Output the generated PDF to Browser
$dompdf->stream("laporan_bulanan-".$tgl.".pdf", array("Attachment"=>0));

?>

<script type="text/javascript">
  window.setTimeout(function() {
    window.close();
  },1000)
</script> 