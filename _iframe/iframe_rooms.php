<?php 
 require_once('../Connections/db_link.php');

 mysql_select_db($database_db_link, $db_link);
 
	$query_rooms = "SELECT rooms.RoomNo, roomtypes.RoomType, rooms.Available
FROM rooms INNER JOIN roomtypes ON rooms.RoomTypeId = roomtypes.RoomTypeId";
 $result_rooms = mysql_query($query_rooms, $db_link) or die(mysql_error());
 $row_result_rooms = mysql_fetch_assoc($result_rooms);
 $totalRows_result_rooms = mysql_num_rows($result_rooms);

 $yes = 'Yes'; $single = '1'; $dbl = '2'; $fam = '3'; $dlx = '4';
	
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
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<meta http-equiv="refresh" content="10" >
<title>iframe_rooms</title>
<link href="../lib/styles/main_style.css" media="screen" rel="stylesheet" type="text/css" />
</head>

<body>

<table width="255px" border="0">
<tr><th colspan="3" scope="col">Total Available Rooms: <?php echo $totalRows_availablerooms; ?></th>
<tr>
  <th colspan="3" scope="col">Total Available Single Rooms: <?php echo $totalRows_availablesingles; ?></th>
<tr>
  <th colspan="3" scope="col">Total Available Double Rooms: <?php echo $totalRows_availabledbl; ?></th>
<tr>
  <th colspan="3" scope="col">Total Available Family Rooms: <?php echo $totalRows_availablefam; ?></th>
<tr>
  <th colspan="3" scope="col">Total Available Deluxe Rooms: <?php echo $totalRows_availabledlx; ?></th>
<tr>
  <tr>
    <th scope="col">RoomN0.</th>
    <th scope="col">RoomType </th>
	<th scope="col">Availability </th>

    
  </tr><?php 
 
		do { ?>
  <tr>
    <td><?php echo  $row_result_rooms['RoomNo']; ?></td>
    <td><?php echo  $row_result_rooms['RoomType']; ?></td>
    <td><?php echo  $row_result_rooms['Available']; ?></td>

    
	
  </tr><?php } while ($row_result_rooms = mysql_fetch_assoc($result_rooms));
	 ?>
</table>

</body>
</html>
