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
    <th colspan="4">Laporan Harian</th>
  </tr>
  <tr>
    <th colspan="4">'.$_GET['tanggal'].' - '.$wkt.'</th>
  </tr>
  <tr>
    <td colspan="4"><hr></td>
  </tr>
</table>
<table id="laporan" width="100%" border="1" style="border-spacing: 0;" class="table table-bordered table-striped">
<thead>
<tr>
  <td>Tanggal</td>
  <td>Jumlah Transaksi</td>
  <td>Omset</td>
  <td>Diskon</td>
  <td>Debet</td>
  <td>Offline</td>
  <td>Online</td>
  <td>Reseller</td>
</tr>
</thead>
<tbody>';



  $text_line = explode(":",$_GET['tanggal']);
  $tgl1=$text_line[0];
  $tgl2=$text_line[1];

  $query=mysql_query("SELECT transaksi_tanggal,count(transaksi_id) as jumlah, sum(transaksi_total) as total, sum(transaksi_diskon) as diskon from transaksi where transaksi_tanggal between '$tgl1' and '$tgl2' group by transaksi_tanggal order by transaksi_tanggal ASC");
  while ($datatea=mysql_fetch_array($query)) {

    $tgl = $datatea["transaksi_tanggal"];
    $query1=mysql_query("SELECT count(transaksi_id) as jumlah, sum(transaksi_total) as total, sum(transaksi_diskon) as diskon from transaksi where transaksi_tanggal='$tgl' and transaksi_status='1' group by transaksi_tanggal ");
    $datadebet=mysql_fetch_array($query1);
    $omsetdebet = $datadebet['total']-$datadebet['diskon'];

    $query2=mysql_query("SELECT count(transaksi_id) as jumlah, sum(transaksi_total) as total, sum(transaksi_diskon) as diskon from transaksi where transaksi_tanggal='$tgl' and transaksi_status_jual='offline' group by transaksi_tanggal ");
    $dataoffline=mysql_fetch_array($query2);
    $omsetoffline = $dataoffline['total']-$dataoffline['diskon'];

    $query3=mysql_query("SELECT count(transaksi_id) as jumlah, sum(transaksi_total) as total, sum(transaksi_diskon) as diskon from transaksi where transaksi_tanggal='$tgl' and transaksi_status_jual='online' group by transaksi_tanggal ");
    $dataonline=mysql_fetch_array($query3);
    $omsetonline = $dataonline['total']-$dataonline['diskon'];

    $query4=mysql_query("SELECT count(transaksi_id) as jumlah, sum(transaksi_total) as total, sum(transaksi_diskon) as diskon from transaksi where transaksi_tanggal='$tgl' and transaksi_status_jual='reseller' group by transaksi_tanggal ");
    $datareseller=mysql_fetch_array($query4);
    $omsetreseller = $datareseller['total']-$datareseller['diskon'];
  $html.='
    <tr>
      <td>'.$datatea["transaksi_tanggal"].'</td>
      <td>'.$datatea["jumlah"].'</td>
      <td>'.format_rupiah($datatea["total"]-$datatea["diskon"]).'</td>
      <td>'.format_rupiah($datatea["diskon"]).'</td>
      <td>'.format_rupiah($omsetdebet).'</td>
      <td>'.format_rupiah($omsetoffline).'</td>
      <td>'.format_rupiah($omsetonline).'</td>
      <td>'.format_rupiah($omsetreseller).'</td>
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
$dompdf->stream("laporan_harian-".$tgl.".pdf", array("Attachment"=>0));

?>

<script type="text/javascript">
  window.setTimeout(function() {
    window.close();
  },1000)
</script>