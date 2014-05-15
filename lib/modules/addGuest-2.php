<?php
require_once('../../Connections/db_link.php'); 
 $roomno = $_GET["rno"];
 $roomtype = $_GET["rt"];
 $title = $_GET['t'];
 $fname = $_GET['fn'];
 $lname = $_GET['ln'];
 
mysql_select_db($database_db_link, $db_link);

	$sql_roomprice = "SELECT roomprices.RoomPrice, rooms.RoomNo
FROM (roomprices INNER JOIN rooms ON roomprices.RoomPriceId = rooms.RoomPriceId) INNER JOIN roomtypes ON rooms.RoomTypeId = roomtypes.RoomTypeId
WHERE (((rooms.RoomNo)='$roomno'))";
 
 $excute_roomprice = mysql_query($sql_roomprice, $db_link) or die ('Error Room No' .mysql_error());
 
 $row_result_roomprice = mysql_fetch_assoc($excute_roomprice);
 
 $roomprice = $row_result_roomprice['RoomPrice'];

	$select_reservation = "SELECT ReservationId, CustomerId, Duration FROM reservations WHERE RoomNo = '$roomno' ";
 
 $excute_reservation = mysql_query($select_reservation,$db_link) or die('Error select reservation' .mysql_error());
 
 $row_result_reservation = mysql_fetch_assoc($excute_reservation);

 $totalRows_reservation = mysql_num_rows($excute_reservation);
 
 $cid = $row_result_reservation['CustomerId'];
 $duration = $row_result_reservation['Duration'];
 $reservationid = $row_result_reservation['ReservationId']; 

//caculate cost  
  $cost = $duration * $roomprice;
  
//update room status to not available
	$update_rooms = "UPDATE rooms SET Available = 'No' WHERE RoomNo = '$roomno' LIMIT 1";
 
 $excute_rooms = mysql_query($update_rooms, $db_link) or die ('Error update Room' .mysql_error());
//select guest details
 $select_customer = "SELECT GuestId, GuestTitle,FirstName, LastName FROM guest WHERE GuestId = '$cid' LIMIT 1";
 
 $excute_customer = mysql_query($select_customer, $db_link) or die (mysql_error());
 
 $row_result_customer = mysql_fetch_assoc($excute_customer);
 
 $totalRows_customer = mysql_num_rows($excute_customer);

 $cgid = $row_result_customer['GuestId'];
 $title = $row_result_customer['GuestTitle'];
 $fname = $row_result_customer['FirstName'];
 $lname = $row_result_customer['LastName'];
//insert in reserved rooms
	$add_reservationlink = "INSERT INTO reservedrooms (ReservationId, RoomNo, GuestId) 
VALUES ('$reservationid', '$roomno', '$cgid')"; 

 $excute_reservationlink = mysql_query($add_reservationlink,$db_link) or die('Error link reservation' .mysql_error());
?> 
 <div class="success_box">

<p><img src="../../lib/images/ok.png" /> <b>Guest Details</b> </p>

<p>You have succefully booked a room for : <b> <?php echo $title, ' ', $fname, ' ', $lname; ?></b></p>  

<p>Room Number : <b> <?php echo $roomno; ?> </b></p>

<p>Room Type : <b> <?php echo $roomtype; ?> </b></p>

</div>

<h3>Make Payment</h3>

<p>Duration : <b> <?php echo $duration; ?> </b></p>

<p>Room Price: <b> <?php echo $roomprice; ?> </b></p>

<p>Total Cost: <b> <?php echo $cost; ?> </b></p></p>

<form action="makepayment.php?c=<?php echo $cost; ?>&cid=<?php echo $cid; ?>" method="post" name="Payment">

<table border="1">

<tr><td>Payment Method:</td><td>

<select name="PaymentMethod">
        <option value="1">Visa Card</option>
        <option value="2">Cash</option>
      </select></td>
	  </tr>

<tr><td align="right">Amount Paid:</td><td>Mk
  <input name="Paid" type="text" maxlength="6" ></td>

<tr><td colspan="2"><input type="submit" value="Make Payment"></td>

</tr></table>

</form>