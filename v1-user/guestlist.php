<?php 
require_once('_connections/db_link.php'); 
require_once('_includes/check_access.php');

//query selectn frm the db 
mysql_select_db($database_db_link, $db_link);
$select_guest = "SELECT * FROM guest";
$select_customer = "SELECT * FROM customers";

// execute query
$select_guest = mysql_query($select_guest,$db_link) or die(mysql_error());
$row_result_guest = mysql_fetch_assoc($select_guest);
$totalRows_guest = mysql_num_rows($select_guest);

$select_customer = mysql_query($select_customer,$db_link) or die(mysql_error());
$row_result_customer = mysql_fetch_assoc($select_customer);

?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<title>guest list</title>
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
<h3>Guest List</h3>
<?php echo date("m/d/y");?>
<table width="920" border="0">
  <tr>
   <th scope="col">Membership</th>
  	<th scope="col">Title </th>
    <th scope="col">First Name </th>
    <th scope="col">Last Name </th>
    <th scope="col">Town</th>
    <th scope="col">Country</th>
    <th scope="col">Phone No. 1 </th>
    <th scope="col">Phone No. 2  </th>
   
  </tr>
  <?php 
  //check if database has records
  if ($totalRows_guest == '0') {
  echo "<h1>There are no records of any guest</h1>";
 	}
	else {
    		do { ?>
	<tr>
	<td><?php echo  $row_result_customer['Membership']; ?></td>
	<td><?php echo  $row_result_guest['GuestTitle']; ?></td>
    <td><a href="viewguest.php?GNo=<?php echo $row_result_guest['GuestId']; ?>"><?php echo  $row_result_guest['FirstName']; ?></a></td> 
	
    <td><?php echo  $row_result_guest['LastName']; ?></td>
    <td><?php echo  $row_result_guest['AddressTown']; ?></td>
    <td><?php echo  $row_result_guest['AddressCountry']; ?></td>
    <td><?php echo  $row_result_guest['PhoneNumber1']; ?></td>
    <td><?php echo  $row_result_guest['PhoneNumber2']; ?></td>
    
    </tr> <?php } while ($row_result_guest = mysql_fetch_assoc($select_guest)); 
		}
	?>
</table>

</tr></td></table>
</body>
</html>
