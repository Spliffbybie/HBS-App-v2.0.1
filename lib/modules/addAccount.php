<?php
 require_once('../../Connections/db_link.php');

	
	function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
{
  $theValue = (!get_magic_quotes_gpc()) ? addslashes($theValue) : $theValue;

  switch ($theType) {
    case "text":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;    
    case "long":
    case "int":
      $theValue = ($theValue != "") ? intval($theValue) : "NULL";
      break;
    case "double":
      $theValue = ($theValue != "") ? "'" . doubleval($theValue) . "'" : "NULL";
      break;
    case "date":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;
    case "defined":
      $theValue = ($theValue != "") ? $theDefinedValue : $theNotDefinedValue;
      break;
  }
  return $theValue;
}

 $editFormAction = $_SERVER['PHP_SELF'];

	if (isset($_SERVER['QUERY_STRING'])) {
   
   $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

	if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "acc")) {
	
	if ((isset($_POST["accType"])) && ($_POST["accType"] == "Limited")){
 
  $insertSQL = sprintf("INSERT INTO sys_users (First_name, Last_name, Email, login_alias, login_password, User_type) VALUES (%s, %s, %s, %s, md5(%s), %s)",
                       GetSQLValueString($_POST['firstname'], "text"),
                       GetSQLValueString($_POST['lastname'], "text"),
					   GetSQLValueString($_POST['email'], "text"),
                       GetSQLValueString($_POST['alias'], "text"),
                       GetSQLValueString($_POST['conPassword'], "text"),
                       GetSQLValueString($_POST['accType'], "text"));

  mysql_select_db($database_db_link, $db_link);
  $Result1 = mysql_query($insertSQL, $db_link) or die(mysql_error());

  $insertGoTo = "useraccounts.php";
  
  if (isset($_SERVER['QUERY_STRING'])) {
  
    $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
    $insertGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $insertGoTo));

	}
	else {
	
	$insertSQL = sprintf("INSERT INTO sys_admins (First_name, Last_name, Email, login_alias, login_password, User_type) VALUES (%s, %s, %s, %s, md5(%s), %s)",
                       GetSQLValueString($_POST['firstname'], "text"),
                       GetSQLValueString($_POST['lastname'], "text"),
					   GetSQLValueString($_POST['email'], "text"),
                       GetSQLValueString($_POST['alias'], "text"),
                       GetSQLValueString($_POST['conPassword'], "text"),
                       GetSQLValueString($_POST['accType'], "text"));

  mysql_select_db($database_db_link, $db_link);
  $Result1 = mysql_query($insertSQL, $db_link) or die(mysql_error());

  $insertGoTo = "useraccounts.php";
  if (isset($_SERVER['QUERY_STRING'])) {
  
    $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
    $insertGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $insertGoTo));
	}
}
?>
<form name="acc" method="POST" action="<?php echo $editFormAction; ?>">

  <table border="0" width="652px">
    <tr>
       <th colspan="2"><img src="../../lib/images/addaccount.png">Account Details</th>
    </tr> 
      <tr>
        <td width="187"><div align="right">First Name</div></td>
         <td width="445">
          <input type="text" name="firstname">         </td>
		 <tr>
	    <td><div align="right">Last Name</div></td>
		<td><input type="text" name="lastname"></td>
		</tr>
		 <tr>
		   <td align="right">Email</td>
		   <td><input type="text" name="email"></td>
		   </tr>
		 <tr>
      	<td><div align="right">Login Alias</div></td>
		<td><input type="text" name="alias"></td>
		</tr>
		<tr>
		<td><div align="right">Password</div></td>
		<td><input type="password" name="password"></td>
		</tr>
		<tr>
		<td><div align="right">Confirm Passwrod</div></td>
		<td><input type="password" name="conPassword"></td>
   	      </tr>
     	<tr><td><div align="right">Account Type</div></td>
		<td><select name="accType"><option>Administrator</option><option>Limited</option></select></td>
		</tr>
		<tr><td><input name="add" type="submit" value="Add Account"></td></tr>
		</table>
  <input type="hidden" name="MM_insert" value="acc">
</form>