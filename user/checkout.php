<?php
 require_once('../Connections/db_link.php'); 
//require_once('includes/checkaccess.php');
//query selectn frm the db 
 
 mysql_select_db($database_db_link, $db_link);

 $gno = $_GET["gno"];
 $rno = $_GET['rno'];
 $date = date("Y m d H i s");
 $fn = $_GET["gfn"];
 $ln = $_GET["gln"];

//update status to out
 $update_stat = "UPDATE customers SET Status = 'Out', Date = '$date' WHERE CustomerId = '$gno' LIMIT 1"; 
 $excute_upstat = mysql_query($update_stat,$db_link) or die(mysql_error());

//delete guest details
 $delete_guest = "DELETE FROM guest WHERE GuestId = '$gno' LIMIT 1";
 $excute_sqldg = mysql_query($delete_guest,$db_link) or die(mysql_error());

 $delete_reservation = "DELETE FROM reservations WHERE CustomerId = '$gno' LIMIT 1"; 
 $excute_sqldr = mysql_query($delete_reservation,$db_link) or die(mysql_error());

//update room status to available
 $update_rooms = "UPDATE rooms SET Available = 'Yes' WHERE RoomNo = '$rno' LIMIT 1";
 $excute_sqlur = mysql_query($update_rooms, $db_link) or die (mysql_error());

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
<link href="../lib/styles/main_style.css" media="screen" rel="stylesheet" type="text/css" />
</head>

<body>
<table class="container" align="center">
<tr><td>
<table class="info_bar" cellspacing="5px" cellpadding="0px" width="920px" >

<tr>

<td class="info"></td>

<td class="info"><?php echo date("F d Y")?></td>

<td class="logout_box"><img src = "../lib/images/online_u.png" > <?php echo $_SESSION['MM_Username']; ?></td>

</tr></table>

<div class="header">

<h1>Company Name </h1>

</div>

<hr />

<div class="menu">
	
	<ul>

	<li class="home"><a href="home.php"><span>Home</span></a></li>

	<li class="booking"><a href="bookings.php"><span>Bookings</span></a> </li>

	<li class="list"><a href="guestlist.php"><span>Guest List</span></a> </li>

	<li class="add"><a href="addguest/checkrooms.php"><span>Add Guest</span></a> </li>

	<li class="report"><a href=""><span>Reports</span></a></li>

</ul></div>

<br/>

<div class="notification_box">

<p><img src="../lib/images/info.png" /> <b>Guest Checkout</b> </p>

<p>Guest <b> <?php echo $fn, ' ', $ln; ?></b> was checked out</p> 

</div>

</td></tr></table>

</body>
</html>
