<?php
session_start();
include "koneksi.php";

$user_check=$_SESSION['login_user'];

$ses_sql=mysql_query("select user_nama from user where user_id='$user_check' ");

$row=mysql_fetch_array($ses_sql,MYSQLI_ASSOC);

$login_session=$row['user_nama'];

if(!isset($login_session))
{
header("Location: ../login.php");
}
?>