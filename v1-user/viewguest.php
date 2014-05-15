<?php 
require_once('_connections/db_link.php'); 
require_once('_includes/check_access.php');
//query selectn frm the db 
mysql_select_db($database_db_link, $db_link);

$GNo = $_GET["GNo"];

$select_guest = "SELECT * FROM guest WHERE GuestId = '$GNo' ";
$select_customer = "SELECT * FROM customers WHERE CustomerId = '$GNo' ";
// execute query
$select_guest = mysql_query($select_guest,$db_link) or die(mysql_error());
$row_result_guest = mysql_fetch_assoc($select_guest);


$select_customer = mysql_query($select_customer,$db_link) or die(mysql_error());
$row_result_customer = mysql_fetch_assoc($select_customer);


//query selectn frm the db 
$plateNo = $row_result_customer['PlateNumber'];

$select_reservation = "SELECT * FROM reservations WHERE CustomerId = '$GNo' ";
$excute_reservation = mysql_query($select_reservation,$db_link) or die(mysql_error());
$row_result_reservation = mysql_fetch_assoc($excute_reservation);

$select_vehicle = "SELECT * FROM vehicle WHERE PlateNumber = '$plateNo' ";
$excute_vehicle = mysql_query($select_vehicle, $db_link) or die (mysql_error());
$row_result_vehicle = mysql_fetch_assoc($excute_vehicle);


?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<title>View guest</title>
<link href="styles/main_style.css" media="screen" rel="stylesheet" type="text/css" />
<link href="styles/facebox.css" media="screen" rel="stylesheet" type="text/css" />
<script src="scripts/jquery.js" type="text/javascript"></script>
	<script src="scripts/facebox.js" type="text/javascript"></script>
  	<script type="text/javascript">
    	jQuery(document).ready(function($) {
      		$('a[rel*=facebox]').facebox({
        	loadingImage : 'images/loading.gif',
        	closeImage   : 'images/closelabel.png'
      })
    })
  </script>
</head>

<body>
<div class="container">
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
<h3>Guest </h3>


<table width="654" border="0" align="center">
  <tr>
    <th colspan="2">Guest Information 
    </th>
  
    <th colspan="2">Room Information 
    </th>  
   </tr>
  <tr>
    <td align="right" bgcolor="#CCCCCC">Membership</td>
    <td><?php echo  $row_result_customer['Membership']; ?></td>
    <td align="right" bgcolor="#CCCCCC">Room Number</td>
    <td><?php echo  $row_result_reservation['RoomNo']; ?></td>
  </tr>
  <tr>
    <td align="right" bgcolor="#CCCCCC">Title</td>
    <td><?php echo  $row_result_guest['GuestTitle']; ?></td>
<td align="right" bgcolor="#CCCCCC">Room Type</td> 
<td><?php echo  $row_result_reservation['RoomType']; ?></td>
  </tr>
  <tr> 	
    <td width="104" align="right" bgcolor="#CCCCCC">First Name </td>
    <td width="186"><?php echo  $row_result_guest['FirstName']; ?></td>
    <td width="108" align="right" bgcolor="#CCCCCC">Date In</td>
    <td width="196"><?php echo  $row_result_reservation['DateIn']; ?></td>
  </tr>
  <tr>
    <td align="right" bgcolor="#CCCCCC">Last Name </td>
    <td><?php echo  $row_result_guest['LastName']; ?></td>
    <td align="right" bgcolor="#CCCCCC">Date Out</td>
    <td><?php echo  $row_result_reservation['DateOut']; ?></td>
  </tr>
  <tr>
    <td align="right" bgcolor="#CCCCCC">Address</td>
    <td><?php echo  $row_result_guest['AddressTown']; ?></td>
    <td align="right" bgcolor="#CCCCCC">Duration (Days)</td>
    <td><?php echo  $row_result_reservation['Duration']; ?></td>
  </tr>
  <tr>
    <td align="right" bgcolor="#CCCCCC">PhoneNumber1</td>
    <td><?php echo  $row_result_guest['PhoneNumber1']; ?></td>
    <td align="right" bgcolor="#CCCCCC">No. of Adults</td>
    <td><?php echo  $row_result_reservation['NoAdults']; ?></td>
  </tr>
  <tr>
    <td align="right" bgcolor="#CCCCCC">PhoneNumber2</td>
    <td><?php echo  $row_result_guest['PhoneNumber2']; ?></td>
    <td align="right" bgcolor="#CCCCCC">No. of Children</td>
    <td><?php echo  $row_result_reservation['NoChildren']; ?></td>
  </tr>
  <tr>
    <td align="right" bgcolor="#CCCCCC">Country</td>
    <td><?php echo  $row_result_guest['AddressCountry']; ?></td>
    <td align="right" bgcolor="#CCCCCC">&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <th colspan="2">Indentification Information 
    </th>
    
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td align="right" bgcolor="#CCCCCC">ID Type </td>
    <td><?php echo  $row_result_customer['IdType']; ?></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td align="right" bgcolor="#CCCCCC">ID Number </td>
    <td><?php echo  $row_result_customer['IdNumber']; ?></td>
    <td align="right" bgcolor="#CCCCCC">Total Cost </td>
    <td><?php echo  $row_result_reservation['TotalCost']; ?></td>
  </tr>
  <tr>
    <th colspan="2">Vehicle Information
    </th>
  
    <td align="right" bgcolor="#CCCCCC">Paid</td>
    <td><?php echo  $row_result_reservation['Paid']; ?></td>
  </tr>
  <tr>
    <td align="right" bgcolor="#CCCCCC">Vehicle</td>
    <td><?php echo  $row_result_vehicle['Vehicle']; ?></td>
    <td align="right" bgcolor="#CCCCCC">Balance</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td align="right" bgcolor="#CCCCCC">Vehicle Model </td>
    <td>
    <?php echo  $row_result_vehicle['VehicleModel']; ?> </td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td align="right" bgcolor="#CCCCCC">Plate Number </td>
    <td>
      <?php echo  $row_result_vehicle['PlateNumber']; ?> </td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
<tr>
	<td colspan="4"><a href="editguest.php?GNo=<?php echo $row_result_guest['GuestId']; ?>" rel="facebox">Edit</a> | <a target="_blank" href="check_out.php?GNo=<?php echo $row_result_guest['GuestId']; ?>&?RNo=<?php echo  $row_result_reservation['RoomNo']; ?>&?gfn=<?php echo $row_result_guest['FirstName']; ?>&?gln=<?php echo $row_result_guest['LastName']; ?>" >Check Out</a></td>
</tr>  
</table>
</div>
</body>
</html>
