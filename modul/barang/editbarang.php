
<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
    	Edit Barang
      </h1>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">

		<div class="box-body">
			<?php

			$id = $_GET['id'];
			$sqlte1="SELECT * from barang, subcategory where barang_subcategory=subcategory_id and barang_id='$id'";
			$queryte1=mysql_query($sqlte1);
			$datatea=mysql_fetch_array($queryte1);
			$idsub = $datatea['subcategory_parent'];
			$idsub1 = $datatea['barang_subcategory'];
			
			$query = "SELECT * FROM category";
			$rs = mysql_query($query) or die(mysql_error());
			$cbstr = "";
			while ($r = mysql_fetch_array($rs))
			{
				if ($idsub==$r['category_id']) {
					# code...
					$select = "selected";
				} else {
					# code...
					$select='';
				}
				
				$cbstr .= "<option value='$r[category_id]' $select >$r[category_nama]</option>";
			}


			$query1 = "SELECT * FROM subcategory where subcategory_parent='$idsub'";
			$rs1 = mysql_query($query1) or die(mysql_error());
			$cbstr1 = "";
			while ($r1 = mysql_fetch_array($rs1))
			{
				if ($idsub1==$r1['subcategory_id']) {
					# code...
					$select1 = "selected";
				} else {
					# code...
					$select1='';
				}
				
				$cbstr1 .= "<option value='$r1[subcategory_id]' $select1 >$r1[subcategory_nama]</option>";
			}

			?>
		    <form action="aksi/barang.aksi.php" method="post">
			    <div class="form-group">
					<label>Barcode Barang</label>
			      	<input type="hidden" name="id" value="<?php echo $datatea['barang_barcode'] ; ?>">
			      	<input type="text" name="barcode" class="form-control" placeholder="Nama Barang" value="<?php echo $datatea['barang_barcode'] ; ?>">
			    </div>
			    <div class="form-group">
					<label>Nama Barang</label>
			      	<input type="hidden" name="id" value="<?php echo $datatea['barang_id'] ; ?>">
			      	<input type="text" name="nama" class="form-control" placeholder="Nama Barang" value="<?php echo $datatea['barang_nama'] ; ?>">
			    </div>
			    <div class="form-group">
			    	<label>Category</label>
			        <select name="category" class="form-control" id="category" onchange='javascript:rubah(this)'>
			                <option value="">-- Pilih Category --</option>
			                <?php echo $cbstr; ?>
		            </select>
			    </div>
			    <div class="form-group">
			    	<label>Sub Category</label>
			        <div id="subcategory">
			        	<select name='subcategory' class='form-control'>
			        		<?php echo $cbstr1; ?>
			        	</select>
			        </div>
			    </div>
			    <div class="form-group">
					<label>Harga Beli</label>
			      <input type="text" name="hargabeli" class="form-control" placeholder="Harga Beli" id="price" value="<?php echo $datatea['barang_harga_beli'] ; ?>">
			    </div>
			    <div class="form-group">
					<label>Harga Jual</label>
			      <input type="text" name="hargajual" class="form-control" placeholder="Harga Jual" id="price1" value="<?php echo $datatea['barang_harga_jual'] ; ?>">
			    </div>
			    <div class="form-group">
					<label>Stok</label>
			      <input type="text" name="stok" class="form-control" placeholder="Stok" value="<?php echo $datatea['barang_stok'] ; ?>">
			    </div>
			    <div class="form-group">
					<label>Batas Stok</label>
			      <input type="text" name="batasstok" class="form-control" placeholder="Batas Stok" value="<?php echo $datatea['barang_batas_stok'] ; ?>">
			    </div>
			    <div class="form-group" id="box-add" style="width: 100%; display: inline-block;">
			    	<label>Type Barang</label>
			        <select name="type" class="form-control" id="jenis" onchange='javascript:displayvariable(this)'>
			        	<?php
			        		$simple="";
			        		$variable="";
			        		$ketvariable="hidden";
			        		if ($datatea['barang_type']=="simple") {
			        			# code...
			        			$simple = "selected";
			        		} else {
			        			# code...
			        			$variable = "selected";
			        			$ketvariable = "";
			        		}
			        		
			        	?>
			                <option value="simple" <?php echo $simple; ?> >Simple</option>
			                <option value="variable" <?php echo $variable; ?> >Variable</option>
		            </select>
		        
			    </div>
			    <div class="form-group <?php echo $ketvariable; ?>" id="variable" style="width: 100%; display: inline-block;">
			    	<div class="col-md-12 col-md-offset-0"  style="padding: 0px; display: inline-block;">
				    	<label>Variable Barang</label>
				    </div>
			    	<div class="col-md-6 col-md-offset-0" style="padding: 0px; display: inline-block;">
				        <select name="variable" class="form-control" id="jenis" onchange='javascript:displaysize(this)'>
				        	<?php
				        		$huruf="";
				        		$angka="";
				        		$kethuruf="hidden";
				        		$ketangka="hidden";
				        		if ($datatea['barang_variable']=="huruf") {
				        			# code...
				        			$huruf = "selected";
				        			$kethuruf = "";
				        		} else {
				        			# code...
				        			$angka = "selected";
				        			$ketangka = "";
				        		}
				        		
				        	?>
				                <option value="">Pilih Variable</option>
				                <option value="angka" <?php echo $angka; ?> >Angka</option>
				                <option value="huruf" <?php echo $huruf; ?> >Huruf</option>
			            </select>
			        </div>
			    	<div class="col-md-6 col-md-offset-0 <?php echo $ketangka; ?>" id="angka" style="padding-right: 0px; min-height: 34px; display: inline-block;">
			        	<select name="angka" class="form-control">
				                <option value="">Pilih Size</option>
				                <?php
				                $select1="";
				                $angkavalue = array("25", "26", "27","28", "29", "30", "31", "32", "33", "34", "35", "36", "37", "38", "39", "40", "41", "42", "43");
				                for ($i=0; $i < count($angkavalue); $i++) { 
				                	# code...
				                	if ($datatea["barang_size"]==$angkavalue[$i]) {
				                		# code...
				                		$select1 = "selected";
				                	} else {
				                		# code...
				                		$select1 = "";
				                	}
				                	echo "<option value='$angkavalue[$i]' $select1>$angkavalue[$i]</option>";
				                	

				                }
				                ?>
			            </select>
			        </div>
			        <div class="col-md-6 col-md-offset-0 <?php echo $kethuruf; ?>" id="huruf" style="padding-right: 0px; min-height: 34px; display: inline-block;">
			        	<select name="huruf" class="form-control">
				                <option value="">Pilih Size</option>
				                <?php
				                $select1="";
				                $angkavalue = array("XS","S", "M", "L", "XL", "XXL");
				                for ($i=0; $i < count($angkavalue); $i++) { 
				                	# code...
				                	if ($datatea["barang_size"]==$angkavalue[$i]) {
				                		# code...
				                		$select1 = "selected";
				                	} else {
				                		# code...
				                		$select1 = "";
				                	}
				                	echo "<option value='$angkavalue[$i]' $select1>$angkavalue[$i]</option>";
				                	

				                }
				                ?>
			            </select>
			        </div>
			    </div>
			    <div class="form-group" style="display: inline-block; width: 100%;">
			    	<div class="col-md-6 col-md-offset-0" id="" style="padding-left: 0px; display: inline-block;">
				    	<label>Diskon (%)</label>
					    <input type="text" name="diskon" class="form-control" placeholder="%" value="<?php echo $datatea['barang_diskon'] ; ?>">
				    </div>
			    	<div class="col-md-6 col-md-offset-0" id="" style="padding: 0px; display: inline-block;">
			        	<label>Keterangan Barang</label>
			        	<?php
			        	$s1 = "";
			        	$s2 = "";
			        	$s3 = "";
			        	if ($datatea["barang_keterangan"]=="sendiri") {
	                		# code...
	                		$s1 = "selected";

	                	} elseif ($datatea["barang_keterangan"]=="titipan") {
	                		# code...
	                		$s2 = "selected";

	                	} else {
	                		# code...
	                		$s3 = "";
	                	}
			        	?>
			        	<select name="keterangan" class="form-control">
			                <option value="">Pilih Keterangan</option>
			                <option value="sendiri" <?php echo $s1; ?> >Produksi Sendiri</option>
			                <option value="titipan" <?php echo $s2; ?> >Titipan</option>
			            </select>
			        </div>
			    </div>
			    <div class="form-group">
			      <input type="submit" class="btn btn-primary" value="save" name="edit">
			    </div>
		    </form>
		</div>
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
<script type='text/javascript'>

function createRequestObject() {
    var ro;
    var browser = navigator.appName;
    if(browser == "Microsoft Internet Explorer"){
        ro = new ActiveXObject("Microsoft.XMLHTTP");
    }else{
        ro = new XMLHttpRequest();
    }
    return ro;
}
 
var xmlhttp = createRequestObject();
 
function rubah(combobox)
{
    var kode = combobox.value;
    if (!kode) return;
    xmlhttp.open('get', 'modul/barang/getdata.php?id='+kode, true);
    xmlhttp.onreadystatechange = function() {
        if ((xmlhttp.readyState == 4) && (xmlhttp.status == 200))
        {
             document.getElementById("subcategory").innerHTML = xmlhttp.responseText;
        }
        return false;
    }
    xmlhttp.send(null);
}
function displayvariable(combobox)
{
    var kode = combobox.value;
    if(kode=='variable') {
    	$('#variable').removeClass('hidden');
    } else {
    	$('#variable').addClass('hidden');

    }
}
function displaysize(combobox)
{
    var kode = combobox.value;
    if(kode=='angka') {
    	$('#angka').removeClass('hidden');
    	$('#huruf').addClass('hidden');
    } else if(kode=='huruf') {
    	$('#huruf').removeClass('hidden');
    	$('#angka').addClass('hidden');
    } else {
    	$('#angka').addClass('hidden');
    	$('#huruf').addClass('hidden');

    }
}

$("#addvariable").click(function(ev){
	ev.preventDefault();
	console.log("add");
});
 
</script>