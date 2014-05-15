<?php
require_once('../AdminConnections/db_link.php'); 
require_once('../includes/checkaccess.php');

$fn =$_GET["fn"]; 
$ln =$_GET["ln"];
 
/*
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

	if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "AddGuest")) {
  
  $updateSQL = sprintf("UPDATE customers SET CustomerTitle=%s, Membership=%s, CustomerFName=%s, CustomerLName=%s, AddressTown=%s, AddressCountry=%s, AddressPostalCode=%s, PhoneNumber1=%s, PhoneNumber2=%s, CustomerEmail=%s, IdNumber=%s, IdType=%s, PlateNumber=%s WHERE CustomerId='$gno' LIMIT 1)",
                       GetSQLValueString($_POST['Title'], "text"),
                       GetSQLValueString($_POST['Membership'], "text"),
                       GetSQLValueString($_POST['FirstName'], "text"),
                       GetSQLValueString($_POST['LastName'], "text"),
                       GetSQLValueString($_POST['AddressTown'], "text"),
                       GetSQLValueString($_POST['Country'], "text"),
                       GetSQLValueString($_POST['AddressPostal'], "text"),
                       GetSQLValueString($_POST['PhoneNumber1'], "int"),
                       GetSQLValueString($_POST['PhoneNumber2'], "int"),
                       GetSQLValueString($_POST['Email'], "text"),
                       GetSQLValueString($_POST['IdNumber'], "text"),
                       GetSQLValueString($_POST['IdType'], "text"),
                       GetSQLValueString($_POST['PlateNo'], "text"));

  mysql_select_db($database_db_link, $db_link);
  $Result1 = mysql_query($updateSQL, $db_link) or die(mysql_error());
}
 
$plateno = $_POST['PlateNo'];

	if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "UpdateGuest")) {
  
  $updateSQL = sprintf("UPDATE vehicle SET PlateNumber=%s, Vehicle=%s, VehicleModel=%s WHERE PlateNumber='$plateNo' LIMIT 1)",
                       GetSQLValueString($_POST['PlateNo'], "text"),
                       GetSQLValueString($_POST['Vehicle'], "text"),
                       GetSQLValueString($_POST['VehicleModel'], "text"));

  mysql_select_db($database_db_link, $db_link);
  $Result1 = mysql_query($updateSQL, $db_link) or die(mysql_error());
	
	$update_booking = sprintf("UPDATE reservations SET CustomerId='$gno', RoomNo=%s, RoomType=%s, DateIn=%s, DateOut=%s, Duration=%s, NoAdults=%s, NoChildren=%s LIMIT 1)",
                       GetSQLValueString($_POST['RoomNumber'], "text"),
					   GetSQLValueString($_POST['RoomType'], "text"),
					   GetSQLValueString($_POST['DateIn'], "date"),
                       GetSQLValueString($_POST['DateOut'], "date"),
                       GetSQLValueString($_POST['Duration'], "int"),
					   GetSQLValueString($_POST['NoAdults'], "int"),
					   GetSQLValueString($_POST['NoChildren'], "int"));

  mysql_select_db($database_db_link, $db_link);
  $Result_booking = mysql_query($update_booking, $db_link) or die('error Updateing Booking' . mysql_error());
	
	//insert guest
	$update_guest = sprintf("UPDATE guest SET GuestId='$gno', GuestTitle=%s, FirstName=%s, LastName=%s, AddressTown=%s, AddressCountry=%s, PhoneNumber1=%s, PhoneNumber2=%s LIMIT 1)",
                       GetSQLValueString($_POST['Title'], "text"),
                       GetSQLValueString($_POST['FirstName'], "text"),
                       GetSQLValueString($_POST['LastName'], "text"),
                       GetSQLValueString($_POST['AddressTown'], "text"),
                       GetSQLValueString($_POST['Country'], "text"),
                       GetSQLValueString($_POST['PhoneNumber1'], "int"),
                       GetSQLValueString($_POST['PhoneNumber2'], "int"));

  mysql_select_db($database_db_link, $db_link);
  $Result_guest = mysql_query($update_guest, $db_link) or die('error Updating Guest' . mysql_error());
  
  $update_payment = sprintf("UPDATE payments SET AmountPaid=%s, Totalcost=%s, Balance=%s WHERE CustomerId='$gno'LIMIT 1)",
                       GetSQLValueString($_POST['AmountPaid'], "int"),
                       GetSQLValueString($_POST['Totalcost'], "int"),
                       GetSQLValueString($_POST['Balance'], "int"));

  mysql_select_db($database_db_link, $db_link);
  $Result_guest = mysql_query($update_payment, $db_link) or die('error Updating Guest' . mysql_error());
	}
*/
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<title>Untitled Document</title>
<link href="../../lib/styles/main_style.css" media="screen" rel="stylesheet" type="text/css" />
</head>

<body>

<table class="container" align="center">

<tr><td>

<table class="info_bar" cellspacing="5px" cellpadding="0px" width="920px" >

<tr>

<td class="info"></td>

<td class="info"><?php echo date("F d Y")?></td>

<td class="logout_box"><img src = "../../lib/images/online.png" /><?php echo $_SESSION['MM_Username']; ?></td>

</tr></table>

<div class="header">

<h1>Company Name</h1>

</div>
<hr />

<div class="menu">
	
	<ul>

	<li class="home"><a href="../home.php"><span>Home</span></a></li>

	<li class="booking"><a href="../bookings.php"><span>Bookings</span></a> </li>

	<li class="list"><a href="../guestlist.php"><span>Guest List</span></a> </li>

	<li class="add"><a href="../addguest/checkrooms.php"><span>Add Guest</span></a> </li>

	<li class="report"><a href=""><span>Reports</span></a></li>

</ul></div>

<br/>

<div class="success_box">

<p><img src="../../lib/images/ok.png" /> <b>Guest Details Updated</b></p>

<p>You have succefully updated guest details of : <b> <?php echo $fn, ' ', $ln; ?></b></p> 

</div>

</td></tr></table>

</body>
</html>