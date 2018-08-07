<?php
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
       


$sql4 = "SELECT * from options LIMIT 1";
  $query4 = mysql_query($sql4) or die(mysql_error());
  $data4 = mysql_fetch_array($query4);
  $logo=$data4['options_logo'];
  $alamat=$data4['options_alamat'];
  $telepon=$data4['options_telepon'];
    

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<link rel="stylesheet" href="../style-print.css">
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<!-- Print style -->
<link rel="stylesheet" href="dist/css/print.css">
<script type="text/javascript">
  window.setTimeout(function() {
    window.close();
  },1000)
</script>
</head>

<body onLoad="window.print()" style="
  font-family: 'Merchant Copy'; font-size: 13px;">
    <div class="wrapper">
<img src="../<?php echo $logo; ?>" style=" width: 100px;
    margin: 0 auto 10px;
    display: block;">
<table  width="100%" border="0"  style='font-size: 16px;'>
  <tr>
    <th colspan="4"><?php echo $alamat; ?></th>
  </tr>
  <tr>
    <th colspan="4">Tlp <?php echo $telepon; ?></th>
  </tr>
  <tr>
    <th colspan="4"><?php echo $tgl." - ".$wkt; ?></th>
  </tr>
  <tr>
    <td width="60">Pelanggan</td>
    <td width="10">:</td>
    <td ><?php echo $pelanggan;?></td>
    <td  align="right">D - <?php echo $idmember; ?></td>
  </tr>
  <tr>
    <td>Kasir</td>
    <td>:</td>
    <td><?php echo $us;?></td>
    <td  align="right"><?php echo $t; ?></td>
  </tr>
  <tr>
    <td colspan="4"><hr></td>
  </tr>
</table>
<table width="100%" border="0"  style='font-size: 16px;'>
  <tr>
    <td align="center">Barang</td>
    <td width="24" align="center">Jml.</td>
    <td width="60" align="center">Harga</td>
    <td width="60" align="center">Subtotal</td>
  </tr>
   <?php
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
      if ($data["transaksi_detail_keterangan"]=='') {
        # code...
        $ket="";
      } else {
        # code...
        $ket=" - ".$data["transaksi_detail_keterangan"];
      }

      echo "

      <tr>
        <td>".$data["category_nama"]." ".$data["subcategory_nama"]." ".$barang." size ".$data["barang_size"]."".$ket."</td>
        <td align='center'>".$jumlah."</td>
        <td align='right'>".format_rupiah($harga)."</td>
        <td align='right'>".format_rupiah($tot)."</td>
      </tr>
      ";
      if ($diskon!=0) {
        # code...
        echo "

      <tr>
        <td></td>
        <td align='center'>Diskon</td>
        <td align='right'></td>
        <td align='right' style='font-size: 16px;'>".format_rupiah($diskon)."</td>
      </tr>
      ";

      }
      
      $no=$no+1;
    }         
  ?>
  <tr>
    <td colspan="4"><hr color="black"></td>
  </tr>
 
  <tr>
    <th align="left" scope="row" colspan="2">Total</th>
    <td align="right">: Rp.</td>
    <td align="right"><?php echo format_rupiah($tran_tot) ; ?></td>
  </tr>
  <tr>
    <th align="left" scope="row" colspan="2">Bayar</th>
    <td align="right">: Rp.</td>
    <td align="right"><?php echo format_rupiah($bayar) ; ?></td>
  </tr>
  <tr>
    <th align="left" scope="row" colspan="2">Kembalian</th>
    <td align="right">: Rp.</td>
    <td align="right"><?php echo format_rupiah($kembalian) ; ?></td>
  </tr>
  <tr>
    <th align="left" scope="row" colspan="2">Pembayaran</th>
    <td align="left">&nbsp;</td>
    <td align="right"><?php echo $type ; ?></td>
  </tr>
  <tr>
    <th colspan="4">BARANG YANG SUDAH DIBELI<br>TIDAK DAPAT DIKEMBALIKAN<br>TERIMA KASIH</th>
  </tr>
</table>
</div>
</body>
</html>
