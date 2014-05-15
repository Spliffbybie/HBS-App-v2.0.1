<?php
require_once('_connections/db_link.php'); 
//require_once('_includes/check_access.php');
//query selectn frm the db 
mysql_select_db($database_db_link, $db_link);

$GNo = $_GET["GNo"];
$RNo = $_GET['RNo'];

//delete guest details
 $delete_guest = "DELETE FROM guest WHERE GuestId = '$GNo' LIMIT 1";
 $excute_guest = mysql_query($delete_guest,$db_link) or die(mysql_error());

 $delete_reservation = "DELETE FROM reservations WHERE CustomerId = '$GNo' LIMIT 1"; 
 $excute_reservation = mysql_query($delete_reservation,$db_link) or die(mysql_error());

//update room status to available
 $update_rooms = "UPDATE rooms SET Available = 'Yes' WHERE RoomNo = '$RNo' LIMIT 1";
 $excute_rooms = mysql_query($update_rooms, $db_link) or die (mysql_error());

//$select_reservedrooms = "SELECT * FROM reservedrooms WHERE GuestId = '$GNo' LIMIT 1";
//$select_rooms = "SELECT * FROM rooms WHERE RoomNo = '$RNo' LIMIT 1";
// excute query
//$excute_reservedrooms = mysql_query($select_reservedrooms,$db_link) or die(mysql_error());
//$row_result_reservedrooms = mysql_fetch_assoc($excute_reservedrooms);

//get roomNo
//$roomNo = $row_result_reservedrooms['RoomNo'];

//$plateNo = $row_result_customer['PlateNumber'];
//$select_vehicle = "SELECT * FROM vehicle WHERE PlateNumber = '$plateNo' ";
//$excute_vehicle = mysql_query($select_vehicle, $db_link) or die (mysql_error());
//$row_result_vehicle = mysql_fetch_assoc($excute_vehicle);

//query selectn frm the db 
//$fname = $row_result_guest['FirstName'];
//$select_reservation = "SELECT * FROM reservations WHERE CustomerId = '$GNo' ";

// execute query
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<title>Checkout</title>
<link href="lib/styles/main_style.css" media="screen" rel="stylesheet" type="text/css" />
</head>

<body>
<table class="container" align="center">
<tr><td>
<h1>Hotel Booking System</h1>
<hr />
<a href="reservation.php">View Reservations</a> | <a href="guestlist.php">View Guest List</a> | <a href="check_rooms.php">Add Guest</a> |
<h3>Guest Checkout </h3>
<p>You have succefully Checked out the guest : <b> <?php echo $_GET["gfn"], ' ', $_GET["gln"]; ?></b></p> 
</td></tr></table>
</body>
</html>
