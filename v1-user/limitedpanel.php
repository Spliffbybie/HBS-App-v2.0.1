<?php 
require_once('_includes/check_access.php');
require_once('Connections/db_link.php'); 

mysql_select_db($database_db_link, $db_link);

$yes = 'Yes';	$single = '1'; $dbl = '2'; $fam = '3'; $dlx = '4';

	$sql_availablerooms = "SELECT * FROM rooms WHERE Available = '$yes' ";
$result_availablerooms = mysql_query($sql_availablerooms, $db_link) or die(mysql_error());
$row_result_availablerooms = mysql_fetch_assoc($result_availablerooms);
$totalRows_availablerooms = mysql_num_rows($result_availablerooms);

	$sql_availablesingles = "SELECT * FROM rooms WHERE Available = '$yes' AND RoomTypeId = '$single' ";
$result_availablesingles = mysql_query($sql_availablesingles, $db_link) or die(mysql_error());
$row_result_availablesingles = mysql_fetch_assoc($result_availablesingles);
$totalRows_availablesingles = mysql_num_rows($result_availablesingles);

	$sql_availabledbl = "SELECT * FROM rooms WHERE Available = '$yes' AND RoomTypeId = '$dbl' ";
$result_availabledbl = mysql_query($sql_availabledbl, $db_link) or die(mysql_error());
$row_result_availabledbl = mysql_fetch_assoc($result_availabledbl);
$totalRows_availabledbl = mysql_num_rows($result_availabledbl);

	$sql_availablefam = "SELECT * FROM rooms WHERE Available = '$yes' AND RoomTypeId = '$fam' ";
$result_availablefam = mysql_query($sql_availablefam, $db_link) or die(mysql_error());
$row_result_availablefam = mysql_fetch_assoc($result_availablefam);
$totalRows_availablefam = mysql_num_rows($result_availablefam);

	$sql_availabledlx = "SELECT * FROM rooms WHERE Available = '$yes' AND RoomTypeId = '$dlx' ";
$result_availabledlx = mysql_query($sql_availabledlx, $db_link) or die(mysql_error());
$row_result_availabledlx = mysql_fetch_assoc($result_availabledlx);
$totalRows_availabledlx = mysql_num_rows($result_availabledlx);
	
	$query_roomprices = "SELECT roomprices.RoomPrice, roomtypes.RoomTypeId FROM (roomprices INNER JOIN rooms ON roomprices.RoomPriceId = rooms.RoomPriceId) INNER JOIN roomtypes ON rooms.RoomTypeId = roomtypes.RoomTypeId WHERE (((roomtypes.RoomTypeId)= '1'))";
$all_roomprices = mysql_query($query_roomprices,$db_link)or die(mysql_error());
$row_roomprices = mysql_fetch_assoc($all_roomprices);
$totalRows_roomprices = mysql_num_rows($all_roomprices);

	$query_roomprices_dbl = "SELECT roomprices.RoomPrice, roomtypes.RoomTypeId FROM (roomprices INNER JOIN rooms ON roomprices.RoomPriceId = rooms.RoomPriceId) INNER JOIN roomtypes ON rooms.RoomTypeId = roomtypes.RoomTypeId WHERE (((roomtypes.RoomTypeId)= '2'))";
$all_roomprices_dbl = mysql_query($query_roomprices_dbl,$db_link)or die(mysql_error());
$row_roomprices_dbl = mysql_fetch_assoc($all_roomprices_dbl);
$totalRows_roomprices_dbl = mysql_num_rows($all_roomprices_dbl);

	$query_roomprices_fam = "SELECT roomprices.RoomPrice, roomtypes.RoomTypeId FROM (roomprices INNER JOIN rooms ON roomprices.RoomPriceId = rooms.RoomPriceId) INNER JOIN roomtypes ON rooms.RoomTypeId = roomtypes.RoomTypeId WHERE (((roomtypes.RoomTypeId)= '3'))";
$all_roomprices_fam = mysql_query($query_roomprices_fam,$db_link)or die(mysql_error());
$row_roomprices_fam = mysql_fetch_assoc($all_roomprices_fam);
$totalRows_roomprices_fam = mysql_num_rows($all_roomprices_fam);

	$query_roomprices_dlx = "SELECT roomprices.RoomPrice, roomtypes.RoomTypeId FROM (roomprices INNER JOIN rooms ON roomprices.RoomPriceId = rooms.RoomPriceId) INNER JOIN roomtypes ON rooms.RoomTypeId = roomtypes.RoomTypeId WHERE (((roomtypes.RoomTypeId)= '4'))";
$all_roomprices_dlx = mysql_query($query_roomprices_dlx,$db_link)or die(mysql_error());
$row_roomprices_dlx = mysql_fetch_assoc($all_roomprices_dlx);
$totalRows_roomprices_dlx = mysql_num_rows($all_roomprices_dlx);
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<title>Home_Panel</title>
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

<h3>Room Information</h3>
<table border="0">
  <tr>
    <th>RoomType</th>
    <th>RoomPrice</th>
	<th>Total Available Rooms: <?php echo $totalRows_availablerooms; ?></th>
  </tr>

    <tr>
      <td>Single Room </td>
      <td><?php echo "MK".$row_roomprices['RoomPrice']; ?></td>
	  <td>Total Available Single Rooms: <?php echo $totalRows_availablesingles; ?></td>
    </tr><tr>
	  <td>Double Room </td>
      <td><?php echo "MK".$row_roomprices_dbl['RoomPrice']; ?></td>
	  <td>Total Available Double Rooms: <?php echo $totalRows_availabledbl; ?></td>
	  </tr><tr>
	  <td>Family Room </td>
      <td><?php echo "MK".$row_roomprices_fam['RoomPrice']; ?></td>
	  <td>Total Available Family Rooms: <?php echo $totalRows_availablefam; ?></td>
	  </tr><tr>
	  <td>Deluxe Room </td>
      <td><?php echo "MK".$row_roomprices_dlx['RoomPrice']; ?></td>
	  <td>Total Available Deluxe Rooms: <?php echo $totalRows_availabledlx; ?></td>
    </tr>
</table>
<h3>Reservations</h3>
<iframe class="frame" name="guest" src="_iframe/iframe_reservation.php" width="920px" height="350px"></iframe>
</td></tr></table>
</body>
</html>

