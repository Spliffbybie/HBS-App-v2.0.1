

<table width="920px" border="0" cellspacing="0px">

  <tr>
    <th scope="col">Guest ID </th>
    <th scope="col">Room Number </th>
    <th scope="col">Room Type </th>
    <th scope="col">Date In </th>
    <th scope="col">Date Out </th>
    <th scope="col">Duration</th>
    <th scope="col">No. of Adults </th>
    <th scope="col">No. of Children </th>
  </tr>
<?php
 $q = $_GET["q"];

switch ($q){

	case "All" :
		 require_once('../../Connections/db_link.php');
		mysql_select_db($database_db_link, $db_link);

		$query_reservations = "SELECT reservations.CustomerId, reservations.RoomNo, reservations.RoomType, reservations.DateIn, reservations.DateOut, reservations.Duration, Month, reservations.NoChildren, reservations.NoAdults FROM reservations ";

		 $reservations = mysql_query($query_reservations, $db_link) or die(mysql_error());
 
		 $row_reservations = mysql_fetch_assoc($reservations);
 
		 $totalRows_reservations = mysql_num_rows($reservations);
		 $total=$totalRows_reservations;

 	  //check if database has records
  		
		if ($totalRows_reservations == '0') {
 
  			echo "<div class ='notification_box'>";
			echo "<p><img src ='../lib/images/info.png'> There are no bookings made.</p>";
			echo "</div>";
 
		 }
		else {

		do { ?>
    
	<tr class="row-1">
  
  	<td><a href="viewguest.php?gno=<?php echo $row_reservations['CustomerId']; ?>"><?php echo  $row_reservations['CustomerId']; ?></a></td>
  
    <td><?php echo  $row_reservations['RoomNo']; ?></td>
  
    <td><?php echo  $row_reservations['RoomType']; ?></td>
  
    <td><?php echo  $row_reservations['DateIn']; ?></td>
  
    <td><?php echo  $row_reservations['DateOut']; ?></td>
  
    <td><?php echo  $row_reservations['Duration']; ?></td>
  
    <td><?php echo  $row_reservations['NoAdults']; ?></td>
  
    <td><?php echo  $row_reservations['NoChildren']; ?></td>
    
  </tr>
  <?php } while ($row_reservations = mysql_fetch_assoc($reservations));
	
	} 
?>
<tr>
  <th colspan="8" scope="col">Total Reservations: <?php echo $totalRows_reservations; ?></th>
</tr>
</table>	
<?php break;
	
	case "Today":
		$today = date("d");
		require_once('../../Connections/db_link.php');
		mysql_select_db($database_db_link, $db_link);
		$currMonth = date("F");
		$query_reservations = "SELECT reservations.CustomerId, reservations.RoomNo, reservations.RoomType, reservations.DateIn, reservations.DateOut, reservations.Duration, Month, reservations.NoChildren, reservations.NoAdults FROM reservations WHERE DAYOFMONTH(DateIn) ='$today' AND MONTHNAME(DateIn)='$currMonth'";

		 $reservations = mysql_query($query_reservations, $db_link) or die(mysql_error());
		 
		 $row_reservations = mysql_fetch_assoc($reservations);
		 
		 $totalRows_reservations = mysql_num_rows($reservations);
	
	  //check if database has records
  if ($totalRows_reservations == '0') {
 
  	echo "<div class ='notification_box'>";
  	echo "<p><img src ='../lib/images/info.png'> There are no bookings made for ",$today,' ', $currMonth, "</p>";
 	echo "</div>";
 
 }
	else {

		do { ?>
  <tr class="row-1">
  
  	<td><a href="viewguest.php?gno=<?php echo $row_reservations['CustomerId']; ?>"><?php echo  $row_reservations['CustomerId']; ?></a></td>
  
    <td><?php echo  $row_reservations['RoomNo']; ?></td>
  
    <td><?php echo  $row_reservations['RoomType']; ?></td>
  
    <td><?php echo  $row_reservations['DateIn']; ?></td>
  
    <td><?php echo  $row_reservations['DateOut']; ?></td>
  
    <td><?php echo  $row_reservations['Duration']; ?></td>
  
    <td><?php echo  $row_reservations['NoAdults']; ?></td>
  
    <td><?php echo  $row_reservations['NoChildren']; ?></td>
    
  </tr>
  <?php } while ($row_reservations = mysql_fetch_assoc($reservations));
	
	} 
?>
<tr>
  <th colspan="8" scope="col">Total Reservations: <?php echo $totalRows_reservations; ?></th>
</tr>
</table>	
<?php	break;
	
	case "Month":
		require_once('../../Connections/db_link.php');
		mysql_select_db($database_db_link, $db_link);
		$currMonth = date("F");
		$query_reservations = "SELECT reservations.CustomerId, reservations.RoomNo, reservations.RoomType, reservations.DateIn, reservations.DateOut, reservations.Duration, Month, reservations.NoChildren, reservations.NoAdults FROM reservations WHERE MONTHNAME(DateIn)='$currMonth'  ";

		 $reservations = mysql_query($query_reservations, $db_link) or die(mysql_error());
		 
		 $row_reservations = mysql_fetch_assoc($reservations);
		 
		 $totalRows_reservations = mysql_num_rows($reservations);
	
	  //check if database has records
  if ($totalRows_reservations == '0') {
 	
	echo "<div class ='notification_box'>";
  	echo "<p><img src ='../lib/images/info.png'> There are no bookings made for ", $currMonth, "</p>";
 	echo "</div>";
 }
	else {

		do { ?>
  <tr class="row-1">
  
  	<td><a href="viewguest.php?gno=<?php echo $row_reservations['CustomerId']; ?>"><?php echo  $row_reservations['CustomerId']; ?></a></td>
  
    <td><?php echo  $row_reservations['RoomNo']; ?></td>
  
    <td><?php echo  $row_reservations['RoomType']; ?></td>
  
    <td><?php echo  $row_reservations['DateIn']; ?></td>
  
    <td><?php echo  $row_reservations['DateOut']; ?></td>
  
    <td><?php echo  $row_reservations['Duration']; ?></td>
  
    <td><?php echo  $row_reservations['NoAdults']; ?></td>
  
    <td><?php echo  $row_reservations['NoChildren']; ?></td>
    
  </tr>
  <?php } while ($row_reservations = mysql_fetch_assoc($reservations));
	
	} 
?>
<tr>
  <th colspan="8" scope="col">Total Reservations: <?php echo $totalRows_reservations; ?></th>
</tr>
</table>	
<? 	break;	
		}
 ?>