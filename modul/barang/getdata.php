<?php
session_start();
include "../../include/koneksi.php";
$id = $_GET['id'];
 
echo "<select name='subcategory' class='form-control'>";
 
$rs = mysql_query ("SELECT * FROM subcategory WHERE subcategory_parent='$id'");
while ($r = mysql_fetch_array($rs))
    echo "<option value='$r[subcategory_id]'>$r[subcategory_nama]</option>";
echo "</select>";
 
?>