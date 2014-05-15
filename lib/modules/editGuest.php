<?php
 require_once('../../Connections/db_link.php'); 
//query selectn frm the db 
 mysql_select_db($database_db_link, $db_link);

 $gno = $_GET["gno"];

 $select_guest = "SELECT * FROM guest WHERE GuestId = '$gno' ";
 $excute_guest = mysql_query($select_guest,$db_link) or die(mysql_error());
 $row_result_guest = mysql_fetch_assoc($excute_guest);

 $select_customer = "SELECT * FROM customers WHERE CustomerId = '$gno' ";
 $excute_customer = mysql_query($select_customer,$db_link) or die(mysql_error());
 $row_result_customer = mysql_fetch_assoc($excute_customer);

 $plateid = $row_result_customer['PlateNumber'];

 $select_vehicle = "SELECT * FROM vehicle WHERE PlateNumber = '$plateid' ";
 $excute_vehicle = mysql_query($select_vehicle, $db_link) or die (mysql_error());
 $row_result_vehicle = mysql_fetch_assoc($excute_vehicle);

 $select_reservation = "SELECT * FROM reservations WHERE CustomerId = '$gno' ";
 $excute_reservation = mysql_query($select_reservation,$db_link) or die(mysql_error());
 $row_result_reservation = mysql_fetch_assoc($excute_reservation);
 $totalRows_reservation = mysql_num_rows($excute_reservation);

 $select_payment = "SELECT AmountPaid, Totalcost FROM payments WHERE CustomerId = '$gno' ";
 $excute_payment = mysql_query($select_payment, $db_link) or die(mysql_errno());
 $row_result_payment = mysql_fetch_assoc($excute_payment);

//UPDATING INFORMATION INTO DATABASE

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

 $updateFormAction = $_SERVER['PHP_SELF'];
	
	if (isset($_SERVER['QUERY_STRING'])) {
  
  $updateFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

	if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "UpdateGuest")) {
  
  $updateSQL = sprintf("UPDATE customers SET CustomerTitle=%s, Membership=%s, CustomerFName=%s, CustomerLName=%s, AddressTown=%s, AddressCountry=%s, AddressPostalCode=%s, PhoneNumber1=%s, PhoneNumber2=%s, CustomerEmail=%s, IdNumber=%s, IdType=%s, PlateNumber=%s WHERE CustomerId='$gno' LIMIT 1",
                       GetSQLValueString($_POST['Title'], "text"),
                       GetSQLValueString($_POST['Membership'], "text"),
                       GetSQLValueString($_POST['FirstName'], "text"),
                       GetSQLValueString($_POST['LastName'], "text"),
                       GetSQLValueString($_POST['AddressTown'], "text"),
                       GetSQLValueString($_POST['Country'], "text"),
                       GetSQLValueString($_POST['AddressPostal'], "text"),
                       GetSQLValueString($_POST['PhoneNumber1'], "text"),
                       GetSQLValueString($_POST['PhoneNumber2'], "text"),
                       GetSQLValueString($_POST['Email'], "text"),
                       GetSQLValueString($_POST['IdNumber'], "text"),
                       GetSQLValueString($_POST['IdType'], "text"),
                       GetSQLValueString($_POST['PlateNo'], "text"));

  mysql_select_db($database_db_link, $db_link);
  $Result1 = mysql_query($updateSQL, $db_link) or die(mysql_error());
}
 
 
//$plateno = $_POST['PlateNo'];

	if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "UpdateGuest")) {
  
  $updateSQL = sprintf("UPDATE vehicle SET PlateNumber=%s, Vehicle=%s, VehicleModel=%s WHERE PlateNumber='$plateid' LIMIT 1",
                       GetSQLValueString($_POST['PlateNo'], "text"),
                       GetSQLValueString($_POST['Vehicle'], "text"),
                       GetSQLValueString($_POST['VehicleModel'], "text"));

  mysql_select_db($database_db_link, $db_link);
  $Result2 = mysql_query($updateSQL, $db_link) or die(mysql_error());
	
	$update_booking = sprintf("UPDATE reservations SET CustomerId='$gno', RoomNo=%s, RoomType=%s, DateIn=%s, DateOut=%s, Duration=%s, NoAdults=%s, NoChildren=%s LIMIT 1",
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
	$update_guest = sprintf("UPDATE guest SET GuestTitle=%s, FirstName=%s, LastName=%s, AddressTown=%s, AddressPostalCode=%s, AddressCountry=%s, PhoneNumber1=%s, PhoneNumber2=%s, GuestEmail=%s WHERE GuestId='$gno' LIMIT 1",
                       GetSQLValueString($_POST['Title'], "text"),
                       GetSQLValueString($_POST['FirstName'], "text"),
                       GetSQLValueString($_POST['LastName'], "text"),
                       GetSQLValueString($_POST['AddressTown'], "text"),
					   GetSQLValueString($_POST['AddressPostal'], "text"),
                       GetSQLValueString($_POST['Country'], "text"),
                       GetSQLValueString($_POST['PhoneNumber1'], "text"),
                       GetSQLValueString($_POST['PhoneNumber2'], "text"),
					   GetSQLValueString($_POST['Email'], "text"));

  mysql_select_db($database_db_link, $db_link);
  $Result_guest = mysql_query($update_guest, $db_link) or die('error Updating Guest' . mysql_error());
  
  $update_payment = sprintf("UPDATE payments SET AmountPaid=%s, Totalcost=%s, Balance=%s WHERE CustomerId='$gno'LIMIT 1",
                       GetSQLValueString($_POST['AmountPaid'], "int"),
                       GetSQLValueString($_POST['Totalcost'], "int"),
                       GetSQLValueString($_POST['Balance'], "int"));

  mysql_select_db($database_db_link, $db_link);
  $Result_payment = mysql_query($update_payment, $db_link) or die('error Updating Guest' . mysql_error());
  
  $fname = $_POST['FirstName']; 
  $lname = $_POST['LastName'];
  
   $insertGoTo = "updateguest.php?fn=$fname&ln=$lname";
  if (isset($_SERVER['QUERY_STRING'])) {
    $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
    $insertGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $insertGoTo));
  }
?>

<form name="UpdateGuest" action="<?php echo $updateFormAction; ?>" method="post">

<div id ="pop_table">

<table width="654" border="0">
  <tr> 
    <th colspan="2">Guest Information </td>
    <th colspan="2">Room Information </td>  </tr>
  <tr>
    <td align="right">Membership</td>
    <td>
      <select name="Membership">
        <option value="Yes" <?php if ($row_result_customer['Membership'] == 'Yes') {echo "selected=\"selected\"";} ?>>Yes</option>
        <option value="No" <?php if ($row_result_customer['Membership'] == 'No') {echo "selected=\"selected\"";} ?>>No</option>
      </select>    </td>
    <td align="right">Room Number </td>
    <td>
      <input type="text" name="RoomNumber" value="<?php echo  $row_result_reservation['RoomNo']; ?>">    </td>
  </tr>
  <tr>
    <td align="right">Title</td>
    <td><select name="Title">
		<option value="Dr." <?php if ($row_result_customer['CustomerTitle'] == 'Dr.') {echo "selected=\"selected\"";} ?>>Dr.</option>
	        <option value="Mr." <?php if ($row_result_customer['CustomerTitle'] == 'Mr.') {echo "selected=\"selected\"";} ?>>Mr.</option>
		<option value="Mrs." <?php if ($row_result_customer['CustomerTitle'] == 'Mrs.') {echo "selected=\"selected\"";} ?>>Mrs.</option>
		<option value="Ms." <?php if ($row_result_customer['CustomerTitle'] == 'Ms.') {echo "selected=\"selected\"";} ?>>Ms.</option>
      </select>	</td>
    <td align="right">Room Type </td>
    <td><select name="RoomType">
      <option value="Single" <?php if ($row_result_reservation['RoomType'] == 'Single') {echo "selected=\"selected\"";} ?>>Single</option>
      <option value="Double" <?php if ($row_result_reservation['RoomType'] == 'Double') {echo "selected=\"selected\"";} ?>>Double</option>
      <option value="Family" <?php if ($row_result_reservation['RoomType'] == 'Family') {echo "selected=\"selected\"";} ?>>Family</option>
      <option value="Deluxe" <?php if ($row_result_reservation['RoomType'] == 'Deluxe') {echo "selected=\"selected\"";} ?>>Deluxe</option>
      <option value="Master Suite" <?php if ($row_result_reservation['RoomType'] == 'Master Suite') {echo "selected=\"selected\"";} ?>>Master Suite</option>
    </select></td>
  </tr>
  <tr>
  
 	 
    <td width="222" align="right">First Name </td>
    <td width="682"><input name="FirstName" type="text" maxlength="20" value="<?php echo  $row_result_guest['FirstName']; ?>"></td>
    <td width="682" align="right">Date In </td>
    <td width="682"><input type="date" name="DateIn" value="<?php echo  $row_result_reservation['DateIn']; ?>"></td>
  </tr>
  <tr>
    <td align="right">Last Name </td>
    <td><input name="LastName" type="text" maxlength="20" value="<?php echo  $row_result_guest['LastName']; ?>"></td>
    <td align="right">Date Out </td>
    <td><input type="date" name="DateOut" value="<?php echo  $row_result_reservation['DateOut']; ?>"></td>
  </tr>
  <tr>
    <td align="right">Address Town</td>
    <td><input name="AddressTown" type="text" maxlength="20" value="<?php echo  $row_result_guest['AddressTown']; ?>"></td>
    <td align="right">Duration (Days) </td>
    <td><input type="text" name="Duration" value="<?php echo  $row_result_reservation['Duration']; ?>"></td>
  </tr>
  <tr>
    <td align="right">Postal Code: </td>
    <td><input name="AddressPostal" type="text" maxlength="20" value="<?php echo  $row_result_guest['AddressPostalCode']; ?>"></td>
    <td align="right">No. of Adults </td>
    <td><input type="text" name="NoAdults" value="<?php echo  $row_result_reservation['NoAdults']; ?>"></td>
  </tr>
  <tr>
    <td align="right">PhoneNumber1</td>
    <td><input name="PhoneNumber1" type="text" maxlength="20" value="<?php echo  $row_result_guest['PhoneNumber1']; ?>"></td>
    <td align="right">No. of Children </td>
    <td><input name="NoChildren" type="text" maxlength="20" value="<?php echo  $row_result_reservation['NoChildren']; ?>"></td>
  </tr>
  <tr>
    <td align="right">PhoneNumber2</td>
    <td><input name="PhoneNumber2" type="text" maxlength="20" value="<?php echo  $row_result_guest['PhoneNumber2']; ?>"></td>
    <td align="right">&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td align="right">Country</td>
    <td><input name="Country" type="text" maxlength="20" value="<?php echo  $row_result_guest['AddressCountry']; ?>"></td>
    <td align="right">&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td align="right">Email:</td>
    <td><input name="Email" type="text" maxlength="20" value="<?php echo  $row_result_guest['GuestEmail']; ?>"></td>
    <td align="right">&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <th colspan="2">Indentification Information </td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td align="right">ID Type </td>
    <td><select name="IdType">
      <option value="Driving License" <?php if ($row_result_customer['IdType'] == 'Driving License') {echo "selected=\"selected\"";} ?>>Driving License</option>
      <option value="Passport" <?php if ($row_result_customer['IdType'] == 'Passport') {echo "selected=\"selected\"";} ?>>Passport</option>
    </select></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td align="right">ID Number </td>
    <td><input name="IdNumber" type="text" maxlength="20" value="<?php echo  $row_result_customer['IdNumber']; ?>"></td>
    <td align="right">Total Cost </td>
    <td>
      <input type="text" name="Totalcost" value="<?php echo  $row_result_payment['Totalcost']; ?>"></td>
  </tr>
  <tr>
    <th colspan="2">Vehicle Information</td>
    <td align="right">Paid</td>
    <td>
      <input type="text" name="AmountPaid" value="<?php echo  $row_result_payment['AmountPaid']; ?>">    </td>
  </tr>
  <tr>
    <td align="right">Vehicle</td>
    <td>
      <select name="Vehicle">
        <option value="Car" <?php if ($row_result_vehicle['Vehicle'] == 'Car') {echo "selected=\"selected\"";} ?>>Car</option>
        <option value="Motocycle" <?php if ($row_result_vehicle['Vehicle'] == 'Motocycle') {echo "selected=\"selected\"";} ?>>Motocycle</option>
		<option value="None" <?php if ($row_result_vehicle['Vehicle'] == 'None') {echo "selected=\"selected\"";} ?>>None</option>
      </select>    </td>
    <td align="right">Balance</td>
    <td>
      <input type="text" name="Balance" value="<?php echo  $row_result_payment['Balance']; ?>">    </td>
  </tr>
  <tr>
    <td align="right">Vehicle Model </td>
    <td>
      <input type="text" name="VehicleModel" value="<?php echo  $row_result_vehicle['VehicleModel']; ?>">    </td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td align="right">Plate Number </td>
    <td>
      <input type="text" name="PlateNo" value="<?php echo  $row_result_vehicle['PlateNumber']; ?>">    </td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
<tr>
	<td colspan="4"><div class="Form_buttons" ><input type="submit" value="Update Guest"></div></td>
</tr>  
</table>
</div>
<input type="hidden" name="MM_update" value="UpdateGuest">
</form>