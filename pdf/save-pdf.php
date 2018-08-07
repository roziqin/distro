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
  $alamat=$data4['options_alamat'];
  $telepon=$data4['options_telepon'];

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
<div style="display: block; text-align: center;"><img src="../'.$logo.'" style=" width: 100px;"></div>
<table  width="100%" border="0"  style="font-size: 16px;"">
  <tr>
    <th colspan="4" align="center">'.$alamat.'</th>
  </tr>
  <tr>
    <th colspan="4" align="center">Tlp '.$telepon.'</th>
  </tr>
  <tr>
    <th colspan="4" align="center">'.$tgl.' - '.$wkt.'</th>
  </tr>
  <tr>
    <td width="60">Pelanggan</td>
    <td width="10">:</td>
    <td >'.$pelanggan.'</td>
    <td  align="right">D - '.$idmember.'</td>
  </tr>
  <tr>
    <td>Kasir</td>
    <td>:</td>
    <td>'.$us.'</td>
    <td  align="right">'.$t.'</td>
  </tr>
  <tr>
    <td colspan="4"><hr></td>
  </tr>
</table>
<table width="100%" border="0"  style="font-size: 16px;">
  <tr>
    <td align="center">Barang</td>
    <td width="24" align="center">Jml.</td>
    <td width="60" align="center">Harga</td>
    <td width="60" align="center">Subtotal</td>
  </tr>';
	$no=1;
    $sql="SELECT * from transaksi,transaksi_detail,barang,member, subcategory, category WHERE transaksi_id=transaksi_detail_no_nota and transaksi_detail_barang_id=barang_id and transaksi_member=member_id and barang_subcategory=subcategory_id and subcategory_parent=category_id and transaksi_id='$t'";
    $query=mysql_query($sql);
    while ($data=mysql_fetch_array($query)) {
      
		  
      $barang=$data['barang_nama'];
      $jumlah=$data['transaksi_detail_jumlah'];
      $diskon=$data['transaksi_detail_diskon'];
      $harga=$data['transaksi_detail_harga_jual'];
      $tot=$jumlah*$harga;
      $tran_tot = $data['transaksi_total'] - $data['transaksi_diskon'];
      $bayar = $data['transaksi_bayar'];
      $kembalian = $bayar - $tran_tot;

     $html.='

      <tr>
        <td>'.$data["category_nama"].' '.$data["subcategory_nama"].' '.$barang.' size '.$data["barang_size"].'</td>
        <td align="center">'.$jumlah.'</td>
        <td align="right">'.format_rupiah($harga).'</td>
        <td align="right">'.format_rupiah($tot).'</td>
      </tr>
      ';
	if ($diskon!=0) {
        # code...
	$html.='

      <tr>
        <td></td>
        <td align="center">Diskon</td>
        <td align="right"></td>
        <td align="right" style="font-size: 16px;"">'.format_rupiah($diskon).'</td>
      </tr>
      ';

    }
      
    $no=$no+1;
    }

    $html.='

      <tr>
	    <td colspan="4"><hr color="black"></td>
	  </tr>
	 
	  <tr>
	    <th align="left" scope="row" colspan="2">Total</th>
	    <td align="right">: Rp.</td>
	    <td align="right">'.format_rupiah($tran_tot).'</td>
	  </tr>
	  <tr>
	    <th align="left" scope="row" colspan="2">Bayar</th>
	    <td align="right">: Rp.</td>
	    <td align="right">'.format_rupiah($bayar).'</td>
	  </tr>
	  <tr>
	    <th align="left" scope="row" colspan="2">Kembalian</th>
	    <td align="right">: Rp.</td>
	    <td align="right">'.format_rupiah($kembalian).'</td>
	  </tr>
	  <tr>
	    <th align="left" scope="row" colspan="2">Pembayaran</th>
	    <td align="left">&nbsp;</td>
	    <td align="right">'.$type.'</td>
	  </tr>
	  <tr>
	    <td colspan="4" align="center">BARANG YANG SUDAH DIBELI<br>TIDAK DAPAT DIKEMBALIKAN<br>TERIMA KASIH</td>
	  </tr>
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
$dompdf->stream("nota-".$tanggal."-".$pelanggan.".pdf", array("Attachment"=>0));

?>

<script type="text/javascript">
  window.setTimeout(function() {
    window.close();
  },1000)
</script>