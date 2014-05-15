<?php 
 require_once('../Connections/db_link.php');

//query selectn frm the db 
 mysql_select_db($database_db_link, $db_link);
 
 $select_sql = "SELECT guest.GuestTitle, guest.FirstName, guest.LastName, reservations.RoomNo, reservations.RoomType, reservations.DateIn, reservations.DateOut, reservations.Duration
FROM reservations INNER JOIN guest ON reservations.CustomerId = guest.GuestId";

// execute query
 $select_reservation = mysql_query($select_sql,$db_link) or die(mysql_error());
 $row_result_reservation = mysql_fetch_assoc($select_reservation);
 $totalRows_reservation = mysql_num_rows($select_reservation);

?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<meta http-equiv="refresh" content="10" >
<title>iframe_reservation</title>
<link href="../lib/styles/main_style.css" media="screen" rel="stylesheet" type="text/css" />
</head>

<body>
<div class="container">

<table width="920" border="0">
<tr>
  <th colspan="8" scope="col">Total Reservations: <?php echo $totalRows_reservation; ?></th>
</tr>
  <tr>
    <th scope="col">Title</th>
    <th scope="col">First Name </th>
    <th scope="col">Last Name </th>
    <th scope="col">Room No. </th>
    <th scope="col">Room Type </th>
    <th scope="col">Date In </th>
    <th scope="col">Date Out </th>
    <th scope="col">Duration</th>
    
  </tr><?php 
  //check if database has records
  if ($totalRows_reservation == '0') {
  echo "<h1>There are no reservations made.</h1>";
 }
	else {
		do { ?>
  <tr>
	<td><?php echo  $row_result_reservation['GuestTitle']; ?></td>
    <td><?php echo  $row_result_reservation['FirstName']; ?></td>
  	<td><?php echo  $row_result_reservation['LastName']; ?></td>
    <td><?php echo  $row_result_reservation['RoomNo']; ?></td>
    <td><?php echo  $row_result_reservation['RoomType']; ?></td>
    <td><?php echo  $row_result_reservation['DateIn']; ?></td>
    <td><?php echo  $row_result_reservation['DateOut']; ?></td>
    <td><?php echo  $row_result_reservation['Duration']; ?></td>
        
	
  </tr><?php } while ($row_result_reservation = mysql_fetch_assoc($select_reservation));
	} ?>
</table>
</div>
</body>
</html>
