<?php 
require_once('includes/checkaccess.php');
require_once('../Connections/db_link.php'); 

mysql_select_db($database_db_link, $db_link);

$yes = 'Yes';	$single = '1'; $dbl = '2'; $fam = '3'; $dlx = '4';

	$sql_availablerooms = "SELECT RoomNo FROM rooms WHERE Available = '$yes' ";
$result_availablerooms = mysql_query($sql_availablerooms, $db_link) or die(mysql_error());
$row_result_availablerooms = mysql_fetch_assoc($result_availablerooms);
$totalRows_availablerooms = mysql_num_rows($result_availablerooms);

	$sql_availablesingles = "SELECT RoomNo FROM rooms WHERE Available = '$yes' AND RoomTypeId = '$single' ";
$result_availablesingles = mysql_query($sql_availablesingles, $db_link) or die(mysql_error());
$row_result_availablesingles = mysql_fetch_assoc($result_availablesingles);
$totalRows_availablesingles = mysql_num_rows($result_availablesingles);

	$sql_availabledbl = "SELECT RoomNo FROM rooms WHERE Available = '$yes' AND RoomTypeId = '$dbl' ";
$result_availabledbl = mysql_query($sql_availabledbl, $db_link) or die(mysql_error());
$row_result_availabledbl = mysql_fetch_assoc($result_availabledbl);
$totalRows_availabledbl = mysql_num_rows($result_availabledbl);

	$sql_availablefam = "SELECT RoomNo FROM rooms WHERE Available = '$yes' AND RoomTypeId = '$fam' ";
$result_availablefam = mysql_query($sql_availablefam, $db_link) or die(mysql_error());
$row_result_availablefam = mysql_fetch_assoc($result_availablefam);
$totalRows_availablefam = mysql_num_rows($result_availablefam);

	$sql_availabledlx = "SELECT RoomNo FROM rooms WHERE Available = '$yes' AND RoomTypeId = '$dlx' ";
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
<link href="../lib/styles/main_style.css" media="screen" rel="stylesheet" type="text/css" />
<script>
function showBooking(str) {

if (str=="") {
	document.getElementById("display").innerHTML="";
	return;
	}
	if (window.XMLHttpRequest) {
	//code for IE7, Firefox, Chrome, Opera Safari
	xmlhttp=new XMLHttpRequest();
	}
	else {
	xmlhttp=new ActiveXobject ("Microsoft.XMLHTTP");
	}
	xmlhttp.onreadystatechange=function() {
	if (xmlhttp.readyState==4 && xmlhttp.status==200) {
	document.getElementById("display").innerHTML=xmlhttp.responseText;
	}
}
xmlhttp.open ("GET", "../lib/modules/viewBookings.php?q="+str,true);
xmlhttp.send();
}
</script>
</head>

<body>
<table class="container" align="center">

<tr><td>

<table class="info_bar" cellspacing="5px" cellpadding="0px" width="920px" >

<tr>

<td class="info">Limited Panel.</td>

<td class="info"><?php echo date("F d Y")?></td>

<td class="logout_box"><img src = "../lib/images/online_u.png" > <?php echo $_SESSION['MM_Username']; ?> | <a href="<?php echo $logoutAction ?>" class="linkAsButton"><span>Log out</span></a></td>

</tr></table>

<div class="header">

<h1>Company Name</h1>

<hr />

<div class="menu">
	
	<ul>

	<li class="homeActive"><a href="home.php"><span>Home</span></a></li>

	<li class="booking"><a href="bookings.php"><span>Bookings</span></a> </li>

	<li class="list"><a href="guestlist.php"><span>Guest List</span></a> </li>

	<li class="add"><a href="addguest/checkrooms.php"><span>Add Guest</span></a> </li>

	<li class="report"><a href=""><span>Reports</span></a></li>

</ul></div>

<br/>


<h3>Room Information</h3>
<table border="0" width ="800px">
  <tr>
    <th>RoomType</th>
    <th>RoomPrice</th>
	<th>Total Available Rooms: <?php echo $totalRows_availablerooms; ?></th>
  </tr>

    <tr>
      <td >Single Room </td>
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
<h3>Booking Calendar</h3>
<form>
<select name="view" onChange="showBooking(this.value)" >
<option value="">Select View Mode</option>
<option value="All">All</option>
<option value="Today">Today</option>
<option value="Month">Month</option>
</select>
</form>
<div id ="display"></div>

</td>
</tr></table>
</body>
</html>

