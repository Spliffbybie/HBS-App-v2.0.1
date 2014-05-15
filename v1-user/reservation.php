<?php 
require_once('_connections/db_link.php'); 

require_once('_includes/check_access.php');
//query selectn frm the db 
mysql_select_db($database_db_link, $db_link);
$select_reservation = "SELECT * FROM reservations";

// execute query
$select_reservation = mysql_query($select_reservation,$db_link) or die(mysql_error());
$row_result_reservation = mysql_fetch_assoc($select_reservation);
$totalRows_reservation = mysql_num_rows($select_reservation);

?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<title>reservation</title>
<link href="styles/main_style.css" media="screen" rel="stylesheet" type="text/css" />
</head>

<body>
<table class="container" align="center">
<tr><td>
<h1>Hotel Booking System</h1>
<hr /><table class="info_bar" cellspacing="5px" cellpadding="0px" width="920px">
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
<h3>Reservations</h3>

<table width="920" border="0">
  <tr>
    <th scope="col">Guest ID </th>
    <th scope="col">Room Number </th>
    <th scope="col">Room Type </th>
    <th scope="col">Date In </th>
    <th scope="col">Date Out </th>
    <th scope="col">Duration</th>
    <th scope="col">No. of Adults </th>
    <th scope="col">No. of Children </th>
    
  </tr><?php 
  //check if database has records
  if ($totalRows_reservation == '0') {
  echo "<h1>There are no reservations made.</h1>";
 }
	else {
		do { ?>
  <tr>
  	<td><a href="viewguest.php?GNo=<?php echo $row_result_reservation['CustomerId']; ?>"><?php echo  $row_result_reservation['CustomerId']; ?></a></td>
    <td><?php echo  $row_result_reservation['RoomNo']; ?></td>
    <td><?php echo  $row_result_reservation['RoomType']; ?></td>
    <td><?php echo  $row_result_reservation['DateIn']; ?></td>
    <td><?php echo  $row_result_reservation['DateOut']; ?></td>
    <td><?php echo  $row_result_reservation['Duration']; ?></td>
    <td><?php echo  $row_result_reservation['NoAdults']; ?></td>
    <td><?php echo  $row_result_reservation['NoChildren']; ?></td>
    
	
  </tr><?php } while ($row_result_reservation = mysql_fetch_assoc($select_reservation));
	} ?>
</table>
</td></tr></table>
</body>
</html>
