<?php require_once('_connections/db_link.php'); 
require_once('_includes/check_access.php');
//query selectn frm the db 
mysql_select_db($database_db_link, $db_link);
$GNo = $_GET["GNo"];
$select_guest = "SELECT * FROM guest WHERE GuestId = '$GNo' ";
$select_customer = "SELECT * FROM customers WHERE CustomerId = '$GNo' ";
// execute query
$excute_guest = mysql_query($select_guest,$db_link) or die(mysql_error());
$row_result_guest = mysql_fetch_assoc($excute_guest);

$excute_customer = mysql_query($select_customer,$db_link) or die(mysql_error());
$row_result_customer = mysql_fetch_assoc($excute_customer);
$plateNo = $row_result_customer['PlateNumber'];
$select_vehicle = "SELECT * FROM vehicle WHERE PlateNumber = '$plateNo' ";
$excute_vehicle = mysql_query($select_vehicle, $db_link) or die (mysql_error());
$row_result_vehicle = mysql_fetch_assoc($excute_vehicle);

//query selectn frm the db 
//$fname = $row_result_guest['FirstName'];
$select_reservation = "SELECT * FROM reservations WHERE CustomerId = '$GNo' ";

// execute query
$excute_reservation = mysql_query($select_reservation,$db_link) or die(mysql_error());
$row_result_reservation = mysql_fetch_assoc($excute_reservation);
$totalRows_reservation = mysql_num_rows($excute_reservation);
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<title>Edit guest</title>
<link href="styles/main_style.css" media="screen" rel="stylesheet" type="text/css" />
</head>

<body>
<form action="updateguest.php?GNo=<?php echo $row_result_guest['GuestId']; ?>&plateNo=<?php echo $row_result_vehicle['PlateNumber']; ?>" method="post">
<table width="654" border="0" align="center">
  <tr>
    <th colspan="2">Guest Information </td>
    <th colspan="2">Room Information </td>  </tr>
  <tr>
    <td align="right">Membership</td>
    <td>
      <select name="Membership">
        <option value="Yes">Yes</option>
        <option value="No">No</option>
      </select>    </td>
    <td align="right">Room Number </td>
    <td>
      <input type="text" name="roomnumber" value="<?php echo  $row_result_reservation['RoomNo']; ?>">    </td>
  </tr>
  <tr>
    <td align="right">Title</td>
    <td><select name="Title">
		<option value="Dr.">Dr.</option>>
	        <option value="Mr.">Mr.</option>
		<option value="Mrs.">Mrs.</option>
		<option value="Ms.">Ms.</option>
      </select>
	</td>
    <td align="right">&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
  
 	 
    <td width="222" align="right">First Name </td>
    <td width="682"><input name="FirstName" type="text" maxlength="20" value="<?php echo  $row_result_guest['FirstName']; ?>"></td>
    <td width="682" align="right">Room Type </td>
    <td width="682">
      <select name="RoomType">
        <option value="">Single</option>
        <option>Double</option>
        <option>Family</option>
        <option>Deluxe</option>
        <option>Master Suite</option>
      </select>    </td>
  </tr>
  <tr>
    <td align="right">Last Name </td>
    <td><input name="FastName" type="text" maxlength="20" value="<?php echo  $row_result_guest['LastName']; ?>"></td>
    <td align="right">Date In </td>
    <td>
      <input type="date" name="DateIn" value="<?php echo  $row_result_reservation['DateIn']; ?>">    </td>
  </tr>
  <tr>
    <td align="right">Address Town</td>
    <td><input name="AddressTown" type="text" maxlength="20" value="<?php echo  $row_result_guest['AddressTown']; ?>"></td>
    <td align="right">Date Out </td>
    <td>
      <input type="date" name="DateOut" value="<?php echo  $row_result_reservation['DateOut']; ?>">    </td>
  </tr>
  <tr>
    <td align="right">PhoneNumber1</td>
    <td><input name="PhoneNumber1" type="text" maxlength="20" value="<?php echo  $row_result_guest['PhoneNumber1']; ?>"></td>
    <td align="right">Duration (Days) </td>
    <td>
      <input type="text" name="Duration" value="<?php echo  $row_result_reservation['Duration']; ?>">    </td>
  </tr>
  <tr>
    <td align="right">PhoneNumber2</td>
    <td><input name="PhoneNumber2" type="text" maxlength="20" value="<?php echo  $row_result_guest['PhoneNumber2']; ?>"></td>
    <td align="right">No. of Adults </td>
    <td>
      <input type="text" name="NoAdults" value="<?php echo  $row_result_reservation['NoAdults']; ?>">    </td>
  </tr>
  <tr>
    <td align="right">Country</td>
    <td><input name="Country" type="text" maxlength="20" value="<?php echo  $row_result_guest['AddressCountry']; ?>"></td>
    <td align="right">No. of Children </td>
    <td><input name="NoChildren" type="text" maxlength="20" value="<?php echo  $row_result_reservation['NoChildren']; ?>"></td>
  </tr>
  <tr>
    <th colspan="2">Indentification Information </td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td align="right">ID Type </td>
    <td>
        <select name="IdType">
          <option value="<?php echo  $row_result_guest['IdType']; ?>">Driving License</option>
          <option value="<?php echo  $row_result_guest['IdType']; ?>">Passport</option>
        </select>    </td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td align="right">ID Number </td>
    <td><input name="IdNumber" type="text" maxlength="20" value="<?php echo  $row_result_customer['IdNumber']; ?>"></td>
    <td align="right">Total Cost </td>
    <td>
      <input type="text" name="NoChildren" value="<?php echo  $row_result_reservation['NoChildren']; ?>"></td>
  </tr>
  <tr>
    <th colspan="2">Vehicle Information</td>
    <td align="right">Paid</td>
    <td>
      <input type="text" name="textfield11" value="<?php echo  $row_result_reservation['NoChildren']; ?>">    </td>
  </tr>
  <tr>
    <td align="right">Vehicle</td>
    <td>
      <select name="Vehicle">
        <option value="<?php echo  $row_result_guest['Vehicle']; ?>">Car</option>
        <option value="<?php echo  $row_result_guest['Vehicle']; ?>">Motorcycle</option>
      </select>    </td>
    <td align="right">Balance</td>
    <td>
      <input type="text" name="textfield10" value="<?php echo  $row_result_reservation['NoChildren']; ?>">    </td>
  </tr>
  <tr>
    <td align="right">Vehicle Model </td>
    <td>
      <input type="text" name="vehicleMOdel" value="<?php echo  $row_result_vehicle['VehicleModel']; ?>">    </td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td align="right">Plate Number </td>
    <td>
      <input type="text" name="plateNumber" value="<?php echo  $row_result_vehicle['PlateNumber']; ?>">    </td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
<tr>
	<td colspan="4"><input type="submit" value="Update Guest"></td>
</tr>  
</table>
</form>

</body>
</html>
