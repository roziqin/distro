
<?php
 
      $query = "SELECT * FROM category";
      $rs = mysql_query($query) or die(mysql_error());
      $cbstr = "";
      while ($r = mysql_fetch_array($rs))
      {
      	$cbstr .= "<option value='$r[category_id]'>$r[category_nama]</option>";
      }
?>
<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
    	Tambah Barang
      </h1>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">

		<div class="box-body">
		    <form action="aksi/barang.aksi.php" method="post">
			    <div class="form-group">
			    	<label>Barcode Barang</label>
			      <input type="text" name="barcode" class="form-control" placeholder="Barcode Barang">
			    </div>
			    <div class="form-group">
			    	<label>Nama Barang</label>
			      <input type="text" name="nama" class="form-control" placeholder="Nama Barang">
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
			        <div id="subcategory"></div>
			    </div>
			    <div class="form-group">
			    	<label>Harga Beli</label>
			      <input type="text" name="hargabeli" class="form-control" placeholder="Harga Beli" id="price">
			    </div>
			    <div class="form-group">
			    	<label>Harga Jual</label>
			      <input type="text" name="hargajual" class="form-control" placeholder="Harga Jual" id="price1">
			    </div>
			    <div class="form-group">
			    	<label>Stok</label>
			      <input type="text" name="stok" class="form-control" placeholder="Stok">
			    </div>
			    <div class="form-group">
			    	<label>Batas Stok</label>
			      <input type="text" name="batasstok" class="form-control" placeholder="Batas Stok">
			    </div>
			    <div class="form-group" id="box-add" style="width: 100%; display: inline-block;">
			    	<label>Type Barang</label>
			        <select name="type" class="form-control" id="jenis" onchange='javascript:displayvariable(this)'>
			                <option value="simple">Simple</option>
			                <option value="variable">Variable</option>
		            </select>
		        
			    </div>
			    <div class="form-group hidden" id="variable" style="width: 100%; display: inline-block;">
			    	<div class="col-md-12 col-md-offset-0"  style="padding: 0px; display: inline-block;">
				    	<label>Variable Barang</label>
				    </div>
			    	<div class="col-md-6 col-md-offset-0" style="padding: 0px; display: inline-block;">
				        <select name="variable" class="form-control" id="jenis" onchange='javascript:displaysize(this)'>
				                <option value="">Pilih Variable</option>
				                <option value="angka">Angka</option>
				                <option value="huruf">Huruf</option>
			            </select>
			        </div>
			    	<div class="col-md-6 col-md-offset-0 hidden" id="angka" style="padding-right: 0px; min-height: 34px; display: inline-block;">
			        	<select name="angka" class="form-control">
				                <option value="">Pilih Size</option>
				                <option value="25">25</option>
				                <option value="26">26</option>
				                <option value="27">27</option>
				                <option value="28">28</option>
				                <option value="29">29</option>
				                <option value="30">30</option>
				                <option value="31">31</option>
				                <option value="32">32</option>
				                <option value="33">33</option>
				                <option value="34">34</option>
				                <option value="35">35</option>
				                <option value="36">36</option>
				                <option value="37">37</option>
				                <option value="38">38</option>
				                <option value="39">39</option>
				                <option value="40">40</option>
				                <option value="41">41</option>
				                <option value="42">42</option>
				                <option value="43">43</option>
			            </select>
			        </div>
			        <div class="col-md-6 col-md-offset-0 hidden" id="huruf" style="padding-right: 0px; min-height: 34px; display: inline-block;">
			        	<select name="huruf" class="form-control">
				                <option value="">Pilih Size</option>
				                <option value="XS">XS</option>
				                <option value="S">S</option>
				                <option value="M">M</option>
				                <option value="L">L</option>
				                <option value="XL">XL</option>
				                <option value="XXL">XXL</option>
			            </select>
			        </div>
			    </div>
			    <div class="form-group" style="display: inline-block; width: 100%;">
			    	<div class="col-md-6 col-md-offset-0" id="" style="padding-left: 0px; display: inline-block;">
				    	<label>Diskon (%)</label>
				    	<input type="text" name="diskon" class="form-control" placeholder="%">
				    </div>
			    	<div class="col-md-6 col-md-offset-0" id="" style="padding: 0px; display: inline-block;">
			        	<label>Keterangan Barang</label>
			        	<select name="keterangan" class="form-control">
				                <option value="">Pilih Keterangan</option>
				                <option value="sendiri">Produksi Sendiri</option>
				                <option value="titipan">Titipan</option>
			            </select>
			        </div>
			    </div>
			    <div class="form-group">
			      <input type="submit" class="btn btn-primary" value="save" name="tambah">
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