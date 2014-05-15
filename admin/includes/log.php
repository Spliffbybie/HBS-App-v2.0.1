<?php

//login status session 
	require_once('../Connections/db_link.php');
	$name = $_SESSION['MM_Username'];
	mysql_select_db($datbase_db_link, $db_link);
  	
  	$id_query="SELECT admin_id, login_alias, User_type FROM sys_admins WHERE login_alias = '$name' ";
    $id_rs = mysql_query($id_query, $db_link) or die(mysql_error());
  	$idFoundUser = mysql_fetch_assoc($id_rs);
	$id = $idFoundUser['admin_id']; $_SESSION['id'] = $id; 
	$date = date("Y m d H i s"); $ip = $_SERVER['REMOTE_ADDR']; $agent = $_SERVER['HTTP_USER_AGENT']; 
	$ref = $_SERVER['HTTP_REFERER'];

//check if admin already login
 	$check_status = "SELECT login_status FROM admin_log WHERE admin_id = '$id' LIMIT 1";
	$run_check = mysql_query($check_status, $db_link) or die(mysql_error());
	$status_found = mysql_fetch_assoc($run_check);
	$totalRows_found = mysql_num_rows($run_check); 
	
	$status = $status_found['login_status'];
	
	 if ($totalRows_found == '0')
	 {
				$set_status = "INSERT INTO admin_log (admin_id, login_status, login_time, ip_address, user_agent, referer) VALUES ('$id', 1, '$date', '$ip', '$agent', '$ref')";
	
			$run = mysql_query($set_status, $db_link) or die(mysql_error());
		}
	
	if ($status == '0')// && ($status = NULL))
	{
			$set_status = "INSERT INTO admin_log (admin_id, login_status, login_time, ip_address, user_agent, referer) VALUES ('$id', 1, '$date', '$ip', '$agent', '$ref')";
	
			$run = mysql_query($set_status, $db_link) or die(mysql_error());
	}

	if ($status == '1')
		{
			$update_status = "UPDATE admin_log SET login_status = '0', logout_time = '$date' WHERE login_status = '1' AND admin_id = '$id' LIMIT 1";
	
			$run = mysql_query($update_status, $db_link) or die(mysql_error());
		}
?>
