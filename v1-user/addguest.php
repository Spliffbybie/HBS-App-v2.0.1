<?php 
require_once('_connections/db_link.php'); 
require_once('_includes/check_access.php');
//get room no and room typ
$roomNo = $_GET['RNo'];
$roomType = $_GET['RT'];
$redirectValidationSuccess = "feedback.php?RNo= $roomNo&RT= $roomType";
mysql_select_db($database_db_link, $db_link);

//$query_result_roomtype = "SELECT * FROM roomtypes";
//$result_roomtype = mysql_query($query_result_roomtype, $db_link) or die(mysql_error());
//$row_result_roomtype = mysql_fetch_assoc($result_roomtype);
//$totalRows_result_roomtype = mysql_num_rows($result_roomtype);

//$query_result_rooms = "SELECT * FROM rooms WHERE Available = 'yes' ";
//$result_rooms = mysql_query($query_result_rooms, $db_link) or die(mysql_error());
//$row_result_rooms = mysql_fetch_assoc($result_rooms);
//$totalRows_result_rooms = mysql_num_rows($result_rooms);
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<title>Add_guest</title>
<link href="styles/main_style.css" media="screen" rel="stylesheet" type="text/css" />

</head>

<body>
<table class="container" align="center">
<tr><td>
<h1>Hotel Booking System</h1>
<hr />
<table class="info_bar" cellspacing="5px" cellpadding="0px" width="920px">
<tr>
<td class="info">WARNING!! This is Limited Panel.</td>
<td class="info"><?php echo date("F d Y")?></td>
<td class="logout_box"><img src = "images/online.ico" align="bottom"><?php echo $_SESSION['MM_Username']; ?> | <a href="<?php echo $logoutAction ?>">Log out</a></td>
</tr></table>
<div class="navi_icons">
<a href="limitedpanel.php"><img src="images/home.png" alt="home icon" width="26" height="27" title="Home"> Home</a> |
<a href="reservation.php"><img src="images/reservations.png" alt="reservations icon" width="26" height="27" title="View Reservations"> View Reservations</a> | 
<a href="guestlist.php"><img src="images/guestlist.png" alt="guestlist icon" width="26" height="27" title="Guest List"> Guest List</a> | 
<a href="check_rooms.php"><img src ="images/addguest.png" alt="addguest" width="26" height="27" title="Add Guest"> Add Guest</a> </div>
<h3>Add Guest</h3>
<form name="AddGuest" method="post" action="feedback.php?RNo=<?php echo  $roomNo; ?>&RT=<?php echo $roomType; ?>" >
<table width="742" border="0" align="center">
  <tr>
    <th colspan="2">Guest Information </th>
    <th colspan="2" align="center">Room Information</th>`
  </tr>
  <tr>
    <td align="right">Membership</td>
    <td>
      <select name="Membership" size="1">
        <option selected>Yes</option>
        <option>No</option>
      </select>    </td>
    <td align="right">Room Type:</td>
	<td><?php echo $roomType; ?></td>
  </tr>
  <tr>
    <td align="right">Title</td>
    <td><select name="Title">
        <option value="Dr.">Dr.</option>
        <option value="Mr.">Mr.</option>
		<option value="Mrs.">Mrs.</option>
		<option value="Ms.">Ms.</option>
      </select></td>
    <td align="right">Room Number:</td>
    <td><?php echo $roomNo; ?></td>
  </tr>
  <tr>
  
 	 
    <td width="160" align="right">First Name </td>
    <td width="220"><input name="FirstName" type="text" maxlength="20"></td>
    <td width="146" align="right">Date In </td>
    <td width="198"><input name="DateIn" type="text" value="YYYY-MM-DD" maxlength="10"></td>
  </tr>
  <tr>
    <td align="right">Last Name </td>
    <td><input name="LastName" type="text" maxlength="20"></td>
    <td align="right">Date Out</td>
    <td><input name="DateOut" type="text" value="YYYY-MM-DD" maxlength="10"></td>
  </tr>
  <tr>
    <td align="right">Town</td>
    <td><input name="AddressTown" type="text" maxlength="20"></td>
    <td align="right">Duration (Days)</td>
    <td><input name="Duration" type="text" maxlength="3"></td>
  </tr>
  <tr>
    <td align="right">Country</td>
    <td><input name="Country" type="text" maxlength="20"></td>
    <td align="right">No. of Adults</td>
    <td><input name="NoAdults" type="text" maxlength="2"></td>
  </tr>
  <tr>
    <td align="right">Postal Code</td>
    <td><input name="AddressPostal" type="text" maxlength="20"></td>
    <td align="right">No. of Children</td>
    <td><input name="NoChildren" type="text" maxlength="2"></td>
  </tr>
  <tr>
    <td align="right">Phone Number1</td>
    <td><input name="PhoneNumber1" type="text" maxlength="20"></td>
    <td align="right">&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td align="right">Phone Number2</td>
    <td><input name="PhoneNumber2" type="text" maxlength="20"></td>
    <td align="right">&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td align="right">Email</td>
    <td><input name="Email" type="text" value="yourname@email.com" maxlength="20"></td>
    <td align="right">&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <th colspan="2">Indentification Information </th>
    <th colspan="2">Payment Information</th>  </tr>
  <tr>
    <td align="right">ID Type </td>
    <td><select name="IdType">
      <option>Driving License</option>
      <option>Passport</option>
    </select></td>
    <td align="right">&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td align="right">ID Number </td>
    <td><input name="IdNumber" type="text" maxlength="20"></td>
    <td align="right">&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <th colspan="2">Vehicle Information</th>
    <td align="right">&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td align="right">Vehicle</td>
    <td>
      <select name="Vehicle">
        <option>Car</option>
        <option>Motorcycle</option>
		<option>None</option>
      </select>    </td>
    <td align="right">&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td align="right">Vehicle Model </td>
    <td>
      <input name="VehicleModel" type="text" maxlength="20">    </td>
    <td align="right">&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td align="right">Plate Number </td>
    <td><input name="PlateNo" type="text" maxlength="15"></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
<tr>
	<td colspan="4">
	<div class="Form_buttons" ><input type="Submit" value="Add Guest" name="Submit">
	  <input type="reset" value="Clear Details" name="Reset"></div></td>
</tr>  
</table>

</form>
<?PHP
//} true == $show_form
?>
</td></tr></table>
</body>
</html>
