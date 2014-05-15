<?php 
 require_once('../Connections/db_link.php'); 
 
//query selectn frm the db 
mysql_select_db($database_db_link, $db_link);

$gno = $_GET["gno"];

$select_customer = "SELECT Status FROM customers WHERE CustomerId = '$gno' LIMIT 1"; //AND Status = 'In'
$select_customer = mysql_query($select_customer, $db_link) or die(mysql_error());
$row_result_customer = mysql_fetch_assoc($select_customer);
$totalRows_customer = mysql_num_rows($select_customer);
$stat = $row_result_customer['Status'];

//retrieve customer wher status is IN
if (($stat == 'Out') || ($totalRows_customer == '0')) {

	echo '<div class="warning_box">';

	echo '<p><img src="../lib/images/warning.png" /><br /> <b>Warning VIEW GUEST</b></p>';
	
	echo '<p>OOPS Something went wrong</p>';
	
	echo '<p>There was no guest selected to view the details <br />';
	
	echo 'or <br />';
	
	echo 'The guest has checked out</p>';
	
	echo '<div class="Form_buttons" ><a href="guestlist.php" class="linkAsButton"><span>RETURN</span></a></div></div>';

	}

	else {
	$select_customer = "SELECT * FROM customers WHERE CustomerId = '$gno' AND Status = 'In' LIMIT 1";
	$select_customer = mysql_query($select_customer, $db_link) or die(mysql_error());
	$row_result_customer = mysql_fetch_assoc($select_customer);
	$plateNo = $row_result_customer['PlateNumber'];
	
	$select_guest = "SELECT * FROM guest WHERE GuestId = '$gno' ";
	$select_guest = mysql_query($select_guest,$db_link) or die(mysql_error());
	$row_result_guest = mysql_fetch_assoc($select_guest);
		
	$select_reservation = "SELECT * FROM reservations WHERE CustomerId = '$gno' ";
	$excute_reservation = mysql_query($select_reservation, $db_link) or die(mysql_error());
	$row_result_reservation = mysql_fetch_assoc($excute_reservation);
	
	$select_vehicle = "SELECT * FROM vehicle WHERE PlateNumber = '$plateNo' ";
	$excute_vehicle = mysql_query($select_vehicle, $db_link) or die (mysql_error());
	$row_result_vehicle = mysql_fetch_assoc($excute_vehicle);
	
	$select_payment = "SELECT AmountPaid, Totalcost FROM payments WHERE CustomerId = '$gno' ";
	$excute_payment = mysql_query($select_payment, $db_link) or die(mysql_errno());
	$row_result_payment = mysql_fetch_assoc($excute_payment);

?>
<h3>Guest </h3>

<table width="742" border="0" align="center">

  <tr>

    <th colspan="4">Guest Information </th>
  </tr>

  <tr>

    <td id="row-title">Title:</td>

    <td><?php echo  $row_result_guest['GuestTitle']; ?></td>

    <td id="row-title">Membership:</td>

	<td><?php echo  $row_result_customer['Membership']; ?></td>
  </tr>

  <tr>

    <td id="row-title">First Name: </td>

    <td><?php echo  $row_result_guest['FirstName']; ?></td>

    <td id="row-title">Last Name:</td>

    <td><?php echo  $row_result_guest['LastName']; ?></td>

  </tr>

  <tr>
  	 
    <td width="160" id="row-title">Town:</td>
 
    <td width="220"><?php echo  $row_result_guest['AddressTown']; ?></td>
 
    <td width="146" id="row-title">Country:</td>
 
    <td width="198"><?php echo  $row_result_guest['AddressCountry']; ?></td>
 
  </tr>
 
  <tr>
 
    <td id="row-title">Postal Code:</td>
 
    <td><?php echo  $row_result_customer['AddressPostalCode']; ?></td>
 
    <td id="row-title">Email:</td>
 
    <td><?php echo  $row_result_customer['CustomerEmail']; ?></td>
  </tr>
 
  <tr>
 
    <td id="row-title">Phone Number1:</td>
 
    <td><?php echo  $row_result_guest['PhoneNumber1']; ?></td>
 
    <td id="row-title">Phone Number2:</td>
 
    <td><?php echo  $row_result_guest['PhoneNumber2']; ?></td>
 
  </tr>
 
  <tr>
 
    <th colspan="4" align="center">Room Information</th>`
	   
  </tr>
  
  <tr>
  
    <td id="row-title">Room Number:</td>
  
    <td><?php echo  $row_result_reservation['RoomNo']; ?></td>
  
    <td id="row-title">Room Type:</td>
  
    <td><?php echo  $row_result_reservation['RoomType']; ?></td>
  
  </tr>
  
  <tr>
  
    <td id="row-title">Date In:</td>
  
    <td><?php echo  $row_result_reservation['DateIn']; ?></td>
  
    <td id="row-title">Date Out:</td>
  
    <td><?php echo  $row_result_reservation['DateOut']; ?></td>
  
  </tr>
  
  <tr>
  
    <td id="row-title">Duration (Days):</td>
  
    <td><?php echo  $row_result_reservation['Duration']; ?></td>
  
    <td id="row-title">&nbsp;</td>
  
    <td>&nbsp;</td>
  
  </tr>
  
  <tr>
  
    <td id="row-title">No. of Adults:</td>
  
    <td><?php echo  $row_result_reservation['NoAdults']; ?></td>
  
    <td id="row-title">No. of Children:</td>
  
    <td><?php echo  $row_result_reservation['NoChildren']; ?></td>
  
  </tr>
  
  <tr>
  
    <th colspan="4">Indentification Information </th>
  
  </tr>
  
  <tr>
  
    <td id="row-title">ID Type: </td>
  
    <td><?php echo  $row_result_customer['IdType']; ?></td>
  
    <td id="row-title">&nbsp;</td>
  
    <td>&nbsp;</td>
  
  </tr>
  
  <tr>
  
    <td id="row-title">ID Number: </td>
  
    <td><?php echo  $row_result_customer['IdNumber']; ?></td>
  
    <td id="row-title">&nbsp;</td>
  
    <td>&nbsp;</td>
  
  </tr>
  
  <tr>
  
    <th colspan="4">Vehicle Information</th>
  
  </tr>
  
  <tr>
  
    <td id="row-title">Vehicle:</td>
  
    <td><?php echo  $row_result_vehicle['Vehicle']; ?></td>
  
    <td id="row-title">&nbsp;</td>
  
    <td>&nbsp;</td>
  
  </tr>
  
  <tr>
  
    <td id="row-title">Vehicle Model: </td>
  
    <td><?php echo  $row_result_vehicle['VehicleModel']; ?></td>
  
    <td id="row-title">&nbsp;</td>
  
    <td>&nbsp;</td>
  
  </tr>
  
  <tr>
  
    <td id="row-title">Plate Number: </td>
  
    <td><?php echo  $row_result_vehicle['PlateNumber']; ?></td>
  
    <td>&nbsp;</td>
  
    <td>&nbsp;</td>
  
  </tr>
	
  <tr>
  
  <th  colspan="4">Payment Information</th>
  
  </tr>
  
  <tr>
   <td id="row-title">Total Cost: </td>
  
    <td><?php echo  'MK', $row_result_payment['Totalcost']; ?></td>
  
    <td id="row-title">Amount Paid: </td>
  
    <td><?php echo  'MK', $row_result_payment['AmountPaid']; ?></td>

  </tr>
  
   <tr>
  
    <td id="row-title">Balance: </td>
  
    <td><?php echo 'MK', $row_result_payment['Balance']; ?></td>
	
  </tr>	  	
  
  <tr>

	<td colspan="4">

	<div class="Form_buttons" >
	
	<a href="edit/editguest.php?gno=<?php echo $row_result_guest['GuestId']; ?>" rel="facebox" class="linkAsButton"><span>Edit</span></a> 
	
	<a target="_blank" href="checkout.php?gno=<?php echo $row_result_guest['GuestId']; ?>&rno=<?php echo  $row_result_reservation['RoomNo']; ?>&gfn=<?php echo $row_result_guest['FirstName']; ?>&gln=<?php echo $row_result_guest['LastName']; ?>" class="linkAsButton"><span>Check Out</span></a>

	</div></td>

</tr>  

</table>

<?php 
 }
?>