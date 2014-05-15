<?php
require_once('../Connections/db_link.php');
 mysql_select_db($database_db_link, $db_link);

	$query_reservations = "SELECT reservations.CustomerId, reservations.RoomNo, reservations.RoomType, reservations.DateIn, reservations.DateOut, reservations.Duration, reservations.NoChildren, reservations.NoAdults FROM reservations";

 $reservations = mysql_query($query_reservations, $db_link) or die(mysql_error());
 
 $row_reservations = mysql_fetch_assoc($reservations);
 
 $totalRows_reservations = mysql_num_rows($reservations);
 
 ?>
 <h3>Bookings</h3>

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
  if ($totalRows_reservations == '0') {
  echo "<h1>There are no reservations made.</h1>";
 }
	else {
		do { ?>
  <tr>
  	<td><a href="viewguest.php?gno=<?php echo $row_reservations['CustomerId']; ?>"><?php echo  $row_reservations['CustomerId']; ?></a></td>
    <td><?php echo  $row_reservations['RoomNo']; ?></td>
    <td><?php echo  $row_reservations['RoomType']; ?></td>
    <td><?php echo  $row_reservations['DateIn']; ?></td>
    <td><?php echo  $row_reservations['DateOut']; ?></td>
    <td><?php echo  $row_reservations['Duration']; ?></td>
    <td><?php echo  $row_reservations['NoAdults']; ?></td>
    <td><?php echo  $row_reservations['NoChildren']; ?></td>
    
	
  </tr><?php } while ($row_reservations = mysql_fetch_assoc($reservations));
	} ?>
</table>