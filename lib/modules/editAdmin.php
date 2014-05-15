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

/*
********************************************
*display account details
********************************************
*/
$id = $_GET['aid']; $ut = $_GET['ut']; 

	if ((isset($_GET['ut'])) && ($ut == "Administrator")){

 mysql_select_db($database_db_link, $db_link);

 $sql_acc = "SELECT First_name, Last_name, Email, login_alias FROM sys_admins WHERE admin_id = '$id' LIMIT 1";
 $accinfo = mysql_query($sql_acc, $db_link) or die(mysql_error());
 $row_accinfo = mysql_fetch_assoc($accinfo);
}

/*
********************************************
*edit account details
********************************************
*/
$editFormAction = $_SERVER['PHP_SELF'];
	if (isset($_SERVER['QUERY_STRING'])) 
	{
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

	if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "updateAcc")) 
	{
	$MM_redirectSuccess = "useraccounts.php";
  $updateSQL = sprintf("UPDATE sys_admins SET First_name=%s, Last_name=%s, Email=%s, login_alias=%s, User_type=%s WHERE admin_id = '$id' LIMIT 1",
  						GetSQLValueString($_POST['firstname'], "text"),
  						GetSQLValueString($_POST['lastname'], "text"),
						GetSQLValueString($_POST['email'], "text"),
						GetSQLValueString($_POST['alias'], "text"),
                       	GetSQLValueString($_POST['accType'], "text"));

  mysql_select_db($database_db_link, $db_link);
  $Result1 = mysql_query($updateSQL, $db_link) or die(mysql_error());
	 header("Location: ". $MM_redirectSuccess );
	}
	
/*
********************************************
*edit Password details
********************************************
*/
$editPassword = $_SERVER['PHP_SELF'];
	if (isset($_SERVER['QUERY_STRING'])) 
	{
  $editPassword .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

	if ((isset($_POST["MM_newpswd"])) && ($_POST["MM_newpswd"] == "newpswd")) 
	{

//validate current password and update new password
	if ((isset($_POST["newPassword"])) && ($_POST["confirmPassword"] == $_POST["newPassword"]))
	 {
	$oldp = md5($_POST['oldPassword']); $MM_redirectSuccess = "useraccounts.php";
  $updateSQL = sprintf("UPDATE sys_admins SET login_password=md5(%s) WHERE admin_id = '$id' AND login_password ='$oldp' LIMIT 1",
  							GetSQLValueString($_POST['confirmPassword'], "text"));

  mysql_select_db($database_db_link, $db_link);
  $Result1 = mysql_query($updateSQL, $db_link) or die(mysql_error());
  header("Location: ". $MM_redirectSuccess );
	}
	}
?>
<form name="editacc" method="POST" action="<?php echo $editFormAction; ?>">

  <table border="0" width="652px">
    <tr>
       <th colspan="2"><img src="../../lib/images/editaccount.png">Edit Account Details</th>
    </tr> 
      <tr>
        <td width="187"><div align="right">First Name</div></td>
         <td width="445">
          <input value="<?php echo $row_accinfo['First_name']; ?>" type="text" name="firstname">         </td>
		 <tr>
	    <td><div align="right">Last Name</div></td>
		<td><input value="<?php echo $row_accinfo['Last_name']; ?>" type="text" name="lastname"></td>
		</tr>
		 <tr>
		   <td align="right">Email</td>
		   <td><input value="<?php echo $row_accinfo['Email']; ?>" type="text" name="email"></td>
		   </tr>
		<tr>
      	<td><div align="right">Login Alias</div></td>
		<td><input value="<?php echo $row_accinfo['login_alias']; ?>" type="text" name="alias"></td>
		</tr>
		
     	<tr><td><div align="right">Account Type</div></td>
		<td><select name="accType"><option>Administrator</option><option>Limited</option></select></td>
		</tr>
		<tr><td><input name="add" type="submit" value="Update Account"></td></tr>
		<input type="hidden" name="MM_update" value="updateAcc">
		 </table></form>
		
		  <form name="editpwd" method="POST" action="<?php echo $editPassword; ?>">
		 <table border="0" width="652px">
		<tr><th colspan="2">Change Password</th></tr>
		<tr>
		<td width="190"><div align="right">Old Password</div></td>
		<td width="444"><input type="password" name="oldPassword"></td>
		</tr>
		<tr>
		<td><div align="right">New Password</div></td>
		<td><input type="password" name="newPassword"></td>
		</tr>
		<tr>
		<td><div align="right">Confirm Passwrod</div></td>
		<td><input type="password" name="confirmPassword"></td>
   	      </tr>
		  <tr><td><input name="updatePassword" type="submit" value="Change Password"></td></tr>	
			<input type="hidden" name="MM_newpswd" value="newpswd">
	</table>
</form>