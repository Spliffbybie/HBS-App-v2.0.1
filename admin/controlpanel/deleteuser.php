<?php
 require_once('../../Connections/db_link.php'); 

 require_once('../includes/checkaccess.php');

$id = $_GET['id']; $ut = $_GET['ut']; 
 
 if ((isset($_GET['ut'])) && ($ut == "Administrator")){
 
 $MM_redirectSuccess = "deleteaccount.php";
 mysql_select_db($database_db_link, $db_link);
 $query_admins = "DELETE FROM sys_admins WHERE admin_id = '$id' LIMIT 1";
 $admins = mysql_query($query_admins, $db_link) or die(mysql_error());
  header("Location: ". $MM_redirectSuccess );
  exit;
 }
 
 elseif ((isset($_GET['ut'])) && ($ut == "Limited")){
 
 $MM_redirectSuccess = "deleteaccount.php";
 mysql_select_db($database_db_link, $db_link);
 $query_users = "DELETE FROM sys_users WHERE User_id ='$id' LIMIT 1";
 $users = mysql_query($query_users, $db_link) or die(mysql_error());
  header("Location: ". $MM_redirectSuccess );
	exit; 
 }
?>