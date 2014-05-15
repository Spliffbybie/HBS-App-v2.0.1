<?php
require_once('_connections/db_link.php'); 

require_once('_includes/check_access.php');
//query selectn frm the db 
mysql_select_db($database_db_link, $db_link);
$select_guest = "SELECT * FROM guest";
$select_customer = "SELECT * FROM customers";

// execute query
$select_guest = mysql_query($select_guest,$db_link) or die(mysql_error());
$row_result_guest = mysql_fetch_assoc($select_guest);
$totalRows_guest = mysql_num_rows($select_guest);

$select_customer = mysql_query($select_customer,$db_link) or die(mysql_error());
$row_result_customer = mysql_fetch_assoc($select_customer);
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<title>Untitled Document</title>
</head>

<body>
<h1>Hotel Management System</h1>
<hr />
<a href="addguest.php">Add Guest</a> | <a href="reservation.php">View Reservation</a> |
<h2>Guest List</h2>
<?php echo date("m/d/y");?>
<table width="920" border="1">
  <tr>
   <th scope="col">Membership</th>
  	<th scope="col">Title </th>
    <th scope="col">F Nane </th>
    <th scope="col">L name </th>
    <th scope="col">Town</th>
    <th scope="col">Country</th>
    <th scope="col">Phone No. 1 </th>
    <th scope="col">Phone No. 2  </th>
   
  </tr>
  <?php 
  //check if database has records
  if ($totalRows_guest == '0') {
  echo "<h1>There are no records of any guest</h1>";
 	}
	else {
    		do { ?>
	<tr>
	<td><div align="center"><?php echo  $row_result_customer['Membership']; ?></div></td>
	<td><div align="center"><?php echo  $row_result_guest['GuestTitle']; ?></div></td>
    <td><a href="viewguest.php?GNo=<?php echo $row_result_guest['GuestId']; ?>"><?php echo  $row_result_guest['FirstName']; ?></a></td> 
	
    <td><div align="center"><?php echo  $row_result_guest['LastName']; ?></div></td>
    <td><div align="center"><?php echo  $row_result_guest['AddressTown']; ?></div></td>
    <td><div align="center"><?php echo  $row_result_guest['AddressCountry']; ?></div></td>
    <td><div align="center"><?php echo  $row_result_guest['PhoneNumber1']; ?></div></td>
    <td><div align="center"><?php echo  $row_result_guest['PhoneNumber2']; ?></div></td>
    
    </tr> <?php } while ($row_result_guest = mysql_fetch_assoc($select_guest)); 
		}
	?>
</table>
</body>
</html>
